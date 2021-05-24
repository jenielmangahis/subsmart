const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

const columns = {
  name: function (_, _, row) {
    const { name, recipients: recipientsData } = row;
    const recipients = recipientsData.map(({ name }) => name);
    const totalRecipients = recipients.length;
    const firstThree = recipients.slice(0, 3);

    if (totalRecipients <= 3) {
      const recipientStr = recipients.join(", ");

      return `
        <div>
            <p class="mb-0 text-title">${name}</p>
            <p class="mb-0 text-secondary">To: ${recipientStr}</p>
        </div>
    `;
    }

    const dataContent = `
        <div>
            <strong>Recipients</strong>
              ${recipients.map((name) => `<div>${name}</div>`).join("")}
        </div>
    `;

    return `
        <div>
            <div class="mb-0 text-title">${name}</div>
            <div class="mb-0 text-secondary">
                To: ${firstThree.join(", ")}
                <a
                    href="#"
                    class="text-link"
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content="${dataContent}"
                >
                    +${totalRecipients - 3} more
                </a>
            </div>
        </div>
    `;
  },
  status: function (_, _, row) {
    const { recipients } = row;

    const totalRecipients = recipients.length;
    const recipientsSigned = recipients.filter((r) => r.completed_at);
    const recipientsToSign = recipients.filter((r) => !r.completed_at);

    const totalRecipientsSigned = recipientsSigned.length;
    const totalSignedPercent = (totalRecipientsSigned * 100) / totalRecipients;

    let status = row.status;

    if (!/^waiting for others$/i.test(status)) {
      return status;
    }

    if (recipientsToSign.length) {
      const dataContentBody = recipientsToSign.map((recipient) => {
        const { name, sent_at, role } = recipient;
        const sentOnDate = moment(sent_at);
        const sentOnTime = moment(sent_at);

        const sentOnDateFormatted = sentOnDate.format("MM/DD/YYYY");
        const sentOnTimeFormatted = sentOnTime.format("HH:mm:ss A");

        let textSecondary = `Sent on ${sentOnDateFormatted} &bull; ${sentOnTimeFormatted}`;
        if (!sentOnDate.isValid() || !sentOnTime.isValid()) {
          textSecondary = role;
        }

        return `
            <div>
              <div>${name}</div>
              <div class='text-secondary'>${textSecondary}</div>
            </div>
          `;
      });

      const dataContent = `
        <div>
            <strong>Waiting for</strong>
            ${dataContentBody.join("<br>")}
        </div>
      `;

      status = `
        <a
          href="javascript:;"
          class="text-link"
          data-toggle="popover"
          data-placement="bottom"
          data-trigger="hover"
          data-content="${dataContent}"
        >
          ${row.status}
        </a>
      `;
    }

    return `
        <div>
            <div class="d-flex align-items-center">
                <div class="progress">
                    <div
                        class="progress-bar bg-success"
                        role="progressbar"
                        aria-valuenow="${totalRecipientsSigned}"
                        aria-valuemax="${totalRecipients}"
                        style="width: ${totalSignedPercent}%"
                    ></div>
                </div>
                ${totalRecipientsSigned}/${totalRecipients}
            </div>
            <div>${status}</div>
        </div>
    `;
  },
  manage: function (_, _, row) {
    const menu = {};
    const { status } = row;

    const isVoided = /^voided$/i.test(status);
    const isDraft = /^draft$/i.test(status);
    const isSent = /^waiting for others$/i.test(status);
    const isDeleted = /^trashed$/i.test(status);
    const isCompleted = /^completed$/i.test(status);

    const DELETE = "delete";
    const CONTINUE = "continue";
    const VOID = "void";
    const RESEND = "resend";
    const COPY = "copy";
    const HISTORY = "history";
    const SAVE_AS_TEMPLATE = "save as template";

    switch (true) {
      case isVoided:
        menu.primary = DELETE;
        menu.secondary = [HISTORY];
        break;

      case isDraft:
        menu.primary = CONTINUE;
        menu.secondary = [DELETE, HISTORY];
        break;

      case isDeleted:
        menu.primary = CONTINUE;
        menu.secondary = [HISTORY];
        break;

      case isSent:
        menu.primary = RESEND;
        menu.secondary = [COPY, DELETE, VOID, HISTORY, SAVE_AS_TEMPLATE];
        break;

      case isCompleted:
        menu.primary = HISTORY;
        menu.secondary = [SAVE_AS_TEMPLATE];
        break;
    }

    const { primary, secondary } = menu;

    if (!primary) {
      return "";
    }

    const primaryMenu = `
      <button
        type="button"
        class="btn btn-sm btn-primary d-flex align-items-center action text-capitalize" data-action="${primary}"
      >
        <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        ${primary}
      </button>
    `;

    let secondaryMenu = "";
    if (secondary && secondary.length) {
      const secondaryMenuItems = secondary.map((action) => {
        return `
          <a class="dropdown-item action text-capitalize" data-action="${action}" href="#">
            ${action}
          </a>
        `;
      });

      secondaryMenu = `
        <button
          type="button"
          class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            ${secondaryMenuItems.join("")}
        </div>
      `;
    }

    return `
        <div class="btn-group">
          ${primaryMenu}
          ${secondaryMenu}
        </div>
    `;
  },
  lastChanged: function (_, _, row) {
    let { updated_at } = row;
    updated_at = updated_at || row.created_at;

    const sentOnDate = moment(updated_at).format("MM/DD/YYYY");
    const sentOnTime = moment(updated_at).format("HH:mm:ss A");

    return `
      <div>
        <div>${sentOnDate}</div>
        <div class='text-secondary'>${sentOnTime}</div>
      </div>
    `;
  },
};

const actions = {
  delete: async function (row, table) {
    const $deleteModal = $("#confirmDelete");
    $deleteModal.modal("show");

    $deleteModal.find(".btn-danger").off();
    $deleteModal.find(".btn-danger").on("click", async function () {
      const $this = $(this);

      $this.prop("disabled", true);
      $this.find(".spinner-border").removeClass("d-none");

      const response = await fetch(`${prefixURL}/DocuSign/apiTrash/${row.id}`, {
        method: "DELETE",
      });

      const data = await response.json();
      table.row($(`#row${row.id}`)).remove().draw(); // prettier-ignore

      $this.prop("disabled", false);
      $this.find(".spinner-border").addClass("d-none");
      $deleteModal.modal("hide");
    });
  },
  resend: async function (row, _, event) {
    const $this = $(event.target);

    $this.prop("disabled", true);
    $this.find(".spinner-border").removeClass("d-none");

    const response = await fetch(`${prefixURL}/DocuSign/send`, {
      method: "POST",
      body: JSON.stringify({ document_id: row.id }),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const data = await response.json();
    $this.prop("disabled", false);
    $this.find(".spinner-border").addClass("d-none");
  },
  void: function (row, table) {
    const $voidModal = $("#confirmVoid");
    const $textarea = $voidModal.find("#voidReason");

    $textarea.val("");
    $voidModal.modal("show");

    $voidModal.find(".btn-danger").off();
    $voidModal.find(".btn-danger").on("click", async function () {
      const $this = $(this);
      const reason = $textarea.val().trim();

      if (!reason.length) {
        $textarea.focus();
        return;
      }

      $this.prop("disabled", true);
      $this.find(".spinner-border").removeClass("d-none");

      const response = await fetch(`${prefixURL}/DocuSign/apiVoid/${row.id}`, {
        method: "POST",
        body: JSON.stringify({ reason }),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });

      const { data } = await response.json();
      const updatedRow = { ...row, ...data };

      const $row = $(`#row${row.id}`);
      table.row($row.get(0)).data(updatedRow).draw();

      $this.prop("disabled", false);
      $this.find(".spinner-border").addClass("d-none");
      $voidModal.modal("hide");
    });
  },
  continue: function (row) {
    window.location = `${prefixURL}/esign/Files?id=${row.id}&next_step=2`;
  },

  copy: async function (row) {
    const response = await fetch(`${prefixURL}/DocuSign/apiCopy/${row.id}`, {
      method: "POST",
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });
    const { data } = await response.json();
    actions.continue(data);
  },
  history: function (row) {
    const formatDate = (date) => {
      if (!moment(date).isValid()) {
        return "-";
      }

      const dateFormat = moment(date).format("MM/DD/YYYY");
      const timeFormat = moment(date).format("HH:mm:ss A");

      return `${dateFormat} | ${timeFormat}`;
    };

    const $historyModal = $("#historyModal");
    $historyModal.modal("show");

    const { name, status, created_at, updated_at, recipients, id } = row;

    let recipientNames = recipients.map((r) => r.name).join(", ");
    recipientNames = recipients.length ? recipientNames : "-";

    $("[data-property-name=name]").text(name);
    $("[data-property-name=status]").text(status);
    $("[data-property-name=created_at]").text(formatDate(created_at));
    $("[data-property-name=updated_at]").text(formatDate(updated_at));
    $("[data-property-name=recipients]").text(recipientNames);
    $("[data-property-name=id]").text(id);
  },
  "save as template": async function (row) {
    const endpoint = `${prefixURL}/DocuSign/apiSaveEnvelopeAsTemplate/${row.id}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    window.location = `${prefixURL}/DocuSign/templatePrepare?id=${data.id}`;
  },
};

$(document).ready(function () {
  const $navItems = $(".submenus");
  const $table = $("#documentsTable");

  const views = [...$navItems].map((item) => {
    const navItemLink = $(item).find("a").attr("href");
    const urlParams = new URLSearchParams(new URL(navItemLink).search);
    if (!urlParams.has("view")) return null;
    return urlParams.get("view").toLowerCase();
  });

  const [defaultView] = views.filter(Boolean);

  const urlParams = new URLSearchParams(window.location.search);
  let view = urlParams.get("view");

  if (!view || !views.includes(view.toLowerCase())) {
    view = defaultView;
  }

  $("#currentView").text(view);

  $navItems.each(function (_, navItem) {
    const $navItem = $(navItem);
    const navItemLink = $navItem.find("a").attr("href");
    if (navItemLink.includes(view)) {
      $navItem.addClass("active");
    }
  });

  const table = $table.DataTable({
    searching: false,

    ajax: `${prefixURL}/DocuSign/apiManage/${view.toLowerCase()}`,
    columns: [
      {
        sortable: false,
        render: columns.name,
      },
      {
        sortable: false,
        render: columns.status,
      },
      {
        render: columns.lastChanged,
      },
      {
        sortable: false,
        render: columns.manage,
      },
    ],
    rowId: function (row) {
      return `row${row.id}`;
    },
    createdRow: function (row, data) {
      $(row).attr("data-id", data.id);
    },
  });

  table.on("draw", function () {
    $table.find('[data-toggle="popover"]').popover({ html: true });
  });

  $table.find("tbody").on("click", ".action", async function (event) {
    const $parent = $(this).closest("tr");
    const rows = table.rows().data().toArray();

    const rowId = $parent.data("id");
    const row = rows.find(({ id }) => id == rowId);

    const action = $(this).data("action");
    await actions[action](row, table, event);
  });
});

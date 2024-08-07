const prefixURL = "";
const PDFJS = pdfjsLib;

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
                    class="text-link nsm-link"
                    data-bs-toggle="popover"
                    data-bs-trigger="hover"
                    data-bs-placement="bottom"
                    data-bs-content="${dataContent}"
                >
                    +${totalRecipients - 3} more
                </a>
            </div>
        </div>
    `;
  },
  subject: function (_, _, row) {
    return  row.subject;
  },
  rowIcon: function(_, _, row){
    return '<div class="table-row-icon"><i class="bx bx-file"></i></div>';
  },
  docfileid: function(_, _, row){
    return '<b>' + row.unique_key + '</b>';
  },
  customerName: function(_, _, row){
    if( row.customer_firstname === null || row.customer_lastname === null ){
      return 'Customer nof found';
    }else{
      return row.customer_firstname + ' ' + row.customer_lastname;  
    }
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
      let badge = "";
      switch (status.toLowerCase()) {
        case "trashed":
          badge = "error";
          break;
        case "draft":
          badge = "warning";
          break
        case "completed":
          badge = "success";
          break;
      }

      return `
        <div class="nsm-badge ${badge}">
          ${status}
        </div>
      `;
    }

    if (recipientsToSign.length) {
      const dataContentBody = recipientsToSign.map((recipient) => {
        const { name, sent_at, role } = recipient;
        const sentOnDate = moment(sent_at);
        const sentOnTime = moment(sent_at);

        const sentOnDateFormatted = sentOnDate.format("MM/DD/YYYY");
        const sentOnTimeFormatted = sentOnTime.format("hh:mm A");

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
          tabindex="0"
          class="text-link nsm-link"
          data-bs-toggle="popover"
          data-bs-trigger="hover"
          data-bs-placement="bottom"
          data-bs-content="${dataContent}"
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
            </div>
            <span class="progress-count">${totalRecipientsSigned}/${totalRecipients}</span> - 
            <div class="label-waiting">${status}</div>
        </div>
    `;
  },
  manage: function (_, _, row) {
    if (row.signing_url) {
      return `
        <a href="${row.signing_url}" class="nsm-button" target="_blank" style="margin: 0;">
          Continue Signing
        </a>
      `;
    }

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
    const VIEW = "view";

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
        menu.primary = VIEW;
        menu.secondary = [HISTORY, SAVE_AS_TEMPLATE];
        break;
    }

    const { primary, secondary } = menu;

    if (!primary) {
      return "";
    }

    const primaryMenu = `
      <li>
        <a class="dropdown-item action text-capitalize" data-action="${primary}" href="#">
          ${primary}
        </a>
      </li>

    `;

    let secondaryMenu = "";
    if (secondary && secondary.length) {
      const secondaryMenuItems = secondary.map((action) => {
        return `
        <li>
          <a class="dropdown-item action text-capitalize" data-action="${action}" href="#">
            ${action}
          </a>
        </li>
        `;
      });

      secondaryMenu = secondaryMenuItems.join("");
    }

    const dropdown = `
      <div class="dropdown table-management">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          ${primaryMenu}
          ${secondaryMenu}
        </ul>
      </div>
    `;

    if (row.next_recipient && row.next_recipient.signing_url) {
      return `
        <div style="display: flex; align-items: center; justify-content: flex-end;">
          <a href="${row.next_recipient.signing_url}" class="nsm-button" target="_blank" style="margin: 0; margin-right: 8px;">
          Continue Signing (${row.next_recipient.name})
          </a>
          ${dropdown}
        </div>
      `;
    }

    return dropdown;
  },
  managerTools: function (_, _, row) {
    if (row.signing_url) {
      return `
        <a href="${row.signing_url}" class="nsm-button" target="_blank" style="margin: 0;">
          Continue Signing
        </a>
      `;
    }

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
    const VIEW = "view";

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
        menu.primary = VIEW;
        menu.secondary = [HISTORY, SAVE_AS_TEMPLATE];
        break;
    }

    const { primary, secondary } = menu;

    if (!primary) {
      return "";
    }

    const primaryMenu = `
      <li>
        <a class="dropdown-item action text-capitalize" data-action="${primary}" href="#">
          ${primary}
        </a>
      </li>

    `;

    let secondaryMenu = "";
    if (secondary && secondary.length) {
      const secondaryMenuItems = secondary.map((action) => {
        return `
        <li>
          <a class="dropdown-item action text-capitalize" data-action="${action}" href="#">
            ${action}
          </a>
        </li>
        `;
      });

      secondaryMenu = secondaryMenuItems.join("");
    }

    const dropdown = `
      <div class="dropdown table-management">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          ${primaryMenu}          
        </ul>
      </div>
    `;

    if (row.next_recipient && row.next_recipient.signing_url) {
      return `
        <div style="display: flex; align-items: center; justify-content: flex-end;">
          <a href="${row.next_recipient.signing_url}" class="nsm-button" target="_blank" style="margin: 0; margin-right: 8px;">
          Continue Signing (${row.next_recipient.name})
          </a>
          ${dropdown}
        </div>
      `;
    }

    return dropdown;
  },
  lastChanged: function (_, _, row) {
    let { updated_at } = row;
    updated_at = updated_at || row.created_at;

    const sentOnDate = moment(updated_at).format("MM/DD/YYYY");
    const sentOnTime = moment(updated_at).format("hh:mm A");

    return `
      <div>
        <div>${sentOnDate} <span class='text-secondary'>${sentOnTime}</span></div>
        
      </div>
    `;
  },
};

const actions = {
  view: function (row) {
    window.open(`/DocuSign/viewCompletedEsign/${row.id}`, "_blank");
  },
  delete: async function (row, table) {    
    Swal.fire({            
        title: "Delete Envelope",
        html: "You can find all your deleted envelopes in your Deleted bin within 24 hours before they're removed permanently.",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
          const response = fetch(`${prefixURL}/DocuSign/apiTrash/${row.id}`, {
            method: "DELETE",
          }).then(function() {
            Swal.fire({                        
                text: "Envelope was successfully deleted",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            }).then((result) => {
                //if (result.value) {                    
                    table.row($(`#row${row.id}`)).remove().draw(); // prettier-ignore
                //}
            });
          }).catch(function() {
            console.log("error");
          });
          //const data = await response.json();
        }
    });
  },
  resend: async function (row, _, event) {
    const $this = $(event.target);
    const $noticeModal = $("#loading_modal");

    $this.prop("disabled", true);
    $this.find(".spinner-border").removeClass("d-none");

    $noticeModal.modal('show');
    $noticeModal.find('.modal-body').html('<span class="bx bx-loader bx-spin"></span> Resending envelope....');

    const response = await fetch(`${prefixURL}/DocuSign/send`, {
      method: "POST",
      body: JSON.stringify({ document_id: row.id }),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const data = await response.json();

    $noticeModal.modal('hide');
    Swal.fire({                        
        text: "Envelope was successfully sent.",
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'Okay'
    }).then((result) => {
        
    }); 

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

      Swal.fire({                        
          text: "Envelope was successfully updated",
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'Okay'
      }).then((result) => {
          //if (result.value) {                    
          
          //}
      });
    });
  },
  continue: function (row) {
    /*if (!row.recipients.length) {
      window.location = `${prefixURL}/esign/Files?signing_id=${row.id}&next_step=3`;
      return;
    }*/

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
      const timeFormat = moment(date).format("hh:mm A");

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
    window.location = `${prefixURL}/eSign/templatePrepare?id=${data.id}`;
  },
};

$(document).ready(function () {
  const $navItems = $(".tabitem");
  const $table = $("#documentsTable");

  const views = [...$navItems].map((item) => {
    const navItemLink = $(item).find("a").attr("href");
    let urlParams = null;
    try {
      urlParams = new URLSearchParams(new URL(navItemLink).search);
    } catch (error) {
      return null;
    }
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
    //searching: false,

    ajax: `${prefixURL}/DocuSign/apiManage/${view.toLowerCase()}`,
    columns: [
      {
        sortable: false,
        render: columns.rowIcon,
      },
      {
        sortable: true,
        render: columns.docfileid,
      },
      {
        sortable: true,
        render: columns.customerName,
      },
      {
        sortable: true,
        render: columns.subject,
      },
      {
        sortable: true,
        render: columns.status,
      },
      {
        render: columns.lastChanged,
      },
      {
        sortable: false,
        ordering: false,
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

  $("#custom-esign-search").keyup(function() {             
      table.search($(this).val()).draw();
  });

  table.on("draw", function () {
    $table.find('[data-bs-toggle="popover"]').popover({ html: true });
  });

  $table.find("tbody").on("click", ".action", async function (event) {
    event.preventDefault();

    const $parent = $(this).closest("tr");
    const rows = table.rows().data().toArray();

    const rowId = $parent.data("id");
    const row = rows.find(({ id }) => id == rowId);

    const action = $(this).data("action");
    await actions[action](row, table, event);
  });
});

(() => {
  const $signadocument = $("#signadocument");
  const $modal = $("#selectDocument");
  const $input = $modal.find("#docFile");
  const $docModal = $("#documentModal");
  
  // senddocument
  const $sendEnvelope = $("#send-envelope");
  const $sendEnvelopeModal = $("#sendEnvelope");

  const validFileExtensions = ["pdf"];
  let files = [];

  async function createFilePreview(event, file) {
    await sleep(1000);
    const fileId = Date.now();
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    let document = null;
    const documentUrl = URL.createObjectURL(file);

    try {
      document = await PDFJS.getDocument({ url: documentUrl });
      document = await document.promise;
    } catch (error) {
      alert(error);
      return;
    }

    const html = `
      <div class="esignBuilder__docPreview h-100" data-id="${fileId}">
        <div class="esignBuilder__docPreviewHover"></div>

        <canvas></canvas>
        <div class="esignBuilder__docInfo">
            <div class="esignBuilder__docInfoText">
              <h5 class="esignBuilder__docTitle"></h5>
              <span class="esignBuilder__docPageCount"></span>
            </div>

            <div class="dropdown">
              <button
                class="btn dropdown-toggle esignBuilder__docInfoActions"
                type="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-ellipsis-v"></i>
              </button>

              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" data-action="preview" href="#">Preview</a>
                <a class="dropdown-item" data-action="delete" href="#">Delete</a>
              </div>
            </div>
        </div>

        <div class="esignBuilder__uploadProgress" width="100%">
            <span></span>
        </div>

        <div class="esignBuilder__uploadProgressCheck">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Check</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                </g>
            </svg>
        </div>
      </div>
    `;

    const $docPreview = createElementFromHTML(html);
    $(".fileupload").prepend($docPreview);

    const $progress = $docPreview.find(".esignBuilder__uploadProgress");
    const $progressCheck = $docPreview.find(".esignBuilder__uploadProgressCheck"); // prettier-ignore

    const documentPage = await document.getPage(1);

    const $canvas = $docPreview.find("canvas").get(0);
    const $docTitle = $docPreview.find(".esignBuilder__docTitle");
    const $docPageCount = $docPreview.find(".esignBuilder__docPageCount");
    const $docModalTitle = $docModal.find(".modal-title");
    const context = $canvas.getContext("2d");

    $docPreview.removeClass("d-none");
    context.clearRect(0, 0, $canvas.width, $canvas.height);
    $docPreview.removeClass("esignBuilder__docPreview--completed");
    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.removeClass("esignBuilder__uploadProgressCheck--completed");

    await sleep(1000);

    $docTitle.text(file.name);
    $docModalTitle.text(file.name);
    $docPageCount.text(`${document.numPages} page`);

    const scaleRequired = $canvas.width / documentPage.getViewport(1).width;
    const viewport = documentPage.getViewport(scaleRequired);
    const canvasContext = {
      viewport,
      canvasContext: context,
    };

    await documentPage.render(canvasContext);

    $docPreview.addClass("esignBuilder__docPreview--completed");
    $progress.addClass("esignBuilder__uploadProgress--completed");

    await sleep(500);

    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.addClass("esignBuilder__uploadProgressCheck--completed");

    files.push({ file, documentUrl, id: fileId });
    $docPreview
      .find(".esignBuilder__docPreviewHover")
      .on("click", showDocument);

    const actions = {
      preview: showDocument,
      delete: function (event) {
        files = files.filter((f) => f.id != fileId);
        const $parent = $(event.target).closest(".esignBuilder__docPreview");
        $parent.remove();
      },
    };

    $docPreview.find(".dropdown-item").on("click", function (event) {
      event.preventDefault();
      const action = $(this).attr("data-action");
      actions[action](event);
    });
  }

  async function showDocument(event) {
    const $parent = $(event.target).closest(".esignBuilder__docPreview");
    const fileId = $parent.attr("data-id");
    const { documentUrl } = files.find(({ id }) => id == fileId);

    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;

    for (index = 1; index <= document.numPages; index++) {
      const canvas = window.document.createElement("canvas");
      $modalBody.append(canvas);

      const documentPage = await document.getPage(index);
      const viewport = documentPage.getViewport({ scale: 1 });

      canvas.height = viewport.height;
      canvas.width = viewport.width;

      documentPage.render({
        viewport,
        canvasContext: canvas.getContext("2d"),
      });
    }

    $docModal.modal("show");
  }

  // https://stackoverflow.com/a/47480429/8062659
  function sleep(ms) {
    return new Promise((res) => setTimeout(res, ms));
  }

  // https://stackoverflow.com/a/494348/8062659
  function createElementFromHTML(htmlString) {
    var div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    return $(div.firstChild);
  }

  $signadocument.on("click", function (event) {
    event.preventDefault();
    $modal.modal("show");
  });

  // send envelope
  $sendEnvelope.on("click", function(e) {
    e.preventDefault();
    $sendEnvelopeModal.modal('show');
  })

  $input.on("change", async function (event) {
    const { files } = event.target;
    const promises = [...files].map((file) => createFilePreview(event, file));
    await Promise.all(promises);
  });

  $modal.find(".btn-primary").on("click", async function (event) {
    event.preventDefault();
    if (!files.length) return;

    const $this = $(this);
    $this.prop("disabled", true);
    $this.find(".spinner-border").removeClass("d-none");

    const formData = new FormData();
    formData.append("subject", "");
    formData.append("message", "");
    files.forEach(({ file }) => {
      formData.append("files[]", file);
    });

    const endpoint = `${prefixURL}/esign/fileSave`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: formData,
    });

    const { data } = await response.json();
    const { id: envelopeId } = data;
    window.location = `${prefixURL}/esign/Files?signing_id=${envelopeId}&next_step=3`;
  });

  $modal.on("hidden.bs.modal", function (e) {
    files = [];
    $modal.find(".esignBuilder__docPreview").remove();
  });
})();

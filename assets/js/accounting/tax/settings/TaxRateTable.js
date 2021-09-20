export class TaxRateTable {
  constructor() {
    this.$table = $("#rateTable");
    this.render();
  }

  render() {
    const columns = {
      name: (_, __, row) => {
        const isActive = row.is_active === "1";

        if (!row.items) {
          return `<span>${row.name} ${!isActive ? "(inactive)" : ""}</span>`;
        }

        const items = row.items.map((item) => {
          return `<div class="rate__subItem pl-3 pr-3">${item.name}</div>`;
        });

        return `
          <div class="rate__subItem">
            ${row.name} (combined) ${!isActive ? "(inactive)" : ""}
          </div>
          ${items.join("")}
        `;
      },
      agency: (_, __, row) => {
        if (!row.items) {
          return `<span>${row.agency}</span>`;
        }

        const items = row.items.map((item) => {
          return `<div class="rate__subItem">${item.agency}</div>`;
        });

        return `
          <div class="rate__subItem"></div>
          ${items.join("")}
        `;
      },
      rate: (_, __, row) => {
        if (!row.items) {
          return `<span>${row.rate}%</span>`;
        }

        const items = row.items.map((item) => {
          return `<div class="rate__subItem">${item.rate}%</div>`;
        });

        return `
          <div class="rate__subItem">${row.rate}%</div>
          ${items.join("")}
        `;
      },
      actions: (_, __, row) => {
        if (row.is_active !== "1") {
          return `
            <button data-action="makeActive" type="button" class="btn btn-sm btnGroup__main action">
              Make active
            </button>
          `;
        }

        if (!row.items) {
          return `
            <div class="btn-group btnGroup">
                <button data-action="edit" type="button" class="btn btn-sm btnGroup__main action">Edit</button>
                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a data-action="makeInactive" class="dropdown-item action" href="#">Make inactive</a>
                </div>
            </div>
          `;
        }

        const items = row.items.map((item) => {
          return `
            <div class="btn-group btnGroup rate__subItem">
                <button
                  data-action="edit"
                  type="button"
                  class="btn btn-sm btnGroup__main action"
                  style="flex: 0;"
                  data-itemid="${item.id}"
                >
                  Edit
                </button>
            </div>
          `;
        });

        return `
          <div class="btn-group btnGroup">
              <button data-action="edit" type="button" class="btn btn-sm btnGroup__main action">Edit</button>
              <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                  <a data-action="makeInactive" class="dropdown-item action" href="#">Make inactive</a>
              </div>
          </div>

          ${items.join("")}
        `;
      },
    };

    const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
    const includeInactive = this.shouldIncludeInactive();

    const actions = {
      edit: (row, _, event) => {
        const $sidebar = $("#editRate");
        const $sidebarCloseBtn = $sidebar.find("[data-action=close]");
        const $sidebarSaveBtn = $sidebar.find("#editRateBtn");

        const { itemid } = event.target.dataset;
        $sidebar.removeClass("editCustomRate--combined");

        if (row.items) {
          if (itemid) {
            row = row.items.find((i) => i.id == itemid);
          } else {
            $sidebar.addClass("editCustomRate--combined");
            const $parent = $sidebar.find("#editCombinedWrapper");
            const $wrapper = $sidebar.find("#editRateCombinedItems");
            const template = $parent.find("template").get(0).content;

            const htmls = row.items.map((item, index) => {
              item.title = `Rate ${index + 1}`;

              const copy = document.importNode(template, true);
              const $copy = $(copy);

              const $dataTypes = $copy.find("[data-type]");
              $dataTypes.each((_, element) => {
                element.textContent = item[element.dataset.type];
              });

              return $copy;
            });

            $wrapper.empty();
            $wrapper.append(htmls);
          }
        }

        const closeSidebar = () => {
          $sidebar.removeClass("sidebarForm--show");
          $sidebar.off("click");
          $sidebarCloseBtn.off("click");
          $sidebarSaveBtn.off("click");
        };

        const $data = $sidebar.find("[data-type]");
        $data.each((_, element) => {
          element.value = row[element.dataset.type];
        });

        $sidebar.addClass("sidebarForm--show");

        $sidebarCloseBtn.on("click", () => {
          closeSidebar();
        });

        $sidebar.on("click", (event) => {
          if ($sidebar.is(event.target)) {
            closeSidebar();
          }
        });

        $sidebarSaveBtn.on("click", async function () {
          let $inputs = $sidebar.find("#editSingleWrapper input[data-type]");

          if ($sidebar.hasClass("editCustomRate--combined")) {
            $inputs = $sidebar.find("#editCombinedWrapper input[data-type]");
          }

          const payload = {};
          for (let index = 0; index < $inputs.length; index++) {
            const input = $inputs[index];
            const value = input.value;
            const key = input.dataset.type;

            const $input = $(input);
            const $formGroup = $input.closest(".form-group");

            $formGroup.removeClass("form-group--error");
            if (!value) {
              $formGroup.addClass("form-group--error");
              $input.focus();
              return;
            }

            payload[key] = value;
          }

          delete payload.agency; // agency must be readonly

          $(this).attr("disabled", true);
          $(this).text("Saving...");

          let endpoint = `${prefixURL}/AccountingSales/apiEditRate/${row.id}`;
          if (row.sub_item) {
            endpoint = `${prefixURL}/AccountingSales/apiEditRateItem/${row.id}`;
          }

          const response = await fetch(endpoint, {
            method: "post",
            body: JSON.stringify(payload),
            headers: {
              accept: "application/json",
              "content-type": "application/json",
            },
          });

          const json = await response.json();
          window.location.reload();
        });
      },
      makeInactive: async ({ agency, ...rest }) => {
        const payload = { is_active: 0 };

        let endpoint = `${prefixURL}/AccountingSales/apiEditRate/${rest.id}`;
        if (rest.sub_item) {
          endpoint = `${prefixURL}/AccountingSales/apiEditRateItem/${rest.id}`;
        }
        const response = await fetch(endpoint, {
          method: "post",
          body: JSON.stringify(payload),
          headers: {
            accept: "application/json",
            "content-type": "application/json",
          },
        });

        const json = await response.json();
        window.location.reload();
      },
      makeActive: async ({ agency, ...rest }) => {
        const payload = { is_active: 1 };

        let endpoint = `${prefixURL}/AccountingSales/apiEditRate/${rest.id}`;
        if (rest.sub_item) {
          endpoint = `${prefixURL}/AccountingSales/apiEditRateItem/${rest.id}`;
        }

        const response = await fetch(endpoint, {
          method: "post",
          body: JSON.stringify(payload),
          headers: {
            accept: "application/json",
            "content-type": "application/json",
          },
        });

        const json = await response.json();
        window.location.reload();
      },
    };

    const table = this.$table.DataTable({
      searching: false,
      ajax: {
        type: "GET",
        url: `${prefixURL}/AccountingSales/apiGetRates?include_inactive=${includeInactive}`,
        dataSrc: ({ data }) => {
          return data.map((currData) => {
            currData.agency = currData.agency ? currData.agency.name : "";

            if (currData.items) {
              currData.items = currData.items.map((currItem) => {
                currItem.agency = currItem.agency ? currItem.agency.name : "";
                currItem.sub_item = true;
                return currItem;
              });
            }

            return currData;
          });
        },
      },
      columns: [
        {
          sortable: false,
          render: columns.name,
        },
        {
          sortable: false,
          render: columns.agency,
        },
        {
          sortable: false,
          render: columns.rate,
        },
        {
          sortable: false,
          render: columns.actions,
        },
      ],
      rowId: function (row) {
        return `row${row.id}`;
      },
      createdRow: function (row, data) {
        $(row).attr("data-id", data.id);
        if (data.is_active !== "1") {
          $(row).addClass("row--inactive");
        }
      },
    });

    this.$table.find("tbody").on("click", ".action", async function (event) {
      event.preventDefault();

      const $parent = $(this).closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $(this).data("action");
      const func = actions[action];

      if (!func) return;
      await actions[action](row, table, event);
    });
  }

  shouldIncludeInactive() {
    const includeInactiveKey = "nsmartrac::taxEditSettings__includeInactive";
    return Boolean(JSON.parse(localStorage.getItem(includeInactiveKey)));
  }
}

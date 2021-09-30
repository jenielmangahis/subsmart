export class UpcomingTaxPaymentsTable {
  data = [];

  constructor() {
    this.loadDeps().then(() => {
      this.$container = $("#taxRowContainer");
      this.$loader = this.$container.find(".payrollTax__loaderRow");
      this.template = $("#taxRowTemplate").get(0).content;

      this.render();
    });
  }

  async loadDeps() {
    const api = await import("./api.js");
    this.helpers = await import("./helpers.js");

    const { data: responseData } = await api.getPayrollTaxPayments();
    this.data = responseData.map((currData) => {
      return {
        type: {
          title: currData.name,
          date_range: currData.date_range,
        },
        status: "Ready to pay",
        amount: currData.balance,
        due_date: "8/2/2021",
        payment_method: {
          primary_text: "Manual",
          secondary_text: "Pay by 8/2/2021",
        },
        show_actions: true,
        secondary_data: {
          type: {
            title: "FL SUI Employer",
          },
          amount: currData.balance,
        },
      };
    });
  }

  render() {
    const rows = this.data.map((tax) => {
      const $row = $(document.importNode(this.template, true));
      const $dataElements = $row.find("[data-type]");
      const $actions = $row.find(".payrollTax__actions");
      const $expandBtn = $row.find(".payrollTax__taxTypeBtn");

      $dataElements.each((_, element) => {
        const $element = $(element);
        const key = $element.attr("data-type");
        const value = this.helpers.Accounting__getValue(tax, key);
        $element.text(value);

        if (key === "status") {
          const statusType = value.replace(/\s+/g, "-").toLowerCase();
          $element.addClass(`payrollTax__paymentStatus--${statusType}`);
        }
      });

      if (tax.show_actions) {
        $actions.removeClass("d-none");
      }

      $expandBtn.on("click", function () {
        const $root = $(this).closest(".payrollTax__row");
        const expandClass = "payrollTax__row--expanded";

        // $root.hasClass(expandClass) is not working correctly here :/
        if ($root.get(0).classList.contains(expandClass)) {
          $root.removeClass(expandClass);
          return;
        }

        $root.addClass(expandClass);
      });

      return $row;
    });

    console.clear();
    console.log(rows);

    this.$container.append(rows);
    this.$loader.addClass("d-none");
  }
}

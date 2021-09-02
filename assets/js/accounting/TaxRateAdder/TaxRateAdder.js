class TaxRateAdder {
  customRates = [];
  selectors = {};

  constructor($select, selectors) {
    this.loadDependencies().then(async () => {
      this.$select = $select;
      this.defaultSelected = $select.find("[default]").val();
      this.selectors = selectors;

      this.$sidebar = $("#addRateSidebar");
      this.$sidebarCloseBtn = this.$sidebar.find("[data-action=close]");
      this.$rateAgencySelect = $("#rateAgencySelect");
      this.$taxDisplay = $(selectors.totalTax);
      this.$grandTotalDisplay = $(selectors.grandTotal);
      this.$subTotalDisplay = $(selectors.subTotal);

      await this.render();
      this.attachEventListeners();
    });

    this.state = {
      setRates: (data) => {
        this.customRates = data;
      },
      addRate: (newData) => {
        this.customRates = [...this.customRates, newData];
      },
    };
  }

  async loadDependencies() {
    const { Accounting__DropdownWithSearch } = await import(
      "../tax/dropdown-with-search/dropdown-with-search.js"
    );
    const { rateAgencies } = await import("../tax/settings/rateAgencies.js");
    const api = await import("./api.js");

    this.Accounting__DropdownWithSearch = Accounting__DropdownWithSearch;
    this.rateAgencies = rateAgencies;
    this.api = api;
  }

  async render() {
    this.$select.prop("disabled", true);
    const response = await this.api.getRates();

    this.state.setRates(response.data);
    this.renderOptions();
    this.$select.prop("disabled", false);

    new this.Accounting__DropdownWithSearch(
      this.$rateAgencySelect,
      this.rateAgencies
    );
  }

  renderOptions() {
    this.customRates.forEach(({ id, name, rate }) => {
      if (this.$select.find(`[data-id=${id}]`).length === 0) {
        this.$select.append(
          `<option data-id="${id}" value="${id}">${name} (${rate}%)</option>`
        );
      }
    });
  }

  attachEventListeners() {
    const $addRateBtn = $("#addRateBtn");
    $addRateBtn.on("click", async (event) => {
      const $inputs = this.$sidebar.find("[data-type]");
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

        if ($(input).is(":checkbox") && !input.checked) {
          continue;
        }

        payload[key] = value;
      }

      const $this = $(event.target);
      $this.prop("disabled", true);
      $this.text("Saving...");

      const { data: newRate } = await this.api.saveRate(payload);
      this.state.addRate(newRate);
      this.renderOptions();
      this.closeSidebar({ nextValue: newRate.id });

      $this.attr("disabled", false);
      $this.text("Save");
    });

    this.$select.on("change", (event) => {
      const { value } = event.target;

      if (value === "add_custom") {
        this.$sidebar.addClass("sidebarForm--show");
      } else if (value === "location") {
        this.displayComputed({ tax: 7.5 });
      } else if (value === this.defaultSelected) {
        this.displayComputed();
      } else {
        this.displayComputed({ rateId: value });
      }
    });

    this.$sidebarCloseBtn.on("click", () => {
      this.closeSidebar();
    });

    this.$sidebar.on("click", (event) => {
      if (this.$sidebar.is(event.target)) {
        this.closeSidebar();
      }
    });
  }

  closeSidebar(params = {}) {
    const { nextValue } = params;
    this.$sidebar.find(".form-control").val("");
    this.$sidebar.removeClass("sidebarForm--show");
    this.$select.val(nextValue ? nextValue : this.defaultSelected);
    this.displayComputed({ rateId: nextValue });
  }

  displayComputed(params = {}) {
    const { rateId, tax } = params;

    let taxValue = this.calculateTax();
    if (rateId !== undefined) {
      const price = this.calculateSubtotal();
      const customRate = this.customRates.find(({ id }) => id == rateId);
      taxValue = (Number(customRate.rate) / 100) * price;
    }

    if (tax !== undefined) {
      const price = this.calculateSubtotal();
      taxValue = (Number(tax) / 100) * price;
    }

    this.$taxDisplay.text(this.formatCurrency(taxValue));
    this.$grandTotalDisplay.text(
      this.formatCurrency(this.calculateGrandTotal())
    );
    this.$subTotalDisplay.text(this.formatCurrency(this.calculateSubtotal()));
  }

  formatCurrency(number) {
    return accounting.formatMoney(number, { symbol: "" });
  }

  calculateTax() {
    let total = 0;
    $(this.selectors.tableRows).each((_, row) => {
      const $tax = $(row).find("input[name='tax[]']");
      total += Number($tax.val());
    });

    return Number(total);
  }

  calculateSubtotal() {
    let total = 0;
    $(this.selectors.tableRows).each((_, row) => {
      const $price = $(row).find("input[name='price[]']");
      const $quantity = $(row).find("input[name='quantity[]']");
      const $discount = $(row).find("input[name='discount[]']");

      const price = Number($price.val());
      const quantity = Number($quantity.val());
      const discount = Number($discount.val());

      total += price * quantity - discount;
    });

    return Number(total);
  }

  calculateGrandTotal() {
    const totalTax = accounting.unformat(this.$taxDisplay.text());
    return Number(this.calculateSubtotal()) + Number(totalTax);
  }
}

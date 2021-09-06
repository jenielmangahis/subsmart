class TaxRateAdder {
  customRates = [];
  selectors = {};

  constructor($select, selectors) {
    this.loadDependencies().then(async () => {
      this.$select = $select;
      this.$mainBtn = $select.find(".taxRateSelect__main");
      this.$itemWrapper = $select.find(".taxRateSelect__item--customWrapper");
      this.defaultSelected = $select.find("[default]").attr("value");
      this.$agencyIdInput = $("[name=agency_id]");

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
    this.$mainBtn.prop("disabled", true);
    const { data: rates } = await this.api.getRates();

    this.state.setRates(rates);
    this.renderOptions();
    this.$mainBtn.prop("disabled", false);

    const { data: agencies } = await this.api.getAgencies();
    let allAgencies = this.rateAgencies;

    if (agencies.length) {
      // Disable saved agencies.
      allAgencies = allAgencies.map((currAgency) => {
        return {
          text: currAgency,
          disabled: agencies.some(({ agency }) => agency === currAgency),
        };
      });

      allAgencies = [
        { text: "Saved Agencies", disabled: true },
        ...agencies.map(({ agency }) => agency),
        ...allAgencies,
      ];
    }

    new this.Accounting__DropdownWithSearch(
      this.$rateAgencySelect,
      allAgencies
    );
  }

  renderOptions() {
    this.customRates.forEach(({ id, name, rate }) => {
      if (this.$itemWrapper.find(`[data-id=${id}]`).length === 0) {
        const $item = $("<div></div>");
        const text = `${name} (${rate}%)`;

        $item.addClass("taxRateSelect__item");
        $item.addClass("taxRateSelect__item--custom");
        $item.addClass("ellipsis");
        $item.attr("data-id", id);
        $item.attr("title", text);
        $item.attr("value", id);
        $item.text(text);
        this.$itemWrapper.append($item);
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

    this.$mainBtn.on("click", () => {
      this.toggleOptions();
    });

    const $options = this.$select.find(".taxRateSelect__options");
    $options.on("click", (event) => {
      let $target = $(event.target);
      if (!$target.hasClass("taxRateSelect__item")) {
        $target = $target.closest(".taxRateSelect__item");
      }

      const value = $target.attr("value");
      if (!value) return;

      let agencyId = null;

      if (value === "add_custom") {
        this.$sidebar.addClass("sidebarForm--show");
      } else if (value === "location") {
        this.displayComputed({ tax: 7.5 });
      } else if (value === this.defaultSelected) {
        this.displayComputed();
      } else {
        const customRate = this.customRates.find(({ id }) => id == value);
        agencyId = customRate.agency_id;
        this.displayComputed({ rateId: value });
      }

      if (value !== "add_custom") {
        this.setButtonText($target.text());
      }

      this.$agencyIdInput.val(agencyId);
      this.hideOptions();
    });

    this.$sidebarCloseBtn.on("click", () => {
      this.closeSidebar();
    });

    this.$sidebar.on("click", (event) => {
      if (this.$sidebar.is(event.target)) {
        this.closeSidebar();
      }
    });

    $(document.body).on("click", (event) => {
      if (this.$select.has(event.target).length === 1) return;
      if (this.isOptionOpen()) {
        this.hideOptions();
      }
    });
  }

  isOptionOpen() {
    return this.$select.hasClass("taxRateSelect--open");
  }

  toggleOptions() {
    this.$select.toggleClass("taxRateSelect--open");
  }

  hideOptions() {
    this.$select.removeClass("taxRateSelect--open");
  }

  setButtonText(text) {
    this.$mainBtn.find("span").text(text);
  }

  closeSidebar(params = {}) {
    this.$sidebar.find(".form-control").val("");
    this.$sidebar.removeClass("sidebarForm--show");

    const { nextValue } = params;
    let $selected = undefined;

    if (nextValue) {
      $selected = this.$select.find(`[value=${nextValue}]`);
    } else {
      $selected = this.$select.find(`[value=${this.defaultSelected}]`);
    }

    this.setButtonText($selected.text());
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

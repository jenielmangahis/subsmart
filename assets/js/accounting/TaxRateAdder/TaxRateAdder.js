if (!window.TaxRateAdder) {
  window.TaxRateAdder = class {
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
            disabled: agencies.some(({ name }) => name === currAgency),
          };
        });

        allAgencies = [
          { text: "Saved Agencies", disabled: true },
          ...agencies.map(({ name }) => name),
          ...allAgencies,
        ];
      }

      this.userCreatedAgencies = agencies;
      this.allAgencies = allAgencies;
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
        let payload = {};

        if (!this.$sidebar.hasClass("customRate--combined")) {
          const $inputs = this.$sidebar.find("#rateSingleWrapper [data-type]");

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
        } else {
          const $items = this.$sidebar.find("#rateCombinedItems .rateCombined");
          const name = this.$sidebar.find("#rateCombinedWrapper [data-type=name]").val(); // prettier-ignore
          const items = [];
          $items.each((_, itemEl) => {
            const item = {};
            const $inputs = $(itemEl).find("[data-type]");

            for (let index = 0; index < $inputs.length; index++) {
              const input = $inputs[index];
              const { value } = input;
              const { type: key } = input.dataset;

              if (key === "agency") {
                const match = this.userCreatedAgencies.find(
                  ({ agency }) => agency === value
                );
                if (match) {
                  item["agency_id"] = match.id;
                  continue;
                }
              }

              item[key] = value;
            }

            items.push(item);
          });

          payload = { rates: items, name };
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

      // rate combined
      const $rateTypes = $("input[type=radio][name=rateType]");
      const $rateCombinedWrapper = this.$sidebar.find("#rateCombinedWrapper");
      const $rateCombinedItems =
        $rateCombinedWrapper.find("#rateCombinedItems");
      const $template = $rateCombinedWrapper.find("template");
      const $addCombineItem = $rateCombinedWrapper.find("#addCombinedItemBtn");
      let combinedRates = [{}];
      const template = $template.get(0).content;
      const renderCombinedRates = () => {
        const htmls = combinedRates.map((data, index, array) => {
          const copy = document.importNode(template, true);
          const $copy = $(copy);
          const $inputs = $copy.find("input");

          $copy.find(".rateCombined__title").text(`Rate ${index + 1}`);
          new this.Accounting__DropdownWithSearch(
            $copy.find(".dropdownWithSearch"),
            this.allAgencies
          );

          $copy.find(".rateCombined__btn--delete").on("click", function () {
            combinedRates = combinedRates.filter((_, i) => i !== index);
            renderCombinedRates();
          });

          $inputs.each((_, element) => {
            element.value = data[element.dataset.type] || "";
          });

          $inputs.on("change", function (event) {
            combinedRates = combinedRates.map((d, i) => {
              if (i !== index) return d;
              return { ...d, [event.target.dataset.type]: event.target.value };
            });
          });

          if (array.length <= 2) {
            $copy.find(".rateCombined").addClass("rateCombined--noDelete");
          }

          return $copy;
        });

        $rateCombinedItems.empty();
        $rateCombinedItems.append(htmls);
      };
      $rateTypes.change((event) => {
        if (event.target.value === "combined") {
          this.$sidebar.addClass("customRate--combined");
          renderCombinedRates();
          return;
        }

        this.$sidebar.removeClass("customRate--combined");
        combinedRates = [{}];
      });
      $addCombineItem.on("click", function () {
        combinedRates.push({});
        renderCombinedRates();
      });
      const $rateCombinedExampleToggle = $(
        ".rateCombined__exampleToggle button"
      );
      const $rateCombinedExample = $(".rateCombined__example");
      $rateCombinedExampleToggle.on("click", function () {
        if ($rateCombinedExample.hasClass("rateCombined__example--show")) {
          $rateCombinedExample.removeClass("rateCombined__example--show");
          $(this).text("Show example");
        } else {
          $rateCombinedExample.addClass("rateCombined__example--show");
          $(this).text("Hide example");
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
  };
}

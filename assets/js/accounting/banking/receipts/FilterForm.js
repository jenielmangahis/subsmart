function dateHandler($from, $to) {
  const format = (date) => date.format("YYYY-MM-DD");

  return {
    all: () => {
      $from.val("");
      $to.val("");
    },
    custom: () => {},
    "365_ago": () => {
      $from.val(format(moment().subtract(1, "year")));
      $to.val(format(moment()));
    },
    this_month: () => {
      $from.val(format(moment().startOf("month")));
      $to.val(format(moment().endOf("month")));
    },
    this_quarter: () => {
      // https://stackoverflow.com/a/14046800/8062659
      const quarter = Math.floor(moment().month() / 3) + 1;

      const { start, end } = getQuarterRange(quarter);
      $from.val(format(start));
      $to.val(format(end));
    },
    this_year: () => {
      $from.val(format(moment().startOf("year")));
      $to.val(format(moment().endOf("year")));
    },
    last_month: () => {
      const lastMonth = moment().subtract(1, "month");
      $from.val(format(lastMonth.startOf("month")));
      $to.val(format(lastMonth.endOf("month")));
    },
    last_quarter: () => {
      // https://stackoverflow.com/a/14046800/8062659
      const currQuarter = Math.floor(moment().month() / 3) + 1;

      const { start, end } = getQuarterRange(currQuarter - 1);
      $from.val(format(start));
      $to.val(format(end));
    },
    last_year: () => {
      const lastYear = moment().subtract(1, "year");
      $from.val(format(lastYear.startOf("year")));
      $to.val(format(lastYear.endOf("year")));
    },
  };
}

// https://stackoverflow.com/a/40412192/8062659
function getQuarterRange(quarter) {
  const start = moment().quarter(quarter).startOf("quarter");
  const end = moment().quarter(quarter).endOf("quarter");
  return { start, end };
}

export class FilterForm {
  constructor() {
    this.$filter = $("#receiptsFilterForm");

    this.loadDeps().then(() => {
      this.addEventListeners();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  addEventListeners() {
    const $dateType = this.$filter.find("#receiptsFilterForm__date");
    const $from = this.$filter.find("#receiptsFilterForm__from");
    const $to = this.$filter.find("#receiptsFilterForm__to");
    const dateHandlerFunc = dateHandler($from, $to);
    $dateType.on("change", () => dateHandlerFunc[$dateType.val()]());
    $from.on("change", () => $dateType.val("custom").change());
    $from.on("change", () => $dateType.val("custom").change());

    const $amountWrapper = this.$filter.find(".amountWrapper");
    const $amountType = $amountWrapper.find("#receiptsFilterForm__amount");
    $amountType.on("change", () => {
      $amountWrapper.find("input").val("");
      $amountWrapper.attr("data-type", $amountType.val());
    });

    const $submit = this.$filter.find(".btn-success");
    const $dataTypes = this.$filter.find("[data-type]");
    const $table = $("#receiptsReview");
    $submit.on("click", async () => {
      const payload = {};
      for (let index = 0; index < $dataTypes.length; index++) {
        const $element = $dataTypes[index];
        const value = $element.value;
        if (value && value.trim().length) {
          payload[$element.dataset.type] = value;
        }
      }

      $submit.addClass("receiptsButton--isLoading");
      $submit.prop("disabled", true);

      const { data } = await this.api.searchReceipts(payload);

      $submit.removeClass("receiptsButton--isLoading");
      $submit.prop("disabled", false);

      $table.DataTable().clear();
      $table.DataTable().rows.add(data);
      $table.DataTable().draw();
    });

    const $reset = this.$filter.find(".btn-default");
    $reset.on("click", () => {
      $("#receiptsFilterForm__category").val("").trigger("change");
    });
  }
}

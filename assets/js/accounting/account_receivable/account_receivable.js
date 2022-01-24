window.addEventListener("DOMContentLoaded", async () => {
  const { ReportsTable } = await import("./ReportsTable.js");
  const api = await import("./api.js");

  new ReportsTable($("#reportsTable"));

  const $customDropdown = $(".customDropdown__btn");
  $customDropdown.on("click", (event) => {
    const $btn = $(event.currentTarget);
    const $parent = $btn.closest(".customDropdown");

    if ($parent.hasClass("open")) {
      $parent.removeClass("open");
    } else {
      $parent.addClass("open");
    }
  });

  const $exportExcel = $("[data-action=export_excel]");
  $exportExcel.on("click", async (event) => {
    event.preventDefault();
    await api.exportAsExcel();
  });

  const $exportPDF = $("[data-action=export_pdf]");
  $exportPDF.on("click", async (event) => {
    event.preventDefault();
    $("#reportsTable_wrapper .buttons-pdf").click();
  });

  const $printBtn = $("[data-action=print]");
  $printBtn.on("click", (event) => {
    event.preventDefault();
    $("#reportsTable_wrapper .buttons-print").click();
  });

  const $emailModal = $("#emailReportModal");
  const $emailModalBtn = $emailModal.find(".btn-primary");
  const $emailModalForm = $emailModal.find("form");
  const { data: user } = await api.getUser();

  const $editHeaderBtn = $("[data-action=edit_header]");
  const $tableHeader = $(".accountReceivableTable__header");
  const $tableTitle = $tableHeader.find("[data-type=title]");
  const $tableSubtitle = $tableHeader.find("[data-type=subtitle]");
  const $tableTitleInput = $tableHeader.find("[data-type=title-input]");
  const $tableSubtitleInput = $tableHeader.find("[data-type=subtitle-input]");

  $emailModal.on("shown", function () {
    $(document).off("focusin.modal");
  });
  $emailModal.on("show.bs.modal", function () {
    const tableName = $tableTitleInput.val().trim();
    $("#emailReportTo").val("");
    $("#emailReportSubject").val("Your A/R Aging Summary Report");
    $("#emailReportReport").val("A/R Aging Summary Report");
    $("#emailReportBody").val(
      `Hello\n\nAttached is the A/R Aging Summary report for ${tableName}.\n\nRegards,\n${user.fullName}`
    );
  });
  $emailModalBtn.on("click", () => {
    $emailModalForm.submit();
  });
  $emailModalForm.on("submit", async (event) => {
    event.preventDefault();
    const $fields = $emailModal.find("[data-type]");
    $fields.removeClass("inputError");

    const payload = {};
    for (let index = 0; index < $fields.length; index++) {
      const $field = $fields[index];
      const name = $field.dataset.type;
      const value = $field.value;

      if (isEmpty(value)) {
        $field.classList.add("inputError");
        $field.focus();
        return;
      }

      if (name === "to" && !isEmail(value)) {
        $field.classList.add("inputError");
        $field.focus();
        return;
      }

      payload[name] = value;
    }

    $emailModalBtn.addClass("arBtn--isLoading");
    $emailModalBtn.prop("disabled", true);

    const response = await api.sendEmail(payload);
    console.log(response);

    $emailModalBtn.removeClass("arBtn--isLoading");
    $emailModalBtn.prop("disabled", false);
    $emailModal.modal("hide");
  });

  $editHeaderBtn.on("click", () => {
    $tableHeader.addClass("accountReceivableTable__header--edit");
  });

  const { data: tableInfo } = await api.getTableInfo();
  $tableTitle.text(tableInfo.title);
  $tableSubtitle.text(tableInfo.subtitle);
  $tableTitleInput.val(tableInfo.title);
  $tableSubtitleInput.val(tableInfo.subtitle);

  document.addEventListener("click", async (event) => {
    if (!$(event.target).closest(".customDropdown").length) {
      $(".customDropdown").removeClass("open");
    }

    if (!$(event.target).closest(".accountReceivableTable__header").length) {
      if (!$tableHeader.hasClass("accountReceivableTable__header--edit")) {
        return;
      }

      $tableHeader.removeClass("accountReceivableTable__header--edit");
      const title = $tableTitleInput.val().trim();
      const subtitle = $tableSubtitleInput.val().trim();

      $tableTitle.text(title);
      $tableSubtitle.text(subtitle);

      api.saveTableInfo({
        title,
        subtitle,
      });
    }
  });

  $("[data-type=days_per_aging_period], [data-type=number_of_periods]") //
    .on("input", function (event) {
      const $target = $(event.target);
      const $parent = $target.closest(".inputErrorWrapper");
      const value = Number($target.val());
      const min = Number($target.prop("min"));
      const max = Number($target.prop("max"));

      $target.removeClass("inputError");
      $parent.removeClass("inputErrorWrapper--active");

      if (value < min || value > max || isNaN(value)) {
        $target.addClass("inputError");
        $parent.addClass("inputErrorWrapper--active");
      }
    });

  const $runReport = $("#runReport");
  const $arForm = $(".accountReceivable__form");
  $runReport.on("click", async () => {
    const $dataTypes = $arForm.find("[data-type]");
    const payload = {};

    for (let index = 0; index < $dataTypes.length; index++) {
      const $dataType = $($dataTypes[index]);
      const $parentError = $dataType.closest(".inputErrorWrapper");
      const name = $dataType.data("type");

      if (
        ($dataType.prop("required") && isEmpty($dataType.val())) ||
        $dataType.hasClass("inputError")
      ) {
        $dataType.addClass("inputError");
        $parentError.addClass("inputErrorWrapper--active");
        $dataType.focus();
        return;
      }

      if ($dataType.is(":checkbox") || $dataType.is(":radio")) {
        payload[name] = $dataType.is(":checked");
      } else {
        payload[name] = $dataType.val();
      }

      $dataType.removeClass("inputError");
      $parentError.removeClass("inputErrorWrapper--active");
    }

    $runReport.addClass("buttonSubmit--isLoading");
    $runReport.prop("disabled", true);

    const response = await api.runReport(payload);
    console.log(response.data);

    $runReport.removeClass("buttonSubmit--isLoading");
    $runReport.prop("disabled", false);
  });

  $("[name=nonZeroActiveOnlyRows], [name=nonZeroActiveOnlyColumns]") //
    .on("change", function (event) {
      const $target = $(event.target);
      const $parent = $target.closest(".customDropdown");
      const $button = $parent.find("button");
      const $rowChecked = $parent.find("[name=nonZeroActiveOnlyRows]:checked");
      const $colChecked = $parent.find(
        "[name=nonZeroActiveOnlyColumns]:checked"
      );

      const rowValue = $rowChecked.val();
      const colValue = $colChecked.val();
      const rowValueCapitalized = capitalize(rowValue.split("_").join(" "));
      const colValueCapitalized = capitalize(colValue.split("_").join(" "));

      $button.text(`${rowValueCapitalized}/${colValueCapitalized}`);
      $button.val(`${rowValue}/${colValue}`);
    });

  $("[data-type=report_period]").on("change", (event) => {
    const $target = $(event.target);
    const $parent = $target.closest(".reportPeriodParent");
    const $siblings = $parent.find(".reportPeriodParent__hide");
    const $date = $parent.find("[type=date]");

    const format = (momentObject) => {
      return momentObject.format("YYYY-MM-DD");
    };

    const handlers = {
      all_dates: () => {
        $siblings.css({ visibility: "hidden" });
      },
      custom: () => {
        $date.val("");
      },
      today: () => {
        $date.val(format(moment()));
      },
      this_week: () => {
        $date.val(format(moment().endOf("week")));
      },
      this_week_to_date: () => {
        handlers.today();
      },
      this_month: () => {
        $date.val(format(moment().endOf("month")));
      },
      this_month_to_date: () => {
        handlers.today();
      },
      this_quarter: () => {
        $date.val(format(moment().endOf("quarter")));
      },
      this_quarter_to_date: () => {
        handlers.today();
      },
      this_year: () => {
        $date.val(format(moment().endOf("year")));
      },
      this_year_to_date: () => {
        handlers.today();
      },
      this_year_to_last_month: () => {
        $date.val(format(moment().startOf("year")));
      },
      yesterday: () => {
        $date.val(format(moment().subtract(1, "day")));
      },
      recent: () => {
        handlers.today();
      },
      last_week: () => {
        $date.val(format(moment().startOf("week").subtract(1, "day")));
      },
      last_week_to_date: () => {
        $date.val(format(moment().subtract(1, "week")));
      },
      last_month: () => {
        $date.val(format(moment().startOf("month").subtract(1, "day")));
      },
      last_month_to_date: () => {
        $date.val(format(moment().subtract(1, "month")));
      },
      last_quarter: () => {
        $date.val(format(moment().subtract(1, "quarter").endOf("quarter")));
      },
      last_quarter_to_date: () => {
        $date.val(format(moment().subtract(1, "quarter")));
      },
      last_year: () => {
        $date.val(format(moment().subtract(1, "year").endOf("year")));
      },
      last_year_to_date: () => {
        $date.val(format(moment().subtract(1, "year")));
      },
      since_30_days_ago: () => {
        handlers.all_dates();
      },
      since_60_days_ago: () => {
        handlers.all_dates();
      },
      since_90_days_ago: () => {
        handlers.all_dates();
      },
      since_365_days_ago: () => {
        handlers.all_dates();
      },
      next_week: () => {
        $date.val(format(moment().add(1, "week").endOf("week")));
      },
      next_4_week: () => {
        $date.val(format(moment().add(4, "week").endOf("week")));
      },
      next_month: () => {
        $date.val(format(moment().add(1, "month").endOf("month")));
      },
      next_quarter: () => {
        $date.val(format(moment().add(1, "quarter").endOf("quarter")));
      },
      next_year: () => {
        $date.val(format(moment().add(1, "year").endOf("year")));
      },
    };

    $siblings.css({ visibility: "visible" });
    handlers[event.target.value]();
  });

  const $customizeReport = $(".customizeReport");
  $("[data-action=customize_toggle]").on("click", () => {
    $customizeReport.addClass("customizeReport--show");
    $customizeReport.find(".collapse").first().collapse("show");
    $(".popover").popover("hide");
  });
  $("[data-action=customize_hide], .customizeReport__backdrop") //
    .on("click", () => {
      $customizeReport.removeClass("customizeReport--show");
      $customizeReport.find(".collapse").collapse("hide");
    });
  const $customizeReportBtn = $customizeReport.find(".btn-primary");
  $customizeReportBtn.on("click", async () => {
    const $dataTypes = $customizeReport.find("[data-type]");
    const payload = {};

    const $error = $customizeReport.find(".inputError");
    if ($error.length) {
      $error.closest(".collapse").collapse("show");
      $error.first().focus();
      return;
    }

    for (let index = 0; index < $dataTypes.length; index++) {
      const $dataType = $($dataTypes[index]);
      const name = $dataType.data("type");

      if ($dataType.is(":checkbox") || $dataType.is(":radio")) {
        payload[name] = $dataType.is(":checked");
      } else {
        payload[name] = $dataType.val();
      }
    }

    $customizeReportBtn.addClass("buttonSubmit--isLoading");
    $customizeReportBtn.prop("disabled", true);

    const response = await api.runReportCustomize(payload);
    setupReportFormValue($(".accountReceivable__form"), response.data);

    $customizeReportBtn.removeClass("buttonSubmit--isLoading");
    $customizeReportBtn.prop("disabled", false);
  });
  api.getReportCustomizeFormValues().then(({ data }) => {
    setupReportFormValue($customizeReport, data);
    setupReportFormValue($(".accountReceivable__form"), data);
  });

  const $saveCustomizationBtn = $("[data-action=save_customization]");
  const $saveCustomizationForm = $("#saveCustomizationForm");
  const saveCustomizationForm = $saveCustomizationForm.html();
  $saveCustomizationForm.remove();
  $saveCustomizationBtn.popover({
    html: true,
    sanitize: false,
    placement: "bottom",
    content: saveCustomizationForm,
  });
});

function setupReportFormValue($form, data) {
  const $dataTypes = $form.find("[data-type]");
  for (let index = 0; index < $dataTypes.length; index++) {
    const $dataType = $($dataTypes[index]);
    const key = $dataType.data("type");
    const value = data[key];

    if ($dataType.is(":checkbox")) {
      $dataType.prop("checked", Boolean(Number(value)));
      continue;
    }

    if ($dataType.is(":radio")) {
      if ($dataType.attr("name") === "aging_method") {
        $form
          .find(`[type=radio][value=${data.aging_method}]`)
          .prop("checked", true);
        continue;
      }
    }

    if (key === "show_nonzero_or_active_only") {
      const [row, column] = value.split("/");
      const $parent = $dataType.closest(".customDropdown");

      const $row = $parent.find(`[value=${row}]`);
      const $column = $parent.find(`[value=${column}]`);
      $row.prop("checked", true);
      $column.prop("checked", true);

      const rowValueCapitalized = capitalize(row.split("_").join(" "));
      const colValueCapitalized = capitalize(column.split("_").join(" "));
      const $button = $parent.find("button");
      $button.text(`${rowValueCapitalized}/${colValueCapitalized}`);
      $button.val(`${row}/${column}`);
    }

    $dataType.val(value);
    $dataType.get(0).value = value;
  }
}

function isEmpty(value) {
  return (
    (typeof value == "string" && !value.trim()) ||
    typeof value == "undefined" ||
    value === null
  );
}

function isEmail(string) {
  const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(string);
}

function capitalize(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

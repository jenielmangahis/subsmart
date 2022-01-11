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
});

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

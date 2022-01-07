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

  document.addEventListener("click", (event) => {
    if (!$(event.target).closest(".customDropdown").length) {
      $(".customDropdown").removeClass("open");
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
  const tableName = "ADI Smart Security";

  $emailModal.on("shown", function () {
    $(document).off("focusin.modal");
  });
  $emailModal.on("show.bs.modal", function () {
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

    $emailModalBtn.removeClass("arBtn--isLoading");
    $emailModalBtn.prop("disabled", false);

    const response = await api.sendEmail(payload);
    console.log(response);

    $emailModalBtn.removeClass("arBtn--isLoading");
    $emailModalBtn.prop("disabled", false);
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

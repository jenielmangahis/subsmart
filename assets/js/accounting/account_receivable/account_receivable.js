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
});

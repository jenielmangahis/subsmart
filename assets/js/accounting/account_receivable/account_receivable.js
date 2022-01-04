window.addEventListener("DOMContentLoaded", async () => {
  const { ReportsTable } = await import("./ReportsTable.js");

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
});

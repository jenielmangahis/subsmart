(() => {
  const $sidebar = $(".editTaxAgency");
  const $sidebarCloseBtn = $sidebar.find(".editTaxAgency__close");
  const $editLink = $(".settings__link");

  $editLink.on("click", (event) => {
    event.preventDefault();
    $sidebar.addClass("editTaxAgency--show");
  });

  $sidebarCloseBtn.on("click", () => {
    $sidebar.removeClass("editTaxAgency--show");
  });

  $sidebar.on("click", (event) => {
    if ($sidebar.is(event.target)) {
      $sidebar.removeClass("editTaxAgency--show");
    }
  });
})();

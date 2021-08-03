(() => {
  const $sidebarTriggers = $("[data-action]");

  $sidebarTriggers.on("click", function () {
    const sidebarId = $(this).attr("data-action");
    const showClass = "sidebarForm--show";

    const $sidebar = $(`#${sidebarId}`);
    const $sidebarCloseBtn = $sidebar.find("[data-action=close]");

    $sidebar.addClass(showClass);

    $sidebarCloseBtn.on("click", () => {
      $sidebar.removeClass(showClass);
    });

    $sidebar.on("click", (event) => {
      if ($sidebar.is(event.target)) {
        $sidebar.removeClass(showClass);
      }
    });
  });
})();

(() => {
  const $modal1 = $("#confirmEsignModal");
  const $modal2 = $("#docusignTemplateModal");

  const $btn1 = $("#confirmEsignModalTrigger");
  const $btn2 = $modal1.find(".btn-primary");
  const $btn3 = $modal1.find(".btn-secondary");

  $btn1.on("click", function (event) {
    event.preventDefault();
    $modal1.modal("show");
  });

  $btn2.on("click", function () {
    $modal1.modal("hide");
    $modal2.modal("show");
  });

  $modal2.on("hide.bs.modal", function () {
    $modal1.modal("show");
  });
})();

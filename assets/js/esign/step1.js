function Step1() {
  const validFileExtensions = ["pdf"];

  const $form = $("[data-form-step=1]");
  const $fileInput = $("#docFile");
  const $docPreview = $(".esignBuilder__docPreview");
  const $docModal = $("#documentModal");

  let documentUrl = null;

  async function onChangeFile(event) {
    const [file] = event.target.files;
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    documentUrl = URL.createObjectURL(file);
    const document = await PDFJS.getDocument({ url: documentUrl });
    const documentPage = await document.getPage(1);

    const $canvas = $docPreview.find("canvas").get(0);
    const $docTitle = $docPreview.find(".esignBuilder__docTitle");
    const $docPageCount = $docPreview.find(".esignBuilder__docPageCount");
    const $docModalTitle = $docModal.find(".modal-title");

    $docTitle.text(file.name);
    $docModalTitle.text(file.name);
    $docPageCount.text(`${document.numPages} page`);

    const scaleRequired = $canvas.width / documentPage.getViewport(1).width;
    const viewport = documentPage.getViewport(scaleRequired);
    const canvasContext = {
      viewport,
      canvasContext: $canvas.getContext("2d"),
    };

    await documentPage.render(canvasContext);
    $docPreview.removeClass("d-none");
  }

  async function onSubmit(event) {
    event.preventDefault();

    $form.off("submit");
    $form.submit();
  }

  async function showDocument() {
    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    const document = await PDFJS.getDocument({ url: documentUrl });
    for (index = 1; index <= document.numPages; index++) {
      const canvas = window.document.createElement("canvas");
      $modalBody.append(canvas);

      const documentPage = await document.getPage(index);
      const viewport = documentPage.getViewport(1);
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      documentPage.render({
        viewport,
        canvasContext: canvas.getContext("2d"),
      });
    }

    $docModal.modal("show");
  }

  function attachEventHandlers() {
    $fileInput.on("change", onChangeFile);
    $form.on("submit", onSubmit);
    $docPreview.on("click", showDocument);
  }

  async function init() {
    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  const $form = $("[data-form-step=1]");
  if ($form.length === 1) {
    const step = new Step1();
    step.init();
  }
});

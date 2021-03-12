function Step1() {
  const validFileExtensions = ["pdf"];

  const $form = $("[data-form-step=1]");
  const $fileInput = $("#docFile");
  const $docModal = $("#documentModal");

  const $docPreview = $(".esignBuilder__docPreview");
  const $progress = $(".esignBuilder__uploadProgress");
  const $progressCheck = $(".esignBuilder__uploadProgressCheck");

  const $submitButton = $(".esignBuilder__submit");

  let documentUrl = null;

  async function onChangeFile(event) {
    const [file] = event.target.files;
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    let document = null;
    documentUrl = URL.createObjectURL(file);

    try {
      document = await PDFJS.getDocument({ url: documentUrl });
    } catch (error) {
      alert(error);
      return;
    }

    const documentPage = await document.getPage(1);

    const $canvas = $docPreview.find("canvas").get(0);
    const $docTitle = $docPreview.find(".esignBuilder__docTitle");
    const $docPageCount = $docPreview.find(".esignBuilder__docPageCount");
    const $docModalTitle = $docModal.find(".modal-title");
    const context = $canvas.getContext("2d");

    $docPreview.removeClass("d-none");
    context.clearRect(0, 0, $canvas.width, $canvas.height);
    $docPreview.removeClass("esignBuilder__docPreview--completed");
    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.removeClass("esignBuilder__uploadProgressCheck--completed");

    await sleep(1000);

    $docTitle.text(file.name);
    $docModalTitle.text(file.name);
    $docPageCount.text(`${document.numPages} page`);

    const scaleRequired = $canvas.width / documentPage.getViewport(1).width;
    const viewport = documentPage.getViewport(scaleRequired);
    const canvasContext = {
      viewport,
      canvasContext: context,
    };

    await documentPage.render(canvasContext);

    $docPreview.addClass("esignBuilder__docPreview--completed");
    $progress.addClass("esignBuilder__uploadProgress--completed");

    await sleep(500);

    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.addClass("esignBuilder__uploadProgressCheck--completed");

    $submitButton.attr("disabled", false);
    $submitButton.addClass("btn-success");
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

// https://stackoverflow.com/a/47480429/8062659
const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

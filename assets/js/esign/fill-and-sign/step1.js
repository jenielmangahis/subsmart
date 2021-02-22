function Step1() {
  const validFileExtensions = ["pdf"];

  const $form = $("#form");
  const $fileInput = $("#fileInput");
  const $docPreview = $(".fillAndSign__docPreview");
  const $docModal = $("#documentModal");
  const $progress = $(".fillAndSign__uploadProgress");

  let documentUrl = null;
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  async function onChangeFile(event) {
    const [file] = event.target.files;
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    const $canvas = $docPreview.find("canvas").get(0);
    const $docTitle = $docPreview.find(".fillAndSign__docTitle");
    const $docPageCount = $docPreview.find(".fillAndSign__docPageCount");
    const $docModalTitle = $docModal.find(".modal-title");
    const context = $canvas.getContext("2d");

    $docPreview.removeClass("d-none");
    context.clearRect(0, 0, $canvas.width, $canvas.height);
    $docPreview.removeClass("fillAndSign__docPreview--completed");
    $progress.removeClass("fillAndSign__uploadProgress--completed");

    await sleep(1000);

    $docPreview.addClass("fillAndSign__docPreview--completed");
    $progress.addClass("fillAndSign__uploadProgress--completed");

    documentUrl = URL.createObjectURL(file);
    const document = await PDFJS.getDocument({ url: documentUrl });
    const documentPage = await document.getPage(1);

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

  async function onSubmit(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append("document", $fileInput.get(0).files[0]);

    const endpoint = `${prefixURL}/FillAndSign/store`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: formData,
      headers: {
        accepts: "application/json",
      },
    });

    const { document_id } = await response.json();
    window.location = `${prefixURL}/FillAndSign/step2?docid=${document_id}`;
  }

  function attachEventHandlers() {
    $fileInput.on("change", onChangeFile);
    $docPreview.on("click", showDocument);
    $form.on("submit", onSubmit);
  }

  async function init() {
    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  if ($("[data-step=1]").length !== 0) {
    const step = new Step1();
    step.init();
  }
});

// https://stackoverflow.com/a/47480429/8062659
const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

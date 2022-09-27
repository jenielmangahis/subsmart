function Step1() {
  jQuery.noConflict();
  const PDFJS = pdfjsLib;

  const validFileExtensions = ["pdf"];
  const prefixURL = "";

  const $form = $("[data-form-step=1]");
  const $fileInput = $("#docFile");
  const $docModal = $("#documentModal");
  const $sortable = $("#sortable");

  let files = [];

  async function createFilePreview(event, file) {
    await sleep(1000);
    const fileId = Date.now();
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    let document = null;
    const documentUrl = URL.createObjectURL(file);

    try {
      document = await PDFJS.getDocument({ url: documentUrl });
      document = await document.promise;
    } catch (error) {
      alert(error);
      return;
    }

    const html = `
      <div class="esignBuilder__docPreview h-100" data-id="${fileId}">
        <div class="esignBuilder__docPreviewHover"></div>

        <canvas></canvas>
        <div class="esignBuilder__docInfo">
            <div class="esignBuilder__docInfoText">
              <h5 class="esignBuilder__docTitle"></h5>
              <span class="esignBuilder__docPageCount"></span>
            </div>

            <div class="dropdown">
              <button
                class="btn dropdown-toggle esignBuilder__docInfoActions"
                type="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-ellipsis-v"></i>
              </button>

              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" data-action="preview" href="#">Preview</a>
                <a class="dropdown-item" data-action="delete" href="#">Delete</a>
              </div>
            </div>
        </div>

        <div class="esignBuilder__uploadProgress" width="100%">
            <span></span>
        </div>

        <div class="esignBuilder__uploadProgressCheck">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Check</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                </g>
            </svg>
        </div>
      </div>
    `;

    const $docPreview = createElementFromHTML(html);
    $(".fileupload").append($docPreview);

    const $progress = $docPreview.find(".esignBuilder__uploadProgress");
    const $progressCheck = $docPreview.find(".esignBuilder__uploadProgressCheck"); // prettier-ignore

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

    const scaleRequired =
      $canvas.width / documentPage.getViewport({ scale: 1 }).width;
    const viewport = documentPage.getViewport({ scale: scaleRequired });
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

    files.push({ file, documentUrl, id: fileId });
    $docPreview
      .find(".esignBuilder__docPreviewHover")
      .on("click", showDocument);

    const actions = {
      preview: showDocument,
      delete: function (event) {
        files = files.filter((f) => f.id != fileId);
        const $parent = $(event.target).closest(".esignBuilder__docPreview");
        $parent.remove();
        setSubjectFromFiles();
      },
    };

    $docPreview.find(".dropdown-item").on("click", function (event) {
      event.preventDefault();
      const action = $(this).attr("data-action");
      actions[action](event);
    });

    const $target = $(event.target);
    $target.val("");
    $target.removeAttr("required");

    setSubjectFromFiles();
  }

  function setSubjectFromFiles() {
    const $subject = $form.find("#subject");
    const filenames = files.map(({ file }) => file.name);
    const currValue = $subject.val().trim();

    if (currValue && !currValue.startsWith("Please eSign:")) {
      return;
    }

    let value = "";
    if (filenames.length) {
      value = `${$subject.prop("placeholder")} ${filenames.join(", ")}`;
    }

    $subject.val(value);
  }

  async function onChangeFile(event) {
    const { files: eventFiles } = event.target;

    if (files && files.length) {
      for (let index = 0; index < eventFiles.length; index++) {
        const file = eventFiles[index];
        if (files.find((f) => f.file.name === file.name)) {
          alert(`File name already exists: ${file.name}`);
          return;
        }
      }
    }

    const promises = [...eventFiles].map((file) =>
      createFilePreview(event, file)
    );
    await Promise.all(promises);
    $(".esignBuilder__submit").removeAttr("disabled");
  }

  async function onSubmit(event) {
    event.preventDefault();

    const $this = $(this);
    const $subject = $this.find("#subject");
    const $message = $this.find("#message");

    if (!$subject.val().trim()) {
      $subject.focus();
      return;
    }

    const $items = $(".esignBuilder__docPreview");
    let documentSequence = $items.map((_, item) => {
      const file = files.find((f) => f.id == $(item).attr("data-id"));
      return file === undefined ? null : file.file.name;
    });

    documentSequence = [...documentSequence].filter(Boolean);
    documentSequence = JSON.stringify({ sequence: documentSequence });

    const formData = new FormData();
    formData.append("subject", $subject.val());
    formData.append("message", $message.val());
    formData.append("document_sequence", documentSequence);

    files.forEach(({ file }) => {
      formData.append("files[]", file);
    });

    const response = await fetch($form.attr("action"), {
      method: "POST",
      body: formData,
    });

    const { data } = await response.json();
    const { id: envelopeId } = data;
    window.location = `${prefixURL}/esign_v2/Files?id=${envelopeId}&next_step=2`;
  }

  async function showDocument(event) {
    const $parent = $(event.target).closest(".esignBuilder__docPreview");
    const fileId = $parent.attr("data-id");
    const { documentUrl } = files.find(({ id }) => id == fileId);

    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    const document = await PDFJS.getDocument({ url: documentUrl });
    for (index = 1; index <= document.numPages; index++) {
      const canvas = window.document.createElement("canvas");
      $modalBody.append(canvas);

      const documentPage = await document.getPage(index);
      const viewport = documentPage.getViewport({ scale: 1 });
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
  }

  async function init() {
    attachEventHandlers();

    // console.log({ $sortable })
    // $sortable.disableSelection();
    $sortable.sortable({
      placeholder: "ui-state-highlight",
      items: "> .esignBuilder__docPreview",
      cursor: "move",
    });
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

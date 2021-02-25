function Step1() {
  const validFileExtensions = ["pdf"];

  const $form = $("#form");
  const $docPreview = $(".fillAndSign__docPreview");
  const $docModal = $("#documentModal");
  const $progress = $(".fillAndSign__uploadProgress");
  const $submitButton = $("#formSubmit");
  const $uploadButton = $(".fillAndSign__upload");

  const $selectFileModal = $("#selectDocumentModal");
  const $selectFileModalClose = $("#selectDocumentCloseButton");
  const $vaultTab = $("#vault");
  const $selectDocumentButton = $("#selectDocumentButton");
  const $fileInput = $("#fileInput");

  let vaultDocuments = [];
  let documentObj = null;
  let documentUrl = null;

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  async function previewDocument({ file, fileId = null }) {
    if (fileId) {
      const currFile = vaultDocuments.find(({ file_id }) => file_id == fileId);
      const { title, folder_name, file_path } = currFile;
      documentUrl = `${prefixURL}/uploads/${folder_name}${file_path}`;
      file = { name: title };
      documentObj = currFile;
    } else {
      documentUrl = URL.createObjectURL(file);
      documentObj = file;
    }

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

    $submitButton.attr("disabled", false);
    $submitButton.addClass("btn-success");
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

    if (documentObj === null) {
      return;
    }

    $submitButton.attr("disabled", true);
    $submitButton.find(".spinner-border").removeClass("d-none");

    const formData = new FormData();

    if (documentObj instanceof File) {
      formData.append("document", documentObj);
    } else {
      formData.append("vault_file_id", documentObj.file_id);
    }

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
    const $fileInputName = $fileInput
      .parent()
      .find(".custom-file-label__inner");

    $docPreview.on("click", showDocument);
    $form.on("submit", onSubmit);

    $uploadButton.on("click", (event) => {
      event.preventDefault();

      $fileInputName.html("Select Document");
      const $selected = $(".fillAndSign__vaultItem--selected");
      $selected.removeClass("fillAndSign__vaultItem--selected");
      $fileInput.val(null);

      $selectFileModal.show();
    });

    $selectFileModalClose.on("click", () => {
      $selectFileModal.hide();
    });

    $selectDocumentButton.on("click", async function () {
      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const $activeTab = $(".tab-pane.active");
      const uploadType = $activeTab.data("upload-type");

      let file = null;
      let fileId = null;

      if (uploadType === "local") {
        const files = $fileInput.get(0).files;
        if (files.length) {
          file = files[0];
        }
      } else {
        const $selected = $(".fillAndSign__vaultItem--selected");
        if ($selected.length) {
          fileId = parseInt($selected.data("file-id"));
        }
      }

      if (file === null && fileId === null) {
        return;
      }

      $selectFileModal.hide();
      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");

      await previewDocument({ file, fileId });
    });

    $fileInput.on("change", function () {
      const fileName = $(this).val();
      $fileInputName.html(fileName);
    });
  }

  async function fetchPdfs() {
    const endpoint = `${prefixURL}/FillAndSign/getVaultPdfs`;
    const response = await fetch(endpoint, {
      headers: {
        accepts: "application/json",
      },
    });

    const data = await response.json();
    vaultDocuments = data.documents;
  }

  function displayVaultDocuments() {
    if (!vaultDocuments.length) {
      $("#vault").append("<p>🤷‍♀️ Nothing to display here</p>");
      return;
    }

    const $elements = vaultDocuments.map((vaultDocument) => {
      const { file_id, title, FName, LName, created: createdRaw } = vaultDocument; // prettier-ignore
      const creator = `${FName} ${LName}`;
      const created = moment(createdRaw).format("MMMM DD, YYYY");

      const html = `
      <li class="fillAndSign__vaultItem" data-file-id=${file_id}>
          <div class="media">
              <i class="fa fa-file-pdf-o fa-2x text-danger mr-3"></i>
              <div class="media-body">
                  <h5 class="mt-0 fillAndSign__vaultItemTitle">${title}</h5>
                  <div class="fillAndSign__vaultItemInfo">
                      Created By <span>${creator}</span> on <span>${created}</span>
                  </div>
              </div>
          </div>
      </li>
      `;

      $element = createElementFromHTML(html);
      $element.on("click", (event) => {
        const $currActive = $(".fillAndSign__vaultItem--selected");
        $currActive.removeClass("fillAndSign__vaultItem--selected");

        let $target = $(event.target);
        if (!$target.hasClass("fillAndSign__vaultItem")) {
          $target = $target.closest(".fillAndSign__vaultItem");
        }

        $target.addClass("fillAndSign__vaultItem--selected");
      });

      return $element;
    });

    const $vaultList = $vaultTab.find(".fillAndSign__vault");
    $vaultList.append($elements);
  }

  async function init() {
    await fetchPdfs();

    displayVaultDocuments();
    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  $(".fillAndSign").css({ marginTop: $("#topnav").height() });

  if ($("[data-step=1]").length !== 0) {
    const step = new Step1();
    step.init();
  }
});

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

// https://stackoverflow.com/a/47480429/8062659
const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

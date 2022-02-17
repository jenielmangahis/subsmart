function Step1(params = {}) {
  const PDFJS = pdfjsLib;
  const validFileExtensions = ["pdf"];

  const $form = $("#form");
  const $docPreview = $(".fillAndSign__docPreview");
  const $docModal = $("#documentModal");
  const $progress = $(".fillAndSign__uploadProgress");
  const $progressCheck = $(".fillAndSign__uploadProgressCheck");
  const $submitButton = $("#formSubmit");
  const $uploadButton = $(".fillAndSign__upload");

  const $selectFileModal = $("#selectDocumentModal");
  const $selectFileModalClose = $("#selectDocumentCloseButton");
  const $vaultTab = $("#vault");
  const $recentTab = $("#recent");
  const $myTemplates = $("#myTemplates");
  const $selectDocumentButton = $("#selectDocumentButton");
  const $fileInput = $("#fileInput");

  let vaultDocuments = [];
  let documentObj = null;
  let documentUrl = null;
  let recentDocuments = [];
  let templates = [];
  let onSelect = params.onSelect || (() => {});

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  function getVaultDocumentById(id) {
    return vaultDocuments.find(({ file_id }) => file_id == id);
  }

  function getTemplateById(id) {
    return templates.find(({ id: currId }) => currId == id);
  }

  function getRecentById(id) {
    return recentDocuments.find(({ id: currId }) => currId == id);
  }

  async function previewDocument({
    file = null,
    fileId = null,
    recentFileId = null,
  }) {
    if (file instanceof File) {
      documentUrl = URL.createObjectURL(file);
      documentObj = file;
    } else if (fileId !== null) {
      const currFile = getVaultDocumentById(fileId);
      const { title, folder_name, file_path } = currFile;
      documentUrl = `${prefixURL}/uploads/${folder_name}${file_path}`;
      file = { name: title };
      documentObj = currFile;
    } else if (recentFileId !== null) {
      const currFile = getRecentById(recentFileId);
      documentUrl = `${prefixURL}/uploads/fillandsign/${currFile.name}`;
      file = { name: currFile.name };
      documentObj = currFile;
    } else {
      return;
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
    $progressCheck.removeClass("fillAndSign__uploadProgressCheck--completed");

    await sleep(1000);

    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;
    const documentPage = await document.getPage(1);

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

    $docPreview.addClass("fillAndSign__docPreview--completed");
    $progress.addClass("fillAndSign__uploadProgress--completed");

    await sleep(500);

    $progress.removeClass("fillAndSign__uploadProgress--completed");
    $progressCheck.addClass("fillAndSign__uploadProgressCheck--completed");

    $submitButton.attr("disabled", false);
    $submitButton.addClass("btn-success");
  }

  async function fetchRecentDocuments() {
    const endpoint = `${prefixURL}/FillAndSign/getRecents`;
    const response = await fetch(endpoint);
    const data = await response.json();
    recentDocuments = data.documents.map((d) => ({ ...d, isRecent: true }));
  }

  async function showDocument() {
    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;

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

  async function onSubmit(event) {
    event.preventDefault();

    if (documentObj === null) {
      return;
    }

    if (documentObj.isRecent) {
      window.location = `${prefixURL}/FillAndSign/step2?docid=${documentObj.id}`;
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
      const $selected = $(".fillAndSign__vaultItem--selected");

      let file = null;
      let fileId = null;
      let recentFileId = null;

      if (uploadType === "local") {
        const files = $fileInput.get(0).files;
        if (files.length) {
          file = files[0];
        }
      } else if ($selected.length) {
        if (uploadType === "vault") {
          fileId = $selected.data("file-id");
        } else {
          recentFileId = $selected.data("recent-id");
        }
      }

      if (file === null && fileId === null && recentFileId === null) {
        return;
      }

      $selectFileModal.hide();
      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");

      try {
        await previewDocument({ file, fileId, recentFileId });
      } catch (error) {
        alert(error);
      }
    });

    $fileInput.on("change", function (event) {
      const fileName = $(this).val();
      $fileInputName.html(fileName);
      onSelect(event);
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
      $vaultTab.append("<p>🤷‍♀️ Nothing to display here</p>");
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
        onSelect(event);
      });

      return $element;
    });

    $vaultTab.find(".fillAndSign__vault").append($elements);
  }

  function displayRecentDocuments() {
    if (!recentDocuments.length) {
      $recentTab.append("<p>🤷‍♀️ Nothing to display here</p>");
      return;
    }

    const $elements = recentDocuments.map((document) => {
      const { id, name, created: createdRaw } = document;
      const created = moment(createdRaw).format("MMMM DD, YYYY");

      const html = `
        <li class="fillAndSign__vaultItem" data-recent-id=${id}>
            <div class="media">
                <i class="fa fa-file-pdf-o fa-2x text-danger mr-3"></i>
                <div class="media-body">
                    <h5 class="mt-0 fillAndSign__vaultItemTitle">${name}</h5>
                    <div class="fillAndSign__vaultItemInfo">
                      Created on <span>${created}</span>
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
        onSelect(event);
      });

      return $element;
    });

    $recentTab.find(".fillAndSign__recent").append($elements);
  }

  function displayMyTemplates() {
    if (!templates.length) {
      $myTemplates.append("<p>🤷‍♀️ Nothing to display here</p>");
      return;
    }

    const $elements = templates.map((template) => {
      const { id, name, created_at: createdRaw, user, is_shared } = template;
      const created = moment(createdRaw).format("MMMM DD, YYYY");

      const html = `
        <li class="fillAndSign__vaultItem" data-template-id=${id}>
            <div class="media">
                <i class="fa fa-file-pdf-o fa-2x text-danger mr-3"></i>
                <div class="media-body">
                    <h5 class="mt-0 fillAndSign__vaultItemTitle">${name}</h5>
                    <div class="fillAndSign__vaultItemInfo">
                      Created on <span>${created}</span>
                  </div>
                </div>
            </div>
        </li>
        `;

      $element = createElementFromHTML(html);
      if (user && is_shared) {
        $element.find(".fillAndSign__vaultItemInfo").html(`
          Created by ${user.FName} ${user.LName} on ${created}
        `);
      }

      $element.on("click", (event) => {
        const $currActive = $(".fillAndSign__vaultItem--selected");
        $currActive.removeClass("fillAndSign__vaultItem--selected");

        let $target = $(event.target);
        if (!$target.hasClass("fillAndSign__vaultItem")) {
          $target = $target.closest(".fillAndSign__vaultItem");
        }

        $target.addClass("fillAndSign__vaultItem--selected");
        onSelect(event);
      });

      return $element;
    });

    $myTemplates.find(".fillAndSign__vault").append($elements);
  }

  async function fetchMyTemplates() {
    const endpoint = `${prefixURL}/DocuSign/apiTemplates?all=true`;
    const response = await fetch(endpoint, {
      headers: { accepts: "application/json" },
    });

    const { data } = await response.json();
    templates = data.map((currData) => ({ ...currData, isTemplate: true }));
  }

  async function init() {
    await fetchPdfs();
    await fetchRecentDocuments();
    await fetchMyTemplates();

    displayVaultDocuments();
    displayRecentDocuments();
    attachEventHandlers();
    displayMyTemplates();
  }

  return { init, getVaultDocumentById, getTemplateById, getRecentById };
}

$(document).ready(function () {
  if ($("[data-step=1]").length !== 0) {
    $(".fillAndSign").css({ marginTop: $("#topnav").height() });

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

function JobFillAndEsign() {
  const $nextButton = $("#fillAndSignNext");
  const $saveButton = $("#fillAndSignSave");

  const $modal = $("#fill_esign");

  let step1 = null;
  let step2 = null;
  let documentObj = null;

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  function onSelect(event) {
    let $target = $(event.target);

    const { files } = $target.get(0);

    if (files && !files.length) {
      return;
    }

    if (files) {
      documentObj = files[0];
    } else {
      const $activeTab = $(".tab-pane.active");
      const uploadType = $activeTab.data("upload-type");
      const $selected = $(".fillAndSign__vaultItem--selected");

      if (uploadType === "vault") {
        fileId = $selected.data("file-id");
        documentObj = step1.getVaultDocumentById(fileId);
      } else {
        recentFileId = $selected.data("recent-id");
        documentObj = step1.getRecentById(recentFileId);
      }
    }
  }

  function initStep2(documentId) {
    step2 = new Step2({ documentId });
    step2.init();
    $modal.attr("data-current-step", 2);
  }

  async function onClickNext() {
    if (documentObj.isRecent) {
      initStep2(documentObj.id);
      return;
    }

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
    initStep2(document_id);
  }

  function onClickSave() {
    $modal.modal("hide");
  }

  function attachEventHandlers() {
    $nextButton.on("click", onClickNext);
    $saveButton.on("click", onClickSave);
  }

  async function init() {
    step1 = new Step1({ onSelect: onSelect });
    await step1.init();

    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  new JobFillAndEsign().init();
});

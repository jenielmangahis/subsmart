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
      if (!$target.hasClass("fillAndSign__vaultItem")) {
        $target = $target.closest(".fillAndSign__vaultItem");
      }

      const fileId = parseInt($target.data("file-id"));
      documentObj = step1.getVaultDocumentById(fileId);
    }
  }

  async function onClickNext() {
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
    step2 = new Step2({ documentId: document_id });
    step2.init();

    $modal.attr("data-current-step", 2);
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

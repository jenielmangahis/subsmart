/**
 * This script uses some functions declared/can be found on
 * /js/esign/fill-and-sign/step2.js — make sure you
 * have that file linked. :)
 */

function JobFillAndEsign() {
  const $nextButton = $("#fillAndSignNext");
  const $saveButton = $("#fillAndSignSave");

  const $modal = $("#fill_esign");

  const $esignOnlyTab = $("#esign-only");
  const $signaturePad = $esignOnlyTab.find(".fillAndSign__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");

  const $fontSelect = $esignOnlyTab.find("#fontSelect");
  const $signatureTextInput = $esignOnlyTab.find(".fillAndSign__signatureInput"); // prettier-ignore

  const $authorizerName = $esignOnlyTab.find("#authorizerName");

  let step1 = null;
  let step2 = null;
  let documentObj = null;
  let signaturePad = null;
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  function onSelect(event) {
    let $target = $(event.target);

    const { files } = $target.get(0);

    if (files && files.length) {
      documentObj = files[0];
    } else {
      const $activeTab = $("[data-upload-type].tab-pane.active");
      const uploadType = $activeTab.data("upload-type");
      const $selected = $(".fillAndSign__vaultItem--selected");

      if (uploadType === "vault") {
        fileId = $selected.data("file-id");
        documentObj = step1.getVaultDocumentById(fileId);
      } else if (uploadType === "myTemplates") {
        fileId = $selected.data("template-id");
        documentObj = step1.getTemplateById(fileId);
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

  async function saveSignatureOnly() {
    const authorizerName = $authorizerName.val();

    if (isEmptyOrSpaces(authorizerName)) {
      alert("Authorizer name is required.");
      $authorizerName.focus();
      return;
    }

    const $activeTab = $esignOnlyTab.find(".tab-pane.active");
    const signatureType = $activeTab.data("signature-type");

    let signatureDataUrl = null;
    const canvas = $signaturePadCanvas.get(0);

    if (signatureType === "type") {
      const signature = $signatureTextInput.val();
      const fontSize = $signatureTextInput.css("font-size");
      const fontFamily = $signatureTextInput.css("font-family");
      const fontWeight = $signatureTextInput.css("font-weight");

      if (isEmptyOrSpaces(signature)) {
        alert("Signature is required.");
        return;
      }

      signaturePad.clear();
      const clonedCanvas = cloneCanvas(canvas);
      const context = clonedCanvas.getContext("2d");

      context.font = `${fontWeight} ${fontSize} ${fontFamily}`;
      const textWidth = context.measureText(signature).width;
      context.fillText(signature, clonedCanvas.width / 2 - textWidth / 2, 100); // prettier-ignore

      trimCanvas(context);
      signatureDataUrl = clonedCanvas.toDataURL("image/png");
    } else {
      if (isCanvasBlank(canvas)) {
        alert("Signature is required.");
        return;
      }

      const clonedCanvas = cloneCanvas(canvas);
      trimCanvas(clonedCanvas.getContext("2d"));
      signatureDataUrl = clonedCanvas.toDataURL("image/png");
    }

    const payload = {
      authorize_name: authorizerName,
      signature_link: signatureDataUrl,
      jobs_id: $("#jobid").val(),
      datetime_signed: moment().format("YYYY-MM-DD"),
    };

    const endpoint = `${prefixURL}/Job/createOrUpdateSignature`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const data = await response.json();
    console.log(data);

    signaturePad.clear();
    $signatureTextInput.val("");
    $authorizerName.val("");
    $modal.modal("hide");
  }

  async function onClickNext() {
    if ($esignOnlyTab.hasClass("active")) {
      return saveSignatureOnly();
    }

    if (documentObj.isRecent) {
      initStep2(documentObj.id);
      return;
    }

    if (documentObj.isTemplate) {
      const $fillAndSignNext = $("#fillAndSignNext");
      const jobId = $fillAndSignNext.data("id");
      const jobStatus = $fillAndSignNext.data("status");

      const formData = new FormData();
      formData.append("id", jobId);
      formData.append("status", jobStatus);

      const endpoint = `${prefixURL}/job/update_jobs_status`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
      });

      const text = await response.text();
      if (text === "Success") {
        const { id: templateId } = documentObj;
        window.location = `${prefixURL}/eSign/templatePrepare?id=${templateId}&job_id=${jobId}`;
      } else {
        await Swal.fire({
          title: "Warning!",
          text: "There is an error updating job status. Contact Administrator!",
          icon: "warning",
          showCancelButton: false,
          confirmButtonColor: "#32243d",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ok",
        });
      }
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

    $signaturePadClear.on("click", (event) => {
      event.preventDefault();
      signaturePad.clear();
    });

    const $fontItems = $fontSelect.find(".dropdown-item");
    const $fontItemText = $fontSelect.find(".dropdown-toggle");
    $fontItems.on("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      const $target = $(event.target);
      const font = $target.data("font");

      $fontItemText.text($target.text().trim());
      $signatureTextInput.attr("data-font", font);
      $fontSelect.removeClass("open");
    });
  }

  async function init() {
    signaturePad = new SignaturePad($signaturePadCanvas.get(0));

    step1 = new Step1({ onSelect });
    await step1.init();

    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  new JobFillAndEsign().init();
});

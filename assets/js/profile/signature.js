function Signature() {
  const $signatureModal = $("#updateSignature");
  const $closeModalButtons = $signatureModal.find(".close-me");
  const $createSignatureButton = $("#createSignatureButton");

  const $signaturePad = $signatureModal.find(".fillAndSign__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");

  const $fontSelect = $signatureModal.find("#fontSelect");
  const $signatureTextInput = $signatureModal.find(".fillAndSign__signatureInput"); // prettier-ignore

  const $signatureHolder = $(".signature-holder");

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  async function fetchUserSignature() {
    const endpoint = `${prefixURL}/Profile/getUserSignature`;
    const response = await fetch(endpoint, {
      headers: {
        accepts: "application/json",
      },
    });

    const data = await response.json();
    return data;
  }

  async function storeUserSignature(signatureUrl) {
    const payload = {
      signature: signatureUrl,
    };

    const endpoint = `${prefixURL}/Profile/createOrUpdateSignature`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const data = await response.json();
    return data;
  }

  function setSignature(data) {
    const $image = $signatureHolder.find("#userSignatureImage");
    const $imageDate = $signatureHolder.find("#userSignatureImageUpdatedAt");

    const { signature, updated_at } = data;
    $image.attr("src", signature);
    $imageDate.text(moment(updated_at).format("MM/DD/YYYY"));

    $signatureHolder.show();
    $("#userSignatureWarning").hide();
  }

  function attachEventHandlers() {
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
    });

    $signatureApplyButton.on("click", async function () {
      const $activeTab = $signatureModal.find(".tab-pane.active");
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

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const { data } = await storeUserSignature(signatureDataUrl);
      setSignature(data);

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
      $signatureModal.modal("hide");
    });

    $createSignatureButton.on("click", () => {
      $signatureModal.find(".fillAndSign__signatureInput").val("");
      signaturePad.clear();
      $signatureModal.modal("show");
    });

    $closeModalButtons.on("click", (event) => {
      event.preventDefault();
      $signatureModal.modal("hide");
    });
  }

  async function init() {
    const { data } = await fetchUserSignature();
    if (data) {
      setSignature(data);
    } else {
      $signatureHolder.hide();
    }

    signaturePad = new SignaturePad($signaturePadCanvas.get(0));
    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  new Signature().init();
});

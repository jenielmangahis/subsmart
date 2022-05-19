function Step2({ documentId }) {
  const $closeModalButtons = $(".fillAndSign__modal .close-me");

  const $documentContainer = $("#documentContainer");
  const $actions = $(".action--draggable");
  const $topnav = $(".fillAndSign__topnav");
  const $header = $("#topnav");

  const $signatureModal = $("#signatureModal");
  const $addSignatureButton = $("#addSignatureButton");

  const $signaturePad = $signatureModal.find(".fillAndSign__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");

  const $generateLinkAndEmail = $("#generateLinkAndEmail");
  const $sendEmailModal = $("#sendEmail");
  const $addEmailInput = $sendEmailModal.find("#sendEmailAddMore");
  const $sendEmailButton = $sendEmailModal.find("#sendEmailSendButton");

  const $copyLink = $("#copyLink");
  const $linkPreview = $(".fillAndSign__shareLink");
  const $copyLinkButton = $linkPreview.find(".btn");

  const $downloadButton = $("#downloadDocument");
  const $container = $(".fillAndSign");

  const $fontSelect = $signatureModal.find("#fontSelect");
  const $signatureTextInput = $signatureModal.find(".fillAndSign__signatureInput"); // prettier-ignore

  const $previewContainer = $(".fillAndSign__preview");
  const $doneButton = $("#doneButton");

  let fields = [];
  let signatures = [];
  let documentUrl = null;
  let signaturePad = null;
  let isStoring = false;
  let link = null;
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  async function renderPage({ canvas, page, document }) {
    const documentPage = await document.getPage(page);
    const viewport = await documentPage.getViewport(1.5);
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    await documentPage.render({
      viewport,
      canvasContext: canvas.getContext("2d"),
    });

    return canvas;
  }

  async function getPage({ page, ...rest }) {
    const html = `
      <div class="fillAndSign__canvasContainer" data-page="${page}">
        <canvas class="fillAndSign__document"></canvas>
      </div>
    `;
    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  async function getPagePreview({ page, ...rest }) {
    const html = `
      <div class="fillAndSign__previewItem">
        <canvas></canvas>
        <span>Page ${page}</span>
      </div>
    `;
    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  function createInputField({ textType, ...rest }) {
    const { value, unique_key, size } = rest;

    const styles = {
      initial: {},
      bold: { "font-weight": "bold" },
      italic: { "font-style": "italic" },
      underline: { "text-decoration": "underline" },
      strikethrough: { "text-decoration": "line-through" },
    };

    const events = {
      onClick: (event) => {
        const $target = $(event.target);

        if (
          $target.hasClass("fillAndSign__fieldClose") ||
          $target.parent().hasClass("fillAndSign__fieldClose")
        ) {
          return;
        }

        const $parent = $target.closest(".fillAndSign__field");
        const $input = $parent.find(".fillAndSign__fieldInput");
        placeCaretAtEnd($input.get(0));
      },
      onFocusOut: async (event) => {
        const $root = $(event.target).closest(".ui-draggable");
        const $parent = $root.find(".fillAndSign__field");

        $root.removeClass("ui-draggable-dragging");
        $parent.removeClass("fillAndSign__field--focused");

        await storeField({ $element: $parent });
      },
      onFocus: (event) => {
        const $parent = $(event.target).closest(".fillAndSign__field");
        $parent.addClass("fillAndSign__field--focused");
      },
      onDelete: async (event) => {
        event.stopPropagation();
        const $parent = $(event.target).closest(".fillAndSign__field");
        const uniqueKey = $parent.data("key");

        const endpoint = `${prefixURL}/FillAndSign/deleteField/${uniqueKey}`;
        await fetch(endpoint, { method: "DELETE" });

        $parent.remove();
      },
      onIncreaseFontSize: (event) => setFontSize(event),
      onReduceFontSize: (event) => setFontSize(event, false),
    };

    const setFontSize = async (event, increase = true) => {
      event.stopPropagation();
      const $parent = $(event.target).closest(".fillAndSign__field");
      const $input = $parent.find(".fillAndSign__fieldInput");

      const currFontSize = parseInt($input.css("font-size"), 10);
      const fontSize = increase ? currFontSize + 1 : currFontSize - 1;
      $input.css({ fontSize });
      await storeField({ $element: $parent });
    };

    const html = `
      <div class="fillAndSign__field" data-key="${unique_key || Date.now()}">
        <div tabindex="0" class="fillAndSign__fieldInput" contenteditable="true" spellcheck="false">
          ${value || ""}
        </div>
        <div class="fillAndSign__fieldOptions">
          <div class="fillAndSign__fieldReduce" title="Reduce size">
            <i class="fa fa-font"></i>
          </div>
          <div class="fillAndSign__fieldEnlarge" title="Increase size">
            <i class="fa fa-font"></i>
          </div>
          <div class="fillAndSign__fieldClose" title="Delete">
            <i class="fa fa-times"></i>
          </div>
        </div>
      </div>
    `;

    const $element = createElementFromHTML(html);

    $input = $element.find(".fillAndSign__fieldInput");
    $increase = $element.find(".fillAndSign__fieldEnlarge");
    $reduce = $element.find(".fillAndSign__fieldReduce");
    $close = $element.find(".fillAndSign__fieldClose");

    $element.on("click", events.onClick);
    $input.on("focus", events.onFocus);
    $input.on("focusout", events.onFocusOut);
    $increase.on("click", events.onIncreaseFontSize);
    $reduce.on("click", events.onReduceFontSize);
    $close.on("click", events.onDelete);

    const fontSize = parseInt(size, 10) || 16;
    $input.css({ ...styles[textType], fontSize });
    return $element;
  }

  function createSignature({ value, unique_key, size = null, ...rest }) {
    const events = {
      onDelete: async (event) => {
        const $parent = $(event.target).closest(".ui-draggable");
        const $signature = $parent.find(".fillAndSign__signatureDraw");
        const uniqueKey = $signature.data("key");

        const endpoint = `${prefixURL}/FillAndSign/deleteSignature/${uniqueKey}`;
        await fetch(endpoint, { method: "DELETE" });

        $parent.remove();
      },
    };

    let created_at = moment();
    if (rest.created_at) {
      created_at = moment(rest.created_at);
    }

    // prettier-ignore
    const html = `
      <div class="fillAndSign__signatureContainer">
        <img class="fillAndSign__signatureDraw" data-key=${unique_key || Date.now()} src="${value}"/>
        <span class="fillAndSign__signatureTime">${created_at.format('MMMM Do YYYY, h:mm:ss A')}</span>
        <div class="fillAndSign__signatureOptions">
          <div class="fillAndSign__signatureClose">
            <i class="fa fa-times"></i>
          </div>
        </div>
      </div>
    `;

    const $element = createElementFromHTML(html);

    $close = $element.find(".fillAndSign__signatureClose");
    $close.on("click", events.onDelete);

    if (size && size.width > 0) {
      $element.css({ width: size.width });
    }

    return $element;
  }

  async function storeField({ position, $element }) {
    if (isStoring) {
      return;
    }

    isStoring = true;
    let $root = $element;

    if (!$element.hasClass("ui-draggable")) {
      $root = $element.closest(".ui-draggable");
    }

    const $parent = $root.closest(".fillAndSign__canvasContainer");
    const $field = $root.find(".fillAndSign__field");
    const $input = $root.find(".fillAndSign__fieldInput");
    const key = $field.data("key");
    const value = $field.text().trim();
    const documentPage = $parent.data("page");
    const textType = $root.data("text-type");
    const fontSize = parseInt($input.css("font-size"), 10);

    if (!position) {
      position = {
        top: parseInt($root.css("top"), 10),
        left: parseInt($root.css("left"), 10),
      };
    }

    const payload = {
      coordinates: position,
      document_page: documentPage,
      document_id: documentId,
      unique_key: key,
      text_type: textType,
      value,
      size: fontSize,
    };

    const endpoint = `${prefixURL}/FillAndSign/storeField`;
    await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    isStoring = false;
  }

  async function fetchFields() {
    const endpoint = `${prefixURL}/FillAndSign/getFields/${documentId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    fields = data.fields;
  }

  async function fetchSignatures() {
    const endpoint = `${prefixURL}/FillAndSign/getSignatures/${documentId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    signatures = data.signatures;
  }

  async function fetchLink() {
    const endpoint = `${prefixURL}/FillAndSign/getLink/${documentId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    link = data.link;
  }

  async function renderPDF() {
    const document = await PDFJS.getDocument({ url: documentUrl });

    for (let index = 1; index <= document.numPages; index++) {
      if (index > 1) break;

      const currentFields = fields.filter(({ document_page }) => document_page == index); // prettier-ignore
      const currentSignatures = signatures.filter(({ document_page }) => document_page == index); // prettier-ignore

      const params = { page: index, document };
      const $page = await getPage(params);
      const $pagePreview = await getPagePreview(params);

      const $fields = currentFields.map((field) => {
        const { top, left } = JSON.parse(field.coordinates);
        const $item = createElementFromHTML(`
          <div
            class="action--draggable action--hasField ui-draggable ui-draggable-handle"
            data-text-type="${field.textType}"
          ></div>
        `);

        const $itemInner = createInputField(field);
        $item.html($itemInner);
        $item.css({
          position: "absolute",
          top: `${top}px`,
          left: `${left}px`,
        });

        $item.draggable({
          containment: ".ui-droppable",
          appendTo: ".ui-droppable",
          stop: (_, ui) => {
            storeField({ position: ui.position, $element: $(ui.helper) });
          },
        });

        return $item;
      });

      const $signatures = currentSignatures.map((signature) => {
        const { coordinates } = signature;
        const { top, left } = JSON.parse(coordinates);
        const size = JSON.parse(signature.size);

        $item = createSignature({ ...signature, size });

        $item.css({
          position: "absolute",
          top: `${top}px`,
          left: `${left}px`,
        });

        $item.resizable({
          handles: "e",
          stop: (_, ui) => {
            storeSignature({ $element: $(ui.helper) });
          },
        });

        $item.draggable({
          containment: ".ui-droppable",
          appendTo: ".ui-droppable",
          stop: (_, ui) => {
            storeSignature({ position: ui.position, $element: $(ui.helper) });
          },
        });

        return $item;
      });

      $page.append($fields);
      $page.append($signatures);

      $page.droppable({
        drop: function (_, ui) {
          if (!ui.draggable.hasClass("action")) {
            return;
          }

          const $item = $(ui.helper).clone();
          const $itemInner = createInputField({
            textType: $item.data("text-type"),
          });

          $item.html($itemInner);
          $item.removeClass("action");
          $item.addClass("action--hasField");

          $(this).append($item);
          $item.find(".fillAndSign__fieldInput").focus();

          storeField({ position: ui.position, $element: $item });
          $item.draggable({
            containment: ".ui-droppable",
            appendTo: ".ui-droppable",
            stop: (_, ui) =>
              storeField({ position: ui.position, $element: $(ui.helper) }),
          });
        },
      });

      $documentContainer.append($page);
      $previewContainer.append($pagePreview);
    }
  }

  async function storeSignature({ position, size, $element }) {
    if (isStoring) {
      return;
    }

    isStoring = true;
    $root = $element;

    if (!$element.hasClass("ui-draggable")) {
      $root = $element.closest(".ui-draggable");
    }

    const $parent = $element.closest(".fillAndSign__canvasContainer");
    const $image = $root.find(".fillAndSign__signatureDraw");
    const value = $image.attr("src");
    const documentPage = $parent.data("page");
    const uniqueKey = $image.data("key");

    if (!position) {
      position = {
        top: parseInt($root.css("top"), 10),
        left: parseInt($root.css("left"), 10),
      };
    }

    if (!size) {
      size = {
        width: parseInt($image.css("width"), 10),
        height: parseInt($image.css("height"), 10),
      };
    }

    const payload = {
      coordinates: position,
      document_page: documentPage,
      document_id: documentId,
      value,
      unique_key: uniqueKey,
      size,
    };

    const endpoint = `${prefixURL}/FillAndSign/storeSignature`;
    await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    isStoring = false;
  }

  async function createLink(docId) {
    const pdfDoc = await generatePDF(docId);
    const formData = new FormData();
    formData.append("document", pdfDoc.output("blob"));

    const endpoint = `${prefixURL}/FillAndSign/createLink/${docId}`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: formData,
      headers: {
        accepts: "application/json",
      },
    });

    const { link, ...rest } = await response.json();
    const documentLink = `${window.location.origin}${prefixURL}/uploads/fillandsign/out/${link.hash}.pdf`;
    return { ...rest, documentLink };
  }

  function attachEventHandlers() {
    const headerHeight = $header.height();

    $(window).scroll(() => {
      if (window.pageYOffset <= headerHeight + 50) {
        $topnav.removeAttr("style");
        return;
      }

      $topnav.css({
        position: "fixed",
        top: `${headerHeight}px`,
        left: 0,
        width: "100%",
        "z-index": 1,
      });
    });

    $doneButton.on("click", () => {
      window.location = `${prefixURL}/esignmain`;
    });

    $closeModalButtons.on("click", (event) => {
      event.preventDefault();
      $(event.target).closest(".fillAndSign__modal").hide();
    });

    $addSignatureButton.on("click", () => {
      $(".fillAndSign__signatureInput").val("");
      signaturePad.clear();
      $signatureModal.show();
    });

    $signaturePadClear.on("click", (event) => {
      event.preventDefault();
      signaturePad.clear();
    });

    $signatureApplyButton.on("click", async function () {
      const $activeTab = $("#signatureModal .tab-pane.active");
      const signatureType = $activeTab.data("signature-type");

      let $element = null;
      let signatureDataUrl = null;
      const canvas = $signaturePadCanvas.get(0);

      if (signatureType === "type") {
        const signature = $signatureTextInput.val();
        const fontSize = $signatureTextInput.css("font-size");
        const fontFamily = $signatureTextInput.css("font-family");
        const fontWeight = $signatureTextInput.css("font-weight");

        if (isEmptyOrSpaces(signature)) {
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
          return;
        }

        const clonedCanvas = cloneCanvas(canvas);
        trimCanvas(clonedCanvas.getContext("2d"));
        signatureDataUrl = clonedCanvas.toDataURL("image/png");
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      $element = createSignature({ value: signatureDataUrl });

      $(".ui-droppable").append($element);
      const position = { top: 0, left: 0 };
      $element.css({ position: "absolute", ...position });

      $element.resizable({
        handles: "e",
        stop: (_, ui) => storeSignature({ $element: $(ui.helper) }),
      });

      $element.draggable({
        containment: ".ui-droppable",
        appendTo: ".ui-droppable",
        stop: (_, ui) =>
          storeSignature({ position: ui.position, $element: $(ui.helper) }),
      });

      await storeSignature({ position, $element });
      $signatureModal.hide();

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
    });

    $copyLink.on("click", async (event) => {
      event.preventDefault();

      const { documentLink } = await createLink(documentId);
      $container.addClass("fillAndSign--readonly");

      $copyLinkButton.on("click", () => {
        const $temp = $("<input>");
        $("body").append($temp);
        $temp.val(documentLink).select();
        document.execCommand("copy");
        $temp.remove();
        $copyLinkButton.text("Copied!");
      });

      $linkPreview.find(".fillAndSign__shareLinkContent").html(documentLink);
      $linkPreview.addClass("fillAndSign__shareLink--show");
      setTimeout(() => {
        $linkPreview.removeClass("fillAndSign__shareLink--show");
        $copyLinkButton.text("Copy link");
      }, 5000);
    });

    $downloadButton.on("click", async (event) => {
      event.preventDefault();

      const { documentLink } = await createLink(documentId);
      $container.addClass("fillAndSign--readonly");
      downloadURI(documentLink);
    });

    $generateLinkAndEmail.on("click", async (event) => {
      event.preventDefault();
      $sendEmailModal.show();
    });

    $addEmailInput.on("click", (event) => {
      event.preventDefault();
      const $inputGroup = $sendEmailModal.find(".form-group");
      $inputGroup.append(
        `<input type="email" class="form-control mb-3" placeholder="Enter email">`
      );
    });

    $sendEmailButton.on("click", async function () {
      let emails = [];
      const $inputs = $sendEmailModal.find("input");

      for (let index = 0; index < $inputs.length; index++) {
        const $input = $($inputs[index]);
        const email = $input.val();

        if (isEmptyOrSpaces(email)) {
          continue;
        }

        if (!isValidEmail(email)) {
          alert("Invalid email address");
          return;
        }

        emails.push(email);
      }

      if (!emails.length) {
        return;
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const pdfDoc = await generatePDF(documentId);
      const formData = new FormData();

      formData.append("document", pdfDoc.output("blob"));
      emails.forEach((email) => {
        formData.append("emails[]", email);
      });

      const endpoint = `${prefixURL}/FillAndSign/emailDocument/${documentId}`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: { accepts: "application/json" },
      });

      await response.json();

      $container.addClass("fillAndSign--readonly");
      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");

      $sendEmailModal.hide();
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

  async function fetchDocument() {
    const endpoint = `${prefixURL}/FillAndSign/get/${documentId}`;
    const response = await fetch(endpoint, {
      headers: {
        accepts: "application/json",
      },
    });

    if (response.status !== 200) {
      return new Promise((_, reject) => reject(response));
    }

    const { document } = await response.json();
    documentUrl = `${prefixURL}/uploads/fillandsign/${document.name}`;
  }

  async function init() {
    signaturePad = new SignaturePad($signaturePadCanvas.get(0));
    attachEventHandlers();

    await fetchLink();

    if (link) {
      $container.addClass("fillAndSign--readonly");
    }

    try {
      await fetchDocument();
    } catch (error) {
      if (error.status === 404) {
        const message = '<h1 style="color: white;">Document Not Found</h1>';
        $documentContainer.append(message);
        $(".fillAndSign__footer").hide();
        $topnav.hide();
        return;
      }
    }

    await fetchFields();
    await fetchSignatures();
    await renderPDF();

    $actions.draggable({
      containment: ".ui-droppable",
      appendTo: ".ui-droppable",
      helper: "clone",
    });
  }

  return { init };
}

async function generatePDF(documentId) {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  let documentPdf = null;
  let fields = [];
  let signatures = [];

  async function fetchDocument() {
    const endpoint = `${prefixURL}/FillAndSign/get/${documentId}`;
    const response = await fetch(endpoint, {
      headers: {
        accepts: "application/json",
      },
    });

    const data = await response.json();
    documentPdf = data.document;
  }

  async function fetchFields() {
    const endpoint = `${prefixURL}/FillAndSign/getFields/${documentId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    fields = data.fields;
  }

  async function fetchSignatures() {
    const endpoint = `${prefixURL}/FillAndSign/getSignatures/${documentId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    signatures = data.signatures;
  }

  async function getPage({ page, ...rest }) {
    const html = `<canvas id="pdfCanvas"></canvas>`;
    const $element = createElementFromHTML(html);
    const canvas = $element.get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  async function renderPage({ canvas, page, document }) {
    const documentPage = await document.getPage(page);
    const viewport = await documentPage.getViewport(1.5);
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    await documentPage.render({
      viewport,
      canvasContext: canvas.getContext("2d"),
    });

    return canvas;
  }

  async function init() {
    await fetchDocument();
    await fetchFields();
    await fetchSignatures();

    const documentUrl = `${prefixURL}/uploads/fillandsign/${documentPdf.name}`;
    const document = await PDFJS.getDocument({ url: documentUrl });

    for (let index = 1; index <= document.numPages; index++) {
      if (index > 1) break;

      const currentFields = fields.filter(({ document_page }) => document_page == index); // prettier-ignore
      const currentSignatures = signatures.filter(({ document_page }) => document_page == index); // prettier-ignore
      const $page = await getPage({ page: index, document });
      const canvas = $page.get(0);
      const context = canvas.getContext("2d");

      currentFields.forEach((field) => {
        const { coordinates, textType, value, size } = field;

        const fontStyle = {
          initial: "",
          bold: "bold",
          italic: "italic",
          underline: "",
          strikethrough: "",
        };

        const fontSize = parseFloat(size, 10) || 16;
        const adjustments = { top: fontSize * 1.25, left: 8 };

        const coords = JSON.parse(coordinates);
        const x = coords.left + adjustments.left;
        const y = coords.top + adjustments.top;
        const color = "black";

        context.font = `${fontStyle[textType]} ${fontSize}px monospace`;
        context.fillStyle = color;
        context.fillText(value, x, y);

        const underlineParams = {
          x,
          y,
          color,
          context,
          text: value,
          textSize: fontSize,
        };

        if (textType === "underline") {
          textUnderline(underlineParams);
        } else if (textType === "strikethrough") {
          textUnderline({ ...underlineParams, strikethrough: true });
        }
      });

      currentSignatures.forEach((signature) => {
        const { coordinates, size: _size, value, created_at } = signature;
        const { top, left } = JSON.parse(coordinates);
        const size = JSON.parse(_size);

        const image = new Image(size.width, size.height);
        image.src = value;
        context.drawImage(image, left, top, image.width, image.height);

        if (created_at) {
          const date = moment(created_at).format("MMMM Do YYYY, h:mm:ss A");
          const fontSize = 10;
          const marginTop = 12;

          context.font = `${fontSize}px Verdana`;
          const width = context.measureText(date).width;

          const topDate = top + image.height + marginTop;
          const topBg = topDate - 10; // adjust if needed
          const leftBg = left - 2; // 2px padding left
          const widthBg = width + 4; // 2px padding right
          const heightBg = fontSize + 2; // base on fontsize

          context.fillStyle = "#333";
          context.fillRect(leftBg, topBg, widthBg, heightBg);

          context.fillStyle = "#fff";
          context.fillText(date, left, topDate);
        }
      });

      // $(window.document.body).append($page);

      const doc = new jspdf.jsPDF();
      const width = doc.internal.pageSize.getWidth();
      const height = doc.internal.pageSize.getHeight();

      const image = canvas.toDataURL("image/png");
      const imageAlias = undefined;
      const imageCompression = "MEDIUM"; // 'NONE', 'FAST', 'MEDIUM', 'SLOW'

      doc.addImage(image, "PNG", 0, 0, width, height, imageAlias, imageCompression); // prettier-ignore
      // doc.save(`${documentPdf.name}.pdf`);
      return doc;
    }
  }

  return init();
}

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  const documentId = parseInt(urlParams.get("docid"));

  if (Number.isInteger(documentId) && $("[data-step=2]").length !== 0) {
    $(".fillAndSign").css({ marginTop: $("#topnav").height() });

    const step = new Step2({ documentId });
    step.init();
  }
});

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

// https://stackoverflow.com/a/4238971/8062659
function placeCaretAtEnd(el) {
  el.focus();
  if (
    typeof window.getSelection != "undefined" &&
    typeof document.createRange != "undefined"
  ) {
    var range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
  } else if (typeof document.body.createTextRange != "undefined") {
    var textRange = document.body.createTextRange();
    textRange.moveToElementText(el);
    textRange.collapse(false);
    textRange.select();
  }
}

// https://stackoverflow.com/a/10232792/8062659
function isEmptyOrSpaces(str) {
  return str === null || str.match(/^ *$/) !== null;
}

// https://stackoverflow.com/a/17386803/8062659
function isCanvasBlank(canvas) {
  return !canvas
    .getContext("2d")
    .getImageData(0, 0, canvas.width, canvas.height)
    .data.some((channel) => channel !== 0);
}

// https://stackoverflow.com/a/45873660/8062659
function trimCanvas(ctx) {
  // removes transparent edges
  var x, y, w, h, top, left, right, bottom, data, idx1, idx2, found, imgData;
  w = ctx.canvas.width;
  h = ctx.canvas.height;
  if (!w && !h) {
    return false;
  }
  imgData = ctx.getImageData(0, 0, w, h);
  data = new Uint32Array(imgData.data.buffer);
  idx1 = 0;
  idx2 = w * h - 1;
  found = false;
  // search from top and bottom to find first rows containing a non transparent pixel.
  for (y = 0; y < h && !found; y += 1) {
    for (x = 0; x < w; x += 1) {
      if (data[idx1++] && !top) {
        top = y + 1;
        if (bottom) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2--] && !bottom) {
        bottom = h - y - 1;
        if (top) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
    }
    if (y > h - y && !top && !bottom) {
      return false;
    } // image is completely blank so do nothing
  }
  top -= 1; // correct top
  found = false;
  // search from left and right to find first column containing a non transparent pixel.
  for (x = 0; x < w && !found; x += 1) {
    idx1 = top * w + x;
    idx2 = top * w + (w - x - 1);
    for (y = top; y <= bottom; y += 1) {
      if (data[idx1] && !left) {
        left = x + 1;
        if (right) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2] && !right) {
        right = w - x - 1;
        if (left) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      idx1 += w;
      idx2 += w;
    }
  }
  left -= 1; // correct left
  if (w === right - left + 1 && h === bottom - top + 1) {
    return true;
  } // no need to crop if no change in size
  w = right - left + 1;
  h = bottom - top + 1;
  ctx.canvas.width = w;
  ctx.canvas.height = h;
  ctx.putImageData(imgData, -left, -top);
  return true;
}

// https://stackoverflow.com/a/8306028/8062659
function cloneCanvas(oldCanvas) {
  //create a new canvas
  var newCanvas = document.createElement("canvas");
  var context = newCanvas.getContext("2d");

  //set dimensions
  newCanvas.width = oldCanvas.width;
  newCanvas.height = oldCanvas.height;

  //apply the old canvas to the new one
  context.drawImage(oldCanvas, 0, 0);

  //return the new canvas
  return newCanvas;
}

// https://stackoverflow.com/a/15832662/8062659
function downloadURI(uri) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}

// https://scriptstock.wordpress.com/2012/06/12/html5-canvas-text-underline-workaround/
var textUnderline = function ({
  context,
  text,
  x,
  y,
  color = "black",
  textSize = 16,
  strikethrough = false,
  align = undefined,
}) {
  //Get the width of the text
  var textWidth = context.measureText(text).width;

  //var to store the starting position of text (X-axis)
  var startX;

  //var to store the starting position of text (Y-axis)
  // I have tried to set the position of the underline according
  // to size of text. You can change as per your need
  var startY = y + parseInt(textSize) / 15;
  if (strikethrough) {
    startY = y - (textSize / 2 - textSize * 0.2); // adjust if needed :D
  }

  //var to store the end position of text (X-axis)
  var endX;

  //var to store the end position of text (Y-axis)
  //It should be the same as start position vertically.
  var endY = startY;

  //To set the size line which is to be drawn as underline.
  //Its set as per the size of the text. Feel free to change as per need.
  var underlineHeight = parseInt(textSize) / 15;

  //Because of the above calculation we might get the value less
  //than 1 and then the underline will not be rendered. this is to make sure
  //there is some value for line width.
  if (underlineHeight < 1) {
    underlineHeight = 1;
  }

  context.beginPath();
  if (align == "center") {
    startX = x - textWidth / 2;
    endX = x + textWidth / 2;
  } else if (align == "right") {
    startX = x - textWidth;
    endX = x;
  } else {
    startX = x;
    endX = x + textWidth;
  }

  context.strokeStyle = color;
  context.lineWidth = underlineHeight;
  context.moveTo(startX, startY);
  context.lineTo(endX, endY);
  context.stroke();
};

// https://stackoverflow.com/a/46181/8062659
function isValidEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

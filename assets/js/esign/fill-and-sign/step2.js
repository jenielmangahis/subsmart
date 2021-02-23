function Step2(documentId) {
  const $documentContainer = $("#documentContainer");
  const $actions = $(".action--draggable");
  const $topnav = $(".fillAndSign__topnav");
  const $header = $("#topnav");

  const $signatureModal = $("#signatureModal");
  const $addSignatureButton = $("#addSignatureButton");
  const $signatureModalCloseButton = $("[data-dismiss=modal]");

  const $signaturePad = $(".fillAndSign__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");

  const $copyLink = $("#copyLink");
  const $linkPreview = $(".fillAndSign__shareLink");
  const $copyLinkButton = $linkPreview.find(".btn");

  const $downloadButton = $("#downloadDocument");
  const $container = $(".fillAndSign");

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

  function createInputField({ textType, ...rest }) {
    const { value, unique_key } = rest;

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

        const position = {
          top: parseInt($root.css("top"), 10),
          left: parseInt($root.css("left"), 10),
        };

        await storeField(position, $parent);
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

    const setFontSize = (event, increase = true) => {
      event.stopPropagation();
      const $parent = $(event.target).closest(".fillAndSign__field");
      const $input = $parent.find(".fillAndSign__fieldInput");

      const fontSize = parseInt($input.css("font-size"), 10);
      $input.css({ fontSize: increase ? fontSize + 1 : fontSize - 1 });
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

    $element.css(styles[textType]);
    return $element;
  }

  function createSignature({ value, unique_key, onDelete }) {
    // prettier-ignore
    const html = `
    <div class="fillAndSign__signatureContainer">
      <img class="fillAndSign__signatureDraw" data-key=${unique_key || Date.now()} src="${value}"/>
      <div class="fillAndSign__signatureClose"><i class="fa fa-times"></i></div>
    </div>
    `;

    const $element = createElementFromHTML(html);

    $close = $element.find(".fillAndSign__signatureClose");
    $close.on("click", onDelete);

    return $element;
  }

  async function storeField(position, $element) {
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
    const key = $field.data("key");
    const value = $field.text().trim();
    const documentPage = $parent.data("page");
    const textType = $root.data("text-type");

    const payload = {
      coordinates: position,
      document_page: documentPage,
      document_id: documentId,
      unique_key: key,
      text_type: textType,
      value,
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

      const $page = await getPage({ page: index, document });

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
            storeField(ui.position, $(ui.helper));
          },
        });

        return $item;
      });

      const $signatures = currentSignatures.map((signature) => {
        const { coordinates, unique_key, value } = signature;
        const { top, left } = JSON.parse(coordinates);

        $item = createSignature({
          value,
          unique_key,
          onDelete: onDeleteSignature,
        });

        $item.css({
          position: "absolute",
          top: `${top}px`,
          left: `${left}px`,
        });

        $item.draggable({
          containment: ".ui-droppable",
          appendTo: ".ui-droppable",
          stop: (_, ui) => {
            storeSignature(ui.position, $(ui.helper));
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

          storeField(ui.position, $item);
          $item.draggable({
            containment: ".ui-droppable",
            appendTo: ".ui-droppable",
            stop: (_, ui) => storeField(ui.position, $(ui.helper)),
          });
        },
      });

      $documentContainer.append($page);
    }
  }

  async function storeSignature(position, $element) {
    if (isStoring) {
      return;
    }

    isStoring = true;

    if (!$element.hasClass("fillAndSign__signatureDraw")) {
      $element = $element.find(".fillAndSign__signatureDraw");
    }

    const $parent = $element.closest(".fillAndSign__canvasContainer");
    const value = $element.attr("src");
    const documentPage = $parent.data("page");
    const uniqueKey = $element.data("key");

    const payload = {
      coordinates: position,
      document_page: documentPage,
      document_id: documentId,
      value,
      unique_key: uniqueKey,
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

  async function onDeleteSignature(event) {
    const $parent = $(event.target).closest(".ui-draggable");
    const $signature = $parent.find(".fillAndSign__signatureDraw");
    const uniqueKey = $signature.data("key");

    const endpoint = `${prefixURL}/FillAndSign/deleteSignature/${uniqueKey}`;
    await fetch(endpoint, { method: "DELETE" });

    $parent.remove();
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

    $signatureModalCloseButton.on("click", () => {
      $signatureModal.hide();
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

    $signatureApplyButton.on("click", async () => {
      const $activeTab = $(".tab-pane.active");
      const signatureType = $activeTab.data("signature-type");

      let $element = null;
      let signatureDataUrl = null;
      const canvas = $signaturePadCanvas.get(0);

      if (signatureType === "type") {
        const $input = $(".fillAndSign__signatureInput");
        const signature = $input.val();

        if (isEmptyOrSpaces(signature)) {
          return;
        }

        const clonedCanvas = cloneCanvas(canvas);
        const context = clonedCanvas.getContext("2d");
        context.font = "bold 100px Southam";
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

      $element = createSignature({
        value: signatureDataUrl,
        onDelete: onDeleteSignature,
      });

      $(".ui-droppable").append($element);
      const position = { top: 0, left: 0 };
      $element.css({ position: "absolute", ...position });
      $element.draggable({
        containment: ".ui-droppable",
        appendTo: ".ui-droppable",
        stop: (_, ui) => storeSignature(ui.position, $(ui.helper)),
      });

      await storeSignature(position, $element);
      $signatureModal.hide();
    });

    $copyLink.on("click", async (event) => {
      event.preventDefault();

      const pdfDoc = await generatePDF(documentId);
      const formData = new FormData();
      formData.append("document", pdfDoc.output("blob"));

      const endpoint = `${prefixURL}/FillAndSign/createLink/${documentId}`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: {
          accepts: "application/json",
        },
      });

      const { link } = await response.json();
      const documentLink = `${window.location.origin}${prefixURL}/uploads/fillandsign/out/${link.hash}.pdf`;
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

      const pdfDoc = await generatePDF(documentId);
      const formData = new FormData();
      formData.append("document", pdfDoc.output("blob"));

      const endpoint = `${prefixURL}/FillAndSign/createLink/${documentId}`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: {
          accepts: "application/json",
        },
      });

      const { link } = await response.json();
      const documentLink = `${window.location.origin}${prefixURL}/uploads/fillandsign/out/${link.hash}.pdf`;
      $container.addClass("fillAndSign--readonly");
      downloadURI(documentLink);
    });
  }

  async function fetchDocument() {
    const endpoint = `${prefixURL}/FillAndSign/get/${documentId}`;
    const response = await fetch(endpoint, {
      headers: {
        accepts: "application/json",
      },
    });

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

    await fetchDocument();
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
        const { coordinates, textType, value } = field;

        const fontStyle = {
          initial: "",
          bold: "bold",
          italic: "italic",
          underline: "",
          strikethrough: "",
        };

        // manual adjustments in px to position correctly :D
        const adjustments = { top: 20, left: 8 };

        const coords = JSON.parse(coordinates);
        const x = coords.left + adjustments.left;
        const y = coords.top + adjustments.top;
        const color = "black";

        context.font = `${fontStyle[textType]} 14px monospace`;
        context.fillStyle = color;
        context.fillText(value, x, y);

        const underlineParams = {
          x,
          y,
          color,
          context,
          text: value,
          textSize: 14,
        };

        if (textType === "underline") {
          textUnderline(underlineParams);
        } else if (textType === "strikethrough") {
          textUnderline({ ...underlineParams, strikethrough: true });
        }
      });

      currentSignatures.forEach((signature) => {
        const { top, left } = JSON.parse(signature.coordinates);
        const image = new Image();
        image.src = signature.value;
        context.drawImage(image, left, top);
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
    const step = new Step2(documentId);
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
    startY = y - 3; // adjust if needed :D
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

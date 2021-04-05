function Signing(hash) {
  const $documentContainer = $(".signing__documentContainer");

  const $signatureModal = $("#signatureModal");

  const $signaturePad = $(".signing__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");

  const $fontSelect = $("#fontSelect");
  const $signatureTextInput = $(".signing__signatureInput");

  const $finishSigning = $("[data-action=finish]");

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  let data = null;
  let signaturePad = null;

  async function fetchData() {
    const endpoint = `${prefixURL}/DocuSign/apiSigning?hash=${hash}`;
    const response = await fetch(endpoint);
    data = await response.json();
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

  async function getPage({ page, ...rest }) {
    const html = `
      <div class="signing__documentPage" data-page="${page}">
        <canvas></canvas>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  async function renderPDF() {
    const { document: documentData, fields, recipient } = data;
    const { name: filename } = documentData;

    const documentUrl = `${prefixURL}/uploads/DocFiles/${filename}`;
    const document = await PDFJS.getDocument({ url: documentUrl });

    for (let index = 1; index <= document.numPages; index++) {
      const currentFields = fields.filter(({ doc_page }) => doc_page == index);
      const params = { page: index, document };

      const $page = await getPage(params);
      $documentContainer.append($page);

      const canvas = $page.find("canvas").get(0);
      const context = canvas.getContext("2d");

      const $fields = currentFields.map((field, fieldIndex) => {
        const { field_name, coordinates, id: fieldId, value: fieldValue } = field; // prettier-ignore
        let text = recipient[field_name.toLowerCase()];
        const { top, left } = JSON.parse(coordinates);

        if (field_name === "Date Signed") {
          text = moment().format("MM/DD/YYYY");
          const html = `<span class="d-none" data-field-type="dateSigned" data-field-id="${fieldId}">${text}</span>`;
          const $element = createElementFromHTML(html);
          $page.append($element);
        }

        if (["Approve", "Decline"].includes(field_name)) {
          const html = `<button class="btn btn-secondary btn-sm docusignField">${field_name}</button>`;
          const $element = createElementFromHTML(html);
          $element.css({ top, left, position: "absolute" });
          return $element;
        }

        if (field_name === "Attachment") {
          const { value } = fieldValue || { value: null };

          const html = `
            <div class="signing__fieldAttachment docusignField" title="Attachment" data-field-type="attachment">
              <input type="file" />
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"/>
              </svg>
            </div>
          `;

          const $element = createElementFromHTML(html);
          $element.css({ top, left, position: "absolute" });

          if (value) {
            $element.find("input").addClass("d-none");
            $element.attr("data-value", `${prefixURL}/uploads/docusign/${value}`); // prettier-ignore
          }

          const $input = $element.find("input");
          $input.on("change", async function () {
            const [file] = this.files;
            const ONE_MB = 1048576;

            if (file.size > ONE_MB * 8) {
              alert("Maximum file size is less than 8MB");
              return;
            }

            const { data } = await storeFieldValue({
              id: fieldId,
              value: this.files[0],
            });

            $(this).addClass("d-none");
            $element.attr("data-value", `${prefixURL}/uploads/docusign/${data.value}`); // prettier-ignore
            $element.attr("title", $(this).val());
          });

          $element.on("click", function () {
            const filepath = $(this).attr("data-value");
            if (filepath) {
              window.open(filepath, "_blank").focus();
            }
          });

          return $element;
        }

        if (field_name === "Signature") {
          const { value } = fieldValue || { value: null };

          let html = `
            <div class="signing__fieldSignature docusignField" title="Signature" data-field-type="signature" id="signature${fieldId}">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                <path fill="currentColor" d="M623.2 192c-51.8 3.5-125.7 54.7-163.1 71.5-29.1 13.1-54.2 24.4-76.1 24.4-22.6 0-26-16.2-21.3-51.9 1.1-8 11.7-79.2-42.7-76.1-25.1 1.5-64.3 24.8-169.5 126L192 182.2c30.4-75.9-53.2-151.5-129.7-102.8L7.4 116.3C0 121-2.2 130.9 2.5 138.4l17.2 27c4.7 7.5 14.6 9.7 22.1 4.9l58-38.9c18.4-11.7 40.7 7.2 32.7 27.1L34.3 404.1C27.5 421 37 448 64 448c8.3 0 16.5-3.2 22.6-9.4 42.2-42.2 154.7-150.7 211.2-195.8-2.2 28.5-2.1 58.9 20.6 83.8 15.3 16.8 37.3 25.3 65.5 25.3 35.6 0 68-14.6 102.3-30 33-14.8 99-62.6 138.4-65.8 8.5-.7 15.2-7.3 15.2-15.8v-32.1c.2-9.1-7.5-16.8-16.6-16.2z"/>
              </svg>
            </div>
          `;

          const $element = createElementFromHTML(html);

          if (value) {
            const valueHtml = `
              <div class="fillAndSign__signatureContainer">
                <img class="fillAndSign__signatureDraw" src="${value}"/>
              </div>
            `;

            $element.html(createElementFromHTML(valueHtml));
          }

          $element.css({ top, left, position: "absolute" });
          $element.on("click", () => {
            signaturePad.clear();
            $(".signing__signatureInput").val("");

            $signatureModal.attr("data-field-id", fieldId);
            $signatureModal.modal("show");
          });
          return $element;
        }

        if (field_name === "Checkbox") {
          const { options = [] } = JSON.parse(field.specs) || {};
          let { value: selected } = fieldValue || { value: null };
          selected = JSON.parse(selected) || [];

          const html = `<div class="docusignField"></div>`;
          const $element = createElementFromHTML(html);
          $element.append(
            options.map((option) => {
              const id = guidGenerator();
              const isSelected = selected.includes(option);

              // prettier-ignore
              return `
                <div class="form-check" title="${option}">
                  <span class="form-check-indicator">x</span>
                  <input class="form-check-input" type="checkbox" value="${option}" id="${id}" ${isSelected ? "checked" : ""}>
                  <label class="form-check-label invisible" for="${id}">
                    ${option}
                  </label>
                </div>
              `;
            })
          );

          $element.find("input:checkbox").on("change", function () {
            const values = [];
            $element.find("input:checkbox:checked").each(function () {
              values.push($(this).val());
            });

            const value = JSON.stringify(values);
            storeFieldValue({ value, id: fieldId });
          });

          $element.css({ top, left, position: "absolute" });
          return $element;
        }

        if (field_name === "Radio") {
          const { options = [] } = JSON.parse(field.specs) || {};
          const { value: selected } = fieldValue || { value: null };

          const html = `<div class="docusignField"></div>`;
          const $element = createElementFromHTML(html);
          $element.append(
            options.map((option) => {
              const id = guidGenerator();
              const isSelected = selected === option;

              // prettier-ignore
              return `
                <div class="form-check" title="${option}">
                  <span class="form-check-indicator">x</span>
                  <input class="form-check-input" type="radio" value="${option}" name="radio-${fieldIndex}" id="${id}" ${isSelected ? "checked" : ""}>
                  <label class="form-check-label invisible" for="${id}">
                    ${option}
                  </label>
                </div>
              `;
            })
          );

          $element.find("input:radio").on("change", function () {
            const $selected = $element.find("input:radio:checked");
            storeFieldValue({ value: $selected.val(), id: fieldId });
          });

          $element.css({ top, left, position: "absolute" });
          return $element;
        }

        if (field_name === "Dropdown") {
          const { options = [], selected: defaultValue } = JSON.parse(field.specs) || {}; // prettier-ignore
          const { value: selected } = fieldValue || { value: defaultValue };

          const optionsArray = options.map((option) => {
            const isSelected = selected === option;
            return `
              <option value="${option}" ${isSelected ? "selected" : ""}>
                ${option}
              </option>
            `;
          });

          if (!optionsArray.length) {
            return "";
          }

          const html = `
            <select class="docusignField">
              ${optionsArray.join("")}
            </select>
          `;

          const $element = createElementFromHTML(html);
          $element.on("change", function () {
            storeFieldValue({ value: this.value, id: fieldId });
          });

          $element.css({ top, left, position: "absolute" });
          return $element;
        }

        if (field_name === "Text" || text === undefined) {
          const { value } = fieldValue || { value: "" };
          const html = `
            <div class="docusignField" style="position: relative; display: flex; align-items: center;">
              <input type="text" placeholder="${field_name}" value="${value}" />
              <div class="spinner-border spinner-border-sm d-none" role="status" style="position: absolute; right: 4px;">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          `;

          const $element = createElementFromHTML(html);

          let typingTimer;
          let doneTypingInterval = 1000;
          const doneTyping = async (input) => {
            const $input = $(input);
            const $spinner = $input.next(".spinner-border");

            $input.attr("readonly", true);
            $spinner.removeClass("d-none");

            const value = $input.val().trim();
            await storeFieldValue({ value, id: fieldId });

            $input.attr("readonly", false);
            $spinner.addClass("d-none");
          };

          $element.find("input").keyup(function () {
            clearTimeout(typingTimer);
            if ($(this).val()) {
              typingTimer = setTimeout(
                () => doneTyping(this),
                doneTypingInterval
              );
            }
          });

          $element.css({ top, left, position: "absolute" });
          return $element;
        }

        context.font = "12px monospace";
        context.fillText(text, left, top);
      });

      $page.append($fields);
    }
  }

  async function storeFieldValue({ id, value }) {
    const { recipient } = data;
    const { id: recipient_id } = recipient;

    if (value instanceof File) {
      const formData = new FormData();
      formData.append("attachment", value);
      formData.append("recipient_id", recipient_id);
      formData.append("field_id", id);

      const endpoint = `${prefixURL}/DocuSign/apiUploadAttachment`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: {
          accepts: "application/json",
        },
      });

      return response.json();
    }

    const payload = {
      recipient_id,
      field_id: id,
      value,
    };

    const response = await fetch(`${prefixURL}/DocuSign/apiStoreFieldValue`, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    return response.json();
  }

  function attachEventHandlers() {
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

      const fieldId = $signatureModal.attr("data-field-id");
      await storeFieldValue({ id: fieldId, value: signatureDataUrl });

      const html = `
        <div class="fillAndSign__signatureContainer">
          <img class="fillAndSign__signatureDraw" src="${signatureDataUrl}"/>
        </div>
      `;

      $element = createElementFromHTML(html);
      $(`#signature${fieldId}`).html($element);

      $signatureModal.modal("hide");

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
    });

    $signatureModal.on("hidden.bs.modal", function () {
      $(this).removeAttr("data-field-id");
    });

    $finishSigning.on("click", async function () {
      const $fields = $(".docusignField");
      const fields = [...$fields];

      for (let index = 0; index < fields.length; index++) {
        const $element = $(fields[index]);
        const $input = $element.find("input");
        const fieldType = $element.attr("data-field-type");

        const scrollToElement = () => {
          const className = "docusignField--focused";
          $(`.${className}`).removeClass(className);
          $element.addClass(className);

          $("html, body").animate({
            scrollTop: parseInt($element.offset().top - 100),
          });
        };

        if (
          fieldType === "signature" &&
          !$element.find(".fillAndSign__signatureContainer").length
        ) {
          // no signature yet
          scrollToElement();
          return;
        }

        if (fieldType === "attachment" && !$input.hasClass("d-none")) {
          // empty attachment
          scrollToElement();
          return;
        }

        if ($input.is("input:text") && isEmptyOrSpaces($input.val())) {
          $input.focus();
          scrollToElement();
          return;
        }

        const hasCheckbox = $input.is("input:checkbox");
        const hasRadio = $input.is("input:radio");

        if (hasCheckbox || hasRadio) {
          const checkboxSelected = $element.find("input:checkbox:checked");
          const radioSelected = $element.find("input:radio:checked");

          if (!checkboxSelected.length && !radioSelected.length) {
            // no checkbox selected
            scrollToElement();
            return;
          }
        }
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const $dateSigned = $("[data-field-type=dateSigned]");
      const promises = [...$dateSigned].map((dateSigned) => {
        const $element = $(dateSigned);
        const fieldId = $element.attr("data-field-id");
        const value = $element.text().trim();
        return storeFieldValue({ id: fieldId, value });
      });

      // stores datesigned fields
      await Promise.all(promises);

      const response = await fetch(`${prefixURL}/DocuSign/apiComplete`, {
        method: "POST",
        body: JSON.stringify({ hash }),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });

      const json = await response.json();
      console.log(json);

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
      markAsFinished();
    });
  }

  function markAsFinished() {
    $(".signing").addClass("signing--finished");
    $(".signing__fieldSignature").off();

    const $fields = $(".docusignField");
    [...$fields].forEach((field) => {
      const $input = $(field).find("input");

      [$(field), $input].forEach(($element) => {
        $element.prop("readonly", true);
        $element.prop("disabled", true);
        $element.css({
          color: "initial",
          backgroundColor: "initial",
          opacity: 1,
        });
      });
    });
  }

  async function init() {
    signaturePad = new SignaturePad($signaturePadCanvas.get(0));

    await fetchData();
    await renderPDF();
    attachEventHandlers();

    $(".loader").addClass("d-none");
    if (data.recipient.completed_at) markAsFinished();

    // requires assets/js/esign/docusign/input.autoresize.js
    $("input:text").autoresize({ minWidth: 150 });
  }

  return { init };
}

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  const hash = urlParams.get("hash");

  if (hash) {
    new Signing(hash).init();
  }
});

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
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

// https://stackoverflow.com/a/6860916/8062659
function guidGenerator() {
  var S4 = function () {
    return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
  };
  return (
    S4() +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    S4() +
    S4()
  );
}

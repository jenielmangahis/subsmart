// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

function Step3() {
  let fields = [];

  const $form = $("[data-form-step=3]");
  const $formSubmit = $("#submitBUtton");

  const $docRenderer = $("#main-pdf-render");
  const $docPreviewRenderer = $("#main-pdf-render-preview");
  const $fields = $(".fields");

  const $recipientSelect = $(".esignBuilder__recipientSelect");
  const $optionsSidebar = $(".esignBuilder__optionsSidebar");

  let fileId = undefined;
  let documentUrl = undefined;
  let isTemplate = undefined;
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
      <div id="pdf-render-${page}" class="docPage" data-page="${page}">
        <canvas class="document-page"></canvas>
      </div>
    `;
    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  async function getPagePreview({ page, ...rest }) {
    const html = `
      <div class="documentPage">
        <canvas class="document-page-preview" id="pdf-render-${page}-preview" style="width: 100%;" ></canvas>
        <div class="bar-action"></div>
        <div class="column-indicators"></div>
        <span class="pageNumber">Page ${page}</span>
      </div>
    `;
    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });

    $element.on("click", () => {
      $docRenderer.animate({ scrollTop: rest.offsetTop });
    });

    return $element;
  }

  async function storeField(position, $element, specs = null) {
    if (!$element.hasClass("esignBuilder__field")) {
      $element = $element.closest(".esignBuilder__field");
    }

    let docPage = undefined;
    let docId = undefined;

    const elementYTop = $element.get(0).offsetTop;

    const $pages = [...$docRenderer.find(".docPage")];
    for (let index = 0; index < $pages.length; index++) {
      const $docPage = $($pages[index]);
      const docPageHeight = $docPage.height();
      const docPageYBottom = $docPage.get(0).offsetTop + docPageHeight;

      if (elementYTop <= docPageYBottom) {
        position.pageTop = elementYTop - (docPageYBottom - docPageHeight);
        docPage = parseInt($docPage.attr("data-page"));
        break;
      }
    }

    const $documents = [...$docRenderer.find(".docPageContainer")];
    for (let index = 0; index < $documents.length; index++) {
      const $document = $($documents[index]);
      const docHeight = $document.height();
      const docYBottom = $document.get(0).offsetTop + docHeight;

      if (elementYTop <= docYBottom) {
        docId = parseInt($document.attr("data-document-id"));
        break;
      }
    }

    const key = $element.find(".subData").data("key");
    const recipientId = $("#recipientsSelect").get(0).dataset.recipientId;

    const fieldName = $element.text().trim();

    if (fieldName === "Text") {
      specs = { ...specs, width: parseInt($element.css("width"), 10) };
    }

    const payload = {
      coordinates: position,
      docfile_id: fileId,
      doc_page: docPage,
      doc_id: docId,
      unique_key: key,
      field: fieldName,
      recipient_id: recipientId,
      specs,
    };

    let endpoint = `${prefixURL}/esign/apiCreateUserDocfileFields`;
    if (isTemplate) {
      endpoint = `${prefixURL}/DocuSign/apiCreateTemplateFields`;
      payload.template_id = fileId;
    }

    const response = await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const { record = null, is_created } = await response.json();

    if (is_created && record) {
      fields.push(record);
    } else {
      // updates local fields
      fields = fields.map((field) =>
        field.unique_key != key ? field : record
      );
    }
  }

  async function getFields() {
    let endpoint = `${prefixURL}/esign/apiGetUserDocfileFields/${fileId}`;
    if (isTemplate) {
      endpoint = `${prefixURL}/DocuSign/apiGetTemplateFields/${fileId}`;
    }

    const response = await fetch(endpoint);
    const data = await response.json();
    fields = data.fields;
  }

  function showFieldSidebar(field) {
    const { field_name, specs: fieldSpecs } = field;
    const specs = JSON.parse(fieldSpecs || null) || {};

    const $fieldId = $optionsSidebar.find(".esignBuilder__optionsSidebarFieldId span"); // prettier-ignore
    const $formulaInput = $optionsSidebar.find("#formulaInput");
    const $noteInput = $optionsSidebar.find("#noteInput");
    const $optionInputs = $optionsSidebar.find(".esignBuilder__optionInput");
    const $fieldNameInput = $optionsSidebar.find("#textFieldName");

    $fieldId.html("");
    $fieldId.html(field.unique_key);

    $formulaInput.val("");
    $noteInput.val("");
    $optionInputs.remove();
    $fieldNameInput.val("");

    const fieldTypeWithOptions = ["Checkbox", "Dropdown", "Radio"];
    let fieldType = "field";

    if (field_name === "Formula") {
      fieldType = "formula";
      $formulaInput.val(specs.formula || "");
    } else if (field_name === "Note") {
      fieldType = "note";
      $noteInput.val(specs.note || "");
    } else if (fieldTypeWithOptions.includes(field_name)) {
      fieldType = "options";
      const { options = [] } = specs;
      if (options.length) {
        const $inputs = options.map((value) => createDropdownInput({ value })); // prettier-ignore
        $optionsSidebar.append($inputs);
      }
    } else if (field_name === "Text") {
      fieldType = "text";
      $("#requiredText").prop("checked", false);
      $("#readOnlyText").prop("checked", false);
      $("#requiredText").prop("checked", specs.is_required);
      $("#readOnlyText").prop("checked", specs.is_read_only);
      $("#textFieldName").prop("checked", specs.is_read_only);
      $fieldNameInput.val(specs.name ? specs.name : "");
    }

    $optionsSidebar.attr("data-field-type", fieldType);
    $optionsSidebar.addClass("esignBuilder__optionsSidebar--show");
  }

  function hideFieldSidebar() {
    const optionsSidebarActiveClass = "esignBuilder__optionsSidebar--show";
    const fieldActiveClass = "esignBuilder__field--active";

    $optionsSidebar.find(".esignBuilder__optionInput").remove();
    $(`.${fieldActiveClass}`).removeClass(fieldActiveClass);
    $optionsSidebar.removeClass(optionsSidebarActiveClass);
  }

  function createField(field) {
    const { coordinates: coords, unique_key, field_name = "", color } = field;
    const coordinates = JSON.parse(coords);
    const top = parseInt(coordinates.top, 10);
    const left = parseInt(coordinates.left, 10);
    const specs = field.specs ? JSON.parse(field.specs) : {};

    const fieldName = field_name.trim();
    const uniqueKey = unique_key || Date.now();
    field.field_name = fieldName;
    field.unique_key = uniqueKey;

    const rgba = hexToRGB(color, specs.is_required ? 0.7 : 0.3);

    const html = `
      <div
        class="menu_item ui-draggable ui-draggable-handle ui-draggable-dragging esignBuilder__field"
        style="left: ${left}px; top: ${top}px; --color: ${rgba}"
      >
        <div class="subData">
          <span>${fieldName}</span>
        </div>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const $subData = $element.find(".subData");

    if (fieldName === "Checkbox") {
      $element.css({ minWidth: "unset" });
      $subData.addClass("esignBuilder__fieldCheckbox");
    }

    if (fieldName === "Radio") {
      $element.css({ minWidth: "unset" });
      $subData.addClass("esignBuilder__fieldRadio");
    }

    $subData.css({ border: `2px solid ${color}` });
    $subData.attr("data-key", uniqueKey);

    const activeClass = "esignBuilder__field--active";
    const hasOption = true;

    if (fieldName === "Text") {
      let { specs } = field;
      specs = specs ? JSON.parse(specs) : { width: "initial" };
      $element.css({ width: specs.width });

      $element.resizable({
        handles: "e",
        stop: (_, ui) => storeField(ui.position, $(ui.helper)),
      });
    }

    $subData.on("click", function () {
      const $prevActive = $(`.${activeClass}`);
      const dataKey = $(this).data("key");
      const currField = fields.find(({ unique_key }) => unique_key == dataKey);

      $prevActive.removeClass(activeClass);
      $(this).addClass(activeClass);

      if (!hasOption || !currField) {
        hideFieldSidebar();
        return;
      }

      showFieldSidebar(currField);
    });

    if (!field.isNew) {
      return $element;
    }

    if (hasOption) {
      $element.addClass(activeClass);
      showFieldSidebar(field);
    } else {
      hideFieldSidebar();
    }

    return $element;
  }

  async function renderPDF(data = null) {
    if (data) {
      const { id, path } = data;
      const url = `${prefixURL}/${path.replace(/^\//, "")}`;

      const document = await PDFJS.getDocument({ url });
      const $container = createElementFromHTML("<div></div>");
      $container.addClass("docPageContainer");
      $container.attr("data-document-id", id);

      for (let index = 1; index <= document.numPages; index++) {
        const params = { page: index, document };
        const $page = await getPage(params);
        $container.append($page);

        const { top: offsetTop } = $page.offset();
        const $pagePreview = await getPagePreview({ ...params, offsetTop });
        $docPreviewRenderer.append($pagePreview);
      }

      $docRenderer.append($container);
      //
    } else {
      const document = await PDFJS.getDocument({ url: documentUrl });
      for (let index = 1; index <= document.numPages; index++) {
        const params = { page: index, document };
        const $page = await getPage(params);
        $docRenderer.append($page);

        const { top: offsetTop } = $page.offset();
        const $pagePreview = await getPagePreview({ ...params, offsetTop });
        $docPreviewRenderer.append($pagePreview);
      }
    }
  }

  function createDropdownInput({ value = null }) {
    const html = `
        <div class="esignBuilder__optionInput">
            <input class="form-control">
            <button type="button" class="btn esignBuilder__dropdownClose" tabindex="-1">
              <i class="fa fa-times"></i>
            </button>
        </div>
      `;

    const $element = createElementFromHTML(html);
    $element.find("input").val(value);

    const $close = $element.find(".esignBuilder__dropdownClose");

    $close.on("click", function () {
      $(this).parent().remove();
    });

    return $element;
  }

  function attachEventHandlers() {
    const $pdfFields = fields.map(createField);
    $docRenderer.append($pdfFields);

    const getRecipientColor = () => {
      return getComputedStyle($form.get(0)).getPropertyValue("--color"); // prettier-ignore
    };

    $($pdfFields).draggable({
      containment: $docRenderer,
      appendTo: $docRenderer,
      stop: (_, ui) => storeField(ui.position, $(ui.helper)),
    });

    $fields.draggable({
      containment: $docRenderer,
      appendTo: $docRenderer,
      helper: "clone",
      revert: "invalid",
      start: function (_, ui) {
        const $element = $(ui.helper);
        const color = getRecipientColor();
        $element.css({
          backgroundColor: hexToRGB(color, 0.5),
          border: `2px solid ${color}`,
        });
      },
    });

    $docRenderer.droppable({
      accept: ".fields",
      drop: function (_, ui) {
        const $item = $(ui.helper).clone();
        const color = getRecipientColor();
        $element = createField({
          coordinates: JSON.stringify(ui.position),
          field_name: $item.text(),
          color,
          isNew: true,
        });

        $(this).append($element);
        storeField(ui.position, $element);

        $element.draggable({
          containment: this,
          appendTo: this,
          stop: (_, ui) => storeField(ui.position, $(ui.helper)),
        });
      },
    });

    if (isTemplate) {
      $formSubmit.text("Save Template");
    }

    const setColor = (color) => {
      $form.get(0).style.setProperty("--color", color);
    };

    const $selectedRecipient = $recipientSelect.find("#recipientsSelect");
    const currColor = $selectedRecipient.data("recipient-color");
    setColor(currColor);

    $recipientSelect.find(".dropdown-item").on("click", function (event) {
      event.preventDefault();
      const $target = $(event.target);
      const color = $target.data("recipient-color");
      const id = $target.data("recipient-id");

      setColor(color);
      $selectedRecipient.attr("data-recipient-id", id);
      $selectedRecipient.find("span").text($target.text().trim());
    });

    $formSubmit.on("click", async function (event) {
      event.preventDefault();

      if (isTemplate) {
        window.location = `${prefixURL}/vault/mylibrary`;
        return;
      }

      const $button = $(this);
      const $loader = $button.find(".spinner-border");

      $loader.removeClass("d-none");
      $button.attr("disabled", true);

      const endpoint = `${prefixURL}/DocuSign/send`;
      const response = await fetch(endpoint, {
        method: "POST",
        body: JSON.stringify({ document_id: fileId }),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });

      const data = await response.json();
      $loader.addClass("d-none");
      $button.removeAttr("disabled");
      window.location = `${prefixURL}/DocuSign/manage?view=sent`;
    });

    const $addOption = $optionsSidebar.find("#addOption");
    $addOption.on("click", function () {
      const $element = createDropdownInput({ value: "" });
      $optionsSidebar.append($element);
      $element.find("input").focus();
    });

    const $saveOption = $optionsSidebar.find("#saveOption");
    $saveOption.on("click", async function () {
      let specs = null;
      const fieldType = $optionsSidebar.attr("data-field-type");
      const $formulaInput = $optionsSidebar.find("#formulaInput");
      const $noteInput = $optionsSidebar.find("#noteInput");
      const $optionInputs = $optionsSidebar.find(".esignBuilder__optionInput input"); // prettier-ignore

      if (fieldType === "formula") {
        specs = { formula: $formulaInput.val() };
      } else if (fieldType === "note") {
        specs = { note: $noteInput.val() };
      } else if (fieldType === "text") {
        const fieldName = $("#textFieldName").val().trim();
        specs = {
          is_required: $("#requiredText").is(":checked"),
          is_read_only: $("#readOnlyText").is(":checked"),
          name: !isEmpty(fieldName) ? fieldName : null,
        };
      } else {
        if (!$optionInputs.length) {
          return;
        }

        const values = [];
        $optionInputs.each(function (_, input) {
          values.push($(input).val());
        });

        if (values.some(isEmpty)) {
          alert("Option must not be empty.");
          return;
        }

        specs = {
          options: values,
          selected: null,
          // selected: values[0],
        };
      }

      const $element = $(".esignBuilder__field--active");
      const $parent = $element.closest(".esignBuilder__field");

      const top = $parent.css("top");
      const left = $parent.css("left");
      const position = { top, left };

      if (specs && specs.hasOwnProperty("is_required")) {
        const key = $parent.find(".subData").data("key");
        const { color } = fields.find((f) => f.unique_key == key);
        const rgba = hexToRGB(color, specs.is_required ? 0.7 : 0.3);
        $parent.get(0).style.setProperty("--color", rgba);
      }

      const $button = $(this);
      const $loader = $button.find(".spinner-border");

      $loader.removeClass("d-none");
      $button.attr("disabled", true);

      await storeField(position, $element, specs);
      $optionsSidebar.removeClass("esignBuilder__optionsSidebar--show");
      $optionsSidebar.find(".esignBuilder__optionInput").remove();
      $element.removeClass("esignBuilder__field--active");

      $loader.addClass("d-none");
      $button.removeAttr("disabled");
    });

    const $closeOption = $optionsSidebar.find("#closeOption");
    $closeOption.on("click", hideFieldSidebar);

    const $deleteOption = $optionsSidebar.find("#deleteOption");
    $deleteOption.on("click", async function () {
      const $active = $(".esignBuilder__field--active");

      const $parent = $active.closest(".ui-draggable");
      let uniqueKey = $active.attr("data-key");
      if (!uniqueKey) {
        uniqueKey = $active.find(".subData").attr("data-key");
      }

      const $button = $(this);
      const $loader = $button.find(".spinner-border");

      $loader.removeClass("d-none");
      $button.attr("disabled", true);

      let endpoint = `${prefixURL}/esign/apiDeleteDocfileField/${uniqueKey}`;
      if (isTemplate) {
        endpoint = `${prefixURL}/DocuSign/apiDeleteTemplateField/${uniqueKey}`;
      }

      await fetch(endpoint, { method: "DELETE" });

      $loader.addClass("d-none");
      $button.removeAttr("disabled");

      $parent.remove();
      hideFieldSidebar();
    });

    $form.on("submit", function (event) {
      event.preventDefault();
    });

    $("body").on("click", function (event) {
      const $target = $(event.target);

      if ($target.hasClass("esignBuilder__field")) {
        return;
      }

      if ($target.closest(".esignBuilder__field").length) {
        return;
      }

      if ($target.closest(".esignBuilder__optionsSidebar").length) {
        return;
      }

      $(".esignBuilder__optionsSidebar--show")
        .removeClass("esignBuilder__optionsSidebar--show"); // prettier-ignore

      $(".esignBuilder__field--active")
        .removeClass("esignBuilder__field--active"); // prettier-ignore
    });
  }

  async function getTemplateFile(id) {
    const endpoint = `${prefixURL}/DocuSign/apiTemplateFile/${id}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    return data;
  }

  async function init() {
    const urlParams = new URLSearchParams(window.location.search);
    const templateId = urlParams.get("template_id");
    isTemplate = Boolean(templateId);

    fileId = parseInt($("[name=file_id]").val());
    fileId = isTemplate ? templateId : fileId;

    documentUrl = $form.data("doc-url");
    if (!isTemplate) {
      await getFields();
      await renderPDF();
      attachEventHandlers();

      $(".esignBuilder--loading").removeClass("esignBuilder--loading");
      return;
    }

    const { data } = await getTemplateFile(templateId);
    await getFields();

    for (let index = 0; index < data.length; index++) {
      try {
        await renderPDF(data[index]);
      } catch (error) {
        console.log(error);
        continue;
      }

      if (index === 1) {
        $(".esignBuilder--loading").removeClass("esignBuilder--loading");
      }
    }

    attachEventHandlers();
    $(".esignBuilder--loading").removeClass("esignBuilder--loading");
  }

  return { init };
}

$(document).ready(function () {
  const $form = $("[data-form-step=3]");
  if ($form.length === 1) {
    const step = new Step3();
    step.init();
  }
});

// https://stackoverflow.com/a/3261380/8062659
function isEmpty(str) {
  return !str || 0 === str.length;
}

// https://stackoverflow.com/a/44550181/8062659
function hexToRGB(hex, alpha) {
  if (!hex || [4, 7].indexOf(hex.length) === -1) {
    return; // throw new Error('Bad Hex');
  }

  hex = hex.substr(1);
  // if shortcuts (#F00) -> set to normal (#FF0000)
  if (hex.length === 3) {
    hex = hex
      .split("")
      .map(function (el) {
        return el + el + "";
      })
      .join("");
  }

  var r = parseInt(hex.slice(0, 2), 16),
    g = parseInt(hex.slice(2, 4), 16),
    b = parseInt(hex.slice(4, 6), 16);

  if (alpha !== undefined) {
    return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
  } else {
    return "rgb(" + r + ", " + g + ", " + b + ")";
  }
}

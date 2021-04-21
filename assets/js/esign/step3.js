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

    const payload = {
      coordinates: position,
      docfile_id: fileId,
      doc_page: docPage,
      doc_id: docId,
      unique_key: key,
      field: $element.text().trim(),
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

    $fieldId.html("");
    $fieldId.html(field.unique_key);

    $formulaInput.val("");
    $noteInput.val("");
    $optionInputs.remove();

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

    const fieldName = field_name.trim();
    const uniqueKey = unique_key || Date.now();
    field.field_name = fieldName;
    field.unique_key = uniqueKey;

    const html = `
      <div
        class="menu_item ui-draggable ui-draggable-handle ui-draggable-dragging esignBuilder__field"
        style="left: ${left}px; top: ${top}px; --color: ${color}"
      >
        <div class="subData" data-key="${uniqueKey}">${fieldName}</div>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const activeClass = "esignBuilder__field--active";

    const fieldsWithOption = [
      "Dropdown",
      "Checkbox",
      "Radio",
      "Formula",
      "Note",
    ];
    // const hasOption = fieldsWithOption.includes(fieldName);
    const hasOption = true;

    $element.find(".subData").on("click", function () {
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
      const url = `${prefixURL}/${path}`;

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
    });

    $docRenderer.droppable({
      accept: ".fields",
      drop: function (_, ui) {
        const $item = $(ui.helper).clone();
        const color = getComputedStyle($form.get(0)).getPropertyValue("--color"); // prettier-ignore
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
      const $optionInputs = $optionsSidebar.find("input");

      if (fieldType === "formula") {
        specs = { formula: $formulaInput.val() };
      } else if (fieldType === "note") {
        specs = { note: $noteInput.val() };
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
    await Promise.all(data.map(renderPDF));
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

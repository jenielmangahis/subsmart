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

  const fileId = parseInt($("[name=file_id]").val());
  const documentUrl = $form.data("doc-url");
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  const $optionsSidebar = $(".esignBuilder__optionsSidebar");

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

    const $parent = $element.closest(".docPage");
    const key = $element.find(".subData").data("key");
    const docPage = $parent.data("page");
    const recipientId = $("#recipientsSelect").get(0).dataset.recipientId;

    const payload = {
      coordinates: position,
      docfile_id: fileId,
      doc_page: docPage,
      unique_key: key,
      field: $element.text().trim(),
      recipient_id: recipientId,
      specs,
    };

    const endpoint = `${prefixURL}/esign/apiCreateUserDocfileFields`;
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
    const endpoint = `${prefixURL}/esign/apiGetUserDocfileFields/${fileId}`;
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

        <div class="esignBuilder__fieldOptions">
            <div class="esignBuilder__fieldClose">
                <i class="fa fa-times"></i>
            </div>
        </div>
      </div>
    `;

    const $element = createElementFromHTML(html);
    $close = $element.find(".esignBuilder__fieldClose");
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

    $close.on("click", async (event) => {
      const $parent = $(event.target).closest(".ui-draggable");
      const $signature = $parent.find(".subData");
      const uniqueKey = $signature.data("key");

      const endpoint = `${prefixURL}/esign/apiDeleteDocfileField/${uniqueKey}`;
      await fetch(endpoint, { method: "DELETE" });

      $parent.remove();
      hideFieldSidebar();
    });

    $element.draggable({
      containment: ".ui-droppable",
      appendTo: ".ui-droppable",
      stop: (_, ui) => storeField(ui.position, $(ui.helper)),
    });

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

  async function renderPDF() {
    const document = await PDFJS.getDocument({ url: documentUrl });
    for (let index = 1; index <= document.numPages; index++) {
      const currentFields = fields.filter(({ doc_page }) => doc_page == index);
      const params = { page: index, document };

      const $page = await getPage(params);
      $docRenderer.append($page);

      const { top: offsetTop } = $page.offset();
      const $pagePreview = await getPagePreview({ ...params, offsetTop });
      $docPreviewRenderer.append($pagePreview);

      const $fields = currentFields.map(createField);
      $page.append($fields);

      $page.droppable({
        drop: function (_, ui) {
          if (!ui.draggable.hasClass("fields")) {
            return;
          }

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
            containment: ".ui-droppable",
            appendTo: ".ui-droppable",
            stop: (_, ui) => storeField(ui.position, $(ui.helper)),
          });
        },
      });
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
      const uniqueKey = $active.data("key");

      const $button = $(this);
      const $loader = $button.find(".spinner-border");

      $loader.removeClass("d-none");
      $button.attr("disabled", true);

      const endpoint = `${prefixURL}/esign/apiDeleteDocfileField/${uniqueKey}`;
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

  async function init() {
    await getFields();
    await renderPDF();
    attachEventHandlers();

    $fields.draggable({
      containment: ".ui-droppable",
      appendTo: ".ui-droppable",
      helper: "clone",
    });
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

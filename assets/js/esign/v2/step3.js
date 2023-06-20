// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

function Step3() {
  const PDFJS = pdfjsLib;

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
  let userInfo = undefined;
  let files = [];
  const prefixURL = "";

  async function renderPage({ canvas, page, document }) {
    const documentPage = await document.getPage(page);
    const viewport = await documentPage.getViewport({ scale: 1.5 });
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
      rest.$page.get(0).scrollIntoView({ behavior: "smooth" });
    });

    return $element;
  }

  async function storeField(position, $element, specs = null) {
    if (!$element.hasClass("esignBuilder__field") && !userInfo) {
      $element = $element.closest(".esignBuilder__field");
    }

    let docPage = undefined;
    let docId = undefined;

    // const elementYTop = $element.get(0).offsetTop;
    const elementYTop =
      // get element offset top relative to parent
      $element.get(0).getBoundingClientRect().top +
      document.documentElement.scrollTop -
      $("#upload_file").get(0).offsetTop;

    const $pages = [...$docRenderer.find(".docPage")];
    for (let index = 0; index < $pages.length; index++) {
      const $docPage = $($pages[index]);

      const $parent = $docPage.closest(".docPageContainer");
      const docPageHeight = $docPage.height();

      // docPageYBottom = the pixels of the very bottom of the page
      let docPageYBottom = $parent.get(0).offsetTop;
      if ($docPage.attr("data-page") == 1) {
        docPageYBottom = docPageYBottom + docPageHeight;
      } else {
        docPageYBottom =
          docPageYBottom + $docPage.get(0).offsetTop + docPageHeight;
      }

      // element is sitting on the current page
      if (elementYTop < docPageYBottom) {
        // pageTop = is the top position of the element inside its page
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

    const $subdata = $element.find(".subData");
    let key = $subdata.data("key");
    let fieldName = $element.text().trim();

    if ($subdata.attr("data-field-name")) {
      fieldName = $subdata.attr("data-field-name");
    }

    const recipientId = $("#recipientsSelect").get(0).dataset.recipientId;

    if (specs === null) {
      const field = fields.find((f) => f.unique_key == key);
      if (field) {
        specs = field.specs ? JSON.parse(field.specs) : {};
      }
    }

    if (fieldName === "Text") {
      specs = { ...specs, width: parseInt($element.css("width"), 10) };
    }

    if (userInfo !== undefined) {
      fieldName = $element.data("field-name");
      key = $element.data("unique-key");

      if (specs === null) {
        specs = {};
      }

      if ($element.find("input").length) {
        specs.value = $element.find("input").val();
      }

      if ($element.find(".fillAndSign__signatureDraw").length) {
        specs.value = $element.find(".fillAndSign__signatureDraw").attr("src");
      }
    }

    position.pageTop = position.pageTop - 15; // adjustment

    await apiStoreField({
      coordinates: position,
      docfile_id: fileId,
      doc_page: docPage,
      docfile_document_id: docId,
      unique_key: key,
      field: fieldName,
      recipient_id: recipientId,
      specs,
    });
  }

  async function apiStoreField(payload) {
    let endpoint = `${prefixURL}/Esign/apiCreateUserDocfileFields`;
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
        field.unique_key != payload.unique_key ? field : record
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

  function showFieldSidebar(field, event) {
    const { field_name, specs: fieldSpecs } = field;
    const specs = JSON.parse(fieldSpecs || null) || {};

    const $fieldId = $optionsSidebar.find(".esignBuilder__optionsSidebarFieldId span"); // prettier-ignore
    const $formulaInput = $optionsSidebar.find("#formulaInput");
    const $noteInput = $optionsSidebar.find("#noteInput");
    const $optionInputs = $optionsSidebar.find(".esignBuilder__optionInput");
    const $fieldNameInput = $optionsSidebar.find("#textFieldName");
    const $fieldValueInput = $optionsSidebar.find("#textFieldValue");
    const $fieldValueLabel = $optionsSidebar.find("#textFieldPlaceholder");
    const $autoPopulateWith = $optionsSidebar.find("#autoPopulateWith");

    $fieldId.html("");
    if (event && $(event.target).hasClass("subData--isSubCheckbox")) {
      $fieldId.html($(event.target).attr("data-key"));
      $optionsSidebar.attr("data-subcheckbox", true);
    } else {
      $fieldId.html(field.unique_key);
      $optionsSidebar.removeAttr("data-subcheckbox");
    }

    $formulaInput.val("");
    $noteInput.val("");
    $optionInputs.remove();
    $fieldNameInput.val("");
    $fieldValueInput.val("");
    $fieldValueLabel.val("");
    $autoPopulateWith.val("");

    const fieldTypeWithOptions = ["Checkbox", "Radio"];
    let fieldType = "field";

    if (field_name === "Formula") {
      fieldType = "formula";
      $formulaInput.val(specs.formula || "");
    } else if (field_name === "Note") {
      fieldType = "note";
      $noteInput.val(specs.note || "");
    } else if (fieldTypeWithOptions.includes(field_name)) {
      fieldType = "options";
      const { options = [], subCheckbox = [] } = specs;
      const isCheckbox = field_name === "Checkbox";

      $(".options #optionsRequired").removeAttr("checked");
      $(".options #optionsRequired").prop(
        "checked",
        Boolean(specs.is_required)
      );

      $(".options__valuesItem:first").attr("data-key", field.unique_key);
      $(".options__valuesItem:first")
        .children(":first")
        .attr("type", "checkbox");

      $(".options__valuesSubItems").empty();
      $(".options #optionsFieldName").val(specs.name ? specs.name : "");

      const $valueItem = $(
        `.options__valuesItem[data-key=${field.unique_key}]`
      );

      const $checkbox = $valueItem.find("[type=checkbox]");
      $checkbox.attr("type", isCheckbox ? "checkbox" : "radio");
      $checkbox.attr("name", specs.name ? specs.name : field.unique_key);
      $checkbox.prop("checked", Boolean(specs.isChecked));

      $valueItem.find("[type=text]").val(specs.value || "");

      subCheckbox.forEach((item) => {
        const $valueItem = $(".options__valuesItem:first").clone();

        $valueItem.attr("type", "radio");
        $valueItem.attr("data-key", item.id);

        const $checkbox = $valueItem.find(
          `[type=${isCheckbox ? "checkbox" : "radio"}]`
        );
        $checkbox.attr("type", isCheckbox ? "checkbox" : "radio");
        $checkbox.prop("checked", item.isChecked);
        $checkbox.attr("name", specs.name ? specs.name : field.unique_key);

        $valueItem.find("[type=text]").val(item.value || "");
        $(".options__valuesSubItems").append($valueItem);
      });

      $checks = $(`.options input[type=${isCheckbox ? "checkbox" : "radio"}]`);
      $checks.change(function (event) {
        const $parent = $(event.target).parent(".options__valuesItem");
        const id = $parent.attr("data-key");

        let selector = "esignBuilder__fieldCheckbox";
        if (field_name === "Radio") {
          selector = "esignBuilder__fieldRadio";
        }

        const $field = $(`.${selector}[data-key=${id}]`);

        if (field_name === "Radio") {
          const $fieldParent = $field.parent(".esignBuilder__field");
          $fieldParent
            .find(`.${selector}--checked`)
            .removeClass(`${selector}--checked`);
        }

        if (this.checked) {
          $field.addClass(`${selector}--checked`);
        } else {
          $field.removeClass(`${selector}--checked`);
        }
      });

      if (options.length) {
        const $inputs = options.map((value) => createDropdownInput({ value })); // prettier-ignore
        $optionsSidebar.append($inputs);
      }
    } else if (field_name === "Text") {
      fieldType = "text";
      $(".text #requiredText").prop("checked", specs.is_required);
      $(".text #readOnlyText").prop("checked", specs.is_read_only);
      $(".text #textFieldName").val(specs.name ? specs.name : "");
      $(".text #textFieldValue").val(specs.value ? specs.value : "");
      $(".text #textFieldPlaceholder").val(
        specs.placeholder ? specs.placeholder : ""
      );
      $("#autoPopulateWith").val(
        specs.auto_populate_with ? specs.auto_populate_with : ""
      );
    } else if (field_name === "Dropdown") {
      fieldType = "dropdown";

      $(".dropdown #dropdownName").val(specs.name ? specs.name : "");
      $(".dropdown .options__values").empty();
      $(".dropdown #requiredDropdown").removeAttr("checked");
      $(".dropdown #requiredDropdown").prop(
        "checked",
        Boolean(specs.is_required)
      );

      if (specs && specs.values && specs.values.length) {
        const $elements = specs.values.map((v) =>
          createDropdownInput({ value: v })
        );
        $(".dropdown .options__values").append($elements);
      } else {
        const $element = createDropdownInput({ value: "" });
        $(".dropdown .options__values").append($element);
        $element.find("input").focus();
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
    $optionsSidebar.removeAttr("data-subcheckbox");
  }

  function createFieldWithValue(field) {
    const { coordinates: coords, unique_key, field_name = "" } = field;
    const coordinates = JSON.parse(coords);
    const top = parseInt(coordinates.top, 10);
    const left = parseInt(coordinates.left, 10);
    const specs = field.specs ? JSON.parse(field.specs) : {};

    const fieldName = field_name.trim();
    const uniqueKey = unique_key || Date.now();
    field.field_name = fieldName;
    field.unique_key = uniqueKey;

    let html = undefined;
    let textWidth = undefined;

    if (fieldName === "Signature") {
      const { signature } = userInfo.signature;
      const value = specs.value || signature;

      html = `
        <div class="menu_item ui-draggable ui-draggable-handle ui-draggable-dragging esignBuilder__field">
          <div class="fillAndSign__signatureContainer">
            <img class="fillAndSign__signatureDraw" src="${value}"/>
          </div>
        </div>
      `;
    }

    if (fieldName === "Date Signed") {
      html = `
        <div class="menu_item ui-draggable ui-draggable-handle ui-draggable-dragging esignBuilder__field">
          ${moment().format("MM/DD/YYYY")}
        </div>
      `;
    }

    if (html === undefined) {
      const { details, company } = userInfo;
      const { FName, LName, email } = details;

      let value = "";
      value = fieldName === "Name" ? `${FName} ${LName}` : value;
      value = fieldName === "Email" ? email : value;
      value = fieldName === "Company" ? company.contact_name : value;
      value = specs.value || value;

      textWidth = getWidth("16px", value);

      html = `
        <div
          class="signing docusignField"
          style="position: relative; display: flex; align-items: center; margin: 0;"
        >
          <input type="text" value="${value}" />
          <div class="spinner-border spinner-border-sm d-none" role="status" style="position: absolute; right: 4px;">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      `;
    }

    const $element = createElementFromHTML(html);

    // requires assets/js/esign/docusign/input.autoresize.js
    const minWidth = textWidth < 100 ? 100 : textWidth;
    $element.find("input").autoresize({ minWidth: textWidth });

    $element.css({ top, left, position: "absolute" });
    $element.attr("data-unique-key", uniqueKey);
    $element.attr("data-field-name", fieldName);

    return $element;
  }

  function createField(field) {
    if (userInfo !== undefined) {
      return createFieldWithValue(field);
    }

    const { coordinates: coords, unique_key, field_name = "", color } = field;
    const coordinates = JSON.parse(coords);
    const top = parseInt(coordinates.pageTop, 10);
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

    if (["Checkbox", "Radio", "2 GIG Go Panel 2", "2 GIG Go Panel 3"].includes(fieldName)) {
      const baseClassName =
        fieldName === "Checkbox" || fieldName === "2 GIG Go Panel 2" || fieldName === "2 GIG Go Panel 3"
          ? "esignBuilder__fieldCheckbox"
          : "esignBuilder__fieldRadio";

      $subData.append('<i class="subData__check fa fa-check"></i>');

      if (specs.isChecked) {
        $subData.addClass(`${baseClassName}--checked`);
      }

      async function storeSubCheckbox($subCheckbox) {
        const updatedField = fields.find((f) => f.unique_key == field.unique_key); // prettier-ignore
        const specs = updatedField.specs ? JSON.parse(updatedField.specs) : {};

        const { top, left } = getComputedStyle($subCheckbox.get(0));
        const id = $subCheckbox.attr("data-key");

        let subCheckboxes = specs.subCheckbox ? specs.subCheckbox : [];
        if (subCheckboxes.find((sc) => sc.id === id)) {
          subCheckboxes = subCheckboxes.map((sc) => {
            if (sc.id !== id) return sc;
            return { ...sc, top, left, isChecked: false };
          });
        } else {
          subCheckboxes = [
            ...subCheckboxes,
            { id: $subCheckbox.attr("data-key"), top, left },
          ];
        }

        await storeField(coordinates, $element, {
          ...specs,
          subCheckbox: subCheckboxes,
        });
      }

      function createSubCheckbox(data = {}) {
        const { id, top, left } = data;

        const $currElement = createElementFromHTML(
          `<div class="subData subData--isSubCheckbox ${baseClassName}">
            <i class="subData__check fa fa-check"></i>
          </div>`
        );

        if (data.isChecked) {
          $currElement.addClass(`${baseClassName}--checked`);
        }

        $currElement.attr("data-key", id);
        $currElement.css({
          minWidth: 28,
          minHeight: 28,
          position: "absolute",
          left,
          top,
        });

        $currElement.draggable({
          containment: $docRenderer,
          appendTo: $docRenderer,
          stop: (_, ui) => storeSubCheckbox($(ui.helper)),
        });

        return $currElement;
      }

      if (specs.subCheckbox && specs.subCheckbox.length) {
        specs.subCheckbox.forEach((subCheckbox) => {
          $element.append(createSubCheckbox(subCheckbox));
        });
      } else {
        if (specs.name) {
          $element.attr("data-field-name", specs.name);
        }
      }

      $element.css({ minWidth: "unset" });
      $subData.addClass(baseClassName);
      $element.append(`
        <div class="${baseClassName}Adder">
          <i class="fa fa-plus-square"></i>
        </div>
      `);

      $adder = $element.find(`.${baseClassName}Adder`);
      $adder.on("click", async function () {
        const id = Date.now();
        const $currElement = createSubCheckbox({
          id,
          top: 0,
          left: "calc(100% + 10px)",
        });

        await sleep(1);
        await storeSubCheckbox($currElement);

        $element.append($currElement);

        const $valueItem = $(".options__valuesItem:first").clone();
        $valueItem.attr("data-key", id);
        $valueItem.find("[type=checkbox]").prop("checked", false);
        $valueItem.find("[type=text]").val("");
        $(".options__valuesSubItems").append($valueItem);
      });
    }

    $subData.attr("data-key", uniqueKey);
    $subData.attr("data-field-name", field.field_name);

    const activeClass = "esignBuilder__field--active";
    const hasOption = true;

    if (fieldName === "Text") {
      let { specs } = field;
      specs = specs ? JSON.parse(specs) : { width: "initial" };

      if (specs.value) {
        $subData.text(specs.value);
      }

      $element.css({ width: specs.width });

      $element.resizable({
        handles: "e",
        stop: (_, ui) => storeField(ui.position, $(ui.helper)),
      });
    }

    $element.on("click", function (event) {
      const $prevActive = $(`.${activeClass}`);
      const dataKey = $(this).find(".subData").data("key");
      const currField = fields.find(({ unique_key }) => unique_key == dataKey);

      $prevActive.removeClass(activeClass);
      $(this).addClass(activeClass);

      if (!hasOption || !currField) {
        hideFieldSidebar();
        return;
      }

      showFieldSidebar(currField, event);
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

      let document = await PDFJS.getDocument({ url });
      document = await document.promise;

      const $container = createElementFromHTML("<div></div>");
      $container.addClass("docPageContainer");
      $container.attr("data-document-id", id);

      for (let index = 1; index <= document.numPages; index++) {
        const isDocumentField = ({ doc_page, docfile_document_id }) => {
          return doc_page == index && docfile_document_id == data.id;
        };

        const params = { page: index, document };
        const $page = await getPage(params);
        $container.append($page);

        const currentFields = fields.filter(isDocumentField);
        const $pdfFields = currentFields.map(createField);
        $page.append($pdfFields);

        $($pdfFields).draggable({
          containment: $docRenderer,
          appendTo: $docRenderer,
          stop: (_, ui) => storeField(ui.position, $(ui.helper)),
        });

        const { top: offsetTop } = $page.offset();
        const $pagePreview = await getPagePreview({
          ...params,
          $page,
          offsetTop,
        });
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
      <div class="options__valuesItem d-flex align-items-center">
          <input style="flex-grow: 1;" type="text">
          <button class="btn btn-secondary options__close"><i class="fa fa-times"></i></button>
      </div>
      `;

    const $element = createElementFromHTML(html);
    $element.find("input").val(value);

    const $close = $element.find(".options__close");

    $close.on("click", function () {
      $(this).parent().remove();
    });

    return $element;
  }

  function attachEventHandlers() {
    // const $pdfFields = fields.map(createField);
    // $docRenderer.append($pdfFields);
    // $($pdfFields).draggable({
    //   containment: $docRenderer,
    //   appendTo: $docRenderer,
    //   stop: (_, ui) => storeField(ui.position, $(ui.helper)),
    // });

    const getRecipientColor = () => {
      return getComputedStyle($form.get(0)).getPropertyValue("--color"); // prettier-ignore
    };

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
        const elementYTop = ui.position.top;
        $_document = null;

        const $pages = [...$docRenderer.find(".docPage")];
        for (let index = 0; index < $pages.length; index++) {
          const $docPage = $($pages[index]);

          const $parent = $docPage.closest(".docPageContainer");
          const docPageHeight = $docPage.height();

          let docPageYBottom = $parent.get(0).offsetTop;
          if ($docPage.attr("data-page") == 1) {
            docPageYBottom = docPageYBottom + docPageHeight;
          } else {
            docPageYBottom =
              docPageYBottom + $docPage.get(0).offsetTop + docPageHeight;
          }

          // element is sitting on the current page
          if (elementYTop < docPageYBottom) {
            // pageTop = is the top position of the element inside its page
            ui.position.pageTop =
              elementYTop -
              ($parent.get(0).offsetTop + $docPage.get(0).offsetTop);
            $_document = $docPage;
            break;
          }
        }

        if ($_document === null) {
          console.log($_document);
          return;
        }

        const $item = $(ui.helper).clone();
        const color = getRecipientColor();
        const $element = createField({
          coordinates: JSON.stringify(ui.position),
          field_name: $item.text(),
          color,
          isNew: true,
        });

        $_document.append($element);
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

      Swal.fire({
            title: 'Confirmation',
            html: "Save changes?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
              if (userInfo !== undefined) {
                return handleSelfSigningOnSubmit({ event, evenlopeId: fileId, files });
              }

              if (isTemplate) {
                window.location = `${prefixURL}/vault_v2/mylibrary`;
                return;
              }

              const $button = $(this);
              const $loader = $button.find(".spinner-border");

              $loader.removeClass("d-none");
              $button.attr("disabled", true);

              let url = `${prefixURL}/DocuSign/send`;
              $.ajax({
                  type: 'POST',
                  url: url,
                  dataType: 'json',
                  data: {document_id: fileId},
                  success: function(data) {
                    let nextUrl = `${prefixURL}/eSign/manage?view=sent`;
                    if (data.hash) {
                      nextUrl = `${prefixURL}/eSign/signing?hash=${data.hash}`;
                    }
                    window.location = nextUrl;                           
                  },
              });
            }
        }); 

      /*if (userInfo !== undefined) {
        return handleSelfSigningOnSubmit({ event, evenlopeId: fileId, files });
      }

      if (isTemplate) {
        window.location = `${prefixURL}/vault_v2/mylibrary`;
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
      let nextUrl = `${prefixURL}/eSign/manage?view=sent`;
      if (data.hash) {
        nextUrl = `${prefixURL}/eSign/signing?hash=${data.hash}`;
      }

      window.location = nextUrl;*/
    });

    const $addOption = $optionsSidebar.find("#addDropdownOption");
    $addOption.on("click", function () {
      const $element = createDropdownInput({ value: "" });
      $(".dropdown .options__values").append($element);
      $element.find("input").focus();
    });

    const $saveOption = $optionsSidebar.find("#saveOption");
    $saveOption.on("click", async function () {
      let specs = null;
      const fieldType = $optionsSidebar.attr("data-field-type");
      const $formulaInput = $optionsSidebar.find("#formulaInput");
      const $noteInput = $optionsSidebar.find("#noteInput");

      if (fieldType === "formula") {
        specs = { formula: $formulaInput.val() };
      } else if (fieldType === "note") {
        specs = { note: $noteInput.val() };
      } else if (fieldType === "text") {
        const fieldName = $(".text #textFieldName").val().trim();
        const fieldValue = $(".text #textFieldValue").val().trim();
        const fieldPlaceholder = $(".text #textFieldPlaceholder").val().trim();
        const autoPopulateWith = $("#autoPopulateWith").val().trim();

        specs = {
          is_required: $("#requiredText").is(":checked"),
          is_read_only: $("#readOnlyText").is(":checked"),
          name: !isEmpty(fieldName) ? fieldName : null,
          value: fieldValue,
          placeholder: fieldPlaceholder,
          auto_populate_with: autoPopulateWith,
        };
      } else if (fieldType === "dropdown") {
        const $options = $(".dropdown .options__valuesItem input");
        const fieldName = $(".dropdown #dropdownName").val().trim();
        const values = [];

        for (let index = 0; index < $options.length; index++) {
          const $element = $($options.get(index));
          if (isEmpty($element.val())) {
            $element.focus();
            alert("Please enter value.");
            return;
          }

          values.push($element.val());
        }

        specs = {
          values,
          name: !isEmpty(fieldName) ? fieldName : null,
          is_required: $(".dropdown #requiredDropdown").is(":checked"),
        };
      } else {
        const $fieldKey = $(".esignBuilder__optionsSidebarFieldId span");
        const fieldKey = $fieldKey.text();

        const field = fields.find(({ unique_key, specs }) => {
          if (unique_key === fieldKey) return true;
          const { subCheckbox = [] } = JSON.parse(specs) || {};
          return subCheckbox.find(({ id }) => id === fieldKey);
        });

        const isCheckbox = field.field_name === "Checkbox";

        const { specs: fieldSpecs } = field;
        let { subCheckbox = [] } = JSON.parse(fieldSpecs) || {};
        specs = {};

        $(".options__valuesItem").each(function (_, element) {
          const $element = $(element);
          const $checkbox = $element.find(
            `[type=${isCheckbox ? "checkbox" : "radio"}]`
          );
          const $inputText = $element.find("[type=text]");
          const key = $element.attr("data-key");

          if (key === field.unique_key) {
            specs.isChecked = $checkbox.is(":checked");
            specs.value = $inputText.val();
          } else {
            subCheckbox = subCheckbox.map((c) => {
              if (c.id !== key) return c;
              return {
                ...c,
                isChecked: $checkbox.is(":checked"),
                value: $inputText.val(),
              };
            });
          }
        });

        // values must be unique

        const values = [...subCheckbox.map((s) => s.value)];
        if (specs.value) values.push(specs.value);

        if (new Set(values).size !== values.length) {
          alert("Value must be unique.");
          return;
        }

        const fieldName = $(".options #optionsFieldName").val().trim();
        specs = {
          ...specs,
          subCheckbox,
          name: !isEmpty(fieldName) ? fieldName : null,
          is_required: $(".options #optionsRequired").is(":checked"),
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

      if ($optionsSidebar.attr("data-subcheckbox")) {
        const $subCheckboxId = $(".esignBuilder__optionsSidebarFieldId span");
        const subCheckboxId = $subCheckboxId.text().trim();
        const field = fields.find((f) => f.unique_key == uniqueKey);
        let { subCheckbox } = JSON.parse(field.specs);
        subCheckbox = subCheckbox.filter((s) => s.id !== subCheckboxId);

        await apiStoreField({
          ...field,
          field: field.field_name,
          coordinates: JSON.parse(field.coordinates),
          specs: { subCheckbox },
        });

        $(`[data-key="${subCheckboxId}"]`).remove();
        $loader.addClass("d-none");
        $button.removeAttr("disabled");
        hideFieldSidebar();
        return;
      }

      let endpoint = `${prefixURL}/esign/apiDeleteDocfileField/${uniqueKey}`;
      if (isTemplate) {
        endpoint = `${prefixURL}/DocuSign/apiDeleteTemplateField/${uniqueKey}`;
      }

      await fetch(endpoint, { method: "DELETE" });
      fields = fields.filter((f) => f.unique_key !== uniqueKey);

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

      if ($target.closest(".options__close").length) {
        return;
      }

      hideFieldSidebar();
    });

    $("#textFieldValue").on("input propertychange", function (event) {
      const activeInputId = $(
        ".esignBuilder__optionsSidebarFieldId span"
      ).text();
      $(`[data-key=${activeInputId}]`).text(event.target.value);
    });
  }

  async function getPDFFiles(id) {
    let endpoint = `${prefixURL}/Esign/apiDocumentFile/${id}`;
    if (isTemplate) {
      endpoint = `${prefixURL}/DocuSign/apiTemplateFile/${id}`;
    }

    const response = await fetch(endpoint);
    const data = await response.json();
    return data;
  }

  async function getUserInfo() {
    const response = await fetch(`${prefixURL}/DocuSign/apiUserDetails`);
    const { data } = await response.json();
    userInfo = data;
  }

  function hideLoader() {
    $(".esignBuilder--loading").removeClass("esignBuilder--loading");
  }

  async function init() {
    const urlParams = new URLSearchParams(window.location.search);
    const templateId = urlParams.get("template_id");
    const signingId = urlParams.get("signing_id");

    isTemplate = Boolean(templateId);
    isSelfSigning = Boolean(signingId);

    fileId = parseInt($("[name=file_id]").val());
    fileId = isTemplate ? templateId : fileId;

    if (isSelfSigning) {
      fileId = signingId;
      await getUserInfo();
    }

    const { data } = await getPDFFiles(fileId);
    files = data;
    await getFields();

    for (let index = 0; index < data.length; index++) {
      try {
        await renderPDF(data[index]);
      } catch (error) {
        console.log(error);
        continue;
      }

      if (index === 1) {
        hideLoader();
      }
    }

    attachEventHandlers();
    hideLoader();
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

// https://stackoverflow.com/a/61088413/8062659
function getWidth(fontSize, value) {
  let div = document.createElement("div");
  div.innerHTML = value;
  div.style.fontSize = fontSize;
  div.style.width = "auto";
  div.style.display = "inline-block";
  div.style.visibility = "hidden";
  div.style.position = "fixed";
  div.style.overflow = "auto";
  document.body.append(div);
  let width = div.clientWidth;
  div.remove();
  return width;
}

// https://stackoverflow.com/a/46181/8062659
function isValidEmail(string) {
  const regex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(string).toLowerCase());
}

function handleSelfSigningOnSubmit(args) {
  jQuery.noConflict();

  const { evenlopeId, files } = args;

  const $modal = $("#selfSigningSend");
  const $form = $modal.find(".form");
  const $submit = $modal.find(".btn-primary");
  const $close = $modal.find(".btn-secondary");
  const $name = $modal.find("#selfSigningSend__name");
  const $email = $modal.find("#selfSigningSend__email");
  const $subject = $modal.find("#selfSigningSend__subject");
  const $message = $modal.find("#selfSigningSend__message");

  const prefixURL = "";

  const filenames = files.map((file) => file.name);
  const subject = `Please eSign: ${filenames.join(", ")}`;
  $subject.val(subject);

  $modal.modal("show");
  $modal.addClass("show");

  $modal.on("hidden.bs.modal", function () {
    $modal.removeClass("show");
  });

  $submit.on("click", function (event) {
    event.preventDefault();
    $form.submit();
  });

  $form.on("submit", async function (event) {
    event.preventDefault();

    const payload = {
      recipients: [
        {
          name: $name.val().trim(),
          email: $email.val().trim(),
        },
      ],
      subject: $subject.val().trim(),
      message: $message.val().trim(),
    };

    const [recipient] = payload.recipients;
    if (isEmpty(recipient.name)) {
      $name.focus();
      $name.addClass("is-invalid");
      return;
    } else {
      $name.removeClass("is-invalid");
    }

    if (isEmpty(recipient.email) || !isValidEmail(recipient.email)) {
      $email.focus();
      $email.addClass("is-invalid");
      return;
    } else {
      $email.removeClass("is-invalid");
    }

    $submit.find(".spinner-border").removeClass("d-none");
    $submit.attr("disabled", true);

    const endpoint = `${prefixURL}/DocuSign/apiSubmitSelfSigned/${evenlopeId}`;
    const response = await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    const json = await response.json();
    window.location = `${prefixURL}/eSign_v2/manage?view=sent`;
  });

  $close.on("click", function (event) {
    event.preventDefault();
    window.location = `${prefixURL}/eSign_v2/manage?view=inbox`;
  });
}

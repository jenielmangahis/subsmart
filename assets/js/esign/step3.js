// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

function Step3() {
  let fields = [];

  const $form = $("[data-form-step=3]");
  const $docRenderer = $("#main-pdf-render");
  const $docPreviewRenderer = $("#main-pdf-render-preview");
  const $fields = $(".fields");

  const fileId = parseInt($("[name=file_id]").val());
  const documentUrl = $form.data("doc-url");
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

  async function storeField(position, $element) {
    const $parent = $element.closest(".docPage");
    const key = $element.find(".subData").data("key");
    const docPage = $parent.data("page");

    const payload = {
      coordinates: position,
      docfile_id: fileId,
      doc_page: docPage,
      unique_key: key,
      field: $element.text().trim(),
    };

    const endpoint = `${prefixURL}/esign/apiCreateUserDocfileFields`;
    await fetch(endpoint, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });
  }

  async function getFields() {
    const endpoint = `${prefixURL}/esign/apiGetUserDocfileFields/${fileId}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    fields = data.fields;
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

      const $fields = currentFields.map((field) => {
        const { coordinates: coords, unique_key, field_name } = field;
        const { top, left } = JSON.parse(coords);

        const html = `
          <div
            class="menu_item ui-draggable ui-draggable-handle ui-draggable-dragging"
            style="position: absolute; left: ${left}px; top: ${top}px;">
            <div class="subData" data-key="${unique_key}">${field_name}</div>
          </div>
        `;

        const $element = createElementFromHTML(html);
        $element.draggable({
          containment: ".ui-droppable",
          appendTo: ".ui-droppable",
          stop: (_, ui) => storeField(ui.position, $(ui.helper)),
        });

        return $element;
      });

      $page.append($fields);
      $page.droppable({
        drop: function (_, ui) {
          if (!ui.draggable.hasClass("fields")) {
            return;
          }

          const $item = $(ui.helper).clone();
          $item.removeClass("fields");

          const html = `<div class="subData" data-key="${Date.now()}">${$item.text()}</div>`;
          $item.html(html);

          $(this).append($item);
          storeField(ui.position, $item);

          $item.draggable({
            containment: ".ui-droppable",
            appendTo: ".ui-droppable",
            stop: (_, ui) => storeField(ui.position, $(ui.helper)),
          });
        },
      });
    }
  }

  async function init() {
    await getFields();
    await renderPDF();

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

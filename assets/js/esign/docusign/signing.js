function Signing(hash) {
  const $documentContainer = $(".signing__documentContainer");

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  let data = null;

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
    const { email, name } = recipient;

    const documentUrl = `${prefixURL}/uploads/DocFiles/${filename}`;
    const document = await PDFJS.getDocument({ url: documentUrl });

    for (let index = 1; index <= document.numPages; index++) {
      const currentFields = fields.filter(({ doc_page }) => doc_page == index);
      const params = { page: index, document };

      const $page = await getPage(params);
      $documentContainer.append($page);

      const canvas = $page.find("canvas").get(0);
      const context = canvas.getContext("2d");

      const $fields = currentFields.map((field) => {
        console.log(field);

        const { field_name, coordinates } = field;
        const text = recipient[field_name.toLowerCase()];
        const { top, left } = JSON.parse(coordinates);

        context.font = "16px monospace";
        context.fillText(text, left, top);
      });

      $page.append($fields);
    }
  }

  async function init() {
    await fetchData();
    await renderPDF();
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

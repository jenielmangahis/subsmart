try {
  window.jsPDF = window.jspdf.jsPDF;
  window.PDFDocument = window.PDFLib.PDFDocument;
} catch (error) {}

// https://stackoverflow.com/a/35385518/8062659
export function htmlToElement(html) {
  const template = document.createElement("template");
  template.innerHTML = html.trim();
  return template.content.firstChild;
}

export async function submitBtn($button, asyncCallback) {
  if ($button instanceof jQuery) {
    $button = $button.get(0);
  }

  $button.setAttribute("disabled", true);
  $button.classList.add("esigneditor__btn--loading");
  const response = await asyncCallback();

  $button.removeAttribute("disabled");
  $button.classList.remove("esigneditor__btn--loading");
  return response;
}

export function wysiwygEditor($textarea, content = null) {
  const $letter = $($textarea);
  const $summernote = $letter.summernote({
    placeholder: "Type Here ... ",
    tabsize: 2,
    height: 450,
    toolbar: [
      ["style", ["style"]],
      ["font", ["bold", "italic", "underline", "strikethrough", "clear"]],
      ["fontsize", ["fontsize"]],
      ["para", ["ol", "ul", "paragraph", "height"]],
      ["table", ["table"]],
      ["insert", ["link", "picture"]],
      ["view", ["undo", "redo", "fullscreen"]],
    ],
    callbacks: {
      onImageUpload: async ([file]) => {
        try {
          const base64 = await toBase64(file);
          $summernote.summernote("insertImage", base64);
        } catch (error) {}
      },
    },
  });

  $letter.summernote("fontName", "Arial");

  if (content !== null) {
    $letter.summernote("code", content);
  }
}

export function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

export function isEmail(email) {
  const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

export async function mergePdfs(
  pdfsToMerges /* array of jsPDF doc.output("arraybuffer") */
) {
  const mergedPdf = await PDFDocument.create();
  const actions = pdfsToMerges.map(async (pdfBuffer) => {
    const pdf = await PDFDocument.load(pdfBuffer);
    const copiedPages = await mergedPdf.copyPages(pdf, pdf.getPageIndices());
    copiedPages.forEach((page) => {
      mergedPdf.addPage(page);
    });
  });
  await Promise.all(actions);
  return mergedPdf.saveAsBase64({ dataUri: true });
}

// https://stackoverflow.com/a/57272491/8062659
export function toBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}

export function htmlToPDF(string) {
  const doc = new jsPDF({
    orientation: "portrait",
    format: "a4",
    unit: "px",
    hotfixes: ["px_scaling"],
  });

  const margin = { x: 48, y: 48 };
  let { width, height } = doc.internal.pageSize;
  width = width - margin.x * 2;

  doc.html(
    `<div style="width:${width}px;">
      ${decodeHtml(string)}
    </div>`,
    {
      margin: [margin.y, margin.x, margin.y, margin.x],
      autoPaging: "text",
      callback: (doc) => {
        doc.output("dataurlnewwindow");
      },
    }
  );
}

// https://stackoverflow.com/a/7394787/8062659
function decodeHtml(html) {
  const txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
}

export async function generatePDF(html) {
  let htmls = html;
  if (!Array.isArray(htmls)) {
    htmls = [html];
  }

  const docPromises = htmls.map(async (html) => {
    const doc = new jsPDF({
      orientation: "portrait",
      format: "a4",
      unit: "px",
      hotfixes: ["px_scaling"],
    });

    const margin = { x: 48, y: 48 };
    let { width } = doc.internal.pageSize;
    width = width - margin.x * 2;

    doc.html(
      `<div style="width:${width}px;">
          ${html}
        </div>`,
      {
        margin: [margin.y, margin.x, margin.y, margin.x],
        autoPaging: "text",
      }
    );

    await sleep(5); // sometimes setting this to lower will result to blank pages
    return doc.output("arraybuffer", { returnPromise: true });
  });

  const docs = await Promise.all(docPromises);
  return mergePdfs(docs);
}

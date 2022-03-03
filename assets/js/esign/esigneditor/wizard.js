window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");
  window.jsPDF = window.jspdf.jsPDF;

  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  const { data: customer } = await window.api.getCustomer(params.customer_id);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([initCategories(), initLetters()]).then(() => {
    handleSubmit(customer);
    document.querySelector(".wrapper").classList.remove("wrapper--loading");
  });
});

async function initCategories() {
  const { data: categories } = await window.api.getCategories();
  const $select = document.getElementById("category");
  categories.forEach((category) => {
    const $option = window.helpers.htmlToElement(
      `<option value="${category.id}">${category.name}</option>`
    );
    $select.appendChild($option);
  });

  if (categories.length) {
    const $option = $select.querySelector("option");
    initLetters($option.value);
  }

  $select.addEventListener("change", (event) => {
    initLetters(event.target.value);
  });
}

async function initLetters(categoryId) {
  const $select = document.getElementById("letter");
  $select.innerHTML = "";
  $select.appendChild(
    window.helpers.htmlToElement(
      `<option selected="selected" value="">Select letter</option>`
    )
  );

  const { data: letters } = await window.api.getLetterByCategoryId(categoryId);
  letters.forEach((letter) => {
    const $option = window.helpers.htmlToElement(
      `<option value="${letter.id}">${letter.title}</option>`
    );
    $select.appendChild($option);
  });
}

function handleSubmit(customer) {
  const $form = document.getElementById("selectLetterForm");
  const $letterSelect = $form.querySelector("#letter");
  const $button = $form.querySelector(".btn-primary");
  const $exportAsPDFLink = $form.querySelector(".wizardForm__step2 .link");

  const exportAsPDF = (payload) => async (event) => {
    event.preventDefault();
    const { data } = await window.helpers.submitBtn($exportAsPDFLink, () =>
      window.api.exportLetterAsPDF(payload)
    );

    htmlToPDF(decodeHtml(data.content));
  };

  $button.addEventListener("click", async () => {
    const letterId = Number($letterSelect.value);
    if (Number.isNaN(letterId) || letterId <= 0) {
      return;
    }

    const { data: letter } = await window.helpers.submitBtn($button, () =>
      window.api.getLetter(letterId)
    );

    const $letter = $("#letterContent");
    $letter.summernote({
      placeholder: "Type Here ... ",
      tabsize: 2,
      height: 450,
      toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "italic", "underline", "strikethrough", "clear"]],
        ["fontname", ["fontname"]],
        ["fontsize", ["fontsize"]],
        ["para", ["ol", "ul", "paragraph", "height"]],
        ["table", ["table"]],
        ["insert", ["link"]],
        ["view", ["undo", "redo", "fullscreen"]],
      ],
    });
    $letter.summernote("code", letter.content);
    $form.classList.add("wizardForm--step2");

    $exportAsPDFLink.removeEventListener("click", exportAsPDF);
    $exportAsPDFLink.addEventListener(
      "click",
      exportAsPDF({
        letter_id: letter.id,
        customer_id: customer.prof_id,
      })
    );
  });
}

function htmlToPDF(string) {
  const doc = new jsPDF({
    orientation: "portrait",
    format: "a4",
    unit: "px",
    hotfixes: ["px_scaling"],
  });

  const margin = { x: 48, y: 48 };
  let { width, height } = doc.internal.pageSize;
  width = width - margin.x * 2;
  height = height - margin.y * 2;

  doc.html(
    `<div style="width:${width}px; height:${height}px;">
      ${string}
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

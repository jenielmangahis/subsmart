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

  Promise.all([initCategories(), initLetters(), initSaveForm(customer)]).then(
    () => {
      handleSubmit(customer);
      document.querySelector(".wrapper").classList.remove("wrapper--loading");
    }
  );
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
  const $exportAsPDFLink = $form.querySelector("[data-action=export]");
  const $backLink = $form.querySelector("[data-action=back]");
  const $letter = $("#letterContent");

  const exportAsPDF = (payload) => async (event) => {
    event.preventDefault();
    payload.content = $letter.summernote("code");
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

    window.helpers.wysiwygEditor($letter, letter.content);

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

  $backLink.addEventListener("click", (event) => {
    event.preventDefault();
    $form.classList.remove("wizardForm--step2");
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

function initSaveForm(customer) {
  const $modal = document.getElementById("saveLetterModal");
  const $name = $modal.querySelector("[data-name=name]");
  const $saveButton = $modal.querySelector(".btn");
  const $toggleButtons = $("[data-action=save_for_later], [data-action=save_and_print]"); // prettier-ignore
  const $letter = $("#letterContent");
  const $letterSelect = document.querySelector("#selectLetterForm #letter");

  $toggleButtons.on("click", (event) => {
    $modal.setAttribute("data-action", event.target.dataset.action);
    $($modal).modal("show");
  });

  $saveButton.addEventListener("click", async () => {
    const name = $name.value.trim();
    if (!name.length) {
      $name.focus();
      return;
    }

    const payload = {
      name,
      customer_id: customer.prof_id,
      letter_id: $letterSelect.value,
      content: $letter.summernote("code"),
    };

    await window.helpers.submitBtn($saveButton, () =>
      window.api.createCustomerLetter(payload)
    );

    if ($modal.dataset.action === "save_and_print") {
      window.location.href = `${window.api.prefixURL}/esigneditor/customers/${customer.prof_id}`;
    } else {
      $($modal).modal("hide");
    }
  });

  $($modal).on("show.bs.modal", () => {
    $name.value = "";
  });
}

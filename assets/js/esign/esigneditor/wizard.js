window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");

  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  const { data: customer } = await window.api.getCustomer(params.customer_id);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([initCategories(), initLetters()]).then(() => {
    handleSubmit();
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

function handleSubmit() {
  const $form = document.getElementById("selectLetterForm");
  const $letterSelect = $form.querySelector("#letter");

  console.clear();
  console.log($letterSelect.value);
}

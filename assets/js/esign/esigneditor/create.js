window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");

  window.isEditing = window.location.pathname.endsWith("edit");
  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  let letter = null;
  if (window.isEditing) {
    document.querySelector(".esigneditor__title").textContent = "Edit Letter";
    const letterResponse = await window.api.getLetter(params.id);
    letter = letterResponse.data;
  }

  Promise.all([
    initPlaceholders(),
    initCategories(),
    initAddCategoryForm(),
    initAddPlaceholderForm(),
  ]).then(() => {
    initLetterForm(letter);
    document.querySelector(".wrapper").classList.remove("wrapper--loading");
  });
});

async function initPlaceholders() {
  const { data: placeholders } = await window.api.getPlaceholders();
  placeholders.sort((a, b) => a.code.localeCompare(b.code));
  placeholders.forEach(appendPlaceholderInList);
}

function appendPlaceholderInList(placeholder) {
  const $placeholderList = document.querySelector(".placeholders__list");
  const $item = window.helpers.htmlToElement(
    `<li data-id=${placeholder.id}>
      {${placeholder.code}} - <strong>${placeholder.description}</strong>
    </li>`
  );
  $placeholderList.appendChild($item);
}

async function initCategories() {
  const categories = await window.api.getCategories();
  categories.data.forEach(appendCategoryInSelect);
  categories.data.forEach(appendCategoryInManageModal);
}

function appendCategoryInSelect(category) {
  const $select = document.getElementById("category");
  const $option = window.helpers.htmlToElement(
    `<option value="${category.id}">${category.name}</option>`
  );
  $select.appendChild($option);
}

function appendCategoryInManageModal(category) {
  const $container = document.querySelector(
    "#manageTemplateModal .categoriesList"
  );
  const $template = $container.querySelector("template");
  const template = $template.content;
  const $copy = document.importNode(template, true);
  const $wrapper = $copy.querySelector(".categoriesList__item");
  const $name = $copy.querySelector(".categoriesList__name");
  const $delete = $copy.querySelector("[data-action=delete_category]");
  const $edit = $copy.querySelector("[data-action=edit_category]");

  $name.textContent = category.name;
  $wrapper.setAttribute("data-id", category.id);

  if (category.user_id === null) {
    $wrapper.classList.add("categoriesList__item--isLocked");
  }

  $delete.addEventListener("click", async () => {
    if (confirm("Are you sure you want to delete category?")) {
      deleteCategory(category.id);
    }
  });

  $edit.addEventListener("click", async () => {
    let newName = prompt("Enter name:", category.name);
    if (newName && newName.trim().length) {
      editCategory({ ...category, name: newName.trim() });
    }
  });

  $container.appendChild($copy);
}

async function deleteCategory(id) {
  await window.api.deleteCategory(id);

  const $select = document.getElementById("category");
  $select.querySelector(`[value="${id}"]`).remove();

  const $categoryList = document.querySelector(
    "#manageTemplateModal .categoriesList"
  );
  $categoryList.querySelector(`[data-id="${id}"]`).remove();
}

async function editCategory(category) {
  const { data } = await window.api.editCategory(category);
  const { id, name } = data;

  const $select = document.getElementById("category");
  $select.querySelector(`[value="${id}"]`).textContent = name;

  const $categoryList = document.querySelector(
    "#manageTemplateModal .categoriesList"
  );
  const $item = $categoryList.querySelector(`[data-id="${id}"]`);
  $item.querySelector(".categoriesList__name").textContent = name;
}

function initAddCategoryForm() {
  const $form = document.getElementById("addCategoryForm");
  const $input = $form.querySelector("input");
  const $button = $form.querySelector("button");

  $button.addEventListener("click", async () => {
    const value = $input.value.trim();
    if (!value.length) {
      $input.focus();
      return;
    }

    const { data } = await window.helpers.submitBtn($button, () =>
      window.api.createCategory({ name: value })
    );
    appendCategoryInSelect(data);
    appendCategoryInManageModal(data);
    $input.value = "";
    $input.focus();
  });

  $form.addEventListener("submit", (event) => {
    event.preventDefault();
  });
}

function initAddPlaceholderForm() {
  const $modal = document.getElementById("createPlaceholderModal");
  const $form = $modal.querySelector("#addPlaceholderForm");
  const $inputs = [...$form.querySelectorAll("[data-name]")];
  const $button = $form.querySelector("button");

  $button.addEventListener("click", async () => {
    const payload = {};
    for (let index = 0; index < $inputs.length; index++) {
      const $input = $inputs[index];
      const name = $input.dataset.name;
      const value = $input.value.trim();

      if (!value.length) {
        $input.focus();
        return;
      }

      if (name === "code") {
        const pattern = /^[a-zA-Z0-9_]+$/;
        if (!pattern.test(value)) {
          $input.focus();
          return;
        }
      }

      payload[name] = value;
    }

    const { data } = await window.helpers.submitBtn($button, () =>
      window.api.createPlaceholder(payload)
    );

    appendPlaceholderInList(data);
    $($modal).modal("hide");
  });

  $($modal).on("show.bs.modal", () => {
    for (let index = 0; index < $inputs.length; index++) {
      const $input = $inputs[index];
      $input.value = "";
    }
  });

  $form.addEventListener("submit", (event) => {
    event.preventDefault();
  });
}

function initLetterForm(letter = null) {
  const $letter = $("#letter");
  window.helpers.wysiwygEditor($letter);

  const $form = document.getElementById("addLetterForm");
  const $inputs = [...$form.querySelectorAll("[data-name]")];
  const $button = $form.querySelector("[data-action=submit]");

  if (letter) {
    const { category_id, title, is_active } = letter;
    const isActiveId = Number.parseInt(is_active) ? "status_active" : "status_inactive"; // prettier-ignore
    $form.querySelector("[data-name=category_id]").value = category_id;
    $form.querySelector("[data-name=title]").value = title;
    $form.querySelector(`#${isActiveId}`).checked = true;
    $letter.summernote("code", letter.content);
  }

  $button.addEventListener("click", async () => {
    const payload = {};
    for (let index = 0; index < $inputs.length; index++) {
      const $input = $inputs[index];
      const name = $input.dataset.name;
      const value = $input.value.trim();

      if (!value.length) {
        $input.focus();
        return;
      }

      if (name !== "is_active") {
        payload[name] = value;
      }
    }

    if ($letter.summernote("isEmpty")) {
      $letter.summernote("focus");
      return;
    }

    let func = window.api.createLetter;
    if (letter) {
      func = window.api.editLetter;
      payload.id = letter.id;
    }

    payload.is_active = $form.querySelector("#status_active").checked ? 1 : 0;
    payload.content = $letter.summernote("code");
    window.helpers.submitBtn($button, () => func(payload));
    window.location.href = `${window.api.prefixURL}/esigneditor/letters`;
  });
}

import * as common from "./common.js";

const letters = [
  {
    id: "793",
    title: "Welcome Email Template 1",
  },
  {
    id: "794",
    title: "Welcome Email Template 2",
  },
  {
    id: "795",
    title: "Welcome Email Template 3",
  },
  {
    id: "796",
    title: "Welcome Email Template 4",
  },
  {
    id: "797",
    title: "Welcome Email Template 5",
  },
];

const $modal = document.getElementById("sendemailmodal");
const $triggerBtn = document.getElementById("sendWelcomeEmail");
const $submitBtn = $modal.querySelector("button.primary");

const $template = $modal.querySelector("template");
const $fragment = document.createDocumentFragment();
letters.forEach((letter) => {
  const $copy = document.importNode($template.content, true);
  const $title = $copy.querySelector(".content-title");
  const $switch = $copy.querySelector(".form-check-input");

  $title.textContent = letter.title;
  $switch.setAttribute("data-id", letter.id);
  $fragment.appendChild($copy.firstElementChild);
});

const $wrapper = $modal.querySelector(".letters-wrapper");
$wrapper.appendChild($fragment);

$triggerBtn.addEventListener("click", function () {
  $($modal).modal("show");
});

$submitBtn.addEventListener("click", function () {
  const $selectedSwitch = $modal.querySelector("[type=radio]:checked");
  const payload = {
    letter_id: $selectedSwitch.dataset.id,
    customer_id: common.getCustomerId(),
  };

  console.log(payload);
});

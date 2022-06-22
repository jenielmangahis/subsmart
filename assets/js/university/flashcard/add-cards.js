import "./components/add-cards/Preview.js";
import "./components/add-cards/Form.js";

window.document.addEventListener("DOMContentLoaded", async () => {
  createNewCard();

  const $createCardBtn = document.querySelector("[data-action=createcard]");
  $createCardBtn.addEventListener("click", createNewCard);

  const $deleteCardBtn = document.querySelector("[data-action=deletecard]");
  $deleteCardBtn.addEventListener("click", deleteCurrentCard);
});

function createNewCard() {
  const $formWrapper = document.getElementById("formwrapper");
  if ($formWrapper.childElementCount === 0) {
    $formWrapper.append(document.createElement("add-cards-form"));
  }

  const $previewWrapper = document.getElementById("previewwrapper");
  const $preview = document.createElement("add-cards-preview");
  $previewWrapper.append($preview);

  $preview.data = { id: uuid.v4(), question: "", answer: "" };
  $preview.makeActive();
}

function deleteCurrentCard() {
  const $wrapper = document.getElementById("previewwrapper");
  if ($wrapper.childElementCount === 1) return;

  const $active = $wrapper.querySelector("add-cards-preview.active");
  if ($active) {
    const $nextActive = $active.previousSibling;
    $active.remove();

    if ($nextActive) {
      $nextActive.makeActive();
    }
  }
}

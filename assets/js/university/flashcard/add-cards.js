import * as api from "./api.js";
import "./components/add-cards/Preview.js";
import "./components/add-cards/Form.js";

window.document.addEventListener("DOMContentLoaded", async () => {
  const response = await api.getDeck(getDeckId());
  const { cards } = response.data;

  if (!cards.length) {
    createNewCard();
  } else {
    cards.forEach(createNewCard);
  }

  const $createCardBtn = document.querySelector("[data-action=createcard]");
  $createCardBtn.addEventListener("click", () => createNewCard());

  const $deleteCardBtn = document.querySelector("[data-action=deletecard]");
  $deleteCardBtn.addEventListener("click", deleteCurrentCard);

  const $saveDeckBtn = document.querySelector("[data-action=savedeck]");
  $saveDeckBtn.addEventListener("click", saveDeck);
});

function createNewCard(data = null) {
  const $formWrapper = document.getElementById("formwrapper");
  if ($formWrapper.childElementCount === 0) {
    $formWrapper.append(document.createElement("add-cards-form"));
  }

  const $previewWrapper = document.getElementById("previewwrapper");
  const $preview = document.createElement("add-cards-preview");
  $previewWrapper.append($preview);

  console.log(data);
  $preview.data = data ? data : { id: generateId(), question: "", answer: "" };
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

async function saveDeck() {
  const $cards = [...document.querySelectorAll("add-cards-preview")];
  const cards = $cards.map(($card) => {
    const { id, ...rest } = $card.data;
    return String(id).startsWith("new") ? rest : { id, ...rest };
  });
  const payload = { cards, deck_id: getDeckId() };

  const $btn = document.querySelector("[data-action=savedeck]");
  const btnText = $btn.dataset.default;
  $btn.setAttribute("disabled", true);
  $btn.textContent = "Saving...";

  try {
    const response = await api.saveDeck(payload);
    console.log(response.data);
  } catch (error) {
  } finally {
    $btn.removeAttribute("disabled");
    $btn.textContent = btnText;
  }
}

function getDeckId() {
  return Number(document.getElementById("deckid").value);
}

function generateId() {
  return `new-${uuid.v4()}`;
}

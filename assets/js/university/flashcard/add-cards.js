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

  const $resetBtn = document.querySelector("[data-action=resetcards]");
  $resetBtn.addEventListener("click", resetCards);
});

function createNewCard(data = null) {
  const $formWrapper = document.getElementById("formwrapper");
  if ($formWrapper.childElementCount === 0) {
    $formWrapper.append(document.createElement("add-cards-form"));
  }

  const $previewWrapper = document.getElementById("previewwrapper");
  const $preview = document.createElement("add-cards-preview");
  $previewWrapper.append($preview);

  $preview.data = data ? data : { id: generateId(), question: "", answer: "" };
  $preview.makeActive();
}

function clearCards() {
  const $previewWrapper = document.getElementById("previewwrapper");
  const $previews = [...$previewWrapper.querySelectorAll("add-cards-preview")];
  $previews.forEach(($preview) => $preview.remove());
}

async function resetCards() {
  const $resetBtn = document.querySelector("[data-action=resetcards]");
  const $saveBtn = document.querySelector("[data-action=savedeck]");
  const btnText = $resetBtn.dataset.default;

  $resetBtn.textContent = "Resetting...";
  $resetBtn.setAttribute("disabled", true);
  $saveBtn.setAttribute("disabled", true);

  try {
    const { data: deck } = await api.getDeck(getDeckId());
    clearCards();
    deck.cards.forEach(createNewCard);
  } catch (error) {
  } finally {
    $resetBtn.textContent = btnText;
    $resetBtn.removeAttribute("disabled");
    $saveBtn.removeAttribute("disabled");
  }
}

async function deleteCurrentCard() {
  const $wrapper = document.getElementById("previewwrapper");
  if ($wrapper.childElementCount === 1) return;

  const result = await Swal.fire({
    title: "Delete Card",
    text: "Deleting a card will permanently remove it from its deck. Are you sure you want to delete this card?",
    icon: "question",
    confirmButtonText: "Yes, delete",
    showCancelButton: true,
    cancelButtonText: "Cancel",
  });

  if (!result.isConfirmed) {
    return;
  }

  const $active = $wrapper.querySelector("add-cards-preview.active");
  if (!$active) return;

  try {
    await api.deleteCard($active.dataset.id);
    const $nextActive = $active.previousSibling;
    $active.remove();

    if ($nextActive) {
      $nextActive.makeActive();
    }
  } catch (error) {}
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
    const { data: deck } = await api.saveDeck(payload);
    clearCards();
    deck.cards.forEach(createNewCard);
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

import * as api from "./api.js";
import "./components/add-cards/StudyCard.js";

const $currentCard = document.getElementById("currentcard");
const $totalCards = document.getElementById("totalcards");

window.document.addEventListener("DOMContentLoaded", async () => {
  const response = await api.getDeck(getDeckId());
  const { cards } = response.data;

  if (cards.length) {
    $totalCards.textContent = cards.length;

    const cardsGenerator = iterCards(cards);
    displayCard(cardsGenerator.next(), cardsGenerator);
  }
});

function* iterCards(cards) {
  let index = 0;
  while (true) {
    yield { card: cards[index], place: index + 1 };
    index = (index + 1) % cards.length;
  }
}

function displayCard({ value }, cardsGenerator) {
  $currentCard.textContent = value.place;

  const $container = document.getElementById("cardscontainer");
  const $prevCard = $container.querySelector("study-card");
  if ($prevCard) {
    $prevCard.remove();
  }

  const $card = document.createElement("study-card");
  $container.append($card);
  $card.data = value.card;
  $card.onNext = () => {
    displayCard(cardsGenerator.next(), cardsGenerator);
  };
}

function getDeckId() {
  return Number(document.getElementById("deckid").value);
}

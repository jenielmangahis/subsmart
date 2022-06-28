import * as api from "./api.js";
import "./components/add-cards/StudyCard.js";

window.document.addEventListener("DOMContentLoaded", async () => {
  const response = await api.getDeck(getDeckId());
  const { cards } = response.data;
});

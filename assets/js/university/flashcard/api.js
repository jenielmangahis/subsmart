import { http, prefixURL } from "../api.js";
export { prefixURL };

export function createDeck(payload) {
  return http.post(`${prefixURL}/FlashCard/apiCreateDeck`, payload);
}

export function saveDeck(payload) {
  return http.post(`${prefixURL}/FlashCard/apiSaveCards`, payload);
}

export function getDeck(id) {
  return http.post(`${prefixURL}/FlashCard/apiGetDeck/${id}`);
}

export function deleteCard(id) {
  return http.delete(`${prefixURL}/FlashCard/apiDeleteCard?id=${id}`);
}

export function removeDeck(id) {
  return http.delete(`${prefixURL}/FlashCard/apiDeleteDeck?id=${id}`);
}

export function updateDeck(payload) {
  return http.post(`${prefixURL}/FlashCard/apiEditDeck`, payload);
}

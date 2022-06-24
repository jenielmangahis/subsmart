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

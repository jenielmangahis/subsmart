import { http, prefixURL } from "../api.js";
export { prefixURL };

export function createDeck(payload) {
  return http.post(`${prefixURL}/FlashCard/apiCreateDeck`, payload);
}

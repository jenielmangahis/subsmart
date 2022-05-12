export function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

export async function getCustomerUser() {
  if (!window.__customermodule_customer) {
    const api = await import("./api.js");
    const customer = await api.getCustomerById(getCustomerId());
    window.__customermodule_customer = customer.data;
  }

  return window.__customermodule_customer;
}

export function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

// https://stackoverflow.com/a/35385518/8062659
export function htmlToElement(html) {
  const template = document.createElement("template");
  template.innerHTML = html.trim();
  return template.content.firstChild;
}

export async function submitBtn($button, asyncCallback) {
  $button.setAttribute("disabled", true);
  $button.classList.add("esigneditor__btn--loading");
  const response = await asyncCallback();

  $button.removeAttribute("disabled");
  $button.classList.remove("esigneditor__btn--loading");
  return response;
}

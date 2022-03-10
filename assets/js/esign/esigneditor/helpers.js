// https://stackoverflow.com/a/35385518/8062659
export function htmlToElement(html) {
  const template = document.createElement("template");
  template.innerHTML = html.trim();
  return template.content.firstChild;
}

export async function submitBtn($button, asyncCallback) {
  if ($button instanceof jQuery) {
    $button = $button.get(0);
  }

  $button.setAttribute("disabled", true);
  $button.classList.add("esigneditor__btn--loading");
  const response = await asyncCallback();

  $button.removeAttribute("disabled");
  $button.classList.remove("esigneditor__btn--loading");
  return response;
}

export function wysiwygEditor($textarea, content = null) {
  const $letter = $($textarea);
  $letter.summernote({
    placeholder: "Type Here ... ",
    tabsize: 2,
    height: 450,
    toolbar: [
      ["style", ["style"]],
      ["font", ["bold", "italic", "underline", "strikethrough", "clear"]],
      ["fontsize", ["fontsize"]],
      ["para", ["ol", "ul", "paragraph", "height"]],
      ["table", ["table"]],
      ["insert", ["link"]],
      ["view", ["undo", "redo", "fullscreen"]],
    ],
  });

  $letter.summernote("fontName", "Arial");

  if (content !== null) {
    $letter.summernote("code", content);
  }
}

export function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

export function isEmail(email) {
  const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

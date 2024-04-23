const prefixURL = "";

window.document.addEventListener("DOMContentLoaded", async () => {
  const widgets = document.querySelectorAll("[id^=widget_]");

  const { data: widgetNames } = await getCustomWidgetName();
  widgets.forEach(($widget) => setCustomName($widget, widgetNames));
  widgets.forEach(addRenameOption);

});

window.document.addEventListener("DOMContentLoaded", async () => {

  const thumbnail = document.querySelectorAll("[id^=thumbnail_]");

  const { data: thumbnailNames } = await getCustomWidgetName();
  thumbnail.forEach(($thumbnail) => setCustomName($thumbnail, thumbnailNames));

  thumbnail.forEach(addRenameOptionThumbnail);
});




function setCustomName($widget, widgetNames) {
  const widgetId = $widget.dataset.id;
  const match = widgetNames.find(({ w_id }) => w_id == widgetId);
  $widget.__data = match;

  if (match?.custom) {
    const $header = $widget.querySelector(".nsm-card-header");
    const $title = $header.querySelector(".nsm-card-title span");
    $title.textContent = match.custom.name;
  }
}

function addRenameOption($widget) {
  const $header = $widget.querySelector(".nsm-card-header");
  const $menu = $header.querySelector(".dropdown-menu");

  const $option = document.createElement("li");
  $option.classList.add("dropdown-item");
  $option.textContent = "Rename Widget";
  $menu.appendChild($option);

  $option.addEventListener("click", (event) => {
    event.__$widget = $widget;
    onClickRename(event);
  });
}

function addRenameOptionThumbnail($widget) {
  const $header = $widget.querySelector(".nsm-card-header");
  const $menu = $header.querySelector(".dropdown-menu");

  const $option = document.createElement("li");
  $option.classList.add("dropdown-item");
  $option.textContent = "Rename Thumbnail";
  $menu.appendChild($option);
  console.log('===============Goes here===============')


  $option.addEventListener("click", (event) => {
    event.__$widget = $widget;
    onClickRenameTumbnail(event);
  });
}

function onClickRenameTumbnail(event) {
  const $widget = event.__$widget;
  const $header = $widget.querySelector(".nsm-card-header");
  const $title = $header.querySelector(".nsm-card-title");

  const $modal = document.getElementById("drw--modal");
  const $modalTitle =$modal.querySelector(".modal-title");
  const $input = $modal.querySelector(".nsm-field");
  const $text = $modal.querySelector(".form-text");
  const $contentSubtitle =  $modal.querySelector(".content-subtitle"); 
  const $submit = $modal.querySelector(".nsm-button.primary");

  if ($modal.hasAttribute("data-saving")) {
    return;
  }

  $submit.removeEventListener("click", onFormSubmit);
  $submit.addEventListener("click", onFormSubmit);

  const widgetName = $title.textContent.trim();
  $input.value = widgetName;
  $text.innerHTML = `You are about to rename the <i>${widgetName}</i> thumbnail.`;
  $modalTitle.innerHTML = 'Rename Thumbnails';
  $contentSubtitle.innerHTML = 'Thumbnail Name';
  $input.setAttribute("placeholder", $widget.__data.w_name);
  $modal.setAttribute("data-id", $widget.dataset.id);
  $($modal).modal("show");
}


function onClickRename(event) {
  const $widget = event.__$widget;
  const $header = $widget.querySelector(".nsm-card-header");
  const $title = $header.querySelector(".nsm-card-title");

  const $modal = document.getElementById("drw--modal");
  const $input = $modal.querySelector(".nsm-field");
  const $text = $modal.querySelector(".form-text");
  const $submit = $modal.querySelector(".nsm-button.primary");

  if ($modal.hasAttribute("data-saving")) {
    return;
  }

  $submit.removeEventListener("click", onFormSubmit);
  $submit.addEventListener("click", onFormSubmit);

  const widgetName = $title.textContent.trim();
  $input.value = widgetName;
  $text.innerHTML = `You are about to rename the <i>${widgetName}</i> widget.`;

  $input.setAttribute("placeholder", $widget.__data.w_name);
  $modal.setAttribute("data-id", $widget.dataset.id);
  $($modal).modal("show");
}

async function onFormSubmit(event) {
  event.preventDefault();
  const $modal = document.getElementById("drw--modal");
  const $input = $modal.querySelector(".nsm-field");
  const $submit = $modal.querySelector(".nsm-button.primary");
  const $widget = document.querySelector(`[id=widget_${$modal.dataset.id}]`);
  const $widgetTitle = $widget.querySelector(".nsm-card-title span");

  const newTitle = $input.value.trim();
  if (!newTitle.length) {
    $input.focus();
    return;
  }

  $submit.setAttribute("disabled", true);
  $modal.setAttribute("data-saving", true);
  const submitText = $submit.textContent;
  $submit.textContent = "Saving...";

  const payload = { id: $modal.dataset.id, name: newTitle };
  const response = await renameWidget(payload);

  $submit.removeAttribute("disabled");
  $modal.removeAttribute("data-saving");
  $submit.textContent = submitText;

  $widgetTitle.textContent = response.data.name;
  $($modal).modal("hide");
}

async function renameWidget(payload) {
  const response = await fetch(`${prefixURL}/Dashboard/apiRenameWidget`, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });
  return response.json();
}

async function getCustomWidgetName() {
  const response = await fetch(`${prefixURL}/Dashboard/apiGetWidgetNames`);
  return response.json();
}

async function getCustomThumbnailName() {
  const response = await fetch(`${prefixURL}/Dashboard/apiGetThumbnailNames`);
  return response.json();
}

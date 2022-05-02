window.document.addEventListener("DOMContentLoaded", async () => {
  const api = await import("./api.js");
  window.__qaapi = api;

  const customerId = getCustomerId();
  const response = await api.getCustomerActions(customerId);
  const { data: customerActions } = response;

  const $fragment = document.createDocumentFragment();
  customerActions.forEach((action) => {
    $fragment.appendChild(createActionButton(action));
  });

  const $wrapper = document.getElementById("customerquickactions");
  $wrapper.appendChild($fragment);

  const $link = document.getElementById("managequickactions");
  const $modal = document.getElementById("managequickactionsmodal");

  $link.addEventListener("click", function (event) {
    event.preventDefault();
    $($modal).modal("show");
  });

  $($modal).on("show.bs.modal", async function () {
    const $wrapper = this.querySelector(".actions-wrapper");
    if ($wrapper.childElementCount) return;

    const response = await api.getActions();
    const $fragment = document.createDocumentFragment();
    const $loader = this.querySelector(".actions-loader");

    response.data.forEach((action) => {
      const isChecked = customerActions.some(({ id }) => id == action.id);
      const $action = createActionItem({ ...action, is_checked: isChecked });
      $fragment.appendChild($action);
    });

    $loader.remove();
    $wrapper.appendChild($fragment);
  });
});

function createActionItem(action) {
  const $template = document.querySelector("#managequickactionsmodal template");
  const $copy = document.importNode($template.content, true);

  const $title = $copy.querySelector(".content-title");
  const $switch = $copy.querySelector("[type=checkbox]");

  if (action.icon_class) {
    const $icon = $copy.querySelector(".icon");
    $icon.classList.remove("d-none");
    $icon.classList.add(...action.icon_class.split(" "));
  }

  if (action.is_checked === true) {
    $switch.setAttribute("checked", true);
  } else {
    $switch.removeAttribute("checked");
  }

  $title.textContent = action.text;
  $switch.addEventListener("click", (event) => {
    handleSwitchChange(event, action);
  });

  return $copy.firstElementChild;
}

async function handleSwitchChange(event, action) {
  const customerId = getCustomerId();
  const $wrapper = document.getElementById("customerquickactions");
  let $button = $wrapper.querySelector(`[data-id="${action.id}"]`);

  if (event.target.checked === false) {
    $button && $button.remove();
    window.__qaapi.deleteAction({
      customer_id: customerId,
      acs_dashboard_quick_actions_id: action.id,
    });
    return;
  }

  if (!$button) {
    $button = createActionButton(action);
    $wrapper.appendChild($button);
    window.__qaapi.createAction({
      customer_id: customerId,
      acs_dashboard_quick_actions_id: action.id,
    });
  }
}

function createActionButton(action) {
  const $wrapper = document.getElementById("customerquickactions");
  let $button = $wrapper.querySelector(`[data-id="${action.id}"]`);
  if ($button) {
    return $button;
  }

  $button = document.createElement("button");
  $button.classList.add("nsm-button", "w-100", "ms-0");
  $button.textContent = action.text;
  $button.setAttribute("data-id", action.id);

  if (action.icon_class) {
    $icon = document.createElement("i");
    $icon.classList.add(...action.icon_class.split(" "));
    $button.prepend($icon);
  }

  $button.addEventListener("click", () => {
    if (!action.url || !action.url.trim().length) return;
    window.location = `${action.url}`.replace(":customerid", getCustomerId());
  });

  return $button;
}

function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

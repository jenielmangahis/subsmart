window.document.addEventListener("DOMContentLoaded", async () => {
  const api = await import("./api.js");
  window.__customermodule_api = api;

  import("./docu.js");
  import("./office.js");

  const customerId = getCustomerId();
  const response = await api.getCustomerActions(customerId);
  const { data: customerActions } = response;

  const customer = await api.getCustomerById(customerId);
  window.__customermodule_customer = customer.data;

  const $fragment = document.createDocumentFragment();
  customerActions.forEach((action) => {
    $fragment.appendChild(createActionButton(action));
  });

  if ($fragment.childElementCount) {
    const $container = document.getElementById("customerquickactions");
    const $emptyMessage = $container.querySelector(".empty-message");
    const $wrapper = $container.querySelector(".actions-wrapper");

    $emptyMessage.classList.add("d-none");
    $wrapper.appendChild($fragment);
  }

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

  if (action.sub_text) {
    const $subTitle = $copy.querySelector(".content-subtitle");
    $subTitle.textContent = action.sub_text;
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
  const $container = document.getElementById("customerquickactions");
  const $wrapper = $container.querySelector(".actions-wrapper");
  const $emptyMessage = $container.querySelector(".empty-message");

  let $button = $wrapper.querySelector(`[data-id="${action.id}"]`);

  if (!event.target.checked) {
    window.__customermodule_api.deleteAction({
      customer_id: customerId,
      acs_dashboard_quick_actions_id: action.id,
    });

    if ($button) {
      $button.remove();
    }

    if (!$wrapper.childElementCount) {
      $emptyMessage.classList.remove("d-none");
    }

    return;
  }

  if (!$button) {
    $button = createActionButton(action);
    $wrapper.appendChild($button);
  }

  $emptyMessage.classList.add("d-none");
  window.__customermodule_api.createAction({
    customer_id: customerId,
    acs_dashboard_quick_actions_id: action.id,
  });
}

function createActionButton(action) {
  const $wrapper = document.getElementById("customerquickactions");
  let $button = $wrapper.querySelector(`[data-id="${action.id}"]`);
  if ($button) {
    return $button;
  }

  $button = document.createElement("button");
  $button.classList.add("nsm-button", "w-100", "ms-0", "mb-0");
  $button.textContent = action.text;
  $button.setAttribute("data-id", action.id);
  $button.setAttribute("title", action.text);
  $button.style.cssText = `
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  `;

  $button.addEventListener("click", (event) => {
    if (!action.url || !action.url.trim().length) return;

    if (isSelectorValid(action.url)) {
      const $element = document.querySelector(action.url);
      if ($($element).modal) {
        event.preventDefault();
        $($element).modal("show");
        return;
      }
    }

    const { prof_id, email } = window.__customermodule_customer;
    let location = `${action.url}`.replace(":customerid", prof_id);
    location = location.replace(":customeremail", email);
    // window.location = location;
    window.open(location, "_blank");
  });

  return $button;
}

function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

// https://stackoverflow.com/a/43467144/8062659
function isValidHttpUrl(string) {
  try {
    const url = new URL(string);
    return url.protocol === "http:" || url.protocol === "https:";
  } catch (_) {
    return false;
  }
}

function isSelectorValid(selector) {
  try {
    document.createDocumentFragment().querySelector(selector);
    return true;
  } catch {
    return false;
  }
}

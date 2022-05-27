import * as api from "./api.js";

export function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

export async function getCustomer() {
  if (!window.__customermodule_customer) {
    const api = await import("./api.js");
    const customer = await api.getCustomerById(getCustomerId());
    window.__customermodule_customer = customer.data;
  }

  return window.__customermodule_customer;
}

export function setupEmailTemplateModal(category) {
  const modalSelector = `emailtemplate-${category}--modal`;
  const modalTriggerSelector = modalSelector.replace("--modal", "--trigger");

  const $modal = document.getElementById(modalSelector);
  const $triggerBtn = document.getElementById(modalTriggerSelector);
  const $submitBtn = $modal.querySelector("button.primary");
  const $createLink = $modal.querySelector(".letters-loader + .d-flex");

  $triggerBtn.addEventListener("click", function () {
    $($modal).modal("show");
  });

  $($modal).on("show.bs.modal", async function () {
    // We want to keep the list updated always.
    const $body = $modal.querySelector(".modal-body");
    const $wrapper = $modal.querySelector(".letters-wrapper");
    $wrapper.innerHTML = "";
    $body.classList.add("loading");

    const $template = $modal.querySelector("template");
    const $fragment = document.createDocumentFragment();

    const { data: letters } = await api.getEmailTemplates({ category });
    letters.forEach((letter) => {
      const $copy = document.importNode($template.content, true);
      const $title = $copy.querySelector(".content-title");
      const $switch = $copy.querySelector(".form-check-input");

      if (letter.is_default == 1) {
        $switch.setAttribute("checked", true);
      }

      if (letters.length === 1) {
        $switch.setAttribute("disabled", true);
      }

      $switch.addEventListener("click", () => {
        api.setDefaultEmailTemplate({ letter_id: letter.id }, { category });
      });

      $title.textContent = letter.title;
      $switch.setAttribute("data-id", letter.id);
      $fragment.appendChild($copy.firstElementChild);
    });

    $modal.__letters = letters;
    $wrapper.appendChild($fragment);

    if ($wrapper.childElementCount) {
      $submitBtn.classList.remove("d-none");
      $createLink.classList.remove("d-none");
    } else {
      $submitBtn.classList.add("d-none");
      $createLink.classList.add("d-none");
      $wrapper.innerHTML = `
        <div class="nsm-empty" style="height: 200px;">
          <i class="bx bx-meh-blank"></i>
          <span>Your email template is empty, click <a target="_blank" href="${api.prefixURL}/EsignEditor/create">here</a> to create.</span>
        </div>
      `;
    }

    $body.classList.remove("loading");
  });

  $submitBtn.addEventListener("click", async function () {
    const $selectedSwitch = $modal.querySelector("[type=radio]:checked");
    const $callOut = $modal.querySelector(".nsm-callout");

    const customer = await getCustomer();
    const switchId = $selectedSwitch.dataset.id;
    const letter = $modal.__letters.find(({ id }) => id == switchId);

    const payload = {
      letter_id: letter.id,
      customer_id: customer.prof_id,
      customer_email: customer.email,
      letter,
    };

    const btnText = $submitBtn.textContent;
    $submitBtn.setAttribute("disabled", true);
    $submitBtn.textContent = "Sending Email...";

    const response = await api.sendWelcomeEmail(payload);
    if (response.success) {
      $callOut.textContent = `Email sent to ${customer.email}.`;
      $callOut.classList.add("success");
      $callOut.classList.remove("error");
    } else {
      $callOut.textContent = "Something went wrong sending this email.";
      $callOut.classList.add("error");
      $callOut.classList.remove("success");
    }

    $callOut.classList.remove("d-none");
    window.setTimeout(() => $callOut.classList.add("d-none"), 3500);

    $submitBtn.removeAttribute("disabled");
    $submitBtn.textContent = btnText;
  });
}

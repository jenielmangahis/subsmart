import * as api from "./api.js";
import * as common from "./common.js";

const $modal = document.getElementById("sendemailmodal");
const $triggerBtn = document.getElementById("sendWelcomeEmail");
const $submitBtn = $modal.querySelector("button.primary");

$triggerBtn.addEventListener("click", function () {
  $($modal).modal("show");
});

$submitBtn.addEventListener("click", async function () {
  const $selectedSwitch = $modal.querySelector("[type=radio]:checked");
  const $callOut = $modal.querySelector(".nsm-callout");

  const user = await common.getCustomerUser();
  const payload = {
    letter_id: $selectedSwitch.dataset.id,
    customer_id: user.id,
    customer_email: user.email,
  };

  const btnText = $submitBtn.textContent;
  $submitBtn.setAttribute("disabled", true);
  $submitBtn.textContent = "Sending Welcome Email...";

  const response = await api.sendWelcomeEmail(payload);
  if (response.success) {
    $callOut.textContent = `Welcome email sent to ${user.email}.`;
    $callOut.classList.add("success");
  } else {
    $callOut.textContent = "Something went wrong sending this email.";
    $callOut.classList.add("error");
  }

  $callOut.classList.remove("d-none");
  window.setTimeout(() => $callOut.classList.add("d-none"), 3500);

  $submitBtn.removeAttribute("disabled");
  $submitBtn.textContent = btnText;
});

$($modal).on("show.bs.modal", async function () {
  // We want to keep the list updated always.
  const $body = $modal.querySelector(".modal-body");
  const $wrapper = $modal.querySelector(".letters-wrapper");
  $wrapper.innerHTML = "";
  $body.classList.add("loading");

  const $template = $modal.querySelector("template");
  const $fragment = document.createDocumentFragment();

  const { data: letters } = await api.getEmailTemplates();
  letters.forEach((letter) => {
    const $copy = document.importNode($template.content, true);
    const $title = $copy.querySelector(".content-title");
    const $switch = $copy.querySelector(".form-check-input");

    if (letter.is_default == 1) {
      $switch.setAttribute("checked", true);
    }

    $switch.addEventListener("click", () => {
      api.setDefaultEmailTemplate({ letter_id: letter.id });
    });

    $title.textContent = letter.title;
    $switch.setAttribute("data-id", letter.id);
    $fragment.appendChild($copy.firstElementChild);
  });

  $wrapper.appendChild($fragment);

  if (!$wrapper.querySelector(".form-check-input:checked")) {
    $wrapper.querySelector(".form-check-input").checked = true;
  }

  if ($wrapper.childElementCount) {
    $submitBtn.classList.remove("d-none");
  } else {
    $submitBtn.classList.add("d-none");
    $wrapper.innerHTML = `
      <div class="nsm-empty" style="height: 200px;">
        <i class="bx bx-meh-blank"></i>
        <span>Your email template is empty, click <a target="_blank" href="${api.prefixURL}/EsignEditor/create">here</a> to create.</span>
      </div>
    `;
  }

  $body.classList.remove("loading");
});

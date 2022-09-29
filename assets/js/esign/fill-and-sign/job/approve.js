window.addEventListener("DOMContentLoaded", () => {
  const $button = document.getElementById("approveThisJob");
  const $modal = document.getElementById("approveThisJobModal");
  const $loader = $modal.querySelector(".nsm-loader");
  const $empty = $modal.querySelector(".nsm-empty");
  const $esignButton = $modal.querySelector(".approve-and-esign");

  const $esignTemplates = $modal.querySelector(".esign-templates");
  const $esignTemplatesToggle =
    $esignTemplates.querySelector(".dropdown-toggle");
  const $esignTemplatesMenu = $esignTemplates.querySelector(".dropdown-menu");

  const $approveButton = $modal.querySelector("[data-action=approve]");
  const $approveAndEsignButton = $modal.querySelector(
    "[data-action=approve-and-esign]"
  );
  const $approveAndEsignButtonLoader =
    $approveAndEsignButton.querySelector(".bx-spin");

  $button.addEventListener("click", (event) => {
    event.preventDefault();
    $($modal).modal("show");
  });

  $($modal).on("shown.bs.modal", async () => {
    const getTemplateName = (template) => {
      if (!template.is_default) return template.name;
      return `${template.name} (default)`;
    };

    const response = await fetch("/DocuSign/apiTemplates?all=true");
    const jsonData = await response.json();
    const templates = jsonData.data;

    $loader.classList.add("d-none");
    $approveAndEsignButtonLoader.classList.add("d-none");

    if (!Array.isArray(templates) || !templates.length) {
      $empty.classList.remove("d-none");
      return;
    }

    let defaultTemplate = templates.find((template) => template.is_default);
    if (!defaultTemplate) {
      defaultTemplate = templates[0];
    }

    $esignTemplatesToggle.textContent = getTemplateName(defaultTemplate);
    $esignTemplatesToggle.setAttribute("data-id", defaultTemplate.id);

    $esignButton.removeAttribute("disabled");
    $esignTemplates.classList.remove("d-none");

    templates.forEach((template) => {
      const $item = document.createElement("li");
      const $link = document.createElement("a");
      $link.classList.add("dropdown-item");
      $link.setAttribute("href", "#");
      $link.textContent = getTemplateName(template);
      $item.appendChild($link);
      $esignTemplatesMenu.appendChild($item);

      $link.addEventListener("click", (event) => {
        event.preventDefault();
        $esignTemplatesToggle.textContent = getTemplateName(template);
        $esignTemplatesToggle.setAttribute("data-id", template.id);
      });
    });
  });

  $($modal).on("hidden.bs.modal", () => {
    $loader.classList.remove("d-none");
    $approveAndEsignButtonLoader.classList.remove("d-none");

    $esignButton.setAttribute("disabled", true);
    $esignTemplates.classList.add("d-none");
    $esignTemplatesMenu.innerHTML = "";
  });

  $approveButton.addEventListener("click", () => {
    const customerId = $("#customer_id").val();

    console.log("---------------------------");
    console.log("Update job status to approve");
    console.log({ customerId });
  });

  $approveAndEsignButton.addEventListener("click", () => {
    const esignId = $esignTemplatesToggle.dataset.id;
    const customerId = $("#customer_id").val();

    console.log("---------------------------");
    console.log("Update job status to approve and redirect to esign");
    console.log({ esignId, customerId });
  });
});

window.addEventListener("DOMContentLoaded", () => {
  const $button = document.getElementById("approveThisTicket");
  const $modal = document.getElementById("approveThisTicketModal");
  const $loader = $modal.querySelector(".nsm-loader");
  const $empty = $modal.querySelector(".nsm-empty");
  const $esignButton = $modal.querySelector(".ticket-approve-and-esign");

  const $esignTemplates = $modal.querySelector("#ticket_update_status_to_omw .esign-templates");
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

    const jobStatus = $("#esignJobStatus").val();
    if (jobStatus === "Started") {
      $($modal).modal("show");
    }
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
    $esignTemplates.classList.add("d-none");
    $esignTemplatesMenu.innerHTML = "";
    disableApproveAndEsignButton();
  });

  $approveAndEsignButton.addEventListener("click", async () => {
    disableApproveAndEsignButton();    
    enableApproveAndEsignButton();

    const esignId = $esignTemplatesToggle.dataset.id;
    const customerId = $("#ticket_customer_id").val();
    const ticketId = $("input[id=esignTicketId]").val();

    const params = new URLSearchParams({
      id: esignId,
      ticket_id: ticketId,
      customer_id: customerId,
    });

    window.open(`/eSign_v2/templatePrepare?${params}`, '_blank');

  });

  function disableApproveAndEsignButton() {
    $approveAndEsignButtonLoader.classList.remove("d-none");
    $esignButton.setAttribute("disabled", true);
  }
  function enableApproveAndEsignButton() {
    $approveAndEsignButtonLoader.classList.add("d-none");
    $esignButton.removeAttribute("disabled");
  }
});

window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=addNewInvoice]");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  let errorTimeout = null;
  let hasChangedUrl = false;

  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        const response = await autoSaveForm();
        const { id } = response;
        if (!hasChangedUrl) {
          window.history.replaceState({}, "", `/invoice/invoice_edit/${id}`);
          $form.setAttribute("action",`/invoice/updateInvoice/${id}`);
          
          hasChangedUrl = true;
        }

        let $invoiceId = $form.querySelector("[name=invoiceDataID]");
        if (!$invoiceId) {
          $invoiceId = document.createElement("input");
          $invoiceId.setAttribute("type", "hidden");
          $invoiceId.setAttribute("name", "invoiceDataID");
          $invoiceId.value = id;
          $form.appendChild($invoiceId);
        }
      } catch (error) {
        if (error.toString().toLowerCase().includes("is not valid json")) {
          return;
        }
        console.error(error);
        window.clearTimeout(errorTimeout);
        FormAutoSave.toggleSavingErrorIndicator();
        errorTimeout = window.setTimeout(() => {
          FormAutoSave.toggleSavingErrorIndicator(false);
        }, 5000);
      }
    },
  });
  const form = new FormAutoSave($form, config);
  form.listen();

  window.CKEDITOR.on("instanceReady", () => {
    form.listenCKEDITOR();
  });
});

async function autoSaveForm() {
  const $form = document.querySelector("form[action$=addNewInvoice]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  let url = "/Invoice/addNewInvoice?json=1";
  if (formdata.has("invoiceDataID")) {
    url = "/invoice/updateInvoice?json=1";
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  if (response.status === 500) {
    throw new Error("500");
  }

  return response.json();
}

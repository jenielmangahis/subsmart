window.document.addEventListener("DOMContentLoaded", async () => {
  const $estimateId = document.querySelector("[name=est_id]");
  if (!$estimateId) return;

  const estimateId = $estimateId.value;
  const $form = document.querySelector(`form[action$="update/${estimateId}"]`);
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  let errorTimeout = null;

  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        await autoSaveForm();
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
  const $estimateId = document.querySelector("[name=est_id]");
  const estimateId = $estimateId.value;

  const $form = document.querySelector(`form[action$="update/${estimateId}"]`);
  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const response = await fetch(`/Estimate_v1/update/${estimateId}?json=1`, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

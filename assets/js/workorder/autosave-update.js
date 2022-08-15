window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=UpdateWorkorder]");
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
});

async function autoSaveForm() {
  const $form = document.querySelector("form[action$=UpdateWorkorder]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const response = await fetch("/workorder/UpdateWorkorder?json=1", {
    method: "post",
    body: formdata,
  });

  return response.json();
}

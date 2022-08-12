window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector(
    "form[action$=updateWorkorderAgreement]"
  );
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
        if (error.toString().includes("is not valid JSON")) {
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
  const $form = document.querySelector(
    "form[action$=updateWorkorderAgreement]"
  );

  const prefixURL = "";
  // const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const response = await fetch(
    `${prefixURL}/workorder/updateWorkorderAgreement?json=1`,
    {
      method: "post",
      body: formdata,
    }
  );

  return response.json();
}

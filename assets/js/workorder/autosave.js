window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewWorkorder]");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  const config = new FormAutoSaveConfig({
    onChange: async (field, value) => {
      console.log({ field, value });
    },
  });
  const form = new FormAutoSave($form, config);
  form.listen();
});

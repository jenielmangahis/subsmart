window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=UpdateWorkorder]");
  if (!$form) return;

  console.clear();
  console.log($form);

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  const config = new FormAutoSaveConfig({
    onChange: async (name, value) => {
      try {
        const response = await autoSaveForm();
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
  });
  const form = new FormAutoSave($form, config);
  form.listen();
});

async function autoSaveForm() {
  const $form = document.querySelector("form[action$=UpdateWorkorder]");

  const prefixURL = "";
  // const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const response = await fetch(
    `${prefixURL}/workorder/UpdateWorkorder?json=1`,
    {
      method: "post",
      body: formdata,
    }
  );

  return response.json();
}

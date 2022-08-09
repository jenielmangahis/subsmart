window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewWorkorder]");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        const response = await autoSaveForm();
        const { id } = response;

        window.history.replaceState({}, "", `/workorder/edit/${id}`);

        let $workorderId = $form.querySelector("[name=wo_id]");
        if (!$workorderId) {
          $workorderId = document.createElement("input");
          $workorderId.setAttribute("type", "hidden");
          $workorderId.setAttribute("name", "wo_id");
          $workorderId.value = id;
          $form.appendChild($workorderId);
        }
      } catch (error) {
        console.error(error);
      }
    },
  });
  const form = new FormAutoSave($form, config);
  form.listen();
});

async function autoSaveForm() {
  const $form = document.querySelector("form[action$=savenewWorkorder]");

  const prefixURL = "";
  // const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  let url = `${prefixURL}/workorder/savenewWorkorder?json=1`;
  if (formdata.has("wo_id")) {
    url = `${prefixURL}/workorder/UpdateWorkorder?json=1`;
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewWorkorder]");
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
          window.history.replaceState({}, "", `/workorder/edit/${id}`);
          $form.setAttribute("action",`/workorder/UpdateWorkorder/${id}`);
          hasChangedUrl = true;
        }

        let $workorderId = $form.querySelector("[name=wo_id]");
        if (!$workorderId) {
          $workorderId = document.createElement("input");
          $workorderId.setAttribute("type", "hidden");
          $workorderId.setAttribute("name", "wo_id");
          $workorderId.value = id;
          $form.appendChild($workorderId);
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
});

async function autoSaveForm() {
  const $form = document.querySelector("form[action$=savenewWorkorder]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  let url = "/workorder/savenewWorkorder?json=1";
  if (formdata.has("wo_id")) {
    url = "/workorder/UpdateWorkorder?json=1";
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

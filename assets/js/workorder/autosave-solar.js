window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewWorkorderSolar]");
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
          window.history.replaceState({}, "", `/workorder/editWorkorderSolar/${id}`); // prettier-ignore
          $form.setAttribute("action",`/workorder/updateWorkorderSolar/${id}`);
          hasChangedUrl = true;
        }

        $form.setAttribute("edit", true);
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
  const $form = document.querySelector("form[action$=savenewWorkorderSolar]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  let url = "/workorder/savenewWorkorderSolar?json=1";
  if ($form.hasAttribute("edit")) {
    url = "/workorder/updateWorkorderSolar?json=1";
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

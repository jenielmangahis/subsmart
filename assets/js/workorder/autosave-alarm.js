window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector(
    "form[action$=savenewWorkorderAgreement]"
  );
  if (!$form) return;

  $form.setAttribute("formautosave", "true");

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
          window.history.replaceState({}, "", `/workorder/editInstallation/${id}`); // prettier-ignore
          $form.setAttribute(
            "action",
            `/workorder/updateWorkorderAgreement/${id}`
          );
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
  const $form = document.querySelector("form[formautosave]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  let url = "/workorder/savenewWorkorderAgreement?json=1";
  if ($form.hasAttribute("edit")) {
    url = "/workorder/updateWorkorderAgreement?json=1";
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

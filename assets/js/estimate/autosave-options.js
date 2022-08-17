window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewestimateOptions]");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  let errorTimeout = null;
  let hasChangedUrl = false;

  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        const { id } = await autoSaveForm();

        if (!hasChangedUrl) {
          window.history.replaceState({}, "", `/estimate/editOption/${id}`); // prettier-ignore
          hasChangedUrl = true;
        }

        $form.setAttribute("edit", true);
        $form.setAttribute("est_id", id);
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
  const $form = document.querySelector("form[action$=savenewestimateOptions]");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const estimateId = $form.getAttribute("est_id");

  let url = "/estimate/savenewestimateOptions?json=1";
  if (estimateId !== null) {
    url = `/estimate/updateestimateOptions/${estimateId}?json=1`;
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

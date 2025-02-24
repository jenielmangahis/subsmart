window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.querySelector("form[action$=savenewestimate]");
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
        const { id } = await autoSaveForm();

        if (!hasChangedUrl) {
          window.history.replaceState({}, "", `/estimate/edit/${id}`); // prettier-ignore
          $form.setAttribute("action", `/Estimate_v1/update/${id}`);
          hasChangedUrl = true;
        }

        $form.setAttribute("edit", true);
        let $estimateId = $form.querySelector("[name=est_id]");
        if (!$estimateId) {
          $estimateId = document.createElement("input");
          $estimateId.setAttribute("type", "hidden");
          $estimateId.setAttribute("name", "est_id");
          $estimateId.value = id;
          $form.appendChild($estimateId);
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

  if (window.CKEDITOR && window.CKEDITOR) {
    const form = new FormAutoSave($form, config);
    form.listen();

    window.CKEDITOR.on("instanceReady", () => {
      form.listenCKEDITOR();
    });
  }
});

async function autoSaveForm() {
  const $form = document.querySelector("form[formautosave]");

  const formdata = new FormData($form);
  const estimateId = formdata.get("est_id");
  formdata.append("action", "submit");

  let url = "/Estimate_v1/savenewestimate?json=1";
  if (estimateId !== null) {
    url = `/Estimate_v1/update/${estimateId}?json=1`;
  }

  const response = await fetch(url, {
    method: "post",
    body: formdata,
  });

  return response.json();
}

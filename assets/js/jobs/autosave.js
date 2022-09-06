window.document.addEventListener("DOMContentLoaded", async () => {
  const $form = document.getElementById("jobs_form");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "../customer/add_advance/FormAutoSave.js"
  );

  let errorTimeout = null;
  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        const { id } = await autoSaveForm();

        let $jobId = $form.querySelector("[name=jobs_id]");
        if (!$jobId) {
          $jobId = document.createElement("input");
          $jobId.setAttribute("type", "hidden");
          $jobId.setAttribute("name", "jobs_id");
          $form.appendChild($jobId);
        }

        $jobId.value = id;
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
  const $form = document.getElementById("jobs_form");

  const formdata = new FormData($form);
  formdata.append("action", "submit");

  const response = await fetch("/job/save_job?json=1", {
    method: "post",
    body: formdata,
  });

  if (response.status === 500) {
    throw new Error("500");
  }

  return response.json();
}

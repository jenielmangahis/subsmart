window.document.addEventListener("DOMContentLoaded", async () => {
  import("./BillingInfo.js");
  import("./SubscriptionPayPlan.js");
  import("./OfficeUseInfo.js");
  import("./AccessInfo.js");
  import("./EmergencyContacts.js");
  import("./CustomerProfle.js");
  import("./FundingInfo.js");
  import("./AlarmInfo.js");

  import("./Header.js");
  import("../components/FieldCustomName.js");

  const selects = document.querySelectorAll("select[data-value]");
  selects.forEach(($select) => {
    if ($select.dataset.value.trim().length) {
      $($select).val($select.dataset.value).trigger("change");
    }
  });

  const $form = document.getElementById("customer_form");
  if ($form) {
    const { FormAutoSave, FormAutoSaveConfig } = await import(
      "./FormAutoSave.js"
    );

    const config = new FormAutoSaveConfig();
    const autoSave = new FormAutoSave($form, config);
    autoSave.listen();
  }
});

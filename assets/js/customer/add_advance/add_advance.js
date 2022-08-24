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

    const $profileId = $form.querySelector("[name=prof_id]");
    const config = new FormAutoSaveConfig({
      onChange: async () => {
        try {
          const response = await autoSaveForm();
          const { profile_id } = response;

          $profileId.value = profile_id;
          window.history.replaceState({}, "", `/customer/add_advance/${profile_id}`); // prettier-ignore

          let $customerId = $form.querySelector("[name=customer_id]");
          if (!$customerId) {
            $customerId = document.createElement("input");
            $customerId.setAttribute("type", "hidden");
            $customerId.setAttribute("name", "customer_id");
            $customerId.value = profile_id;
            $form.appendChild($customerId);
          }
        } catch (error) {
          console.error(error);
        }
      },
    });

    const form = new FormAutoSave($form, config);
    form.listen();
  }
});

async function autoSaveForm() {
  const $form = $("#customer_form");

  const formArray = $form.serializeArray();
  const payload = {};
  formArray.forEach(({ name, value }) => (payload[name] = value));

  const prefixURL = "";
  // const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const duplicateResp = await fetch(
    `${prefixURL}/Customer_Form/apiCheckDuplicate`,
    {
      method: "post",
      body: JSON.stringify(payload),
      headers: {
        accept: "application/json",
        "content-type": "application/json",
      },
    }
  );

  const duplicateRespJson = await duplicateResp.json();
  if (duplicateRespJson.data && duplicateRespJson.message) {
    return;
  }

  const saveResp = await fetch(`${prefixURL}/Customer/save_customer_profile`, {
    method: "post",
    body: new FormData($form.get(0)),
  });

  return saveResp.json();
}

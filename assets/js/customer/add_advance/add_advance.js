window.document.addEventListener("DOMContentLoaded", () => {
  import("./BillingInfo.js");
  import("./SubscriptionPayPlan.js");
  import("./OfficeUseInfo.js");
  import("./AccessInfo.js");
  import("./EmergencyContacts.js");
  import("./CustomerProfle.js");
  import("./FundingInfo.js");
  import("./AlarmInfo.js");

  import("./Header.js");

  const selects = document.querySelectorAll("select[data-value]");
  selects.forEach(($select) => {
    if ($select.dataset.value.trim().length) {
      $($select).val($select.dataset.value).trigger("change");
    }
  });
});

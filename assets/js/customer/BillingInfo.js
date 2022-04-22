import * as api from "./api.js";

const $addressToggle = document.getElementById("use_customer_address");
const $customerInputs = document.querySelectorAll("[data-type^='customer_address']"); // prettier-ignore
const $addressInputs = document.querySelectorAll("[data-type^='billing_address']"); // prettier-ignore

function getAddressKey($input) {
  return $input.dataset.type.split("_").at(-1);
}

function autopopulateBillingAddress($customerInput) {
  const key = getAddressKey($customerInput);
  const $billingInput = [...$addressInputs].find(($input) => {
    return getAddressKey($input) === key;
  });

  if ($billingInput) {
    $billingInput.value = $customerInput.value;
  }

  return $billingInput;
}

$addressToggle.addEventListener("change", function () {
  if (!this.checked) {
    $addressInputs.forEach(($input) => {
      $input.removeAttribute("readonly", true);
    });
    return;
  }

  $customerInputs.forEach(($input) => {
    const $billingInput = autopopulateBillingAddress($input);
    if ($billingInput) {
      $billingInput.setAttribute("readonly", true);
    }
  });
});

$customerInputs.forEach(($input) => {
  $input.addEventListener("input", function () {
    if (!$addressToggle.checked) return;
    autopopulateBillingAddress(this);
  });
});

const $ratePlan = document.querySelector("[data-type=billing_rate_plan]");
$($ratePlan).select2({
  placeholder: "Select Rate Plan",
  ajax: {
    url: `${api.prefixURL}/Customer_Form/apiGetRatePlans`,
    dataType: "json",
    data: (params) => {
      return { search: params.term };
    },
    processResults: (response) => {
      return {
        results: response.data.map((item) => ({
          id: item.amount,
          text: item.amount,
        })),
      };
    },
  },
});
if ($ratePlan.dataset.value) {
  $($ratePlan).val($ratePlan.dataset.value).trigger("change");
}

const $contractTerm = document.querySelector("[data-type=billing_contract_term]"); // prettier-ignore
const $startDate = document.querySelector("[data-type=billing_start_date]");
const $endDate = document.querySelector("[data-type=billing_end_date]");
$($contractTerm).on("change", function () {
  const billingStart = moment().add(Number(this.value), "months");
  const billingEnd = billingStart.clone().add(Number(this.value), "months");
  $($startDate).datepicker("setDate", billingStart.toDate());
  $($endDate).datepicker("setDate", billingEnd.toDate());
});

const $subStartDate = document.querySelector("[data-type=subscription_start_date]"); // prettier-ignore
$($startDate)
  .datepicker()
  .on("changeDate", function () {
    const date = moment(this.value).subtract(1, "months");
    $($subStartDate).datepicker("setDate", date.toDate());
  });

const $subEndDate = document.querySelector("[data-type=subscription_end_date]"); // prettier-ignore
$($endDate)
  .datepicker()
  .on("changeDate", function () {
    const date = moment(this.value).subtract(1, "months");
    $($subEndDate).datepicker("setDate", date.toDate());
  });

const $monthDay = document.querySelector("[data-type=billing_month_day]");
$($monthDay).on("change", function () {
  if ($subStartDate.value) {
    const start = moment($subStartDate.value).set("date", this.value);
    $($subStartDate).datepicker("setDate", start.toDate());
  }

  if ($subEndDate.value) {
    const end = moment($subEndDate.value).set("date", this.value);
    $($subEndDate).datepicker("setDate", end.toDate());
  }
});

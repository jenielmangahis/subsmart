const $billingFrequency = document.querySelector("[data-type=billing_frequency]"); // prettier-ignore
const $frequency = document.querySelector("[data-type=subscription_frequency]"); // prettier-ignore

$($billingFrequency).on("change", function () {
  const $options = $frequency.querySelectorAll("option");
  const $option = [...$options].find(($currOption) => {
    return $currOption.textContent.trim() === this.value;
  });

  $($frequency).val($option.getAttribute("value")).trigger("change");
});

const $billingRatePlan = document.querySelector("[data-type=billing_rate_plan]"); // prettier-ignore
const $amount = document.querySelector("[data-type=subscription_amount]");
$($billingRatePlan).on("change", function () {
  $amount.value = this.value;
});

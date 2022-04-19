const $billingFrequency = document.querySelector("[data-type=billing_frequency]"); // prettier-ignore
const $frequency = document.querySelector("[data-type=subscription_frequency]"); // prettier-ignore

$($billingFrequency).on("change", function () {
  const $options = $frequency.querySelectorAll("option");
  const $option = [...$options].find(($currOption) => {
    return $currOption.textContent.trim() === this.value;
  });

  $($frequency).val($option.getAttribute("value")).trigger("change");
});

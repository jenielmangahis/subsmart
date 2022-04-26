import * as api from "./api.js";

const $actFee = document.querySelector("[data-type=funding_info_activation_fee]"); // prettier-ignore
$($actFee).select2({
  placeholder: "Select Activation Fee",
  ajax: {
    url: `${api.prefixURL}/Customer_Form/apiGetActivationFees`,
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
if ($actFee.dataset.value) {
  $($actFee).val($actFee.dataset.value).trigger("change");
}

import * as api from "./api.js";

const $systemType = document.querySelector("[data-type=alarm_info_system_type]"); // prettier-ignore
$($systemType).select2({
  placeholder: "Select Account Type",
  ajax: {
    url: `${api.prefixURL}/Customer_Form/apiGetSystemPackages`,
    dataType: "json",
    data: (params) => {
      return { search: params.term };
    },
    processResults: (response) => {
      return {
        results: response.data.map((item) => ({
          id: item.name,
          text: item.name,
        })),
      };
    },
  },
});
if ($systemType.dataset.value) {
  $($systemType).val($systemType.dataset.value).trigger("change");
}

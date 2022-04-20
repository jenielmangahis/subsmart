import * as api from "./api.js";

const $salesArea = document.querySelector("[data-type=customer_sales_area]");
$($salesArea).select2({
  placeholder: "Select Sales Area",
  ajax: {
    url: `${api.prefixURL}/Customer_Form/apiGetSalesArea`,
    dataType: "json",
    data: (params) => {
      return { search: params.term };
    },
    processResults: (response) => {
      return {
        results: response.data.map((item) => ({
          id: item.sa_id,
          text: item.sa_name,
        })),
      };
    },
  },
});

if ($salesArea.dataset.value) {
  $($salesArea).val($salesArea.dataset.value).trigger("change");
}

import * as api from "./api.js";

const $salesArea = document.querySelector("[data-type=customer_sales_area]");
$($salesArea).select2({
  placeholder: "Select Sales Area",
  ajax: {
    url: base_url + `Customer_Form/apiGetSalesAreas`,
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

const $installCode = document.querySelector("[data-type=install_code]");
$($installCode).select2({
  placeholder: "Select Installer Code",
  ajax: {
    url: base_url + `autocomplete/_company_installer_codes`,
    dataType: "json",
    data: (params) => {
      return { search: params.term };
    },
    processResults: (response) => {
      return {
        results: response.map((item) => ({
          id: item.code,
          text: item.code,
        })),
      };
    },
  },
});

if ($installCode.dataset.value) {
  $($installCode).val($installCode.dataset.value).trigger("change");
}

// birthday input
const $birthday = document.querySelector("[data-type=customer_birthday]");
$($birthday).birthdaypicker({
  defaultDate: $birthday.dataset.value ? $birthday.dataset.value : false,
});

const $birthdayInput = $($birthday).find("[type=hidden]");
$birthdayInput.get(0).setAttribute("name", "date_of_birth");

const $birthdaySelects = $($birthday).find("select");
$birthdaySelects.addClass("form-control");
// end birthday input

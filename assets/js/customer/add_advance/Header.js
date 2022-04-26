const checkboxes = document.querySelectorAll("[data-type=header_date_checkbox]"); // prettier-ignore
checkboxes.forEach(($checkbox) => {
  $checkbox.addEventListener("change", function () {
    const $parent = this.closest(".table_body_customer");
    const $datePicker = $parent.querySelector("[data-type=header_date_input]");
    $($datePicker).datepicker("setDate", this.checked ? new Date() : null);
  });
});

const $datePickers = document.querySelectorAll("[data-type=header_date_input]");
$($datePickers).datepicker({});

const $dateInputs = document.querySelectorAll("[data-type$=_date]");
$($dateInputs).datepicker({ dateFormat: "dd/mm/yy" });

const $profileStatus = document.querySelector("[data-type=customer_status]");
const $optional = document.querySelector(".office_info-optional");
$($profileStatus).on("change", function () {
  const willHide = [
    "Draft",
    "Installed",
    "Active",
    "Lead",
    "Scheduled",
    "Service Customer",
  ];

  if (willHide.includes(this.value)) {
    $optional.classList.add("d-none");
    const $inputs = $optional.querySelectorAll("input, select");
    $inputs.forEach(($input) => {
      $input.value = "";

      if ($input.classList.contains("select2-hidden-accessible")) {
        $($input).val("").trigger("change");
      }
    });
  } else {
    $optional.classList.remove("d-none");
  }
});

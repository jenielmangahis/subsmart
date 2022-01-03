window.addEventListener("DOMContentLoaded", async () => {
  const { ReportsTable } = await import("./ReportsTable.js");

  new ReportsTable($("#reportsTable"));

  const $nonZeroActiveOnly = document.getElementById("nonZeroActiveOnly");
  const $nonZeroActiveOnlyBtn = $nonZeroActiveOnly.querySelector(
    ".nonZeroActiveOnly__btn"
  );
  $nonZeroActiveOnlyBtn.addEventListener("click", (event) => {
    event.preventDefault();
    $nonZeroActiveOnly.classList.toggle("nonZeroActiveOnly--open");
  });

  document.addEventListener("click", (event) => {
    if (!$nonZeroActiveOnly.contains(event.target)) {
      $nonZeroActiveOnly.classList.remove("nonZeroActiveOnly--open");
    }
  });
});

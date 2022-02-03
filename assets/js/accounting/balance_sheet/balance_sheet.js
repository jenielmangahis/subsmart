window.addEventListener("DOMContentLoaded", async () => {
  const $customDropdown = $(".customDropdown__btn");
  $customDropdown.on("click", (event) => {
    const $btn = $(event.currentTarget);
    const $parent = $btn.closest(".customDropdown");

    if ($parent.hasClass("open")) {
      $parent.removeClass("open");
    } else {
      $parent.addClass("open");
    }
  });

  $("[name=nonZeroActiveOnlyRows], [name=nonZeroActiveOnlyColumns]") //
    .on("change", function (event) {
      const $target = $(event.target);
      const $parent = $target.closest(".customDropdown");
      const $button = $parent.find("button");
      const $rowChecked = $parent.find("[name=nonZeroActiveOnlyRows]:checked");
      const $colChecked = $parent.find(
        "[name=nonZeroActiveOnlyColumns]:checked"
      );

      const rowValue = $rowChecked.val();
      const colValue = $colChecked.val();
      const rowValueCapitalized = capitalize(rowValue.split("_").join(" "));
      const colValueCapitalized = capitalize(colValue.split("_").join(" "));

      $button.text(`${rowValueCapitalized}/${colValueCapitalized}`);
      $button.val(`${rowValue}/${colValue}`);
    });

  document.addEventListener("click", async (event) => {
    if (!$(event.target).closest(".customDropdown").length) {
      $(".customDropdown").removeClass("open");
    }
  });
});

function capitalize(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

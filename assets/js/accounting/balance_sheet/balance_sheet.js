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

  const $customizeReport = $(".customizeReport");
  $("[data-action=customize_toggle]").on("click", () => {
    $customizeReport.addClass("customizeReport--show");
    $customizeReport.find(".collapse").first().collapse("show");
    $(".popover").popover("hide");
  });
  $("[data-action=customize_hide], .customizeReport__backdrop") //
    .on("click", () => {
      $customizeReport.removeClass("customizeReport--show");
      $customizeReport.find(".collapse").collapse("hide");
    });

  const $saveCustomizationBtn = $("[data-action=save_customization]");
  const $saveCustomizationForm = $("#saveCustomizationForm");
  const saveCustomizationForm = $saveCustomizationForm.html();
  $saveCustomizationForm.remove();
  $saveCustomizationBtn.popover({
    html: true,
    sanitize: false,
    placement: "bottom",
    content: saveCustomizationForm,
  });

  $editTitleBtn = $("[data-action=editTitle]");
  $editTitleBtn.on("click", () => {
    $("#editTitleModal").modal("show");
  });
});

function capitalize(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

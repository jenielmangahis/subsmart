(($) => {
  const $inputs = $(".email-input-element");
  $inputs.on("input", (event) => {
    const valueLower = event.target.value.toLowerCase();

    if (/@[^g]mail\.com$/i.test(valueLower)) {
      const $input = $(event.target);

      if ($input.hasClass("email-input-element-warn-shown")) {
        return;
      }

      $input.addClass("email-input-element-warn-shown");
      $(event.target).after(
        '<small class="form-text text-muted email-input-element-warn">Did you mean @gmail.com?</small>'
      );
    } else {
      $(event.target).removeClass("email-input-element-warn-shown");
      $(event.target).next(".email-input-element-warn").remove();
    }
  });
})(jQuery);

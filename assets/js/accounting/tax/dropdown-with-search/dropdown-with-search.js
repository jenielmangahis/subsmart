class Accounting__DropdownWithSearch {
  constructor(element, options) {
    this.$element = $(element);
    this.options = options;

    this.createOptions();
    this.attachEventListeners();
  }

  createOptions() {
    if (this.$element.find(".dropdownWithSearch__options").length > 0) {
      return;
    }

    let optionItems = this.options.map((option) => this.createOption(option));
    optionItems = optionItems.join("");
    const html = `<ul class="dropdownWithSearch__options">${optionItems}</ul>`;
    this.$element.append(this.createElementFromHTML(html));
  }

  createOption(option) {
    if (this.isString(option)) {
      return `
        <li class="dropdownWithSearch__optionsItem" data-value="${option}">
          <span>${option}</span>
        </li>
      `;
    }

    if (!option.hasOwnProperty("text")) {
      return;
    }

    const { text, right_text, sub_texts } = option;
    const $item = this.createElementFromHTML(this.createOption(text));

    if (this.isString(right_text)) {
      $item.append(`<span>${right_text}</span>`);
    }

    if (!Array.isArray(sub_texts)) {
      return $item.prop("outerHTML");
    }

    const $subTexts = sub_texts.map((subText) => {
      const subOption = this.createOption({ text: subText, right_text });
      const $subOption = this.createElementFromHTML(subOption);

      $subOption.addClass("dropdownWithSearch__optionsItem--sub");
      $subOption.attr("data-value", `${text}:${subText}`);
      return $subOption;
    });

    $item.append($subTexts);
    return $item.prop("outerHTML");
  }

  attachEventListeners() {
    // clicking button will show options
    const $button = this.$element.find(".dropdownWithSearch__btn");
    $button.on("click", () => this.showOptions());

    const $optionList = this.$element.find(".dropdownWithSearch__options");
    $optionList.on("click", (event) => {
      let $target = $(event.target);

      if (!$target.hasClass("dropdownWithSearch__optionsItem")) {
        $target = $target.parent(".dropdownWithSearch__optionsItem");
      }

      if ($target.hasClass("dropdownWithSearch__optionsItem")) {
        this.$element.find("input").val($target.attr("data-value"));
        this.hideOptions();
      }
    });

    // clicking outside will hide options
    $(window).on("click", (event) => {
      if (this.$element.has(event.target).length === 0) {
        this.hideOptions();
      }
    });

    // filtering option
    const $input = this.$element.find(".dropdownWithSearch__input");
    const $options = this.$element.find(".dropdownWithSearch__optionsItem");
    $input.on("input", (event) => {
      const filter = event.target.value.toUpperCase();
      let hasMatch = false;

      $options.each((_, element) => {
        const $option = $(element);
        const value = $option.attr("data-value");
        const isMatch = value.toUpperCase().indexOf(filter) > -1;
        hasMatch = hasMatch ? hasMatch : isMatch;
        $option.css({ display: isMatch ? "flex" : "none" });
      });

      if (hasMatch) {
        this.showOptions();
      } else {
        this.hideOptions();
      }
    });
  }

  showOptions() {
    this.$element.addClass("dropdownWithSearch--optionsShown");
  }

  hideOptions() {
    this.$element.removeClass("dropdownWithSearch--optionsShown");
    const $options = this.$element.find(".dropdownWithSearch__optionsItem");
    $options.css({ display: "flex" });
  }

  // https://stackoverflow.com/a/494348/8062659
  createElementFromHTML(htmlString) {
    const div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    return $(div.firstChild);
  }

  isString(value) {
    return typeof value === "string" || value instanceof String;
  }
}

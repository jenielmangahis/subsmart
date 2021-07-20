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

    let optionItems = this.options.map((option) => {
      return `<li class="dropdownWithSearch__optionsItem" data-value="${option}">${option}</li>`;
    });

    optionItems = optionItems.join("");
    const html = `<ul class="dropdownWithSearch__options">${optionItems}</ul>`;
    this.$element.append(this.createElementFromHTML(html));

    const $options = this.$element.find(".dropdownWithSearch__options");
    $options.on("click", (event) => {
      const $target = $(event.target);
      if ($target.hasClass("dropdownWithSearch__optionsItem")) {
        this.$element.find("input").val($target.attr("data-value"));
        this.hideOptions();
      }
    });
  }

  attachEventListeners() {
    // clicking button will show options
    const $button = this.$element.find(".dropdownWithSearch__btn");
    $button.on("click", () => this.showOptions());

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
        $option.css({ display: isMatch ? "block" : "none" });
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
    $options.css({ display: "block" });
  }

  // https://stackoverflow.com/a/494348/8062659
  createElementFromHTML(htmlString) {
    const div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    return $(div.firstChild);
  }
}

(async function () {
  const data = [
    "August 2020",
    "September 2020",
    "October 2020",
    "November 2020",
    "December 2020",
    "January 2021",
    "February 2021",
    "March 2021",
    "April 2021",
    "May 2021",
    "June 2021",
    "July 2021",
  ];

  $(".dropdownWithSearch").each((_, element) => {
    new Accounting__DropdownWithSearch(element, data);
  });
})();

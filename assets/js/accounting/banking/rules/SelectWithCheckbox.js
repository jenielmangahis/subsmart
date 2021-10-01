export class SelectWithCheckbox {
  constructor($root) {
    this.$root = $root;
    this.$button = $root.querySelector(".selectWithCheckbox__btn");
    this.$text = $root.querySelector(".selectWithCheckbox__text");
    this.$options = $root.querySelector(".selectWithCheckbox__options");

    this.attachEventListeners();
  }

  set onSelect(func) {
    this.userOnSelect = func;
  }

  attachEventListeners() {
    this.$button.addEventListener("click", () => {
      this.toggleOptions();
    });

    document.body.addEventListener("click", (event) => {
      if (!this.$root.contains(event.target)) {
        this.closeOptions();
      }
    });

    const $checkboxes = this.$root.querySelectorAll("[type=checkbox]");
    [...$checkboxes].forEach(($checkbox) => {
      $checkbox.addEventListener("change", (event) => {
        if (this.userOnSelect) {
          this.userOnSelect(event);
        }
      });
    });
  }

  toggleOptions() {
    if (!this.isOptionsOpen()) {
      this.openOptions();
    } else {
      this.closeOptions();
    }
  }

  isOptionsOpen() {
    return this.$root.classList.contains("selectWithCheckbox--active");
  }

  openOptions() {
    this.$root.classList.add("selectWithCheckbox--active");
  }

  closeOptions() {
    this.$root.classList.remove("selectWithCheckbox--active");
  }
}

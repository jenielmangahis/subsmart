export class FormAutoSaveConfig {
  onChange = null;

  constructor(args = {}) {
    Object.keys(args).forEach((key) => {
      if (this.hasOwnProperty(key)) {
        this[key] = args[key];
      }
    });
  }
}

export class FormAutoSave {
  CHANGING_TIMEOUT = 500; // ms

  $form = null;
  config = null;

  inputs = [];
  inputTimeouts = {};

  /**
   *
   * @param {HTMLFormElement} $form
   * @param {FormAutoSaveConfig} config
   */
  constructor($form, config) {
    this.$form = $form;
    this.config = config;

    this.inputs = $form.querySelectorAll("input,textarea,select");
    this.onChange = this.onChange.bind(this);
    this.setInputListener = this.setInputListener.bind(this);
  }

  listen() {
    this.seInputListeners();
  }

  seInputListeners() {
    this.inputs.forEach(this.setInputListener);
  }

  setInputListener($input) {
    // if (!this.$form.checkValidity()) return;
    if (!$input.name || !$input.name.length) return;

    if (
      $input.classList.contains("timepicker") &&
      $.isFunction($().timepicker)
    ) {
      $($input).timepicker().on("changeTime.timepicker", this.onChange);
      return;
    }

    if (
      $input.classList.contains("date_picker") &&
      $.isFunction($().datepicker)
    ) {
      $($input).datepicker().on("changeDate", this.onChange);
      return;
    }

    if (this.isTextBox($input)) {
      if ($input.hasAttribute("type")) {
        const inputType = $input.getAttribute("type").toLowerCase();
        if (inputType === "date") {
          $input.addEventListener("change", this.onChange);
          return;
        }
      }

      $input.addEventListener("keyup", this.onChange);
      return;
    }

    $input.addEventListener("change", this.onChange);
    // $input.addEventListener("input", this.onChange);

    if (this.isSelect($input)) {
      $($input).on("select2:select", this.onChange);
    }
  }

  onChange(event) {
    const $input = event.target;
    let { name, value } = $input;

    if (!name || !name.length) return;
    if (!value || !value.length) return;

    value = this.isCheckbox($input) ? $input.checked : value;
    const timeout = this.inputTimeouts[name];

    if ($input.getAttribute("type") === "file") {
      value = $input.hasAttribute("multiple") ? $input.files : $input.files[0];
    }

    const _onDoneChanging = () => {
      this.onDoneChanging({ name, value });
    };

    if (timeout) {
      clearTimeout(timeout);
    }

    if (!value.length || !this.isTextBox($input)) {
      _onDoneChanging();
      return;
    }

    this.inputTimeouts[name] = setTimeout(
      _onDoneChanging,
      this.CHANGING_TIMEOUT
    );
  }

  async onDoneChanging({ name, value }) {
    if (typeof this.config.onChange !== "function") {
      return;
    }

    try {
      FormAutoSave.toggleSavingIndicator();
      await this.config.onChange(name, value);
    } finally {
      FormAutoSave.toggleSavingIndicator(false);
    }
  }

  static toggleSavingIndicator(show = true) {
    const id = "formautosavemessage";
    let $div = document.getElementById(id);

    if (!$div) {
      $div = FormAutoSave.createIndicatorElement();
      $div.textContent = "Saving...";
      $div.setAttribute("id", id);
      document.body.appendChild($div);
    }

    $div.style.display = show ? "flex" : "none";
  }

  static createIndicatorElement() {
    const $div = document.createElement("div");
    $div.style.cssText = `
      --height: 25px;

      position: fixed;
      bottom: 1rem;
      right: 1rem;

      padding-left: 10px;
      padding-right: 1rem;
      height: var(--height);
      border-radius: var(--height);
      box-sizing: border-box;
      align-items: center;

      background-color: rgb(230 230 230);
      z-index: 999;
    `;

    return $div;
  }

  static toggleSavingErrorIndicator(show = true) {
    const id = "formautosavemessage--error";
    let $div = document.getElementById(id);

    if (!$div) {
      $div = FormAutoSave.createIndicatorElement();
      $div.textContent = "Saving failed, something went wrong.";
      $div.setAttribute("id", id);

      $div.style.backgroundColor = "#e3778f47";
      $div.style.color = "#dc3545";

      document.body.appendChild($div);
    }

    $div.style.display = show ? "flex" : "none";
  }

  // https://stackoverflow.com/a/38795917/8062659
  isTextBox($element) {
    const tagName = $element.tagName.toLowerCase();
    if (tagName === "textarea") return true;
    if (tagName !== "input") return false;

    const inputTypes = [
      "text",
      "password",
      "number",
      "email",
      "tel",
      "url",
      "search",
      "date",
      "datetime",
      "datetime-local",
      "time",
      "month",
      "week",
    ];

    const type = $element.getAttribute("type").toLowerCase();
    return inputTypes.indexOf(type) >= 0;
  }

  isCheckbox($element) {
    return (
      $element instanceof HTMLInputElement &&
      $element.getAttribute("type") == "checkbox"
    );
  }

  isSelect($element) {
    return (
      $element instanceof HTMLSelectElement &&
      $element.tagName.toLowerCase() === "select"
    );
  }
}

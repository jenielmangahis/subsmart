export class FormAutoSaveConfig {}

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
    if (!$input.name || !$input.name.length) return;

    // TODO: handle timepicker

    if (this.isTextBox($input)) {
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

  onDoneChanging({ name, value }) {
    console.log({ name, value });
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

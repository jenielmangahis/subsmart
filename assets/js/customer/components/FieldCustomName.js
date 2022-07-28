const PREFIX_URL = location.hostname === "localhost" ? "/nsmartrac" : "";
const CUSTOM_EVENT_NAME = "formfieldcustomnamesready";

(() => {
  const $link = document.createElement("link");
  $link.href = `${PREFIX_URL}/assets/plugins/font-awesome/css/font-awesome.min.css`;
  $link.type = "text/css";
  $link.rel = "stylesheet";

  document.querySelector("head").appendChild($link);
})();

const $template = document.createElement("template");
$template.innerHTML = `
<link rel="stylesheet" href="${PREFIX_URL}/assets/plugins/font-awesome/css/font-awesome.min.css">

<style>
:host {
  display: inline-block;
}

.form {
    display: flex;
    align-items: center;
}

.btn {
    --size: 30px;

    outline: 0;
    border: 0;
    padding: 0;
    width: var(--size);
    min-width: var(--size);
    height: var(--size);
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-color: transparent;
    opacity: 0;
    visibility: hidden;
}

.hide {
    display: none !important;
}

.input {
    display: none;
    width: 100%;
    box-sizing: border-box;
    font-family: inherit;
}

:host(.editing) .input {
    display: block;
}
:host(.editing) .text {
    display: none;
}

:host(:not([readonly]):hover) .btn,
:host(.editing) .btn {
  opacity: 1;
  visibility: visible;
}
</style>

<form class="form">
    <div>
        <span class="text"></span>
        <input class="input" required />
    </div>

    <button class="btn hide" type="button" title="Rename label">
        <i class="fa fa-pencil"></i>
    </button>
</form>
`;

class FieldCustomName extends HTMLElement {
  static get observedAttributes() {
    return ["default"];
  }

  get text() {
    return this.__text;
  }

  set text(value) {
    this.__text = value.trim();
    this.$text.textContent = this.__text;
    this.$input.value = this.__text;
  }

  get isSaving() {
    return this.__isSaving;
  }

  set isSaving(value) {
    this.__isSaving = value;

    if (value === true) {
      this.setAttribute("title", "Saving...");
      this.$input.setAttribute("disabled", true);
      this.$btn.setAttribute("disabled", true);
    } else {
      this.removeAttribute("title");
      this.$input.removeAttribute("disabled");
      this.$btn.removeAttribute("disabled");
    }
  }

  get form() {
    return this.getAttribute("form").trim();
  }

  get defaultName() {
    return this.getAttribute("default").trim();
  }

  constructor() {
    super();

    const shadowRoot = this.attachShadow({ mode: "open" });
    shadowRoot.appendChild($template.content.cloneNode(true));

    this.$form = this.shadowRoot.querySelector(".form");
    this.$text = this.$form.querySelector(".text");
    this.$input = this.$form.querySelector(".input");
    this.$btn = this.$form.querySelector(".btn");
    this.$btnIcon = this.$btn.querySelector("i");

    this.onClickButton = this.onClickButton.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
    this.onNamesReady = this.onNamesReady.bind(this);
    this.onKeyDown = this.onKeyDown.bind(this);
  }

  attributeChangedCallback(name) {
    if (name === "default") {
      this.text = this.defaultName;
    }
  }

  async connectedCallback() {
    this.$btn.addEventListener("click", this.onClickButton);
    this.$form.addEventListener("submit", this.onSubmit);
    this.$input.addEventListener("keydown", this.onKeyDown);
    window.addEventListener(CUSTOM_EVENT_NAME, this.onNamesReady);
  }

  disconnectedCallback() {
    this.$btn.removeEventListener("click", this.onClickButton);
    this.$form.removeEventListener("submit", this.onSubmit);
    this.$input.removeEventListener("keydown", this.onKeyDown);
    window.removeEventListener(CUSTOM_EVENT_NAME, this.onNamesReady);
  }

  onNamesReady(event) {
    const names = event.detail;
    const customName = names.find((name) => {
      return name.form === this.form && name.default_name === this.defaultName;
    });

    this.text = customName ? customName.name : this.defaultName;
    this.$input.setAttribute("placeholder", this.defaultName);

    if (customName && customName.is_hidden == 1) {
      const $parent = this.closest(".field-custom-name-container");
      if ($parent) {
        $parent.remove();
      }
    }

    if (!this.hasAttribute("readonly")) {
      this.$btn.classList.remove("hide");
    }
  }

  onChangeDataDefault() {
    this.text = this.dataset.text;
  }

  onClickButton(event) {
    if (this.classList.contains("editing")) {
      this.onSubmit(event);
    } else {
      this.onEdit();
    }
  }

  onEdit() {
    const inputMinWidth = 150;
    const textWidth = this.$text.offsetWidth + 24;

    this.$input.style.width = `${textWidth}px`;
    if (textWidth <= inputMinWidth) {
      this.$input.style.minWidth = `${inputMinWidth}px`;
    }

    this.classList.add("editing");
    this.$btnIcon.setAttribute("class", "fa fa-check");

    this.$input.value = this.text;
    this.$input.focus();
  }

  onKeyDown(event) {
    if (event.key === "Escape") {
      this.classList.remove("editing");
      this.$btnIcon.setAttribute("class", "fa fa-pencil");
    }
  }

  async onSubmit(event) {
    event.preventDefault();

    const value = this.$input.value.trim();
    if (!value.length) {
      this.$input.focus();
      return;
    }

    if (this.isSaving) return;

    this.isSaving = true;
    const response = await this.saveName();
    this.text = response.data.name;

    this.isSaving = false;
    this.classList.remove("editing");
    this.$btnIcon.setAttribute("class", "fa fa-pencil");
  }

  async saveName() {
    const payload = {
      form: this.form,
      default: this.defaultName,
      name: this.$input.value.trim(),
    };

    const endpoint = `${PREFIX_URL}/Customer_Form/apiSaveFormFieldCustomName`;
    const response = await fetch(endpoint, {
      body: JSON.stringify(payload),
      method: "post",
      headers: {
        accept: "application/json",
        "content-type": "application/json",
      },
    });
    return response.json();
  }
}

async function fetchNames() {
  if (window.__formFieldCustomNames_isLoading === true) {
    return null;
  }

  if (Array.isArray(window.__formFieldCustomNames)) {
    return window.__formFieldCustomNames;
  }

  window.__formFieldCustomNames_isLoading = true;
  const endpoint = `${PREFIX_URL}/Customer_Form/apiGetFormFieldCustomNames`;

  const response = await fetch(endpoint);
  const json = await response.json();

  window.__formFieldCustomNames = json.data;
  window.__formFieldCustomNames_isLoading = false;

  return window.__formFieldCustomNames;
}

try {
  window.customElements.define("field-custom-name", FieldCustomName);
  fetchNames().then((names) => {
    const event = new CustomEvent(CUSTOM_EVENT_NAME, { detail: names });
    window.dispatchEvent(event);
  });
} catch (error) {}

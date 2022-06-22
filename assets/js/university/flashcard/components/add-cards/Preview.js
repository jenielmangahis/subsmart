const $template = document.createElement("template");
$template.innerHTML = `
<style>
:host {
  display: block;
  cursor: pointer;
}

.root {
  width: 100%;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 9px;
  color: #5d5d5d;
  display: flex;
  flex: 1;
  flex-direction: column;
  justify-content: center;
  box-sizing: border-box;
}

.question {
  font-weight: 600;
  border-bottom: 4px solid #f5f5f5;
  box-sizing: border-box;
}

.question,
.answer {
  padding: 1rem;
  box-sizing: border-box;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

:host(.active) .root {
  border-color: #6a4a86;
  border-width: 2px;
}
</style>

<div class="root">
  <div class="question">New Card</div>
  <div class="answer">&nbsp;</div>
</div>
`;

class Preview extends HTMLElement {
  _data = null;

  constructor() {
    super();

    const shadowRoot = this.attachShadow({ mode: "open" });
    shadowRoot.appendChild($template.content.cloneNode(true));

    this.$question = this.shadowRoot.querySelector(".question");
    this.$answer = this.shadowRoot.querySelector(".answer");
    this.onClick = this.onClick.bind(this);
  }

  set data(value) {
    this.$question.textContent = value.question || "New Card";
    this.$answer.textContent = value.answer || "\u00A0";
    this.setAttribute("data-id", value.id);
    this._data = value;
  }

  get data() {
    return this._data;
  }

  async connectedCallback() {
    this.addEventListener("click", this.onClick);
  }

  onClick() {
    this.makeActive();
  }

  makeActive() {
    this.setActive();
    this.setFormData();
  }

  setActive() {
    const $wrapper = document.getElementById("previewwrapper");
    const $previews = [...$wrapper.querySelectorAll("add-cards-preview")];
    $previews.forEach(($node) => {
      $node.classList.remove("active");
    });
    this.classList.add("active");
  }

  setFormData() {
    const $wrapper = document.getElementById("formwrapper");
    const $form = $wrapper.querySelector("add-cards-form");
    $form.data = this.data;
  }
}

try {
  window.customElements.define("add-cards-preview", Preview);
} catch (error) {}

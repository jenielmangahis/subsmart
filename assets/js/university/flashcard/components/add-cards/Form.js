import { prefixURL } from "../../api.js";

const $template = document.createElement("template");
$template.innerHTML = `
<link rel="stylesheet" href="${prefixURL}/assets/css/v2/bootstrap.min.css" crossorigin="anonymous">

<style>
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
}
.textarea {
  width: 100%;
  border: 0;
  padding: 1rem;
  resize: none;
  border-radius: 9px;
}
</style>

<div class="root">
  <div class="question">
    <textarea class="textarea" rows="4" placeholder="Question"></textarea>
  </div>
  <div class="answer">
    <textarea class="textarea" rows="4" placeholder="Answer"></textarea>
  </div>
</div>
`;

class Form extends HTMLElement {
  _data = null;

  constructor() {
    super();

    const shadowRoot = this.attachShadow({ mode: "open" });
    shadowRoot.appendChild($template.content.cloneNode(true));

    this.$question = this.shadowRoot.querySelector(".question textarea");
    this.$answer = this.shadowRoot.querySelector(".answer textarea");
    this.onChange = this.onChange.bind(this);
  }

  set data(value) {
    this.$question.value = value.question;
    this.$answer.value = value.answer;
    this.$question.focus();
    this._data = value;
  }

  get data() {
    return this._data;
  }

  async connectedCallback() {
    this.$question.addEventListener("input", this.onChange("question"));
    this.$answer.addEventListener("input", this.onChange("answer"));
  }

  onChange(dataKey) {
    return (event) => {
      const $wrapper = document.getElementById("previewwrapper");
      const $preview = $wrapper.querySelector(
        `add-cards-preview[data-id="${this.data.id}"]`
      );
      this.data[dataKey] = event.target.value;
      $preview.data = this.data;
    };
  }
}

try {
  window.customElements.define("add-cards-form", Form);
} catch (error) {}

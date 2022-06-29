import { prefixURL } from "../../api.js";

const $template = document.createElement("template");
$template.innerHTML = `
<link rel="stylesheet" href="${prefixURL}/assets/css/v2/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="${prefixURL}/assets/css/v2/main.css">

<style>
:host {
  display: block;
  max-width: 500px;
}
.question,
.answer {
  width: 100%;
  height: 500px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 9px;
  padding: 1.5rem;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}

.content {
  flex: 1;
  display: grid;
  place-content: center;
  font-size: 20px;
  text-align: center;
}

.wrapper {
  position: relative;
}

.answer {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  transform: translateY(-1rem);
  transition: 0.3s;
}
.answer.revealed {
  opacity: 1;
  transform: translateY(0);
}
</style>

<div class="root">
  <div class="wrapper">
    <div class="question">
      <div>Question</div>
      <div class="content"></div>
    </div>
    <div class="answer">
      <div class="title"></div>
      <div class="content"></div>
    </div>
  </div>
  <div class="mt-3">
    <button class="nsm-button primary w-100" data-action="reveal">
      Reveal answer
    </button>
  </div>
</div>
`;

class StudyCard extends HTMLElement {
  _data = null;

  constructor() {
    super();

    const shadowRoot = this.attachShadow({ mode: "open" });
    shadowRoot.appendChild($template.content.cloneNode(true));

    this.$button = this.shadowRoot.querySelector(".nsm-button.primary");
    this.$question = this.shadowRoot.querySelector(".question");
    this.$answer = this.shadowRoot.querySelector(".answer");
    this.onClickBtn = this.onClickBtn.bind(this);
  }

  set data(value) {
    const $question = this.$question.querySelector(".content");
    const $answer = this.$answer.querySelector(".content");
    const $answerTitle = this.$answer.querySelector(".title");

    $question.textContent = value.question;
    $answer.textContent = value.answer;
    $answerTitle.textContent = value.question;
    this._data = value;
  }

  get data() {
    return this._data;
  }

  connectedCallback() {
    this.$button.addEventListener("click", this.onClickBtn);
  }

  disconnectedCallback() {
    this.$button.removeEventListener("click", this.onClickBtn);
  }

  onClickBtn() {
    if (this.$button.dataset.action === "reveal") {
      this.$answer.classList.add("revealed");
      this.$button.textContent = "Next";
      this.$button.setAttribute("data-action", "next");
    } else {
      if (this.onNext) {
        this.onNext();
      }
    }
  }
}

try {
  window.customElements.define("study-card", StudyCard);
} catch (error) {}

export class ReceiptForwarding {
  constructor() {
    this.$button = $("#receiptForwardingButton");
    this.$modal = $("#receiptForwardingModal");
    this.$input = this.$modal.find("#receiptEmail");
    this.$emailText = this.$modal.find(".receiptModal__emailCopy");
    this.$submit = this.$modal.find(".btn-primary");

    this.loadDeps().then(() => {
      this.addEventListeners();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
    this.utils = await import("./utils.js");

    const response = await this.api.getForwardEmailInfo();
    this.forwardEmail = response.email;
    this.company = response.company;
  }

  addEventListeners() {
    this.$button.on("click", () => {
      const email = this.forwardEmail ? this.forwardEmail.value : "";
      this.$input.val(email);
      this.$input.trigger("input");
      this.$modal.find("#receiptCompany").text(this.company.business_name);
      this.$modal.modal("show");
    });

    this.$input.on("input", (event) => {
      const { value } = event.target;
      const isValid = this.utils.isEmail(value);
      this.$emailText.text(event.target.value);

      if (!isValid) {
        this.$input.addClass("input--error");
      } else {
        this.$input.removeClass("input--error");
      }
    });

    this.$submit.on("click", async () => {
      const email = this.$input.val();
      this.$input.removeClass("input--error");

      if (!this.utils.isEmail(email)) {
        this.$input.addClass("input--error");
        this.$input.focus();
        return;
      }

      this.$submit.addClass("receiptsButton--isLoading");
      this.$submit.prop("disabled", true);

      const response = await this.api.saveForwardEmail(email);
      this.forwardEmail = response.data;

      this.$submit.removeClass("receiptsButton--isLoading");
      this.$submit.prop("disabled", false);
      this.$modal.modal("hide");
    });
  }
}

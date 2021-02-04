class PaymentMethods extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['options'];
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
        <div class="form-group">
        <label class="font-weight-bold">Accepted Payment Methods</label></br>
        <label class="text-muted">Select the payment methods that will appear on this invoice.</label>
    
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-credit-card" value="credit-card">
            <label class="form-check-label" for="${this.element_type}-${this.id}-credit-card">
                Credit Card Payments ()</br>
                <span class="text-muted">
                    Your client can pay your invoice using credit card or bank account online.
                    You will be notified when your client makes a payment and the money will be transferred to your bank account automatically.
                </span>
                <div class="payment_method_cc_images">
                    <img src="/assets/fb/images/credit_cards.png" style="margin: 10px 0;">
                </div>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-cash" value="cash">
            <label class="form-check-label" for="${this.element_type}-${this.id}-cash">
                Cash
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-check" value="check">
            <label class="form-check-label" for="${this.element_type}-${this.id}-check">
                Check
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-credit" value="credit">
            <label class="form-check-label" for="${this.element_type}-${this.id}-credit">
                Credit
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-direct-deposit" value="direct-deposit">
            <label class="form-check-label" for="${this.element_type}-${this.id}-direct-deposit">
                Direct Deposit
            </label>
        </div>
    </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
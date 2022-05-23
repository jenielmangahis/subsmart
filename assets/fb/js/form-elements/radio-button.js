class RadioButton extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'choices', 'options', 'inline']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `<label class="element-label" for="${this.id}">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>`;
        this.choices.forEach(choice => {
            element_container.content += `
                <div class="form-check ${this.inline ? 'form-check-inline': ''}">
                    <input class="form-check-input" type="radio" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}-${choice.id}" value="${choice.id}">
                    <label class="form-check-label" for="${this.element_type}-${this.id}-${choice.id}">
                        ${choice.choice_text}
                    </label>
                </div>
            `
        });
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
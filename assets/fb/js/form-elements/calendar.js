class Calendar extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
        <label for="${this.id}" class="element-label">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>
            <input type="text" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}" class="form-control form-datepicker">
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
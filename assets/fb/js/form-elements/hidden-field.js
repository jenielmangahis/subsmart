class HiddenField extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
            <div><p>[hidden field]</p></div
            <input type="hidden" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}" class="form-control">
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
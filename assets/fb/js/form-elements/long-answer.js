class LongAnswer extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options', 'textarea']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
        <label for="${this.id}">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>
            <textarea name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}" cols="${this.columns}" rows="${this.rows}" class="form-control"></textarea>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }

    
}
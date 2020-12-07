class Dropdown extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'choices', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `<label class="element-label" for="${this.element_type}-${this.id}">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>
                <select class="form-control" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}">`;
        this.choices.forEach(choice => {
            element_container.content += `
                <option value="${choice.id}">${choice.choice_text}</option>
            `
        });
        element_container.content += `</select>`;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
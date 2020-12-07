class TextList extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
            <label for="${this.id}" class="element-label">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>
            <div class="row text-center">
                <input type="text" name="${this.element_type}-${this.id}" id="${this.element_type}-${this.id}" class="form-control col-10">
                <div class="col-1 p-2">
                    <button class="btn btn-sm rounded-circle text-list-btn btn-success">+</button>
                </div>
                <div class="col-1 p-2">
                    <button class="btn btn-sm rounded-circle text-list-btn btn-danger">-</button>
                </div>
            </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
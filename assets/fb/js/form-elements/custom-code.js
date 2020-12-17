class CustomCode extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['code', 'options'];
        this.custom_code = obj.custom_code ? obj.custom_code : '<p>Input code here</p>'
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
            <div class="custom-code">
                ${this.custom_code}
            </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
class FormattedText extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['editor', 'options']
        this.height = obj.height ? obj.height : 3;
    }

    getElement(preview = false) {
        const element_controls = preview ? '' : this.getElementControls();
        const element_container = this.getElementContainer(true);
        element_container.content += `
            <div class="formatted-text">
                ${this.question}
            </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
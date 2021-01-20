class Heading extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['preview', 'question', 'options', 'height', 'text', 'background']
        this.height = obj.height ? obj.height : 3;
    }

    getElement(preview = false) {
        const element_controls = preview ? '' : this.getElementControls();
        const element_container = this.getElementContainer(true);
        element_container.content += `
            <div class="form-header d-table-cell height-${this.height} container-fluid heading-element" style="font-size: ${this.text_font_size}px; ${this.text_is_bold ? 'font-weight: bold;' : ''} vertical-align: ${this.text_vertical_align}; text-align: ${this.text_horizontal_align}; ">
                <h3 class="heading-text" style="font-family: ${this.text_font_family};">${this.question ? this.question : ''}</h3>
            </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
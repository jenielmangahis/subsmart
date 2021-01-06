class Heading extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['preview', 'question', 'size']
        this.height = obj.height ? obj.height : 3;
    }

    getElement(preview = false) {
        const element_controls = preview ? '' : this.getElementControls();
        const element_container = this.getElementContainer(true);
        element_container.content += `
            <div class="form-header height-${this.height} container-fluid heading-element">
                <h3 class="my-auto heading-text">${this.question ? this.question : 'Heading'}</h3>
            </div>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
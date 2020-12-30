class ContainerBlock extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `<div class="container-block row" id="${this.element_type}-${this.id}">
    
        </div>`;
        return element_container.open + ' ' + element_container.content + /* ' ' + element_controls + */ ' ' + element_container.close;
    }
}
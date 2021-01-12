class BlankSpace extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['options'];
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += ``;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
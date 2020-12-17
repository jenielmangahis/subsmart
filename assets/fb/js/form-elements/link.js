class Link extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['url', 'options'];
        this.url_text = obj.url_text ? obj.url_text : 'open link';
        this.url = obj.url ? obj.url : '#';
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
            <a href="${this.url}">
                ${this.url_text}
            </a>
        `;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
class Image extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['image', 'options'];
        this.img_url = obj.img_url ? obj.img_url : '';
        this.img_alt_text = obj.img_alt_text ? obj.img_alt_text : '';
        this.optional_link_url = obj.optional_link_url ? obj.optional_link_url : '';
        this.optional_link_action = obj.optional_link_action ? obj.optional_link_action : '';
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        if(this.optional_link_url) {
            element_container.content += `
                <a href="${this.optional_link_url}">
                    <img src="${this.img_url}" alt="${this.img_alt_text}">
                </a>
            `;
        } else {
            element_container.content += `
                <img src="${this.img_url}" alt="${this.img_alt_text}">
            `; 
        }
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
class Signature extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `
        <label for="${this.id}" class="element-label">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>
        <div class="container border border-1 bg-light p-2 mt-0 rounded">
            <canvas class="boreder signature-canvas" element-id="${this.id}" id="${this.element_type}-${this.id}" name="${this.element_type}-${this.id}"></canvas>
            <div class="text-right">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearCanvas(${this.id})">Clear</button>
            </div>
        </div>`;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
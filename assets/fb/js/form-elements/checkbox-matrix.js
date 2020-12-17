class CheckboxMatrix extends MatrixElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'matrix', 'options']
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `<label class="element-label" for="${this.id}">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>`;
        element_container.content += `<table class="table table-sm">
        <thead><tr><th></th>`
        this.matrix_columns.forEach(column => {
            element_container.content += `
                <th>${column.text}</th>
            `
        });
        element_container.content += `</tr></thead><tbody>`;
        this.matrix_rows.forEach(row => {
            element_container.content += `<tr>`;
            element_container.content += `
                <td>${row.text}</td>
            `
            this.matrix_columns.forEach(column => {
                element_container.content += `
                    <td>                    
                        <input class="form-check-input position-static mx-auto" type="checkbox" name="${this.element_type}-${row}-${this.id}" id="${this.element_type}-${this.id}-${column.id}">
                    </td>
                `
            });
            element_container.content += `</tr>`;
        });
        element_container.content += `</tbody></table>`;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
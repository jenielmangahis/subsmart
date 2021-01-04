class FormElement {
    constructor(obj, editable = false) {
        this.editable = editable;
        this.id = obj.id ? obj.id : null;
        this.form_id = obj.form_id ? obj.form_id : null;
        this.element_type = obj.element_type;
        this.question = obj.question ? obj.question : '';
        this.question_label = obj.question ? obj.question : 'Question'
        this.required = obj.required ? parseInt(obj.required) : 0;
        this.read_only = obj.read_only ? parseInt(obj.read_only) : 0;
        this.admin_item = obj.admin_item ? parseInt(obj.admin_item) : 0;
        this.element_order = obj.element_order ? obj.element_order : null;
        this.element_type = obj.element_type ? obj.element_type : null;
        this.span = obj.span ? obj.span : 4;
        this.height = obj.height ? obj.height : 3;
        this.columns = obj.columns ? obj.columns : 30;
        this.rows = obj.rows ? obj.rows : 50;
        this.min = obj.min ? obj.min : null;
        this.max = obj.max ? obj.max : null;
        this.limit_unit = obj.limit_unit ? obj.limit_unit : 'characters';
        this.placeholder_text = obj.placeholder_text ? obj.placeholder_text : `input ${this.element_type} here`;
        this.choices = obj.choices ? obj.choices : ['-'];
        this.matrix_rows = obj.matrix ? obj.matrix.rows ? obj.matrix.rows : ['-'] : ['-'];
        this.matrix_columns = obj.matrix ? obj.matrix.columns ? obj.matrix.columns : ['-'] : ['-'];
        this.container_id = obj.container_id ? obj.container_id : null;
        this.rules = obj.rules ? obj.rules : null;
    }

    getElementContainer(remove_padding = false) {
        const container_selector = this.container_id !== null ? 'container-block' : 'in-parent';
        return {
            open: `<div id="${this.id}" class="form-group ${remove_padding ? 'px-0' : ''} col-12 col-md-${this.span} ${this.element_type} form-element ${this.editable ? 'editable' : ''} ${container_selector}">`,
            content: '',
            close: `</div>`
        }
    }

    getChoiceValue(choice) {
        choice = choice.toLowerCase();
        choice = choice.replace(' ', '_');
        return choice;
    }

    getElementControls() {
        let element_controls = ''
        const handle_selector = this.container_id !== null ? 'contained-element-handle' : 'element-handle';
        if(this.editable) {
            element_controls = `
            <div class="form-element-controls">
                <span class="${handle_selector}"><i class="fa fa-arrows-alt"></i></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-primary" onclick="handleElementEdit(${this.id})"><i class="fa fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="handleCopyElement(${this.id})"><i class="fa fa-cog"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="handleDeleteElement(${this.id})"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-file-alt"></i> Select Multiple</button>
                </div>
            </div?`
        }
        return element_controls;
    }

    setOrder(order) {
        this.element_order = order;
    }

    getPostData(with_choices = true) {
        if(with_choices) {
            return {
                form_element :{
                    id: this.id,
                    form_id: this.form_id,
                    question: this.question,
                    required: this.required,
                    read_only: this.read_only,
                    admin_item: this.admin_item,
                    element_type: this.element_type,
                    span: this.span,
                    element_order: this.element_order,
                    min: this.min,
                    max: this.max,
                    rows: this.rows,
                    columns: this.columns,
                    limit_unit: this.limit_unit,
                    rules: this.rules,
                },
                choices: this.choices,
            }
        } else {
            return {
                id: this.id,
                form_id: this.form_id,
                question: this.question,
                required: this.required,
                read_only: this.read_only,
                admin_item: this.admin_item,
                element_type: this.element_type,
                span: this.span,
                element_order: this.element_order,
                min: this.min,
                max: this.max,
                rows: this.rows,
                columns: this.columns,
                limit_unit: this.limit_unit,
                rules: this.rules,
            }
        }
    }
}
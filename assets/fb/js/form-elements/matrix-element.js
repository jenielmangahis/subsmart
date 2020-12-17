class MatrixElement extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.randomize_sub_questions = obj.matrix ? obj.matrix.randomize_sub_questions ? parseInt(obj.matrix.randomize_sub_questions) : 0 : 0;
        this.use_other_field = obj.matrix ? obj.matrix.use_other_field ? parseInt(obj.matrix.use_other_field) : 0 : 0;
        this.use_na_choice = obj.matrix ? obj.matrix.use_na_choice ? parseInt(obj.matrix.use_na_choice) : 0 : 0;
    }
}
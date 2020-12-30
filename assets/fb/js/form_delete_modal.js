const handleDeleteForm = () => {
    const id = $('#deleteFormID').val();
    const folder_id = 2;
    const data = {
        id,
        folder_id
    }
    updateForm(data).then(res => {
        $('#formDeleteModal').modal('hide');
        filterForms();
    });
}
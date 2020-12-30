const handleMoveToFolder = () => {
    const id = $('#moveFolderFormID').val();
    const folder_id = $('#folderMoveTo').val();
    const data = {
        id,
        folder_id
    }
    updateForm(data).then(res => {
        $('#moveFolderModal').modal('hide');
        filterForms();
    });
}
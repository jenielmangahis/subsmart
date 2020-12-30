const handleMoveToFolder = () => {
    const id = form.id;
    const selected_form = forms.filter(form => {
        return form.id == $('#copyFromForm').val();
    })
    const style = selected_form[0].style;
    const color = selected_form[0].color;
    const data = {
        id,
        style,
        color
    }
    console.log(data);
    updateForm(data).then(async res => {
        showBuilderTab('build');
        await loadElements(id, true).then(res => {
            initBuilder();
        });
        showSuccess();
        $('#copyFromFormModal').modal('hide');
    });
}
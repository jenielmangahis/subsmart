const handleOnLoad = async (form_id) => {
    await loadElements(form_id, false).then(res => {
        initSignPads();
    });
    setPageProperties();
};

const setPageProperties = () => {
    $(document).attr("title", form.name);
}
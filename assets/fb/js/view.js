const handleOnLoad = async (form_id) => {
    await loadElements(form_id, false);
    setPageProperties();
};

const setPageProperties = () => {
    $(document).attr("title", form.name);
}
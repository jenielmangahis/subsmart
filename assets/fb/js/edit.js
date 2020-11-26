const handleOnLoad = async (form_id) => {
  await loadElements(form_id, true);
};

const loadForm = async (form_id, editable) => {
  await getFormByID(form_id).then((res) => {
  }).catch(err => {
      alert('Error fetching form. please try again later.')
  });
};

const setPageProperties = () => {
    $('#navFormName').html(form.name);
}
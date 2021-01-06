let forms = [];
const handleOnLoad = async (form_id, laodColorPicker = true) => {
  await loadElements(form_id, true).then(res => {
    initBuilder();
    initSignPads();
    initContainers();
    if(laodColorPicker){
      initColorPicker();
    }

    try {
      initEditor();      
    } catch (error) {
      console.log(error);
    }
  });
  getAllForms().then(res => {
    forms = res.data;
    forms.forEach(el => {
      appendFormOptions(el);
    })
  })
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
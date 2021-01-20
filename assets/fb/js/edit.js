let forms = [];
let background_color_picker, font_color_picker;
const handleOnLoad = async (form_id, laodColorPicker = true) => {
  await loadElements(form_id, true).then(res => {
    initBuilder();
    initSignPads();
    initContainers();
    initModalColorPickers();
    if(laodColorPicker){
      initColorPicker();
    }

    try {
      initEditor();      
    } catch (error) {
      console.log(error);
    }
  });
  setPageProperties();
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

const initModalColorPickers = () => {
  background_color_picker = colorjoe.rgb('backgroundColorPicker', '#000').on('change', function (c) {
    const val = c.hex();
    $('#backgroundColorValue').html(val);
  });
  font_color_picker = colorjoe.rgb('fontColorPicker', '#000').on('change', function (c) {
    const val = c.hex();
    $('#fontColorValue').html(val);
  });
}
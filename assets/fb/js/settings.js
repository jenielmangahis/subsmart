const refreshForm = async (form_id) => {
  await getFormByID(form_id).then((res) => {
    console.log(form_id);
    console.log(res)
    const form = res.data.form;
    $('#formName').val(form.name);
    $('#formPrivateNotes').val(form.private_notes);
    $('#formSocialDescription').val(form.social_description);
    $('#formSocialImage').val(form.social_image);
  }).catch(err => {
      alert('Error fetching form. please try again later.')
  });
};

const setPageProperties = () => {
    $('#navFormName').html(form.name);
}

const handleDescriptionSave = async (form_id) => {
  showLoading();
  const data = {
    name: $('#formName').val(),
    private_notes: $('#formPrivateNotes').val(),
    social_description: $('#formSocialDescription').val(),
    social_image: $('#formSocialImage').val(),
  };

  await updateForm(data).then((res) => {
    showSuccess();
    refreshForm(form_id);
  }).catch(err => {
      showDanger();
  });
}

const showLoading = () => {
  hideSuccess();
  hideDanger();
  $('#loadingContainer').show();
}

const hideLoading = () => {
  $('#loadingContainer').hide();
}

const showDanger = () => {
  hideSuccess();
  hideLoading();
  $('#dangerIndicator').show();
}

const hideDanger = () => {
  $('#dangerIndicator').hide();
}

const showSuccess = () => {
  hideLoading();
  hideDanger();
  $('#successIndicator').show();
  setTimeout(() => {
      hideSuccess();
  }, 2000);
}

const hideSuccess = () => {
  $('#successIndicator').hide();
}
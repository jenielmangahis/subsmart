<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper w-100">
  <div __wrapper_section>
    <div class="card my-2" style="height: 1250px">
      <div class="text-left">
        <h1>Tems and Conditions</h1>
      </div>
      <div class="container-fluid">
        <form id="termsAndConditionsEditForm">
            <div class="form-group">
                <label for="document-title">Document Title</label>
                <input type="text" name="document-title" id="documentTitle" class="form-control">
            </div>
            <div class="form-group">
                <label for="document-content">Document Content</label>
                <textarea name="document-content" id="documentContent" cols="30" rows="10" class="form-control document-editor"></textarea>
            </div>
            <div class="text-right">
              <button class="btn btn-success save-button" type="button">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include viewPath('includes/footer'); ?>

<script>
$.ajax({
    url: `${baseUrl}/terms-and-conditions/get-one-by-id/${<?= $terms_and_conditions_id ?>}`,
    method: 'GET',
    success: (res) => {
        const data = res.data;
        editor.setContents(data.content)
        $('#documentTitle').val(data.title);
        $('#breadcrumbTitle').html(data.title);
        $('#breadcrumbBack a').attr('href', '/terms-and-conditions');
    }
});

$('.save-button').click(() => {
    handleSave(true, <?= $terms_and_conditions_id ?>);
  })
</script>

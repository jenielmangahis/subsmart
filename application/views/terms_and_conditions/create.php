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
  $('.save-button').click(() => {
    handleSave();
  })
</script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
.custom__border .card-body>.row {
    background: none !important;
}
.custom__border .card-body>.row {
    border-bottom: 0;
    padding-bottom: 20px;
    margin-bottom: 20px;
    background: #f2f2f2;
     padding: 0px !important;
    margin: 0;
    /* margin-bottom: 20px; */
    /* border-radius: 8px; */
}
.form-control-block {
    display: block;
    width: 100%;
    color: #363636;
    font-size: 16px;
    border-radius: 2px;
    height: 27px;
    padding: 3px 0 0 0;
    text-align: center;
}
.item-link-sm {
    font-style: italic;
    font-size: 12px;
    color: #8f8f8f;
    display: none;
}
.custom__border .card-body>.row {
    background: none !important;
}
.custom__border .card-body>.row {
    border-bottom: 0;
    padding-bottom: 20px;
    margin-bottom: 20px;
    background: #f2f2f2;
     padding: 0px !important;
    margin: 0;
    /* margin-bottom: 20px; */
    /* border-radius: 8px; */
}
.dropdown .btn {
    position: relative;
    top:12px;
}
.subtle-txt {
    color: rgba(42, 49, 66, 0.7);
}
.form-control-block {
    display: block;
    width: 100%;
    color: #363636;
    font-size: 16px;
    border-radius: 2px;
    height: 27px;
    padding: 3px 0 0 0;
    text-align: center;
}
.item-link-sm {
    font-style: italic;
    font-size: 12px;
    color: #8f8f8f;
    display: none;
}
.float-right.d-none.d-md-block {
    position: relative;
    bottom: 11px;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  margin-bottom: 0px !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 19px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<div class="wrapper" role="wrapper">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <?php echo form_open_multipart('credit_notes/update_settings', ['class' => 'form-validate require-validation', 'id' => 'frm-credit-note-settings', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                      <div class="page-title-box" style="padding:5px 0 0 0;">
                          <div class="row align-items-center">
                              <div class="col-sm-6">
                                  <h3 class="page-title mt-0">Settings</h3>
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item active"></li>
                                  </ol>
                              </div>
                          </div>
                      </div>
                      <div class="pl-3 pr-3 mt-0 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                        </div>
                      </div>
                      <div class="form-group mt-2">
                            <label>Credit Note Number</label>
                            <div class="help help-sm help-block">Set the prefix and the next auto-generated number.</div>
                            <br />
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="margin-bottom-qui">Prefix</div>
                                    <input type="text" name="credit_note_number_prefix" value="<?= $settings->credit_note_number_prefix . '-'; ?>" class="form-control" autocomplete="off">
                                </div>
                                <?php
                                    $next_number = str_pad($settings->credit_note_number_next_number, 5, '0', STR_PAD_LEFT);
                                ?>
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Next number</div>
                                    <input type="text" name="credit_note_number_next_number" value="<?= $next_number; ?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <hr style="margin:44px;" />
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Default Message</div>
                                    <textarea name="credit_note_message" cols="40" rows="2" class="form-control ckeditor" autocomplete="off" placeholder="" required=""><?= $settings->default_message; ?></textarea>
                                </div>
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Default Terms & Condition</div>
                                    <textarea name="credit_note_terms" cols="40" rows="2" class="form-control ckeditor" autocomplete="off" placeholder="" required=""><?= $settings->default_terms_conditions; ?></textarea>
                                </div>
                            </div>
                            <br /><br />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save Changes</button>
                                    <a href="<?php echo base_url('credit_notes') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Credit Note List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

        <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer'); ?>

<script>
$(function(){
    $("#frm-credit-note-settings").submit(function(e){
        e.preventDefault();

        Swal.fire({
          title: 'Are all entries correct?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Update',
          confirmButtonColor: '#32243d'
        }).then((result) => {          
          if (result.isConfirmed) {
            var url = base_url + 'credit_notes/_update_credit_note_settings';

            $.ajax({
               type: "POST",
               url: url,
               dataType: 'json',
               data: $("#frm-credit-note-settings").serialize(),
               success: function(o)
               {     
                    if( o.is_success ){
                        Swal.fire({
                          title: 'Success',
                          text: 'Settings was successfully updated.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                        }).then((result) => {
                          if (result.value) {
                            
                          }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot update settings.',
                            text: o.msg
                        });
                    }            
               }
            });
          } 
        });

    });
});
</script>

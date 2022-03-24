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
  padding-top: 40px !important;
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
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-update-furnisher', 'autocomplete' => 'off']); ?>
            <input type="hidden" value="<?= $furnisher->id; ?>" name="fid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div>
                            <div class="row align-items-center">
                              <div class="col-sm-6">
                                  <h3 class="page-title mt-0">Edit Creditor/Furnisher</h3>
                              </div>
                              <div class="col-sm-6">
                                  <div class="float-right d-none d-md-block">
                                      <div class="dropdown">
                                          <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                              <a href="<?php echo base_url('creditor_furnisher/list') ?>" class="btn btn-primary"
                                                 aria-expanded="false">
                                                  <i class="mdi mdi-settings mr-2"></i> Go Back to Creditor/Furnisher List
                                              </a>
                                          <?php //endif ?>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="pl-3 pr-3 mt-2 row">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Edit Creditor/Furnisher.</span>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-name">Company name</label>
                                    <input type="text" class="form-control" name="f_company_name" id="f-name" placeholder="" value="<?= $furnisher->name; ?>" required/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="f-account-type">Account Type</label>
                                    <input type="text" class="form-control" name="f_account_type" id="f-account-type" placeholder="" value="<?= $furnisher->account_type; ?>" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-address">Address</label>
                                    <input type="text" class="form-control" name="f_address" id="f-address" placeholder="" value="<?= $furnisher->address; ?>" required/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">City</label>
                                    <input type="text" class="form-control" name="f_city" id="" placeholder="" value="<?= $furnisher->city; ?>" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="f-state">State</label>
                                    <input type="text" class="form-control" name="f_state" id="f-state" placeholder="" value="<?= $furnisher->state; ?>" required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date">Zip Code</label>
                                    <input type="text" class="form-control" name="f_zipcode" id="" placeholder="" value="<?= $furnisher->zip_code; ?>" required/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="f-phone">Phone</label><br />
                                    <input type="text" class="form-control" name="f_phone" id="f-phone" placeholder="" value="<?= $furnisher->phone; ?>" required style="display:inline-block;width: 40%;" />
                                    <input type="text" class="form-control" name="f_ext" id="" placeholder="Ext" value="<?= $furnisher->ext; ?>" required style="display:inline-block; width: 25%;"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-note">Note</label>
                                    <textarea class="form-control" name="f_note" id="f-note" style="height:100px;"><?= $furnisher->note; ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary btn-update-furnisher">Save</button>
                                    <a href="<?php echo url('creditor_furnisher/list') ?>" class="btn btn-primary">Cancel</a>
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

    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
  $(function () {    

    $("#frm-update-furnisher").submit(function(e){
      e.preventDefault();
      var aid = $(this).attr("data-id");
      var url = base_url + 'creditor_furnisher/_update_creditor_furnisher';
      $(".btn-update-furnisher").html('<span class="spinner-border spinner-border-sm m-0"></span>');

      var formData = new FormData($("#frm-update-furnisher")[0]);   

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){
                  Swal.fire({
                      title: 'Great!',
                      text: 'Creditor / Furnisher was successfully updated.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      location.href = base_url + "creditor_furnisher/list";
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 
                $(".btn-update-furnisher").html('Save');
             }
          });
      }, 800);
    });

  });
</script>

<style>
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.form-group {
    margin-bottom: 2px !important;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.btn {
    font-size: 12px !important;
    background-repeat: no-repeat;
    padding: 6px 12px;
}
.input_select{
    color: #363636;
    border: 2px solid #e0e0e0;
    box-shadow: none;
    display: inline-block !important;
    width: 100%;
    background-color: #fff;
    background-clip: padding-box;
    font-size: 11px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
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
.job-marker{
  height: 57px;
  width: 100px;
  border: 1px solid #dee2e6;
}
.card{
    box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
// CSS to add only Customer module
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //"assets/css/accounting/sidebar.css",
    'assets/textEditor/summernote-bs4.css',
));
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid p-40">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk pt-0" style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                            <div class="row margin-bottom-ter mb-2 align-items-center" style="background-color:white; padding:0px;">
                                <div class="col-auto pl-0">
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Job Types</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a href="<?php echo base_url('job/add_new_job_type'); ?>" class="btn btn-primary btn-sm" id="">
                                                <span class="fa fa-plus"></span> Add New Job Type
                                            </a>
                                        </div>
                                    </div>
                                    <div class="float-right d-md-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                          <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                  In our software, jobs are project that an invoice will need to be issued for payment.
                                  This will help organize your projects into categories and will help you see the profitability of your business based on the various job type.
                              </span>
                          </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pan" id="tab1">
                                <hr>
                                <table class="table table-bordered table-striped" id="jobTypeTable">
                                    <thead>
                                    <tr>                                        
                                        <th></th>
                                        <th>Job Type Name</th>
                                        <th>Manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($job_types)): ?>
                                        <?php foreach($job_types as $types) : ?>
                                            <tr>
                                                <td>
                                                  <?php 
                                                    if( $types->icon_marker != '' ){
                                                      $image = base_url('uploads/job_types/' . $types->icon_marker);
                                                    }else{
                                                      $image = base_url('uploads/job_types/default_no_image.jpg');
                                                    }
                                                  ?>
                                                  <img src="<?= $image ?>" class="job-marker" />
                                                </td>
                                                <td><?= $types->title; ?></td>                                                
                                                <td class="pl-3">
                                                    <a href="<?php echo base_url('job/edit_job_type/' . $types->id); ?>" class="btn btn-primary btn-sm">
                                                        <span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                    <a href="javascript:void(0)" id="<?= $types->id; ?>"  class="delete_job_type btn btn-primary btn-sm">
                                                        <span class="fa fa-trash"></span> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="newJobTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="form_add_tag">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Job Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="invoice_job_location">Title</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" >Save</button>
                            <!--<button type="button" class="btn btn-primary" id="jobTypeAddCloseBtn">Add & Close</button>
                            <button type="button" class="btn btn-primary" style="display:none;" id="jobTypeEditBtn">Edit</button>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php
// JS to add only Job module
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
));
?>
<?php include viewPath('includes/footer'); ?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function () {
        $('#jobTypeTable').DataTable({
            "lengthChange": true,
            "searching" : false,
            "pageLength": 10,
            "order": [],
            "aoColumnDefs": [
              { "sWidth": "8%", "aTargets": [ 0 ] },
              { "sWidth": "80%", "aTargets": [ 1 ] },
              { "sWidth": "15%", "aTargets": [ 2 ] }
            ]
        });
        $("#form_add_tag").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/job/add_job_type",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "1"){
                        window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            });
        });
        $(".delete_job_type").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Are you sure to remove this Job Type?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "/job/delete_job_type",
                        data: {type_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.reload();
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    });
</script>

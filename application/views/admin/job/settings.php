<?php
defined('BASEPATH') or exit('No direct script access allowed');
// CSS to add only Customer module
add_css(array(
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
));

include viewPath('job/css/settings');
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
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Job Settings</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">

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
                                  ......
                              </span>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="banking-tab-container">
                                <div class="rb-01">
                                    <ul class="nav nav-tabs border-0">
                                        <li class="nav-item">
                                            <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'jobSettings' || $active_tab == '' ?   "active" : '';  ?>" data-toggle="tab" href="#jobSettings">
                                                Job Settings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'taxRate' ?   "active" : '';  ?>" data-toggle="tab" href="#taxRate">
                                                Tax Rate
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content mt-4" >
                                <div class="tab-pane <?= $active_tab == 'jobSettings' || $active_tab == '' ? "active" : "fade"; ?> standard-accordion" id="jobSettings">
                                    <div class="row col-md-12 pb-3">
                                        <label class="pt-2 pr-5">Job Prefix</label>
                                        <input type="text" class="form-control col-md-2" id="surveyPrefix" value="JOB-">
                                    </div>
                                </div>

                                <div class="tab-pane <?= $active_tab == 'taxRate' ? "active" : "fade"; ?> standard-accordion" id="taxRate">
                                    <h6>Tax Rates</h6>
                                    <table class="table table-bordered table-striped" id="tax_rates_table">
                                        <a href="javascript:void(0);" id="add_new_tax" data-toggle="modal" data-target="#new_tax_rate" class="btn btn-primary btn-sm pull-right" >
                                            <span class="fa fa-plus"></span> Add Tax Rate
                                        </a>
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Percent</th>
                                            <th>Date Created</th>
                                            <th>Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($tax_rates)): ?>
                                            <?php foreach($tax_rates as $rate) : ?>
                                                <tr>
                                                    <td><?= $rate->name; ?></td>
                                                    <td><?= $rate->rate; ?> %</td>
                                                    <td><?= date("m-d-Y h:i A",strtotime($rate->date_created)); ?></td>
                                                    <td class="pl-3">
                                                        <a href="javascript:void(0)" id="<?= $rate->id; ?>"  class="delete_tax_rate btn btn-primary btn-sm">
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
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
   </div>
    <!-- page wrapper end -->
    <div class="modal fade" id="new_tax_rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form_add_tax">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Tax Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="invoice_job_location">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="invoice_job_location">Percentage</label>
                                    <input type="number" class="form-control" name="rate" required placeholder="5">
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

<script>
    $(document).ready(function () {
        $('#tax_rates_table').DataTable({
            "lengthChange": true,
            "searching" : false,
            "pageLength": 10,
            "order": [],
        });
        $("#form_add_tax").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/job/add_tax_rate",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "1"){
                        sucess_add('Awesome!','Successfully Added!','taxRate');
                        //window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            });
        });
        $(".delete_tax_rate").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Are you sure to remove this tax rate?',
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
                        url: base_url + "/job/delete_tax_rate",
                        data: {id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                //window.location.reload();
                                sucess_add('Nice!','Removed Successfully!','taxRate');
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });

        function sucess_add($title,information,is_reload){
            Swal.fire({
                title: $title,
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(is_reload === 1){
                    if (result.value) {
                        window.location.reload();
                    }
                }else{
                    window.location.href='<?= base_url(); ?>job/settings/'+is_reload;
                }
            });
        }
    });
</script>

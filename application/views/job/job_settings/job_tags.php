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
            <div class="container-fluid">
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body hid-desk" style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                                <div class="row margin-bottom-ter align-items-center" style="background-color:white; padding:0px;">
                                    <div class="col-auto">
                                        <h5 class="page-title">Job Tags</h5>
                                        <span>Define the different job tags</span>
                                    </div>
                                    <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                        <div class="float-right d-md-block">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" id="newJobTypeBtn" data-target="#newJobTypeModal">
                                                    <span class="fa fa-plus"></span> Add New Tag
                                                </a>
                                            </div>
                                        </div>
                                        <div class="float-right d-md-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pan" id="tab1">
                                    <hr>
                                    <table class="table table-bordered table-striped" id="jobTypeTable">
                                        <thead>
                                        <tr>
                                            <th scope="col"><strong>Name</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($job_tags)): ?>
                                                <?php foreach($job_tags as $tags) : ?>
                                                    <tr>
                                                        <td class="pl-3"><?= $tags->name; ?></td>
                                                        <td class="pl-3">
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#newJobTypeModal" data-id="<?php echo $jobtype->id; ?>" data-jobtype="<?php echo $jobtype->value; ?>" class="editJobTypeBtn btn btn-primary btn-sm">
                                                                <span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                            <a href="javascript:void(0)" id="<?= $tags->id; ?>"  class="delete_tags btn btn-primary btn-sm">
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
                                <h5 class="modal-title" id="exampleModalLabel">Add Job Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="invoice_job_location">Name</label>
                                            <input type="text" class="form-control" name="name">
                                            <span style="display:none; color:red; font-size:12px;" id="error_settingType">This field is required</span>
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
        });
        $("#form_add_tag").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/job/add_tag",
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
        $(".delete_tags").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Continue to REMOVE tag?',
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
                        url: "/job/delete_tag",
                        data: {tag_id : ID}, // serializes the form's elements.
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

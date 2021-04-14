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
<!-- load page css -->
<?php include viewPath('events/css/list'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/events'); ?>
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
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Events</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" href="<?= base_url('events/new_event') ?>">
                                                <span class="fa fa-plus"></span> New Event
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
                                      This is where you will create, view, and edit your events and all event-related records,
                                    go to the Events work area where you can create a new event and—working from this single event
                                    record—add most of the other types of records and information that you need to plan, publish,
                                    promote, and analyze it.  Like many of our sales items the event record provides a customizable
                                    business process workflow that helps guide you through each step of the process.
                                   </span>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tabs">
                                <ul class="clearfix work__order" id="myTab" role="tablist">
                                    <li class="active">
                                        <a class="nav-link active"  href="#"  aria-controls="tab1" aria-selected="true">All (0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Scheduled 0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Started (0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Finished (0)</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php if (!empty($events)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="jobListTable">
                                        <thead>
                                        <tr>
                                            <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                            <th scope="col"><strong>Job Number</strong></th>
                                            <th scope="col"><strong>Date</strong></th>
                                            <!-- <th scope="col"><strong>Customer</strong></th>-->
                                            <th scope="col"><strong>Employee</strong></th>
                                            <th scope="col"><strong>Amount</strong></th>
                                            <th scope="col"><strong>Event Type</strong></th>
                                            <th scope="col"><strong>Event Tag</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($events as $event) : ?>
                                            <tr>
                                                <td class="pl-3"><?= $event->event_number; ?></td>
                                                <td class="pl-3"><?php echo date_format(date_create($event->date_created),"m/d/Y"); ?></td>
                                                <!--<td class="pl-3"><?= $event->first_name.' '.$event->last_name ; ?></td>-->
                                                <td class="pl-3"><?= $event->FName.' '.$event->LName ; ?></td>
                                                <td class="pl-3">$<?= number_format((float)$event->amount,2,'.',',') ; ?></td>
                                                <td class="pl-3"><?= $event->event_type; ?></td>
                                                <td class="pl-3"><?= $event->event_tag; ?></td>
                                                <td class="pl-3">
                                                    <a href="<?= base_url('events/new_event/').$event->id; ?>" class="editJobTypeBtn btn btn-default btn-sm">
                                                        <span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                    <a href="javascript:void(0)" id="<?= $event->id; ?>"  class="delete_event btn btn-default btn-sm">
                                                        <span class="fa fa-trash"></span> Delete
                                                    </a>
                                                    <a href="<?= base_url('events/event_preview/').$event->id; ?>"  class=" btn btn-default btn-sm">
                                                        <span class="fa fa-search-plus"></span> Preview
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added Events yet</h5>
                                        <p class="text-ter margin-bottom">Manage your Events.</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
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
        $('#jobListTable').DataTable({
            "lengthChange": true,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

        $(".delete_event").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Continue to REMOVE this Event?',
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
                        url: "<?= base_url('events/delete_event') ?>",
                        data: {job_id : ID}, // serializes the form's elements.
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
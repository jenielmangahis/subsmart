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
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117) !important;
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
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Paused (0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Invoiced (0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Withdrawn (0)</a>
                                    </li>
                                    <li>
                                        <a class="nav-link active" href="#" aria-controls="tab1" aria-selected="true">Closed (0)</a>
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
                                            <th scope="col"><strong>Customer</strong></th>
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
                                                <td class="pl-3"><?= $event->first_name.' '.$event->last_name ; ?></td>
                                                <td class="pl-3"><?= $event->FName.' '.$event->LName ; ?></td>
                                                <td class="pl-3">$0.00<?= $event->amount; ?></td>
                                                <td class="pl-3"><?= $event->event_type; ?></td>
                                                <td class="pl-3"><?= $event->event_tag; ?></td>
                                                <td class="pl-3">
                                                    <a href="<?= base_url('job/new_job1/').$event->id; ?>" class="editJobTypeBtn btn btn-default btn-sm">
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
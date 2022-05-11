<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.badge{
    padding: 10px;
    font-size: 14px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/admin_event_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all companies events.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/events') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Events" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/events'); ?>">All Events</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/events?status=draft'); ?>">Draft</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/events?status=scheduled'); ?>">Scheduled</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/events?status=started'); ?>">Started</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/events?status=finished'); ?>">Finished</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <!-- <a class="nsm-button primary btn-add-new-type" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Event</a> -->                            
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_events') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Company Name">Company Name</td>
                            <td data-name="Customer Name">Customer Name</td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date" style="width:10%;">Date</td>                            
                            <td data-name="Event Type" style="width:10%;">Event Type</td>
                            <td data-name="Event Tag" style="width:10%;">Event Tag</td>
                            <td data-name="Event Tag" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($events as $event){ ?>    
                            <tr>
                                <td class="center"><?= $event->business_name; ?></td>
                                <td class="center"><?= $event->first_name . ' ' . $event->last_name; ?></td>
                                <td class="center"><?= $event->event_number; ?></td>
                                <td class="center"><?php echo date_format(date_create($event->date_created),"m/d/Y"); ?></td>
                                <td class="center"><?= $event->event_type; ?></td>
                                <td class="center"><?= $event->event_tag; ?></td>
                                <td class="center"><?= $event->status; ?></td>
                                <td class="center actions-col">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <!-- <li>
                                                <a class="dropdown-item btn-edit-type" href="javascript:void(0)" data-id="<?php echo $event->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li> -->
                                            <li>
                                                <a class="dropdown-item btn-view-event" href="javascript:void(0)" data-id="<?php echo $event->id ?>"><i class='bx bx-fw bx-show'></i> View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-event" href="javascript:void(0);" data-name="<?= $event->event_number; ?>" data-id="<?= $event->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--View Event modal-->
            <div class="modal fade nsm-modal fade" id="modalViewEvent" tabindex="-1" aria-labelledby="modalViewEventLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Event</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body modal-view-event-container"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-view-event', function(){
        var eid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_view_event';

        $('#modalViewEvent').modal('show');
        $(".modal-view-event-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {eid:eid},
             success: function(o)
             {          
                $('.modal-view-event-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/events';
    });    

    $(document).on("click", ".delete-event", function(e) {
        var eid = $(this).attr("data-id");
        var event_number = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteEvent';

        Swal.fire({
            title: 'Delete Event',
            html: "Are you sure you want to delete event number <b>"+event_number+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {eid:eid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Event Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>
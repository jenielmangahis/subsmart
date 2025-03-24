<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<style>
.nsm-table {
    /*display: none;*/
}
.nsm-badge.primary-enhanced {
    background-color: #6a4a86;
}
    table {
    width: 100% !important;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important;
     cursor: pointer; 
}
.btn-view-event{
    text-decoration:none;
    color:unset;
}
.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            This is where you will create, view, and edit your events and all event-related records, go to the Events work area where you can create a new event and—working from this single event record—add most of the other types of records and information that you need to plan, publish, promote, and analyze it. Like many of our sales items the event record provides a customizable business process workflow that helps guide you through each step of the process.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_EVENT_SEARCHBAR" placeholder="Search Event...">
                            <input class="d-none" id="CUSTOM_FILTER_SEARCHBAR" type="text" placeholder="Filter" data-index="20">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('events', 'write')){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('events/event_add') ?>'">
                            <i class='bx bx-fw bx-calendar-event'></i> New Event
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table id="EVENT_TABLE" class="nsm-table w-100">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Event Number">Event Number</td>
                            <td data-name="Date">Event Date</td>
                            <td data-name="Event Color" style="width:5%;">Event Color</td>
                            <td data-name="Employee">Employee</td>                            
                            <td data-name="Event Type">Event Type</td>
                            <td data-name="Event Tag">Event Tag</td>                            
                            <td data-name="Event Type" style="width:5%;">Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (!empty($events)) {
                                foreach ($events as $event) {
                            ?>
                        <tr>
                            <td>
                                <div class="table-row-icon">
                                    <i class='bx bx-calendar-event'></i>
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary">
                                <a class="btn-view-event" href="javascript:void(0);" data-id="<?= $event->id; ?>" data-event-number="<?= $event->event_number; ?>"><?php echo $event->event_number; ?></a>
                            </td>
                            <td><?= date("m/d/Y", strtotime($event->start_date)); ?> - <?= date("m/d/Y", strtotime($event->end_date)); ?></td>
                            <td>
                                <div class="nsm-profile me-3" style="background-color:<?= $event->event_color; ?>; width: 40px;"></div>
                            </td>
                            <td>
                                <div class="techs">                   
                                    <?php $attendees = json_decode($event->employee_id); ?>
                                    <?php foreach($attendees as $eid){ ?>
                                        <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');"></div>
                                    <?php } ?>            
                                </div>
                            </td>                            
                            <td><?php echo $event->event_type; ?></td>
                            <td><?php echo $event->event_tag; ?></td>                            
                            <td><?php echo date_format(date_create($event->date_created), "m/d/Y"); ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item btn-view-event" href="javascript:void(0);" data-id="<?= $event->id; ?>" data-event-number="<?= $event->event_number; ?>">Preview</a></li>
                                        <?php if(checkRoleCanAccessModule('events', 'write')){ ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('events/event_edit/') . $event->id; ?>">Edit</a></li>
                                        <?php } ?>
                                        <?php if(checkRoleCanAccessModule('events', 'delete')){ ?>
                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-event-number="<?= $event->event_number; ?>" data-id="<?php echo $event->id; ?>">Delete</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="modal fade nsm-modal fade" id="modal-view-event" tabindex="-1" aria-labelledby="modal-view-event-label" aria-hidden="true">
                <div class="modal-dialog modal-lg">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">View Event</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" id="view-event-container"></div>
                    </div>        
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->
 
<script type="text/javascript">
var EVENT_TABLE = $("#EVENT_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});

$("#CUSTOM_EVENT_SEARCHBAR").keyup(function () {
    EVENT_TABLE.search($(this).val()).draw()
});
EVENT_TABLE_SETTINGS = EVENT_TABLE.settings();

$('#CUSTOM_FILTER_DROPDOWN').change(function (event) {
    $('#CUSTOM_FILTER_SEARCHBAR').val($('#CUSTOM_FILTER_DROPDOWN').val());
    EVENT_TABLE.columns(7).search(this.value).draw();
});

$(document).ready(function () {
    // $(".nsm-table").nsmPagination();

    $('.btn-view-event').on('click', function(){
        var event_id = $(this).attr('data-id');
        var event_number = $(this).attr('data-event-number');
        $('#modal-view-event').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + 'events/_view_event',
            data: {event_id:event_id},
            success: function(html) {    
               $('#view-event-container').html(html);               
            },
            beforeSend: function() {
                $('#view-event-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".delete-item", function (event) {
        var eid = $(this).data("id");
        var event_number = $(this).data('event-number');

        Swal.fire({
            title: 'Delete Event',
            html: `Are you sure you want to delete event number <b>${event_number}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "events/_delete_event",
                    data: {schedule_id: eid},
                    dataType:"json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Events',
                                text: "Data deleted successfully!",
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
                                html: result.msg
                            });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
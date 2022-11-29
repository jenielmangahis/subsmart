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
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
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
                    <div class="col-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <select id="CUSTOM_FILTER_DROPDOWN" class="dropdown-toggle nsm-button">
                                <option selected value="">All</option>
                                <option value="Draft">Draft</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Started">Started</option>
                                <option value="Finished">Finished</option>
                            </select>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('events/event_add') ?>'">
                            <i class='bx bx-fw bx-calendar-event'></i> New Event
                            </button>
                        </div>
                    </div>
                </div>
                <table id="EVENT_TABLE" class="nsm-table w-100">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Employee">Employee</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Event Type">Event Type</td>
                            <td data-name="Event Tag">Event Tag</td>
                            <td data-name="Event Type">Status</td>
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
                            <td class="fw-bold nsm-text-primary"><?php echo $event->event_number; ?></td>
                            <td><?php echo date_format(date_create($event->date_created), "m/d/Y"); ?></td>
                            <td><?php echo $event->FName . ' ' . $event->LName; ?></td>
                            <td>$<?php echo number_format((float)$event->amount, 2, '.', ','); ?></td>
                            <td><?php echo $event->event_type; ?></td>
                            <td><?php echo $event->event_tag; ?></td>
                            <td><?php echo ucfirst($event->status); ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?php echo base_url('events/event_preview/') . $event->id; ?>">Preview</a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('events/new_event/') . $event->id; ?>">Edit</a></li>
                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $event->id; ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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

    $(document).on("click", ".delete-item", function (event) {
        var ID = $(this).data("id");
        Swal.fire({
            title: 'Continue to REMOVE this Event?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Event was deleted successfully!',
                }).then((result) => {
                    window.location.href = "/events";
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('events/delete_event') ?>",
                    data: {
                        job_id: ID
                    }, // serializes the form's elements.
                    success: function (data) { }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
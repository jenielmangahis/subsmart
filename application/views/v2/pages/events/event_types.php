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
.table-row-icon.img {
    width: 50px;
    height: 50px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #f1f1f1;
    border-radius: 5px;
}
.nsm-table tr:not(.nsm-row-collapse) td:not(:last-child) {    
    max-width: initial !important;
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
                            Event types can be separated into seminars, conference, trade show, work shop, corporate, private, or charity. Event types can also be track for categories where an invoice will not be submit like estimates, tasks, demos and reminders. With our Crm you can choose, create or delete the appropriate classification for your business model.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TYPE_SEARCHBAR" placeholder="Search Event Type...">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('events/event_types_add'); ?>'">
                            <i class='bx bx-fw bx-book'></i> New Event Type
                            </button>
                        </div>
                    </div>
                </div>
                <table id="EVENT_TYPE_TABLE" class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Event Icon"></td>
                            <td data-name="Event Type Name">Event Type Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($event_types)) {
                                foreach ($event_types as $type) {
                            ?>
                        <tr>
                            <td>
                                <?php
                                    if ($type->icon_marker != '') :
                                        if ($type->is_marker_icon_default_list == 1) :
                                            $marker = base_url("uploads/icons/" . $type->icon_marker);
                                        else :
                                            $marker = base_url("uploads/event_types/" . $type->company_id . "/" . $type->icon_marker);
                                        endif;
                                    else :
                                        $marker = base_url("uploads/event_types/default_no_image.jpg");
                                    endif;
                                    ?>
                                <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                            </td>
                            <td class="fw-bold nsm-text-primary"><?php echo $type->title; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?php echo base_url('events/event_types_edit/' . $type->id); ?>">Edit</a></li>
                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $type->id; ?>">Delete</a></li>
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
var EVENT_TYPE_TABLE = $("#EVENT_TYPE_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
    "columns": [
        { "width": "5%"},
        null,
        { "width": "5%"},
    ]
});

$("#CUSTOM_TYPE_SEARCHBAR").keyup(function () {
    EVENT_TYPE_TABLE.search($(this).val()).draw()
});
EVENT_TYPE_TABLE_SETTINGS = EVENT_TYPE_TABLE.settings();


$(document).ready(function () {
    var base_url = "<?php echo base_url(); ?>";

    // $(".nsm-table").nsmPagination();
    $(document).on('click', '.delete-item', function () {
        var eid = $(this).data("id");
        Swal.fire({
            title: 'Warning',
            text: "Do you want to delete selected event type?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Event Type was deleted successfully!',
                }).then((result) => {
                    window.location.href = base_url + "/events/event_types";
                });
                $.ajax({
                    type: "POST",
                    url: base_url + "/event_types/delete",
                    data: {
                        eid: eid
                    }, // serializes the form's elements.
                    success: function (data) { }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
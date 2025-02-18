<?php include viewPath('v2/includes/header'); ?>
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
.nsm-table tr:not(.nsm-row-collapse) td:not(:last-child) {    
    max-width: initial !important;
}
</style>


<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('events/add_new_event_tag') ?>'">
        <i class='bx bx-tag'></i>
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
                            While categories are broader designations that are typically assigned one per event, tags are short but specific, and each event can be assigned as many tags as you'd like. It's a great way to use keywords or other important phrases to help you locate events that are most relevant to your interests.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TAG_SEARCHBAR" placeholder="Search Event Tag...">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('events/event_tags_add'); ?>'">
                                <i class='bx bx-fw bx-plus'></i> New Event Tag
                            </button>
                        </div>
                    </div>
                </div>

                <table id="EVENT_TAG_TABLE" class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Event Icon"></td>
                            <td data-name="Event Tag Name">Event Tag Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($event_tags)) {
                                foreach ($event_tags as $tag) {
                            ?>
                        <tr>
                            <td>
                                        <?php
                                        if ($tag->marker_icon != '') :
                                            if ($tag->is_marker_icon_default_list == 1) :
                                                $marker = base_url("uploads/icons/" . $tag->marker_icon);
                                            else :
                                                $marker = base_url("uploads/event_tags/" . $tag->company_id . "/" . $tag->marker_icon);
                                            endif;
                                        else :
                                            $marker = base_url("uploads/event_tags/default_no_image.jpg");
                                        endif;
                                        ?>
                                        <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $tag->name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url("events/event_tags_edit/" . $tag->id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?= $tag->name; ?>" data-id="<?php echo $tag->id; ?>">Delete</a>
                                                </li>
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
//EVENT_TAG_TABLE_SETTINGS = EVENT_TAG_TABLE.settings();
    $(document).ready(function() {
        var EVENT_TAG_TABLE = $("#EVENT_TAG_TABLE").DataTable({
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

        $("#CUSTOM_TAG_SEARCHBAR").keyup(function() {
            EVENT_TAG_TABLE.search($(this).val()).draw()
        });
        
        $(document).on( "click", ".delete-item", function( event ) {
            var tag_id = $(this).data("id");
            var tag_name = $(this).data("name");

            Swal.fire({
                title: 'Delete Event Tag',
                html: `Proceed with deleting event tag  <b>${tag_name}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "events/_delete_event_tag",
                        data: {tag_id:tag_id},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Event tags was successfully deleted',
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
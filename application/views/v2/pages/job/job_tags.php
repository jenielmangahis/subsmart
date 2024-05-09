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
.nsm-button:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important; 
}
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'">
        <i class='bx bx-tag'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A job tag identifies similar jobs or job templates. Use job tags to easily search and filter jobs and job templates when viewing them in the Jobs view. Tags will also help you to see the growth direction of your product, service, source and more.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TAG_SEARCHBAR" placeholder="Search Tag...">
                        </div>
                    </div>
                    <div class="col-sm-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'">
                            <i class='bx bx-fw bx-tag'></i> New Tag
                            </button>
                        </div>
                    </div>
                </div>
                <table id="JOB_TAG_TABLE" class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($job_tags)) {
                                foreach ($job_tags as $tag) {
                            ?>
                        <tr>
                            <td>
                                <?php
                                    if ($tag->marker_icon != '') :
                                        if ($tag->is_marker_icon_default_list == 1) :
                                            $marker = base_url("uploads/icons/" . $tag->marker_icon);
                                        else :
                                            $marker = base_url("uploads/job_tags/" . $tag->company_id . "/" . $tag->marker_icon);
                                        endif;
                                    else :
                                        $marker = base_url("uploads/job_tags/default_no_image.jpg");
                                    endif;
                                    ?>
                                <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                            </td>
                            <td class="fw-bold nsm-text-primary"><?= $tag->name; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url("job/edit_job_tag/" . $tag->id); ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $tag->id; ?>">Delete</a>
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
var JOB_TAG_TABLE = $("#JOB_TAG_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});

$("#CUSTOM_TAG_SEARCHBAR").keyup(function() {
    JOB_TAG_TABLE.search($(this).val()).draw()
});
JOB_TAG_TABLE_SETTINGS = JOB_TAG_TABLE.settings();


    $(document).ready(function() {
        // $(".nsm-table").nsmPagination();

        $(document).on("click", ".delete-item", function( event ) {
            var ID = $(this).attr("data-id");

            Swal.fire({
                title: 'Continue to REMOVE tag?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('job/delete_tag') ?>",
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
<?php include viewPath('v2/includes/footer'); ?>
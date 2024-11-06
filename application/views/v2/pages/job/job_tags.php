<?php include viewPath('v2/includes/header'); ?>
<style>
#input-upload-image, #icon-pick-name {
    width: 300px;
    display: inline-block;
}
.list-icon{
    list-style: none;
    height: 400px;
    overflow: auto;
    padding: 6px;
}
.list-icon li{
    display: inline-block;
    /*width: 30%;*/
    height:100px;
    margin: 3px;
}
.icon-image{
    height: 50px;
    width: 50px;    
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
                            <button type="button" class="nsm-button primary" id="btn-add-new-tag"><i class='bx bx-plus-medical'></i> Add New</button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="job-tags-table">
                    <thead>
                        <tr>
                            <td class="table-icon" style="width:5%;"></td>
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
                            <td class="nsm-text-primary"><?= $tag->name != '' ? $tag->name : '---'; ?></td>
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
    
    <div class="modal fade nsm-modal fade" id="modal-create-tags" tabindex="-1" aria-labelledby="modal-create-tags_label" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="post" id="tags_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Create Job Tags</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Tag Name</label>
                                <input type="text" name="job_tag_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Tag Icon / Marker</label>
                                <input type="file" name="image" value="" class="form-control" id="input-upload-image" autocomplete="off" />
                                <input type="text" name="default-icon-name" disabled="" value="" class="form-control" style="display:none;" id="icon-pick-name" /><br />
                                <div class="form-check" style="margin-top: 10px;">
                                    <input class="form-check-input" type="checkbox" name="is_default_icon" value="1" id="iconList" />
                                    <label class="form-check-label">
                                        Pick from list
                                    </label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modalIconList" tabindex="-1" aria-labelledby="modalIconListLabel" aria-hidden="true">
        <div style="max-width: 1000px;" class="modal-dialog modal-lg">
        <input type="hidden" name="pid" id="priority_id" value="" />
        <div class="modal-content">
            <div class="modal-header">
            <span class="modal-title content-title">Icon List</span>
            <button onclick='$("#iconList").prop("checked", false);' type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                <ul class="list-icon">
                    <?php foreach($icons as $i){ ?>
                    <li>
                    <a href="javascript:void(0);" data-name="<?= $i->image; ?>" data-id="<?= $i->id; ?>" class="a-icon hvr-float-shadow hvr-icon-bounce">
                        <img src="<?= base_url('uploads/icons/' . $i->image); ?>" class="icon-image hvr-icon" />
                    </a>
                    </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
            </div>
            <div class="modal-footer modal-footer-detail">
            <div class="button-modal-list">
                <button onclick='$("#iconList").prop("checked", false);' type="button" class="nsm-button" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>


</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#job-tags-table").nsmPagination({itemsPerPage:10});
        $("#CUSTOM_TAG_SEARCHBAR").on("input", debounce(function() { 
            tableSearch($(this));            
        }, 1000));

        $('#btn-add-new-tag').on('click', function(){
            $('#modal-create-tags').modal('show');
        });

        $(".a-icon").click(function(){
            var icon_name = $(this).attr("data-name");
            var icon_id   = $(this).attr("data-id");

            $("#input-upload-image").hide();
            $("#icon-pick-name").show();
            $("#icon-pick-name").val(icon_name);
            $("#modalIconList").modal('hide');
            $("#default-icon-id").val(icon_id);
        });

        $("#iconList").on('change', function(){
            if ($(this).is(':checked')) {
                $("#modalIconList").modal('show');
            }else{
                $("#input-upload-image").show();
                $("#icon-pick-name").hide();
                $("#default-icon-id").val("");
            }
        });

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
<?php include viewPath('v2/includes/header'); ?>
<style>
#input-upload-image, #icon-pick-name, #edit-icon-pick-name, #edit-input-upload-image {
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
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TAG_SEARCHBAR" placeholder="Search Job Tag">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                    <div class="col-sm-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-add-new-tag"><i class='bx bx-fw bx-plus'></i> Add New</button>
                        </div>
                    </div>
                    <?php } ?>
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
                                        <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                                        <li>                                            
                                            <a class="dropdown-item row-edit-job-tag" data-id="<?= $tag->id; ?>" data-title="<?= $tag->name; ?>" data-marker="<?= $tag->marker_icon; ?>" href="javascript:void(0);">Edit</a>
                                        </li>
                                        <?php } ?>
                                        <?php if(checkRoleCanAccessModule('job-settings', 'delete')){ ?>
                                        <li>
                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-title="<?= $tag->name; ?>" data-id="<?= $tag->id; ?>">Delete</a>
                                        </li>
                                        <?php } ?>
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
            <form method="post" id="tagsCreateForm" class="tags-create-form">
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
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
                                    <input class="form-check-input iconList" id="chk-add-default-icon" type="checkbox" name="is_default_icon" value="1" data-action="add" />
                                    <label class="form-check-label">
                                        Pick from list
                                    </label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="tags-create-button" class="nsm-button primary tags-create-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-job-tag" tabindex="-1" aria-labelledby="modal-edit-job-tag_label" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="post" id="frm-update-job-tag">
                <input type="hidden" name="default_icon_id" id="edit-default-icon-id" value="">
                <input type="hidden" name="jid" id="edit-jid" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Edit Job Tag</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                <input type="text" name="job_tag_name" id="edit-job-tag-name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Current Icon / Marker</label>
                                <input type="text" class="form-control" id="edit-current-marker" readonly="" disabled="" />
                            </div>                             
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Change Icon / Marker</label>
                                <input type="file" name="image" value="" class="form-control" id="edit-input-upload-image" autocomplete="off" />
                                <input type="text" name="default-icon-name" disabled="" value="" class="form-control" style="display:none;" id="edit-icon-pick-name" /><br />
                                <div class="form-check" style="margin-top: 10px;">
                                    <input class="form-check-input iconList" id="chk-edit-default-icon" type="checkbox" name="is_default_icon" value="1" data-action="edit" />
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
        <input type="hidden" id="form-action" value="" />
        <div style="max-width: 1000px;" class="modal-dialog modal-lg">
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

        $('.row-edit-job-tag').on('click', function(){
            var jid   = $(this).attr('data-id');
            var title  = $(this).attr('data-title');
            var marker = $(this).attr('data-marker');

            $('#edit-job-tag-name').val(title);
            $('#edit-jid').val(jid);
            $('#edit-current-marker').val(marker);

            $('#modal-edit-job-tag').modal('show');
        });        

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
            var form_action = $('#form-action').val();
            
            $("#modalIconList").modal('hide');
            if( form_action == 'add' ){
                $("#input-upload-image").hide();
                $("#icon-pick-name").show();
                $("#icon-pick-name").val(icon_name);
                $("#default-icon-id").val(icon_id);
            }else{
                $("#edit-input-upload-image").hide();
                $("#edit-icon-pick-name").show();
                $("#edit-icon-pick-name").val(icon_name);
                $("#edit-default-icon-id").val(icon_id);
            }
        });

        $(".iconList").on('change', function(){
            var form_action = $(this).attr('data-action');        
            $('#form-action').val(form_action);
            if ($(this).is(':checked')) {
                $("#modalIconList").modal('show');
            }else{
                if(form_action == 'add'){
                    $("#input-upload-image").show();
                    $("#icon-pick-name").hide();
                    $("#default-icon-id").val("");
                }else{
                    $("#edit-input-upload-image").show();
                    $("#edit-icon-pick-name").hide();
                    $("#edit-default-icon-id").val("");
                }
            }
        });

        $("#tagsCreateForm").submit(function(e) {
            e.preventDefault();
            var data = new FormData(this);
            if(!$('#input-upload-image').val() && !$('#chk-add-default-icon').is(':checked')){
                e.preventDefault();      
                Swal.fire({
                    title: 'Error',
                    text: 'Please specify job tag icon/marker image.',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });                         
            }else{
                $.ajax({
                    url: base_url + 'job/ajax_create_new_job_tag',
                    data: data,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    success: function (result) {

                        var res = JSON.parse(result);
                        if(res.success == true) {

                            Swal.fire({
                                title: 'New Job Tags',
                                text: "Job tag successfully created.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });

                            setTimeout(function () {
                                //location.reload();
                                $('#modal-create-tags').modal('hide');
                                $('#modal-edit-job-tag').modal('hide');                                
                            }, 500);                         

                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: res.message,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });                            
                        }

                    }
                })       
            }
        });

        $("#frm-update-job-tag").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: base_url + 'job/ajax_update_job_tag',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                dataType:'json',
                success: function(result){
                    if (result.success == true) {
                        Swal.fire({
                            title: 'Edit Job Tag',
                            text: "Job tag was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });         
                        
                        setTimeout(function () {
                            //location.reload();
                            $('#modal-create-tags').modal('hide');
                            $('#modal-edit-job-tag').modal('hide');                                
                        }, 500);      

                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                }
            });
        })            

        $(document).on("click", ".delete-item", function( event ) {
            var tag_id = $(this).attr("data-id");
            var title  = $(this).attr('data-title');

            Swal.fire({
                title: "Delete Job Tag",
                html: 'Are you sure to delete job tag <b>' + title + '</b>?',                
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "job/_delete_job_tag",
                        data: {tag_id : tag_id}, 
                        dataType: "json",
                        success: function(result){
                            if( result.is_success ){
                                Swal.fire({
                                    title: 'Delete Job Tag',
                                    text: "Data was successfully deleted",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
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
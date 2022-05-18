<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
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
                            Listing of all event tags.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/event_tags') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Event Tags" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-tag" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Event Tag</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>                            
                            <td data-name="Name">Name</td>
                            <td data-name="Name">Company Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($eventTags)) :
                        ?>
                            <?php
                            foreach ($eventTags as $tag) :
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
                                    <td class="fw-bold nsm-text-primary"><?= $tag->name; ?></td>
                                    <td><?= $tag->business_name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-tag" href="javascript:void(0);" data-id="<?= $tag->id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-tag" href="javascript:void(0);" data-name="<?= $tag->name; ?>" data-company="<?= $tag->business_name; ?>" data-id="<?= $tag->id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewTag" tabindex="-1" aria-labelledby="modalAddNewTagLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Event Tag</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-event-tag">
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-12 mt-3 company-select">
                                    <label for="">Company</label>
                                    <select name="company_id" id="companyList" class="nsm-field mb-2 form-control add-company" required="">     
                                        <option value="">Select Company</option>           
                                        <?php foreach($companies as $c){ ?>
                                            <option value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Event Tag Name</label>
                                    <input type="text" name="event_tag_name" id="event-tag-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Icon / Marker</label>
                                    <input type="file" name="image_marker" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-tag">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalEditTag" tabindex="-1" aria-labelledby="modalEditTagLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Event Tag</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-event-tag">
                        <div class="modal-body modal-edit-tag-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-tag">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $('.add-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/event_tags';
    });

    $(document).on('click','.btn-add-new-tag',function(){
        $('#modalAddNewTag').modal('show');
    });

    $(document).on('submit', '#frm-add-new-event-tag', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveEventTag';
        $(".btn-add-tag").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-event-tag")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddNewTag").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Event Tag was successfully created.",
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

                $(".btn-add-tag").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-tag', function(){
        var etid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_event_tag';

        $('#modalEditTag').modal('show');
        $(".modal-edit-tag-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {etid:etid},
             success: function(o)
             {          
                $('.modal-edit-tag-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-event-tag', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateEventTag';
        $(".btn-update-tag").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-event-tag")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalEditTag").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Event Tag was successfully updated.",
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

                $(".btn-update-tag").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-tag", function(e) {
        var etid = $(this).attr("data-id");
        var event_tag = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxDeleteEventTag';

        Swal.fire({
            title: 'Delete Event Tag',
            html: "Are you sure you want to delete event tag <b>"+event_tag+"</b> from company <b>"+company_name+"</b>?",
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
                    data: {etid:etid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Event Tag Data Deleted Successfully!",
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
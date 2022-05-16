<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.badge{
    padding: 10px;
    font-size: 14px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all event icons.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/event_icons') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Event Icons" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-icon" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Icon</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Icon Name">Icon Name</td>                            
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $icons as $i){ ?>               
                            <tr>
                                <td class="center">
                                    <?php $marker = base_url("uploads/icons/" . $i->image); ?>
                                    <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                                </td>
                                <td class="center"><?= $i->name; ?></td>
                                <td class="center actions-col">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit-icon" href="javascript:void(0)" data-id="<?php echo $i->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-icon" href="javascript:void(0);" data-name="<?= $i->name; ?>" data-id="<?= $i->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Event Type modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewIcon" tabindex="-1" aria-labelledby="modalAddNewIconLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Event Icon</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-icon">
                        <div class="modal-body">
                            <div class="row">    
                                <div class="col-md-12 mt-3">
                                    <label for="">Icon Name</label>
                                    <input type="text" name="icon_name" id="icon-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Icon / Marker</label>
                                    <input type="file" name="image_marker" class="form-control" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-icon">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Event Icon modal-->
            <div class="modal fade nsm-modal fade" id="modalEditIcon" tabindex="-1" aria-labelledby="modalEditIconLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Event Icon</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-icon">
                        <div class="modal-body modal-edit-icon-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-icon">Save</button>
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

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/event_icons';
    });

    $(document).on('click','.btn-add-new-icon',function(){
        $('#modalAddNewIcon').modal('show');
    });

    $(document).on('submit', '#frm-add-new-icon', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveEventIcon';
        $(".btn-add-icon").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-icon")[0]);   

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
                    $("#modalAddNewIcon").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Event Icon was successfully created.",
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

                $(".btn-add-icon").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-icon', function(){
        var eiid = $(this).attr('data-id');
        var url  = base_url + 'admin/ajax_edit_event_icon';

        $('#modalEditIcon').modal('show');
        $(".modal-edit-icon-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {eiid:eiid},
             success: function(o)
             {          
                $('.modal-edit-icon-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-icon', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateEventIcon';
        $(".btn-update-icon").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-icon")[0]);   

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
                    $("#modalEditIcon").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Event Icon was successfully updated.",
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

                $(".btn-update-icon").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-icon", function(e) {
        var eiid = $(this).attr("data-id");
        var icon_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteEventIcon';

        Swal.fire({
            title: 'Delete Event Icon',
            html: "Are you sure you want to delete icon name <b>"+icon_name+"</b>?",
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
                    data: {eiid:eiid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Event Icon Data Deleted Successfully!",
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
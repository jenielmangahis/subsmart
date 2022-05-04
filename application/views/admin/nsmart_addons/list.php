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
                            Listing of all addons.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/nsmart_addons') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Addons" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_addons'); ?>">All Addons</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_addons?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_addons?status=inactive'); ?>">Status Inactive</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-addon" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Addon</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Description">Description</td>
                            <td data-name="Price" style="width: 10%;">Price</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $nSmartAddons as $addon ){ ?>       
                            <tr>
                                <td class="center"><?= $addon->name; ?></td>
                                <td class="center"><?= $addon->description; ?></td>
                                <td class="center"><?= "$" . number_format($addon->price,2); ?></td>
                                <td class="center">
                                    <?php if($addon->status == 1) { ?>
                                        <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Active</span>
                                    <?php }else{ ?>
                                        <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td class="center actions-col">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit-addon" href="javascript:void(0)" data-id="<?php echo $addon->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-addon" href="javascript:void(0);" data-name="<?= $addon->name; ?>" data-id="<?= $addon->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Addon modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewAddon" tabindex="-1" aria-labelledby="modalAddNewAddonLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Addon</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-addon">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Addon Name</label>
                                    <input type="text" name="addon_name" id="addon-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Description</label>
                                    <textarea class="form-control" style="height: 200px !important;" required="" name="addon_description"></textarea>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Price</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="addon_price" value="" id="addon-price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Status</label>
                                    <select name="addon_status" class="form-control" autocomplete="off">
                                        <option value="1" selected="">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-addon">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Addon modal-->
            <div class="modal fade nsm-modal fade" id="modalEditAddon" tabindex="-1" aria-labelledby="modalEditAddonLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Addon</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-addon">
                        <div class="modal-body modal-edit-addon-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-addon">Save</button>
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
        location.href = base_url + 'admin/nsmart_addons';
    });

    $(document).on('click','.btn-add-new-addon',function(){
        $('#modalAddNewAddon').modal('show');
    });

    $(document).on('submit', '#frm-add-new-addon', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveAddon';
        $(".btn-add-addon").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-addon")[0]);   

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
                    $("#modalAddNewAddon").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Addon was successfully created.",
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

                $(".btn-add-addon").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-addon', function(){
        var aid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_addon';

        $('#modalEditAddon').modal('show');
        $(".modal-edit-addon-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {aid:aid},
             success: function(o)
             {          
                $('.modal-edit-addon-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-addon', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateAddon';
        $(".btn-update-addon").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-addon")[0]);   

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
                    $("#modalEditAddon").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Addon was successfully updated.",
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

                $(".btn-update-addon").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-addon", function(e) {
        var aid = $(this).attr("data-id");
        var addon_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteAddon';

        Swal.fire({
            title: 'Delete Addon',
            html: "Are you sure you want to delete addon <b>"+addon_name+"</b>?",
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
                    data: {aid:aid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Addon Data Deleted Successfully!",
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
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
                            Listing of all nSmart Offer Codes.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/offer_codes') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Offer Codes" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/offer_codes'); ?>">All Offer Codes</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/offer_codes?status=unused'); ?>">Status Ununsed</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/offer_codes?status=used'); ?>">Status Used</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-code" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Offer Code</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Offer Code">Offer Code</td>
                            <td data-name="Trial Days">Trial days</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $offerCodes as $offerCode){ ?>
                            <tr>
                                <td class="center"><?= $offerCode->offer_code; ?></td>
                                <td class="center"><?= $offerCode->trial_days; ?></td>
                                <td class="center">
                                    <?php if($offerCode->status == 0) { ?>
                                        <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Unused</span>
                                    <?php }else{ ?>
                                        <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Used</span>
                                    <?php } ?>
                                </td>
                                <td class="center actions-col">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit-code" href="javascript:void(0)" data-id="<?php echo $offerCode->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-code" href="javascript:void(0);" data-name="<?= $offerCode->offer_code; ?>" data-id="<?= $offerCode->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Plan modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewCode" tabindex="-1" aria-labelledby="modalAddNewCodeLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Offer Code</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-code">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Offer Code</label>
                                    <input type="text" name="offer_code" value=""  class="form-control" required="" autocomplete="off" />
                                </div>
                                <div class="col-md-12">
                                    <label for="">Trial days</label>
                                    <input type="number" name="trial_days" value="30" id="trial_days" class="form-control" required="" autocomplete="off" min="0" step="1" />
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" autocomplete="off">                                        
                                        <option value="0">Unused</option>
                                        <option value="1">Used</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-code">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Plan modal-->
            <div class="modal fade nsm-modal fade" id="modalEditCode" tabindex="-1" aria-labelledby="modalEditCodeLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Offer Code</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-code">
                        <div class="modal-body modal-edit-code-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-code">Save</button>
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
        location.href = base_url + 'admin/offer_codes';
    });

    $(document).on('click','.btn-add-new-code',function(){
        $('#modalAddNewCode').modal('show');
    });

    $(document).on('submit', '#frm-add-new-code', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveOfferCode';
        $(".btn-add-code").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-code")[0]);   

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
                    $("#modalAddNewCode").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Offer Code was successfully created.",
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

                $(".btn-add-code").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-code', function(){
        var oid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_offer_code';

        $('#modalEditCode').modal('show');
        $(".modal-edit-code-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {oid:oid},
             success: function(o)
             {          
                $('.modal-edit-code-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-code', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateOfferCode';
        $(".btn-update-code").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-code")[0]);   

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
                    $("#modalEditCode").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Offer Code was successfully updated.",
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

                $(".btn-update-code").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-code", function(e) {
        var oid = $(this).attr("data-id");
        var offer_code = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteOfferCode';

        Swal.fire({
            title: 'Delete Offer Code',
            html: "Are you sure you want to delete offer code <b>"+offer_code+"</b>?",
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
                    data: {oid:oid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Offer Code Deleted Successfully!",
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
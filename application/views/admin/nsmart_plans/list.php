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
                            Listing of all nSmart Plans.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/nsmart_plans') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search nSmart Plans" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_plans'); ?>">All Addons</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_plans?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/nsmart_plans?status=inactive'); ?>">Status Inactive</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-plan" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New nSmart Plan</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Plan Name">Plan</td>
                            <td data-name="Plan Description">Description</td>
                            <td data-name="Number License" style="width: 10%;">Number of License</td>
                            <td data-name="Price Per License" style="width:10%;">Price per License</td>
                            <td data-name="Plan Price" style="width:10%;">Plan Price</td>                            
                            <td data-name="Discount Price" style="width:10%;">Discount Price</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $nSmartPlans as $p ){ ?>
                            <tr>
                                <td class="center"><?= $p->plan_name; ?></td>
                                <td class="center"><?= $p->plan_description; ?></td>
                                <td class="center"><?= $p->num_license; ?></td>
                                <td class="center">$<?= number_format($p->price_per_license,2); ?></td>
                                <td class="center">$<?= number_format($p->price,2); ?></td>
                                <td class="center"><?= $p->discount . " - " . $option_discount_types[$p->discount_type]; ?></td>
                                <td class="center">
                                    <?php if($p->status == 1) { ?>
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
                                                <a class="dropdown-item btn-edit-plan" href="javascript:void(0)" data-id="<?php echo $p->nsmart_plans_id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-plan" href="javascript:void(0);" data-name="<?= $p->plan_name; ?>" data-id="<?= $p->nsmart_plans_id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Plan modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewPlan" tabindex="-1" aria-labelledby="modalAddNewPlanabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New nSmart Plan</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-plan">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Plan Name</label>
                                    <input type="text" name="plan_name" id="plan-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Description</label>
                                    <textarea class="form-control" style="height: 100px !important;" required="" name="plan_description"></textarea>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Default Number of License</label>
                                    <input type="text" name="num_license" id="default-num-license" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Plan Price</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="plan_price" value="" id="plan-price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Price per License</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="price_per_license" value="" id="price-per-license" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="">Discount</label>
                                            <input type="number" name="plan_discount" value="" id="plan_discount" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                        </div>
                                        <div class="col-6">
                                            <label for="">Discount Type</label>
                                            <select name="plan_discount_type" class="form-control">
                                                <?php foreach( $option_discount_types as $key => $value ){ ?>
                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="">Status</label>
                                    <select name="plan_status" class="form-control" autocomplete="off">
                                        <?php foreach($option_status as $key => $value){ ?>
                                            <option value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-plan">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Plan modal-->
            <div class="modal fade nsm-modal fade" id="modalEditPlan" tabindex="-1" aria-labelledby="modalEditPlanLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit nSmart Plan</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-plan">
                        <div class="modal-body modal-edit-plan-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-plan">Save</button>
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

    $(document).on('click','.btn-add-new-plan',function(){
        $('#modalAddNewPlan').modal('show');
    });

    $(document).on('submit', '#frm-add-new-plan', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveNsmartPlan';
        $(".btn-add-plan").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-plan")[0]);   

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
                    $("#modalAddNewPlan").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "nSmart Plan was successfully created.",
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

                $(".btn-add-plan").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-plan', function(){
        var nspid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_nsmart_plan';

        $('#modalEditPlan').modal('show');
        $(".modal-edit-plan-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {nspid:nspid},
             success: function(o)
             {          
                $('.modal-edit-plan-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-plan', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateNsmartPlan';
        $(".btn-update-plan").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-plan")[0]);   

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
                    $("#modalEditPlan").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "nSmart Plan was successfully updated.",
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

                $(".btn-update-plan").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-plan", function(e) {
        var nspid = $(this).attr("data-id");
        var plan_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteNsmartPlan';

        Swal.fire({
            title: 'Delete nSmart Plan',
            html: "Are you sure you want to delete nSmart plan <b>"+plan_name+"</b>?",
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
                    data: {nspid:nspid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "nSmart Plan Data Deleted Successfully!",
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
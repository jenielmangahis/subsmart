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
                            Listing of all companies.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/companies') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Companies" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by: <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies'); ?>">All Companies</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=deactivated'); ?>">Status Deactivated</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=expired'); ?>">Status Expired</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_company_list') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <!-- <a class="nsm-button primary btn-add-user" href="javascript:void(0);"><i class='bx bx-fw bx-user'></i> Create User</a> -->                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Company Name">Company Name</td>
                            <td data-name="Contact Name">Contact Name</td>
                            <td data-name="Industry">Industry</td>
                            <td data-name="Plan">Plan</td>
                            <td data-name="Num License" style="width:10%;">Number of License</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($companies as $c) { ?>
                            <?php if($c->bp_business_name != ''){ ?>
                                <?php 
                                    $status = "-";
                                    if( $c->is_plan_active == 1 ){
                                        $cell = 'cell-active';
                                        $status = "Active";
                                    }elseif( $c->is_plan_active == 3 ){
                                        $cell = 'cell-inactive';
                                        $status = "Deactivated";
                                    }else{
                                        $cell = 'cell-inactive';
                                        $status = "Expire";
                                    }
                                ?>                                    
                                <tr>
                                    <td class="center"><?= $c->bp_business_name; ?></td>
                                    <td class="center">
                                        <?php 
                                            if( $c->bp_contact_name != '' ){
                                                echo $c->bp_contact_name;
                                            }else{
                                                echo "---";
                                            }
                                        ?>
                                    </td>
                                    <td class="center"><?= $c->industry_type_name; ?></td>
                                    <td class="center">
                                        
                                        <div class="col-sm-8 col-md-8" style="background-color: #909da7;padding:5px">
                                            <div class="plan-option-box" style="color: #ffffff;">
                                                <span class="plan-option-box-header">
                                                   <?= $c->plan_name; ?>
                                                </span>
                                                <div class="plan-option-box-cnt">
                                                    <span class="plan-option-box-value">$<?= $c->price; ?></span>
                                                    <span class="plan-option-box-name">Subscription</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <span class=""><strong>Next Billing:</strong> Month XX, XXXX</span> -->

                                    </td>
                                    <td class="center"><?= $c->number_of_license; ?></td>
                                    <td class="center">                                
                                        <?php if($c->is_plan_active == 1) { ?>
                                            <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Active</span>
                                        <?php }elseif( $c->is_plan_active == 3 ){ ?>
                                            <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Deactivated</span>
                                        <?php }else{ ?>
                                            <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Expired</span>
                                        <?php } ?>
                                    </td>
                                    <td class="center actions-col">
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-view-subscription-details" href="javascript:void(0)" data-id="<?php echo $c->id ?>"><i class='bx bx-fw bxs-show'></i> View Details</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-manage-company-modules" data-name="<?= $c->bp_business_name; ?>" href="javascript:void(0)" data-id="<?php echo $c->id ?>"><i class="bx bx-fw bx-edit"></i> Manage Modules</a>
                                                </li>
                                                <li>
                                                <?php if( $c->is_plan_active == 1 ){ ?>
                                                        <a href="javascript:void(0)" data-name="<?= $c->bp_business_name; ?>" data-id="<?php echo $c->id ?>" class="deactivate-company dropdown-item"><i class="bx bx-fw bxs-x-square"></i> Deactivate</a>
                                                <?php }else{ ?>
                                                        <a href="javascript:void(0)" data-name="<?= $c->bp_business_name; ?>" data-id="<?php echo $c->id ?>" class="activate-company dropdown-item"><i class="bx bx-fw bxs-check-square"></i> Activate</a>
                                                <?php } ?>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-company" href="javascript:void(0);" data-name="<?= $c->bp_business_name; ?>" data-id="<?= $c->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--View company modal-->
            <div class="modal fade nsm-modal fade" id="modalViewSubscriptionDetails" tabindex="-1" aria-labelledby="modalViewSubscriptionDetailsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Company Subscription</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body modal-view-subscription-details-container" style="max-height:600px; overflow-y: auto;"></div>                        
                    </div>
                </div>
            </div>

            <!--Edit company module modal-->
            <div class="modal fade nsm-modal fade" id="modalManageCompanyModules" tabindex="-1" aria-labelledby="modalManageCompanyModulesLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label"><span class="module-company-name"></span> : Manage Modules</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body modal-company-modules-container" style="max-height:600px; overflow-y: auto;"></div>                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click','.btn-view-subscription-details', function(){
        var sid = $(this).attr("data-id");
        var url = base_url + 'admin/ajax_load_subscriber_details';

        $("#modalViewSubscriptionDetails").modal('show');

        $(".modal-view-subscription-details-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {sid:sid},
               success: function(o)
               {
                  $(".modal-view-subscription-details-container").html(o);                  
               }
            });
        }, 500);

    });

    $(document).on("click", ".deactivate-company", function(e) {
        var cid = $(this).attr("data-id");
        var company_name = $(this).attr('data-name');
        var status = 3;
        var url = base_url + 'admin/ajaxUpdateCompanyStatus';

        Swal.fire({
            title: 'Deactivate Company',
            html: "Are you sure you want to deactivate company <b>"+company_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {cid:cid, status:status},
                    success: function(result) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Company data was successfully updated!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    },
                });
            }
        });
    });

    $(document).on('click', '.btn-manage-company-modules', function(){
        var cid = $(this).attr("data-id");
        var cname = $(this).attr('data-name');
        var url = base_url + 'admin/ajax_load_company_module_details';

        $("#modalManageCompanyModules").modal('show');
        $('.module-company-name').html(cname);
        $(".modal-company-modules-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {cid:cid},
               success: function(o)
               {
                  $(".modal-company-modules-container").html(o);
               }
            });
        }, 500);
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/companies';
    });

    $(document).on("click", ".activate-company", function(e) {
        var cid = $(this).attr("data-id");
        var company_name = $(this).attr('data-name');
        var status = 1;
        var url = base_url + 'admin/ajaxUpdateCompanyStatus';

        Swal.fire({
            title: 'Activate Company',
            html: "Are you sure you want to activate company <b>"+company_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {cid:cid, status:status},
                    success: function(result) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Company data was successfully updated!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    },
                });
            }
        });
    });

    $(document).on("click", ".delete-company", function(e) {
        var cid = $(this).attr("data-id");
        var company_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteCompany';

        Swal.fire({
            title: 'Delete Company',
            html: "Are you sure you want to delete company <b>"+company_name+"</b>?<br /><br /><small><b>Warning : You wont be able to revert this.</b></small>",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {cid:cid},
                    dataType: "json",
                    success: function(result) {
                        if( result.is_success == 1 ){
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Company Deleted Successfully!",
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

    $(".btn-view-subscription-details").click(function(){
        $("#modalViewSubscriptionDetails").modal('show');

        var sid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + 'admin/ajax_load_subscriber_details';

        $(".modal-view-subscription-details-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {sid:sid},
               success: function(o)
               {
                  $(".modal-view-subscription-details-container").html(o);                  
               }
            });
        }, 500);

    });

});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>
<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/group_add') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_groups_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A customer group is a way of aggregating customers that are similar in some way. For example, you may
                            use them to distinguish between retail and wholesale customers or between company employees and external customers etc..
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6 grid-mb">
                        <form action="<?php echo base_url('customer/group') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>   
                    </div>                  
                    <?php if( checkRoleCanAccessModule('customer-groups', 'write') ){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-create-customer-group">
                                <i class='bx bx-fw bx-group'></i> Add New
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Title">Title</td>
                            <td data-name="Description">Description</td>
                            <td data-name="Count" style="width:10%;">Number of Customer</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customerGroups)) : ?>
                            <?php foreach ($customerGroups as $customerGroup) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-chart'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $customerGroup->title ?></td>
                                    <td><?= $customerGroup->description; ?></td>
                                    <td style="text-align:center;"><?= countCustomerByGroup($customerGroup->id); ?></td>
                                    <td>
                                        <?php if( checkRoleCanAccessModule('customer-groups', 'write') || checkRoleCanAccessModule('customer-groups', 'delete') ){ ?>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if( checkRoleCanAccessModule('customer-groups', 'write') ){ ?>
                                                        <li><a class="dropdown-item edit-item" data-id="<?= $customerGroup->id; ?>" data-name="<?= $customerGroup->title; ?>" data-description="<?= $customerGroup->description; ?>" href="javascript:void(0);">Edit</a></li>
                                                    <?php } ?>
                                                    <?php if( checkRoleCanAccessModule('customer-groups', 'delete') ){ ?>
                                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $customerGroup->id; ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
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
            
            <!-- Create Customer Group -->
            <div class="modal fade nsm-modal fade" id="modal-create-customer-group" tabindex="-1" aria-labelledby="modal-create-customer-group_label" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form id="frm-create-customer-group" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Add New</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                        <input type="text" name="group_name" id="group-name" class="nsm-field form-control" value="" placeholder="" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                        <textarea name="group_description" id="group-description" class="form-control"></textarea>                                        
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-save-customer-group">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Customer Group -->
            <div class="modal fade nsm-modal fade" id="modal-edit-customer-group" tabindex="-1" aria-labelledby="modal-edit-customer-group_label" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form id="frm-update-customer-group" method="POST">
                        <input type="hidden" name="gid" id="gid" value="" />
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Edit</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                        <input type="text" name="group_name" id="edit-group-name" class="nsm-field form-control" value="" placeholder="" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                        <textarea name="group_description" id="edit-group-description" class="form-control"></textarea>                                        
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-update-customer-group">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $('#btn-create-customer-group').on('click', function(){
            $('#modal-create-customer-group').modal('show');
        });

        $('.edit-item').on('click', function(){
            var gid = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var description = $(this).attr('data-description');

            $('#gid').val(gid);
            $('#edit-group-name').val(name);
            $('#edit-group-description').val(description);

            $('#modal-edit-customer-group').modal('show');
        });

        $('#frm-create-customer-group').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer/_create_customer_group",
                dataType: 'json',
                data: $('#frm-create-customer-group').serialize(),
                success: function(data) {    
                    $('#btn-save-customer-group').html('Save');                   
                    if (data.is_success) {
                        $('#modal-create-customer-group').modal('hide');
                        Swal.fire({
                            title: "Customer Group",
                            text: "Customer group was successfully created.",
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
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-save-customer-group').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-customer-group').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer/_update_customer_group",
                dataType: 'json',
                data: $('#frm-update-customer-group').serialize(),
                success: function(data) {    
                    $('#btn-update-customer-group').html('Save');                   
                    if (data.is_success) {
                        $('#modal-edit-customer-group').modal('hide');
                        Swal.fire({
                            title: "Customer Group",
                            text: "Customer group was successfully updated.",
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
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-update-customer-group').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        /*$("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");
            _form.submit();
        }, 1000));*/  
        
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Customer Group',
                text: "Are you sure you want to delete this Customer Group?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/group_delete",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            Swal.fire({
                                //title: 'Good job!',
                                text: "Data Deleted Successfully!",
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
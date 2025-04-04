<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_lead_source_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6 grid-mb">
                        <form action="<?php echo base_url('customer/settings_lead_source') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>   
                    </div>  

                    <div class="col-6 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_lead_source_modal">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Date Created" style="width:10%;">Date Created</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($lead_source)) :
                        ?>
                            <?php
                            foreach ($lead_source as $source) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-notepad'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $source->ls_name; ?></td>
                                    <td><?= date("m/d/Y h:i A",strtotime($source->date_created)); ?></td>
                                    <td>
                                        <?php if( $source->fk_company_id > 0 ){ ?>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $source->ls_id; ?>" data-name="<?= $source->ls_name; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?= $source->ls_name; ?>" data-id="<?= $source->ls_id; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
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
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        /*$("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");
            _form.submit();
        }, 1000));*/ 
        
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".edit-item", function(){
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#edit_ls_id").val(id);
            $("#edit_ls_name").val(name);

            $("#edit_lead_source_modal").modal("show");
        });

        $("#new_lead_source_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/add_leadsource_ajax";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success == 1) {
                        $("#new_lead_source_modal").modal('hide');
                        _this.trigger("reset");

                        Swal.fire({
                            title: 'Lead Source',
                            text: "New lead source has been added successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#edit_lead_source_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/update_leadsource_ajax";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:"json",
                success: function(result) {
                    if (result.is_success == 1) {
                        $("#edit_lead_source_modal").modal('hide');
                        _this.trigger("reset");

                        Swal.fire({
                            title: 'Lead Source',
                            text: "Lead source has been updated successfully.",
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
                            title: 'Error',
                            text: result.msg,
                        });
                    }
                    
                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Lead Source',
                html: `Are you sure you want to delete this lead source <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customer/delete_lead_source",
                        data: {id: id},
                        dataType:"json",
                        success: function(result) {
                            if (result.is_success ) {
                                Swal.fire({
                                    title: 'Lead Source',
                                    text: "Data deleted successfully!",
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
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
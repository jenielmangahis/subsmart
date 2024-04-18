<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_customer_status_modal">
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
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_customer_status_modal">
                                <i class='bx bx-fw bx-bar-chart-square'></i> New Customer Status
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Date Created" style="width:10%;">Date Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($customerStatus)) :
                        ?>
                            <?php
                            foreach ($customerStatus as $cs) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-bar-chart-square'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $cs->name; ?></td>
                                    <td><?= date("Y-m-d", strtotime($cs->date_created)); ?></td>
                                    <td>
                                        <?php if( $cs->company_id > 0 ){ ?>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-item customer-status-item" href="javascript:void(0);" data-id="<?= $cs->id; ?>" data-name="<?= $cs->name; ?>" data-bs-toggle="modal" data-bs-target="#edit_customer_status_modal">Edit</a>
                                                </li>
                                                
                                                <li>
                                                    <a class="dropdown-item delete-item delete-customer-status-item" href="javascript:void(0);" data-id="<?= $cs->id; ?>">Delete</a>
                                                </li>                                                
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

        $("#new_customer_status_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/_add_customer_status";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success === 1) {
                        $("#new_customer_status_modal").modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Customer Status has been created successfully.",
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
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#edit_customer_status_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/_update_customer_status";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success === 1) {
                        $("#edit_customer_status_modal").modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Customer Status has been updated successfully.",
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
                            title: 'Error!',
                            html: result.msg
                        });
                    }
                    
                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".customer-status-item", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            
            $("#edit_cs_id").val(id);
            $("#edit_cs_name").val(name);
        });

        $(document).on("click", ".delete-customer-status-item", function() {
            let csid = $(this).attr("data-id");

            Swal.fire({
                title: 'Delete Customer Status',
                text: "Are you sure you want to delete selected customer status?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/_delete_customer_status",
                        data: {
                            csid: csid
                        },
                        dataType:'json',
                        success: function(result) {
                            console.log(result);
                            if (result.is_success === 1) {
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
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
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
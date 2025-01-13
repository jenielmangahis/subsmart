<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_activation_fee_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
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
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_activation_fee_modal">
                                <i class='bx bx-fw bx-plus'></i> New Activation Fee
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Date Created" style="width:10%;">Date Created</td>
                            <td data-name="Manage" style="width:1%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($activation_fee)) :
                        ?>
                            <?php
                            foreach ($activation_fee as $fee) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-dollar-circle'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary">$<?= $fee->amount; ?></td>
                                    <td><?= date("m/d/Y h:i A",strtotime($fee->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $fee->id; ?>" data-amount="<?= $fee->amount; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-amount="<?= $fee->amount; ?>" data-id="<?= $fee->id; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
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
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".edit-item", function() {
            let id = $(this).attr("data-id");
            let amount = $(this).attr("data-amount");

            $("#edit_fee_id").val(id);
            $("#edit_fee_amount").val(amount);

            $("#edit_activation_fee_modal").modal("show");
        });

        $("#new_activation_fee_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "customers/_create_activation_fee";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success) {
                        $("#new_activation_fee_modal").modal('hide');
                        _this.trigger("reset");

                        Swal.fire({
                            title: 'Rate Plans',
                            text: "Rate plan has been updated successfully.",
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

        $("#edit_activation_fee_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "customers/_update_activation_fee";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:"json",
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Activation Fee',
                            text: "Activation fee has been updated successfully.",
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
                    $("#edit_activation_fee_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let amount = $(this).attr('data-amount');

            Swal.fire({
                title: 'Delete Activation Fee',
                html: `Are you sure you want to delete activation fee amounting of <b>${amount}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customers/_delete_activation_fee",
                        data: {id: id},
                        dataType:"json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Activation Fee',
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
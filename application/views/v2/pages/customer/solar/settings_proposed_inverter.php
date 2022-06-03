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
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_proposed_inverter_modal">
                                <i class='bx bx-fw bx-notepad'></i> New Proposed Inverter
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Date Created">Date Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($lender_types)) :
                        ?>
                            <?php
                            foreach ($lender_types as $type) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-notepad'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $type->name; ?></td>
                                    <td><?= date("d-m-Y h:i A",strtotime($type->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $type->name; ?>">Delete</a>
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

        $(document).on("click", ".edit-item", function(){
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#edit_ls_id").val(id);
            $("#edit_ls_name").val(name);

            $("#edit_lead_source_modal").modal("show");
        });

        $("#new_proposed_inverter_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/settings_solar_inverter";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    if (result === "Updated") {
                        
                    } else {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "New Proposed Inverter has been added successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                    $("#new_lender_type_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");

            Swal.fire({
                title: 'Delete Proposed Inverter',
                text: "Are you sure you want to delete this Proposed Inverter?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/settings_solar_inverter",
                        data: {
                            lenderName : id
                        },
                        success: function(result) {
                            if (result === '1') {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
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
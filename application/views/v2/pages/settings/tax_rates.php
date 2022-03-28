<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
        <i class="bx bx-receipt"></i>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing all your predefined tax rates.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_tax_rate_modal">
                                <i class='bx bx-fw bx-dollar-circle'></i> New Rate
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Rate">Rate</td>
                            <td data-name="Default">Default</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($taxRates)) :
                        ?>
                            <?php
                            foreach ($taxRates as $tax_rate) :
                                if ($tax_rate->is_default == 1):
                                    $value = 'Yes'; 
                                    $badge = "success";
                                else:
                                    $value = 'No'; 
                                    $badge = "";
                                endif;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-dollar-circle'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary nsm-link default"><?= $tax_rate->name; ?></td>
                                    <td><?= $tax_rate->rate; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $value; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $tax_rate->id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $tax_rate->id; ?>">Delete</a>
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
                                <td colspan="11">
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
            let tid = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>settings/ajax_edit_tax_rate";

            $("#tid").val(tid);
            $("#edit_tax_rate_modal").modal("show");

            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o){
                  $("#edit_tax_rate_cont").html(o);
               }
            });
        });

        $(document).on("click", ".delete-item", function(){
            let tid = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>settings/delete_tax_rate";

            Swal.fire({
                title: 'Delete Tax Rate',
                text: "Are you sure you want to delete this Tax Rate?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {tid:tid},
                        success: function(o){
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
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
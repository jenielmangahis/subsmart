<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('plans/add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-calendar-alt"></i>
            </div>
            <span class="nsm-fab-label">New Plan</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate__tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage Estimate Plans.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Plan">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('estimate-settings', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('plans/add') ?>'">
                                <i class='bx bx-fw bx-plus'></i> New Plan
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name" style="width:90%;">Name</td>
                            <td data-name="Status">Is Enabled</td>
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($plans)) :
                        ?>
                            <?php
                            foreach ($plans as $plan) :
                                if( $plan->status == 1 ){
                                    $cell   = 'success';
                                    $status = 'Yes';
                                }else{
                                    $cell   = 'secondary';
                                    $status = 'No';
                                } 
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-calendar-alt'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $plan->plan_name ?></td>
                                    <td><span class="nsm-badge badge <?= $cell ?>" style="display:block;width:100%;"><?= $status; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('estimate-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo url('plans/edit/'.$plan->id) ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('estimate-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $plan->id; ?>" data-name="<?= $plan->plan_name; ?>">Delete</a>
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

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));

        $(document).on("click", ".delete-item", function() {
            let plan_id = $(this).attr("data-id");
            let plan_name = $(this).attr('data-name');

            Swal.fire({
                title: "Delete Plan",
                html: `Are you sure you want to delete plan <b>${plan_name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>plans/delete_plan_v2",
                        data: {
                            id: plan_id
                        },
                        success: function(result) {
                            Swal.fire({
                                //title: 'Good job!',
                                text: "Plan has been deleted successfully.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                    });
                }                
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
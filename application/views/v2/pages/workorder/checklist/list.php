<?php include viewPath('v2/includes/header'); ?>

<style>
    #cke_updateheader {
        border-radius: 5px;
        overflow: hidden;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders.  This can be attached to estimate, workorder, invoices.  A powerful addition to your forms.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('/workorder/add_checklist') ?>'">
                                <i class='bx bx-fw bx-list-check'></i> Add Checklist
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('workorder') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" value="" placeholder="Search Checklist">
                            </div>
                        </form>
                    </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Checklist Name">Checklist Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($checklists)) :
                        ?>
                            <?php
                            foreach ($checklists as $checklist) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-list-check'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $checklist->checklist_name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-item" href="<?php echo base_url('/workorder/edit_checklist/' . $checklist->id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" data-id="<?= $checklist->id; ?>" href="javascript:void(0);">Delete</a>
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

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));
    });

    $(document).on("click", ".delete-item", function(event) {
        var ID = $(this).attr("data-id");

        Swal.fire({
            title: 'Continue to REMOVE this checklist?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('workorder/_delete_checklist') ?>",
                    dataType: "json",
                    data: {cid: ID},
                    success: function(data) {
                        if (data.is_success === 1) {
                            Swal.fire({
                                //title: 'Great!',
                                text: "Checklist was successfully deleted!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
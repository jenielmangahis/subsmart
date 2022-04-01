<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('job/add_new_job_type'); ?>'">
        <i class='bx bx-book'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            In our software, jobs are project that an invoice will need to be issued for payment. This will help organize your projects into categories and will help you see the profitability of your business based on the various job type.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('job/add_new_job_type'); ?>'">
                                <i class='bx bx-fw bx-book'></i> New Job Type
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Type Name">Job Type Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($job_types)) :
                        ?>
                            <?php
                            foreach ($job_types as $types) :
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($types->icon_marker != '') :
                                            if ($types->is_marker_icon_default_list == 1) :
                                                $marker = base_url("uploads/icons/" . $types->icon_marker);
                                            else :
                                                $marker = base_url("uploads/job_types/" . $types->company_id . "/" . $types->icon_marker);
                                            endif;
                                        else :
                                            $marker = base_url("uploads/job_types/default_no_image.jpg");
                                        endif;
                                        ?>
                                        <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $types->title; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/edit_job_type/' . $types->id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $types->id; ?>">Delete</a>
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
                                <td colspan="3">
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

        $(document).on("click", ".delete-item", function( event ) {
            var ID = $(this).attr("data-id");

            Swal.fire({
                title: 'Are you sure to remove this Job Type?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('/job/delete_job_type') ?>",
                        data: {type_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.reload();
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
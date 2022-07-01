<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/more/online_booking_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Online booking system is a software solution that allows potential guests to self-book and pay through your website, and other channels, while giving you the best tools to run and scale your operation, all in one place.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_category_modal">
                                <i class="bx bx-fw bx-category-alt"></i> Add Category
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#add_service_item_modal">
                                <i class="bx bx-fw bx-radio-circle-marked"></i> Add Service/Item
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Categories & Products">Categories & Products</td>
                                    <td data-name="Visible">Visible</td>
                                    <td data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($category)) :
                                ?>
                                    <?php
                                    foreach ($category as $cat) :
                                    ?>
                                        <tr class="primary">
                                            <td class="fw-bold nsm-text-primary" colspan="2"><?php echo $cat->name; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-category" href="javascript:void(0);" data-id="<?php echo $cat->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-category" href="javascript:void(0);" data-id="<?php echo $cat->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if (array_key_exists($cat->id, $service_items)) : ?>
                                            <?php $service_item = $service_items[$cat->id]; ?>

                                            <?php foreach ($service_item as $sitem) : ?>
                                                <tr>
                                                    <?php
                                                    $service_item_thumb = $sitem->image;
                                                    if (file_exists('uploads/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {

                                                        $service_item_thumb_img = base_url('/assets/dashboard/images/online-booking.png');
                                                        if (file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                                                            $service_item_thumb_img = base_url('/assets/dashboard/images/online-booking.png');
                                                        } else {
                                                            $service_item_thumb_img = base_url('uploads/service_item/' . $service_item_thumb);
                                                        }
                                                    } else {
                                                        $service_item_thumb_img = base_url('uploads/' . $service_item_thumb);
                                                    }
                                                    ?>
                                                    <td class="nsm-text-primary">
                                                        <div class="d-flex">
                                                            <div class="me-4">
                                                                <div class="table-row-icon img" style="background-image: url('<?php echo $service_item_thumb_img; ?>')"></div>
                                                            </div>
                                                            <div>
                                                                <label class="nsm-link default d-block fw-bold"><?= $sitem->name; ?></label>
                                                                <label class="content-subtitle fst-italic d-block"><?= $sitem->description; ?></label>
                                                                <label class="content-subtitle d-block">Price: $<?= $sitem->price; ?>/<?= $sitem->price_unit; ?></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch nsm-switch">
                                                            <input class="form-check-input product-status-switch" name="product-status[]" type="checkbox" id="switch_<?= $sitem->id; ?>" data-product-id="<?= $sitem->id; ?>" <?= $sitem->is_visible == 1 ? 'checked=""' : ''; ?>>
                                                            <label class="form-check-label" for="switch_<?= $sitem->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown table-management">
                                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item edit-service" href="javascript:void(0);" data-id="<?php echo $sitem->id; ?>">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item delete-service" href="javascript:void(0);" data-name="<?php echo $sitem->name; ?>" data-id="<?php echo $sitem->id; ?>">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".edit-category", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let url = "<?php echo base_url('booking/ajax_edit_category'); ?>";
            showLoader($("#edit_category_container"));

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    cat_id: id
                },
                success: function(result) {
                    $("#edit_category_modal").modal("show");
                    $("#edit_category_container").html(result);
                }
            });
        });

        $(document).on("click", ".delete-category", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Category',
                text: "Delete selected category & associated services/items?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>booking/delete_category",
                        data: {
                            cat_id: id,
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Success!',
                                text: "Category has been deleted succesfully.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error',
                                text: "Something went wrong, please try again later.",
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },

                    });
                }
            });
        });

        $(document).on("click", ".edit-service", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let url = "<?php echo base_url('booking/ajax_edit_service_item'); ?>";
            showLoader($("#edit_service_container"));

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    siid: id
                },
                success: function(result) {
                    $("#edit_service_item_modal").modal("show");
                    $("#edit_service_container").html(result);
                }
            });
        });

        $(document).on("click", ".delete-service", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Service',
                text: "Delete selected services/items?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>booking/delete_service_item",
                        data: {
                            siid: id,
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Success!',
                                text: "Service item has been deleted succesfully.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error',
                                text: "Something went wrong, please try again later.",
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },

                    });
                }
            });
        });

        $(document).on("change", ".product-status-switch", function() {
            let id = $(this).attr("data-product-id");
            let isActive = $(this).prop("checked") ? 1 : 0;
            let url = "<?php echo base_url(); ?>booking/ajax_save_service_item_visible_status";

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    service_item_id: id,
                    is_visible: isActive
                },
                dataType: "JSON",
                success: function(result) {
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
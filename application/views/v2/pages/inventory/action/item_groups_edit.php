<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Update Item Category.
    </div>
</div>
<form id="item_category_form">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span class="d-block">
                                            <div class="right-text">
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bx-fw bx-category'></i>&nbsp;Edit Item Category</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <input type="hidden" name="icid" value="<?php echo $itemCategory->item_categories_id; ?>">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Name</strong>
                                            <input value="<?php echo $itemCategory->name; ?>" type="text" class="form-control" name="category_name" id="category_name" required/>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <strong>Description</strong>
                                            <textarea class="form-control" name="category_description" id="category_description"><?php echo $itemCategory->description; ?></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                                <button class="nsm-button" type="button" onclick="window.location.replace('/inventory/item_groups')">Cancel</button>
                                                <button type="submit" class="nsm-button primary"><i class='bx bx-save'></i>&nbsp;Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$("#item_category_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form);
    //var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/inventory/_update_item_category",
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            // console.log(data);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Category was added successfully!',
    }).then((result) => {
        window.location.href = "/inventory/item_groups";
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
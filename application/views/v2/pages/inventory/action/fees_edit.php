<?php include viewPath('v2/includes/header'); ?>
<!-- <?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?> -->

<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Update Inventory Fee.
    </div>
</div>
<form id="fees_form">
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bx-fw bx-dollar-circle'></i>&nbsp;Edit Inventory Fee</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <strong>Name</strong>
                                            <input value="<?php echo $item->title; ?>" type="text" class="form-control " name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Price</strong>
                                            <input value="<?php echo $item->price; ?>" type="number" step="any" class="form-control" name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Frequency</strong>
                                            <select class="form-control" name="frequency" id="frequency" required>
                                                <option <?php echo $item->frequency == 'One Time' ? 'selected' : ''; ?> value="One Time" selected>One Time</option>
                                                <option <?php echo $item->frequency == 'Daily' ? 'selected' : ''; ?> value="Daily">Daily</option>
                                                <option <?php echo $item->frequency == 'Monthly' ? 'selected' : ''; ?> value="Monthly">Monthly</option>
                                                <option <?php echo $item->frequency == 'Yearly' ? 'selected' : ''; ?> value="Yearly">Yearly</option>
											</select>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <strong>Description</strong>
                                            <textarea class="form-control " name="description" id="description"><?php echo $item->description; ?></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                            	<input type="hidden" name="type" value="fees"/>
                                                <input type="hidden" name="fid" value="<?php echo $item->id; ?>">
                                                <button class="nsm-button" type="button" onclick="window.location.replace('/inventory/fees')">Cancel</button>
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
$("#fees_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form);
    //var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/inventory/update_fees",
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            // console.log(data);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Inventory Fee was updated successfully!',
    }).then((result) => {
        window.location.href = "/inventory/fees";
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
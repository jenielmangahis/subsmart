<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Update a Service.
    </div>
</div>
<form id="service_form">
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-wrench'></i>&nbsp;Edit <?= $item->title; ?> Service</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-lg-3 mb-2">
                                            <strong>Service Name</strong>
                                            <input value="<?= $item->title; ?>" type="text" class="form-control " name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Price</strong>
                                            <input value="<?= number_format($item->price,2); ?>" type="number" step="any" class="form-control" name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Frequency</strong>
                                            <select class="form-control" name="frequency" id="frequency" required>
                                                        <option <?= $item->frequency == 'One Time' ? 'selected="selected"' : ''; ?> value="One Time" selected>One Time</option>
                                                        <option <?= $item->frequency == 'Daily' ? 'selected="selected"' : ''; ?> value="Daily">Daily</option>
                                                        <option <?= $item->frequency == 'Monthly' ? 'selected="selected"' : ''; ?> value="Monthly">Monthly</option>
                                                        <option <?= $item->frequency == 'Yearly' ? 'selected="selected"' : ''; ?> value="Yearly">Yearly</option>
											</select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Time Estimate</strong>
                                            <input type="time" class="form-control TIME_ESTIMATE" id="TIME_ESTIMATE" required/>
                                            <input value="<?= $item->estimated_time; ?>" class="d-none" type="text" class="form-control" name="estimated_time" id="estimated_time" readonly/>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <strong>Description</strong>
                                            <textarea class="form-control " name="description" id="description"><?= $item->description; ?></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                            	<input type="hidden" name="type" value="service"/>
                                                <input type="hidden" name="sid" value="<?= $item->id; ?>"/>     
                                                <button class="nsm-button" type="button" onclick="window.location.replace('/inventory/services')">Cancel</button>
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
$("#service_form").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    console.log(form);
    //var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/inventory/update_service_item",
        data: form.serialize(), // serializes the form's elements.
        success: function (data) {
            // console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Service was updated successfully!',
            }).then((result) => {
                window.location.href = "/inventory/services";
            });
        }
    });
});

$('#TIME_ESTIMATE').change(function (event) {
    $('#estimated_time').val(moment($('#TIME_ESTIMATE').val(), 'hh:mm').format('hh:mm A'));
});
$('#TIME_ESTIMATE').val(moment('<?= $item->estimated_time; ?>', 'hh:mm A').format('HH:mm'));
</script>
<?php include viewPath('v2/includes/footer'); ?>
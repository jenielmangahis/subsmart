<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>
<style>
.custom-header {
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
    display: block;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row mt-3 mb-3">
                    <div class="col-12 mb-2">
                        <label class="content-title custom-header">Selected Services:</label>
                    </div>
                    <div class="col-12">
                        <?php if (count($selectedCategories) > 0) : ?>
                            <?php foreach ($selectedCategories as $s) { ?>
                                <span class="nsm-badge primary" style="display:inline-block;margin-top:5px;"><?= $s->service_name; ?></span>
                            <?php } ?>
                        <?php else : ?>
                            <label class="content-subtitle">No selected services found.</label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if( checkRoleCanAccessModule('company-my-services', 'write') ){ ?>
                    <?php echo form_open_multipart(null, ['id' => 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <?php } ?>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="accordion">
                            <?php
                            $service = 1;
                            $is_enabled = checkRoleCanAccessModule('company-my-services', 'write');
                            foreach ($businessTypes as $businessType) {
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#service_<?php echo $service; ?>_collapse" aria-expanded="true" aria-controls="service_<?php echo $service; ?>_collapse">
                                            <?php echo $businessType; ?>
                                        </button>
                                    </h2>
                                    <div id="service_<?php echo $service; ?>_collapse" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="row g-2">
                                                <?php foreach ($industryType as $industryValue) { ?>
                                                    <?php
                                                    if ($industryValue->business_type_name == $businessType) {
                                                        $select = false;
                                                        if ($selectedCategories) {
                                                            foreach ($selectedCategories as $key => $selectedCategory) {
                                                                if ($industryValue->id == $selectedCategory->industry_type_id) {
                                                                    $select = true;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="categories[<?php echo $industryValue->id; ?>]" id="category_<?php echo $industryValue->id; ?>" value="<?php echo $industryValue->name; ?>" <?php if ($select) { ?> checked="checked" <?php } ?> <?= !$is_enabled ? 'disabled=""' : ''; ?>>
                                                                <label class="form-check-label" for="category_<?php echo $industryValue->id; ?>"><?php echo $industryValue->name; ?></label>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $service++;
                            }
                            ?>
                        </div>
                    </div>
                    <?php if( checkRoleCanAccessModule('company-my-services', 'write') ){ ?>
                    <div class="col-12 text-end">
                        <button class="nsm-button primary" type="submit">Save</button>
                    </div>
                    <?php } ?>
                </div>
                <?php if( checkRoleCanAccessModule('company-my-services', 'write') ){ ?>
                <?php echo form_close(); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if( checkRoleCanAccessModule('company-my-services', 'write') ){ ?>
            $(document).on("submit", "#form-business-details", function(e) {
                let _this = $(this);
                e.preventDefault();

                var url = "<?php echo base_url('users/saveservices'); ?>";
                _this.find("button[type=submit]").html("Saving");
                _this.find("button[type=submit]").prop("disabled", true);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: _this.serialize(),
                    dataType: 'json',
                    success: function(result) {
                        if( result.is_success == 1 ){
                            Swal.fire({
                                title: 'My Business Services',
                                text: "Data was successfully updated.",
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

                        _this.find("button[type=submit]").html("Save");
                        _this.find("button[type=submit]").prop("disabled", false);
                    },
                });
            });
        <?php } ?>
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
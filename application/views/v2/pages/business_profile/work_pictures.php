<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Add photos to spotlight features of your business or past projects pictures.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('users/add_work_pictures') ?>'">
                                <i class='bx bx-fw bx-image-add'></i> Upload Image
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <?php
                    $images = array();
                    if ($profiledata->work_images != '') {
                        $images = unserialize($profiledata->work_images);
                    }
                    ?>
                    <?php if ($images) { ?>
                        <?php foreach ($images as $key => $i) { ?>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-0 workspace-item" role="button">
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12 thumbnail-header">
                                                <div class="nsm-card-thumbnail" style="background-image: url('<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>')"></div>
                                            </div>
                                            <div class="col-12 text-center p-3">
                                                <div class="nsm-card-title mb-2">
                                                    <span><?= $i['caption']; ?></span>
                                                </div>
                                                <button class="nsm-button btn-sm"><i class='bx bx-edit'></i> Edit</button>
                                                <button class="nsm-button btn-sm"><i class='bx bx-zoom-in'></i> Zoom</button>
                                                <button class="nsm-button btn-sm"><i class='bx bx-trash'></i> Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {});
</script>
<?php include viewPath('v2/includes/footer'); ?>
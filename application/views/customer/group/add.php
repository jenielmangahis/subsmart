<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <div>A customer group is a way of aggregating customers that are similar in some way.  For example, you may
                                            use them to distinguish between retail and wholesale customers or between company employees and external customers etc. ...
                                            For example, a customer may have registered through the application as a wholesale customer.</div>
                        </div>
                    </div>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-card">
                                <div class="nsm-card-content">
                                    <div class="col-md-12">
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo (isset($custom_errors['title']) && $custom_errors['title']!='' )?'has-feedback':''; ?>">
                                                <label for="title">Name *</label>
                                                <input style="width:50%;" type="text" class="form-control col-sm-6" name="title" id="title" value="<?php echo (isset($old_data['title']))?$old_data['title']:''  ?>" placeholder="Group Name" autofocus/>
                                                <?php if(isset($custom_errors['title']) && $custom_errors['title']!='' ) { ?>
                                                    <label id="title-error" class="error" for="title"><?php echo $custom_errors['title']; ?></label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 form-group <?php echo (isset($custom_errors['description']) && $custom_errors['description']!='' )?'has-feedback':''; ?>">
                                            <label for="notes">Description <small>(some description for internal use)</small></label>
                                            <textarea name="description" cols="40" rows="3" class="form-control" autocomplete="off"><?php echo (isset($old_data['description']))?$old_data['description']:''  ?></textarea>
                                            <?php if(isset($custom_errors['description']) && $custom_errors['description']!='' ) { ?>
                                                <label id="title-error" class="error" for="description"><?php echo $custom_errors['description']; ?></label>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12 mt-3 text-end">
                                            <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('customer/group') ?>'">Go Back to Customer Group List</button>
                                            <button type="submit" class="nsm-button primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();
    })
</script>
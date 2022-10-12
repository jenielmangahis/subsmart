<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Here is where you will create how you want to name the events or jobs on the calendar. This priority list is where you assigned the most important thing you have to do or deal with, or must be done or dealt with before everything else you have to do. It can be based on the most important to least important base on funding or state of need.</div>
                    </div>
                </div>
                <?php echo form_open('workorder/priority/save', ['class' => 'form-validate', 'method' => 'post']); ?>
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>New Priority</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="content-subtitle fw-bold d-block mb-2">Name</label>                                            
                                            <input type="text" class="form-control" name="title" id="title" required
                                                   placeholder="Enter Name" autofocus/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('workorder/priority') ?>'">Go Back to Priority List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();
    })
</script>
<?php include viewPath('v2/includes/footer'); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Create New Email Templates</h4>

                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="card">
                            <form method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" />
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="title">Email Subject </label>
                                                    <input type="text" class="form-control" name="subject" id="subject" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="notes">Email Body</label>
                                                <textarea id="summernote" name="email_body" ></textarea>
                                            </div>
                                            <div class=" col-md-12 form-group">
                                                <label class="" for="email-1">Template Type</label>
                                                <select class="form-control" data-style="btn-white" name="type_id" required>
                                                    <option  value="1">Invoice</option>
                                                    <option  value="2">Estimate</option>
                                                    <option  value="3">Schedule</option>
                                                    <option  value="4">Review</option>
                                                    <option  value="5">Notes</option>
                                                </select>
                                            </div>
                                            <div class=" col-md-12 form-group">
                                                <label class="" for="email-1">Details</label>
                                                <select class="form-control" data-style="btn-white" name="details" required>
                                                    <option  value="1">Default Template</option>
                                                    <option  value="2">Custom Template</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send-o"></span> Save</button>
                                                <a href="<?= base_url('settings/email_templates') ?>" type="button" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function() {
        $('#summernote').summernote('code', '');
        //$('#summernote').summernote({height: 300,focus: false});
    });
</script>
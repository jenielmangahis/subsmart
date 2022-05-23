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
                            <h4>Email Templates</h4>

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
                                                        <input type="text" class="form-control" name="title" id="title" value="<?= isset($template) ? $template->title : ""?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="title">Subject *</label>
                                                        <input type="text" class="form-control" name="subject" id="subject" value="<?= isset($template) ? $template->subject : ""?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="notes">Email Body</label>
                                                    <textarea id="summernote" name="email_body"></textarea>
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
        $('#summernote').summernote('code', '<?= isset($template) ? $template->email_body : ""?>');
    });
</script>

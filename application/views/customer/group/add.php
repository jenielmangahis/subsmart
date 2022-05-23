<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <section class="content">
                <!-- Default box -->
                <div class="box">

                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h1 class="page-title">Add Group</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Enter the name for the new group.</li>
                                </ol>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="<?php echo url('customer/group/') ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Groups
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post">
                        <div class="row custom__border">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group <?php echo (isset($custom_errors['title']) && $custom_errors['title']!='' )?'has-feedback':''; ?>">
                                                    <label for="title">Name *</label>
                                                    <input type="text" class="form-control col-sm-6" name="title" id="title" value="<?php echo (isset($old_data['title']))?$old_data['title']:''  ?>" placeholder="Enter title" autofocus/>
                                                    <?php if(isset($custom_errors['title']) && $custom_errors['title']!='' ) { ?>
                                                        <label id="title-error" class="error" for="title"><?php echo $custom_errors['title']; ?></label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group <?php echo (isset($custom_errors['description']) && $custom_errors['description']!='' )?'has-feedback':''; ?>">
                                                <label for="notes">Description <small>(some description for internal use)</small></label>
                                                <textarea name="description" cols="40" rows="3" class="form-control" autocomplete="off"><?php echo (isset($old_data['description']))?$old_data['description']:''  ?></textarea>
                                                <?php if(isset($custom_errors['description']) && $custom_errors['description']!='' ) { ?>
                                                    <label id="title-error" class="error" for="description"><?php echo $custom_errors['description']; ?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </section>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();
    })
</script>
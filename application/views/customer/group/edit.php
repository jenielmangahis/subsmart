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
                                <h1 class="page-title">Manage Group</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Update group details.</li>
                                </ol>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="<?php echo url('customer/group') ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Groups
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_open('customer/group/save', ['class' => 'form-validate', 'method' => 'post']); ?>
                    <div class="row custom__border">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Title *</label>
                                                <input type="text" class="form-control"
                                                       name="title"
                                                       id="title"
                                                       value="<?php echo (isset($old_data['title']))?$old_data['title']:(!empty($customerGroup)) ? $customerGroup->title : '' ?>"
                                                       required
                                                       placeholder="Enter title" autofocus/>
                                                <?php if(isset($custom_errors['title']) && $custom_errors['title']!='' ) { ?>
                                                    <label id="title-error" class="error" for="title"><?php echo $custom_errors['title']; ?></label>
                                                <?php } ?>
                                                <?php if (!empty($customerGroup)) { ?>
                                                    <input type="hidden" name="id"
                                                           value="<?php echo $customerGroup->id ?>">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="notes">Description <small>(some description for internal use)</small></label>
                                            <textarea name="description" rows="3" class="form-control" style="height:150px !important;resize: none;" autocomplete="off"><?php echo (!empty($customerGroup) && isset($customerGroup->description) && $customerGroup->description != '') ? $customerGroup->description : '' ?><?php echo (isset($old_data['description']))?$old_data['description']:(!empty($customerGroup)) ? $customerGroup->description : ''  ?></textarea>
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

                    <?php echo form_close(); ?>
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
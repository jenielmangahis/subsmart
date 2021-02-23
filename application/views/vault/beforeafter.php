<style>
button#dropdown-edit {
    width: 100px;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
    padding-left: 25px !important;
    padding-top: 55px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 25px !important;
}
.col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
    position: relative;
    left: 13px;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/filevault'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <!-- <div class="page-title-box">
            </div> -->
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12 p-0">
                    <div class="card" style="padding: 5px 20px !important;">
                      <div class="row margin-bottom-ter mb-2 align-items-center">
                          <div class="col-auto vault__header">
                              <h3 class="page-title mb-0 vault__title">Before and After Photos</h3>
                          </div>
                          <div class="col text-right-sm d-flex justify-content-end align-items-center">
                              <div class="float-right d-md-block">
                                  <div class="dropdown">
                                      <a class="btn btn-primary btn-md" id="newJobBtn" href="<?php echo url('before-after/add_photo') ?>">
                                      <span class="fa fa-plus"></span> Add Photos</a>
                                  </div>
                              </div>
                              <div class="float-right d-md-block">
                              </div>
                          </div>
                      </div>
                      <div class="pl-3 pr-3 mt-0 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                One of the best way for prospect to process information is with visual data.  Before and after photos serve as proof that the product (or service) works.  Start sharing your success photos to others to grow your business. 
                            </span>
                        </div>
                      </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php if (!empty($photos)) { ?>
                                <table class="table table-hover table-bordered table-striped" style="width:100%;" id="beforeAfterListTable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong>Pic</strong></th>
                                            <th scope="col"><strong>Date Added</strong></th>
                                            <th scope="col"><strong>Customer</strong></th>
                                            <th scope="col"><strong></strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $group=array();?>
                                     <?php foreach($photos as $photo) : ?>
                                        <?php //if(!in_array($photo->group_number, $group)) : ?>
                                        <?php array_push($group, $photo->group_number);?>
                                        <tr>
                                            <td class="pl-3">
                                                <div class="row">
                                                    <img src="<?php echo base_url() . "uploads/" . $photo->before_image;  ?>" width="200px" height="150px;">&nbsp;&nbsp;
                                                    <img src="<?php echo base_url() . "uploads/" . $photo->after_image;  ?>" width="200px" height="150px;">
                                                </div>
                                                <div class="row">
                                                    <span><strong style="margin-left:70px; margin-right:165px;">Before</strong></span>
                                                    <span><strong>After</strong></span>
                                                </div>
                                            </td>
                                            <td class="pl-3"><?php echo date_format(date_create($photo->created_at),"d-M-Y H:m"); ?></td>
                                            <td class="pl-3"><?php echo $photo->first_name . ' ' . $photo->last_name; ?></td>
                                            <td class="pl-3">
                                                <div class="dropdown dropdown-btn text-center">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('before-after/edit/'. $photo->id); ?>" class="editDeleteBeforeAfterBtn"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                        <li role="separator" class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('before-after/delete/'. $photo->group_number); ?>" class="editDeleteBeforeAfterBtn"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php //endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't uploaded any photos.</h5>
                                        <p class="text-ter margin-bottom">Upload and manage Before and After photos and send them to your customers.</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

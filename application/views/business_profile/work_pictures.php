<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.option-container {
    position: relative;
    top: 30px;
    float: right;
        background-color: #000000;
    width: 16%;
    padding: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
img.event-marker {
    display: block;
    margin: 0 auto;
}
tr.odd {
    background: #f1f1f1 !important;
}
table.table tbody tr td {
    width: 15%;
    text-align: right;
}
table.table tbody tr td:first-child {
    width: 85%;
    text-align: left;
}
table.dataTable {
    border-collapse: collapse;
    margin-top: 5px;
}
table.dataTable thead tr th {
    border: 1px solid black !important;
}
table.dataTable tbody tr td {
    border: 1px solid black !important;
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
.event-marker{
  height: 50px;
  width: 50px;
  border: 1px solid #dee2e6;
}
.gallery li{
  width: 30%;
  display: inline-block;
  margin: 10px;
  height: 286px;
  float: left;
}
div.picture-container div.img img {
    object-fit: cover;
    height: 286px;
    width: 100% !important;
}
.img-delete{
    color: #ffffff;
    font-size: 18px;
}
.img-caption{
    float: left;
    margin-right: 7px;
    color: #ffffff !important;
    font-size: 18px;
}
.img-zoom{
  margin-right: 7px;
  color: #ffffff !important;
  font-size: 18px;
}
.image-caption{
  position: relative;
    top: -25px;
    left: 16px;
    color: #ffffff;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/business'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Work Pictures</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('users/add_work_pictures') ?>" class="btn btn-primary btn-md"><i class="fa fa-camera"></i> Upload Image</a><br />
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                              Add photos to spotlight features of your business or past projects pictures.  You can upload up to <b>25 images.</b>
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                           <?php
                            $images = array();
                            if( $profiledata->work_images != '' ){
                              $images = unserialize($profiledata->work_images);
                            }
                           ?>
                           <?php if($images){ ?>
                           <ul class="gallery ui-sortable" id="gallery">
                              <?php foreach($images as $key => $i){ ?>
                                <li class="col-image-<?= $key ?>">
                                  <div class="picture-container ui-sortable-handle">
                                    <div class="img">
                                        <div class="option-container" style="background-color: #000000;">
                                          <a class="img-zoom" href="<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>" data-fancybox="gallery" data-caption="<?= $i['caption']; ?>"><i class="fa fa-search-plus"></i></a>
                                          <a class="img-caption" data-caption="<?= $i['caption']; ?>" data-id="<?= $key; ?>" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                                          <a class="img-delete" data-name="<?= $i['file']; ?>" data-id="<?= $key; ?>" href="javascript:void(0);"><i class="fa fa-trash-o icon"></i></a>
                                        </div>
                                        <img src="<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>">
                                        <div class="image-caption image-caption-container-<?= $key; ?>">
                                          <?= $i['caption']; ?>
                                        </div>
                                    </div>
                                  </div>
                                </li>
                              <?php } ?>
                            </ul>
                          <?php } ?>
                        </section>
                        <!-- /.content -->
                    </div>

                    <!-- Modal Delete Work Picture  -->
                    <div class="modal fade bd-example-modal-sm" id="modalDeleteImage" tabindex="-1" role="dialog" aria-labelledby="modalDeleteImageTitle" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-delete-image', 'autocomplete' => 'off' ]); ?>
                          <?php echo form_input(array('name' => 'image_name', 'type' => 'hidden', 'value' => '', 'id' => 'image_name'));?>
                          <?php echo form_input(array('name' => 'image_key', 'type' => 'hidden', 'value' => '', 'id' => 'image_key'));?>
                          <div class="modal-body">
                              <p>Are you sure you want delete the selected image?</p>
                          </div>
                          <div class="modal-footer close-modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger btn-delete-image">Yes</button>
                          </div>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Updated Work Picture Caption  -->
                    <div class="modal fade bd-example-modal-sm" id="modalAddCaptionImage" tabindex="-1" role="dialog" aria-labelledby="modalAddCaptionImageTitle" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-pencil"></i> Edit Caption</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-edit-image-caption', 'autocomplete' => 'off' ]); ?>
                          <?php echo form_input(array('name' => 'image_key', 'type' => 'hidden', 'value' => '', 'id' => 'caption_image_key'));?>
                          <div class="modal-body">
                              <div class="col-md-12 form-group">
                                  <label for="image_caption">Caption</label>
                                  <input type="text" class="form-control" name="image_caption" id="image_caption" required placeholder="" autofocus/>
                              </div>
                          </div>
                          <div class="modal-footer close-modal-footer">
                            <button type="submit" class="btn btn-primary btn-update-caption">Update</button>
                          </div>
                          <?php echo form_close(); ?>
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
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".img-caption").click(function(){
      var image_caption = $(this).attr("data-caption");
      var image_key  = $(this).attr("data-id");

      $("#image_caption").val(image_caption);
      $("#caption_image_key").val(image_key);
      $(".btn-update-caption").html('Update');
      $("#modalAddCaptionImage").modal('show');
    });

    $(".img-delete").click(function(){
      var image_name = $(this).attr("data-name");
      var image_key  = $(this).attr("data-id");

      $("#image_name").val(image_name);
      $("#image_key").val(image_key);
      $(".btn-delete-image").html('Yes');
      $("#modalDeleteImage").modal('show');
    });

    $("#form-edit-image-caption").submit(function(e){
      e.preventDefault();
      var url = base_url + 'users/_update_work_image_caption';
      $(".btn-update-caption").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-edit-image-caption").serialize(),
           dataType:"json",
           success: function(o)
           {
             $("#modalAddCaptionImage").modal('hide');
             var image_key = $("#caption_image_key").val();
             var image_caption = $("#image_caption").val();
             $(".image-caption-container-" + image_key).html(image_caption);

             Swal.fire({
              icon: 'success',
              title: 'Image caption was successfully updated',
              showConfirmButton: false,
              timer: 1500
             });

           }
        });
      }, 800);
    });

    $("#form-delete-image").submit(function(e){
      e.preventDefault();
      var url = base_url + 'users/_delete_work_picture';
      $(".btn-delete-image").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-delete-image").serialize(),
           dataType:"json",
           success: function(o)
           {
             $("#modalDeleteImage").modal('hide');
             var image_key = $("#image_key").val();
             var li_image  = $(".col-image-" + image_key);
             Swal.fire({
              icon: 'success',
              title: 'Image was successfully deleted',
              showConfirmButton: false,
              timer: 1500
             });
             li_image.fadeOut(300, function(){
               li_image.remove();
            });

           }
        });
      }, 800);
    });
});

</script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card p-20 mt-5">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">Add New Item Category</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      Create new item category.
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="item_category_form">
                            <div class="form-group">
                              <label>Category Name</label> <span class="form-required">*</span>
                              <input type="text" class="form-control" name="category_name" id="category_name" required/>
                            </div>
                            <div class="form-group">
                              <label>Description</label> <span class="form-required">*</span>
                              <textarea class="form-control" name="category_description" id="category_description"></textarea>
                            </div>
                            <div class="col-md-">
                                <button type="submit" class="btn btn-primary btn-save-category">Save</button>
                                <a class="btn btn-primary" href="<?php echo base_url('inventory/item_groups'); ?>">Cancel</a>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end container-fluid -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        $("#item_category_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $(".btn-save-category").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            var form = $(this);
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/inventory/_create_item_category",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        $(".btn-save-category").html('Save');
                        Swal.fire({
                          title: 'Great!',
                          text: 'Item category was successfully created.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                        }).then((result) => {
                          location.href = base_url + "/inventory/item_groups";
                        });
                    }, beforeSend: function() {
                        //document.getElementById('overlay').style.display = "flex";
                    }
                });
            }, 1000);
        });
    });
</script>

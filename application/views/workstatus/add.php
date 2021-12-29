<?php include viewPath('includes/header'); ?>
<style>
.checklist-items{
    margin-top: 15px;
    margin-bottom: 51px;
}
.checklist-form .form-control{
    width: 50%;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
.checklist-container{
    padding: 0px;
    margin: 0px;
}
.checklist-container li{
    width: 50%;
    padding: 10px;
    font-size: 17px;
    background-color: #32243d;
    color: #ffff;
    margin: 10px 0px;
}
.checklist-container li a{
    float: right;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="card p-40">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 class="m-0">Add New Workorder Type</h3>
                </div>
                <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;">
                    Create your own workorder type.    
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('workstatus/save', [ 'class' => 'form-validate checklist-form', 'id' => 'frm-create-workorder-type', 'autocomplete' => 'off' ]); ?>
                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" class="form-control" name="title" id="title" required placeholder="Enter title" autofocus />
                          </div>
                          <div class="form-group">
                              <label>Color</label> <span class="form-required">*</span>
                              <input type="text" class="form-control colorpicker" name="color" id="colorpicker" required placeholder="Select Color"/>
                          </div>        
                          <div class="col-md-5" style="padding: 0px;margin-top: 110px;">                            
                            <button type="submit" class="btn btn-primary btn-save-workorder-type">Save</button>
                            <a class="btn btn-default" href="<?php echo base_url('workstatus'); ?>">Cancel</a>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
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
    $('.colorpicker').colorpicker();
    $("#frm-create-workorder-type").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workstatus/_create_workorder_type';
        $(".btn-save-workorder-type").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#frm-create-workorder-type").serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Success',
                            text: 'Workorder type was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "/workstatus"; 
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot save data.',
                          text: o.msg
                        });
                    }

                    $(".btn-save-workorder-type").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>
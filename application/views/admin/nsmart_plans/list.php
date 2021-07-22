<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
.cell-active{
    background-color: #53b94a;
    color: white;
    padding: 4px 0px;
    width: 75px;
    display: block;
    text-align: center;
    border-radius: 20px;
}
.cell-inactive{
    background-color: #585858;
    color: white;
    padding: 4px 0px;
    width: 75px;
    display: block;
    text-align: center;
    border-radius: 20px;
}
a.btn-add {
    background: #38a4f8;
    color: white;
    padding: 10px 30px;
    border-radius: 25px;
    font-size: 15px;
    box-shadow: rgb(0 0 0 / 32%) 0 1px 4px 0px;
    margin-right: 60px;
}
@media only screen and (max-width: 1024px) {
  h1.page-title {
      margin-bottom: 11px !important;
  }
  .col-xl-12 div.card {
      padding-top: 20px !important;
      width: 1000px;
  }
  a.btn-add {
    margin-right: 0px;
  }
}
.btn{
    border-radius: 0px !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Plans</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage nSmarTrac Plans.</span>
                            </div>
                        </div>

                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('admin/add_new_nsmart_plan'); ?>"><i class="fa fa-plus"></i> New Plan</a>
                            </div>
                        </div>
                        <br class="clear"/>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Plan</th>
                                    <th style="width: 30%;">Description</th>
                                    <th style="width: 8%;">Price</th>
                                    <th style="width: 15%;">Discount Price</th>
                                    <th style="width: 5%;">Is Active</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $nSmartPlans as $p ){ ?>
                                    <?php
                                        if( $p->status == 1 ){
                                            $cell = 'cell-active';
                                        }else{
                                            $cell = 'cell-inactive';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $p->plan_name; ?></td>
                                        <td><?= $p->plan_description; ?></td>
                                        <td><?= $p->price; ?></td>
                                        <td><?= $p->discount . " / " . $option_discount_types[$p->discount_type]; ?></td>
                                        <td><span class="<?= $cell; ?>"><?= $option_status[$p->status]; ?><span></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/edit_nsmart_plan/'.$p->nsmart_plans_id); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-sm btn-primary btn-delete-plan" data-name="<?= $p->plan_name; ?>" href="javascript:void(0);" data-id="<?= $p->nsmart_plans_id; ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

    <div class="modal fade bd-example-modal-sm" id="modalDeletePlan" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('admin/delete_nsmart_plan', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
          <div class="modal-body">        
              <p>Are you sure you want to delete plan name <span class="delete-plan-name"></span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

</div>
<?php include viewPath('includes/admin_footer'); ?>

<script>    
$(document).on('click', '.btn-delete-plan', function(){
    var plan_id   = $(this).attr("data-id");
    var plan_name = $(this).attr("data-name");

    $("#pid").val(plan_id);
    $(".delete-plan-name").html("<b>" + plan_name + "</b>");
    $("#modalDeletePlan").modal('show');
});
</script>

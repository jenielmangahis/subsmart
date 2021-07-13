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
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Offer Codes</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Offer Codes list.</span>
                            </div>
                        </div>
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('admin/add_new_offer'); ?>"><i class="fa fa-file"></i> New Offer Code</a>
                            </div>
                        </div> 
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">Offer Code</th>
                                    <th style="width: 10%;">Trial days</th>
                                    <th style="width: 10%;">Status</th>
                 
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $offerCodes as $offerCode){ ?>
                                    <?php 
                                        if( $offerCode->status == 1 ){
                                            $cell = 'cell-active';
                                            $status = "Active";
                                        }else{
                                            $cell = 'cell-inactive';
                                            $status = "Unused";
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $offerCode->offer_code; ?></td>
                                        <td><?= $offerCode->trial_days; ?></td>
                                        <td class="<?= $cell; ?>"><?= $status; ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/edit_offer_code/'.$offerCode->id); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-sm btn-primary btn-delete-offer-code" href="javascript:void(0);" data-name="<?= $offerCode->offer_code; ?>" data-id="<?= $offerCode->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade bd-example-modal-sm" id="modalDeleteOfferCode" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanTitle" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php echo form_open_multipart('admin/delete_offer_code', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <?php echo form_input(array('name' => 'offer_code_id', 'type' => 'hidden', 'value' => '', 'id' => 'offer_code_id'));?>
                          <div class="modal-body">        
                              <p>Are you sure you want to delete selected offer code <span class="delete-offer-code" style="font-weight: bold;"></span></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
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
<?php include viewPath('includes/admin_footer'); ?>

<script type="text/javascript">  
$(function(){
    $(".btn-delete-offer-code").click(function(){
        var offer_code_id = $(this).attr("data-id");
        var offer_code    = $(this).attr("data-name");
        $(".delete-offer-code").html(offer_code);
        $("#offer_code_id").val(offer_code_id);

        $("#modalDeleteOfferCode").modal("show");
    });
});
</script>

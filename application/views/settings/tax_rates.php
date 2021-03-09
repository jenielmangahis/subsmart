<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/invoice'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Tax Rates </h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Listing all your predefined tax rates.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <a href="#modalAddTaxRate" data-toggle="modal" data-target="#modalAddTaxRate" class="btn btn-default pull-right"><span class="fa fa-plus fa-margin-right"></span> New rate</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">  
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Rate</th>
                                    <th style="width:10%;">Is Default</th>
                                    <th style="width:10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $taxRates as $tx ){ ?>
                                    <?php 
                                        if( $tx->is_default == 1 ){
                                            $cell  = 'cell-active';
                                            $value = 'Yes'; 
                                        }else{
                                            $cell  = 'cell-inactive';
                                            $value = 'No'; 
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $tx->name; ?></td>
                                        <td><?= $tx->rate; ?></td>
                                        <td class="<?= $cell; ?>"><?= $value; ?></td>
                                        <td style="text-align: right;">
                                            <a class="btn btn-info btn-sm btn-edit-tax-rate" data-id="<?= $tx->id; ?>" href="javascript:void(0);"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-tax-rate" href="javascript:void(0);" data-id="<?= $tx->id; ?>"><i class="fa fa-trash"></i> Delete</a>
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
</div>
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".btn-edit-tax-rate").click(function(){
        var tid = $(this).attr("data-id");

        $("#tid").val(tid);
        $("#modalEditTaxRate").modal('show');
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Loading...</div>';
        var url = base_url + '/settings/ajax_edit_tax_rate';

        $(".body-edit-tax-rate").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o)
               {
                  $(".body-edit-tax-rate").html(o);
               }
            });
        }, 1000);
    });

    $(".btn-delete-tax-rate").click(function(){
        var tid = $(this).attr("data-id");
        
        $("#dtid").val(tid);
        $("#modalDeleteTaxRate").modal('show');
    });
});

</script>
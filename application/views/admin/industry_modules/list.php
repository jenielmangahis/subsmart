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
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
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
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Industry Modules</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Nsmart Industry Modules.</span>
                            </div>
                        </div>

                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('admin/add_new_industry_module'); ?>"><i class="fa fa-file"></i> New Module</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 2%;">ID</th>
                                    <th style="width: 20%;">Model Name</th>
                                    <th style="width: 30%;">Description</th>
                                    <th style="width: 8%;">Status</th>
                 
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $industryModules as $industryModule){ ?>
                                    <?php 
                                        if( $industryModule->status == 1 ){
                                            $cell = 'cell-active';
                                            $status = "Active";
                                        }else{
                                            $cell = 'cell-inactive';
                                            $status = "Inactive";
                                        }
                                    ?>
                                    <tr>
                                         <td><?= $industryModule->id; ?></td>
                                        <td><?= $industryModule->name; ?></td>
                                        <td><?= $industryModule->description; ?></td>
                                        <td>
                                            <span class="<?= $cell; ?>"><?= $status; ?></span>
                                                
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/edit_industry_module/'.$industryModule->id); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-sm btn-primary btn-delete-module" href="javascript:void(0);" data-id="<?= $industryModule->id; ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php include viewPath('includes/admin_footer'); ?>

<script type="text/javascript">  
$(function(){
    $(".btn-delete-module").click(function(){
        var module_id = $(this).attr("data-id");
        $("#mid").val(module_id);

        $("#modalDeleteIndustryModule").modal("show");
    });
});
</script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        flex-direction: column; /*added*/
        display: inline-block;
        grid-gap: 15px;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        float: left;
        overflow-y:auto;
        overflow-x: auto;
        white-space: nowrap;
        flex-flow: wrap;
        flex: 0 0 31.666667%;
        max-width: 28%;
        height: 100%;
    }
    .module_ac_full {
        background: #f2f2f2;
        border-radius: 1px;
        flex-direction: column; /*added*/
        display: inline-block;
        grid-gap: 15px;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        float: left;
        overflow-y:auto;
        overflow-x: auto;
        white-space: nowrap;
        flex-flow: wrap;
        flex: 0 0 97.33%;
        max-width: 100%;
        height: 100%;
    }
    .module_ac_{
        flex: 0 0 97.33%;
        max-width: 100%;
        height: 100%;
        flex-direction: column; /*added*/
        display: inline-block;
        grid-gap: 15px;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        float: left;
        overflow-y:auto;
        overflow-x: auto;
        white-space: nowrap;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */
        background-color: #32243d;
        color : #fff;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        max-height: 30px;
        max-width: 100%;
        margin-bottom: 10px;
    }
    .module_title{
        padding-top: 3px;
    }

    .required{
        color : red!important;
    }

    .form-control  {
        font-size: 11px !important;
        height: 24px !important;
        line-height: 10%;
    }
    .form-controls{
        font-size: 11px !important;
        line-height: 150%;
    }
    label{
        font-size: 10px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 0.5px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 2px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
    .form-line{
        padding-bottom: 1px;
    }
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
    .input_select{
        color: #363636;
        border: 2px solid #e0e0e0;
        box-shadow: none;
        display: inline-block !important;
        width: 100%;
        background-color: #fff;
        background-clip: padding-box;
        font-size: 11px !important;
    }
</style>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/customer'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6" style="padding-left: 45px;">
                            <h4>New Advance Customer</h4>
                            <ol class="breadcrumb">
                                <!--<li class="breadcrumb-item active">Add your new customer.</li>-->
                                <?php if (!isset($profile_info)){ ?>
                                    <li class="breadcrumb-item active">* Fill up Profile form in order to open up other modules *</li>
                                <?php }else{
                                    ?>
                                    <li class="breadcrumb-item active">* Update customer info per module. *</li>
                                    <?php
                                } ?>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block" >
                                <div class="dropdown">
                                    <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('customer') ?>" class="btn btn-primary" aria-expanded="false">
                                        <span class="fa fa-arrow-alt-circle-left"></span> Go Back to Customer
                                    </a>
                                    <?php //endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="cards">
                            <div class="card-body">

                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="cards">
                                            <div class="card-body">
                                <div class="module_ac_">
                                </div>
                                <div class="col-md-12">
                                    <form id="customer_form">
                                        <div class="row pull-right">
                                            <button type="button" class="btn btn-primary btn-md " name="" id="" ><span class="fa fa-remove"></span> Cancel </button> &nbsp;
                                            <a href="<?php echo base_url('customer') ?>"><button type="submit" class="btn btn-primary btn-md " name="" id="" ><span class="fa fa-paper-plane-o"></span> Save </button></a>
                                        </div>
                                        <div class="row">
                                            <?php
                                                include viewPath('customer/adv_module_sheets/module_profile');

                                                include viewPath('customer/adv_module_sheets/module_billing');
                                            include viewPath('customer/adv_module_sheets/module_office');
                                                //include viewPath('customer/adv_module_sheets/module_account');
                                                //include viewPath('customer/adv_module_sheets/module_address');
                                                include viewPath('customer/adv_module_sheets/module_access');
                                                include viewPath('customer/adv_module_sheets/module_alarm');

                                                //include viewPath('customer/adv_module_sheets/module_admin');
                                                // include viewPath('customer/adv_module_sheets/module_tech');

                                                //include viewPath('customer/adv_module_sheets/module_custom');
                                                //include viewPath('customer/adv_module_sheets/module_payment');
                                                //include viewPath('customer/adv_module_sheets/module_owner');
                                            ?>
                                        </div>
                                        <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />

                                    </form>
                                </div>
                        </div>
                    </div>
                </div> <!-- end card -->
                <br><br><br>
            </div>
        </div>
    </div>
        <!-- end container-fluid -->

                        <!-- Lead Type Modal -->
                        <div class="modal fade" id="modal_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Assign</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="modal_form_assign">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Assign Name</label><br/>
                                                    <select id="fk_user_id" name="fk_user_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                        <option value="">Select</option>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <option value="<?= $employee->id; ?>"><?= $employee->FName.' '.$employee->LName; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $("#date_of_birth").datetimepicker({
            format: "L",
            //minDate: new Date(),
        });
        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

        //$('.time_picker').val(new Date().toLocaleTimeString());

        // $(".time_picker").datetimepicker({
        //     format: "LT",
        // });

        $('.timepicker').timepicker('setTime', new Date().toLocaleTimeString());

        var table_assign_module = $('#assign_module_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var note = $('#notes_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var devices_table= $('#devices_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#customer_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_data_sheet",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Added"){
                        sucess("New Customer has been Added Successfully!");
                    }else if(data === "Updated"){
                        sucess("Customer Info has been Updated Successfully!");
                    }else{
                        console.log(data);
                    }

                }
            });
        });
        function save_sucess(information){
            Swal.fire(
                'Good job!',
                information,
                'success'
            );
        }
        function sucess(information){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/customer";
                }
            });
        }
    });
</script>
<style>
    .select2-container--open{       z-index: 0;}
    span.select2-selection.select2-selection--single {
        font-size: 16px;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Users</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage users</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): ?>
                                    <a href="<?php echo url('users') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to User
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('timesheet/manual_clock_in', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">New Timesheet Entry</h4>
                            <input type="hidden" name="clockin_user_id" value="<?php echo logged('id');?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Details</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Role">Entry Type</label>
                                    <select name="entry_type" id="formClient-Role" class="form-control select2" required>
                                        <option value="">Select Entry Type</option>
                                        <option value="workhours">Work Hours</option>
                                        <option value="pto">PTO</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Contact">Date</label>
                                    <input type="text" class="form-control entry_date" name="entry_date"
                                           placeholder="Select Date"/>
                                </div>

                                <div class="col-md-12">
                                    <h3>Clock In/Out</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Contact">From</label>
                                    <input type="text" class="form-control" name="clock_in_from"
                                           placeholder="hh:mm" onchange="validateHhMm(this);"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Contact">To</label>
                                    <input type="text" class="form-control" name="clock_in_to"
                                           placeholder="hh:mm" onchange="validateHhMm(this);"/>
                                </div>

                                <?php /*<div class="col-md-12">
                                    <h3>Breaks</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Contact">From</label>
                                    <input type="text" class="form-control" name="break_from"
                                           placeholder="hh:mm"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Contact">To</label>
                                    <input type="text" class="form-control" name="break_to"
                                           placeholder="hh:mm"/>
                                </div>*/?>


                                <!-- Job code hidden for now -->
                                <input type="hidden" name="job_code" value="workhours" /> 
                                <?php /*<div class="col-md-12">
                                <div class="col-md-12">
                                    <h3>Job Code</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Role">Job Code Type</label>
                                    <select name="job_code" id="formClient-Role" class="form-control select2" required>
                                        <option value="">Select Entry Type</option>
                                        <option value="workhours">Work Hours</option>
                                        <option value="pto">PTO</option>
                                    </select>
                                </div>*/ ?>

                                <div class="col-md-12">
                                    <h3>Notes</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Role">*optional</label>
                                    <textarea name="notes" class="form-control"></textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {

        $('.form-validate').validate();

        //Initialize Select2 Elements

        $('.select2').select2()


        $(".entry_date").datepicker();

        /*$("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();*/


    })


    function previewImage(input, previewDom) {


        if (input.files && input.files[0]) {


            $(previewDom).show();


            var reader = new FileReader();


            reader.onload = function (e) {

                $(previewDom).find('img').attr('src', e.target.result);

            }


            reader.readAsDataURL(input.files[0]);

        } else {

            $(previewDom).hide();

        }


    }

    function createUsername(name) {

        return name.toLowerCase()

            .replace(/ /g, '_')

            .replace(/[^\w-]+/g, '')

            ;
        ;

    }

    // for validating hours inputs
    function validateHhMm(inputField) {
        var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

        if (isValid) {
            inputField.style.backgroundColor = '#bfa';
        } else {
            inputField.style.backgroundColor = '#fba';
            alert('Invalid Input. Must be 00:00 format.');
        }

        return isValid;
    }

</script>
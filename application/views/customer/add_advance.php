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
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 30%;
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
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */

        background-color: #32243d;
        color : #fff;
        text-align: center;
        max-height: 40px;
        max-width: 100%;
        margin-bottom: 10px;
    }
    .module_ac2 {
        background: #f2f2f2;
        border-radius: 1px;
        display: flex;
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 100%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
    }
    .module_ac3 {
        background: #f2f2f2;
        border-radius: 1px;
        border-left : #0b2e13 20px;
        height : 130px;
    }

    .module_ac_long {
        background: #f2f2f2;
        border-radius: 1px;
        display: inline-block;
        flex-direction: column; /*added*/
        grid-gap: 15px;
        flex-flow: wrap;
        flex: 0 0 91%;
        max-width: 100%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        float: left;
        overflow-y: auto;
        overflow-x: auto;
        white-space: nowrap;
        height:auto;
        min-height: 100px;
    }

    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 0.5px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
</style>

    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/customer'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
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
                        <div class="col-sm-12">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                    </a>
                                    <?php //endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <?php //echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="banking-tab-container">
                                            <div class="rb-01">
                                                <ul class="nav nav-tabs border-0">
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#profile">Profile</a>
                                                    </li>
                                                    <!--<li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#other">Other Info</a>
                                                    </li>-->
                                                    <?php //if (isset($profile_info)) :  ?>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#account">Account</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#address">Address</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#billing">Billing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#alarm">Alarm</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#office">Office Use</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#admin">Admin</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#tech">Tech</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#access">Access</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#customizable">Customizable</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#payment">Payment</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#owner">Owner</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#assign">Assigned</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#notes">Notes</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#devices">Devices</a>
                                                    </li>
                                                    <?php //endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content mt-4" >
                                            <?php
                                                include viewPath('customer/adv_module_sheets/sheet_profile');
                                                include viewPath('customer/adv_module_sheets/sheet_account');
                                                include viewPath('customer/adv_module_sheets/sheet_address');
                                                include viewPath('customer/adv_module_sheets/sheet_billing');
                                                include viewPath('customer/adv_module_sheets/sheet_alarm');
                                                include viewPath('customer/adv_module_sheets/sheet_office');
                                                include viewPath('customer/adv_module_sheets/sheet_admin');
                                                include viewPath('customer/adv_module_sheets/sheet_tech');
                                                include viewPath('customer/adv_module_sheets/sheet_access');
//                                                include viewPath('customer/adv_module_sheets/sheet_cust');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
        <!-- end container-fluid -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
    });
</script>
<script>

    // document.getElementById('contact_mobile').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });
    // document.getElementById('contact_phone').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });

    // function validatecard() {
    //     var inputtxt = $('.card-number').val();
    //
    //     if (inputtxt == 4242424242424242) {
    //         $('.require-validation').submit();
    //     } else {
    //         alert("Not a valid card number!");
    //         return false;
    //     }
    // }
    $(document).ready(function() {
        $("#profile_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_data_sheet",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Profile Info successfully saved!");
                        window.location.href="/customer";
                    }
                    console.log(data);
                }
            });
        });

        $("#account_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_account_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Account Information successfully saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#address_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_address_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Address Information successfully saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#billing_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_billing_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Billing Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#alarm_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_alarm_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Alarm Industry Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#office_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_office_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Office Use Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#admin_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_admin_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Admin Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#tech_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_tech_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Tech Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#access_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_access_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Acount Access Information Successfully Saved!");
                    }
                    console.log(data);
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

        function sucess(){
            Swal.fire({
                title: 'Good job!',
                text: "Profile Info successfully saved!",
                icon: 'sucess',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
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
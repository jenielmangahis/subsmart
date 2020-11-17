<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
<style>
.view-password{
    position: absolute;
    bottom:2px;
    right:15px;
    width:24px;
    height:24px;
    cursor: pointer;
}
.input-switch{
    display: inline-block;
    margin-right: 20px;
}

.check-if-exist,#employeeEmail,#employeeUsername{
    display: inline;
}
.check-if-exist{
    margin-left: 10px;
}
.check-if-exist:hover{
    color: #0b62a4;
}
.email-error ,.username-error{
    visibility: hidden;
    display: block;
    font-style: italic;
    color: red;
}
.password-error{
    visibility: hidden;
    position: absolute;
    font-style: italic;
    color: red;
}
.profile-container{
    width: 150px;
    height: 150px;
    position: absolute;
    bottom: 0;
    display: none;
}
.profile-container img{
    width: 100%;
    height: 100%;
    border-radius: 3%;
    border: 1px solid grey;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}
.new-password-container ,.change-password{
    display: none;
}
.section-title{
    text-align: left;
    font-weight: bold;
    padding: 10px;
    background-color: #34134D;
    width: 100%;
    color: #ffffff;
    margin-bottom: 30px;
    margin-top: 30px;
}
</style>
<section class="contact-spacing" style="padding-top: 30px;">
    <div class="container spacing-ft">
        <div class="row container-contact">
            <div class="col-sm-12 pt-1 mt-3 mobile-width-100">
              <div class="contact_container" id="form-container">
                <h2 class="uppercase cn-tn">Company : <?= $client->business_name; ?></h2>
                <br/>
                <h4 class="cn-address" style="font-size: 30px;">Add Employee</h4>
                <form action="" id="addEmployeeForm">
                <input type="hidden" name="eid" value="<?= $eid; ?>">
                <div class="msg-container"></div>
                <div class="section-title">Basic Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" class="form-control" required="" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control" required="" placeholder="Enter Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Login Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" style="display: block">Email</label>
                                <input type="email" name="email" class="form-control" required="" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
                                <span class="email-error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" style="display: block">Username</label>
                                <input type="text" name="username" class="form-control" required="" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Username already exist" data-toggle="tooltip"></i>
                                <span class="username-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="password-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="password" name="password" required="" id="employeePass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                    <span class="password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" required="" id="employeeConfirmPass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showConfirmPass" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 42px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-switch">
                                    <label for="">App Access</label><br>
                                    <input type="checkbox" name="app_access" class="js-switch" checked />
                                </div>
                                <div class="input-switch">
                                    <label for="">Web Access</label><br>
                                    <input type="checkbox" name="web_access" class="js-switch" checked />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div style="margin-top: 32px;"><button type="submit" class="btn btn-success" style="width: 12%">Save</button></div>
                </form>
              </div>
            </div>            
        </div>

        <div class="modal fade" id="modalNotification">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-globe"></i> Public URL</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>
<script>
var base_url = "<?= base_url(); ?>";
$(function(){
    // Switch button
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

    $('#showPass').click(function () {
        $(this).toggleClass('fa-eye-slash');
        if ($(this).prev('input[type="password"]').length == 1){
            $(this).prev('input[type="password"]').attr('type','text');
            $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
        }else{
            $(this).prev('input[type="text"]').attr('type','password');
            $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
        }
    });

    $('#showConfirmPass').click(function () {
        $(this).toggleClass('fa-eye-slash');
        if ($(this).prev('input[type="password"]').length == 1){
            $(this).prev('input[type="password"]').attr('type','text');
            $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
        }else{
            $(this).prev('input[type="text"]').attr('type','password');
            $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
        }
    });

    $("#addEmployeeForm").submit(function(e){
        e.preventDefault();

        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Saving...</div>';
        var url = base_url + '/save_company_employee';

        $("#modalNotification").modal("show");
        $("#modalNotification .modal-body").html(msg);

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#addEmployeeForm").serialize(),
               dataType:"json",
               success: function(o)
               {    
                    if( o.is_success ){
                        var msg = "<div class='alert alert-success fade show' style='margin-top:26px;margin-bottom:10px;'>" + o.msg + "</div>";
                        $(".msg-container").html(msg);
                        $("#modalNotification").modal("hide");

                        $("#addEmployeeForm")[0].reset();
                    }else{
                        var msg = "<div class='alert alert-danger fade show' style='margin-top:26px;margin-bottom:10px;'>" + o.msg + "</div>";
                        $(".msg-container").html(msg);
                        $("#modalNotification").modal("hide");
                    }

                    $('html, body').animate({
                        scrollTop: $("#form-container").offset().top
                        }, 1000
                    );
                  
               }
            });
        }, 1000);
    });
});
</script>
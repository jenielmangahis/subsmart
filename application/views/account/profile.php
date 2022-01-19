<style>
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 5px;
    }
    .pr-b10 {
      position: relative;
      bottom: 10px;
    }
    .left {
      float: left;
    }
    .p-40 {
      padding-left: 15px !important;
      padding-top: 10px !important;
    }
    .card.p-20 {
        padding-top: 18px !important;
    }
    .fr-right {
      float: right;
      justify-content: flex-end;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
    }
    .pd-17 {
      position: relative;
      left: 17px;
    }
    @media only screen and (max-width: 1300px) {
      .card-deck-upgrades div a {
          min-height: 440px;
      }
    }
    @media only screen and (max-width: 1250px) {
      .card-deck-upgrades div a {
          min-height: 480px;
      }
      .card-deck-upgrades div {
        padding: 10px !important;
      }
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
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 62px !important;
    }

    #modalEditEmployee .modal-body {
        padding: 20px !important;
        overflow-y: auto;
    }

    #modalEditEmployee .section-title {
        font-size: 20px;
        font-weight: bold;
        color: grey;
    }

    #modalEditEmployee label {
        font-weight: bold;
    }

    .section-title {
        background-color: #32243d;
        color: #ffffff !important;
        padding: 10px;
        margin-bottom: 27px;
    }
    .view-password {
        position: absolute;
        bottom: 2px;
        right: 15px;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }
</style>
<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" style="margin-top:60px;">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
     <!--
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-12">
               <h1 class="page-title">Profile Edit</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Edit Profile</li>
               </ol>
            </div>
           </div>
      </div>
    -->

      <section class="content">

<div class="row">

  <div class="col-md-3" style="margin-top: 34px;">



    <!-- Profile Image -->

    <div class="box box-primary">
      <div class="box-body box-profile text-center">
        <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo userProfile($user->id) ?>" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                  <h4><?= $user->FName . ' ' . $user->LName; ?></h4>
                  <p class="text-secondary mb-1"><?php echo getUserType($user->user_type); ?></p>
                  <br />
                  <a class="btn btn-outline-primary btn-primary" id="editProfile" data-id="<?= $user->id; ?>" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">Edit Profile</a>
                   <a class="btn btn-outline-primary btn-primary" id="createSignatureButton" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">Create Signature</a>
                  <a class="btn btn-outline-primary btn-primary" href="javascript:void(0)" data-name="<?php echo $user->FName . ' ' . $user->LName; ?>" data-id="<?php echo $user->id ?>" id="changePassword" style="width: 100%; margin-bottom: 10px;">Change Password</a>
                  <?php 
                      if( $user->profile_img != '' ){
                          $data_img = $user->profile_img;
                      }else{
                          $data_img = 'default.png';
                      }
                  ?>
                  <a class="btn btn-outline-primary btn-primary" id="changeProfilePhoto" data-id="<?= $user->id; ?>" data-img="<?= $data_img; ?>" href="javascript:void(0);" style="width: 100%;">Change Profile Picture</a>
                </div>
              </div>
            </div>
          </div>
      </div>

      <!-- /.box-body -->

    </div>

    <!-- /.box -->



  </div>

  <!-- /.col -->

  <div class="col-md-9">
    <div class="row">
      <div class="col-xl-12">
          <div class="card">
              <h1 class="page-title mb-0">Profile Edit</h1>
              <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
                <div class="col mb-0 left alert alert-warning mt-0">
                    <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Edit Profile</span>
                </div>
              </div>
              <div class="card-body hid-desk" style="padding-bottom:0px;">
                  <div class="row align-items-center pt-3 bg-white">
                      <div class="col-md-12 pl-0">
                          <!-- Nav tabs -->
                          <div class="tab-content mt-4" >
                              <div class="tab-pane active standard-accordion" id="profile">
                                  <div class="<?php echo $activeTab=='profile'?'active':'' ?> tab-pane" id="viewProfile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped">
                                              <tbody>
                                                <tr>
                                                  <td width="160"><strong>Name</strong>:</td>
                                                  <td><?php echo $user->FName ?> <?php echo $user->LName ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>username</strong>:</td>
                                                  <td><?php echo $user->username ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Email</strong>:</td>
                                                  <td><?php echo $user->email ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Role</strong>:</td>
                                                  <td><?php echo $user->role->title ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Phone Number</strong>:</td>
                                                  <td><?php echo $user->phone ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Mobile Number</strong>:</td>
                                                  <td><?php echo $user->mobile ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Address</strong>:</td>
                                                  <td><?php echo nl2br($user->address) ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Last Login</strong>:</td>
                                                  <td><?php echo ($user->last_login!='0000-00-00 00:00:00')?date( setting('datetime_format'), strtotime($user->last_login)):'No Record' ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Member Since</strong>:</td>
                                                  <td><?php echo ($user->created_at!='0000-00-00 00:00:00')?date( setting('datetime_format'), strtotime($user->created_at)):'No Record' ?></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="userSignatureContainer">
                                                <img src="<?php echo userSignature($user->id); ?>">
                                            </div>
                                            <br />
                                            <p>This is the electronic representation of your signature, update any time.</p>
                                        </div>
                                    </div>
                                  </div>
                              </div>

                              <div class="tab-pane standard-accordion" id="profImg">
                                  <div class="col-sm-6">
                                      <h3 class="page-title">Change Profile Image</h3>
                                  </div>
                                  <div class="<?php echo $activeTab=='change_profile_pic'?'active':'' ?> tab-pane" id="editUserProfilePic">
                                  <?php echo form_open('/profile/updateUserProfilePic', ['method' => 'POST', 'autocomplete' => 'off', 'class' => 'form-horizontal form-validate', 'enctype' => 'multipart/form-data']); ?>
                                  <div class="form-group">
                                    <label for="formUser-Image" class="col-sm-2 control-label">User Profile Image</label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control" name="file" id="formUser-Image" placeholder="Upload Image" required accept="image/*" onchange="previewImage(this, '#imagePreview')">
                                    </div>
                                  </div>
                                  <div class="form-group" id="imagePreview">
                                    <label for="formUser-Preview" class="col-sm-2 control-label">Preview</label>
                                    <div class="col-sm-10">
                                      <img src="<?php echo userProfileImage($user->id) ?>" class="img-circle" width="150" alt="Uploaded Preview">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary btn-flat">Update Image</button>
                                    </div>
                                  </div>
                                <?php echo form_close(); ?>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- end card -->

            <div class="modal fade" id="modalEditEmployee">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Profile</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <form action="" id="editProfileForm">
                            <div class="modal-body modal-edit-employee"></div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="closeEditProfileModal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="updateProfile">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <!--Change Password modal-->
            <div class="modal fade" id="modalChangePassword">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-lock"></i> Change Password</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <form action="" id="changePasswordForm">
                            <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Employee Name</label>
                                        <input type="text" id="changePasswordEmployeeName" class="form-control" readonly="" disabled="">
                                    </div>
                                </div>
                                <br />
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">New Password</label>
                                        <input type="password" name="new_password" id="newPassword" required="" class="form-control">
                                        <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                                        <span class="old-password-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Retype Password</label>
                                        <input type="password" name="re_password" id="rePassword" required="" class="form-control">
                                        <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="closedChangePasswordModal">Close</button>
                                <button type="button" class="btn btn-success" id="updatePassword">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

      </div>
    </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>

<!-- /.row -->
  
  <!--Change Employee Profile Photo modal-->
<div class="modal fade" id="modalEditEmployeeProfile">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-image"></i> Change Employee Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="editEmployeeProfileForm">
                <div class="modal-body modal-edit-employee-profile" style="padding-bottom: 0px;">
                    <div class="form-group" style="margin-bottom: 0px !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <img style="margin:0 auto; height: 300px;" id="img_profile" src="">
                                <div class="margin-bottom" style="text-align: center;margin-top: 10px;">
                                    <input type="file" class="form-control" style="margin-left: 77px; width: auto;" name="user_photo" id="upload-employee-photo" placeholder="Upload Image" accept="image/*" required="">
                                </div>
                                <input type="hidden" name="user_id_prof" id="user_id_prof" value="<?= $user->id; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closeEditEmployeeModalProfilePhoto">Close</button>
                    <button type="button" class="btn btn-primary" id="updateEmployeeProfilePhoto">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

  <div class="modal fade fillAndSign__modal" id="updateSignature" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Signature</h5>
                <button type="button" class="close close-me" aria-label="Close">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="padding:1%;">
                        <center>
                            <div id="signArea" >
                                <?php echo form_open_multipart('', ['id' => 'form-signature', 'class' => 'form-validate', 'autocomplete' => 'off']); ?> 
                                <canvas id="canvas-a" style="border: solid gray 1px;"></canvas>
                                <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                <input type="hidden" id="saveUserSignatureDB1aMb" name="user_approval_signature1aM">
                                <input type="hidden" id="saveUserSignatureDB1aM_web" name="user_approval_signature1aM_web">
                                <?php echo form_close(); ?>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display: block;">
                <div>
                    <p>By clicking <strong>Save Signature</strong>, I agree that the signature will be the electronic representation of my signature for all purposes when
                        I (or my agent) use them on documents, including legally binding contracts - just the same as pen-and-paper signature.</p>
                </div>

                <div class="modal-footer__buttonContainer" style="display: flex; justify-content: flex-end;">
                    <button id="clear" class="btn btn-danger" style="margin-right: 10px;">Clear</button>
                    <button type="button" class="btn btn-primary d-flex align-items-center mr-2" id="signatureApplyButton">
                        <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save Signature
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  </div>


</section>
      <!-- end row -->
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).on('click', '#closeEditProfileModal', function() {
        $("#modalEditEmployee").modal('hide');
    });

    $(document).on('click', '#editProfile', function() {
        var user_id = $(this).attr('data-id');
        $(".modal-edit-employee").html('<span class="spinner-border spinner-border-sm m-0"></span>  Loading');
        $('#modalEditEmployee').modal({
            backdrop: 'static',
            keyboard: false
        });
        $.ajax({
            url: base_url + "users/load_edit_profile",
            type: "POST",
            dataType: "html",
            data: {
                user_id: user_id
            },
            success: function(data) {
                $(".modal-edit-employee").html(data);
            }
        });
    });

    var signaturePad;
    jQuery(document).ready(function () {
      var signaturePadCanvas = document.querySelector('#canvas-a');
    //   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
    //   signaturePadCanvas.setAttribute("width", parentWidth);
      signaturePad = new SignaturePad(signaturePadCanvas);

      signaturePadCanvas.width  = 680;
      signaturePadCanvas.height = 300;
    });

    $('#clear').click(function() {
      $('#signArea').signaturePad().clearCanvas();
    });

    $(document).on('click', '#closedChangePasswordModal', function() {
      $("#modalChangePassword").modal('hide');
    });

    $(document).on('click touchstart','#canvas-a',function(){
        // alert('test');
        var canvas_web = document.getElementById("canvas-a");    
        // alert(canvas_web);
        var dataURL = canvas_web.toDataURL("image/png");
        $("#saveUserSignatureDB1aMb").val(dataURL);
    });

    $(document).on('click', '#createSignatureButton', function(){
        $("#updateSignature").modal('show');
    });

    $(document).on('click', '#changePassword', function() {
        var user_id = $(this).attr('data-id');
        var employee_name = $(this).attr('data-name');
        $("#changePasswordUserId").val(user_id);
        $("#changePasswordEmployeeName").val(employee_name);
        $("#modalChangePassword").modal('show');
    });

    $(document).on('click touchstart','#signatureApplyButton',function(){
        // alert('test');
        var first = $("#saveUserSignatureDB1aMb").val();
        // alert(first);
        $("#saveUserSignatureDB1aM_web").val(first);

        // $(".img1").hide();

        var input_conf = '<img src="'+first+'">'

        $('#userSignatureContainer').html(input_conf);

        $.ajax({
            url: base_url + "users/_update_user_signature",
            type: "POST",
            dataType: "html",
            data: $('#form-signature').serialize(),
            success: function(data) {
                $(".modal-edit-employee").html(data);
            }
        });

        
        $('#updateSignature').modal('hide');
        
    });

    $(document).on('click', '#updateProfile', function() {
        $("#updateProfile").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        $.ajax({
            url: base_url + 'users/_update_profile',
            type: "POST",
            dataType: "json",
            data: $('#editProfileForm').serialize(),
            success: function(data) {
                if (data == 1) {
                    $("#modalEditEmployee").modal('hide');
                    Swal.fire({
                        title: 'Success',
                        text: "Your profile was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: "Cannot update profile. Please try again.",
                        icon: 'warning'
                    });
                }

                $("#updateProfile").html('Save');
            }
        });
    });

    $(document).on('click', '#updatePassword', function() {
        let values = {};
        $.each($('#changePasswordForm').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        if (values['new_password'] && values['re_password']) {
            $.ajax({
                url: base_url + 'users/_update_employee_password',
                type: "POST",
                dataType: "json",
                data: {
                    values: values
                },
                success: function(data) {
                    if (data.is_success) {
                        $("#modalChangePassword").modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: "Your password has been Updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: data.msg,
                            icon: 'warning'
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: 'Failed',
                text: "Please fillup form entries",
                icon: 'warning'
            });
        }
    });

    $(document).on('change', '#upload-employee-photo', function(e){
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('img_profile');
        output.src = reader.result;
      };
      reader.readAsDataURL(e.target.files[0]);
    });

    $(document).on('click', '#changeProfilePhoto', function() {
        var data_img = $(this).attr('data-img');
        if( data_img == 'default.png' ){
            var default_img = base_url + 'uploads/users/' + data_img;
        }else{
            var default_img = base_url + 'uploads/users/user-profile/' + data_img;
        }

        $("#img_profile").attr("src",default_img);

        $('#modalEditEmployeeProfile').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '#closeEditEmployeeModalProfilePhoto', function() {
      $("#modalEditEmployeeProfile").modal('hide');
    });

    $(document).on('click', '#updateEmployeeProfilePhoto', function() {
            var formData = new FormData($("#editEmployeeProfileForm")[0]);   
            $.ajax({
                url: base_url + 'users/ajaxUpdateEmployeeProfilePhoto',
                type: "POST",
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                data: formData,
                success: function(data) {
                    if (data == 1) {
                        $("#modalEditEmployeeProfile").modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: "Employee photo has been Updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: "Please select a valid image",
                            icon: 'warning'
                        });
                    }
                }
            });
        });

    $('.showPass').click(function() {
        $(this).toggleClass('fa-eye-slash');
        if ($(this).prev('input[type="password"]').length == 1) {
            $(this).prev('input[type="password"]').attr('type', 'text');
            $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
        } else {
            $(this).prev('input[type="text"]').attr('type', 'password');
            $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
        }
    });
    $('.showConfirmPass').click(function() {
        $(this).toggleClass('fa-eye-slash');
        if ($(this).prev('input[type="password"]').length == 1) {
            $(this).prev('input[type="password"]').attr('type', 'text');
            $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
        } else {
            $(this).prev('input[type="text"]').attr('type', 'password');
            $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
        }
    });


</script>

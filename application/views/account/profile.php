<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.pull-center {
  text-align: center;
  display: block;
}
.p-40 {
  padding-top: 40px !important;
}
table.account-info tbody tr td b {
    margin-left: 20%;
}
table.account-info {
    width: 100%;
    margin-bottom: 20px;
}
table.account-info tbody tr td {
    width: 50%;
    border: 1px solid black;
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
@media only screen and (max-width: 1550px) {
  table.account-info tbody tr td b {
      margin-left: 12%;
  }
}
@media only screen and (max-width: 1410px) {
  table.account-info tbody tr td b {
      margin-left: 10%;
  }
}
@media only screen and (max-width: 1280px) {
  table.account-info tbody tr td b {
      margin-left: 5%;
  }
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

        <img style="width:30%;margin:0 auto;" class="profile-user-img img-responsive img-circle" src="<?php echo userProfileImage($user->id) ?>" alt="User profile picture" />



        <h3 class="profile-username text-center mb-0"><?php echo ucfirst($user->FName); ?> <?php echo ucfirst($user->LName) ?></h3>



        <p class="text-muted text-center"><?php echo $user->role->title ?></p>


        <table class="account-info">
          <tr>
            <td><b>Username</b></td>
            <td><a class="pull-center"><?php echo $user->username ?></a></td>
          </tr>
          <tr>
            <td><b>Last Login</b></td>
            <td><a class="pull-right"><a class="pull-center"><?php echo date( setting('date_format'), strtotime($user->last_login)) ?></a></td>
          </tr>
          <tr>
            <td><b>Member Since</b></td>
            <td><a class="pull-right"><a class="pull-center"><?php echo date( setting('date_format'), strtotime($user->created_at)) ?></a></td>
          </tr>
        </table>
        <!--
        <ul class="list-group list-group-unbordered">

          <li class="list-group-item">

            <b>Username</b> <a class="pull-right"><?php echo $user->username ?></a>

          </li>

          <li class="list-group-item">

            <b>Last Login</b> <a class="pull-right"><?php echo date( setting('date_format'), strtotime($user->last_login)) ?></a>

          </li>

          <li class="list-group-item">

            <b>Member Since</b> <a class="pull-right"><?php echo date( setting('date_format'), strtotime($user->created_at)) ?></a>

          </li>

        </ul>
      -->


        <a href="<?php echo url('profile/index/edit') ?>" class="btn btn-primary btn-block"><b> <i class="fa fa-pencil"></i> Edit Profile</b></a>

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
                          <div class="banking-tab-container">
                              <div class="rb-01">
                                  <ul class="nav nav-tabs border-0">
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#profile">Profile</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#edit">Edit</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#profImg">Change Profile Image</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#changePwd">Change Password</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#compProfImg">Change Company Profile Image</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#signatureDiv">Signature</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          <div class="tab-content mt-4" >
                              <div class="tab-pane active standard-accordion" id="profile">
                                  <div class="col-sm-6">
                                      <h3 class="page-title">Profile</h3>
                                  </div>
                                  <div class="<?php echo $activeTab=='profile'?'active':'' ?> tab-pane" id="viewProfile">
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
                                          <td><strong>Phone</strong>:</td>
                                          <td><?php echo $user->phone ?></td>
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
                              </div>

                              <div class="tab-pane fade standard-accordion" id="edit">
                                  <div class="col-sm-12">
                                      <h3 class="page-title">Edit</h3>
                                  </div>
                                  <div class="<?php echo $activeTab=='edit'?'active':'' ?> tab-pane" id="editProfile">
                                  <?php echo form_open('/profile/updateProfile', ['method' => 'POST', 'autocomplete' => 'off', 'class' => 'form-horizontal form-validate']); ?>
                                    <div class="form-group">
                                      <label for="inputName" class="col-sm-2 control-label">First Name</label>
                                      <div class="col-sm-10">
                                        <input type="name" name="FName" required class="form-control" id="inputName" value="<?php echo $user->FName ?>" autofocus placeholder="Name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                                      <div class="col-sm-10">
                                        <input type="name" name="LName" required class="form-control" id="inputName" value="<?php echo $user->LName ?>" autofocus placeholder="Name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputUserName" class="col-sm-2 control-label">Username</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control"  minlength="5" data-rule-remote="<?php echo url('users/check?notId='.$user->id) ?>" data-msg-remote="Username Already taken" name="username" id="inputUsername" required placeholder="Enter Username"  value="<?php echo $user->username ?>"/>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                      <div class="col-sm-10">
                                        <input type="email" name="email" required
                                        data-rule-remote="<?php echo url('users/check?notId='.$user->id) ?>" data-msg-remote="Email Already Exists"
                                        class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $user->email ?>">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputContact" class="col-sm-2 control-label">Contact Number</label>
                                      <div class="col-sm-10">
                                        <input type="name" name="contact" class="form-control" id="inputContact" value="<?php echo $user->phone ?>" placeholder="Contact Number..">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputContact" class="col-sm-2 control-label">Address</label>
                                      <div class="col-sm-10">
                                        <textarea type="text" class="form-control" name="address" id="inputAddress" placeholder="Enter Address" rows="3"><?php echo $user->address ?></textarea>
                                      </div>
                                    </div>
                                    <div class="form-group hidden">
                                      <label for="inputContact" class="col-sm-2 control-label">Role</label>
                                      <div class="col-sm-10">
                                        <select name="role" id="inputRole" class="form-control select2">
                                          <option value="">Select Role</option>
                                          <?php foreach ($this->roles_model->get() as $row): ?>
                                            <?php $sel = !empty($user->role) && $user->role->id==$row->id ? 'selected' : '' ?>
                                            <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                      </div>
                                    </div>
                                  <?php echo form_close(); ?>
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

                              <div class="tab-pane standard-accordion" id="changePwd">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Change Password</h3>
                                </div>
                                <div class="<?php echo $activeTab=='change_password'?'active':'' ?> tab-pane" id="changePassword">
                                <?php echo form_open('/profile/updatePassword', ['method' => 'POST', 'autocomplete' => 'off', 'class' => 'form-horizontal form-validate']); ?>
                                  <div class="alert alert-warning" role="alert">
                                    You will need to login again after password is changed !
                                  </div>
                                  <div class="alert alert-info" role="alert">
                                    Password must be atleast 6 characters long !
                                  </div>
                                  <div class="form-group">
                                    <label for="inputContact" class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                      <div class="has-feedback">
                                        <input type="password" class="form-control" placeholder="Enter New Old Password..." minlength="6" name="old_password" required autofocus id="old_password" />
                                        <span class="fa fa-lock form-control-feedback"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputContact" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                      <div class="has-feedback">
                                        <input type="password" class="form-control" placeholder="Enter New Password..." minlength="6" name="password" required autofocus id="password" />
                                        <span class="fa fa-lock form-control-feedback"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputContact" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                      <div class="has-feedback">
                                        <input type="password" class="form-control" equalTo="#password" placeholder="Enter New Password Again..." required name="password_confirm" />
                                        <span class="fa fa-lock form-control-feedback"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                    </div>
                                  </div>
                                <?php echo form_close(); ?>
                                </div>
                              </div>

                              <div class="tab-pane standard-accordion" id="compProfImg">
                                  <div class="col-sm-6">
                                      <h3 class="page-title">Change Company Profile Image</h3>
                                  </div>
                                  <div class="<?php echo $activeTab=='change_pic'?'active':'' ?> tab-pane" id="editCompanyProfileImage">
                                  <?php echo form_open('/profile/updateProfilePic', ['method' => 'POST', 'autocomplete' => 'off', 'class' => 'form-horizontal form-validate', 'enctype' => 'multipart/form-data']); ?>
                                  <div class="form-group">
                                    <label for="formAdmin-Image" class="col-sm-2 control-label">Company Image</label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control" name="image" id="formAdmin-Image" placeholder="Upload Image" required accept="image/*" onchange="previewImage(this, '#imagePreview')">
                                    </div>
                                  </div>
                                  <div class="form-group" id="imagePreview">
                                    <label for="formAdmin-Preview" class="col-sm-2 control-label">Preview</label>
                                    <div class="col-sm-10">
                                      <img src="<?php echo userProfile($user->id) ?>" class="img-circle" width="150" alt="Uploaded Preview">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary btn-flat">Update</button>
                                    </div>
                                  </div>
                                <?php echo form_close(); ?>
                                </div>
                              </div>

                              <div class="tab-pane standard-accordion" id="signatureDiv">
                                  <div class="<?php echo $activeTab=='signature'?'active':'' ?> tab-pane" id="editSignature">
                                  <?php echo form_open('/profile/updateUserProfilePic', ['method' => 'POST', 'autocomplete' => 'off', 'class' => 'form-horizontal form-validate', 'enctype' => 'multipart/form-data']); ?>
                                    <h4>Signature</h4>
                                      <div class="row">
                                          <div class="col-md-12">
                                          <div class="signature-holder">
                                              <div class="signature-body mb-3">
                                                  <p>This is the electronic representation of your signature, update any time.</p>

                                                  <img id="userSignatureImage">
                                                  <small>Last updated on <span id="userSignatureImageUpdatedAt"></span></small>
                                              </div>
                                          </div>

                                          <div class="alert alert-warning" id="userSignatureWarning" role="alert">
                                            Register your signature by clicking the button below.
                                          </div>

                                          <div class="signature-btn-holder">
                                              <a class="btn btn-primary btn-flat" style="color:#fff" id="createSignatureButton">Register Signature</a>
                                          </div>
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
      </div>
    </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>

<!-- /.row -->
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
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="draw-tab" data-toggle="tab" href="#draw" role="tab" aria-controls="draw" aria-selected="false">
                            <i class="fa fa-pencil mr-2"></i>Draw
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="true">
                            <i class="fa fa-keyboard-o mr-2"></i>Type
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" data-signature-type="draw" id="draw" role="tabpanel" aria-labelledby="draw-tab">
                        <div class="fillAndSign__signaturePad">
                            <canvas width="700" height="200" style="touch-action: none;"></canvas>
                            <a href="#">Clear</a>
                        </div>
                    </div>
                    <div class="tab-pane" data-signature-type="type" id="type" role="tabpanel" aria-labelledby="type-tab">

                        <div class="dropdown mt-2 mb-2" id="fontSelect">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="fontDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Font
                            </button>
                            <div class="dropdown-menu" aria-labelledby="fontDropdown">
                                <a class="dropdown-item" href="#" data-font="font-1">Font 1</a>
                                <a class="dropdown-item" href="#" data-font="font-2">Font 2</a>
                                <a class="dropdown-item" href="#" data-font="font-3">Font 3</a>
                                <a class="dropdown-item" href="#" data-font="font-4">Font 4</a>
                                <a class="dropdown-item" href="#" data-font="font-5">Font 5</a>
                            </div>
                        </div>

                        <input class="form-control fillAndSign__signatureInput" spellcheck="false" autocomplete="off" autofocus="" tabindex="0" aria-label="Type your signature here" maxlength="255" placeholder="Type your signature here">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display: block;">
                <div>
                    <p>By clicking <strong>Save Signature</strong>, I agree that the signature will be the electronic representation of my signature for all purposes when
                        I (or my agent) use them on documents, including legally binding contracts - just the same as pen-and-paper signature.</p>
                </div>

                <div class="modal-footer__buttonContainer" style="display: flex; justify-content: flex-end;">
                    <button type="button" class="btn btn-primary d-flex align-items-center mr-2" id="signatureApplyButton">
                        <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save Signature
                    </button>
                    <button type="button" class="btn btn-secondary close-me" id="signatureModalCloseButton">Close</button>
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

  $(document).ready(function() {

    $('.form-validate').each(function() {

      $(this).validate();

    });

  })



  function previewImage(input, previewDom) {



    if (input.files && input.files[0]) {



      $(previewDom).show();



      var reader = new FileReader();



      reader.onload = function(e) {

        $(previewDom).find('img').attr('src', e.target.result);

      }



      reader.readAsDataURL(input.files[0]);

    }else{

      $(previewDom).hide();

    }



  }


</script>

<script>

      //Initialize Select2 Elements

    $('.select2').select2()

</script>

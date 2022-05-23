<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">  
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

   
      <section class="content">

<div class="row">

  <div class="col-md-3">



    <!-- Profile Image -->

    <div class="box box-primary">

      <div class="box-body box-profile text-center">

        <img style="width:30%;" class="profile-user-img img-responsive img-circle" src="<?php echo userProfileImage($user->id) ?>" alt="User profile picture" />



        <h3 class="profile-username text-center"><?php echo ucfirst($user->FName); ?> <?php echo ucfirst($user->LName) ?></h3>



        <p class="text-muted text-center"><?php echo $user->role->title ?></p>



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
              <div class="card-body hid-desk" style="padding-bottom:0px;">
                  <div class="row align-items-center pt-3 bg-white">
                      <div class="col-md-12">
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
                                      <input type="file" class="form-control" name="image" id="formUser-Image" placeholder="Upload Image" required accept="image/*" onchange="previewImage(this, '#imagePreview')">
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
                                      <p>This is your signature, update any time.</p>
                                      <div class="row">
                                          <div class="col-md-12">
                                          <div class="signature-holder">
                                              <div class="signature-body">
                                                  <?php if ( empty( $user->signature ) ){ ?>
                                                    <img src="<?=url("");?>uploads/signatures/demo.png" class="img-responsive">
                                                  <?php }else{ ?>
                                                    <img src="<?=url("");?>uploads/signatures/{{ $user->signature }}" class="img-responsive">
                                                  <?php } ?>
                                              </div>
                                          </div>
                                          <div class="signature-btn-holder">
                                              <a class="btn btn-primary btn-block"  data-toggle="modal" data-target="#updateSignature" data-target="#createFolder" data-backdrop="static" data-keyboard="false"> Update Signature</a>
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
<div class="modal fade" id="updateSignature" role="dialog">
        <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
      <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Signature </h4>
                </div>
      <ul class="head-links">
        <li type="capture" class="active"><a data-toggle="tab" href="#text">Text</a></li>
        <li type="upload"><a data-toggle="tab" href="#upload">Upload</a></li>
        <li type="draw"><a data-toggle="tab" href="#draw">Draw</a></li>
      </ul>
        <div class="modal-body">
        <div class="tab-content">
            <div id="text" class="tab-pane fade in active">
                      <form>
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                  <label>Type your signature</label>
                                  <input type="text" class="form-control signature-input" name="" placeholder="Type your signature" maxlength="18" value="Your Name">
                                </div>
                                <div class="col-md-6">
                                  <label>Select font</label>
                                  <select class="form-control signature-font" name="">
                                      <option value="Lato">Lato</option>
                                      <option value="Miss Fajardose">Miss Fajardose</option>
                                      <option value="Meie Script">Meie Script</option>
                                      <option value="Petit Formal Script">Petit Formal Script</option>
                                      <option value="Niconne">Niconne</option>
                                      <option value="Rochester">Rochester</option>
                                      <option value="Tangerine">Tangerine</option>
                                      <option value="Great Vibes">Great Vibes</option>
                                      <option value="Berkshire Swash">Berkshire Swash</option>
                                      <option value="Sacramento">Sacramento</option>
                                      <option value="Dr Sugiyama">Dr Sugiyama</option>
                                      <option value="League Script">League Script</option>
                                      <option value="Courgette">Courgette</option>
                                      <option value="Pacifico">Pacifico</option>
                                      <option value="Cookie">Cookie</option>
                                      <option value="Grand Hotel">Grand Hotel</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                  <label>Weight</label>
                                  <select class="form-control signature-weight" name="">
                                      <option value="normal">Regular</option>
                                      <option value="bold">Bold</option>
                                      <option value="lighter">Lighter</option>
                                  </select>
                                </div>
                                <div class="col-md-4">
                                  <label>Color</label>
                                  <input  class="form-control signature-color jscolor { valueElement:null,borderRadius:'1px', borderColor:'#e6eaee',value:'000000',zIndex:'99999', onFineChange:'updateSignatureColor(this)'}" readonly="">
                                </div>
                                <div class="col-md-4">
                                  <label>Style</label>
                                  <select class="form-control signature-style" name="">
                                      <option value="normal">Regular</option>
                                      <option value="italic">Italic</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                      </form>
                      <div class="divider"></div>
                      <h4 class="text-center">Preview</h4>
                      <div class="text-signature-preview">
                          <div class="text-signature" id="text-signature" style="color: #000000">Your Name</div>
                      </div>

            </div>
            <div id="upload" class="tab-pane fade">
                <p>Upload your signature if you already have it.</p>
                  <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Upload your signature</label>
                                <input type="file" name="signatureupload" class="croppie" crop-width="400" crop-height="150">
                          </div>
                      </div>
                  </div>
            </div>
            <div id="draw" class="tab-pane fade text-center">
                    <p>Draw your signature.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="draw-signature-holder"><canvas width="400" height="150" id="draw-signature"></canvas></div>
                            <div class="signature-tools text-center" id="controls">
                                <div class="signature-tool-item with-picker">
                                    <div><button class="jscolor { valueElement:null,borderRadius:'1px', borderColor:'#e6eaee',value:'000000',zIndex:'99999', onFineChange:'modules.color(this)'}"></button></div>
                                </div>
                                <div class="signature-tool-item" id="signature-stroke" stroke="5">
                                    <div class="tool-icon tool-stroke"></div>
                                </div>
                                <div class="signature-tool-item" id="undo">
                                    <div class="tool-icon tool-undo"></div>
                                </div>
                                <div class="signature-tool-item" id="clear">
                                    <div class="tool-icon tool-erase"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save-signature">Save Signature</button>
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
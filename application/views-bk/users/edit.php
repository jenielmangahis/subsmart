<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Users</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">manage users</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                     <?php if (hasPermissions('users_add')): ?>
                     <a href="<?php echo url('users') ?>" class="btn btn-primary" aria-expanded="false">
                     <i class="mdi mdi-settings mr-2"></i> Go Back to User
                     </a>   
                     <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->    
      <?php echo form_open_multipart('users/update/'.$User->id, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>                
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="mt-0 header-title mb-5">Edit User</h4>
                  <div class="row">
                     <div class="col-md-12">
                        <h3>Basic Details</h3>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Name">Name</label>
                        <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Name" onkeyup="$('#formClient-Username').val(createUsername(this.value))" value="<?php echo $User->name ?>" autofocus />
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Contact">Contact Number</label>
                        <input type="text" class="form-control" name="phone" id="formClient-Contact" placeholder="Enter Contact Number" value="<?php echo $User->phone ?>"/>
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-md-12">
                        <h3>Login Details</h3>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Email">Email</label>
                        <input type="email" class="form-control" name="email" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Email Already Exists" id="formClient-Email" required placeholder="Enter email"  value="<?php echo $User->email ?>">
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Username">Username</label>
                        <input type="text" class="form-control" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Username Already taken" name="username" id="formClient-Username" required placeholder="Enter Username"  value="<?php echo $User->username ?>"/>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label for="formClient-Password">Password</label>
                        <input type="text" class="form-control" minlength="6" name="password"value="<?php echo $User->password_plain ?>" id="password" placeholder="Password" />
                        <p class="help-block">Leave Blank to remain unchanged !</p>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-ConfirmPassword">Confirm Password</label>
                        <input type="text" class="form-control" minlength="6" equalTo="#password" name="confirm_password" id="formClient-ConfirmPassword" placeholder="Confirm Password" />
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <h3>Other Details</h3>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Address">Address</label>
                        <textarea type="text" class="form-control" name="address" id="formClient-Address" placeholder="Enter Address" rows="3"><?php echo $User->address ?></textarea>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Role">Role</label>
                        <select name="role" id="formClient-Role" class="form-control select2" required>
                           <option value="">Select Role</option>
                           <?php foreach ($this->roles_model->get() as $row): 
							if($row->id==1) continue;
							if($User->id != logged('id'))
								if($row->id <= logged('role')) continue; 
							
							?>
                           <?php $sel = !empty($User->role) && $User->role==$row->id ? 'selected' : '' ?>
                           <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label for="formClient-Status">Status</label>
                        <select name="status" id="formClient-Status" class="form-control" <?php echo logged('id')==$User->id ? 'disabled' : '' ?>>
                           <?php $sel = $User->status==1 ? 'selected' : '' ?>
                           <option value="1" <?php echo $sel ?>>Active</option>
                           <?php $sel = $User->status==0 ? 'selected' : '' ?>
                           <option value="0" <?php echo $sel ?>>InActive</option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <h3>Profile Image</h3>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="formClient-Image">Image</label>
                        <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <div class="form-group" id="imagePreview">
                           <img src="<?php echo userProfile($User->id) ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">
                        </div>
                     </div>
                  </div>
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
<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready(function() {
   
     $('.form-validate').validate();
   
       //Initialize Select2 Elements
   
     $('.select2').select2()
   
   
   
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
   
   function createUsername(name) {
   
       return name.toLowerCase()
   
         .replace(/ /g,'_')
   
         .replace(/[^\w-]+/g,'')
   
         ;;
   
   }
   
</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<style>
.new_work_order {
    padding: 50px 0;
    border-top: 1px solid #ddd;
    margin-top: 16px;
    background: #f2f2f2;
    font-size: 13px;
}
</style>
<!-- Main content -->

<section class="mt-5 mb-5 new_work_order">
	<div class="customContainer">
		<div class="row">
			<div class="col-sm-12">

<?php echo form_open_multipart('home/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>


  <div class="row">

    <div class="col-sm-6">

      <!-- Default box -->

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">Basic Details</h3>

        </div>

        <div class="box-body">



          <div class="form-group">

            <label for="formClient-Name">Business Name</label>

            <input type="text" class="form-control" name="name" minlength="5" id="formClient-Name" required placeholder="Enter Name" onkeyup="$('#formClient-Username').val(createUsername(this.value))" autofocus />

          </div>



          <div class="form-group">

            <label for="formClient-Contact">Business Contact Number</label>

            <input type="text" class="form-control" name="phone" id="formClient-Contact" placeholder="Enter Contact Number" />

          </div>



        </div>

        <!-- /.box-body -->



      </div>

      <!-- /.box -->



      <!-- Default box -->

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">Login Details</h3>

        </div>

        <div class="box-body">



          <div class="form-group">

            <label for="formClient-Email">Email</label>

            <input type="email" class="form-control" name="email" data-rule-remote="<?php echo url('users/check') ?>" data-msg-remote="Email Already Exists" id="formClient-Email" required placeholder="Enter email">

          </div>



          <div class="form-group">

            <label for="formClient-Username">Username</label>

            <input type="text" class="form-control" minlength="5" data-rule-remote="<?php echo url('users/check') ?>" data-msg-remote="Username Already taken" name="username" id="formClient-Username" required placeholder="Enter Username" />

          </div>



          <div class="form-group">

            <label for="formClient-Password">Password</label>

            <input type="password" class="form-control" name="password" minlength="6" id="formClient-Password" required placeholder="Password">

          </div>



          <div class="form-group">

            <label for="formClient-ConfirmPassword">Confirm Password</label>

            <input type="password" class="form-control" name="confirm_password" equalTo="#formClient-Password" id="formClient-ConfirmPassword" required placeholder="Confirm Password">

          </div>



        </div>

        <!-- /.box-body -->



      </div>

      <!-- /.box -->

      

    </div>

    <div class="col-sm-6">

      <!-- Default box -->

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">Other Details</h3>

        </div>

        <div class="box-body">



          <div class="form-group">

            <label for="formClient-Address">Business Address</label>

            <input type="text" class="form-control" name="address" id="formClient-Address" placeholder="Enter Address"/>

          </div>



          <div class="form-group d-none">
            <label for="formClient-Role">Role</label>
            <select name="role" id="formClient-Role" class="form-control select2" required>
              <option value="">Select Role</option>
			  <option value="2" selected>Admin</option>
            </select>
          </div>
          <div class="form-group d-none">
            <label for="formClient-Status">Status</label>
            <select name="status" id="formClient-Status" class="form-control">
              <option value="1" selected>Active</option>
              <option value="0">InActive</option>
            </select>

          </div>



        </div>

        <!-- /.box-body -->



      </div>

      <!-- /.box -->

    

      <!-- Default box -->

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">Business Logo</h3>

        </div>

        <div class="box-body">



          <div class="form-group">

            <label for="formClient-Image">Image</label>

            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">

          </div>

          <div class="form-group" id="imagePreview">

            <img src="<?php echo userProfile('default') ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">

          </div>



        </div>

        <!-- /.box-body -->



      </div>

      <!-- /.box -->



    </div>

  </div>


  <!-- Default box -->

  <div class="box">

    <div class="box-footer">

      <button name="button" type="submit" class="btn btn-flat btn-primary">Submit</button>

    </div>

    <!-- /.box-footer-->



  </div>

  <!-- /.box -->



<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</section>

<!-- /.content -->





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



<?php include viewPath('frontcommon/footer'); ?>




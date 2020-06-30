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
            <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">New User</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Basic Details</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Name">First Name</label>
                                    <input type="text" class="form-control" name="FName" id="formClient-FName" required
                                           placeholder="Enter First Name"
                                           onkeyup="$('#formClient-Username').val(createUsername(this.value))"
                                           autofocus/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Name">Last Name</label>
                                    <input type="text" class="form-control" name="LName" id="formClient-LName" required
                                           placeholder="Enter Last Name"/>
                                </div>
                                <div class="col-md-4 form-group" style="display:none;">
                                    <label for="formClient-Contact">Contact Number</label>
                                    <input type="text" class="form-control" name="phone" id="formClient-Contact"
                                           placeholder="Enter Contact Number"/>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Login Details</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           data-rule-remote="<?php echo url('users/check') ?>"
                                           data-msg-remote="Email Already Exists" id="formClient-Email" required
                                           placeholder="Enter email">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Username">Username</label>
                                    <input type="text" class="form-control"
                                           data-rule-remote="<?php echo url('users/check') ?>"
                                           data-msg-remote="Username Already taken" name="username"
                                           id="formClient-Username" required placeholder="Enter Username"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Password">Password</label>
                                    <input type="password" class="form-control" name="password" minlength="6"
                                           id="formClient-Password" required placeholder="Password">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-ConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password"
                                           equalTo="#formClient-Password" id="formClient-ConfirmPassword" required
                                           placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Other Details</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Address">Address</label>
                                    <textarea type="text" class="form-control" name="address" id="formClient-Address"
                                              placeholder="Enter Address" rows="3"></textarea>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Role">Role<?php echo logged('role'); ?></label>
                                    <select name="role" id="formClient-Role" class="form-control select2" required>
                                        <option value="">Select Role</option>
                                        <?php foreach ($this->roles_model->get() as $row): if ($row->id <= logged('role')) continue; ?>
                                            <?php $sel = !empty(get('role')) && get('role') == $row->id ? 'selected' : '' ?>
                                            <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Status">Status</label>
                                    <select name="status" id="formClient-Status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="formClient-Status">App Access</label><br>
                                    <input type="checkbox" name="app_access" class="js-switch" checked />
                                    
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="formClient-Status">Web Access</label><br>
                                    <input type="checkbox" name="web_access" class="js-switch" checked />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Profile Image</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="formClient-Image">Image</label>
                                    <input type="file" class="form-control" name="image" id="formClient-Image"
                                           placeholder="Upload Image" accept="image/*"
                                           onchange="previewImage(this, '#imagePreview')">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <div class="form-group" id="imagePreview">
                                        <img src="<?php echo userProfile('default') ?>" class="img-circle"
                                             alt="Uploaded Image Preview" width="100" height="100">
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
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {

        $('.form-validate').validate();

        //Initialize Select2 Elements

        $('.select2').select2()

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

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

</script>
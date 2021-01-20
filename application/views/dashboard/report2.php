<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-sm-4" id="job">
    <div class="expenses tile-container">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-feed" aria-hidden="true"></i> Feeds</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="inner-news">
                                <div class="card">
                                    <div class="card-body pt-0 pb-0">
                                        <?php foreach($feeds as $feed) : ?>
                                            <div class="wid-peity mb-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <p class="text-muted"><?php echo $feed->company_id; ?></p>
                                                            <h5><?php echo $feed->subject; ?></h5>
                                                            <p><?php echo $feed->description; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-4"><span class="peity-line" data-width="100%"
                                                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                                                data-height="60"><?php echo $feed->date; ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <a href="javascript:void(0)" class="card-link" data-toggle="modal" data-target="#exampleModal">Add New Feed</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="addEmployeeForm">
                <input type="hidden" name="user_id" id="userID">
                <div class="modal-body">
                    <div class="section-title">Basic Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Login Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" style="display: block">Email</label>
                                <input type="text" name="email" class="form-control" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
                                <span class="email-error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" style="display: block">Username</label>
                                <input type="text" name="username" class="form-control" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
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
                                    <input type="password" name="addnew_password" id="employeePass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                    <span class="password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="employeeConfirmPass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showConfirmPass" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void (0)" class="change-password" id="changePassword">Want to change password?</a>
                        <div class="new-password-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Old Password</label>
                                    <input type="password" name="old_password" id="oldPassword" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                    <span class="old-password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">New Password</label>
                                    <input type="password" name="new_password" id="newPassword" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Other Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Role</label>
                                <select name="role" id="employeeRole" class="form-control select2-role"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
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
                    <div class="section-title">Profile Image</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image</label>
                                <div id="employeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                    <div class="dz-message" style="margin: 20px;border">
                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                    </div>
                                </div>
                                <input type="hidden" name="img_id" id="photoId">
                                <input type="hidden" name="profile_photo" id="photoName">
                            </div>
                            <div class="col-md-6">
                                <div class="profile-container">
                                    <img src="/uploads/users/default.png" alt="Profile photo">
                                </div>
                                <label>Role and Access</label>
                                <div class="help help-sm help-block">Select employee role</div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="1" id="role_1">
                                        <label for="role_1"><span>Office Manager</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        ALL except high security file vault<br>
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="2" id="role_2">
                                        <label for="role_2"><span>Partner</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        ALL base on plan type
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="3" id="role_3">
                                        <label for="role_3"><span>Team Leader</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        No accounting or any changes to company profile or deletion
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="4" id="role_4">
                                        <label for="role_4"><span>Standard User</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        Can not add or delete employees, can not manage subscriptions
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="5" id="role_5">
                                        <label for="role_5"><span>Field Sales</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        View only no input 
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="6" id="role_6">
                                        <label for="role_6"><span>Field Tech</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        App access only, no Web access 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Title</label>
                                <select name="role" id="employeeRole" class="form-control select2-role"></select>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="closedEmployeeModal">Close</button>
                <button type="button" class="btn btn-success" id="savedNewEmployee">Save & exit</button>
            </div>
        	</form>

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Feed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php echo form_open('dashboard/saveFeed', ['class' => 'form-validate require-validation', 'id' => 'feed_form', 'autocomplete' => 'off']); ?>
            <div class="col-md-6 form-group">
                <label for="job_customer">Recipient</label>
                <select class="form-control" id="job_customer" name="job_customer">
                    <?php if(!empty($customers)) : ?>
                        <option disabled selected>--Select--</option>
                        <?php foreach($customers as $customer) : ?>
                            <option value="<?php echo $customer->user_id; ?>"><?php echo $customer->contact_name; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <input type="hidden" id="recipient_id" name="recipient_id" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Subject</label>
                <input type="text" class="form-control" name="feed_subject" id="feed_subject" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Description</label>
                <textarea name="feed_description" class="form-control" id="feed_description" cols="30" rows="10"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Feed</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
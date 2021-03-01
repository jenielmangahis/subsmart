<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="card">
              <div class="page-title-box pt-1 pb-0">
                  <div class="row align-items-center">
                      <div class="col-sm-12">
                          <div class="float-right">
                              <div class="dropdown">
                                  <a href="<?php echo base_url('customer/leads') ?>" class="btn btn-primary"
                                     aria-expanded="false">
                                      <i class="mdi mdi-settings mr-2"></i> Lead Lists
                                  </a>
                              </div>
                          </div>
                          <!-- <h3 class="page-title mt-0">New Lead</h3> -->
                          <h3 style="font-family: Sarabun, sans-serif">Lead Lists</h3>
                          <div class="pl-3 pr-3 mt-1 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                    To create new lead go to Lead TAB and Select new. Enter all the Lead information as shown below.
                                    Enter Address information.  Enter Additional Information and Description
                                    and Finally click Save Button.  All required fields must have information.
                                </span>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12" style="background-color:#C9AAE1;padding:1px;text-align:center;color:black;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>Lead Type </b><span class="required_field">*</span></label>
                        <a href="<?php echo url('customer/index/tab3/1/mt13') ?>" class=""><span class="fa fa-plus"></span></a><br/>
                        <select id="fk_lead_id" name="fk_lead_id"  class="form-control" required>
                        <?php foreach ($lead_types as $lt): ?>
                        <option <?php if(isset($leads_data)){ if($leads_data->fk_lead_id == $lt->lead_id){ echo 'selected'; } } ?> value="<?= $lt->lead_id; ?>"><?= $lt->lead_name; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>Sales Representative </b></label><br/>
                        <select id="fk_sr_id" name="fk_sr_id"  class="form-control">
                        <option value="">Select</option>
                        <?php foreach ($users as $user): ?>
                        <option <?php if(isset($leads_data)){ if($leads_data->fk_assign_id == $user->id){ echo 'selected'; } } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""> <b>Assigned To </b><span class="required_field">*</span></label><br/>
                        <select id="fk_assign_id" name="fk_assign_id"  class="form-control" required>
                        <option value="">Select</option>
                        <?php foreach ($users as $user): ?>
                        <option <?php if(isset($leads_data)){ if($leads_data->fk_sr_id == $user->id){ echo 'selected'; } } ?> value="<?= $user->id; ?>" value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" style="background-color:#C9AAE1;padding:1px;text-align:center;color:black;">
                    <h5>Contact Information</h5>
                </div>
            </div>
            <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""><b>First Name </b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(isset($leads_data)){ echo $leads_data->firstname; } ?>" required/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Middle Initial </b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" maxlength="1" name="middle_initial" id="middle_initial" value="<?php if(isset($leads_data)){ echo $leads_data->middle_initial; } ?>"/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Last Name</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(isset($leads_data)){ echo $leads_data->lastname; } ?>"  required/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Name Suffix</b><span class="required_field">*</span></label>
                        <select id="suffix" name="suffix"  class="form-control">
                        <?php
                            for ($suffix=0;$suffix<14;$suffix++){
                        ?>
                        <option <?php if(isset($leads_data)){ if($leads_data->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                            
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""><b>Address</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php if(isset($leads_data)){ echo $leads_data->address; } ?>" required/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>State</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($leads_data)){ echo $leads_data->state; } ?>" required/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>City</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($leads_data)){ echo $leads_data->city; } ?>" required/>
                    </div>
                    <div class="col-md-2">
                        <label for=""><b>County</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="county" id="county" value="<?php if(isset($leads_data)){ echo $leads_data->county; } ?>" />
                    </div>
                    <div class="col-md-1">
                        <label for=""><b>ZIP</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="zip" id="zip" value="<?php if(isset($leads_data)){ echo $leads_data->zip; } ?>" required/>
                    </div>
                </div>
            
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""><b>Country</b></label>
                        <select id="country" name="country" class="form-control" required>
                        <option <?php if(isset($leads_data)){ if($leads_data->country == 'USA'){ echo 'selected'; }} ?> value="USA">USA</option>
                        <option <?php if(isset($leads_data)){ if($leads_data->country == 'CANADA'){ echo 'selected'; }} ?> value="CANADA">CANADA</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Home/Panel Phone</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control phone_number" name="phone_home" id="phone_home" maxlength="12" placeholder="xxx-xxx-xxxx" value="<?php if(isset($leads_data)){ echo $leads_data->phone_home; } ?>"/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Cell Phone</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_cell" id="phone_cell" value="<?php if(isset($leads_data)){ echo $leads_data->phone_cell; } ?>" required/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Email Address</b><span class="required_field">*</span></label>
                        <input type="email" class="form-control" name="email_add" id="email_add" value="<?php if(isset($leads_data)){ echo $leads_data->email_add; } ?>" required/>
                    </div>
                </div>
                            
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""><b>Social Security Number</b></label>
                        <input type="text" maxlength="11" placeholder="xxx-xx-xxxx" class="form-control" name="sss_num" id="sss_num" value="<?php if(isset($ssn) && count($ssn)>0){ echo $ssn[0]; } ?>"/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Date of Birth</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(isset($leads_data)){ echo $leads_data->date_of_birth; } ?>"/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b>Status</b><span class="required_field">*</span></label>
                        <select id="status" name="status"  class="form-control" >
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'New'){echo "selected";} } ?> value="New">New</option>
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Contacted'){echo "selected";} } ?> value="Contacted">Contacted</option>
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Follow Up'){echo "selected";} } ?> value="Follow Up">Follow Up</option>
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Assigned'){echo "selected";} } ?> value="Assigned">Assigned</option>
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Converted'){echo "selected";} } ?> value="Converted">Converted</option>
                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Closed'){echo "selected";} } ?> value="Closed">Closed</option>
                        </select>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-md-12" style="background-color:#C9AAE1;padding:1px;text-align:center;color:black;">
                        <h5>New Credit Report</h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <!-- <label for="">New Credit Report</label> -->
                        <select id="credit_report" name="credit_report"  class="form-control" >
                            <option value="TrunsUnion">TransUnion</option>
                            <option value="Experian">Experian </option>
                            <option value="Equifax ">Equifax  </option>
                        </select>
                    </div>
                </div>
                
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-play"></span> Run Credit</button>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-md-12" style="background-color:#C9AAE1;padding:1px;text-align:center;color:black;">
                        <h5>Report History</h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <!-- <label for="">Report History</label> -->
                        <input value="No History" type="text" class="form-control" name="report_history" disabled id="report_history"/>
                    </div>
                </div>
                
                <br>
                <div class="row">
                    <div class="col-md-3">
                    <button type="submit" name="convert_customer" class="btn btn-primary"><span class="fa fa-exchange"></span>  Convert to Customer </button>
                    </div>
                </div>

                <br><br><br><br><br>
                <div>
                    <?php
                        if(isset($leads_data)){
                    ?>
                    <input value="<?=  $leads_data->leads_id; ?>" type="hidden" class="form-control" name="leads_id" />
                    <?php
                        }
                    ?>

                     <div class="form-group">
                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                        <a href="<?php echo base_url('customer/leads'); ?>"><button type="button" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button></a>
                    </div>
                </div>
            <!-- end card -->
            </div>




        </div>

        <style>

        </style>
        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    $("#date_of_birth").datetimepicker({
        format: "L",
        //minDate: new Date(),
    });

    $(function () {
        $('#sss_num').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 6) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $('.phone_number').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    });
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #000 !important;
        background-color: #ccc !important;
        border-color: #ccc !important;
    }
</style>

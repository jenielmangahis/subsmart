<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 10px;
        border: 1px solid #32243d !important;
        margin-bottom: 20px;
        flex-flow: wrap;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */
        background-color: #32243d;
        color : #fff;
        text-align: center;
        font-size: 11px;
        max-height: 20px;
        max-width: 100%;
        margin-bottom: 3px;
    }
    .module_title{
        padding-top: 1px;
    }

    .form-control {
        font-size: 12px;
        height: 35px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
    .add_data{
        color : #55b94c;
    }
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
    .input_select{
        color: #363636;
        border: 2px solid #e0e0e0;
        box-shadow: none;
        display: inline-block !important;
        width: 100%;
        background-color: #fff;
        background-clip: padding-box;
        font-size: 11px !important;
    }
    .form-control  {
        font-size: 11px !important;
        height: 20px !important;
        line-height: 5%;
    }
    .form-line {
        padding-bottom: 1px;
    }
    .required_field{
        color : red;
    }
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
      padding-top: 40px !important;
    }
    a.btn-primary.btn-md {
        height: 38px;
        display: inline-block;
        border: 0px;
        padding-top: 7px;
        position: relative;
        top: 0px;
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
</style>

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
                          <h3 class="page-title mt-0">New Lead</h3>
                          <div class="pl-3 pr-3 mt-1 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add new lead</span>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end row -->
              <?php //echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
              <div class="row custom__border">
                  <div class="col-md-12">
                          <form method="post">
                               <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                                  <div class="col-md-12">
                                      <div class="row">
                                          <table cellpadding="0" cellspacing="0" width="500" style="border-collapse: collapse;">
                                              <tbody>
                                                  <tr>
                                                      <td align="" valign="top">
                                                          <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                              <div class="module_ac">
                                                                  <div class="row">
                                                                      <div class="col-md-12 module_header">
                                                                          <p class="module_title">General Information</p>
                                                                      </div>
                                                                      <div class="col-md-12">
                                                                          <div class="form-group" id="customer_type_group">
                                                                              <label for="">Lead Type <span class="required_field">*</span></label>
                                                                              <a href="<?php echo url('customer/index/tab3/1/mt13') ?>" class=""><span class="fa fa-plus"></span></a><br/>
                                                                              <select id="fk_lead_id" name="fk_lead_id"  class="input_select" required>
                                                                                  <?php foreach ($lead_types as $lt): ?>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->fk_lead_id == $lt->lead_id){ echo 'selected'; } } ?> value="<?= $lt->lead_id; ?>"><?= $lt->lead_name; ?></option>
                                                                                  <?php endforeach ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12">
                                                                          <div class="form-group" id="customer_type_group">
                                                                              <label for="">Sales Representative </label><br/>
                                                                              <select id="fk_sr_id" name="fk_sr_id"  class="input_select">
                                                                                  <option value="">Select</option>
                                                                                  <?php foreach ($users as $user): ?>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->fk_assign_id == $user->id){ echo 'selected'; } } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                                                  <?php endforeach ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12">
                                                                          <div class="form-group" id="customer_type_group">
                                                                              <label for=""> Assigned To <span class="required_field">*</span></label><br/>
                                                                              <select id="fk_assign_id" name="fk_assign_id"  class="input_select" required>
                                                                                  <option value="">Select</option>
                                                                                  <?php foreach ($users as $user): ?>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->fk_sr_id == $user->id){ echo 'selected'; } } ?> value="<?= $user->id; ?>" value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                                                  <?php endforeach ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  </div>
                                                          </table>


                                                          <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                              <div class=" module_ac">
                                                                  <div class="row">
                                                                      <div class="col-md-12 module_header">
                                                                          <p class="module_title">Contact Information</p>
                                                                      </div>
                                                                      <br><br>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">First Name <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(isset($leads_data)){ echo $leads_data->firstname; } ?>"  required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Middle Initial </label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" maxlength="1" name="middle_initial" id="middle_initial" value="<?php if(isset($leads_data)){ echo $leads_data->middle_initial; } ?>"/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Last Name <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(isset($leads_data)){ echo $leads_data->lastname; } ?>"  required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Name Suffix</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <select id="suffix" name="suffix"  class="input_select">
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
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Address <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="address" id="address" value="<?php if(isset($leads_data)){ echo $leads_data->address; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">ZIP <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="zip" id="zip" value="<?php if(isset($leads_data)){ echo $leads_data->zip; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">State <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($leads_data)){ echo $leads_data->state; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">City <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($leads_data)){ echo $leads_data->city; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">County</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="county" id="county" value="<?php if(isset($leads_data)){ echo $leads_data->county; } ?>" />
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Country</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <select id="country" name="country" class="input_select" required>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->country == 'USA'){ echo 'selected'; }} ?> value="USA">USA</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->country == 'CANADA'){ echo 'selected'; }} ?> value="CANADA">CANADA</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Home/Panel Phone</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control phone_number" name="phone_home" id="phone_home" maxlength="12" placeholder="xxx-xxx-xxxx" value="<?php if(isset($leads_data)){ echo $leads_data->phone_home; } ?>"/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Cell Phone <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_cell" id="phone_cell" value="<?php if(isset($leads_data)){ echo $leads_data->phone_cell; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Email Address <span class="required_field">*</span></label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="email" class="form-control" name="email_add" id="email_add" value="<?php if(isset($leads_data)){ echo $leads_data->email_add; } ?>" required/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Social Security Number</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" maxlength="11" placeholder="xxx-xx-xxxx" class="form-control" name="sss_num" id="sss_num" value="<?php if(isset($ssn) && count($ssn)>0){ echo $ssn[0]; } ?>"/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Date of Birth</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(isset($leads_data)){ echo $leads_data->date_of_birth; } ?>"/>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-12 form-line">
                                                                          <div class="row">
                                                                              <div class="col-md-4">
                                                                                  <label for="">Status</label>
                                                                              </div>
                                                                              <div class="col-md-8">
                                                                                  <select id="status" name="status"  class="input_select" >
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'New'){echo "selected";} } ?> value="New">New</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'Contacted'){echo "selected";} } ?> value="Contacted">Contacted</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'Follow Up'){echo "selected";} } ?> value="Follow Up">Follow Up</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'Assigned'){echo "selected";} } ?> value="Assigned">Assigned</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'Converted'){echo "selected";} } ?> value="Converted">Converted</option>
                                                                                      <option <?php if(isset($leads_data)){ if($leads_data->status == 'Closed'){echo "selected";} } ?> value="Closed">Closed</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </table>

                                                          <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                              <div class="module_ac">
                                                                  <div class="row">
                                                                      <div class="col-md-12 module_header">
                                                                          <p class="module_title">New Credit Report</p>
                                                                      </div>
                                                                      <div class="col-md-12">
                                                                          <div class="row">
                                                                              <div class="col-md-12">
                                                                                  <div class="form-group" id="customer_type_group">
                                                                                      <label for=""></label><br/>
                                                                                      <select id="credit_report" name="credit_report"  class="input_select" >
                                                                                          <option value="TrunsUnion">TransUnion</option>
                                                                                          <option value="Experian">Experian </option>
                                                                                          <option value="Equifax ">Equifax  </option>
                                                                                      </select>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-12"><br>
                                                                                  <div class="form-group" id="customer_type_group">
                                                                                      <label for=""></label>
                                                                                      <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-play"></span> Run Credit</button>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </table>

                                                          <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                              <div class="module_ac">
                                                                  <div class="row">
                                                                      <div class="col-md-12 module_header">
                                                                          <p class="module_title">Report History</p>
                                                                      </div>

                                                                      <div class="col-md-12">
                                                                          <div class="row">
                                                                              <div class="col-md-12">
                                                                                  <div class="form-group" id="customer_type_group">
                                                                                      <label for=""></label><br/>
                                                                                      <input value="No History" type="text" class="form-control" name="report_history" disabled id="report_history"/>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-12"><br>
                                                                                  <div class="form-group" id="customer_type_group">
                                                                                      <label for=""></label>
                                                                                      <button type="submit" name="convert_customer" class="btn btn-primary"><span class="fa fa-exchange"></span>  Convert to Customer </button>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </table>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      <br>
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
                              </form>
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

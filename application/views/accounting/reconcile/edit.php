<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Reconcile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Edit Reconcile</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                
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
                            <h4 class="mt-0 header-title mb-5">Edit Reconcile</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Edit the information from your statement</h5>
                                </div>
                                <div class="col-md-6 form-group">
                                     <label for="account_type">Account</label>
                                    <select name="account_type" id="account_type" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Edit the following, if necessary</h5>
                                </div>
                                 <div class="col-md-2 form-group">
                                    <label for="name">Beginning balance</label>
                                    <input type="text" disabled="disabled" class="form-control" name="name" id="name" required value="111,111.00" 
                                           placeholder="Enter Name"
                                           autofocus/>
                                    
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="name">Ending Balance</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name" value="20,000.00" 
                                           autofocus/>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="name">Ending Date</label>
                                    <div class="col-xs-10 date_picker">
                                        <input type="text" id="ending_date" class="form-control" name="ending_date" placeholder="Enter Ending Date" value="07.07.2020">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Enter the service charge or interest earned, if necessary</h5>
                                </div>
                                 <div class="col-md-3 form-group">
                                    <label for="name">Date</label>
                                    <div class="col-xs-10 date_picker">
                                        <input type="text" id="ending_date" class="form-control" name="ending_date" placeholder="Enter Date" value="07.07.2020">
                                  </div>
                                    
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Service Charge</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name" value="20.00" 
                                           autofocus/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Expense account</label>
                                    <select name="account_type" id="account_type" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                        <option value="" selected="selected">Bank Charges</option>
                                    </select>
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-md-12">
                                    <h5>Enter the service charge or interest earned, if necessary</h5>
                                </div>
                                 <div class="col-md-3 form-group">
                                    <label for="name">Date</label>
                                    <div class="col-xs-10 date_picker">
                                        <input type="text" id="ending_date" class="form-control" name="ending_date" placeholder="Enter Date" value="15.07.2020">
                                  </div>
                                    
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Service Charge</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name" value="10.00" 
                                           autofocus/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Expense account</label>
                                    <select name="account_type" id="account_type" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                        <option value="" selected="selected">Interest Earned</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="button" class="btn btn-flat btn-primary">Cancel</button>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
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
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
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

$('#account_type').on('change', function() {
  var account_id = this.value;
  if(account_id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/chart_of_accounts/fetch_acc_detail') ?>",
        method: "POST",
        data: {account_id:account_id},
        success:function(data)
        {
            $("#detail_type").html(data);
        }
    })
  }
});
   
function showOptions(s) {
    var option_text = document.getElementById(s[s.selectedIndex].id).innerHTML;
    $('#name').val(option_text);
}

$(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
    });
</script>
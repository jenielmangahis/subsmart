<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
.loader
{
    display: none !important;
}
</style>
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
            <?php echo form_open_multipart('accounting/reconcile/update', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">Edit Reconcile</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Edit the information from your statement</h5>
                                </div>
                                <input type="hidden" name="id" id="id" value="<?=$reconcile->id?>">
                                <div class="col-md-6 form-group">
                                     <label for="account_type">Account</label>
                                    <select name="chart_of_accounts_id" id="chart_of_accounts_id" class="form-control select2" required disabled="disabled">
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->chart_of_accounts_model->select() as $row): ?>
                                            <option value="<?php echo $row->id ?>" <?php if($row->id == $reconcile->chart_of_accounts_id) { echo "selected";} ?>><?php echo $row->name ?></option>
                                        <?php endforeach ?>
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
                                    <input type="text" class="form-control" name="ending_balance" id="ending_balance" required
                                           placeholder="Enter Name" value="<?=$reconcile->ending_balance?>" 
                                           autofocus/>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="name">Ending Date</label>
                                    <div class="col-xs-10 date_picker">
                                        <input type="text" id="ending_date" class="form-control" name="ending_date" placeholder="Enter Ending Date" value="<?=$reconcile->ending_date?>">
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
                                        <input type="text" id="first_date" class="form-control" name="first_date" placeholder="" value="<?=$reconcile->first_date?>">
                                  </div>
                                    
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Service Charge</label>
                                    <input type="text" class="form-control" name="service_charge" id="service_charge" required
                                           placeholder="Enter Service Charge"
                                           autofocus value="<?=$reconcile->service_charge?>" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Expense account</label>
                                    <select name="expense_account" id="expense_account" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                       <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option <?php if($row_sub->sub_acc_name == $reconcile->expense_account) { echo "selected";} ?> value="<?php echo $row_sub->sub_acc_name ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
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
                                        <input type="text" id="second_date" class="form-control" name="second_date" placeholder="" value="<?=$reconcile->second_date?>">
                                  </div>
                                    
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Interest earned</label>
                                    <input type="text" class="form-control" name="interest_earned" id="interest_earned" required
                                           placeholder="Enter Interest"
                                           autofocus value="<?=$reconcile->interest_earned?>" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Income account</label>
                                    <select name="income_account" id="income_account" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option <?php if($row_sub->sub_acc_name == $reconcile->income_account) { echo "selected";} ?> value="<?php echo $row_sub->sub_acc_name ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <a href="<?php echo url('/accounting/reconcile') ?>" class="btn btn-flat btn-primary">Cancel</a>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <button type="button" id="submit" class="btn btn-flat btn-primary">Save</button>
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

$('#submit').on('click', function() {
  var id = $('#id').val();
  var chart_of_accounts_id = $('#chart_of_accounts_id').val();
  var ending_balance = $('#ending_balance').val();
  var ending_date = $('#ending_date').val();
  var first_date = $('#first_date').val();
  var service_charge = $('#service_charge').val();
  var expense_account = $('#expense_account').val();
  var second_date = $('#second_date').val();
  var interest_earned = $('#interest_earned').val();
  var income_account = $('#income_account').val();
  if(chart_of_accounts_id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/update/') ?>"+id,
        method: "POST",
        data: {chart_of_accounts_id:chart_of_accounts_id,ending_balance:ending_balance,ending_date:ending_date,first_date:first_date,service_charge:service_charge,expense_account:expense_account,second_date:second_date,interest_earned:interest_earned,income_account:income_account},
        success:function(data)
        {
            sweetAlert(
                            'Updated!',
                            'Reconcile has been updated.',
                            'success'
                        );
            location.href = "<?php echo url('accounting/reconcile') ?>";
        }
    })
  }
});

$("#ending_date").datepicker({
    todayBtn:  1,
    autoclose: true,
    format: "dd.mm.yyyy",
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('#first_date').datepicker('setStartDate', minDate);
    $('#second_date').datepicker('setStartDate', minDate);
});
    
$("#first_date").datepicker({
    autoclose: true,
    format: "dd.mm.yyyy",
}).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#ending_date').datepicker('setEndDate', minDate);
    });
$("#second_date").datepicker({
    autoclose: true,
    format: "dd.mm.yyyy",
}).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#ending_date').datepicker('setEndDate', minDate);
    });
</script>
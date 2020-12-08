<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                        <h1 class="page-title">Chart of Accounts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Edit Chart of Accounts</li>
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
            <?php echo form_open_multipart('accounting/chart_of_accounts/update', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">Edit Chart of account</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Account</h3>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $chart_of_accounts->id ?>">
                                <div class="col-md-4 form-group">
                                     <label for="account_type">Account Type</label>
                                    <select name="account_type" id="account_type" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_model->get() as $row): ?>
                                            <option value="<?php echo $row->id ?>" <?php if($row->id == $chart_of_accounts->account_id) { echo "selected";} ?>><?php echo $row->account_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name" value="<?php echo $chart_of_accounts->name ?>" 
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="detail_type">Detail Type</label>
                                    <select name="detail_type" id="detail_type" class="form-control select2" onchange="showOptions(this)" required>
                                        <!-- <option selected value="<?php echo $chart_of_accounts->acc_detail_id?>"><?php echo $this->account_detail_model->getName($chart_of_accounts->acc_detail_id) ?></option> -->
                                        <?php foreach ($this->account_detail_model->get() as $row_detail): ?>
                                            <option value="<?php echo $row_detail->acc_detail_id ?>" <?php if($row_detail->acc_detail_id == $chart_of_accounts->acc_detail_id) { echo "selected";} ?> ><?php echo $row_detail->acc_detail_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"
                                              placeholder="Enter Description" rows="3"><?php echo $chart_of_accounts->description ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                          Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                          <p>Typically only property managers use this type of account.</p>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check()"
                                     <?php
                                     if($chart_of_accounts->sub_acc_id != '')
                                     {
                                        echo "checked";
                                     }
                                     ?>   
                                    />
                                    <label for="formClient-Status">Is sub account</label>
                                    <select name="sub_account_type" id="sub_account_type" class="form-control select2" required 
                                    <?php
                                     if($chart_of_accounts->sub_acc_id == '')
                                     {
                                        echo "disabled";
                                     }
                                     ?>   
                                    >
                                          <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option value="<?php echo $row_sub->sub_acc_id ?>" <?php if($row_sub->sub_acc_id == $chart_of_accounts->sub_acc_id) { echo "selected";} ?> >
                                                <?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label for="choose_time">When do you want to start tracking your finances from this account in Nsmartrac?</label>
                                    <span></span>
                                    <select name="choose_time" id="choose_time" class="form-control select2" required onchange="showdiv()">
                                            <option selected="selected" disabled="disabled">Choose one</option>
                                            <option value="Beginning of this year" <?php if($chart_of_accounts->time == "Beginning of this year") { echo "selected";} ?>>Beginning of this year</option>
                                            <option value="Beginning of this month" <?php if($chart_of_accounts->time == "Beginning of this month") { echo "selected";} ?>>Beginning of this month</option>
                                            <option value="Today" <?php if($chart_of_accounts->time == "Today") { echo "selected";} ?>>Today</option>
                                            <option value="Other" <?php if($chart_of_accounts->time == "Other") { echo "selected";} ?> onclick="hidediv()">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-div" <?php if($chart_of_accounts->time_date != "") { echo "style='display: block;'";} else { echo "style='display:none;'";} ?>>
                                     <label for="balance">Balance</label>
                                    <input type="text" class="form-control" name="balance" id="balance" required
                                           placeholder="Enter Balance" value="<?php echo $chart_of_accounts->balance ?>"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-date" <?php if($chart_of_accounts->time == "Other") { echo "style='display: block;'";} else { echo "style='display:none;'";} ?> >
                                     <label for="time_date">Date</label>
                                     <div class="col-xs-10 date_picker">
                                        <input type="text" class="form-control" name="time_date" id="time_date"
                                           placeholder="Enter Date" onchange="showdiv2()" autofocus 
                                           value="<?php if($chart_of_accounts->time_date != ''){echo $chart_of_accounts->time_date;}else{echo "";}?>"/>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                                <div class="col-md-4 form-group">
                                    <a href="<?php echo url('/accounting/chart_of_accounts') ?>" class="btn btn-flat btn-primary">Cancel</a>
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

function check() {
  var x = document.getElementById("check_sub").checked;
  if(x == true)
  {
    $('#sub_account_type').removeAttr('disabled','disabled');
  }
  else
  {
    $('#sub_account_type').attr('disabled','disabled');
  }
}

function showdiv() {
    $('.hide-div').css('display','block');
    if($('#choose_time').find(":selected").text()=='Other')
    {
        $('.hide-div').css('display','none');
        $('.hide-date').css('display','block');
    }
    else
    {
        $('.hide-date').css('display','none');
    }
}
function showdiv2() {
    if($('.day').hasClass('active'))
    {
        $('.hide-div').css('display','block');
    }
    else
    {
        $('.hide-div').css('display','none');
    }
}


$(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
    });
</script>
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
                        <h1 class="page-title">Chart of Accounts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add Chart of Accounts</li>
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
                            <h4 class="mt-0 header-title mb-5">New Chart of account</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Account</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                     <label for="account_type">Account Type</label>
                                    <select name="account_type" id="account_type" class="form-control select2" required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_model->get() as $row): ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->account_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="detail_type">Detail Type</label>
                                    <select name="detail_type" id="detail_type" class="form-control select2" onchange="showOptions(this)" required>
                                        <?php foreach ($this->account_detail_model->get() as $row_detail): ?>
                                            <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"
                                              placeholder="Enter Description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                          Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                          <p>Typically only property managers use this type of account.</p>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="sub_account" class="js-switch" />
                                    <label for="formClient-Status">Is sub account</label>
                                    <select name="sub_account_type" id="sub_account_type" class="form-control select2" required>
                                        <?php foreach ($this->roles_model->get() as $row): if ($row->id <= logged('role')) continue; ?>
                                            <?php $sel = !empty(get('role')) && get('role') == $row->id ? 'selected' : '' ?>
                                            <option selected="selected">Cash on Hand</option>
                                            <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label for="choose_time">When do you want to start tracking your finances from this account in Nsmartrac?</label>
                                    <span></span>
                                    <select name="choose_time" id="choose_time" class="form-control select2" required>
                                        <?php foreach ($this->roles_model->get() as $row): if ($row->id <= logged('role')) continue; ?>
                                            <?php $sel = !empty(get('role')) && get('role') == $row->id ? 'selected' : '' ?>
                                            <option selected="selected">Choose one</option>
                                            <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                                        <?php endforeach ?>
                                    </select>
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

</script>
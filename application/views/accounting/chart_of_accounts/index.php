<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    .p-padding{
        padding-left: 10%;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Chart of Accounts List</h3>
                                </div>
                                <div class="alert alert-warning mt-4 mb-4" role="alert">
                                    <span style="color:black;">When you create your company file, our accounting software automatically customizes your chart of accounts based on your industry. You can add more accounts any time you need to track other types of transactions. It is very simple to add more accounts to your chart of accounts. Structuring and setting up the chart of accounts will eliminate the guesswork which in-turn can help run your business smoothly.</span>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab-active text-decoration-none">Chart of Accounts</a>
                                    <a href="<?php echo url('/accounting/reconcile')?>" class="banking-tab">Reconcile</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <a href="#" class="btn btn-secondary mr-2"
                                                aria-expanded="false" style="padding: 10px 12px !important">
                                                    Run Report
                                            </a>
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddAccount" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Add New
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php echo form_open_multipart('accounting/chart_of_accounts', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                                <div class="row my-3">
									<div class="col-md-10"></div>
									 <div class="col-md-2">
                                        <div class="dropdown">
											<a href="#" class="editbtn"><i class="fa fa-edit"></i></a>
											<a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
										    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    <i class="fa fa-cog"></i>
										    </a>
										    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											    Columns<br/>
											    <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type"> Type</p>
											    <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_detailtype()" name="chk_detail_type" id="chk_detail_type"> Detail Type</p>
											    <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_nbalance()" name="chk_nsmart_balance" id="chk_nsmart_balance"> Nsmart Balance</p>
											    <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_balance()" name="chk_balance" id="chk_balance"> Balance</p>
											    <br/>
											    <p class="p-padding"><input type="checkbox" name="chk_other" id="chk_other"> Other</p>
										    </div>
										</div>
                                    </div>
                                </div>
                                <table id="charts_of_account_table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th></th>
                                            <th>NAME</th>
                                            <th class='type'>TYPE</th>
                                            <th class='detailtype'>DETAIL TYPE</th>
                                            <th class='nbalance'>NSMARTRAC BALANCE</th>
                                            <th class='balance'>BANK BALANCE</th>
                                            <th>Action</th>
                                        </tr>
									</thead>
									<tbody id="customer_data">
									</tbody>
								</table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!-- add account modal -->
            <div class="modal fade" id="modalAddAccount" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <?php echo form_open_multipart('accounting/chart_of_accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addLocationLabel">Accounts</h5>
                                <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                            </div>
                            <div class="modal-body" style="max-height: 650px;">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card p-0 m-0">
                                            <div class="card-body" style="max-height: 650px;">
                                                <div class="row">
                                                    <div class="col-md-4 form-group">
                                                        <label for="account_type">Account Type</label>
                                                        <select name="account_type" id="account_type" class="form-control select2" required>
                                                            <?php foreach ($this->account_model->getAccounts() as $row): ?>
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
                                                            <?php foreach ($this->account_detail_model->getDetailTypesById(1) as $row_detail): ?>
                                                                <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="description">Description</label>
                                                        <textarea type="text" class="form-control" name="description" id="description"
                                                                placeholder="Enter Description" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 form-group">
                                                        Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                                        <p>Typically only property managers use this type of account.</p>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check(this)"/>
                                                        <label for="formClient-Status">Is sub account</label>
                                                        <select name="sub_account_type" id="sub_account_type" class="form-control select2" required disabled="disabled">
                                                            <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                                                <option value="<?php echo $row_sub->sub_acc_id ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <br>
                                                        <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                                                        <span></span>
                                                        <select name="choose_time" id="choose_time" class="form-control select2" required onchange="showdiv(this)">
                                                            <option selected="selected" disabled="disabled">Choose one</option>
                                                            <option value="Beginning of this year">Beginning of this year</option>
                                                            <option value="Beginning of this month">Beginning of this month</option>
                                                            <option value="Today">Today</option>
                                                            <option value="Other" onclick="hidediv()">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 form-group hide-div hide">
                                                        <label for="balance">Balance</label>
                                                        <input type="text" class="form-control" name="balance" id="balance" required
                                                            placeholder="Enter Balance"
                                                            autofocus/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 form-group hide-date hide">
                                                        <label for="time_date">Date</label>
                                                        <div class="col-xs-10 date_picker">
                                                            <input type="text" class="form-control" name="time_date" id="time_date"
                                                            placeholder="Enter Date" autofocus/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>

                            </div>
                            <!-- end modal-body -->
                            <div class="modal-footer">
                                <div class="row w-100">
                                    <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- end add account modal -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-edit-account"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function() {
        $('#charts_of_account_table').DataTable({
            autoWidth: false,
            searching: false,
            processing: true,
            serverSide: true,
            ordering: false,
            info: false,
            ajax: {
                url: 'load-chart-of-accounts/',
                dataType: 'json',
                contentType: 'application/json',
                type: 'POST',
                data: function(d) {
                    return JSON.stringify(d);
                },
                pagingType: 'full_numbers'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    fnCreatedCell: function(td, cellData, rowData, row, col) {
                        $(td).html(`<input type="checkbox">`);
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'detail_type',
                    name: 'detail_type'
                },
                {
                    data: 'nsmartrac_balance',
                    name: 'nsmartrac_balance'
                },
                {
                    data: 'bank_balance',
                    name: 'bank_balance'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    } );

    function col_type()
    {
    	if($('#chk_type').attr('checked'))
    	{
    		$('#chk_type').removeAttr('checked');
    		$('.type').css('display','none');

    	}
    	else
    	{
    		$('#chk_type').attr('checked',"checked");
    		$('.type').css('display','');
    	}
    }
    function col_detailtype()
    {
    	if($('#chk_detail_type').attr('checked'))
    	{
    		$('#chk_detail_type').removeAttr('checked');
    		$('.detailtype').css('display','none');

    	}
    	else
    	{
    		$('#chk_detail_type').attr('checked',"checked");
    		$('.detailtype').css('display','');
    	}
    }
    function col_nbalance()
    {
    	if($('#chk_nsmart_balance').attr('checked'))
    	{
    		$('#chk_nsmart_balance').removeAttr('checked');
    		$('.nbalance').css('display','none');

    	}
    	else
    	{
    		$('#chk_nsmart_balance').attr('checked',"checked");
    		$('.nbalance').css('display','');
    	}
    }
    function col_balance()
    {
    	if($('#chk_balance').attr('checked'))
    	{
    		$('#chk_balance').removeAttr('checked');
    		$('.balance').css('display','none');

    	}
    	else
    	{
    		$('#chk_balance').attr('checked',"checked");
    		$('.balance').css('display','');
    	}
    }


    


      $(document).ready(function () {
      	$("#save").hide();
          $('.editbtn').click(function () {
              if ($("#save").html() == '') {
                  	$(".edit_field").each(function() {
                  		$("#save").show();
				        $(this).prop('contenteditable', true);
				    });
                      
              } else {
              		  $("#save").hide();
                      $(".edit_field").prop('contenteditable', false)
              }
    
              $("#save").html($("#save").html() == '' ? 'Save' : '')
    
          });
    
      });

      $("#save").click(function(){
      	$("#save").hide();
      	$(".edit_field").each(function() {
	      	var id = $(this).data('id');
	      	var acc_name = $(this).html();
	      	    $.ajax({
			     url:'<?php echo base_url(); ?>accounting/chart_of_accounts/update_name',
			     method: 'post',
			     data: {id: id,name:acc_name},
			     dataType: 'json',
			   });
	    });
      })

      function make_inactive(id)
      {
      	$.ajax({
			     url:'<?php echo base_url(); ?>accounting/chart_of_accounts/inactive',
			     method: 'post',
			     data: {id: id},
			     dataType: 'json',
			   });
      }


$(document).ready(function(){

    //  load_data();

    //  function load_data()
    //  {
    //   $.ajax({
    //    url:"<?php echo base_url(); ?>accounting/chart_of_accounts/refresh",
    //    method:"POST",
    //    success:function(data){
    //     $('#customer_data').html(data);
    //    }
    //   })
    //  }

     $('#import_form').on('submit', function(event){
      event.preventDefault();
      $.ajax({
       url:"<?php echo base_url(); ?>accounting/chart_of_accounts/import",
       method:"POST",
       data:new FormData(this),
       contentType:false,
       cache:false,
       processData:false,
       success:function(data){
        load_data();
        console.log(data);
       }
      })
     });

    });


    $(document).on('click', '#editAccount', function(e){
        var target = e.currentTarget.dataset;
        // console.log(target);
        // return;
        $.ajax({
            url:"/accounting/chart_of_accounts/edit/" + target.id,
            method: "GET",
            success:function(html)
            {
                $('.append-edit-account').html(html);
                $('.date_picker input#edit_time_date').datepicker({
                    format: "dd.mm.yyyy",
                    todayBtn: "linked",
                    language: "de"
                });
                $('#modalEditAccount').modal('show');
            }
        })
    });
</script>

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
            showOptions(document.getElementById('detail_type'));
        }
    })
  }
});
   
function showOptions(s) {
    var option_text = s[s.selectedIndex].innerHTML;

    if($(s).attr('id').includes('edit')) {
        $('#edit_name').val(option_text);
    } else {
        $('#name').val(option_text);
    }
}

function check(el) {
  var x = document.getElementById($(el).attr('id')).checked;
  if(x == true)
  {
    $(el).parent().children('select[name="sub_account_type"]').removeAttr('disabled','disabled');
  }
  else
  {
    $(el).parent().children('select[name="sub_account_type"]').attr('disabled','disabled');
  }
}

function showdiv(el) {
    var value = $(el).val();
    var elementId = $(el).attr('id');
    
    if(value === 'Other') {
        if(elementId.includes('edit')) {
            $('#edit_balance').parent().addClass('hide');
            $('#edit_time_date').parent().parent().parent().removeClass('hide');
        } else {
            $('#balance').parent().addClass('hide');
            $('#time_date').parent().parent().parent().removeClass('hide');
        }
    } else {
        if(elementId.includes('edit')) {
            $('#edit_time_date').parent().parent().parent().addClass('hide');
            $('#edit_balance').parent().removeClass('hide');
        } else {
            $('#time_date').parent().parent().parent().addClass('hide');
            $('#balance').parent().removeClass('hide');
        }
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none;
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
        <div class="container-fluid">
            <div class="page-title-box mx-4">
				<div class="row pb-2">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab-active text-decoration-none">Chart of Accounts</a>
                        <a href="#" class="banking-tab">Reconcile</a>
                    </div>
                </div>
                <div class="row align-items-center pt-3">
					<div class="col-lg-6 px-0">
						<h2 class="mb-0">Chart of Accounts</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Chart of Accounts</li>
                        </ol>
					</div>
                    <div class="col-sm-6 px-0">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown show">
                            
                            <a href="#" class="btn btn-success rounded"
                                   aria-expanded="false">
                                    Run Report
                            </a>
                             <a href="<?php echo url('/accounting/chart_of_accounts/create') ?>" class="btn btn-success rounded"
                                   aria-expanded="false">
                                    Add New
                              </a>
                              <a class="btn btn-primary hide-toggle dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                              </a>
                              <form method="post" id="import_form" enctype="multipart/form-data">
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <input type="file" name="file" id="file" required accept=".xls, .xlsx" />
                                <input type="submit" name="import" value="Import" class="dropdown-item" />
                              </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
            	<div class="col-md-12">
            		<?php if($this->session->flashdata('success')){ ?>
            		<div class="alert alert-success alert-dismissible">
            		   <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } if($this->session->flashdata('error')){ ?>
					<div class="alert alert-danger alert-dismissible">
					   <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
            	</div>
            </div>
				<?php echo form_open_multipart('accounting/chart_of_accounts', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
				<div class="row pt-2">
					<div class="col-xl-12 px-0">
						<div class="card p-0">
							<div class="card-body px-4 py-3">
								<div class="row mb-3">
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
								 <div class="row" style="margin-bottom: 20px ">
								 	<div class="col-md-10"></div>
									 <div class="col-md-2">
									 	<button style="display: none;" type="button" id="save"  name="save" class="btn btn-primary"></button>
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
									<?php
									  $i=1;
									  foreach($this->chart_of_accounts_model->select() as $row)
									  {
									  echo "<tr>";
									  echo "<td><input type='checkbox'></td>";
									  echo "<td class='edit_field' data-id='".$row->id."'>".$row->name."</td>";
									  echo "<td class='type'>".$this->account_model->getName($row->account_id)."</td>";
									  echo "<td class='detailtype'>".$this->account_detail_model->getName($row->acc_detail_id)."</td>";
									  echo "<td class='nbalance'>".$row->balance."</td>";
									  echo "<td class='balance'></td>";
									  echo "<td>
										<div class='dropdown show'>
										  <a class='dropdown-toggle' href='#' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
										   View Register
										  </a>

										  <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
											<a class='dropdown-item' href='#'>Connect Bank</a>
											<a class='dropdown-item' href=".url('/accounting/chart_of_accounts/edit/'.$row->id).">Edit</a>
											<a class='dropdown-item' href='#' onClick='make_inactive(".$row->id.")'>Make Inactive (Reduce usage)</a>
											<a class='dropdown-item' href='#'>Run Report</a>
										  </div> 
										</div>
										</td>";
									  echo "</tr>";
									  $i++;
									  }
									   ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- end card -->
					</div>
				</div>
         </div>
            <!-- end row -->
			<?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
		    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>
    <!-- page wrapper end -->
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function() {
        $('#charts_of_account_table').DataTable();
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
    		$('.type').css('display','block');
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
    		$('.detailtype').css('display','block');
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
    		$('.nbalance').css('display','block');
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
    		$('.balance').css('display','block');
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

     load_data();

     function load_data()
     {
      $.ajax({
       url:"<?php echo base_url(); ?>accounting/chart_of_accounts/refresh",
       method:"POST",
       success:function(data){
        $('#customer_data').html(data);
       }
      })
     }

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
</script>
var siteurl = document.getElementById('siteurl').value;
$(document).ready(function () {
	    // Delete Check
    $(document).on('click','#makeInactive',function () {
        $('.loader').show();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: siteurl + 'accounting/invalidVendor',
                    method:"POST",
                    data:{id:id},
                    success:function () {
                        $('.loader').hide();
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Vendor has been inactive.",
                                icon: 'success'
                            });
						getAllVendors();
                    }
                });
            }
		});
    });
	$('#btn-new-vendor-modal').click(function(){
		$("#addVendorForm input").val("");
		$("#addVendorForm textarea").val("");
		$("#addVendorForm").removeClass("was-validated");
         $("#new-vendor-modal").modal("show");
	});
	
	$('#transaction_table').DataTable({
         "paging": false,
         "filter":false
    });
	$('#payBillsTable').DataTable({
         "paging": false,
         "filter":false
    });
	  window.addEventListener('load', function() {
		var addVendorForm = document.getElementsByClassName('addVendorForm-validation');
		
		var addVendorForm_validation = Array.prototype.filter.call(addVendorForm, function(form) {
		  form.addEventListener('submit', function(event) {
			  $('.loader').show();
			  event.preventDefault();
			  event.stopPropagation();
				if (form.checkValidity() === true) {
					
					var passdata = new FormData(this);
						passdata.append('title', $("input[name='title']").val());
						passdata.append('f_name', $("input[name='f_name']").val());
						passdata.append('m_name', $("input[name='m_name']").val());
						passdata.append('l_name', $("input[name='l_name']").val());
						passdata.append('suffix', $("input[name='suffix']").val());
						passdata.append('email', $("input[name='email']").val());
						passdata.append('company', $("input[name='company']").val());
						passdata.append('display_name', $("input[name='display_name']").val());
						passdata.append('to_display', $("input[name='to_display']").val());
						passdata.append('street', $("#street").val());
						passdata.append('city', $("input[name='city']").val());
						passdata.append('state', $("input[name='state']").val());
						passdata.append('zip', $("input[name='zip']").val());
						passdata.append('country', $("input[name='country']").val());
						passdata.append('phone', $("input[name='phone']").val());
						passdata.append('mobile', $("input[name='mobile']").val());
						passdata.append('fax', $("input[name='fax']").val());
						passdata.append('website', $("input[name='website']").val());
						passdata.append('billing_rate', $("input[name='billing_rate']").val());
						passdata.append('terms', $("input[name='terms']").val());
						passdata.append('opening_balance', $("input[name='opening_balance']").val());
						passdata.append('opening_balance_as_of_date', $("input[name='opening_balance_as_of_date']").val());
						passdata.append('account_number', $("input[name='account_number']").val());
						passdata.append('business_number', $("input[name='business_number']").val());
						passdata.append('default_expense_amount', $("input[name='default_expense_amount']").val());
						passdata.append('notes', $("#notes").val());
						
						$.ajax({
							type: "POST",
							url: "addVendor",
							data: passdata,
							processData:false,
							contentType:false,
							cache:false,
							async:true,
							success:
								function(data) {
									//console.log(data);
									if(data.length > 0){
										$("#new-vendor-modal").modal("hide");
										Swal.fire(
										{
											showConfirmButton: false,
											timer: 2000,
											title: 'Success',
											text: "Vendor has been created.",
											icon: 'success'
										});
										getAllVendors();
									}else{
										//console.log(0); 	
									}
								},
							error:
							function(data){
								//console.log(data);	
							}
						});
				}
			form.classList.add('was-validated');
		  }, false);
		});
	  }, false);
	getAllVendors();
});
	window.addEventListener('load', function() {
		var editVendorForm = document.getElementsByClassName('editVendorForm-validation');
		
		var editVendorForm_validation = Array.prototype.filter.call(editVendorForm, function(form) {
		  form.addEventListener('submit', function(event) {
			  $('.loader').show();
			  event.preventDefault();
			  event.stopPropagation();
				if (form.checkValidity() === true) {
					
					var passdata = new FormData(this);
						passdata.append('title', $("input[name='title']").val());
						passdata.append('f_name', $("input[name='f_name']").val());
						passdata.append('m_name', $("input[name='m_name']").val());
						passdata.append('l_name', $("input[name='l_name']").val());
						passdata.append('suffix', $("input[name='suffix']").val());
						passdata.append('email', $("input[name='email']").val());
						passdata.append('company', $("input[name='company']").val());
						passdata.append('display_name', $("input[name='display_name']").val());
						passdata.append('to_display', $("input[name='to_display']").val());
						passdata.append('street', $("#street").val());
						passdata.append('city', $("input[name='city']").val());
						passdata.append('state', $("input[name='state']").val());
						passdata.append('zip', $("input[name='zip']").val());
						passdata.append('country', $("input[name='country']").val());
						passdata.append('phone', $("input[name='phone']").val());
						passdata.append('mobile', $("input[name='mobile']").val());
						passdata.append('fax', $("input[name='fax']").val());
						passdata.append('website', $("input[name='website']").val());
						passdata.append('billing_rate', $("input[name='billing_rate']").val());
						passdata.append('terms', $("input[name='terms']").val());
						passdata.append('opening_balance', $("input[name='opening_balance']").val());
						passdata.append('opening_balance_as_of_date', $("input[name='opening_balance_as_of_date']").val());
						passdata.append('account_number', $("input[name='account_number']").val());
						passdata.append('business_number', $("input[name='business_number']").val());
						passdata.append('default_expense_amount', $("input[name='default_expense_amount']").val());
						passdata.append('notes', $("#notes").val());
						
						$.ajax({
							type: "POST",
							url: "editVendor",
							data: passdata,
							processData:false,
							contentType:false,
							cache:false,
							async:true,
							success:
								function(data) {
									//console.log(data);
										$("#edit-vendor-modal").modal("hide");
										Swal.fire(
										{
											showConfirmButton: false,
											timer: 2000,
											title: 'Success',
											text: "Vendor has been updated.",
											icon: 'success'
										});
								},
							error:
							function(data){
								//console.log(data);	
							}
						});
				}
			form.classList.add('was-validated');
		  }, false);
		});
	  }, false);
});
function getAllVendors(){
	var htmlData;
	var vendorDatatable = $('#vendors_table').DataTable();
	vendorDatatable.destroy();
	$('.loader').show();
	
	if($("#vendors_table").length > 0){	
	   $.ajax({
			type: "GET",
			url: siteurl + "accounting/allVendors",
			dataType: "json",
			success:
				function(data) {
					
					htmlData = "";
					if(data.length > 0){
						$("#vendors_table tbody").empty();
						for(var x=0; x < data.length; x++){
							//console.log(data[x].status);
							if(data[x].status == 1){
								htmlData = "";
								htmlData += '<tr>';
									htmlData += '<td><input type="checkbox"></td>';
									htmlData += '<td><a href="vendor-details/'+data[x].vendor_id+'">'+data[x].company+'</td>';
									htmlData += '<td>'+data[x].phone+'</td>';
									htmlData += '<td>'+data[x].email+'</td>';
									htmlData += '<td>'+data[x].opening_balance+'</td>';
									htmlData += '<td>';
										htmlData += '<a href="#" data-toggle="modal" id="addBill" data-target="#bill-modal" id="editCheck" data-id="'+data[x].id+'" style="margin-right: 10px;color: #0077c5;font-weight: 600;">Create bill</a>';
										htmlData += '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
											htmlData += '<span class="fa fa-caret-down" data-toggle="dropdown"></span>';
											htmlData += '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
												htmlData += '<li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#expense-modal" id="addExpense">Create Expense</a></li>';
												htmlData += '<li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit-expensesCheck" id="addCheck">Write Check</a></li>';
												htmlData += '<li><a class="dropdown-item" href="#" data-id="'+data[x].id+'" id="makeInactive">Make inactive</a></li>';
											htmlData += '</ul>';
										htmlData += '</div>';
									htmlData += '</td>';
								htmlData += '</tr>';
								$("#vendors_table tbody").append(htmlData);
							}
						}
						vendorDatatable = $('#vendors_table').DataTable({
							"paging": false,
						});
						
					}
				},
			error:
			function(data){
				//console.log("false");		
			}
		});		
	}
	$('.loader').hide();
}






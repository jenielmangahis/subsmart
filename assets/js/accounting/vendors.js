var siteurl = document.getElementById('siteurl').value;
$(document).ready(function () {

	$('#btn-new-vendor-modal').click(function(){
		$("#addVendorForm input").val("");
		$("#addVendorForm textarea").val("");
		$("#addVendorForm").removeClass("was-validated");
         $("#new-vendor-modal").modal("show");
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
							htmlData = "";
							htmlData += '<tr>';
								htmlData += '<td><input type="checkbox"></td>';
								htmlData += '<td><a href="vendor-details/'+data[x].vendor_id+'">'+data[x].company+'</td>';
								htmlData += '<td>'+data[x].phone+'</td>';
								htmlData += '<td>'+data[x].email+'</td>';
								htmlData += '<td>'+data[x].opening_balance+'</td>';
								htmlData += '<td>';
									htmlData += '<div class="dropdown dropdown-toggle">';
										htmlData += '<button class="btn btn-default border-0 py-2 pl-2 pr-0 bg-transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
											htmlData += 'Settings &ensp;';
										htmlData += '</button>';
										htmlData += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
											htmlData += '<a class="dropdown-item" href="#">Create bill</a>';
											htmlData += '<a class="dropdown-item" href="#">Create Expense</a>';
											htmlData += '<a class="dropdown-item" href="#">Write Check</a>';
											htmlData += '<a class="dropdown-item" href="#">Make inactive</a>';
										htmlData += '</div>';
									htmlData += '</div>';
								htmlData += '</td>';
							htmlData += '</tr>';
							$("#vendors_table tbody").append(htmlData);
						}
						vendorDatatable = $('#vendors_table').DataTable({
							"paging": false,
						});
						$('.loader').hide();
					}
				},
			error:
			function(data){
				//console.log("false");		
			}
		});		
	}
}






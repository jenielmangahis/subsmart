<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/reports/reports_modals'); ?>

<style>
table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length, .dataTables_info, .dt-buttons{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
/*Customize Modal*/
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
        border-radius: 50px !important;
	}
        
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

	.modal-content {
		/*border-radius: 0;*/
		/*border: none;*/
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
	}
    .groupby {
        display: block;
        padding-left: 30px;
        transition: height 1s ease-in;
    }
    #rcRightArrow{
        display: none;
    }
    #rcDownArrow{
        display: inline;
        color: #6a4a86;
        font-weight: bold;
    }
    .rwcl{
        padding-top: 20px;
    }
    .rwcl h6{
        padding-top: 10px;
    }
    .change-col {
        color: blue;
        cursor: pointer;
    }
    .change-col:hover{
        text-decoration: underline !important;
    }
    .filter {
        display: none;
        padding-left: 30px;
        transition: height 1s ease-in;
    }
    #fDownArrow{
        display: none;
    }
    .f{
        padding-top: 20px;
    }
    .hf {
        display: none;
        padding-left: 30px;
        transition: height 1s ease-in;
    } 
    #hfDownArrow{
        display: none;
    }
    .hf2{
        padding-top: 20px;
    }
    .changeCol{
        display: none;
    }
    .czLabel {
        cursor: pointer;
    }
    .czLabel i {
        color: black !important;
        font-size: 13px;
    }
    
    

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes, #checkboxes1 {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label, #checkboxes1 label {
  display: block;
}

#checkboxes label:hover, #checkboxes1 label:hover {
  background-color: #1e90ff;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-12">
                    <span class="float-end">
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                            <span>Filter <i class='bx bx-fw bx-chevron-down'></i></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                            <p class="m-0">Rows/columns</p>
                            <div class="row grid-mb">
                                <div class="col-12">
                                    <label for="filter-group-by">Group by</label>
                                    <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                        <option value="none" selected>None</option>
                                        <option value="shipping-city">Shipping City</option>
                                        <option value="shipping-state">Shipping State</option>
                                        <option value="shipping-zip">Shipping ZIP</option>
                                        <option value="city">Billing City</option>
                                        <option value="state">Billing State</option>
                                        <option value="zip">Billing ZIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="nsm-button primary">
                                    Run Report
                                    </button>
                                </div>
                            </div>
                        </ul>
                        <a type="button" class="nsm-button demo" data-bs-toggle="modal" data-bs-target="#customizeModal">
                        <i class='bx bx-fw bx-customize'></i> Customize
                        </a>
                        <button type="button" class="nsm-button primary">
                        <i class='bx bx-fw bx-save'></i> Save customization
                        </button>
                    </span>
                </div>
            </div>            
            <div class="row">
                <div class="col-lg-12">
                    <div class="nsm-card primary">
                        <div class="nsm-card-header">
                            <div class="col-lg-12">
                                <span class="float-start">
                                   <button type="button" class="nsm-button" data-bs-toggle="dropdown"><span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i></button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" selected>Default</option>
                                                    <option value="billing-city">Billing City</option>
                                                    <option value="billing-country">Billing Country</option>
                                                    <option value="billing-state">Billing State</option>
                                                    <option value="billing-street">Billing Street</option>
                                                    <option value="billing-zip">Billing ZIP</option>
                                                    <option value="cc-expires">CC Expires</option>
                                                    <option value="company-name">Company Name</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="credit-card-num">Credit Card #</option>
                                                    <option value="customer-type">Customer Type</option>
                                                    <option value="delivery-method">Delivery Method</option>
                                                    <option value="email">Email</option>
                                                    <option value="first-name">First Name</option>
                                                    <option value="full-name">Full Name</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="last-name">Last Name</option>
                                                    <option value="note">Note</option>
                                                    <option value="other">Other</option>
                                                    <option value="payment-method">Payment Method</option>
                                                    <option value="phone">Phone</option>
                                                    <option value="resale-num">Resale #</option>
                                                    <option value="shipping-city">Shipping City</option>
                                                    <option value="shipping-country">Shipping Country</option>
                                                    <option value="shipping-state">Shipping State</option>
                                                    <option value="shipping-street">Shipping Street</option>
                                                    <option value="shipping-zip">Shipping ZIP</option>
                                                    <option value="tax-rate">Tax Rate</option>
                                                    <option value="taxable">Taxable</option>
                                                    <option value="terms">Terms</option>
                                                    <option value="website">Website</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button data-bs-toggle="modal" data-bs-target="#ADD_NOTES_MODAL" class="nsm-button">Add Notes</button>
                                </span>
                                <span class="float-end">
                                        <button data-bs-toggle="modal" data-bs-target="#EMAIL_REPORT_MODAL" class="nsm-button border-0"><i class="bx bx-fw bx-envelope"></i></button>
                                        <button data-bs-toggle="modal" data-bs-target="#PRINT_SAVE_MODAL" class="nsm-button border-0"><i class="bx bx-fw bx-printer"></i></button>
                                        <button class="nsm-button border-0" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_EXCEL" onclick="$('.buttons-excel').click();">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_PDF" onclick="$('.buttons-pdf').click();">Export to PDF</a></li>
                                        </ul>
                                        <button class="nsm-button border-0 primary"><i class="bx bx-fw bx-cog"></i></button>
                                        <!-- Example single danger button -->
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mt-4 mb-2">
                                <div class="col-lg-12">
                                    <center><h3><?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?></h3></center>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <center><h5><strong>Customer Contact List</strong></h5></center>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <table id="CUSTOMER_CONTACT_LIST" class="nsm-table w-100 display" data-tableName="Test Table 1">
                                        <thead>
                                            <tr>
                                                <td>Customer</td>
                                                <td>Phone Number</td>
                                                <td>Email</td>
                                                <td>Billing Address</td>
                                                <td>Shipping Address</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <span id="NOTES_CONTENT" class="text-muted">[NOTES_HERE]</span>
                                </div>
                            </div>
                            <center class="mt-4 mb-4"><?php echo date("l, F j, Y h:i A eP") ?></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<!-- START: MODALS -->
<!-- START: ADD NOTES MODAL -->
<div class="modal" id="ADD_NOTES_MODAL" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Notes</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="ADD_NOTES_FORM" method="POST">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                    <textarea id="NOTES" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-end">
                                <button type="button" id="NOTE_CLOSE_MODAL" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: ADD NOTES MODAL -->

<!-- START: PRINT/SAVE MODAL -->
<div class="modal" id="PRINT_SAVE_MODAL" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" style="max-width: 1120px;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3 mt-1 mb-3">
                            <h6>Report print settings</h6>
                            <div class="form-group mb-3">
                                <label>Orientation</label>
                                <select id="PAGE_ORIENTATION" name="PAGE_ORIENTATION" class="form-control">
                                    <option value="PORTRAIT" selected>Portrait</option>
                                    <option value="LANDSCAPE">Landscape</option>
                                </select>
                            </div>
                            <div class="form-check">
                              <input id="PAGE_HEADER_REPEAT" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">Repeat Page Header</label>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <iframe id="PDF_PREVIEW" class="border-0" width="100%" height="450px"></iframe>
                        </div>     
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="float-end">
                                <button type="button" class="nsm-button">Save as PDF</button>
                                <button onclick="PRINT_TABLE();" type="button" class="nsm-button success">Print</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal" id="EMAIL_REPORT_MODAL" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="SEND_EMAIL_FORM">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="EMAIL_TO" class="form-control" type="email" placeholder="Send to (email)">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="EMAIL_CC" class="form-control" type="email" placeholder="Carbon Copy (email)">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="EMAIL_SUBJECT" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <textarea id="EMAIL_BODY" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Report <small class="text-muted">(ReportFileName.pdf)</small></h6>
                                <div class="input-group">
                                    <input id="EMAIL_REPORT_FILENAME" class="form-control" type="text" value="Customer Contact List Report">
                                    <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="EMAIL_CLOSE_MODAL" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button success">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: EMAIL REPORT MODAL -->
<!-- END: MODALS -->

<!-- START: LIBRARY AND FRAMEWORKS IMPORTS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>
 <!-- END: LIBRARY AND FRAMEWORKS IMPORTS -->   

<script type="text/javascript">
 var CUSTOMER_CONTACT_LIST_TABLE = $('#CUSTOMER_CONTACT_LIST').DataTable({
        "ordering" : false,
        // paging: false,
        "ajax": "<?php echo base_url('accounting_controllers/reports/getCustomerContactList'); ?>",
        "columns": [
            { "data": "CUSTOMER" },
            { "data": "PHONE_NUMBER" },
            { "data": "EMAIL" },
            { "data": "BILLING_ADDRESS" },
            { "data": "SHIPPING_ADDRESS" },
        ], 
        language: {
            processing: '<span>Fetching data...</span>'
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: '<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?> Customer Contact List'
            },
            {
                extend: 'pdfHtml5',
                title: '<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?> Customer Contact List'
            },
        ]
    });
    var TABLE_SETTINGS = CUSTOMER_CONTACT_LIST_TABLE.settings(); 

// START: PDF SETTINGS SCRIPT
var PDF_CONTENT = $("#CUSTOMER_CONTACT_LIST").html();
var PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
var PDF_ORIENTATION = "PAGE_ORIENTATION=PORTRAIT";

// INITIATE SETTINGS
$('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>'+PDF_ORIENTATION+"&"+PDF_HEADER_REPEAT);

$('#PAGE_ORIENTATION').change(function(event) {
    PDF_ORIENTATION = "PAGE_ORIENTATION="+$(this).val();
    $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>'+PDF_ORIENTATION+"&"+PDF_HEADER_REPEAT);
});

$('#PAGE_HEADER_REPEAT').change(function() {
  if ($(this).is(':checked')) {
    PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=true";
    $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>'+PDF_ORIENTATION+"&"+PDF_HEADER_REPEAT);
    } else {
    PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
    $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>'+PDF_ORIENTATION+"&"+PDF_HEADER_REPEAT);
  }
});

// END: PDF SETTINGS SCRIPT
var REPORT_ID = "29";
$.post("<?php echo base_url('accounting_controllers/reports/getNotes'); ?>", {
    REPORT_ID: REPORT_ID,
}).done(function(data) {
    $('#NOTES_CONTENT').html(data);
    $("#NOTES").val(data);
});

// START: ADD NOTES SCRIPT
$('#ADD_NOTES_FORM').submit(function(event) {
    event.preventDefault();
    var REPORT_ID = "29";
    var REPORT_NOTES = $("#NOTES").val();
    $.post("<?php echo base_url('accounting_controllers/reports/saveNotes'); ?>", {
        REPORT_ID: REPORT_ID,
        REPORT_NOTES: REPORT_NOTES,
    }).done(function(data) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Note added successfully!',
        }).then((result) => {
            var REPORT_ID = "29";
            $.post("<?php echo base_url('accounting_controllers/reports/getNotes'); ?>", {
                REPORT_ID: REPORT_ID,
            }).done(function(data) {
                $('#NOTES_CONTENT').html(data);
                $("#NOTES").val(data);
                $("#NOTES_CLOSE_MODAL").click();
            });
        });
    });
});
// END: ADD NOTES SCRIPT

// START: ADD EVENT SCRIPT
$('#SEND_EMAIL_FORM').submit(function (event) {
    event.preventDefault();
    var EMAIL_TO = $("#EMAIL_TO").val();
    var EMAIL_CC = $("#EMAIL_CC").val();
    var EMAIL_SUBJECT = $("#EMAIL_SUBJECT").val();
    var EMAIL_BODY = $("#EMAIL_BODY").val();
    var EMAIL_REPORT_FILENAME = $("#EMAIL_REPORT_FILENAME").val();
    $.post("<?php echo base_url('PHPMailer'); ?>", {
        EMAIL_TO: EMAIL_TO,
        EMAIL_CC: EMAIL_CC,
        EMAIL_SUBJECT: EMAIL_SUBJECT,
        EMAIL_BODY: EMAIL_BODY,
        EMAIL_REPORT_FILENAME: EMAIL_REPORT_FILENAME,
    }).done(function (data) {
        if (data == "true"){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Email was sended successfully!',
            }).then((result) => {
                $("#EMAIL_CLOSE_MODAL").click();
                // window.location.reload();
            }); 
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to send email!',
            });
        }
    });
});
// END: ADD EVENT SCRIPT
    
function PRINT_TABLE() {
    TABLE_SETTINGS[0]._iDisplayLength = 9999999999;
    CUSTOMER_CONTACT_LIST_TABLE.draw();
    var filename = "[<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?>] Customer Contact List";
    var tab = document.getElementById('CUSTOMER_CONTACT_LIST');
    var style = "<style>";
    style = style + "table {width: 100%;}";
    style = style + "* {font-family: arial;}";
    style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse; padding: 3px 5px;text-align: left;}";
    style = style + "</style>";
    var win = window.open('', '', 'height=650,width=1000');
    // win.document.write("<img style='position: absolute; top: 6px; right: 5px; width: 28%;' src='../files/image/IMAGE_FILE_HERE.png'>");
    win.document.write("<h2><strong><?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?></strong></h2>");
    win.document.write("<h4 style='margin: -20px 0px 15px 0px; font-weight: normal;'>Customer Contact List</h4>");
    win.document.write(tab.outerHTML);
    win.document.write(style);
    win.document.write("<style>#CUSTOMER_CONTACT_LIST>tbody>tr>td{font-size: 12px;} #CUSTOMER_CONTACT_LIST>thead>tr>th{font-size: 10px;}table{width: 100% !important}.avatar {width: 34px;min-width: 34px;height: 34px;}</style>");
    win.document.title = filename;
    setTimeout(function() {
        win.print();
        win.close();
    }, 1000);
    TABLE_SETTINGS[0]._iDisplayLength = 10;
    CUSTOMER_CONTACT_LIST_TABLE.draw();
}
    


var expanded = false;

// var selectedHeader = [];

// $('input[name="header[]"]').change(function() { 
//     $('input[name="header[]"]').each(function() {
//         selectedHeader.push(this.value);
//     });
//     console.log(selectedHeader);
//  });

// $('#exportReport').click(function(e){
//     var rowCount = $('#exportTbl >tbody >tr').length;
//     var tblList = [];
//     $('#exportTbl tr').each(function() {
//         customerId = $(this).find("td:first").html();  
//         tblList.push(customerId);
// });
//     alert(tblList);
// })

$(document).ready(function () {  
    // fetch('<?php echo base_url('accounting_controllers/reports/getCustomerContactList') ?>', {

    // }).then(response => response.json()).then(response => {
    //     console.log(response);
    //     var {success, acs_profile} = response;
    //     if(success){
    //         $('#def_head').append(
    //             '<tr><td>Customer</td><td>Phone Numbers</td><td>Email</td><td>Billing Address</td><td>Shipping Address</td></tr>'
    //         )
    //         for(var x=0; x<acs_profile.length; x++){
    //             $('#def_body').append(
    //                 '<tr><td>'+acs_profile[x].first_name+' '+acs_profile[x].last_name+'</td><td>'+acs_profile[x].phone_h+'</td><td>'+acs_profile[x].email+'</td><td>'+acs_profile[x].city+', '+acs_profile[x].state+', '+acs_profile[x].zip_code+'</td><td>'+acs_profile[x].mail_add+'</td></tr>'
    //             )
    //         }
    //     }
    // }).catch((error) => {
    //     console.log(error);
    // })

    $('#runReport').submit(function(e){
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var customerCol = [];
        var customerColText = [];
        var billingCol = [];
        var billingColText = [];
        var customer_is_checked = false;
        $("input.customer:checkbox:checked").each(function() {
            if($(this).val() == 'customer'){
                customerCol.push('acs_profile.first_name');
                customerCol.push('acs_profile.last_name');
                customer_is_checked = true;
                customerColText.push($(this).next('label').text());

                return;
            }
            if(($(this).val() == 'acs_profile.first_name' || $(this).val() == 'acs_profile.last_name') && customer_is_checked == true ){
                customerColText.push($(this).next('label').text());
                return;
            }
            customerColText.push($(this).next('label').text());
            customerCol.push($(this).val());
        });
        $("input.billing:checkbox:checked").each(function() {
            billingColText.push($(this).next('label').text());
            billingCol.push($(this).val());
            
        });

        //concat two array for header
        const header = customerColText.concat(billingColText);
        const key = customerCol.concat(billingCol);
        
        //create form data
        const formData = new FormData();
        formData.append('customerCol', JSON.stringify(customerCol));
        formData.append('billingCol', JSON.stringify(billingCol));
        formData.append('billingColText', JSON.stringify(billingColText));
        formData.append('customerColText', JSON.stringify(customerColText));

        fetch('<?php echo base_url('accounting_controllers/reports/getCustomerContactList') ?>',{
            method: 'POST',
            body: formData
        }).then(response => response.json()).then(response => {
            var {succss, acs_profile} = response;
            console.log(response);
            var obj = [];
            for(var j=0; j<key.length; j++){
                obj.push(key[j].substring(key[j].indexOf('.') + 1));
            }
            $('#filtered_tbl thead > tr').empty();
            $('#filtered_tbl tbody').empty();
            $('#defaultTbl').hide();
            $("#customizeModal").modal('hide');

            //displaying customized headers
            for(var i = 0; i<header.length; i++){
                $('#head_tbl').append(
                '<td>'+header[i]+'</td>'
                )
            }

            //displaying data
            for(var x=0; x<acs_profile.length; x++){
                var tr = $('#body_tbl').append('<tr></tr>');
                for(var z=0; z<obj.length;z++){
                    if(header[x] == 'Customer'){
                        var t = obj[z];
                        tr.append('<td>'+acs_profile[x][t]+'</td>')
                    }
                }
            }

            
        }).catch((error)=>{
            console.log(error);
        })

    })
    $('#exportReport').click(function () {  
        var row = $('#exportTbl >tbody >tr').length;

        var header = [];  
        var customerData = [];  
        var bRowStarted = true;  
        $('#exportTbl thead>tr').each(function () {  
            $('td', this).each(function () {  
                if (header.length == 0 || bRowStarted == true) {  
                    header.push($(this).text());  
                    bRowStarted = false;  
                }  
                else  
                header.push($(this).text());  
            });  
            bRowStarted = true;  
        }); 
        $('#exportTbl tbody>tr').each(function () {  
            $('td', this).each(function () {  
                if (customerData.length == 0 || bRowStarted == true) {  
                    customerData.push($(this).text());  
                    bRowStarted = false;  
                }  
                else  
                customerData.push($(this).text());  
            });  
            bRowStarted = true;  
        });  

        let dataTbl = [];
        // var rowCount = header.length * row; 
        // for(var x=0; x<=customerData.length; x++){
        //     dataTbl.push([]);

        //     for(var i=0; i<header.length; i++){
        //         dataTbl[header[i]] = customerData[0];
        //         customerData.shift();
        //     }
        // }
        const formData = new FormData();
        formData.append('headers', JSON.stringify(header));
        formData.append('customerDatas', JSON.stringify(customerData));
        fetch('<?php echo base_url('accounting_controllers/reports/export_report') ?>', {
                method: 'POST',
                body: formData,
            }) .then(response => response.json() ).then(response => {
                

            }).catch((error) => {
                console.log('Error:', error);
            });

    });  
});  
function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
function showCheckboxes1() {
  var checkboxes = document.getElementById("checkboxes1");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
    function printTbl(){
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head>');
 
        var table_style = document.getElementById("head").innerHTML;
        printWindow.document.write(table_style);
        printWindow.document.write('</head>');

        printWindow.document.write('<body>');
        var divContents = document.getElementById("tbl_print_accounts_modal").innerHTML;
        alert(divContents);
        printWindow.document.write('<div>');
        printWindow.document.write(divContents);
        printWindow.document.write('</div>');
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        window.print();

        
    }
    function rwcl() {
        var x = document.getElementById("groupby");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");

        rcright.style.color = "#6a4a86";
        rcdown.style.color = "#6a4a86";
        fright.style.color = "black";
        fdown.style.color = "black";
        hfright.style.color = "black";
        hfdown.style.color = "black";

        fright.classList.remove("fw-bold");
        fdown.classList.remove("fw-bold");
        hfright.classList.remove("fw-bold");
        hfdown.classList.remove("fw-bold");

        if (x.style.display === "block") {
            x.style.display = "none";
            rcdown.style.display = "none";
            rcright.style.display = "inline";
            rcright.classList.add("fw-bold");
            
        } else {
            x.style.display = "block";
            rcdown.style.display = "inline";
            rcright.style.display = "none";
            rcdown.classList.add("fw-bold");

        }
    }
    function filter() {
        var x = document.getElementById("filter");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");

        fright.style.color = "#6a4a86";
        fdown.style.color = "#6a4a86";
        rcright.style.color = "black";
        rcdown.style.color = "black";
        rcdown.style.fontWeight = "normal";
        rcright.style.fontWeight = "normal";
        hfright.style.color = "black";
        hfdown.style.color = "black";

        hfright.classList.remove("fw-bold");
        hfdown.classList.remove("fw-bold");
        rcright.classList.remove("fw-bold");
        rcdown.classList.remove("fw-bold");

        if (x.style.display === "none") {
            x.style.display = "block";
            fdown.style.display = "inline";
            fright.style.display = "none";
            fdown.classList.add("fw-bold");
        } else {
            x.style.display = "none";
            fdown.style.display = "none";
            fright.style.display = "inline";
            fright.classList.add("fw-bold");
        }
    }
    function hf() {
        var x = document.getElementById("hf");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");

        hfright.style.color = "#6a4a86";
        hfdown.style.color = "#6a4a86";
        fright.style.color = "black";
        fdown.style.color = "black";
        rcright.style.color = "black";
        rcdown.style.color = "black";
        rcdown.style.fontWeight = "normal";
        rcright.style.fontWeight = "normal";

        fright.classList.remove("fw-bold");
        fdown.classList.remove("fw-bold");
        rcright.classList.remove("fw-bold");
        rcdown.classList.remove("fw-bold");

        if (x.style.display === "block") {
            x.style.display = "none";
            hfdown.style.display = "none";
            hfright.style.display = "inline";
            hfright.classList.add("fw-bold");
        } else {
            x.style.display = "block";
            hfdown.style.display = "inline";
            hfright.style.display = "none";
            hfdown.classList.add("fw-bold");
        }
    }
    function ccl() {
        var x = document.getElementById("changeCol");
        
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function checkCustomer(){
        document.getElementById("checkCustomer1").checked = true;    
    }
    function checkType(){
        document.getElementById("checkType1").checked = true;    
    }
    function checkStatus(){
        document.getElementById("checkStatus1").checked = true;    
    }

    function changeCompany(){
        document.getElementById("changeCompany1").checked = true;    
    }
    function changeReport(){
        document.getElementById("changeReport1").checked = true;    
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>
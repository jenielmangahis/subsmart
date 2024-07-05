<?php include viewPath('v2/includes/accounting_header'); ?>
<style>
    .modal-print{
        width: 100%;
    }
    .change-col {
        color: blue;
        cursor: pointer;
    }
    .change-col:hover{
        text-decoration: underline !important;
    }
    .changeCol{
        display: none;
    }
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
		border-radius: 0;
		border: none;
	}
	.modal-header {
		border-bottom-color: #EEEEEE;
	}
    .czLabel {
        cursor: pointer;
    }
    .czLabel i {
        color: black !important;
        font-size: 13px;
    }
    #general{
        display: none;
    }
    #column{
        display: none;
    }
    .column{
        margin-top: 20px;
    }
    .head_foot{
        display: none;
    }
    .header-footer{
        margin-top: 20px;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<!-- START: MODALS -->
<!-- Modal for Report Settings -->
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- FOR LATER UPDATES -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">User</label>
                                        <select class="form-select">
                                            <option value="all" selected>All</option>
                                            <?php 
                                                foreach ($customerByCompanyID as $customerByCompanyIDs) {
                                                    echo "<option value='$customerByCompanyIDs->prof_id'>$customerByCompanyIDs->first_name $customerByCompanyIDs->last_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Date Changed</label>
                                        <select class="form-select">
                                            <option value="Today">Today</option>
                                            <option value="Yesterday">Yesterday</option>
                                            <option value="This Week">This Week</option>
                                            <option value="This Month">This Month</option>
                                            <option value="This Quarter">This Quarter</option>
                                            <option value="This Year">This Year</option>
                                            <option value="Last Week">Last Week</option>
                                            <option value="Last Month">Last Month</option>
                                            <option value="Last Quarter">Last Quarter</option>
                                            <option value="Last Year">Last Year</option>
                                            <option value="Last Seven Years">Last Seven Years</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary">
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
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" selected>Default</option>
                                                    <option value="date">Date</option>
                                                    <option value="memo-desc">Memo/Description</option>
                                                    <option value="num">Num</option>
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
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-date" class="form-check-input" checked>
                                                            <label for="col-date" class="form-check-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-num" class="form-check-input" checked>
                                                            <label for="col-num" class="form-check-label">Num</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-status" class="form-check-input" checked>
                                                            <label for="col-status" class="form-check-label">Status</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-accepted-date" class="form-check-input">
                                                            <label for="col-accepted-date" class="form-check-label">Accepted Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-accepted-by" class="form-check-input">
                                                            <label for="col-accepted-by" class="form-check-label">Accepted By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-expiration-date" class="form-check-input">
                                                            <label for="col-expiration-date" class="form-check-label">Expiration Date</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-memo-desc" class="form-check-input">
                                                            <label for="col-memo-desc" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-amount" class="form-check-input" checked>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-balance" class="form-check-input" checked>
                                                            <label for="col-balance" class="form-check-label">Balance</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-invoiced-amount" class="form-check-input" checked>
                                                            <label for="col-invoiced-amount" class="form-check-label">Invoiced Amount</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-percent-invoiced" class="form-check-input" checked>
                                                            <label for="col-percent-invoiced" class="form-check-label">% Invoiced</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-remaining-amount" class="form-check-input" checked>
                                                            <label for="col-remaining-amount" class="form-check-label">Remaining Amount</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="P" selected>Portrait</option>
                                <option value="L">Landscape</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal fade" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="col-12 grid-mb company">
                                        
                                    </div>
                                    <div class="col-12 grid-mb text-center report">
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead id="head_tbl">
                                    </thead>
                                    <tbody id="customerTbl">
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center tbl_footer">
                                <!-- <p class="m-0"><?=date("l, F j, Y h:i A eP")?></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Customize Modal -->
<?php include viewPath('accounting/reports/reports_modals/estimates_and_progress_invoicing_summary_by_customer_modal'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        fetch('<?= base_url('accounting_controllers/reports/EstimatesInvoiceByCustomer') ?>',{

        }).then(response => response.json()).then(response => { 
            var {success, def, customer, customerName, custHeader} = response;
            var foot = '';
            if(def){
                if(custHeader){
                    if(custHeader['company_title']){
                        if ( $('.company').children().length > 0 ) {
                            $("#company_child").remove();
                        }
                        $('.company').append(
                            '<h4 class="text-center fw-bold"><span class="company-name" id="company_child">'+custHeader['company_title']+'</span></h4>'
                        )
                    }
                    if(custHeader['report_title']){
                        if ( $('.report').children().length > 0 ) {
                            $("#report_child").remove();
                        }
                        $('.report').append(
                            '<hp class="fw-bold" id="report_child">'+custHeader['report_title']+'</p>'
                        )
                    }
                    if ( $('.tbl_footer').children().length > 0 ) {
                        $("#date_child").remove();
                    }
                    if(custHeader['date_prepared']){
                        foot += custHeader['date_prepared'];
                    }
                    if(custHeader['time_prepared']){
                        foot += ' '+custHeader['time_prepared'];
                    }
                    $('.tbl_footer').append(
                        '<span id="date_child">'+foot+'</span>'
                    );
                }

                $('#head_tbl').append(
                    '<tr><td data-name="Date">DATE</td><td data-name="Num">NUM</td><td data-name="Status">STATUS</td><td data-name="Amount">AMOUNT</td><td data-name="Balance">BALANCE</td><td data-name="Invoiced Amount">INVOICED AMOUNT</td><td data-name="% Invoiced">% AMOUNT</td><td data-name="Remaining Amount">REMAINING AMOUNT</td></tr>'
                );
                var overall_total_amt = 0.00;

                for(var x=0; x<customerName.length; x++){
                    $('#customerTbl').append(
                        '<tr data-toggle="collapse" data-target="#accordion'+x+'" class="clickable collapse-row collapsed"><td><i class="bx bx-fw bx-caret-right"></i>'+customerName[x][0].first_name+' '+ customerName[x][0].last_name +'</td><td></td><td></td><td></td><td></td><td></td><td></td><td><b></b></td></tr>'
                    )
                    var total_amt = 0.00;
                    for(var i=0; i<customer.length; i++){
                        if(customer[i].customer_id == customerName[x][0].prof_id){
                            total_amt += parseFloat(customer[i].grand_total);
                            var estimate_date ='';
                            var est_date = '';
                            if(customer[i].estimate_date != '0000-00-00'){
                                estimate_date = new Date(customer[i].estimate_date);
                                est_date = estimate_date.getMonth()+1 +'/'+ estimate_date.getDate() +'/' + estimate_date.getFullYear();
                            }else{
                                est_date = 'No Date';
                            }
                            $('#customerTbl').append(
                                '<tr class="clickable collapse-row collapse"  id="accordion'+x+'"><td>'+ est_date+'</td><td>'+ customer[i].estimate_number+'</td><td>'+ customer[i].status+'</td><td>$'+parseFloat(customer[i].grand_total).toFixed(2)+'</td><td>$'+parseFloat(customer[i].grand_total).toFixed(2)+'</td><td>0.00</td><td>0.00%</td><td>$'+ parseFloat(customer[i].grand_total).toFixed(2)+'</td></tr>'
                            )
                        }
                    }
                    $('#customerTbl').append(
                        '<tr class="clickable collapse-row collapse"  id="accordion'+x+'"><td><b>Total for '+customerName[x][0].first_name+' '+ customerName[x][0].last_name +'</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>$'+ parseFloat(total_amt).toFixed(2) +'</b></td></tr>'
                        )
                    overall_total_amt += total_amt;
                    
                }
                $('#customerTbl').append(
                        '<tr><td><b>Total</b></td><td></td><td></td><td><b>$'+ parseFloat(overall_total_amt).toFixed(2) +'</b></td><td></td><td></td><td></td><td><b>$'+ parseFloat(overall_total_amt).toFixed(2) +'</b></td></tr>'
                        )
            }
        }).catch((error) => {
            console.log(error);
        })

//RUN REPORT
        $("#runReport").submit(function(e) {
            var header = [];
            var estimateCol = [];
            var invoiceCol = [];
            e.preventDefault(); // avoid to execute the actual submit of the form.

            $("input.header:checkbox:checked").each(function() {
                header.push($(this).val());
            });

            $("input.estimate:checkbox:checked").each(function() {
                estimateCol.push($(this).val());
            });

            $("input.invoice:checkbox:checked").each(function() {
                invoiceCol.push($(this).val());
            });

            var company_name = $('.company_name').val();
            var report_title = $('.report_title').val();

            const fd = new FormData();
            fd.append('header', JSON.stringify(header));
            fd.append('company_name', company_name);
            fd.append('report_title', report_title);
            fetch('<?= base_url('accounting_controllers/reports/EstimatesInvoiceByCustomer') ?>',{
                method: 'POST',
                body: fd
            }).then(response => response.json()).then(response => {
                var {success, cust_header} = response;
                console.log(response);
                var foot = '';
                if(cust_header){
                        if ( $('.company').children().length > 0 ) {
                            $("#company_child").remove();
                        }
                        $('.company').append(
                            '<h4 class="text-center fw-bold"><span class="company-name" id="company_child">'+cust_header['company_title']+'</span></h4>'
                        )
                        if ( $('.report').children().length > 0 ) {
                            $("#report_child").remove();
                        }
                        $('.report').append(
                            '<hp class="fw-bold" id="report_child">'+cust_header['report_title']+'</p>'
                        )
                        
                        if(cust_header['foot']){
                            if ( $('.tbl_footer').children().length > 0 ) {
                                $("#date_child").remove();
                            }
                            if(cust_header['date_prepared']){
                                foot += cust_header['date_prepared'];
                            }
                            if(cust_header['time_prepared']){
                                foot += ' '+cust_header['time_prepared'];
                            }
                            $('.tbl_footer').append(
                                '<span id="date_child">'+foot+'</span>'
                            );
                        }
                }
            }).catch((error)=>{
                console.log(error);
            })

        })
    })

    function general(){
        var class_name = document.getElementById('gen').className;
        var genHeader = document.getElementById('gen');
        var genLabel = document.getElementById('genLabel');
        var genDiv = document.getElementById('general');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            genHeader.classList.remove("bxs-right-arrow");
            genHeader.classList.add("bxs-down-arrow");
            genLabel.classList.add("fw-bold");
            genLabel.style.color = "#6a4a86";
            genDiv.style.display = 'inline';
        }else{
            genHeader.classList.add("bxs-right-arrow");
            genHeader.classList.remove("bxs-down-arrow");
            genLabel.classList.remove("fw-bold");
            genLabel.style.color = "black";
            genDiv.style.display = 'none';

        }
    }
    function column(){
        var class_name = document.getElementById('custom_row_col').className;
        var colHeader = document.getElementById('custom_row_col');
        var colLabel = document.getElementById('custom_row_col_label');
        var colDiv = document.getElementById('column');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            colHeader.classList.remove("bxs-right-arrow");
            colHeader.classList.add("bxs-down-arrow");
            colLabel.classList.add("fw-bold");
            colLabel.style.color = "#6a4a86";
            colDiv.style.display = 'inline';
        }else{
            colHeader.classList.add("bxs-right-arrow");
            colHeader.classList.remove("bxs-down-arrow");
            colLabel.classList.remove("fw-bold");
            colLabel.style.color = "black";
            colDiv.style.display = 'none';

        }
    }
    function headerFooter(){
        var class_name = document.getElementById('header_footer').className;
        var headFootHeader = document.getElementById('header_footer');
        var headFootLabel = document.getElementById('header_footer_label');
        var headFootDiv = document.getElementById('head_foot');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            headFootHeader.classList.remove("bxs-right-arrow");
            headFootHeader.classList.add("bxs-down-arrow");
            headFootLabel.classList.add("fw-bold");
            headFootLabel.style.color = "#6a4a86";
            headFootDiv.style.display = 'inline';
        }else{
            headFootHeader.classList.add("bxs-right-arrow");
            headFootHeader.classList.remove("bxs-down-arrow");
            headFootLabel.classList.remove("fw-bold");
            headFootLabel.style.color = "black";
            headFootDiv.style.display = 'none';

        }
    }
    function dates(){
        var filter_report_period = document.getElementById('filter_report_period').value;
        var date_filter_from = document.getElementById('date_filter_from');
        var date_filter_to = document.getElementById('date_filter_to');
        var filter_to = document.getElementById('filter_to');
        var filter_from = document.getElementById('filter_from');
        const D = new Date(); 
        var month = D.getMonth() + 1;  // 10 (PS: +1 since Month is 0-based)
        var day = D.getDate();       // 30
        var year = D.getFullYear(); // 2022

        if(filter_report_period == 'all-dates'){
            date_filter_from.style.display = 'none';
            date_filter_to.style.display = 'none';
        }else if(filter_report_period == 'this-week'){
            var numberOfDaysToAdd = 7;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var week = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (week.getMonth() + 1)+"/"+week.getDate()+"/"+week.getFullYear();
        }else if(filter_report_period == 'this-month'){
            var numberOfDaysToAdd = 30;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var res_month = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (res_month.getMonth() + 1)+"/"+res_month.getDate()+"/"+res_month.getFullYear();
        }else{
            date_filter_from.style.display = 'inline';
            date_filter_to.style.display = 'inline';
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
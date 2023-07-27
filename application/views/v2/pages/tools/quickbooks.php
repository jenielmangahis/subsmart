<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<link rel="stylesheet" href="<?= base_url("assets/css/daterange/daterangepicker.css") ?>">
<style>
.api-label{
    display: block;
    margin-bottom: 4px;
    font-weight: bold;
    font-size: 16px;
}
.f-green{
    color: #2ab363;
}
.date-filter{
    display: inline-block;
    margin-left: 16px;
    width: 12%;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-5">
                        <h1>Quickbooks Payroll</h1>
                        <p style="margin-top: 21px;">Export timesheet entries to <b>Quickbooks</b></p>
                    </div>
                    <div class="col-7" style="text-align:right;">
                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">
                    </div>
                </div>

                <?php if( $is_with_error == 1 ){ ?>
                    <div class="row">
                        <div class="col-4">
                            <div class="alert alert-danger">Cannot connect to <b>Quickbooks</b>.</div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($companyQuickBooksPayroll && $companyQuickBooksPayroll->status == 1 && $companyInfo){ ?>
                    <div class="row mt-4">
                        <div class="col-2">
                            <span class="api-label">QuickBooks Status</span>
                            <span class="api-label f-green">You are connected</span>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="nsm-button primary btn-disconnect-qb">Disconnect</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <span class="api-label">QuickBooks Account</span>
                        <span class="api-label f-green"><?= $companyInfo->CompanyName; ?></span>
                        <span class="api-label f-green"><?= $companyInfo->CompanyAddr->Line1.', '.$companyInfo->CompanyAddr->City.' '.$companyInfo->CompanyAddr->CountrySubDivisionCode.', '.$companyInfo->CompanyAddr->PostalCode; ?></span>
                    </div> 
                    <div class="row mt-5">                                     
                        <div class="col-12">
                            <a class="nsm-button primary" id="btn-qb-export-timesheet" href="javascript:void(0);">
                                <i class='bx bx-export'></i> Export Timesheet
                            </a>
                            <div class="date-filter">
                                <input type="text" name="attendace_date" id="attendance-filter" class="form-control" placeholder="" value="" required="">
                                <input type="hidden" name="date_from" id="date-from" value="<?= date("Y-m-d"); ?>">
                                <input type="hidden" name="date_to" id="date-to" value="<?= date("Y-m-d"); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12" id="attendance-list">
                            <table class="nsm-table mt-5">                        
                                <thead>
                                    <tr>
                                        <td class="table-icon" style="width:40%;">Employee</td>
                                        <td data-name="TotalRecords">Type</td>
                                        <td data-name="TotalExported">Clock In</td>
                                        <td data-name="TotalExported">Clock Out</td>
                                        <td data-name="TotalExported">Worked Hours</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($attendance_logs as $log){ ?>
                                        <tr>
                                            <td><?= $log['name']; ?></td>
                                            <td>Clock In-Out</td>
                                            <td><?= $log['checkin']; ?></td>
                                            <td><?= $log['checkout'] != '' ? $log['checkout'] : '---'; ?></td>
                                            <td><?= $log['total_hrs']; ?></td>                                            
                                        </tr>
                                    <?php } ?>                                                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <table class="nsm-table mt-5">                        
                                <thead>
                                    <tr>
                                        <td class="table-icon" style="width:70%;">Resource</td>
                                        <td data-name="TotalRecords">Total</td>
                                        <td data-name="TotalExported">Synced</td>
                                        <td data-name="TotalFailed">Failed</td>       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employees</td>
                                        <td><?= $companyQuickBooksPayroll->qb_total_employee; ?></td>
                                        <td><?= $companyQuickBooksPayroll->qb_total_employee_synced; ?></td>
                                        <td><?= $companyQuickBooksPayroll->qb_total_employee_faild_synced; ?></td>   
                                    </tr>
                                    <tr>
                                        <td>Timesheet Entries Exported</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a href="<?= base_url('tools/quickbooks_payroll_employee_logs') ?>" class="nsm-button default">View Logs</a>
                <?php }else{ ?>
                    <div class="row">
                        <div class="col-8">
                            <label class="d-block mb-5">
                                Connect to <b>QuickBooks</b> to link your employees and export timesheet entries.
                            </label>
                            <button class="nsm-button primary btn-connect-quickbooks" onclick="location.href='<?= $qbAuth_url; ?>'">Connect to Quickbooks</button>                            
                        </div>
                    </div>
                <?php } ?>                
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://apis.google.com/js/client.js?onload=checkAuth"/></script>
<script type="text/javascript">
$(function(){
    $('#attendance-filter').daterangepicker({
        opens: 'left'
        }, function(start, end, label) {
        var start_date = start.format('YYYY-MM-DD');
        var end_date   = end.format('YYYY-MM-DD');
        $('#date-from').val(start_date);
        $('#date-to').val(end_date);
        load_attendance_list(start_date, end_date);
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });  

    $('.btn-disconnect-qb').on('click', function(){
        Swal.fire({            
            html: "Disconnect your Quickbook Payroll Account?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "tools/_disconnect_quickbook_account";
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    beforeSend: function(data) {
                        $('#loading_modal').modal('show');
                        $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Disconnecting Quickbook Payroll Account....');
                    },
                    success: function(data) {                                                
                        setTimeout(
                            function() 
                            {                                
                                $('#loading_modal').modal('hide');
                                Swal.fire({                        
                                    text: "Quickbook Payroll Account was successfully disconnected.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });                    
                            }, 
                        1000);                                        
                    },
                    complete : function(){
                        
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    }); 

    $('#btn-qb-export-timesheet').on('click', function(){
        var url = base_url + "tools/_export_qb_timesheet";
        var date_from = $('#date-from').val();
        var date_to   = $('#date-to').val();

        Swal.fire({
            title: 'Export Timesheet',
            html: "The synchronization process will run in background. You can monitor the progress here.",
            icon: 'question',
            confirmButtonText: 'Sync Now',
            showCancelButton: true,
            cancelButtonText: "Close"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {date_from:date_from,date_to:date_to},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Export Timesheet',
                                text: "Export timesheet was successfully created.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });

    function load_attendance_list(date_from, date_to){
        var url = base_url + "tools/_load_attendance_list";
        $.ajax({
            type: 'POST',
            url: url,
            data:{date_from:date_from, date_to:date_to},
            beforeSend: function(data) {                
                $('#attendance-list').html('<span class="bx bx-loader bx-spin"></span>');
            },
            success: function(o) {                    
                $('#attendance-list').html(o);         
            },
            complete : function(){
                
            },
            error: function(e) {
                console.log(e);
            }
        });
    } 
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript" src="<?= base_url("assets/js/daterange/daterangepicker.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/daterange/moment.min.js") ?>"></script>
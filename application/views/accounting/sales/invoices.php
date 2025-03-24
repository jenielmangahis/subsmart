<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/accounting/subtabs/customers_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When an invoice is created in our CRM, a statement summary of your customer's account listing recent invoices will display here for you to view. The statement shows per invoice not per items.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter error h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year">$<?=number_format($unpaid_last_365, 2)?></h2>
                                    <span>UNPAID LAST 365 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year">$<?=number_format($paid_last_30, 2)?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter secondary h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($due_last_365, 2)?></h2>
                                            <span>OVERDUE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($not_due_last_365, 2)?></h2>
                                            <span>NOT DUE YET</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter success h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($not_deposited_last30_days, 2)?></h2>
                                            <span>NOT DEPOSITED</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter success h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($deposited_last30_days, 2)?></h2>
                                            <span>DEPOSITED</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by tag name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <!-- <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send">Send</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminder">Send reminder</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print">Print</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-packing-slip">Print packing slip</a></li> -->
                                <li><a class="dropdown-item invoice-delete disabled" href="javascript:void(0);" id="delete">Delete</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                Filter by <?= ucwords($filter_status); ?>
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices'); ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=draft'); ?>">Draft</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=partially_paid'); ?>">Partially Paid</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=paid'); ?>">Paid</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=due'); ?>">Due</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=overdue'); ?>">Overdue</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('accounting/invoices?status=unpaid'); ?>">Unpaid</a></li>
                            </ul>
                        </div>
                        
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <a href="<?php echo base_url('accounting/addnewInvoice') ?>" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New Invoice
                            </a>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_invoice_num" class="form-check-input">
                                    <label for="chk_invoice_num" class="form-check-label">Invoice number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                                    <label for="chk_balance" class="form-check-label">Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                                    <label for="chk_due_date" class="form-check-label">Due date</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <form id="frm-invoices" method="POST">
                <table class="nsm-table" id="invoices-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE ISSUED</td>
                            <td data-name="Invoice number">INVOICE NUMBER</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="P.O. Number">P.O. Number</td>
                            <td data-name="Sales Rep">SALES REP</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($invoices) > 0) : ?>
						<?php foreach($invoices as $invoice) : ?>
                        <?php 
                            switch ($invoice->status):
                                case "Partially Paid":
                                    $badge = "secondary";
                                    break;
                                case "Paid":
                                    $badge = "success";
                                    break;
                                case "Due":
                                    $badge = "secondary";
                                    break;
                                case "Overdue":
                                    $badge = "error";
                                    break;
                                case "Submitted":
                                    $badge = "success";
                                    break;
                                case "Approved":
                                    $badge = "success";
                                    break;
                                case "Declined":
                                    $badge = "error";
                                    break;
                                case "Scheduled":
                                    $badge = "primary";
                                    break;
                                case "Draft":
                                    $badge = "error";
                                    break;
                                default:
                                    $badge = "error";
                                    break;
                            endswitch;                            
                        ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" name="invoices[]" value="<?= $invoice->id; ?>" type="checkbox">
                                </div>
                            </td>
                            <td>
                                <?php
                                    if( $invoice->date_issued != '' ){
                                        $myDateTime = DateTime::createFromFormat('Y-m-d', $invoice->date_issued);
                                        echo $newDateString = $myDateTime->format('m/d/Y');
                                    }else{
                                        echo 'Not Specified';
                                    }                                
                                ?>
                            </td>
                            <td><?=$invoice->invoice_number?></td>
                            <td>
                                <?php
                                $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                echo $customer->last_name.', '.$customer->first_name;
                                ?>
                            </td>
                            <td>$<?= number_format($invoice->grand_total,2) ?></td>
                            <td>$<?= $invoice->balance > 0 ? number_format($invoice->balance,2) : '0.00'; ?></td>
                            <td>
                                <?php
                                    if( $invoice->due_date != '' ){
                                        $myDateTime = DateTime::createFromFormat('Y-m-d', $invoice->due_date);
                                        echo $newDateString = $myDateTime->format('m-d-Y');
                                    }else{
                                        echo 'Not Specified';
                                    }                                
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if( $invoice->purchase_order != '' ){
                                        echo $invoice->purchase_order;
                                    }else{
                                        echo  'not Specified';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if( $invoice->FName != '' ){
                                        echo $invoice->FName . ' ' . $invoice->LName;
                                    }else{
                                        echo 'Not Specified';
                                    }
                                ?>
                            </td>
                            <td>
                                <span class="status-label nsm-badge <?= $badge ?>" style="font-size: 13px;">
                                    <?= $invoice->status != '' ? $invoice->status : 'Draft'; ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">View Invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">Send Invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/invoice_edit/' . $invoice->id) ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item recordPaymentBtn" href="javascript:void(0);" data-id="<?php echo $invoice->id ?>">Record Payment</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('workorder/invoice_workorder/' . $invoice->id) ?>">Convert to Workorder</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item clone-item" href="javascript:void(0);" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>" data-bs-toggle="modal">Clone Invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>" target="_blank">Invoice PDF</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>" target="_blank">Print Invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url('job/invoice_job/'. $invoice->id); ?>">Convert to Job</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#invoices-table").nsmPagination({itemsPerPage:10});  
    $(".select-all").click(function(){
        $('.form-check-input').not(this).prop('checked', this.checked);

        var count_rows_list_check = $('.select-all').filter(':checked').length;
        if(count_rows_list_check > 0) {
            $(".invoice-delete").removeClass("disabled");
        } else {
            $(".invoice-delete").addClass("disabled");
        }           
    });

    $(document).on("click", ".delete-item", function(){
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete Invoice',
            text: "Are you sure you want to delete this Invoice?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>invoice/deleteInvoiceBtnNew",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        Swal.fire({
                            title: 'Good job!',
                            text: "Data Deleted Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    },
                });
            }
        });
    });

    $(document).on('click touchstart', '.clone-item', function(){
        var invoice_id = $(this).attr('data-id');
        var invoice_number = $(this).attr('data-invoice-number');

        Swal.fire({
            html: "You are going create a new invoice based on invoice number <b>"+ invoice_number +"</b>.<br/><br /><small style='font-size:13px;'>The new invoice will contain the same items (e.g. materials, labour).Cloned invoice will have status as <b>draft</b>. You will be able to edit and remove the invoice items as you need.</small><br /><br />Do you wish to proceed with selected action?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "invoice/_clone_invoice",
                    data: {
                        invoice_id: invoice_id
                    },
                    dataType:'json',
                    beforeSend: function(data) {
                        
                    },
                    success: function(result) {
                        if( result.is_success == 1 ){
                            var edit_invoice_url = base_url + 'invoice/invoice_edit/' + result.invoice_id;                        
                            Swal.fire({
                                html: 'Invoice was Invoice was successfully cloned.',
                                icon: 'success',
                                showCancelButton: false,
                                showDenyButton: true,
                                confirmButtonText: 'Okay',
                                denyButtonText: `Edit Invoice`,
                                denyButtonColor: '#7367f0'
                            }).then((result) => {
                                if (result.isDenied) {
                                    location.href = edit_invoice_url;
                                }else{
                                    location.reload();
                                }                            
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    },
                    complete : function(){
                        
                    },
                });
            }
        });
    });

    $(".select-one").click(function(){
        var count_rows_list_check = $('.select-one').filter(':checked').length;
        if(count_rows_list_check > 0) {
            $(".invoice-delete").removeClass("disabled");
        } else {
            $(".invoice-delete").addClass("disabled");
        }           
    });

    $('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
        var chk = $(this);
        var dataName = $(this).next().text();

        var index = $(`#invoices-table thead td[data-name="${dataName}"]`).index();
        $(`#invoices-table tr`).each(function() {
            if(chk.prop('checked')) {
                $($(this).find('td')[index]).show();
            } else {
                $($(this).find('td')[index]).hide();
            }
        });
    });

    $('.invoice-delete').on('click', function(){
        Swal.fire({            
            html: "Proceed with deleting selected rows?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "accounting/invoices/delete-selected";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#frm-invoices').serialize(),
                    dataType: 'json',
                    beforeSend: function(data) {
                        
                    },
                    success: function(data) {                                                
                        Swal.fire({                        
                            text: "Invoices was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });                                         
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
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
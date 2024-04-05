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
                                        echo $newDateString = $myDateTime->format('m-d-Y');
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
                            <td><?= $invoice->status != '' ? $invoice->status : 'Draft'; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('accounting/genview/' . $invoice->id) ?>">View</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('accounting/invoice_edit/' . $invoice->id) ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Duplicate</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Send</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Share invoice link</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Print</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Print packing slip</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Void</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Delete</a>
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
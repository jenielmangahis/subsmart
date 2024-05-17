<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/credit_notes_modals'); ?>
<?php 
    $date = 'today';
    $from_date = date("Y-m-d");
    $to_date   = date("Y-m-d");
    if( isset($dates_filter['type'])){
        $date = $dates_filter['type'];
        $from_date = $dates_filter['start-date'];
        $to_date   = $dates_filter['end-date'];
    } 
?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Indicate a return of funds in the event of an invoice error, incorrect or damaged products, purchase cancellation or otherwise specified circumstance.
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
                                <li><a class="dropdown-item dropdown-delete-credit-notes disabled" href="javascript:void(0);" id="delete-credit-notes">Delete</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date-credit-notes">
                                            <option value="last-365-days" <?= $date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                            <option value="custom" <?=$date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?= empty($date) || $date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="yesterday" <?=$date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                                            <option value="this-month" <?=$date === 'this-month' ? 'selected' : ''?>>This month</option>
                                            <option value="this-quarter" <?=$date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                            <option value="this-year" <?=$date === 'this-year' ? 'selected' : ''?>>This year</option>
                                            <option value="last-week" <?=$date === 'last-week' ? 'selected' : ''?>>Last week</option>
                                            <option value="last-month" <?=$date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                            <option value="last-quarter" <?=$date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                            <option value="last-year" <?=$date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                            <option value="all-dates" <?=$date === 'all-dates' ? 'selected' : ''?>>All dates</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <input type="date" id="filter-from" class="nsm-field form-control date" value="<?=empty($from_date) ? date("Y-m-d") : $from_date?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <input type="date" id="filter-to" class="nsm-field form-control date"value="<?=empty($to_date) ? date("Y-m-d") : $to_date?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="<?=$type === 'recently-paid' ? 'col-12' : 'col-5'?>">
                                        <label for="filter-customer">Customer</label>
                                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                                            <?php if(empty($customer_filter)) : ?>
                                                <option value="all" selected="selected">All</option>
                                            <?php else : ?>
                                                <option value="<?=$customer_filter->prof_id?>"><?=$customer_filter->first_name . ' ' . $customer_filter->last_name; ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" id="new-credit-note">
                                <span>
                                    <i class='bx bx-fw bx-list-plus'></i> New Credit Note
                                </span>
                            </button>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-transactions">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_credit_notes_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                                    <label for="chk_no" class="form-check-label">No.</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                                    <label for="chk_customer" class="form-check-label">Customer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                                    <label for="chk_memo" class="form-check-label">Memo</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                                    <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                                    <label for="chk_email" class="form-check-label">Email</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                                    <label for="chk_attachments" class="form-check-label">Attachments</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);" data-row="10">10</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-row="50">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-row="75">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-row="100">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-row="150">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-row="300">300</a></li>
                                    </ul>
                                </div>
                                <!-- <div class="form-check">
                                    <input type="checkbox" id="compact" class="form-check-input">
                                    <label for="compact" class="form-check-label">Compact</label>
                                </div> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <form id="frm-credit-notes" method="POST">
                <table class="nsm-table" id="credit-notes-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="P.O. Number">P.O. Number</td>
                            <td data-name="Sales Rep">SALES REP</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($notes) > 0) : ?>
						<?php foreach($notes as $note) : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" name="creditNotes[]" type="checkbox" value="<?=$note['id']?>">
                                </div>
                            </td>
                            <td><?= $note['date']?></td>
                            <td><?= $note['type']?></td>
                            <td><?= $note['no'] != '' ? $note['no'] : '---'; ?></td>
                            <td><?= $note['customer']; ?></td>
                            <td><?= $note['memo'] != '' ? $note['memo'] : 'Not Specified'; ?></td>
                            <td><?= $note['total']?></td>
                            <td><?= $note['email'] != '' ? $note['email'] : 'Not Specified'; ?></td>
                            <td><?= $note['status']?></td>
                            <td><?= $note['po_number'] != '' ? $note['po_number'] : '---'; ?></td>
                            <td><?= $note['sales_rep'] != '' ? $note['sales_rep'] : 'Not Specified'; ?></td>
                            <td><?= $note['manage']?></td>
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
    const companyName = "<?=$company->business_name?>";
    $('#credit-notes-table').nsmPagination({itemsPerPage: 10});
    
    $(".select-all").click(function(){
        var count_vendor_list_check = $('.select-all').filter(':checked').length;
        if(count_vendor_list_check > 0) {
            $(".dropdown-delete-credit-notes").removeClass("disabled");
        } else {
            $(".dropdown-delete-credit-notes").addClass("disabled");
        }   
        $('.select-one').not(this).prop('checked', this.checked);
    });

    $(".select-one").click(function(){
        var count_vendor_list_check = $('.select-one').filter(':checked').length;
        if(count_vendor_list_check > 0) {
            $(".dropdown-delete-credit-notes").removeClass("disabled");
        } else {
            $(".dropdown-delete-credit-notes").addClass("disabled");
        }           
    });

    $('#table-rows a').on('click', function(){
        var data_row = $(this).attr('data-row');
        $('#credit-notes-table').nsmPagination({itemsPerPage: data_row});
    });

    $('#delete-credit-notes').on('click', function(){
        Swal.fire({            
            html: "Proceed with deleting selected rows?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "accounting/credit-notes/delete-selected";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#frm-credit-notes').serialize(),
                    dataType: 'json',
                    beforeSend: function(data) {
                        
                    },
                    success: function(data) {                                                
                        Swal.fire({                        
                            text: "Credit notes was successfully updated",
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

    $('#filter-date-credit-notes').on('change', function(){
        switch($(this).val()) {
            case 'last-365-days' :
                var date = new Date();
                date.setDate(date.getDate() - 365);

                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = '';
            break;            
            case 'today' :
                var date = new Date();
                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            break;
            case 'yesterday' :
                var date = new Date();
                date.setDate(date.getDate() - 1);
                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            break;
            case 'this-week' :
                var date = new Date();
                var from = date.getDate() - date.getDay();
                var to = from + 6;

                var from_date = new Date(date.setDate(from));
                var to_date = new Date(date.setDate(to));

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'this-month' :
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'this-quarter' :
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
                switch(currQuarter) {
                    case 1 :
                        var from_date = '01/01/' + date.getFullYear();
                        var to_date = '03/31/'+ date.getFullYear();
                    break;
                    case 2 :
                        var from_date = '04/01/' + date.getFullYear();
                        var to_date = '06/30/'+ date.getFullYear();
                    break;
                    case 3 :
                        var from_date = '07/01/' + date.getFullYear();
                        var to_date = '09/30/'+ date.getFullYear();
                    break;
                    case 4 :
                        var from_date = '10/01/' + date.getFullYear();
                        var to_date = '12/31/'+ date.getFullYear();
                    break;
                }
            break;
            case 'this-year' :
                var date = new Date();

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
            case 'last-week' :
                var date = new Date();
                var from = date.getDate() - date.getDay();

                var from_date = new Date(date.setDate(from - 7));
                var to_date = new Date(date.setDate(date.getDate() + 6));

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'last-month' :
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

                from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'last-quarter' :
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
                switch(currQuarter) {
                    case 1 :
                        var from_date = new Date('01/01/' + date.getFullYear());
                        var to_date = new Date('03/31/'+ date.getFullYear());
                    break;
                    case 2 :
                        var from_date = new Date('04/01/' + date.getFullYear());
                        var to_date = new Date('06/30/'+ date.getFullYear());
                    break;
                    case 3 :
                        var from_date = new Date('07/01/' + date.getFullYear());
                        var to_date = new Date('09/30/'+ date.getFullYear());
                    break;
                    case 4 :
                        var from_date = new Date('10/01/' + date.getFullYear());
                        var to_date = new Date('12/31/'+ date.getFullYear());
                    break;
                }

                from_date.setMonth(from_date.getMonth() - 3);
                to_date.setMonth(to_date.getMonth() - 3);

                if(to_date.getDate() === 1) {
                    to_date.setDate(to_date.getDate() - 1);
                }

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'last-year' :
                var date = new Date();
                date.setFullYear(date.getFullYear() - 1);

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
            default :
                var from_date = '';
                var to_date = '';
            break;
        }

        $('#filter-from').val(moment(from_date).format('YYYY-MM-DD'));
        $('#filter-to').val(moment(to_date).format('YYYY-MM-DD'));
    });
});
    
</script>
<?php include viewPath('v2/includes/footer'); ?>
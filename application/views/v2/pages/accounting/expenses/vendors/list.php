<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/vendors_modals'); ?>

<style>
    .nsm-counter.selected, .nsm-counter.co-selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }

    #import-vendors-modal .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    #import-vendors-modal label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }    
    #import-vendors-modal hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    #import-vendors-modal .required{
        color : red!important;
    }
    #import-vendors-modal .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #import-vendors-modal .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    #import-vendors-modal #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    #import-vendors-modal table{
        overflow-x:scroll !important;
        overflow-y:scroll !important;
        display:block !important;
        height:500px !important;
    }
    /**  */
    /* #import-vendors-modal * {
        margin: 0;
        padding: 0;
    } */
    #import-vendors-modal #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }

    #import-vendors-modal #progress-bar-container li.active,
    #import-vendors-modal #progress-bar-container li:hover {
        color: #444;
    }

    #import-vendors-modal #progress-bar-container li::after {
        content: " ";
        display: block;
        width: 6px;
        height: 6px;
        background-color: #777;
        margin: auto;
        border: 7px solid #fff;
        border-radius: 50%;
        margin-top: 40px;
        box-shadow: 0 2px 13px -1px rgba(0, 0, 0, 0.2);
        transition: all ease 0.25s;
    }
    #import-vendors-modal #progress-bar-container li:hover::after {
        background: #555;
    }

    #import-vendors-modal #progress-bar-container li.active::after {
        background: #207893;
    }

    #import-vendors-modal #progress-bar-container #line {
        width: 80%;
        margin: auto;
        background-color: #eee;
        height: 6px;
        position: absolute;
        left: 10%;
        top: 50px;
        z-index: 1;
        border-radius: 50px;
        transition: all ease 0.75s;
    }

    #import-vendors-modal #progress-bar-container #line-progress {
        content: " ";
        width: 10%;
        height: 100%;
        background-color: #207893;
        background: linear-gradient(to right #207893 0%, #2ea3b7 100%);
        position: absolute;
        z-index: 2;
        border-radius: 50px;
        transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.25);
    }
    #import-vendors-modal #progress-content-section {
        position: relative;
        top: 100px;
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 4px;
    }
    #import-vendors-modal #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    #import-vendors-modal .section-content h2 {
        font-size: 17px;
        text-transform: uppercase;
        color: #333;
        letter-spacing: 1px;
    }

    #import-vendors-modal .section-content p {
        font-size: 16px;
        line-height: 1.8rem;
        color: #777;
    }

    #import-vendors-modal .section-content {
        display: none;
        animation: FadeinUp 0.7s ease 1 forwards;
        transform: translateY(15px);
        opacity: 0;
    }

    #import-vendors-modal .section-content.active {
        display: block;
        opacity: 1;
    }
    #import-vendors-modal .progress-wrapper {
        margin: auto;
        max-width: auto;
    }
    #import-vendors-modal #progress-bar-container {
        position: relative;
        margin: auto;
        height: 100%;
        margin-top: 65px;
    }
    #import-vendors-modal #progress-bar-container ul {
        padding-top: 15px;
        z-index: 999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }
    #import-vendors-modal #progress-bar-container li::before {
        content: " ";
        display: block;
        margin: auto;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #aaa;
        transition: all ease 0.3s;
    }

    #import-vendors-modal #progress-bar-container li.active::before,
    #import-vendors-modal #progress-bar-container li:hover::before {
        border: 2px solid #fff;
        background-color: #32243d;
    }

    #import-vendors-modal #progress-bar-container li {
        list-style: none;
        float: left;
        width: 33%;
        text-align: center;
        color: #aaa;
        text-transform: uppercase;
        font-size: 11px;
        cursor: pointer;
        font-weight: 700;
        transition: all ease 0.2s;
        vertical-align: bottom;
        height: 60px;
        position: relative;
    }

    @keyframes FadeInUp {
    0% {
        transform: translateY(15px);
        opacity: 0;
    }
    100% {
        transform: translateY(0px);
        opacity: 1;
    }
    }

    #import-vendors-modal .btn-primary:disabled {
        color: #fff !important;;
        background-color: #ccc !important;
        border: 1px solid transparent !important;;
    }

    #import-vendors-modal .tbl { border-collapse: collapse;}
    #import-vendors-modal .tbl th, .tbl td { padding: 2px; border: solid 1px #777; }
    #import-vendors-modal .tbl th { background-color: lightblue; }
    #import-vendors-modal .tbl-separate { border-collapse: separate; border-spacing: 5px;}

    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Vendors are people or companies that you owe money to or subcontractors that work for you.  You can use the vendors tab to add and track them.  Here's how.  Select Expenses, then Vendors.  Select New Vendor.  Complete the fields in the Vendor Information window.  Select Save and close.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2 <?=$transaction === 'purchase-orders' ? 'selected' : ''?>" id="purchase-orders">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$purchaseOrders?></h2>
                                    <span>PURCHASE ORDERS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter error h-100 mb-2 <?=$transaction === 'overdue-bills' ? 'selected' : ''?><?=$transaction === 'open-bills' ? 'co-selected' : ''?>" id="overdue-bills">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$overdueBills?></h2>
                                    <span>OVERDUE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2 <?=$transaction === 'open-bills' ? 'selected' : ''?>" id="open-bills">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="pending_total"><?=$openBills?></h2>
                                    <span>OPEN BILLS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2 <?=$transaction === 'payments' ? 'selected' : ''?>" id="payments">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="paid_total"><?=$paidTransactions?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/vendors') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
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
                                <li><a class="dropdown-item dropdown-email  disabled" href="javascript:void(0);" id="email">Email</a></li>
                                <li><a class="dropdown-item dropdown-make-inactive disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
                                <li><a class="dropdown-item dropdown-delete-vendor disabled" href="javascript:void(0);" id="delete-vendor">Delete</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Other Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-checks">Print checks</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="pay-bills">Pay bills</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#import-vendors-modal">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button" id="add-vendor-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_vendors_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="address_chk" class="form-check-input">
                                    <label for="address_chk" class="form-check-label">Address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="attachments_chk" class="form-check-input">
                                    <label for="attachments_chk" class="form-check-label">Attachments</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="phone_chk" class="form-check-input">
                                    <label for="phone_chk" class="form-check-label">Phone</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="email_chk" class="form-check-input">
                                    <label for="email_chk" class="form-check-label">Email</label>
                                </div>
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" <?=$status === 'all' ? 'checked' : ''?> id="inc_inactive" value="1" class="form-check-input">
                                    <label for="inc_inactive" class="form-check-label">Include Inactive</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="vendors-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr data-status="<?=$vendor->status === '0' ? 'inactive' : 'active'?>">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$vendor->id?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/vendors/view/' . $vendor->id) ?>'"><?=$vendor->display_name?><?=$vendor->status === '0' ? ' (deleted)' : ''?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td class="overflow-visible">
                                <?php $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendor->id) ?>
                                <?php if(count($attachments) > 0) : ?>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bx bx-fw"><?=count($attachments)?></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px">
                                        <?php foreach($attachments as $attachment) : ?>
                                        <li>
                                            <a href="#" class="dropdown-item view-attachment" data-href="/uploads/accounting/attachments/<?=$attachment->stored_name?>">
                                                <div class="row">
                                                    <div class="col-5 pr-0">
                                                        <?=in_array($attachment->file_extension, ['jpg', 'jpeg', 'png']) ? "<img src='/uploads/accounting/attachments/$attachment->stored_name' class='m-auto w-100'>" : "<div class='bg-muted text-center d-flex justify-content-center align-items-center h-100 text-white'><p class='m-0'>NO PREVIEW AVAILABLE</p></div>"?>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="d-flex align-items-center h-100 w-100">
                                                            <span class="text-truncate"><?=$attachment->uploaded_name.'.'.$attachment->file_extension?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($vendor->status === '0') : ?>
                                        <li>
                                            <a class="dropdown-item make-active" href="javascript:void(0);">Make active</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-vendor" href="javascript:void(0);">Delete</a>
                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a class="dropdown-item create-bill" href="javascript:void(0);">Create bill</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-expense" href="javascript:void(0);">Create expense</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item write-check" href="javascript:void(0);">Write check</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-purchase-order" href="javascript:void(0);">Create purchase order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item make-inactive" href="javascript:void(0);">Make inactive</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-vendor" href="javascript:void(0);">Delete</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){   

    $(".select-all").click(function(){
        var count_vendor_list_check = $('.select-all').filter(':checked').length;
        if(count_vendor_list_check > 0) {
            $(".dropdown-make-inactive").removeClass("disabled");
            $(".dropdown-email").removeClass("disabled");            
        } else {
            $(".dropdown-make-inactive").addClass("disabled");
            $(".dropdown-email").addClass("disabled");
        }             
    }) 
});
</script>
<?php include viewPath('v2/includes/footer'); ?>

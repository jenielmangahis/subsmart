<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/customers_modals'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<style>
    #search_field {
        width: 250px;
    }

    #customerListPagination {
        height: 34px;
    }

    #customers-table > tfoot {
        display: none !important; 
    }

    .customerViewInfo {
        cursor: pointer;
        text-decoration: none;
        color: black;
    }

    #customers-table_length,
    #customers-table_filter {
        display: none;
    }

    .nsm-counter.selected, .nsm-counter.co-selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }

    #import-customers-modal .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    #import-customers-modal label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    #import-customers-modal hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    #import-customers-modal .required{
        color : red!important;
    }
    #import-customers-modal .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #import-customers-modal .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    #import-customers-modal #overlay {
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
    #import-customers-modal table{
        overflow-x:scroll !important;
        overflow-y:scroll !important;
        display:block !important;
        height:500px !important;
    }
    /**  */
    /* #import-customers-modal * {
        margin: 0;
        padding: 0;
    } */
    #import-customers-modal #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }

    #import-customers-modal #progress-bar-container li.active,
    #import-customers-modal #progress-bar-container li:hover {
        color: #444;
    }

    #import-customers-modal #progress-bar-container li::after {
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
    #import-customers-modal #progress-bar-container li:hover::after {
        background: #555;
    }

    #import-customers-modal #progress-bar-container li.active::after {
        background: #207893;
    }

    #import-customers-modal #progress-bar-container #line {
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

    #import-customers-modal #progress-bar-container #line-progress {
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
    #import-customers-modal #progress-content-section {
        position: relative;
        top: 100px;
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 4px;
    }
    #import-customers-modal #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    #import-customers-modal .section-content h2 {
        font-size: 17px;
        text-transform: uppercase;
        color: #333;
        letter-spacing: 1px;
    }

    #import-customers-modal .section-content p {
        font-size: 16px;
        line-height: 1.8rem;
        color: #777;
    }

    #import-customers-modal .section-content {
        display: none;
        animation: FadeinUp 0.7s ease 1 forwards;
        transform: translateY(15px);
        opacity: 0;
    }

    #import-customers-modal .section-content.active {
        display: block;
        opacity: 1;
    }
    #import-customers-modal .progress-wrapper {
        margin: auto;
        max-width: auto;
    }
    #import-customers-modal #progress-bar-container {
        position: relative;
        margin: auto;
        height: 100%;
        margin-top: 65px;
    }
    #import-customers-modal #progress-bar-container ul {
        padding-top: 15px;
        z-index: 999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }
    #import-customers-modal #progress-bar-container li::before {
        content: " ";
        display: block;
        margin: auto;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #aaa;
        transition: all ease 0.3s;
    }

    #import-customers-modal #progress-bar-container li.active::before,
    #import-customers-modal #progress-bar-container li:hover::before {
        border: 2px solid #fff;
        background-color: #32243d;
    }

    #import-customers-modal #progress-bar-container li {
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

    #import-customers-modal .btn-primary:disabled {
        color: #fff !important;;
        background-color: #ccc !important;
        border: 1px solid transparent !important;;
    }

    #import-customers-modal .tbl { border-collapse: collapse;}
    #import-customers-modal .tbl th, .tbl td { padding: 2px; border: solid 1px #777; }
    #import-customers-modal .tbl th { background-color: lightblue; }
    #import-customers-modal .tbl-separate { border-collapse: separate; border-spacing: 5px;}

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
    .table-num-rows{
        float: right;
        margin-top: 10px;
        width: 205px;
        text-align:right;
    }
    .table-num-rows select{
        display: inline-block;
        width:100px;
    }
    .table-num-rows label{
        display:inline-block;
        margin-right:5px;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/customers_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            As your business grows, it's important to stay organized and keep track of your customers. You can add customer profiles so you can quickly add them to transactions or invoices. Here's how to add customers and keep your customer list up-to-date. Select New Customer. Enter your customer's info. Select Save.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter primary h-100 mb-2 <?=$transaction === 'estimates' ? 'selected' : ''?>" id="estimates">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($openEstimates)?></h2>
                                            <span>ESTIMATES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter secondary h-100 mb-2 <?=$transaction === 'unbilled-activity' ? 'selected' : ''?>" id="unbilled-activity">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($unbilledActivities)?></h2>
                                            <span>UNBILLED ACTIVITY</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter error h-100 mb-2 <?=$transaction === 'overdue-invoices' ? 'selected' : ''?><?=$transaction === 'open-invoices' ? 'co-selected' : ''?>" id="overdue-invoices">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($overdueInvoices)?></h2>
                                            <span>OVERDUE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter h-100 mb-2 <?=$transaction === 'open-invoices' ? 'selected' : ''?>" id="open-invoices">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($openInvoices)?></h2>
                                            <span>OPEN INVOICES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2 <?=$transaction === 'payments' ? 'selected' : ''?>" id="payments">
                            <div class="row h-100">
                                <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-10 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=count($payments)?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/customers') ?>" method="get">
                            <div class="nsm-field-group search">
                                <div class="input-group">
                                    <input type="text" class="form-control mb-2" id="search_field" name="search" placeholder="Search by customer info.">                                    
                                </div>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="create-statements">Create statements</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="email-action">Email</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="select-customer-type">Change customer type</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#customer-types-modal">
                                <i class='bx bx-fw bx-list-ul'></i> Customer Types
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#import-customers-modal">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add-customer-modal">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('accounting/customers/export') ?>'">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_customers_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_address" class="form-check-input">
                                    <label for="chk_address" class="form-check-label">Address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                                    <label for="chk_email" class="form-check-label">Email</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_customer_type" class="form-check-input">
                                    <label for="chk_customer_type" class="form-check-label">Customer Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_phone" class="form-check-input">
                                    <label for="chk_phone" class="form-check-label">Phone</label>
                                </div>
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" id="inc_inactive" value="1" class="form-check-input">
                                    <label for="inc_inactive" class="form-check-label">Include inactive</label>
                                </div>                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-num-rows">
                    <label for="customerListPagination" class="col-sm-2 col-4 col-form-label">Rows</label>
                    <select id="customerListPagination" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <table class="nsm-table" id="customers-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input table-select check-input-all-customers" id="check-input-all-customers" type="checkbox">
                            </td>
                            <td data-name="Customer/Company">CUSTOMER/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Customer Type">CUSTOMER TYPE</td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="accountingCustomerTblFrm" class="accountingCustomerTblFrm">
                            <!-- <?php if(count($customers) > 0) : ?>
                            <?php foreach($customers as $customer) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select check-input-customers" id="check-input-customers" name="customer_prof_ids[]" type="checkbox" value="<?=$customer->prof_id?>">
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/customers/view/' . $customer->prof_id) ?>'"><?=$customer->last_name.', '.$customer->first_name?></td>
                                <td>
                                    <?php
                                        $address = '';
                                        $address .= $customer->mail_add !== null ? $customer->mail_add : "";
                                        $address .= $customer->city !== null ? '<br />' . $customer->city : "";
                                        $address .= $customer->state !== null ? ', ' . $customer->state : "";
                                        $address .= $customer->zip_code !== null ? ' ' . $customer->zip_code : "";
                                        echo !empty($address) ? $address : 'Not Specified';
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if(!empty($customer->phone_h)) {
                                            if($customer->phone_h != "") {
                                                if (ctype_space($customer->phone_h)) {
                                                    echo 'Not Specified'; 
                                                } else {
                                                    echo formatPhoneNumber($customer->phone_h);
                                                }
                                            } else {
                                                echo 'Not Specified'; 
                                            }
                                        } else {
                                            echo 'Not Specified'; 
                                        }
                                        //!empty($customer->phone_h) ? formatPhoneNumber($customer->phone_h) : 'Not Specified'; 
                                    ?>
                                </td>
                                <td><?= !empty($customer->email) ? $customer->email : 'Not Specified'; ?></td>
                                <td>
                                    <?php
                                        if(!empty($customer->customer_type)) {
                                            if($customer->customer_type == 'Business') {
                                                echo 'Commercial';
                                            } else {
                                                echo $customer->customer_type;
                                            }
                                        } else {
                                            echo 'Not Specified'; 
                                        }
                                        //!empty($customer->customer_type) ? $customer->customer_type : 'Not Specified'; 
                                    ?>
                                </td>
                                <td>0</td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item receive-payment" href="#">Receive payment</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item send-reminder" href="#">Send reminder</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-statement" href="#">Create statement</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-sales-receipt" href="#">Create sales receipt</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-standard-estimate" href="#">Create standard estimate</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-options-estimate" href="#">Create options estimate</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item create-bundle-estimate" href="#">Create bundle estimate</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item send-payment-link" href="#">Send payment link</a>
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
                            <?php endif; ?> -->
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    $(document).ready(function () {
        // DataTable Configuration ===============
        const customers_table = $('#customers-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?php echo base_url('accounting_controllers/Customers/customerServersideLoad/'); ?>",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $(document).on('keyup', '#search_field', function () {
            customers_table.search($(this).val()).draw();
        });
        
        $(document).on('change', '#customerListPagination', function () {
            const paginationValue = $(this).val();
            customers_table.page.len(paginationValue).draw();
        });
    });
</script>
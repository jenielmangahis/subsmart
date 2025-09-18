<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/chart_of_accounts_modals'); ?>

<style>
    #import-accounts-modal .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    #import-accounts-modal label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    #import-accounts-modal hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    #import-accounts-modal .required{
        color : red!important;
    }
    #import-accounts-modal .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #import-accounts-modal .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    #import-accounts-modal #overlay {
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
    #import-accounts-modal table{
        overflow-x:scroll !important;
        overflow-y:scroll !important;
        display:block !important;
        height:500px !important;
    }
    /**  */
    /* #import-accounts-modal * {
        margin: 0;
        padding: 0;
    } */
    #import-accounts-modal #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }  

    #import-accounts-modal #progress-bar-container li.active,
    #import-accounts-modal #progress-bar-container li:hover {
        color: #444;
    }

    #import-accounts-modal #progress-bar-container li::after {
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
    #import-accounts-modal #progress-bar-container li:hover::after {
        background: #555;
    }

    #import-accounts-modal #progress-bar-container li.active::after {
        background: #207893;
    }

    #import-accounts-modal #progress-bar-container #line {
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

    #import-accounts-modal #progress-bar-container #line-progress {
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
    #import-accounts-modal #progress-content-section {
        position: relative;
        top: 100px;
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 4px;
    }
    #import-accounts-modal #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    #import-accounts-modal .section-content h2 {
        font-size: 17px;
        text-transform: uppercase;
        color: #333;
        letter-spacing: 1px;
    }

    #import-accounts-modal .section-content p {
        font-size: 16px;
        line-height: 1.8rem;
        color: #777;
    }

    #import-accounts-modal .section-content {
        display: none;
        animation: FadeinUp 0.7s ease 1 forwards;
        transform: translateY(15px);
        opacity: 0;
    }

    #import-accounts-modal .section-content.active {
        display: block;
        opacity: 1;
    }
    #import-accounts-modal .progress-wrapper {
        margin: auto;
        max-width: auto;
    }
    #import-accounts-modal #progress-bar-container {
        position: relative;
        margin: auto;
        height: 100%;
        margin-top: 65px;
    }
    #import-accounts-modal #progress-bar-container ul {
        padding-top: 15px;
        z-index: 999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }
    #import-accounts-modal #progress-bar-container li::before {
        content: " ";
        display: block;
        margin: auto;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #aaa;
        transition: all ease 0.3s;
    }

    #import-accounts-modal #progress-bar-container li.active::before,
    #import-accounts-modal #progress-bar-container li:hover::before {
        border: 2px solid #fff;
        background-color: #32243d;
    }

    #import-accounts-modal #progress-bar-container li {
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

    #import-accounts-modal .btn-primary:disabled {
        color: #fff !important;;
        background-color: #ccc !important;
        border: 1px solid transparent !important;;
    }

    #import-accounts-modal .tbl { border-collapse: collapse;}
    #import-accounts-modal .tbl th, .tbl td { padding: 2px; border: solid 1px #777; }
    #import-accounts-modal .tbl th { background-color: lightblue; }
    #import-accounts-modal .tbl-separate { border-collapse: separate; border-spacing: 5px;}

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
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/accounting'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/chart_of_accounts_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When you create your company file, our accounting software automatically customizes your chart of accounts based on your industry. You can add more accounts any time you need to track other types of transactions. It is very simple to add more accounts to your chart of accounts. Structuring and setting up the chart of accounts will eliminate the guesswork which in-turn can help run your business smoothly.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/chart-of-accounts') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Filter by name" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">

                            <div class="dropdown d-inline-block">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>                              
                                </ul>
                            </div>                        
           
                            <div class="btn-group nsm-main-buttons" style="margin-bottom: 5px;">
                                <button type="button" class="btn btn-nsm" id="add-account-button"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Chart of Accounts</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-group-modal">Tag group</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-modal">Tag</a></li>                                                                
                                </ul>
                            </div>            
                            
                            
                            

                        
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                            <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                        </button>           
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                            <div class="row">
                                <div class="col">
                                    <label for="filter-type">Type</label>
                                    <select class="nsm-field form-select filter-coa-type" name="filter_type" id="filter-coa-type">            
                                        <option value="all" <?=$type == 'all' ? 'selected' : ''?>>All</option>
                                        <option value="1" <?=$type == '1' ? 'selected' : ''?>>Accounts receivable (A/R)</option>
                                        <option value="2" <?=$type == '2' ? 'selected' : ''?>>Other Current Assets</option>
                                        <option value="3" <?=$type == '3' ? 'selected' : ''?>>Bank</option>
                                        <option value="4" <?=$type == '4' ? 'selected' : ''?>>Fixed Assets</option>
                                        <option value="5" <?=$type == '5' ? 'selected' : ''?>>Other Assets</option>
                                        <option value="6" <?=$type == '6' ? 'selected' : ''?>>Accounts payable (A/P)</option>
                                        <option value="7" <?=$type == '7' ? 'selected' : ''?>>Credit Card</option>
                                        <option value="8" <?=$type == '8' ? 'selected' : ''?>>Other Current Liabilities</option>
                                        <option value="9" <?=$type == '9' ? 'selected' : ''?>>Long Term Liabilities</option>
                                        <option value="10" <?=$type == '10' ? 'selected' : ''?>>Equity</option>
                                        <option value="11" <?=$type == '11' ? 'selected' : ''?>>Income</option>
                                        <option value="12" <?=$type == '12' ? 'selected' : ''?>>Other Income</option>
                                        <option value="13" <?=$type == '13' ? 'selected' : ''?>>Cost of Goods Sold</option>
                                        <option value="14" <?=$type == '14' ? 'selected' : ''?>>Expenses</option>
                                        <option value="15" <?=$type == '15' ? 'selected' : ''?>>Other Expenses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="filter-type">Status</label>
                                    <select class="nsm-field form-select filter-coa-status" name="filter_status" id="filter-coa-status">   
                                        <option value="all" <?=$status == 'all' ? 'selected' : ''?>>All</option>         
                                        <option value="active" <?=$status == 'active' ? 'selected' : ''?>>Active</option>
                                        <option value="inactive" <?=$status == 'inactive' ? 'selected' : ''?>>Inactive</option>>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="filter-detail-type">Detail Type</label>
                                    <select class="nsm-field form-select filter-coa-detail-type" name="filter_detail_type" id="filter-coa-detail-type">   
                                        <option value="all" <?=$detail_type_id == 'all' ? 'selected' : ''?>>All</option>         
                                        <?php foreach($acc_details_types as $acc_details_type) {?>
                                            <option value="<?php echo $acc_details_type->acc_detail_id; ?>" <?php echo $detail_type_id == $acc_details_type->acc_detail_id ? 'selected' : ''?>><?php echo $acc_details_type->acc_detail_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="nsm-button reset-button" id="reset-button">
                                        Reset
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="nsm-button primary float-end" id="apply-filter-coa-button">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </ul> 

                        <!-- <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
                            </ul>
                        </div> -->

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#import-accounts-modal">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button" id="add-account-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
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
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_detail_type" class="form-check-input">
                                    <label for="chk_detail_type" class="form-check-label">Detail Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_nsmartrac_balance" class="form-check-input">
                                    <label for="chk_nsmartrac_balance" class="form-check-label">nSmarTrac Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_bank_balance" class="form-check-input">
                                    <label for="chk_bank_balance" class="form-check-label">Bank Balance</label>
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
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">10</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>
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
                <table class="nsm-table" id="accounts-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Detail Type">DETAIL TYPE</td>
                            <td data-name="nSmarTrac Balance">NSMARTRAC BALANCE</td>
                            <td data-name="Bank Balance">BANK BALANCE</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($accounts) > 0) : ?>
                        <?php foreach($accounts as $account) : ?>
                        <tr data-status="<?=$account['status']?>">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$account['id']?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default" <?php if($account['status'] === "1" && !in_array($account['type'], ['Income', 'Cost of Goods Sold', 'Expenses', 'Other Income', 'Other Expense'])) : ?>onclick="location.href='<?php echo base_url('accounting/chart-of-accounts/view-register/'.$account['id']) ?>'" <?php endif; ?>><?=$account['name']?></td>
                            <td><?=$account['type']?></td>
                            <td><?=$account['detail_type']?></td>
                            <td><?=$account['nsmartrac_balance']?></td>
                            <td><?=$account['bank_balance']?></td>
                            <td><?=$account['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($account['type'] === 'Bank') : ?>
                                        <li>
                                            <a class="dropdown-item" href="#">Connect bank</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if($account['status'] === "1") : ?>
                                        <?php if(!in_array($account['type'], ['Income', 'Cost of Goods Sold', 'Expenses', 'Other Income', 'Other Expense'])) : ?>
                                        <li>
                                            <a class="dropdown-item" href="#">View Register</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item edit-account" href="#">Edit</a>
                                        </li>
                                        <?php endif;?>
                                        <li>
                                            <a class="dropdown-item delete-account" data-id="<?= $account['id']; ?>" href="javascript:void(0);">Delete</a>
                                        </li>
                                        <li>
                                            <?php $is_status = $account['status'] === '0' ? 'make-active' : 'make-inactive'; ?>
                                            <a class="dropdown-item <?=$account['status'] === '0' ? 'make-active' : 'make-inactive'?>" onClick="javascript:makeActiveInactive('<?php echo $is_status; ?>','<?php echo $account['id']; ?>'); " href="#"><?=$account['status'] === '0' ? 'Make active' : 'Make inactive (reduces usage)'?></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Run report</a>
                                        </li>
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
    $('.delete-account').on('click', function(){
        var caid = $(this).attr('data-id');

        Swal.fire({
            title: 'Chart of Accounts',
            html: `Proceed with deleting selected data?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "accounting/chart-of-accounts/delete",
                    data: {ebid:ebid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email Broadcast was successfully deleted.',
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
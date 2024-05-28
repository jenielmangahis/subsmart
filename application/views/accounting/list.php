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
    .step:hover{
        cursor:default !important;
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
    .vendor-name, .vendor-company-name{
        display:block;
    }
    .vendor-company-name{
        font-size:11px;
    }
    .custom-btn{
        width:100%;
        margin-bottom:10px;
        font-size:16px;
        display:block;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Accounting Lists.
                        </div>
                    </div>
                </div>    
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/chart-of-accounts'); ?>">Chart of accounts</a></h5>
                        <p>Displays your accounts. Balance sheet accounts track your assets and liabilities, and income and expense accounts categorize your transactions. From here, you can add or edit accounts.</p>
                    </div>
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/payment-methods'); ?>">Payment Methods</a></h5>
                        <p>Displays Cash, Check, and any other ways you categorize payments you receive from customers. That way, you can print deposit slips when you deposit the payments you have received.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/recurring-transactions'); ?>">Recurring Transactions</a></h5>
                        <p>Displays a list of transactions that have been saved for reuse. From here, you can schedule transactions to occur either automatically or with reminders. You can also save unscheduled transactions to use at any time.</p>
                    </div>
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/terms'); ?>">Terms</a></h5>
                        <p>Displays the list of terms that determine the due dates for payments from customers, or payments to vendors. Terms can also specify discounts for early payment. From here, you can add or edit terms.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/products-and-services'); ?>">Products and Services</a></h5>
                        <p>Displays the products and services you sell. From here, you can edit information about a product or service, such as its description, or the rate you charge.</p>
                    </div>
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/attachments'); ?>">Attachments</a></h5>
                        <p>Displays the list of all attachments uploaded. From here you can add, edit, download, and export your attachments. You can also see all transactions linked to a particular attachment.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="ml-5"><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/product-categories'); ?>">Product Categories</a></h5>
                        <p class="ml-5">A means of classifying items that you sell to customers. Provide a way for you to quickly organize what you sell, and save you time when completing sales transaction forms.</p>
                    </div>
                    <div class="col-md-6">
                        <h5><a class="nsm nsm-button primary custom-btn" href="<?= base_url('accounting/tags'); ?>">Tags</a></h5>
                        <p>Displays the list of all tags created. You can add, edit, and delete your tags here.</p>
                    </div>
                </div>
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
    }); 
});
</script>
<?php include viewPath('v2/includes/footer'); ?>

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/mycrm/membership_modals'); ?>
<style>
.view_pdf_container{
    display: flex;
}
.view_pdf{
    border: 1px solid #615c5c;
    border-radius: 5px;
    padding: 1em;
    height: 100%;
    font-weight: bold;
    background: transparent;
    display: block;
    text-align: center;
    color: #000;
    text-decoration: none;
    width: 200px;
}

@media screen and (max-width: 567px) {
    .view_pdf_container{
        display: block;
    }
    .view_pdf{
        width: 100%;
        margin-bottom: 10px;
        height: unset !important;
    }
}
</style>
<div class="row page-content g-0">
<div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Transactions shown here are not for the entire party. Visiblity of all transactions
                            is available for the account owner.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 view_pdf_container">
                        <a class="view_pdf" href="<?php echo url('mycrm/pdf_statement/'.$lastPayment->id); ?>" target="_new" style="margin-right: 10px;">View PDF Statement</a>
                        <a class="view_pdf" href="<?php echo url('mycrm/orders/'.$lastPayment->id); ?>" target="_new" style="margin-right: 10px;">View Previous Statement</a>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Transaction</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Available Balance</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <h1 style="font-weight: 700;color: #6a4a86;">$<?php echo number_format($lastPayment->total_amount, 2); ?></h1>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-12 col-md-6">
                        <label class="fw-bold fs-5">Activities</label>
                    </div>
                  
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Order Number">Order Number</td>
                            <td data-name="Details">Details</td>
                            <td data-name="Date Added">Date Added</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($payments)) {
                            ?>
                            <?php
                                foreach ($payments as $p) {
                                    ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-cart-alt'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="d-block fw-bold nsm-link default" onclick="location.href='<?php echo url('mycrm/view_payment/'.$p->id); ?>'"><?php echo $p->order_number; ?></label>
                                    </td>
                                    <td><?php echo $p->description; ?></td>
                                    <td><?php echo date('d/M/Y g:i A', strtotime($p->date_created)); ?></td>
                                    <td>$<?php echo number_format($p->total_amount, 2); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" name="dropdown_view" href="<?php echo base_url('mycrm/view_payment/'.$p->id); ?>">View</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        <?php
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
?>
                    </tbody>
                </table>
                                                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>

<?php include viewPath('v2/includes/footer'); ?>
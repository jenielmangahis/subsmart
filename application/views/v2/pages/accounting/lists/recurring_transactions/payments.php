<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/recurring_transaction_payments_modals'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/recurring_transactions'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A recurring transaction is an agreement between a cardholder and a company providing goods/services that essentially authorizes the charging of periodic, automatic payments during a set amount of time.  The transaction can be charged on a weekly, monthly, or yearly basis.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_recurring_transaction_payments_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">10</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">25</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>                                        
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="transactions-table">
                    <thead>
                        <tr>
                            <td data-name="Payee" style="width:70%;">PAYEE</td>
                            <td data-name="Type" style="width:10%;">TYPE</td>
                            <td data-name="PaymentDate" style="width:10%;">PAYMENT DATE</td>
                            <td data-name="Amount" style="width:15%;text-align:right;">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($recurringPayments) > 0) { ?>
						    <?php foreach($recurringPayments as $rp) { ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $rp->payee; ?></td>
                                    <td class="nsm-text-primary"><?= ucwords(strtolower($rp->txn_type)); ?></td>
                                    <td><?= date("m/d/Y", strtotime($rp->payment_date)); ?></td>
                                    <td style="text-align:right;">$<?= number_format($rp->amount, 2,".",","); ?></td>
                                </tr>
                            <?php } ?>                        
                        <?php }else{ ?>						
						<tr>
							<td colspan="14">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));
});
</script>
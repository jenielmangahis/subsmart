<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/payment_methods_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The many methods of payment are Ach, Cash, Check, Credit, and payment-in-kind (or bartering). These methods are used in basic transactions; for example, one may pay for a product or services with cash, a credit card, or theoretically even by trading another person for other trade services for the equivalent value.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/payment-methods') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find by Name" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-file'></i> Run Report
                            </button>
                            <button type="button" class="nsm-button" id="add-payment-method-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_payment_methods_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="col_credit" class="form-check-input">
                                    <label for="col_credit" class="form-check-label">Credit Card</label>
                                </div>
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" id="inc_inactive" class="form-check-input" <?=$inactive ? 'checked' : ''?>>
                                    <label for="inc_inactive" class="form-check-label">Include inactive</label>
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
                <table class="nsm-table" id="payment-methods-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Credit Card">CREDIT CARD</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($methods) > 0) : ?>
						<?php foreach($methods as $method) : ?>
                        <tr data-id="<?=$method['id']?>">
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$method['name']?></td>
                            <td>
                                <?php if($method['credit_card'] === "1") : ?>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">Run report</a>
                                        </li>
                                        <?php if($method['status'] === "1" || $method['status'] === 1) : ?>
                                        <li>
                                            <a class="dropdown-item edit-payment-method" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item make-inactive" href="#">Make inactive</a>
                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a class="dropdown-item make-active" href="#">Make active</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="14">
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

<?php include viewPath('v2/includes/footer'); ?>
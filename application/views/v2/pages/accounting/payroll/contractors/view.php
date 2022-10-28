<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_contractor_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0" id="contractor-display-name"><?=$contractor->display_name?></h3>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <?php if($contractor->status === '0') : ?>
                                            <button type="button" class="nsm-button" id="make-active" onclick="location.href='<?=base_url('/accounting/contractors/set-status/'.$contractor->id.'/active')?>'">
                                                Make Active
                                            </button>
                                            <?php else : ?>
                                            <button type="button" class="nsm-button" id="make-inactive" onclick="location.href='<?=base_url('/accounting/contractors/set-status/'.$contractor->id.'/inactive')?>'">
                                                Make Inactive
                                            </button>

                                            <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown">
                                                <span>Actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item" id="write-check">Write check</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="create-expense">Create expense</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="create-bill">Create bill</a>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="false">
                                                Details
                                            </button>
                                            <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab" data-bs-target="#nav-payments" type="button" role="tab" aria-controls="nav-payments" aria-selected="true">
                                                Payments
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                            <div class="nsm-card primary">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4 class="float-start">Personal Details</h4>
                                                        <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#edit-contractor-modal"><i class="bx bx-fw <?=in_array($contractor->contractor_type_id, ['', null]) ? 'bx-plus' : 'bx-pencil'?>"></i></button>
                                                    </div>
                                                </div>
                                                <?php if($contractor->contractor_type_id !== null && $contractor->contractor_type_id !== "") : ?>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <h6>Contractor type</h6>
                                                        <h5>-</h5>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6><?=$contractor->contractor_type_id === "1" ? "Name" : "Business name" ?></h6>
                                                        <?php
                                                            if($contractor->contractor_type_id === "1") {
                                                                $name = $contractor->title !== "" ? $contractor->title : "";
                                                                $name .= ' '.$contractor->f_name;
                                                                $name .= $contractor->m_name !== "" ? " $contractor->m_name" : "";
                                                                $name .= ' '.$contractor->l_name;
                                                                $name .= $contractor->suffix !== "" ? " $contractor->suffix" : "";
                                                            } else {
                                                                $name = $contractor->company;
                                                            }
                                                        ?>
                                                        <h5><?=$name?></h5>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6>Display name</h6>
                                                        <h5><?=$contractor->display_name?></h5>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6><?=$contractor->contractor_type_id === "1" ? "Social Security number" : "Employer Identification number" ?></h6>
                                                        <h5><?=$contractor->tax_id ? $contractor->tax_id : '-'?></h5>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6>Email</h6>
                                                        <h5><?=$contractor->email?></h5>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6>Address</h6>
                                                        <h5>-</h5>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-payments" role="tabpanel" aria-labelledby="nav-payments-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                            <span>
                                                                Date: <?=empty($date) ? 'All' : str_replace('-', ' ', ucfirst($date))?>
                                                            </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" id="date-dropdown">
                                                            <li><a class="dropdown-item <?=empty($date) || $date === 'all' ? 'active' : ''?>" href="javascript:void(0);">All</a></li>
                                                            <li><a class="dropdown-item <?=!empty($date) && $date === 'this-month' ? 'active' : ''?>" href="javascript:void(0);">This month</a></li>
                                                            <li><a class="dropdown-item <?=!empty($date) && $date === 'last-3-months' ? 'active' : ''?>" href="javascript:void(0);">Last 3 months</a></li>
                                                            <li><a class="dropdown-item <?=!empty($date) && $date === 'last-12-months' ? 'active' : ''?>" href="javascript:void(0);">Last 12 months</a></li>
                                                            <li><a class="dropdown-item <?=!empty($date) && $date === 'year-to-date' ? 'active' : ''?>" href="javascript:void(0);">Year to date</a></li>
                                                        </ul>
                                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                            <span>
                                                                Type: <?=empty($type) ? 'All' : str_replace('-', ' ', ucfirst($type))?>
                                                            </span> <i class="bx bx-fw bx-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" id="type-dropdown">
                                                            <li><a class="dropdown-item <?=empty($type) || $type === 'all' ? 'active' : ''?>" href="javascript:void(0);">All</a></li>
                                                            <li><a class="dropdown-item <?=!empty($type) && $type === 'check' ? 'active' : ''?>" href="javascript:void(0);">Check</a></li>
                                                            <li><a class="dropdown-item <?=!empty($type) && $type === 'expense' ? 'active' : ''?>" href="javascript:void(0);">Expense</a></li>
                                                            <li><a class="dropdown-item <?=!empty($type) && $type === 'bill-payment' ? 'active' : ''?>" href="javascript:void(0);">Bill payment</a></li>
                                                        </ul>
                                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                            <span>
                                                                Payment method: <?=empty($method) ? 'All' : str_replace('-', ' ', ucfirst($method))?>
                                                            </span> <i class="bx bx-fw bx-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" id="method-dropdown">
                                                            <li><a class="dropdown-item <?=empty($method) || $method === 'all' ? 'active' : ''?>" href="javascript:void(0);">All</a></li>
                                                            <li><a class="dropdown-item <?=!empty($method) && $method === 'check' ? 'active' : ''?>" href="javascript:void(0);">Check</a></li>
                                                            <li><a class="dropdown-item <?=!empty($method) && $method === 'direct-deposit' ? 'active' : ''?>" href="javascript:void(0);">Direct deposit</a></li>
                                                            <li><a class="dropdown-item <?=!empty($method) && $method === 'other' ? 'active' : ''?>" href="javascript:void(0);">Other</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 grid-mb">
                                                    <h4><?=count($payments)?> payments found</h4>
                                                </div>
                                                <div class="col-12 col-md-6 grid-mb text-end">
                                                    <h4>Total: <?=str_replace('$-', '-$', '$'.number_format(floatval($paymentsTotal), 2, '.', ','))?></h4>
                                                </div>
                                            </div>
                                            <table class="nsm-table" id="payments-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Date">DATE</td>
                                                        <td data-name="Type">TYPE</td>
                                                        <td data-name="Payment method">PAYMENT METHOD</td>
                                                        <td data-name="Amount">AMOUNT</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($payments) > 0) : ?>
                                                    <?php foreach($payments as $payment) : ?>
                                                    <tr>
                                                        <td><?=$payment['date']?></td>
                                                        <td><?=$payment['type']?></td>
                                                        <td><?=$payment['payment_method']?></td>
                                                        <td><?=str_replace('$-', '-$', '$'.number_format($payment['amount'], 2, '.', ','))?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <tr>
                                                        <td colspan="4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/contractors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            See how easy paying and tracking contractors can be. This accounting features makes it easy to pay contractors today & W-2 employees tomorrow.  Get started by adding a Contractor.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/contractors') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find a contractor" value="<?=!empty($search) ? $search : ''?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
						<div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span><?=empty($status) || $status === 'active' ? 'Active' : ucfirst($status)?> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="status-filter" style="width: max-content">
                                <li><a class="dropdown-item <?=empty($status) || $status === 'active' ? 'active' : ''?>" href="javascript:void(0);" id="active">Active</a></li>
                                <li><a class="dropdown-item <?=!empty($status) && $status === 'inactive' ? 'active' : ''?>" href="javascript:void(0);" id="inactive">Inactive</a></li>
                                <li><a class="dropdown-item <?=!empty($status) && $status === 'all' ? 'active' : ''?>" href="javascript:void(0);" id="all">All</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-file'></i> Prepare 1099s
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#contractor-modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add a contractor
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-dollar-circle'></i> Pay contractors
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="contractors-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Last payment"></td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($contractors) > 0) : ?>
						<?php foreach($contractors as $contractor) : ?>
                        <tr data-id="<?=$contractor->id?>" data-name="<?=$contractor->display_name?>">
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/contractors/view/' . $contractor->id) ?>'"><?=$contractor->display_name?></td>
                            <td></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item edit-contractor" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-contractor" href="#">Delete</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item write-check" href="#">Write check</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-expense" href="#">Create expense</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-bill" href="#">Create bill</a>
                                        </li>
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
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
                            Get started by adding a worksite.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/worksites') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find a worksites" value="<?=!empty($search) ? $search : ''?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">

                        <!-- 
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>           
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Status</label>
                                        <select class="nsm-field form-select filter-contractor-status" name="filter_type" id="filter-contractor-status">  
                                            <option value="all" <?=$status == 'all' ? 'selected' : ''?>>All</option>          
                                            <option value="active" <?=$status == 'active' ? 'selected' : ''?>>Active</option>
                                            <option value="inactive" <?=$status == 'inactive' ? 'selected' : ''?>>Inactive</option>
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
                                        <button type="button" class="nsm-button primary float-end" id="apply-filter-contractor-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        -->

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#contractor-modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add Worksite
                            </button>

                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="worksite-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td style="width: 75%;" data-name="Address">ADDRESS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($worksites) > 0) : ?>
						<?php foreach($worksites as $worksite) : ?>
                        <tr data-id="<?=$worksite->id?>" data-name="<?=$worksite->name?>">
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php //echo base_url('accounting/contractors/view/' . $worksite->id) ?>'"><?= $worksite->name ?></td>
                            <td><?php echo $worksite->street . ", " . $worksite->city . ", " . $worksite->state . ", " . $worksite->zip_code; ?></td>
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

<script>

$(document).ready(function() {
    $('#apply-filter-contractor-button').on('click', function() {
        var filterType = $('.filter-contractor-status').val();            
        var url = `${base_url}accounting/worksites?`;
        url += filterType !== 0 ? `status=${filterType}&` : '';
        if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
            url = url.slice(0, -1); 
        }
        location.href = url;
    });
})

</script>

<?php include viewPath('v2/includes/footer'); ?>
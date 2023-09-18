<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath("v2/includes/accounting/reports/$modalsView"); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 20%">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="custom-report-name">Custom report name</label>
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Account List">
                                    </div>
                                    <div class="col-12">
                                        <label for="custom-report-group">Add this report to a group</label>
                                        <select name="custom_report_group" id="custom-report-group" class="nsm-field form-control"></select>
                                        <a href="#" class="text-decoration-none" id="add-new-custom-report-group">Add new group</a>
                                    </div>
                                    <div class="col-12 d-none">
                                        <form id="new-custom-report-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="custom-group-name">New group name</label>
                                                    <input type="text" class="nsm-field form-control" name="new_custom_group_name" id="custom-group-name">
                                                </div>
                                                <div class="col-4 d-flex align-items-end">
                                                    <button type="submit" class="nsm-button success">Add</button>
                                                    <button class="nsm-button" id="cancel-new-custom-report-group">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <label for="share-with">Share with</label>
                                        <select name="share_with" id="share-with" class="nsm-field form-control">
                                            <option value="all">All</option>
                                            <option value="none" selected>None</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="save-custom-report">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-auto">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" <?=empty($sort_by) || $sort_by === 'default' ? 'selected' : ''?>>Default</option>
                                                    <option value="account" <?=$sort_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="description" <?=$sort_by === 'description' ? 'selected' : ''?>>Description</option>
                                                    <option value="detail-type" <?=$sort_by === 'detail-type' ? 'selected' : ''?>>Detail Type</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="type" <?=$sort_by === 'type' ? 'selected' : ''?>>Type</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" value="asc" <?=!isset($sort_in) ? 'checked' : ''?>>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input" value="desc" <?=isset($sort_in) && $sort_in === 'desc' ? 'checked' : ''?>>
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button" id="<?=is_null($reportNote) ? 'add-notes' : 'edit-notes'?>">
                                                <?php if(is_null($reportNote) || empty($reportNote->notes)) : ?>
                                                <span>Add notes</span>
                                                <?php else : ?>
                                                <span>Edit notes</span>
                                                <?php endif; ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#email_report_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_report_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-account" class="form-check-input" <?=isset($columns) && in_array('Account', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-account" class="form-check-label">Account</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-type" class="form-check-input" <?=isset($columns) && in_array('Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-type" class="form-check-label">Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-detail-type" class="form-check-input" <?=isset($columns) && in_array('Detail Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-detail-type" class="form-check-label">Detail Type</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-create-date" class="form-check-input" <?=isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-created-by" class="form-check-input" <?=isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified" class="form-check-input" <?=isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified-by" class="form-check-input" <?=isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-description" class="form-check-input" <?=isset($columns) && in_array('Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-description" class="form-check-label">Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-balance" class="form-check-input" <?=isset($columns) && in_array('Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-balance" class="form-check-label">Balance</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row <?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                    <?php if(isset($show_logo)) : ?>
                                    <!-- <div class="position-absolute">
                                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px"/>
                                    </div> -->
                                    <?php endif; ?>
                                    <?php if(!isset($show_company_name)) : ?>
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_title)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="Type" <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>>TYPE</td>
                                            <td data-name="Detail Type" <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>>DETAIL TYPE</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Description" <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>>DESCRIPTION</td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($accounts) > 0) : ?>
                                        <?php foreach($accounts as $account) : ?>
                                        <tr>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$account['name']?></td>
                                            <td <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>><?=$account['type']?></td>
                                            <td <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>><?=$account['detail_type']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$account['create_date']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$account['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>><?=$account['description']?></td>
                                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$account['balance']?></td>
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
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000" class="nsm-field form-control mb-3" placeholder="Add notes or include additional info with your report"><?=!is_null($reportNote) ? str_replace("<br />", "", $reportNote->notes) : ''?></textarea>
                                        <label for="report-note">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?=is_null($reportNote) ? 'd-none' : ''?>" id="report-note-cont">
                                        <?php if(!is_null($reportNote) && !empty($reportNote->notes)) : ?>
                                        <p class="m-0"><b>Note</b></p>
                                        <span><?=str_replace("\n", "<br />", $reportNote->notes)?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-footer <?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <p class="m-0"><?=date($prepared_timestamp)?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?=$clients->business_name?>"
</script>
<?php include viewPath('v2/includes/footer'); ?>
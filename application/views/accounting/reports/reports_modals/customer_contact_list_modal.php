<form method="POST" action="<?= base_url('/accounting/reports/view-report/'.$reportTypeId); ?>">
    <div class="modal right fade" id="customizeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="customizeModalLabel">Customize Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rwcl">
                        <h6 onclick="rwcl()" class="czLabel" id="rcDownArrow"><i class='bx bx-fw bxs-down-arrow'></i>Rows/Columns</h6>
                        <h6 onclick="rwcl()" class="czLabel" id="rcRightArrow"><i class='bx bx-fw bxs-right-arrow'></i>Rows/Columns</h6>
                        <div class="col-lg-12 groupby" id="groupby">
                            <h6>Group by</h6>
                            <div class="col-lg-6">
                                <select name="sort_by" id="sort_by" class="nsm-field form-select">
                                    <option value="">Default</option>
                                    <option value="city">Billing City</option>
                                    <option value="state">Billing State</option>
                                    <option value="street">Billing Street</option>
                                    <option value="zip">Billing ZIP</option>
                                </select>
                            </div>
                            <h6 class="change-col" onclick="ccl()">Change Columns</h6>
                            <div class="changeCol" id="changeCol">
                                <h6 class="fw-bold">Select and reorder columns</h6>
                                <?php foreach(customCols() as $customCols) : ?>
                                <div class="form-check">
                                    <input type="checkbox" id="sort-asc" name="customer[]" class="form-check-input" value="<?= $customCols['description'] ?>">
                                    <label for="sort-asc" class="form-check-label"><?= $customCols['name'] ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="f row">
                        <h6 onclick="filter()" class="czLabel" id="fRightArrow"><i class='bx bx-fw bxs-right-arrow'></i>Filter</h6>
                        <h6 onclick="filter()" class="czLabel" id="fDownArrow"><i class='bx bx-fw bxs-down-arrow'></i>Filter</h6>
                        <div class="row filter" id="filter">
                            <div class="row">
                                <div class="col-7">
                                    <input type="checkbox" id="checkCustomer1">
                                    <label class="form-check-label">Customer</label>
                                </div>
                                <div class="col-5">
                                    <button type="button" class="nsm-button block" data-bs-toggle="dropdown">
                                        <span>All</span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <div class="form-check">
                                            <input type="checkbox" id="sort-asc" name="fl_customer[]" value="*" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label">All</label>
                                        </div>
                                        <?php foreach($customer as $resCustomer) : ?>
                                        <div class="form-check">
                                            <input type="checkbox" onchange="checkCustomer()" name="fl_customer[]" value="<?= $resCustomer->prof_id ?>" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label"><?= $resCustomer->last_name ?></label>
                                        </div>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-7">
                                    <input type="checkbox" id="checkType1">
                                    <label class="form-check-label">Customer Type</label>
                                </div>
                                <div class="col-5">
                                    <button type="button" class="nsm-button block" data-bs-toggle="dropdown">
                                        <span>All</span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <div class="form-check">
                                            <input type="checkbox" onchange="checkType()" name="fl_type[]" value="*" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label">All</label>
                                        </div>
                                        <?php foreach($customerType as $resCustType) : 
                                            if($resCustType->customer_type == NULL) {
                                                continue;
                                            }else{
                                            ?>
                                        <div class="form-check">
                                            <input type="checkbox" onchange="checkType()" name="fl_type" value="<?= $resCustType->customer_type ?>" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label"><?= $resCustType->customer_type ?></label>
                                        </div>
                                        <?php } endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <input type="checkbox" id="checkStatus1">
                                    <label class="form-check-label">Status</label>
                                </div>
                                <div class="col-lg-5">
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                        <span>All</span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <div class="form-check">
                                            <input type="checkbox" onchange="checkStatus()" id="sort-asc" name="fl_status[]" value="*" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label">All</label>
                                        </div>
                                        <?php foreach($status as $resStat) :
                                            if($resStat->status == NULL) {
                                                continue;
                                            }else{
                                            ?>
                                        <div class="form-check">
                                            <input type="checkbox" onchange="checkStatus()" name="fl_status[]" value="<?= $resStat->status ?>" class="form-check-input">
                                            <label for="sort-asc" class="form-check-label"><?= $resStat->status ?></label>
                                        </div>
                                        <?php }
                                    endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hf2">
                        <h6 onclick="hf()" class="czLabel" id="hfRightArrow"><i class='bx bx-fw bxs-right-arrow'></i>Header/Footer</h6>
                        <h6 onclick="hf()" class="czLabel" id="hfDownArrow"><i class='bx bx-fw bxs-down-arrow'></i>Header/Footer</h6>
                        <div class="hf" id="hf">
                            <h6 class="fw-bold" style="margin-top: 20px;">Header</h6>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isLogo" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Show Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="changeCompany1" name="header[]" value="isCompany" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Company Name</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" onchange="changeCompany()" value="<?=$clients->business_name?>" name="header[company]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="changeReport1" name="header[]" value="isReport" class="form-check-input" >
                                        <label for="sort-asc" class="form-check-label">Report Title</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="sort-asc" onchange="changeReport()" name="header[report]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h6 class="fw-bold" style="margin-top: 20px;">Footer</h6>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isDate" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Date Prepared</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isTime" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Time Prepared</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="nsm-button success">Run Report</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include viewPath('v2/includes/accounting_header'); ?>

<style>

/*Customize Modal*/
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
        border-radius: 50px !important;
	}
        
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
	}
    .groupby {
        display: block;
        padding-left: 30px;
        transition: height 1s ease-in;
    }
    #rcRightArrow{
        display: none;
    }
    #rcDownArrow{
        display: inline;
        color: #6a4a86;
        font-weight: bold;
    }
    .rwcl{
        padding-top: 20px;
    }
    .rwcl h6{
        padding-top: 10px;
    }
    .change-col {
        color: blue;
        cursor: pointer;
    }
    .change-col:hover{
        text-decoration: underline !important;
    }
    .filter {
        display: none;
        padding-left: 30px;
        transition: height 1s ease-in;
    }
    #fDownArrow{
        display: none;
    }
    .f{
        padding-top: 20px;
    }
    .hf {
        display: none;
        padding-left: 30px;
        transition: height 1s ease-in;
    }
    #hfDownArrow{
        display: none;
    }
    .hf2{
        padding-top: 20px;
    }
    .changeCol{
        display: none;
    }
    .czLabel {
        cursor: pointer;
    }
    .czLabel i {
        color: black !important;
        font-size: 13px;
    }
    
    

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes, #checkboxes1 {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label, #checkboxes1 label {
  display: block;
}

#checkboxes label:hover, #checkboxes1 label:hover {
  background-color: #1e90ff;
}
</style>

<div class="row page-content g-0" id="container">
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
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <p class="m-0">Rows/columns</p>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-group-by">Group by</label>
                                        <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                            <option value="none" selected>None</option>
                                            <option value="shipping-city">Shipping City</option>
                                            <option value="shipping-state">Shipping State</option>
                                            <option value="shipping-zip">Shipping ZIP</option>
                                            <option value="city">Billing City</option>
                                            <option value="state">Billing State</option>
                                            <option value="zip">Billing ZIP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="nsm-button primary">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <a type="button" class="nsm-button demo" data-bs-toggle="modal" data-bs-target="#customizeModal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </a>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                        </div>
                    </div>
                </div>

                <!-- customize-modal -->
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
                                                <option value="default">Default</option>
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

                <!-- end-customize-modal -->
                <div class="row g-3">
                    <div class="col-12 col-md-10 offset-md-1">
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
                                                    <option value="default" selected>Default</option>
                                                    <option value="billing-city">Billing City</option>
                                                    <option value="billing-country">Billing Country</option>
                                                    <option value="billing-state">Billing State</option>
                                                    <option value="billing-street">Billing Street</option>
                                                    <option value="billing-zip">Billing ZIP</option>
                                                    <option value="cc-expires">CC Expires</option>
                                                    <option value="company-name">Company Name</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="credit-card-num">Credit Card #</option>
                                                    <option value="customer-type">Customer Type</option>
                                                    <option value="delivery-method">Delivery Method</option>
                                                    <option value="email">Email</option>
                                                    <option value="first-name">First Name</option>
                                                    <option value="full-name">Full Name</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="last-name">Last Name</option>
                                                    <option value="note">Note</option>
                                                    <option value="other">Other</option>
                                                    <option value="payment-method">Payment Method</option>
                                                    <option value="phone">Phone</option>
                                                    <option value="resale-num">Resale #</option>
                                                    <option value="shipping-city">Shipping City</option>
                                                    <option value="shipping-country">Shipping Country</option>
                                                    <option value="shipping-state">Shipping State</option>
                                                    <option value="shipping-street">Shipping Street</option>
                                                    <option value="shipping-zip">Shipping ZIP</option>
                                                    <option value="tax-rate">Tax Rate</option>
                                                    <option value="taxable">Taxable</option>
                                                    <option value="terms">Terms</option>
                                                    <option value="website">Website</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" id="exportReport" name="exportReport">
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
                                                            <input type="checkbox" id="col-customer" class="form-check-input" checked>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-create-date" class="form-check-input">
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created-by" class="form-check-input">
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified" class="form-check-input">
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified-by" class="form-check-input">
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-phone" class="form-check-input">
                                                            <label for="col-phone" class="form-check-label">Phone</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-phone-numbers" class="form-check-input" checked>
                                                            <label for="col-phone-numbers" class="form-check-label">Phone Numbers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-email" class="form-check-input" checked>
                                                            <label for="col-email" class="form-check-label">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-full-name" class="form-check-input" checked>
                                                            <label for="col-full-name" class="form-check-label">Full Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-address" class="form-check-input" checked>
                                                            <label for="col-billing-address" class="form-check-label">Billing Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-address" class="form-check-input" checked>
                                                            <label for="col-shipping-address" class="form-check-label">Shipping Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-company-name" class="form-check-input">
                                                            <label for="col-company-name" class="form-check-label">Company Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-website" class="form-check-input">
                                                            <label for="col-website" class="form-check-label">Website</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-delivery-method" class="form-check-input">
                                                            <label for="col-delivery-method" class="form-check-label">Delivery Method</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-other" class="form-check-input">
                                                            <label for="col-other" class="form-check-label">Other</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-taxable" class="form-check-input">
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-tax-rate" class="form-check-input">
                                                            <label for="col-tax-rate" class="form-check-label">Tax Rate</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-resale-no" class="form-check-input">
                                                            <label for="col-resale-no" class="form-check-label">Resale #</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-credit-card-no" class="form-check-input">
                                                            <label for="col-credit-card-no" class="form-check-label">Credit Card #</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-cc-expires" class="form-check-input">
                                                            <label for="col-cc-expires" class="form-check-label">CC Expires</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-payment-method" class="form-check-input">
                                                            <label for="col-payment-method" class="form-check-label">Payment Method</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-terms" class="form-check-input">
                                                            <label for="col-terms" class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-customer-type" class="form-check-input">
                                                            <label for="col-customer-type" class="form-check-label">Customer Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-note" class="form-check-input">
                                                            <label for="col-note" class="form-check-label">Note</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-street" class="form-check-input">
                                                            <label for="col-billing-street" class="form-check-label">Billing Street</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-city" class="form-check-input">
                                                            <label for="col-billing-city" class="form-check-label">Billing City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-state" class="form-check-input">
                                                            <label for="col-billing-state" class="form-check-label">Billing State</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-zip" class="form-check-input">
                                                            <label for="col-billing-zip" class="form-check-label">Billing ZIP</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-country" class="form-check-input">
                                                            <label for="col-billing-country" class="form-check-label">Billing Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-street" class="form-check-input">
                                                            <label for="col-shipping-street" class="form-check-label">Shipping Street</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-city" class="form-check-input">
                                                            <label for="col-shipping-city" class="form-check-label">Shipping City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-state" class="form-check-input">
                                                            <label for="col-shipping-state" class="form-check-label">Shipping State</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-zip" class="form-check-input">
                                                            <label for="col-shipping-zip" class="form-check-label">Shipping ZIP</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-country" class="form-check-input">
                                                            <label for="col-shipping-country" class="form-check-label">Shipping Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-name" class="form-check-input">
                                                            <label for="col-last-name" class="form-check-label">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-first-name" class="form-check-input">
                                                            <label for="col-first-name" class="form-check-label">First Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?= ($head) ? $company_title : $clients->business_name; ?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="fw-bold"><?= ($head) ? $report_title : $page->title; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 nsm-card-content h-auto grid-mb" id="tbl_print_accounts_modal">
                                <?php
                                    if($tblDefault){
                                ?>
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Customer">CUSTOMER</td>
                                            <td data-name="Phone Numbers">PHONE NUMBERS</td>
                                            <td data-name="Email">EMAIL</td>
                                            <td data-name="Billing Address">BILLING ADDRESS</td>
                                            <td data-name="Shipping Address">SHIPPING ADDRESS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($acs_profile as $acsProfile) : ?>
                                        <tr>
                                            <td><?= $acsProfile->first_name.' '. $acsProfile->last_name ?></td>
                                            <td><?= $acsProfile->phone_h ?></td>
                                            <td><?= $acsProfile->email ?></td>
                                            <td>Test billing address</td>
                                            <td>Test shipping address</td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php }else{ ?>
                                <table class="nsm-table" id="exportTbl">
                                    <thead>
                                        <tr>
                                        <?php
                                        if(!empty($custExp)){
                                            foreach($custExp as $cust) : 
                                            
                                        ?>
                                            <td data-name="Customer"><?= custom($cust) ?></td>
                                        <?php 
                                            $col='';
                                            endforeach; 
                                        }else{?>
                                            <td data-name="Customer">CUSTOMER</td>
                                            <td data-name="Phone Numbers">PHONE NUMBERS</td>
                                            <td data-name="Email">EMAIL</td>
                                            <td data-name="Billing Address">STATUS</td>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($acs_profile as $acsProfile) : ?>
                                        <tr>
                                            <?php if(!empty($acsProfile->Empty)){ ?>
                                            <td><? echo $acsProfile->Empty ?></td>
                                            <?php }else{ ?>
                                            <?php if(array_key_exists('first_name', $acsProfile)) : ?>
                                                <td><?= ($acsProfile->first_name == null && !empty($acsProfile->first_name)) ? "N/A" : $acsProfile->first_name.' '. $acsProfile->last_name?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('state', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->state == null && !empty($acsProfile->state)) ? "N/A" : $acsProfile->state ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('phone_h', $acsProfile)) : ?>
                                                <td><?= ($acsProfile->phone_h == null) ? "N/A" : $acsProfile->phone_h ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('email', $acsProfile)) : ?>
                                                <td><?= ($acsProfile->email == null && !empty($acsProfile->email)) ? "N/A" : $acsProfile->email ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('status', $acsProfile)) : ?>
                                                <td><?= ($acsProfile->status == null && !empty($acsProfile->status)) ? "N/A" : $acsProfile->status ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('phone_h', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->notes == null && !empty($acsProfile->notes)) ? "N/A" : $acsProfile->notes ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('bill_start_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->bill_start_date == null && !empty($acsProfile->bill_start_date)) ? "N/A" : $acsProfile->bill_start_date ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('bill_end_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->bill_end_date == null && !empty($acsProfile->bill_end_date)) ? "N/A" : $acsProfile->bill_end_date ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('recurring_start_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->recurring_start_date == null && !empty($acsProfile->recurring_start_date)) ? "N/A" : $acsProfile->recurring_start_date ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('recurring_end_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->recurring_end_date == null && !empty($acsProfile->recurring_end_date)) ? "N/A" : $acsProfile->recurring_end_date ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('last_payment_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->last_payment_date == null && !empty($acsProfile->last_payment_date)) ? "N/A" : $acsProfile->last_payment_date ?></td>
                                            <?php endif; ?>
                                            <?php if(array_key_exists('next_billing_date', $acsProfile) && !empty($custExp)) : ?>
                                                <td><?= ($acsProfile->next_billing_date == null && !empty($acsProfile->next_billing_date)) ? "N/A" : $acsProfile->next_billing_date ?></td>
                                            <?php endif; ?>
                                            <?php } ?>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <?php  if($foot){?>
                                <p class="m-0"><?= $date_prepared ?> <?= $time_prepared ?></p>
                                <?php }else{?>
                                <p><?= date("l, F j, Y h:i A eP") ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/reports/reports_modals'); ?>
<?php include viewPath('v2/includes/footer'); ?>

<script type="text/javascript">
var expanded = false;

// var selectedHeader = [];

// $('input[name="header[]"]').change(function() { 
//     $('input[name="header[]"]').each(function() {
//         selectedHeader.push(this.value);
//     });
//     console.log(selectedHeader);
//  });

// $('#exportReport').click(function(e){
//     var rowCount = $('#exportTbl >tbody >tr').length;
//     var tblList = [];
//     $('#exportTbl tr').each(function() {
//         customerId = $(this).find("td:first").html();  
//         tblList.push(customerId);
// });
//     alert(tblList);
// })

$(document).ready(function () {  
    $('#exportReport').click(function () {  
        var row = $('#exportTbl >tbody >tr').length;

        var header = [];  
        var customerData = [];  
        var bRowStarted = true;  
        $('#exportTbl thead>tr').each(function () {  
            $('td', this).each(function () {  
                if (header.length == 0 || bRowStarted == true) {  
                    header.push($(this).text());  
                    bRowStarted = false;  
                }  
                else  
                header.push($(this).text());  
            });  
            bRowStarted = true;  
        }); 
        $('#exportTbl tbody>tr').each(function () {  
            $('td', this).each(function () {  
                if (customerData.length == 0 || bRowStarted == true) {  
                    customerData.push($(this).text());  
                    bRowStarted = false;  
                }  
                else  
                customerData.push($(this).text());  
            });  
            bRowStarted = true;  
        });  

        let dataTbl = [];
        var rowCount = header.length * row; 
        for(var x=0; x<=customerData.length; x++){
            dataTbl.push([]);

            for(var i=0; i<header.length; i++){
                dataTbl[x][i] = customerData[0];
                customerData.shift();
            }
        }
        console.log(dataTbl);
        console.log(JSON.stringify(dataTbl));
        var test = JSON.stringify(dataTbl);
        fetch('<?= base_url('reports/export_report/') ?>', {
                method: 'POST',
                body: test,
                headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
            }) .then(response => response.json() ).then(response => {
                
            }).catch((error) => {
                console.log('Error:', error);
            }); 
    });  
});  
function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
function showCheckboxes1() {
  var checkboxes = document.getElementById("checkboxes1");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
    function printTbl(){
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head>');
 
        var table_style = document.getElementById("head").innerHTML;
        printWindow.document.write(table_style);
        printWindow.document.write('</head>');

        printWindow.document.write('<body>');
        var divContents = document.getElementById("tbl_print_accounts_modal").innerHTML;
        alert(divContents);
        printWindow.document.write('<div>');
        printWindow.document.write(divContents);
        printWindow.document.write('</div>');
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        window.print();

        
    }
    function rwcl() {
        var x = document.getElementById("groupby");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");

        rcright.style.color = "#6a4a86";
        rcdown.style.color = "#6a4a86";
        fright.style.color = "black";
        fdown.style.color = "black";
        hfright.style.color = "black";
        hfdown.style.color = "black";

        fright.classList.remove("fw-bold");
        fdown.classList.remove("fw-bold");
        hfright.classList.remove("fw-bold");
        hfdown.classList.remove("fw-bold");

        if (x.style.display === "block") {
            x.style.display = "none";
            rcdown.style.display = "none";
            rcright.style.display = "inline";
            rcright.classList.add("fw-bold");
            
        } else {
            x.style.display = "block";
            rcdown.style.display = "inline";
            rcright.style.display = "none";
            rcdown.classList.add("fw-bold");

        }
    }
    function filter() {
        var x = document.getElementById("filter");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");

        fright.style.color = "#6a4a86";
        fdown.style.color = "#6a4a86";
        rcright.style.color = "black";
        rcdown.style.color = "black";
        rcdown.style.fontWeight = "normal";
        rcright.style.fontWeight = "normal";
        hfright.style.color = "black";
        hfdown.style.color = "black";

        hfright.classList.remove("fw-bold");
        hfdown.classList.remove("fw-bold");
        rcright.classList.remove("fw-bold");
        rcdown.classList.remove("fw-bold");

        if (x.style.display === "none") {
            x.style.display = "block";
            fdown.style.display = "inline";
            fright.style.display = "none";
            fdown.classList.add("fw-bold");
        } else {
            x.style.display = "none";
            fdown.style.display = "none";
            fright.style.display = "inline";
            fright.classList.add("fw-bold");
        }
    }
    function hf() {
        var x = document.getElementById("hf");
        var hfright = document.getElementById("hfRightArrow");
        var hfdown = document.getElementById("hfDownArrow");
        var fright = document.getElementById("fRightArrow");
        var fdown = document.getElementById("fDownArrow");
        var rcright = document.getElementById("rcRightArrow");
        var rcdown = document.getElementById("rcDownArrow");

        hfright.style.color = "#6a4a86";
        hfdown.style.color = "#6a4a86";
        fright.style.color = "black";
        fdown.style.color = "black";
        rcright.style.color = "black";
        rcdown.style.color = "black";
        rcdown.style.fontWeight = "normal";
        rcright.style.fontWeight = "normal";

        fright.classList.remove("fw-bold");
        fdown.classList.remove("fw-bold");
        rcright.classList.remove("fw-bold");
        rcdown.classList.remove("fw-bold");

        if (x.style.display === "block") {
            x.style.display = "none";
            hfdown.style.display = "none";
            hfright.style.display = "inline";
            hfright.classList.add("fw-bold");
        } else {
            x.style.display = "block";
            hfdown.style.display = "inline";
            hfright.style.display = "none";
            hfdown.classList.add("fw-bold");
        }
    }
    function ccl() {
        var x = document.getElementById("changeCol");
        
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function checkCustomer(){
        document.getElementById("checkCustomer1").checked = true;    
    }
    function checkType(){
        document.getElementById("checkType1").checked = true;    
    }
    function checkStatus(){
        document.getElementById("checkStatus1").checked = true;    
    }

    function changeCompany(){
        document.getElementById("changeCompany1").checked = true;    
    }
    function changeReport(){
        document.getElementById("changeReport1").checked = true;    
    }
</script>

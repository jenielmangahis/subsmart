<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }

    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }

    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }

    .btn-transparent {
        color: #6B6C72 !important;
    }

    .btn-transparent:focus {
        border-color: #6B6C72 !important;
    }

    .action-bar .dropdown-menu a:hover {
        background: none !important;
    }

    #transactions-table .btn-group .btn:hover,
    #transactions-table .btn-group .btn:focus {
        color: #38a4f8 !important;
    }

    #transactions-table .btn-group .btn.dropdown-toggle:hover,
    #transactions-table .btn-group .btn.dropdown-toggle:focus {
        color: unset !important;
    }

    #transactions-table .btn-group .btn {
        padding: 10px;
    }

    #transactions-table .view-attachment:hover {
        background-color: #365ebf;
        color: #fff;
    }
    #myTabContent .action-bar ul li a:after {
        width: 0;
    }
    #myTabContent .action-bar ul li a {
    font-size: 20px;
    }
    #myTabContent .action-bar ul li {
        margin-right: 5px;
    }
	#myTabContent .action-bar ul li .dropdown-menu a {
		font-size: 14px;
	}
    #transactions-table .badge {
        padding: .25em .4em;
        line-height: 1;
        font-weight: 600;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Transactions by tag</h3>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">An expense is generally anything that your company
                                            spends money on to keep it up and running. Examples of expenses are rent,
                                            phone bills, website hosting fees, office supplies, accountant fees, trash
                                            service, janitorial fees, etc. Simply click new transaction and you will see
                                            you will see a list of options to chose from. Once you choose the type of
                                            transactions; just enter the information and click save new.</span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/tags" class="text-info">All Tags</a></h6>
                                </div>
                            </div>
                        </div>
                        <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6 pb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                                    <a href="javascript:void(0);" class="btn btn-transparent dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fa fa-filter"></span> Filter
                                                    </a>

                                                    <div class="dropdown-menu p-3" id="filter-dropdown" aria-labelledby="filterDropdown" style="width: 650px">
                                                        <div class="inner-filter-list">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <div class="form-group">
                                                                                <label for="type">Type</label>
                                                                                <select id="type" class="form-control">
                                                                                    <option value="all" selected>All transactions</option>
                                                                                    <option value="money-in">Money In</option>
                                                                                    <option value="money-out">Money Out</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="date">Date</label>
                                                                        <select id="date" class="form-control">
                                                                            <option value="all">All dates</option>
                                                                            <option value="today">Today</option>
                                                                            <option value="yesterday">Yesterday</option>
                                                                            <option value="this-week">This week</option>
                                                                            <option value="this-month">This month</option>
                                                                            <option value="this-quarter">This quarter</option>
                                                                            <option value="this-year">This year</option>
                                                                            <option value="last-week">Last week</option>
                                                                            <option value="last-month">Last month</option>
                                                                            <option value="last-quarter">Last quarter</option>
                                                                            <option value="last-year">Last year</option>
                                                                            <option value="last-365-days" selected>Last 365 days</option>
                                                                            <option value="custom">Custom</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="from-date">From</label>
                                                                        <input type="text" id="from-date" class="form-control datepicker" value="<?=date("m/d/Y", strtotime("-1 year"))?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="to-date">To</label>
                                                                        <input type="text" id="to-date" class="form-control datepicker" value="<?=date("m/d/Y")?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="by-contact">By Contact</label>
                                                                        <select id="by-contact" class="form-control"></select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="btn-group d-block">
                                                                <a href="#" class="btn-main" onclick="resetfilters()">Reset Filters</a>
                                                                <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                                    <a href="javascript:void(0);" class="btn btn-transparent dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fa fa-tag"></span> Tags
                                                    </a>

                                                    <div class="dropdown-menu p-3" id="tags-filter-dropdown" aria-labelledby="filterDropdown" style="max-width: 650px">
                                                        <div class="inner-filter-list">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="checkbox checkbox-sec d-block my-2">
                                                                        <input type="checkbox" id="untagged" <?=$untagged ? 'checked' : ''?>>
                                                                        <label for="untagged">Show untagged transactions</label>
                                                                    </div>
                                                                </div>
                                                                <?php foreach($groups as $group) : ?>
                                                                <div class="col-12">
                                                                    <div class="form-group" >
                                                                        <label for="group-<?=$group['id']?>"><?=$group['name']?></label>
                                                                        <select id="group-<?=$group['id']?>" class="form-control" multiple="multiple">
                                                                            <option value="all-<?=$group['name']?>-tags">All <?=$group['name']?> tags</option>
                                                                            <?php foreach($group['tags'] as $tag) : ?>
                                                                            <option value="<?=$tag->id?>"><?=$tag->name?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="ungrouped">Ungrouped</label>
                                                                        <select id="ungrouped" class="form-control" multiple="multiple">
                                                                            <option value="all">All ungrouped tags</option>
                                                                            <?php foreach($ungrouped as $uTag) : ?>
                                                                                <option value="<?=$uTag->id?>"><?=$uTag->name?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="btn-group d-block">
                                                                <a href="#" class="btn-main" onclick="resettags()">Reset</a>
                                                                <a href="#" id="apply-btn" class="btn-main apply-btn m-auto" onclick="applybtn()">Apply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-table"><i class="fa fa-print"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <table id="transactions-table" class="table table-bordered table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex justify-content-center">
													<div class="checkbox checkbox-sec m-0">
                                                        <input type="checkbox" id="select-all-transactions">
														<label for="select-all-transactions" class="p-0" style="width: 24px; height: 24px"></label>
													</div>
												</div>
                                            </th>
                                            <th>DATE</th>
                                            <th>FROM/TO</th>
                                            <th>CATEGORY</th>
                                            <th>MEMO</th>
                                            <th>TYPE</th>
                                            <th>AMOUNT</th>
                                            <th>TAGS</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->


        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting');

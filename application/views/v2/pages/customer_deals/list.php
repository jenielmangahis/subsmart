<?php include viewPath('v2/includes/header'); ?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer_deals') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Customer deals are your ongoing conversations with people and organizations with whom you have already established a relationship.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-list-ul'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($customerDeals); ?></h2>
                                    <span>Total Deals</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bxs-flag-checkered'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="">$<?= number_format($sumAll->total_value, 2, ".", ","); ?></h2>
                                    <span>Total Amount</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bxs-flag-checkered'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="">$<?= number_format($sumWon->total_value, 2, ".", ","); ?></h2>
                                    <span>Total Amount Won</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter error h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-x-circle'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="">$<?= number_format($sumLost->total_value, 2, ".", ","); ?></h2>
                                    <span>Total Amount Lost</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 grid-mb">
                        <div class="btn-group view-style-container" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" id="btn-stage-view" class="btn btn-secondary btn-lg"><i class='bx bx-bar-chart-alt-2 bx-rotate-45'></i></button>
                            <button type="button" id="btn-list-view" class="btn btn-secondary btn-active btn-lg"><i class='bx bx-list-ul'></i></button>
                            <button type="button" id="btn-forecast-view" class="btn btn-secondary btn-lg"><i class='bx bx-dollar-circle'></i></button>
                            <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                            <button type="button" id="btn-archive" class="btn btn-secondary btn-lg"><i class='bx bx-box'></i></button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <input type="hidden" id="customer-deal-modal-name" value="" />   
                        <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-won" href="javascript:void(0);" data-action="pause">Won</a></li> 
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-lost" href="javascript:void(0);" data-action="pause">Lost</a></li>        
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-schedule-activity" href="javascript:void(0);" data-action="pause">Schedule Activity</a></li>                   
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-nsm" id="btn-new-deal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Deal</button>
                            <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class='bx bx-chevron-down' ></i></span>
                            </button>
                            <ul class="dropdown-menu">                                
                                <li><a class="dropdown-item" id="btn-add-new-lost-reason" href="javascript:void(0);">Add Lost Reason</a></li>        
                                <li><a class="dropdown-item" id="btn-export-customer-deals" href="javascript:void(0);">Export</a></li>                               
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>   
                <div class="row mt-2 mb-2">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div> 
                </div>
                <div class="row" id="deal-forecast">
                    <form id="frm-with-selected">
                        <table class="nsm-table" id="email-broadcast-list">
                        <thead>
                            <tr>
                                <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <?php } ?>
                                <td class="table-icon"></td>
                                <td data-name="DealTitle" style="width:50%;">Deal Title</td>
                                <td data-name="DealTitle" style="width:20%;">Owner</td>
                                <td data-name="ExpectedCloseDate">Expected Close Date</td>                            
                                <td data-name="Statue">Status</td>
                                <td data-name="Value" style="text-align:right;">Value</td>
                                <td data-name="Manage"  style="width:3%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( $customerDeals ){ ?>
                                <?php foreach($customerDeals as $deal){ ?>
                                    <tr>
                                        <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                                        <td>
                                            <input class="form-check-input row-select table-select" name="customerDeals[]" type="checkbox" value="<?= $deal->id; ?>">
                                        </td>
                                        <?php } ?>
                                        <td><i class="bx bx-list-ul"></i></td>
                                        <td><?= $deal->deal_title; ?></td>
                                        <td><?= $deal->FName . ' ' . $deal->LName; ?></td>
                                        <td><?= date("m/d/Y",strtotime($deal->expected_close_date)); ?></td>                                
                                        <td><?= $deal->status; ?></td>
                                        <td style="text-align:right">$<?= $deal->value; ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end">                                            
                                                    <li><a class="dropdown-item btn-view-customer-deals" href="javascript:void(0);" data-id="<?= $deal->id; ?>">View</a></li>
                                                    <li><a class="dropdown-item btn-view-activity-scheduled" href="javascript:void(0);" data-id="<?= $deal->id; ?>">Scheduled Activities</a></li>
                                                    <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                                                        <li><a class="dropdown-item btn-edit-customer-deals" href="javascript:void(0);" data-id="<?= $deal->id; ?>">Edit</a></li>
                                                        <?php if( $deal->status == 'New' ) { ?>
                                                            <li><a class="dropdown-item btn-won-customer-deals" href="javascript:void(0);" data-name="<?= $deal->deal_title; ?>" data-id="<?= $deal->id; ?>">Won</a></li>
                                                            <li><a class="dropdown-item btn-lost-customer-deals" href="javascript:void(0);" data-name="<?= $deal->deal_title; ?>" data-id="<?= $deal->id; ?>">Lost</a></li>
                                                        <?php }elseif( $deal->status == 'Won' ){ ?>                                                
                                                            <li><a class="dropdown-item btn-lost-customer-deals" href="javascript:void(0);" data-name="<?= $deal->deal_title; ?>" data-id="<?= $deal->id; ?>">Lost</a></li>
                                                        <?php }elseif( $deal->status == 'Lost' ){ ?>
                                                            <li><a class="dropdown-item btn-won-customer-deals" href="javascript:void(0);" data-name="<?= $deal->deal_title; ?>" data-id="<?= $deal->id; ?>">Won</a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                                                        <li><a class="dropdown-item btn-delete-customer-deals" href="javascript:void(0);" data-name="<?= $deal->deal_title; ?>" data-id="<?= $deal->id; ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <span>No results found.</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/customer_deals/modals'); ?>
<?php include viewPath('v2/pages/customer_deals/js/list'); ?>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<?php include viewPath('v2/includes/footer'); ?>
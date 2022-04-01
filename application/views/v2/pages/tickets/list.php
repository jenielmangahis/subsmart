<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('estimate') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Tickets" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Newest First</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-desc">Newest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-asc">Oldest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-desc">Accepted: newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-asc">Accepted: oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-asc">Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-desc">Number: Desc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-asc">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-desc">Amount: Highest</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
                                <i class='bx bx-fw bx-note'></i> Add Tickets
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
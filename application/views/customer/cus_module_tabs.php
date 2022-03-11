<style>
.nav-pills .nav-link.active {
    background-color: #32243d;
    color: #ffffff;
    font-size: 17px;
}
.cus-modules-tab .nav-link {
    border-radius: 0px !important;
    padding: 13px !important;
}
</style>
<ul class="cus-modules-tab nav nav-pills">
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $cust_active_tab == 'dashboard' ?   "active" : ''; ?> nav-link" href="<?= base_url('customer/module/'.$cus_id) ?>">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab" href="<?= base_url('esign/createTemplate'); ?> nav-link">Inventory</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $cust_active_tab == 'jobs' ?   "active" : ''; ?> nav-link" href="<?= base_url('customer/jobs_list/'.$cus_id) ?>">Jobs</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $cust_active_tab == 'workorders' ?   "active" : ''; ?> nav-link" href="<?= base_url('customer/workorders_list/'.$cus_id) ?>">Workorders</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $cust_active_tab == 'estimates' ?   "active" : ''; ?> nav-link" href="<?= base_url('customer/estimates_list/'.$cus_id); ?>">Estimates</a>
    </li>    
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'leadSource' ?   "active" : ''; ?> nav-link">Import/Audit</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'leadTypes' ?   "active" : ''; ?> nav-link">Tag Pending Report</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab" href="<?= base_url('esign/createTemplate') ?> nav-link">Send Letters</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'header' ?   "active" : ''; ?> nav-link">Dispute Items</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'header' ?   "active" : ''; ?> nav-link">Educate</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab" href="<?= base_url('eSign/manage?view=inbox') ?> nav-link">Messages</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab <?= $cust_active_tab == 'internal_notes' ?   "active" : ''; ?> nav-link" href="<?= base_url('customer/internal_notes/'.$cus_id); ?>">
        Internal Notes</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab"  href="<?= base_url('invoice') ?> nav-link">Invoices</a>
    </li>
    <li class="nav-item">
        <a class="h6 mb-0 nav-link banking-sub-tab" href="<?= base_url('timesheet/notification') ?> nav-link">Activity</a>
    </li>
</ul>
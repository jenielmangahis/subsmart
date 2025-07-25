<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.select2-dropdown{
    z-index: 999999;
}
.nsm-card {
    padding: 1.5em;
    border-radius: 0;
}
.close-btn{
    border: none;
    background-color: transparent;
}

#person-list_filter{
    display: none;
}
#person-list_length{
    display: none;
}
.form_line{
    margin-bottom: 10px;
}

#person-list .table-icon {
    width: 1% !important;
}   
.dropdown-toggle a{
    text-decoration:none;
}
#person-list td .bx {
    color: #888888;
}
#person-list .nsm-badge{
    font-size:14px;
}
.form-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.select-filter-card{
    cursor: pointer
}
.dropdown-menu {
    overflow: hidden;
    overflow-y: auto;
    max-height: calc(100vh - 500px);
}
#person-list td:nth-child(1) {  
    vertical-align:middle;
    text-align:center;
}
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead'); ?>'">
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
                            <button><i class='bx bx-x'></i></button>
                            Listing of all Residential Customers.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <?php
                      $colorClasses = ['primary', 'success', 'error', 'secondary'];
                        $index = 0;
                        foreach ($statusCounts as $status => $count) {
                    ?>
                    <div class="col-6 col-md-3 col-lg-2 select-filter-card" data-value="<?php echo $status; ?>" >
                        <div class="nsm-counter <?php echo $colorClasses[$index % 4]; ?> h-100 mb-2 " id="estimates">
                            <div class="row h-100 w-auto">
                                <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                                    <div><span><i class="bx bx-receipt" ></i>  <?php echo $status; ?></span></div>
                                    <h2 id="total_this_year ml-3"><?php echo $count; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ++$index; } ?>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search">
                        <input type="text" class="nsm-field nsm-search form-control mb-2" style="display:inline-block;width:80%;" id="PERSON_SEARCHBAR" placeholder="Search Customer">
                        <a href="javascript:void(0);" id="btn-reset-customer-list" class="nsm-button primary">Reset</a>                  
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                    <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <span id="filter-selected">All Status</span></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                 <li><a class="dropdown-item"data-value="" href="#">All Status</a></li>
                                 <?php  foreach($statusCounts as $status => $count){?>
                                <li><a class="dropdown-item" data-value="<?= $status ?>" href="#"><?= $status ?></a></li>
                              
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                With Selected <small id="num-checked" class="text-muted"></small> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-favorites" href="javascript:void(0);" data-action="delete">Add to Favorites</a></li>       
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <?php if(checkRoleCanAccessModule('customers', 'write')){ ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-nsm" id="openModalBtn"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Customer</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">       
                                    <li><a class="dropdown-item" id="archived-customer-list" href="javascript:void(0);">Archived</a></li>        
                                    <li><a class="dropdown-item" id="favorite-customer-list" href="javascript:void(0);">Favorites</a></li> 
                                     <li><div class="dropdown-divider"></div></li> 
                                    <li><a class="dropdown-item" id="btn-residential-export-list" href="javascript:void(0);">Export</a></li>                               
                                    <li><a class="dropdown-item" id="btn-import-customer" href="javascript:void(0);">Import</a></li>                               
                                    <li><a class="dropdown-item" id="print-customer-list" href="javascript:void(0);">Print</a></li>                               
                                </ul>
                            </div>
                        <?php } ?>                    
                    </div>
                </div>
                <input type="hidden" id="page_type" value="person">
                
                <?php if (!empty($enabled_table_headers)) { ?>
                    <div class="cont">
                        <form id="frm-with-selected">
                        <table id="person-list" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="table-icon text-center sorting_disabled">
                                        <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                    </th>
                                    <th class="table-icon"></th>
                                    <?php if (in_array('name', $enabled_table_headers)) { ?><th data-name="Name">Name</th><?php } ?>
                                    <?php if (in_array('email', $enabled_table_headers)) { ?><th data-name="Name">Email</th><?php } ?>
                                    <?php if (in_array('industry', $enabled_table_headers)) { ?><th data-name="Name">Industry</th><?php } ?>
                                    <?php if (in_array('city', $enabled_table_headers)) { ?><th data-name="City">City</th><?php } ?>
                                    <?php if (in_array('state', $enabled_table_headers)) { ?><th data-name="State">State</th><?php } ?>
                                    <?php if (in_array('source', $enabled_table_headers)) { ?><th data-name="Source">Source</th><?php } ?>
                                    <?php if (in_array('added', $enabled_table_headers)) { ?><th data-name="Added">Added</th><?php } ?>
                                    <?php if (in_array('sales_rep', $enabled_table_headers)) { ?><th data-name="Sales Rep">Sales Rep</th><?php } ?>
                                    <?php if (in_array('tech', $enabled_table_headers)) { ?><th data-name="Tech">Tech</th><?php } ?>
                                    <?php if (in_array('plan_type', $enabled_table_headers)) { ?><th data-name="Plan Type">Plan Type</th><?php } ?>
                                    <?php if (in_array('rate_plan', $enabled_table_headers)) { ?><th data-name="Rate Plan">Rate Plan</th><?php } ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) { ?><th data-name="<?php echo $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?> "><?php echo $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?> </th><?php } ?>
                                    <?php if (in_array('job_amount', $enabled_table_headers)) { ?><th data-name="<?php echo $companyId == 58 ? 'Proposed Solar' : 'Job Amount'; ?>"><?php echo $companyId == 58 ? 'Proposed Solar' : 'Job Amount'; ?></th><?php } ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) { ?><th data-name="Phone">Phone</th><?php } ?>
                                    <?php if (in_array('status', $enabled_table_headers)) { ?><th data-name="Status">Status</th><?php } ?>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="cont">
                        <form id="frm-with-selected">
                        <table id="person-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-icon text-center sorting_disabled">
                                        <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                    </th>
                                    <th class="table-icon"></th>
                                    <th data-name="Name">Name   </th>
                                    <?php if ($companyId == 1) { ?>
                                    <th data-name="Name">Industry</th>
                                    <?php } ?>
                                    <th data-name="City">City</th>
                                    <th data-name="State">State</th>
                                    <th data-name="Source">Source</th>
                                    <th data-name="Added">Added</th>
                                    <th data-name="Sales Rep">Sales Rep</th>
                                    <th data-name="<?php echo $companyId == 58 ? 'Mentor' : 'Tech'; ?>"><?php echo $companyId == 58 ? 'Mentor' : 'Tech'; ?></th>
                                    <th data-name="Plan Type">Plan Type</th>
                                    <th data-name="<?php echo $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?>"><?php echo $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?></th>
                                    <th data-name="<?php echo $companyId == 58 ? 'Proposed Solar' : 'Job Amount'; ?>"><?php echo $companyId == 58 ? 'Proposed Solar' : 'Job Amount'; ?></th>
                                    <th data-name="Phone">Phone</th>
                                    <th data-name="Status">Status</th>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </form>
                    </div>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade nsm-modal fade" id="modal-archived-customers" aria-labelledby="modal-archived-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-event-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Manage Archived Customers</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="customer-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade nsm-modal fade" id="modal-favorite-customers" aria-labelledby="modal-favorite-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Manage Favorite Customers</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="customer-favorite-list-container" style="max-height: 800px; overflow: auto;"></div>
        </div>
    </div>
</div>
<div class="modal fade nsm-modal fade" id="person_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_customer_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">         
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Residential Customer</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                      
                <form id="person_and_company_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="col-md-4">Status</div>
                                <input type="hidden" name="prof_id" id="prof_id">
                                <div class="col-md-8">
                                    <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select" >
                                        <option  value=""></option>
                                        <?php foreach ($customer_status as $status) { ?>
                                            <option value="<?php echo $status->name; ?>"><?php echo $status->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Customer Type</div>
                                <div class="col-md-8">
                                    <input data-type="customer_type" type="customer_type" class="form-control email-input-element" name="customer_type" id="person_type" value="Residential" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="col-md-4">Customer Group</div>
                                <div class="col-md-8">
                                    <select id="customer_group" name="customer_group" data-customer-source="dropdown" class="form-controls input_select">
                                        <?php foreach ($customerGroups as $cg) { ?>
                                            <option value="<?php echo $cg->id; ?>"><?php echo $cg->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Sales Area</div>
                                <div class="col-md-8">
                                    <select name="fk_sa_id" id="fk_sa_id" data-type="customer_sales_area" class="form-control">
                                        <?php foreach ($salesAreaSelected as $salesArea) {?>
                                            <option value="<?php echo $salesArea->sa_id; ?>"><?php echo $salesArea->sa_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"><h3 class="form-header">CUSTOMER INFORMATION</h3></div>
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="col-md-4">First Name <span class="required"> *</span></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Middle Initial</div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" maxlength="1" name="middle_name" id="middle_name" value="" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Last Name <span class="required"> *</span></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Name Prefix</div>
                                <div class="col-md-8">
                                    <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-controls input_select searchable-dropdown">
                                        <?php for ($prefix = 0; $prefix < 28; ++$prefix) { ?>
                                            <option value="<?php echo prefix_name($prefix); ?>"><?php echo prefix_name($prefix); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Suffix</div>
                                <div class="col-md-8">
                                    <select id="suffix" name="suffix" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                                        <?php for ($suffix = 0; $suffix < 14; ++$suffix) { ?>
                                            <option value="<?php echo suffix_name($suffix); ?>"><?php echo suffix_name($suffix); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row form_line">
                                <div class="col-md-4">Social Security No.</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control" name="ssn" id="ssn" value="" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Date Of Birth</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="" class="form-control" name="date_of_birth" id="date_of_birth" value="" />
                                </div>
                            </div>
                            <hr />
                            <div class="row form_line">
                                <div class="col-md-4">Email</div>
                                <div class="col-md-8">
                                    <input data-type="customer_email" type="email" class="form-control email-input-element" name="email" id="email" value="" />
                                </div>
                            </div>

                            <div class="row form_line">
                                <div class="col-md-4">Phone (H)</div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">Phone (M) <span class="required"> *</span></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="" required />
                                </div>
                            </div>                               
                        </div>
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="row form_line">
                                    <div class="col-md-4">Address <span class="required"> *</span></div>
                                    <div class="col-md-8">
                                        <input data-type="customer_address" type="text" class="form-control" name="mail_add" id="mail_address" value="" required/>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">City <span class="required"> *</span></div>
                                    <div class="col-md-8">
                                        <input data-type="customer_address_city" type="text" class="form-control" name="city" id="city" value="" required/>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">County <span class="required"> *</span></div>
                                    <div class="col-md-8">
                                        <input data-type="customer_address_county" type="text" class="form-control" name="county" id="county" value="" required/>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">State <span class="required"> *</span></div>
                                    <div class="col-md-8">
                                        <input data-type="customer_address_state" type="text" class="form-control" name="state" id="state" value="" required/>
                                    </div>
                                </div>

                                <div class="row form_line">
                                    <div class="col-md-4">Zip Code <span class="required"> *</span></div>
                                    <div class="col-md-8">
                                        <input required data-type="customer_address_zip" type="text" class="form-control" name="zip_code" id="zip_code" value=""/>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">Cross Street</div>
                                    <div class="col-md-8">
                                        <textarea style="height:80px;" data-type="customer_address_street" class="form-control" name="cross_street" id="cross_street"></textarea>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="person_and_company_form">Save</button>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>    
var PERSON_LIST_TABLE = $('#person-list').DataTable({
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "cache": true,
    "stateSave": true,    
    "pageLength": 10,
    "ajax": {
        "url": "<?php echo base_url('customer/getPersonList'); ?>",
        "type": "POST",
        "data": function (d) {        
            d.filter_status = $('#filter-selected').text().trim(); // Get filter value from UI element
        },
        "dataSrc": function (json) {            
            csv_data = json.data;            
            return json.data;
        }
    },
    "columnDefs": [
        { 
            "targets": [0],
            "orderable": false,
        },
    ]
});

$(document).ready(function() {
    var csv_data;

    $('#btn-residential-export-list').on('click', function(){
        location.href = base_url + 'customer/export_residential_list';
    });
    
    $("#PERSON_SEARCHBAR").keyup(function() {
        PERSON_LIST_TABLE.search($(this).val()).draw();
    });

    $('#btn-reset-customer-list').on('click', function(){
        PERSON_LIST_TABLE.state.clear(); 
        location.reload();
    });

    $('.select-filter .dropdown-item').on('click', function(e) {
        e.preventDefault();
        // Get data-value and text of the clicked item
        var filterValue = $(this).attr('data-value');
        var filterText = $(this).text();

        // Update the text inside #filter-selected span
        $('#filter-selected').text(filterText);

        PERSON_LIST_TABLE.ajax.reload();
    });

    $('.select-filter-card').on('click', function(e) {
        e.preventDefault();
        var filterValue = $(this).attr('data-value');
        $('#filter-selected').text(filterValue);

        PERSON_LIST_TABLE.ajax.reload();
    });

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#person-list input[name="customers[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('click', '.btn-remove-favorite-customer', function(){
        var cid = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        Swal.fire({
            title: 'Remove from Favorites',
            html: `Do you wish to remove from favorites customer <b>${name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {                    
                $.ajax({
                    type: "POST",
                    url: base_url + "customer/_remove_favorite",
                    data: {cid:cid},
                    dataType:'json',
                    success: function(result) {     
                        $('#modal-favorite-customers').modal('hide');                       
                        if( result.is_success == 1 ) {
                            $('#modal-archived-customers').modal('hide');
                            Swal.fire({
                            title: 'Remove from Favorites',
                                icon: 'success',
                                title: 'Success',
                                text: 'Customer record was successfully updated.',
                            }).then((result) => {
                                PERSON_LIST_TABLE.ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#person-list input[name="customers[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('click', '#with-selected-favorites', function(){
        let total= $('#person-list input[name="customers[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Add to Favorites',
                html: `Are you sure you want to add selected rows to the list?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + "customers/_with_selected_add_to_favorites",
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Add to Favorites',
                                    text: "Customer records updated successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        PERSON_LIST_TABLE.ajax.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }     
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#person-list input[name="customers[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Customers',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'customers/_archive_selected_customers',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Customers',
                                    text: "Customer records deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        PERSON_LIST_TABLE.ajax.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-customers input[name="customers[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Customers',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'customers/_restore_selected_customers',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-archived-customers').modal('hide');
                                Swal.fire({
                                    title: 'Restore Customers',
                                    text: "Data restored successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-perma-delete', function(){
        let total= $('#archived-customers input[name="customers[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Customers',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'customers/_permanently_delete_selected_customers',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-archived-customers').modal('hide');
                                Swal.fire({
                                    title: 'Delete Customers',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $(document).on('click', '.btn-permanently-delete-customer', function(){
        let customer_id   = $(this).attr('data-id');
        let customer_name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Customer',
            html: `Are you sure you want to <b>permanently delete</b> customer <b>${customer_name}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'customers/_permanently_delete_archived_customer',
                    data: {
                        customer_id: customer_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-archived-customers').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Customer',
                                html: "Data deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    function deleteItem(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            // Send an AJAX request to delete the item
            $.ajax({
                url: `${base_url}customer/delete/${itemId}`, // Replace with your server-side script to handle the deletion
                type: 'POST',
                data: { id: itemId },
                success: function(response) {
                Swal.fire(
                    '',
                    'The item has been deleted.',
                    'success'
                ).then(() => {
                    location.reload();
                });
                },
                error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'An error occurred while deleting the item.',
                    'error'
                );
                }
            });
            }
        });
    }

    $(document).on("click", ".call-item", function() {
        let phone = $(this).attr("data-id");

        window.open('tel:' + phone);
    });

    $('#archived-customer-list').on('click', function(){
        $('#modal-archived-customers').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "customer/_archived_list",  
            success: function(html) {    
                $('#customer-archived-list-container').html(html);                          
            },
            beforeSend: function() {
                $('#customer-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#favorite-customer-list').on('click', function(){
        $('#modal-favorite-customers').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "customer/_favorite_list",  
            success: function(html) {    
                $('#customer-favorite-list-container').html(html);                          
            },
            beforeSend: function() {
                $('#customer-favorite-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#print-customer-list').on('click', function() {
        var url  = base_url + 'customer/_get_customer_lists';
        var type = 'Residential';

        $('#print_customer_list_modal').modal('show');
        $("#print-customer-list-container").html('<span class="bx bx-loader bx-spin"></span> loading customer list...');

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: url,
                data: {type:type},
                success: function(o) {
                    $("#print-customer-list-container").html(o);
                }
            });
        }, 800);
    });
    
    $(document).on('click', '.send-esign', function(){
        var prof_id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        $('#customer-esign').val(prof_id);
        $('#modal-send-esign-customer-name').text(name);
        $('#modal-send-esign').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "customer/_send_esign_form",
            data: {prof_id:prof_id},
            beforeSend: function(data) {
                $("#customer-send-esign").html('<span class="bx bx-loader bx-spin"></span>');
            },
            success: function(html) {
                $("#customer-send-esign").html(html);
            },
            complete: function() {

            },
            error: function(e) {
                console.log(e);
            }
        });
    });

    $(document).on('click', '#btn-customer-send-esign-template', function(){
        var prof_id = $('#customer-esign').val();
        var esign_template_id = $('#customer-send-esign-template').val();
        var url = base_url + `eSign_v2/templatePrepare?id=${esign_template_id}&job_id=0&customer_id=${prof_id}`;

        window.open(
            url,
            '_blank'
        );

        $('#modal-send-esign').modal('hide');
    });

    $(document).on('click', '.btn-restore-customer', function(){
        var cid = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        Swal.fire({
            title: 'Restore Customer',
            html: `Proceed with restoring customer data <b>${name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {                    
                $.ajax({
                    type: "POST",
                    url: base_url + "customer/_restore_archived",
                    data: {cid:cid},
                    dataType:'json',
                    success: function(result) {                            
                        if( result.is_success == 1 ) {
                            $('#modal-archived-customers').modal('hide');
                            Swal.fire({
                            icon: 'success',
                            title: 'Restore Customer',
                            text: 'Customer data was successfully restored.',
                            }).then((result) => {
                                PERSON_LIST_TABLE.ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });

    $(document).on('click', '.favorite-customer', function(){
        var cid = $(this).attr('data-id');
        var cname = $(this).attr('data-name');
        var is_favorite = $(this).attr('data-favorite');

        if( is_favorite == 1 ){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: 'Customer is already in favorite list.'
            });
        }else{
            Swal.fire({
                title: "Favorite Customer",
                html: `Do you want to add to <b>${cname}</b> to the list?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    var url = base_url + "customer/_add_to_favorites";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            cid: cid
                        },
                        dataType: 'json',
                        beforeSend: function(result) {

                        },
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    html: 'Customer record was updated successfully',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    PERSON_LIST_TABLE.ajax.reload();  
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
                                });
                            }
                        },
                        complete: function() {

                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        }            
    });

    $(document).on('click', '.delete-customer', function(){
        var cid = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        Swal.fire({     
            title: 'Residential Customers',     
            html: `Delete selected customer <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "customer/_delete_customer";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {cid:cid},
                    dataType: 'json',
                    beforeSend: function(result) {
                        
                    },
                    success: function(result) {                                                                        
                        if(result.is_success  == 1){
                            Swal.fire({
                                html: 'Customer record was deleted successfully',                        
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                PERSON_LIST_TABLE.ajax.reload();  
                            });                                  
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }                               
                    },
                    complete : function(){
                        
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    });

    $(document).on('click', '.sms-messages', function(){
        var profid = $(this).attr('data-id');
        //var url = base_url + 'customer/_get_messages';
        var url = base_url + 'customer/_load_customer_sms_messages';

        $('#messages_modal').modal('show');
        $(".modal-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
        $.ajax({
            type: "POST",
            url: url,             
            data: {profid:profid},
            success: function(o)
            {          
                $(".modal-messages-container").html(o);                
            }
        });
        }, 800);
    });

    $(document).on('click', '.send-email', function(){
        var customer_email = $(this).attr('data-email');
        var customer_eid   = $(this).attr('data-id');
        
        $('#send_email_modal').modal('show');
        $('#customer-email').val(customer_email);
        $('#customer-send-email-eid').val(customer_eid);
        $('#email-message').val('');
        $('#email-subject').val('');
    });    

    $(document).on('submit', '#frm-send-email', function(e){
        e.preventDefault();
        
        var url = base_url + 'customer/_send_email';
        $.ajax({
            type: "POST",
            url: url,   
            dataType: "json",          
            data: $('#frm-send-email').serialize(),
            beforeSend: function(data) {
                $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
            },
            success: function(o)
            {          
                $("#btn_send_email").html('Send');
                if(o.is_success  == 1){
                    Swal.fire({
                        html: 'Email sent',                        
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                    $("#send_email_modal").modal('hide');                
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                    });
                }                
            },
            complete : function(){
                            
            },
            error: function(e) {
                console.log(e);
            }
        });

        $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
    });

    function cleanPhoneNumber(phoneHtml) {
        const regex = /(?:<p>Phone \(\w\) : )([\d\+\-\(\) ]+)(?:<\/p>)/g;
        const matches = phoneHtml.matchAll(regex);
        const phoneNumbers = Array.from(matches, match => match[1]);
        return phoneNumbers.join(', '); // Concatenate multiple phone numbers with commas
    }

    // Function to convert data to CSV format using Papa Parse
    function convertDataToCSV(data, headers) {
        // Prepare Papa Parse config for CSV conversion
        var csvConfig = {
            quotes: false, // Disable quotes for each field
            delimiter: ",", // Set delimiter as comma
            header: true, // Include headers in CSV output
        };

        // Map and transform each row of data
        var csvData = data.map(row => {
            // Exclude the last column (assuming it's the 5th column based on your provided data)
            var rowSubset = row.slice(0, -1); // Exclude the last element in the row

            return {
                [headers[0]]: rowSubset[0], // Contact Name
                [headers[1]]: rowSubset[1], // Email
                [headers[2]]: cleanPhoneNumber(rowSubset[2]), // Phone (cleaned)
                [headers[3]]: rowSubset[3], // Customer Type
                [headers[4]]: rowSubset[4],//Status
            };
        });

        // Convert data to CSV format using Papa Parse
        var csv = Papa.unparse(csvData, csvConfig);

        return csv; // Return the generated CSV string
    }

    $("#openModalBtn").click(function(){
        // Show the modal
        $("#person_modal").modal('show');
    });
});
</script>
 <?php include viewPath('v2/pages/customer/js/add_advance_js'); ?> 

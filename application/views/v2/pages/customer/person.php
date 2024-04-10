<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />


<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
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
                            Listing of all Persons.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/companies') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Person" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by: <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies'); ?>">All Companies</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=deactivated'); ?>">Status Deactivated</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/companies?status=expired'); ?>">Status Expired</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <!-- <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_company_list') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a> -->
                            <a class="nsm-button primary btn-export-list"  style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <!-- <a class="nsm-button primary btn-add-user" href="javascript:void(0);"><i class='bx bx-fw bx-user'></i> Create User</a> -->                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="person-list">
                    <thead>
                        <tr>
             
                            <td data-name="Contact Name">Contact Name</td>
                            <td data-name="Industry">Email</td>
                            <td data-name="Plan">Phone</td>
                            <td data-name="Num License" style="width:10%;">Customer Type</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage">Action</td>
                        </tr>
                    </thead>
                    <?php foreach ($persons as $person): ?>                    
                                <tr>
                         
                                    <td class="center">
                                    <?php echo $person->first_name ." ".$person->last_name ; ?>
                                    </td>
                                    <td class="center"> <?php echo $person->email; ?></td>
                                    <td class="center">
                                       <p>Phone (H) :  <?php echo $person->phone_h; ?></p>
                                       <p>Phone (M) :  <?php echo $person->phone_m; ?></p>
                                  
                                    </td>
                                    <td class="center"><?php echo $person->customer_type ?></td>
                                    <td class="center">                                
                                    <?php echo $person->status?>
                            <!-- <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;"><?php echo $company->status?></span> -->
                                        
                                    </td>
                                    <td class="center actions-col">
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-view-subscription-details" href="javascript:void(0)" data-id=""><i class='bx bx-fw bxs-show'></i> View Details</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-manage-company-modules"  href="javascript:void(0)" data-id=""><i class="bx bx-fw bx-edit"></i> Manage Modules</a>
                                                </li>
                                                <li>
                                         
                                                        <a href="javascript:void(0)" data-name="" data-id="" class="deactivate-company dropdown-item"><i class="bx bx-fw bxs-x-square"></i> Deactivate</a>
                                                
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-company" href="javascript:void(0);" data-name="" data-id=""><i class="bx bx-fw bx-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                 
                                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        
                   
              
            </div>
        </div>
    </div>
</div>
<script>
       $(document).ready(function() {

    $(".nsm-table").nsmPagination();
    });
</script>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>

<?php include viewPath('v2/includes/footer'); ?>
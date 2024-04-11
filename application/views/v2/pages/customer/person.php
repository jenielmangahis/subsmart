<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
<style>
    .select2-dropdown{
        z-index: 999999;
    }
    .modal-body{
        padding: 0;
        border-radius: 5px;
    }
    .nsm-card {
        padding: 1.5em;
        border-radius: 0;
    }
    .close-btn{
        border: none;
        background-color: transparent;
    }
    .close-btn i{
        font-size: 2.285714em;
    }
</style>

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
                            <a class="nsm-button primary btn-export-list" id="openModalBtn"  style="margin-left: 10px;"> <i class='bx bxs-face'></i> Add Person</a>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <!-- <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_company_list') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a> -->
                            <a class="nsm-button primary btn-export-list"  style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <!-- <a class="nsm-button primary btn-add-user" href="javascript:void(0);"><i class='bx bx-fw bx-user'></i> Create User</a> -->                            
                        </div>
                    </div>
                </div>
                <input type="hidden" id="page_type" value="person">
                <table class="nsm-table" id="person-list">
                    <thead>
                        <tr>
             
                            <td data-name="Contact Name">Contact Name</td>
                            <td data-name="Industry">Email</td>
                            <td data-name="Plan">Phone</td>
                            <td data-name="Num License" style="width:10%;">Customer Type</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                     
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
                                                    <a class="dropdown-item btn-manage-company-modules edit_person"  href="javascript:void(0)" 
                                                    data-status="<?php echo $person->status; ?>" 
                                                    data-id="<?php echo $person->prof_id; ?>" 
                                                    data-email="<?php echo $person->email; ?>"
                                                    data-customer_group="<?php echo $person->customer_group; ?>"
                                                    data-first_name="<?php echo $person->first_name; ?>"
                                                    data-middle_name="<?php echo $person->middle_name; ?>"
                                                    data-last_name="<?php echo $person->last_name; ?>"
                                                    data-prefix="<?php echo $person->prefix; ?>"
                                                    data-suffix="<?php echo $person->suffix; ?>"
                                                    data-country="<?php echo $person->country; ?>"
                                                    data-mail_add="<?php echo $person->mail_add; ?>"
                                                    data-city="<?php echo $person->city; ?>"
                                                    data-county="<?php echo $person->county; ?>"
                                                    data-state="<?php echo $person->state; ?>"
                                                    data-country="<?php echo $person->country; ?>"
                                                    data-zip_code="<?php echo $person->zip_code; ?>"
                                                    data-cross_street="<?php echo $person->cross_street; ?>"
                                                    data-subdivision="<?php echo $person->subdivision; ?>"
                                                    data-ssn="<?php echo $person->ssn; ?>"
                                                    data-phone_h="<?php echo $person->phone_h; ?>"
                                                    data-phone_m="<?php echo $person->phone_m; ?>"
                                                    data-date_of_birth="<?php echo $person->date_of_birth; ?>"
                                                    
                                                    >
                                                    <i class="bx bx-fw bx-edit"></i>View/Edit</a>
                                                </li>
                                              
                                                <li>
                                                    <a class="dropdown-item delete-company" href="javascript:void(0);"onclick="deleteItem(<?php echo $person->prof_id; ?>)"><i class="bx bx-fw bx-trash"></i> Delete</a>
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
<div class="modal fade nsm-modal fade" id="person_modal" tabindex="-1" aria-labelledby="payment_history_modal_label" aria-hidden="true">
<form id="person_and_company_form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="payment_history_container">
            <div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bxs-face'></i> <span id="person_header">Add Person</span></span>
        </div>
        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
    </div>
  
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-4">
                Status
            </div>
            <input type="hidden" name="prof_id" id="prof_id">
            <div class="col-md-8">
                <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select" >
                    <option  value=""></option>
                    <?php foreach ($customer_status as $status): ?>
                        <option <?= isset($profile_info) ? ($profile_info->status == $status->name ? 'selected' : '') : '' ?> value="<?= $status->name ?>"><?= $status->name ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Customer Type
            </div>
            <div class="col-md-8">
            <input data-type="customer_type" type="customer_type" class="form-control email-input-element" name="customer_type" id="person_type" value="Residential" readonly/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Customer Group
            </div>
            <div class="col-md-8">
                <select id="customer_group" name="customer_group" data-customer-source="dropdown" class="form-controls input_select">
                    <?php foreach($customerGroups as $cg){ ?>
                        <option value="<?= $cg->id; ?>"><?= $cg->title; ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>
        <?php if($company_id == 1): ?>
        <div class="row form_line">
            <div class="col-md-4">
                Industry Type
            </div>
            <div class="col-md-8">
                <select 
                    id="industry_type" 
                    name="industry_type" 
                    data-customer-source="dropdown" 
                    class="form-controls input_select"
                >
                    <option>Select your Industry</option>
                    <?php $businessTypeName  = "";
                        foreach($industryTypes  as $industryType ){ ?>
                           <?php if ($businessTypeName!== $industryType->business_type_name ) { ?> 
                                    <optgroup label="<?php echo $industryType->business_type_name; ?>">
                           <?php  $businessTypeName =  $industryType->business_type_name; }      ?>  
                           <?php 
                            $selected_industry_type = 0;
                            if( isset($profile_info) ){
                                $selected_industry_type = $profile_info->industry_type_id;
                            }
                           ?>
                            <option <?= $selected_industry_type == $industryType->id ? 'selected="selected"' : ''; ?> value="<?php echo $industryType->id; ?>"><?php echo $industryType->name; ?></option>
                        <?php  }   ?>
                </select>
            </div>
        </div>
        <?php endif; ?>
        <div class="row form_line">
            <div class="col-md-4">
                Sales Area
            </div>
            <div class="col-md-8">
                <select name="fk_sa_id" data-type="customer_sales_area" class="form-control">
                    <?php if( $salesAreaSelected ){ ?>
                        <option value="<?= $salesAreaSelected->sa_id; ?>"><?= $salesAreaSelected->sa_name; ?></option>
                    <?php } ?>
                </select>
                
            </div>
        </div>
 
        <div class="row form_line">
            <div class="col-md-4">
                First Name <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Middle Initial
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" maxlength="1" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Last Name <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Name Prefix
            </div>
            <div class="col-md-8">
                <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-controls input_select searchable-dropdown">
                    <?php
                    for ($prefix=0;$prefix<28;$prefix++){
                        ?>
                        <option <?php if(isset($profile_info)){ if($profile_info->prefix == prefix_name($prefix)){ echo 'selected'; } } ?> value="<?= prefix_name($prefix); ?>">
                            <?= prefix_name($prefix); ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Suffix
            </div>
            <div class="col-md-8">
                <select id="suffix" name="suffix" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                    <?php
                    for ($suffix=0;$suffix<14;$suffix++){
                        ?>
                        <option <?php if(isset($profile_info)){ if($profile_info->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Country
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_country" type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Address <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address" type="text" class="form-control" name="mail_add" id="mail_address" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                City <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_city" type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                County <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_county" type="text" class="form-control" name="county" id="county" value="<?php if(isset($profile_info->county)){ echo $profile_info->county; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                State <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_state" type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" required/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                Zip Code <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input required data-type="customer_address_zip" type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Cross Street
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_street" type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
            </div>
        </div>                
        <div class="row form_line">
            <div class="col-md-4">
                Subdivision
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_subdivision" type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Social Security No.
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control" name="ssn" id="ssn" value="<?php if(isset($profile_info)){ echo $profile_info->ssn; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Date Of Birth 
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(isset($profile_info)){ echo date("m/d/Y", strtotime($profile_info->date_of_birth)); } ?>" />
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                Email 
            </div>
            <div class="col-md-8">
                <input data-type="customer_email" type="email" class="form-control email-input-element" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
            </div>
        </div>

        <div class="row form_line">
            <?php 
            $phone_h;
            $phone_m;

            if(strpos($profile_info->phone_h, "Mobile:") !== false){
                $str = $profile_info->phone_h;
                $exp = explode("Mobile:",$str);
                $phone_h = preg_replace('/\s+/', '-', ltrim($exp[0]));
                $phone_m = preg_replace('/\s+/', '-', ltrim($exp[1]));
             }else{
                $phone = preg_replace('/\s+/', '-', ltrim($profile_info->phone_h));
             } ?>
            <div class="col-md-4">
                Phone (H)
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="<?php if(isset($profile_info)){ echo $phone_h == null ? $phone : $phone_h; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone (M) <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_h) || isset($profile_info->phone_m)){ echo $profile_info->phone_m != null ? $profile_info->phone_m : $phone_m; } ?>" required />
            </div>
        </div>
    </div>

</div>

            </div>
            <div class="modal-footer">
                <button type="submit"  class="nsm-button primary" >Submit</button>
            </div>
        </div>
    </div>
    </form>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
    function deleteItem(itemId) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this item!',
    icon: 'warning',
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
            'Deleted!',
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
       $(document).ready(function() {
        
        // var PERSON_LIST_TABLE = $('#person-list').DataTable({
        //     "ordering": false,
        //     "processing": true,
        //     "serverSide": true,
        //     // "order": [],
        //     "ajax": {
        //         "url": "<?= base_url('customer/getPersonList'); ?>",
        //         "type": "POST"
        //     },
        // });
        
    $(".nsm-table").nsmPagination();
    $(".edit_person").click(function(){
        // Get data attributes from the button
        
    $("#person_header").text("View/Edit Person");
    $("#status").val($(this).data('status'));  
    $("#prof_id").val($(this).data('id'));   
    $("#email").val($(this).data('email'));
    $("#customer_group").val($(this).data('customer_group'));
    $("#first_name").val($(this).data('first_name'));
    $("#middle_name").val($(this).data('middle_name'));
    $("#last_name").val($(this).data('last_name'));
    $("#prefix").val($(this).data('prefix'));
    $("#suffix").val($(this).data('suffix'));
    $("#country").val($(this).data('country'));
    $("#mail_address").val($(this).data('mail_add'));
    $("#city").val($(this).data('city'));
    $("#county").val($(this).data('county'));
    $("#state").val($(this).data('state'));
    $("#zip_code").val($(this).data('zip_code'));
    $("#cross_street").val($(this).data('cross_street'));
    $("#subdivision").val($(this).data('subdivision'));
    $("#ssn").val($(this).data('ssn'));
    $("#phone_h").val($(this).data('phone_h'));
    $("#phone_m").val($(this).data('phone_m'));
    $("#date_of_birth").val($(this).data('date_of_birth'));
    
    // Show the modal
    $("#person_modal").modal('show');
    });
    });

$('#person_modal').on('hidden.bs.modal', function () {
    $("#person_header").text("Add Person");
    $("#status").val('');  
    $("#prof_id").val('');   
    $("#email").val('');
    $("#customer_group").val('');
    $("#first_name").val('');
    $("#middle_name").val('');
    $("#last_name").val('');
    $("#prefix").val('');
    $("#suffix").val('');
    $("#country").val('');
    $("#mail_address").val('');
    $("#city").val('');
    $("#county").val('');
    $("#state").val('');
    $("#zip_code").val('');
    $("#cross_street").val('');
    $("#subdivision").val('');
    $("#ssn").val('');
    $("#phone_h").val('');
    $("#phone_m").val('');
    $("#date_of_birth").val('');
});

    $("#openModalBtn").click(function(){
        // Show the modal
        $("#person_modal").modal('show');
    });


</script>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<?php include viewPath('v2/pages/customer/js/add_advance_js'); ?> 

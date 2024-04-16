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
 
    #company-list_filter{
        display: none;
    }
    #company-list_length{
        display: none;
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
                            Listing of all 	commercials.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form >
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="COMMERCIAL_SEARCHBAR" name="search" placeholder="Search Commercials" >                                
                            </div>
     
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <span id="filter-selected">All Status</span></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                 <li><a class="dropdown-item"data-value="" href="#">All Status</a></li>
                                <li><a class="dropdown-item" data-value="Contract Review" href="#">Contract Review</a></li>
                                <li><a class="dropdown-item" data-value="Design Team/Engineering Stamps" href="#">Design Team/Engineering Stamps</a></li>
                                <li><a class="dropdown-item" data-value="Acceptance Pending" href="#">Acceptance Pending </a></li>
                                <li><a class="dropdown-item" data-value="Loan Documents to be Executed" href="#">Loan Documents to be Executed</a></li>
                                <li><a class="dropdown-item" data-value="Interconnection" href="#">Interconnection</a></li>
                                <li><a class="dropdown-item" data-value="Inspection" href="#">Inspection</a></li>
                                <li><a class="dropdown-item" data-value="Site Survey" href="#">Site Survey</a></li>
                                <li><a class="dropdown-item" data-value="CAD/Permitting" href="#">CAD/Permitting</a></li>
                                <li><a class="dropdown-item" data-value="Proposal" href="#">Proposal</a></li>
                                <li><a class="dropdown-item" data-value="Lead" href="#">Lead</a></li>
                                <li><a class="dropdown-item" data-value="Installed" href="#">Installed</a></li>
                                <li><a class="dropdown-item" data-value="Cancel Pending" href="#">Cancel Pending</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" id="openModalBtn"  style="margin-left: 10px; cursor:pointer"><i class="bx bx-building"></i> Add 	Commercial</a>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" id="export-csv-button"href="#" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i>Export List</a>
                            
                        </div>
                    </div>
                </div>
                <input type="hidden" id="page_type" value="company">
                <table class="nsm-table" id="company-list">
                    
                    <thead>
                        <tr>
                            <td data-name="Company Name">Company Name</td>
                            <td data-name="Contact Name">Contact Name</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Plan">Phone</td>
                            <td data-name="Customer Type" style="width:10%;">Customer Type</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td></td>
                         
                        </tr>
                    </thead>
                    <tbody>
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
            <span><i class="bx bx-building"></i><span id="person_header"> Add Commercial</span></span>
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
            <input data-type="customer_type" type="customer_type" class="form-control email-input-element" name="customer_type" id="person_type" value="Commercial" readonly/>
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
                <select name="fk_sa_id" id="fk_sa_id" data-type="customer_sales_area" class="form-control">
                <?php foreach( $salesAreaSelected as $salesArea){

                    ?>
                    <option value="<?= $salesArea->sa_id; ?>"><?=  $salesArea->sa_name; ?></option>
                    <?php } ?>
                </select>
                
            </div>
        </div>
     
        <div class="row" id="businessName">
            <div class="col-md-4" id="businessNameLabel">
                <label for="" >Business Name
            </div>
            <div class="col-md-8" id="businessNameInput">
                <input type="text" class="form-control" name="business_name" id="business_name" value="<?php if(isset($profile_info)){ echo $profile_info->business_name; } ?>"/>
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
            [headers[2]]: rowSubset[2], 
            [headers[3]]: cleanPhoneNumber(rowSubset[3]), 
            [headers[4]]: rowSubset[4],// Customer Type
            [headers[5]]: rowSubset[5],//Status
        };
    });

    // Convert data to CSV format using Papa Parse
    var csv = Papa.unparse(csvData, csvConfig);

    return csv; // Return the generated CSV string
}

       $(document).ready(function() {

        var csv_data;
        var COMPANY_LIST_TABLE = $('#company-list').DataTable({
            
       
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [10, 25, 50, 75, 100], // Display options for the length menu
            "pageLength": 10,
            "ajax": {
                "url": "<?= base_url('customer/getCompanyList'); ?>",
                "type": "POST",
                "data": function (d) {
                // Include custom parameters for filtering
                d.filter_status = $('#filter-selected').text().trim(); // Get filter value from UI element
            },
                "dataSrc": function (json) {
            // Handle the response here
            console.log(json);
            // Return the data portion of the response
            csv_data = json.data;
            console.log(csv_data);
            return json.data;

        }
            },
           
           
        });

        $('#export-csv-button').on('click', function() {
            var headers = ["Company Name", "Contact Name", "Email", "Phone",'Customer Type', "Status"];
            var csvData = convertDataToCSV(csv_data, headers);
            var blob = new Blob([csvData], { type: "text/csv;charset=utf-8" });
            saveAs(blob, "commercial.csv");
    });

        $("#COMMERCIAL_SEARCHBAR").keyup(function() {
            COMPANY_LIST_TABLE.search($(this).val()).draw();

        });
        $('.select-filter .dropdown-item').on('click', function(e) {
            e.preventDefault();

            // Get data-value and text of the clicked item
            var filterValue = $(this).attr('data-value');
            var filterText = $(this).text();

            // Update the text inside #filter-selected span
            $('#filter-selected').text(filterText);

            COMPANY_LIST_TABLE.ajax.reload();

        });

    });
    
  
  
    
    $("#openModalBtn").click(function(){
        // Show the modal
        $("#person_modal").modal('show');
    });
</script>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<?php include viewPath('v2/pages/customer/js/add_advance_js'); ?> 

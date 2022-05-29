<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
.section-title {
    background-color: #666666;
    color: #ffffff !important;
    padding: 10px;
    margin-bottom: 10px;
}
.datepicker {
  transform: translate(0, 3.1em);
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and
                            potential customers is to have one powerful platform that can provide an
                            immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and
                            more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/customers') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Customers" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=new'); ?>">Status New</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=contacted'); ?>">Status Contacted</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=followup'); ?>">Status Followup</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=assigned'); ?>">Status Assigned</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=converted'); ?>">Status Converted</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/leads?status=closed'); ?>">Status Closed</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_customers') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>                   
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>                                                     
                            <td data-name="Company">Company</td>
                            <td data-name="Name">Name</td>
                            <td data-name="Name">Industry</td>
                            <td data-name="Source">Source</td>
                            <td data-name="Added">Added</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech">Tech</td>
                            <td data-name="Plan Type">Plan Type</td>
                            <td data-name="Subscription Amount">Subscription Amount</td>
                            <td data-name="Phone">Phone</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($customers)) :
                        ?>
                            <?php
                            foreach ($customers as $customer) :
                                switch (strtoupper($customer->status)):
                                    case "INSTALLED":
                                        $badge = "success";
                                        break;
                                    case "CANCELLED":
                                        $badge = "error";
                                        break;
                                    case "COLLECTIONS":
                                        $badge = "secondary";
                                        break;
                                    case "CHARGED BACK":
                                        $badge = "primary";
                                        break;
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                            ?>  
                                    <td><?= $customer->business_name; ?></td>
                                    <td>
                                        <label class="nsm-link default d-block fw-bold">
                                            <?= $customer->first_name . ' ' . $customer->last_name; ?>
                                        </label>
                                        <label class="nsm-link default content-subtitle fst-italic d-block">
                                            <?php echo $customer->email; ?>                                                
                                        </label>
                                    </td>
                                    <td>
                                        <?php 
                                            if( $customer->industry_type_id > 0 ){
                                                echo $customer->industry_type;
                                            }else{
                                                echo 'Not Specified';                                                    
                                            }
                                        ?>
                                    </td>
                                    <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                    <td><?php echo $customer->entered_by; ?></td>
                                    <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                                    <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                                    <td><?php echo $customer->system_type; ?></td>
                                    <td>$<?= $customer->total_amount; ?></td>
                                    <td><?php echo $customer->phone_m; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('customer/preview_/' . $customer->prof_id); ?>">View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-customer" href="javascript:void(0);" data-name="<?= $customer->first_name . ' ' . $customer->last_name; ?>" data-company="<?= $customer->business_name; ?>" data-id="<?= $customer->prof_id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="14">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/customers';
    });

    $(document).on('click','.btn-add-new-lead',function(){
        $('#modalAddNewLeads').modal('show');
    });

    $(document).on('click','.btn-view-lead',function(){
        var url = base_url + 'admin/ajax_view_lead';
        var lid = $(this).attr("data-id");

        $('#modalViewLead').modal('show');
        $(".modal-view-lead-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,           
             data: {lid:lid},
             success: function(o)
             {          
                $(".modal-view-lead-container").html(o);
             }
          });
        }, 800);
    });

    $(document).on('change', '#companyList', function(){
        var cid = $(this).val();
        var url = base_url + 'admin/ajax_load_leads_company_fields';
        $.ajax({
            type: "POST",
            url: url,
            data: {cid:cid},
            success: function(o)
            {          
                $('.company-fields').html(o);
            }
        });
    });

    $(document).on('submit', '#frm-add-new-lead', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveLead';
        $(".btn-add-lead").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-lead")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddNewLeads").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Leads was successfully created.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-add-lead").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-customer", function(e) {
        var cid = $(this).attr("data-id");
        var customer_name = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxDeleteCustomer';

        Swal.fire({
            title: 'Delete Customer',
            html: "Are you sure you want to delete customer <b>"+customer_name+"</b> from company <b>"+company_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {cid:cid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Customer Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>
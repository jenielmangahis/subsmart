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
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/admin_leads_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers 
                            is to have one powerful platform that can provide an immediate response to your customer needs. 
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your 
                            customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/leads') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Leads" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_leads') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <a class="nsm-button primary btn-add-new-lead" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> Add New Lead</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Company</td>
                            <td data-name="Name">Name</td>
                            <td data-name="City">City</td>
                            <td data-name="State">State</td>
                            <td data-name="Assigned To">Assigned To</td>
                            <td data-name="Email">Email</td>
                            <td data-name="SSS Number">SSS Number</td>
                            <td data-name="Phone">Phone</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($leads)) :
                        ?>
                            <?php
                            foreach ($leads as $lead) :
                                switch($lead->status):
                                    case 'Lead':
                                        $badge = 'primary';
                                        break;
                                    case 'Attempted Contact':
                                        $badge = 'secondary';
                                        break;
                                    case 'Follow Up':
                                        $badge = 'secondary';
                                        break;
                                    case 'Assigned':
                                        $badge = 'success';
                                        break;
                                    case 'Appointed':
                                        $badge = 'success';
                                        break;
                                    case 'Presented':
                                        $badge = 'success';
                                        break;
                                    case 'Pending':
                                        $badge = 'secondary';
                                        break;
                                    case 'Not Interested':
                                        $badge = 'error';
                                        break;
                                    default:
                                        $badge = '';
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-chart'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $lead->business_name; ?></td>
                                    <td class="fw-bold nsm-text-primary"><?= $lead->firstname.' '.$lead->lastname; ?></td>
                                    <td><?= $lead->city; ?></td>
                                    <td><?= $lead->state; ?></td>
                                    <td><?= $lead->FName. ' '. $lead->LName; ?></td>
                                    <td><?= $lead->email_add; ?></td>
                                    <td><?= $lead->sss_num; ?></td>
                                    <td><?= $lead->phone_cell; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $lead->status; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">                                                
                                                <li>
                                                    <a class="dropdown-item btn-view-lead" dat href="javascript:void(0);" data-id="<?php echo $lead->leads_id; ?>">View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-lead" href="javascript:void(0);" data-name="<?= $lead->firstname.' '.$lead->lastname; ?>" data-company="<?= $lead->business_name; ?>" data-id="<?php echo $lead->leads_id; ?>">Delete</a>
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
                                <td colspan="11">
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

            <!--Add New Leads modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewLeads" tabindex="-1" aria-labelledby="modalAddNewLeadsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Lead</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-lead">
                        <div class="modal-body" style="height: 600px; overflow-y:scroll; overflow-x:hidden;">
                            <div class="section-title">General Information</div>
                            <div class="row">                                
                                <div class="col-md-6 mt-3 company-select">
                                    <label for="">Company</label>
                                    <select name="company_id" id="companyList" class="nsm-field mb-2 form-control add-company" required="">     
                                        <option value="" selected="">Select Company</option>           
                                        <?php foreach($companies as $c){ ?>
                                            <option value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Lead Type</label>                                    
                                    <select id="fk_lead_id" name="fk_lead_id"  class="form-control d-select2-lead-types" required>
                                        <option value="" selected="">Select Lead Type</option>   
                                    <?php foreach ($lead_types as $lt){ ?>
                                        <option value="<?= $lt->lead_id; ?>"><?= $lt->lead_name; ?></option>
                                    <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="company-fields">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="">Sales Representative</label>
                                        <select class="nsm-field mb-2 form-control" name="fk_sr_id" required="">
                                            <option value="">-Select Company-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="">Assigned To</label>
                                        <select class="nsm-field mb-2 form-control" name="fk_assign_id" required="">
                                            <option value="">-Select Company-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title mt-3">Contact Information</div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="">First Name</label>
                                    <input type="text" id="" name="firstname" class="form-control">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Middle Initial</label>
                                    <input type="text" id="" maxlength="1" name="middle_initial" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Name Suffix</label>
                                    <select id="suffix" name="suffix"  class="form-control">
                                    <?php for ($suffix=0;$suffix<14;$suffix++){ ?>
                                        <option value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" id="country" value="" class="nsm-field mb-2 form-control" required="">
                                    <label for="">Address</label>
                                    <textarea name="address" id="customer_address" class="nsm-field mb-2 form-control" style="height: 180px;" required=""><?= $user->address; ?></textarea>            
                                </div>
                                <div class="col-md-6 mt-3">                                    
                                    <label for="">County</label>
                                    <input type="text" name="county" id="county" value="" class="nsm-field mb-2 form-control" required="">  
                                    <label for="">City</label>
                                    <input type="text" name="city" value="" class="nsm-field mb-2 form-control" required="">            
                                    <label for="">State</label>
                                    <input type="text" name="state" id="state" value="" class="nsm-field mb-2 form-control" required="">
                                    <label for="">Zip Code</label>
                                    <input type="text" name="zip" value="" class="nsm-field mb-2 form-control" required="">
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6 mt-3">
                                    <label for="">Home/Panel Phone</label>
                                    <input type="text" name="phone_home" id="phone_home" maxlength="12" placeholder="xxx-xxx-xxxx" class="form-control">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Cell Phone </label>
                                    <input type="text" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_cell" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email_add" id="email_add" class="form-control">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Social Security Number </label>
                                    <input type="text" maxlength="11" placeholder="xxx-xx-xxxx" class="form-control" name="sss_num" id="sss_num">
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6 mt-3">
                                    <label for="">Date of Birth</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control dt-default" name="date_of_birth" id="date_of_birth">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Status </label>
                                    <select id="status" name="status"  class="form-control">
                                        <option value="New">New</option>
                                        <option value="Contacted">Contacted</option>
                                        <option value="Follow Up">Follow Up</option>
                                        <option value="Assigned">Assigned</option>
                                        <option value="Converted">Converted</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-lead">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--View Lead modal-->
            <div class="modal fade nsm-modal fade" id="modalViewLead" tabindex="-1" aria-labelledby="modalViewLeadLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Lead</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>                        
                        <div class="modal-body modal-view-lead-container"></div>                        
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $('.add-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $('.d-select2-lead-types').select2({
        placeholder: 'Select Lead Type',
        allowClear: true,
        width: 'resolve'            
    });

    $('.dt-default').datepicker({
        format: 'mm/dd/yyyy',
        widgetParent: 'body'
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/leads';
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

    $(document).on("click", ".delete-lead", function(e) {
        var lid = $(this).attr("data-id");
        var lead_name = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxDeleteLead';

        Swal.fire({
            title: 'Delete Lead',
            html: "Are you sure you want to delete lead <b>"+lead_name+"</b> from company <b>"+company_name+"</b>?",
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
                    data: {lid:lid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Leads Data Deleted Successfully!",
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
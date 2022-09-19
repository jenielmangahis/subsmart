<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.row-adt-project{
    background-color: #d1b3ff !important;
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
                            A great process of managing interactions with existing as well as past and
                            potential customers is to have one powerful platform that can provide an
                            immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and
                            more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('customer/import_customer') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Import
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('customer/customer_export') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Export
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Add Lead
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('customer/add_advance') ?>'">
                                <i class='bx bx-fw bx-chart'></i> New Customer
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_customer_list_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php if (!empty($enabled_table_headers)) : ?>
                    <table class="nsm-table customer-list" id="customer-list">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <?php if (in_array('name', $enabled_table_headers)) : ?><td data-name="Name">Name</td><?php endif; ?>
                                <?php if (in_array('industry', $enabled_table_headers)) : ?><td data-name="Name">Industry</td><?php endif; ?>
                                <?php if (in_array('city', $enabled_table_headers)) : ?><td data-name="City">City</td><?php endif; ?>
                                <?php if (in_array('state', $enabled_table_headers)) : ?><td data-name="State">State</td><?php endif; ?>
                                <?php if (in_array('source', $enabled_table_headers)) : ?><td data-name="Source">Source</td><?php endif; ?>
                                <?php if (in_array('added', $enabled_table_headers)) : ?><td data-name="Added">Added</td><?php endif; ?>
                                <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><td data-name="Sales Rep">Sales Rep</td><?php endif; ?>
                                <?php if (in_array('tech', $enabled_table_headers)) : ?><td data-name="Tech">Tech</td><?php endif; ?>
                                <?php if (in_array('plan_type', $enabled_table_headers)) : ?><td data-name="Plan Type">Plan Type</td><?php endif; ?>
                                <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><td data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> "><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> </td><?php endif; ?>
                                <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><td data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount' ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></td><?php endif; ?>
                                <?php if (in_array('phone', $enabled_table_headers)) : ?><td data-name="Phone">Phone</td><?php endif; ?>
                                <?php if (in_array('status', $enabled_table_headers)) : ?><td data-name="Status">Status</td><?php endif; ?>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($profiles)) :
                            ?>
                                <?php
                                foreach ($profiles as $customer) :
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
                                    <?php if (in_array('name', $enabled_table_headers)) : ?>
                                        <td>
                                            <div class="nsm-profile">
                                                <?php if ($customer->customer_type === 'Business'): ?>
                                                    <span>
                                                    <?php 
                                                        $parts = explode(' ', strtoupper(trim($customer->business_name)));
                                                        echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                                    ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span><?= ucwords($customer->first_name[0]) . ucwords($customer->last_name[0]) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('/customer/module/' . $customer->prof_id); ?>'">
                                                <?php if ($customer->customer_type === 'Business'): ?>
                                                    <?= $customer->business_name ?>
                                                <?php else: ?>
                                                    <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                <?php endif; ?>
                                            </label>
                                            <label class="nsm-link default content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (in_array('industry', $enabled_table_headers)) : ?>
                                        <td>
                                            <?php 
                                                if( $customer->industry_type_id > 0 ){
                                                    echo $customer->industry_type;
                                                }else{
                                                    echo 'Not Specified';                                                    
                                                }
                                            ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (in_array('city', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->city; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('state', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->state; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('source', $enabled_table_headers)) : ?>
                                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('added', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->entered_by; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                                        <td><?php print_r( get_sales_rep_name($customer->fk_sales_rep_office)); ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('tech', $enabled_table_headers)) : ?>
                                        <?php $techician = !empty($customer->technician) ?  get_employee_name($customer->technician)->FName : 'Not Assigned'; ?>
                                        <td><?= $techician; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->system_type; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                        <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                        <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_solar), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->phone_m; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('status', $enabled_table_headers)) : ?>
                                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                    <?php endif; ?>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('customer/preview_/' . $customer->prof_id); ?>">Preview</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('customer/add_advance/' . $customer->prof_id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="mailto:<?= $customer->email; ?>">Email</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item call-item" href="javascript:void(0);" data-id="<?= $customer->phone_m; ?>">Call</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('invoice/add/'); ?>">Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('customer/module/' . $customer->prof_id); ?>">Dashboard</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/new_job1/'); ?>">Schedule</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-messages" href="javascript:void(0);" data-id="<?= $customer->prof_id; ?>">Message</a>
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
                <?php else : ?>
                    
                    <table class="nsm-table " id="customer-list">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Name">Name   </td>
                                <?php if($companyId == 1): ?>
                                <td data-name="Name">Industry</td>
                                <?php endif; ?>
                                <td data-name="City">City</td>
                                <td data-name="State">State</td>
                                <td data-name="Source">Source</td>
                                <td data-name="Added">Added</td>
                                <td data-name="Sales Rep">Sales Rep</td>
                                <td data-name="<?= $companyId == 58 ? 'Mentor' : 'Tech'   ?>"><?= $companyId == 58 ? 'Mentor' : 'Tech'   ?></td>
                                <td data-name="Plan Type">Plan Type</td>
                                <td data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?>"><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?></td>
                                <td data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></td>
                                <td data-name="Phone">Phone</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       // $(".customer-list").nsmPagination();
       
        // $('#customer-list').DataTable({
        //     "lengthChange": true,
        //     "searching" : true,
        //     "pageLength": 10,
        //     "order": [],
        // });

        $('#customer-list').DataTable({
            // Processing indicator
            "processing": true,
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            // Load data from an Ajax source
            "ajax": {
                "url": "<?= base_url('customer/getCustomerLists'); ?>",
                "type": "POST"
            },
            // Load data from an Ajax source
            "createdRow": function( row, data, dataIndex){
                console.log(data);
                if( data[7] ==  'yes'){
                    $(row).addClass('row-adt-project');
                }
            },            
            //Set column definition initialisation properties
            "columnDefs": [{ 
                "targets": [0],
                "orderable": false
            }]
        });

        $(document).on("click", ".call-item", function() {
            let phone = $(this).attr("data-id");

            window.open('tel:' + phone);
        });

        $("#btn_print_customer_list").on("click", function() {
            $("#customer_table_print").printThis();
        });
    });

    $(document).on('click', '.btn-messages', function(){

        var profid = $(this).attr('data-id');
        var url = base_url + 'customer/_get_messages';

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

    $(document).on('submit', '#frm-send-message', function(e){
        e.preventDefault();

        var url = base_url + 'customer/_send_message';
        $(".btn-send-message").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-send-message")[0]);   

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
                    $("#messages_modal").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Customer message was successfully sent",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-send-message").html('Send');
             }
          });
        }, 800);
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
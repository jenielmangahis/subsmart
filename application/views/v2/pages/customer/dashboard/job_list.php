<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Job Number">Job Number</td>
                                <td data-name="Date">Date</td>
                                <td data-name="Tech Rep">Assigned Tech</td>    
                                <td data-name="Job Type">Job Type</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="text-align:right">Amount</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                if (!empty($jobs)) {
                                    foreach ($jobs as $job) {
                                    switch($job->status):
                                        case "New":
                                            $badgeCount = 1;
                                            break;
                                        case "Scheduled":
                                            $badgeCount = 2;
                                            break;
                                        case "Arrival":
                                            $badgeCount = 3;
                                            break;          
                                        case "Started":
                                            $badgeCount = 4;
                                            break;
                                        case "Approved":
                                            $badgeCount = 5;
                                            break;
                                        case "Closed":
                                            $badgeCount = 6;
                                            break;
                                        case "Invoiced":
                                            $badgeCount = 7;
                                            break;
                                        case "Completed":
                                        case "Finished":
                                            $badgeCount = 8;
                                            break;
                                    endswitch;
                                ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                                </td>
                                <td class="fw-bold nsm-text-primary">                                
                                    <?= $job->job_number; ?>
                                </td>
                                <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                <td>
                                    <?php
                                        $employeeFields = [
                                            'employee_id',
                                            'employee2_id',
                                            'employee3_id',
                                            'employee4_id',
                                            'employee5_id',
                                            'employee6_id',
                                        ];
                                    ?>
                                    <?php if(!empty($employees)): ?>
                                        <div class="techs">
                                            <?php foreach ($employees as $employee): ?>
                                                <?php foreach ($employeeFields as $employeeField): ?>
                                                    <?php if ($job->$employeeField == $employee['id']): ?>
                                                        <?= jobsmodule__getEmployeeAvatar($employee); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>                          
                                <td><?php echo $job->job_type != '' ? $job->job_type : '---'; ?></td>
                                <td><?php echo $job->status; ?></td>
                                <td style="text-align:right;">$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= $job->id; ?>">Preview</a>
                                            </li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('job/edit/') . $job->id; ?>">Edit</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));
    });

    $(document).on('click touchstart', '.recordPaymentBtn', function(){
        var invoice_id = $(this).attr('data-id');

        $('#modalRecordPaymentForm').modal('show');
        $("#modalRecordPaymentForm .modal-body").html('<div class="alert alert-info alert-purple" role="alert">Loading...</div>');

        $('#record_payment_invoice_id').val(invoice_id);

        $.ajax({
            url: base_url + "invoice/_load_record_payment_form",
            type: "POST",
            data: {
                invoice_id: invoice_id
            },
            success: function (response) {
                $("#modalRecordPaymentForm .modal-body").html(response);
            },
        });
    });

    $(document).on('submit', '#frm-record-payment', function(e){
        e.preventDefault();
        var url  = base_url + 'invoice/_create_payment';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(), 
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modalRecordPaymentForm').modal('hide');
                    
                    Swal.fire({
                        text: 'Invoice payment was successfully created',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-record-payment").html('Save');
            }, beforeSend: function() {
                $("#btn-record-payment").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
</script>
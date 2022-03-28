<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row">
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
                            A great process of managing interactions with existing as well as past and potential customers 
                            is to have one powerful platform that can provide an immediate response to your customer needs. 
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your 
                            customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Add New Lead
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
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
                                    <td class="fw-bold nsm-text-primary"><?= $lead->firstname.' '.$lead->lastname; ?></td>
                                    <td><?= $lead->city ?></td>
                                    <td><?= $lead->state ?></td>
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
                                                    <a class="dropdown-item" href="<?php echo url('/customer/add_lead/'.$lead->leads_id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo url('/customer/add_lead/'.$lead->leads_id); ?>">Send SMS</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="mailto:<?= $lead->email_add; ?>">Send Email</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $lead->leads_id; ?>">Delete</a>
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
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Lead',
                text: "Are you sure you want to delete this lead?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/remove_lead",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if(result === "Done"){
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
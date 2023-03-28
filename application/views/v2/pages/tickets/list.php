<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<style>
.dataTables_filter, .dataTables_length{
    display: none;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('estimate') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="custom-ticket-searchbar" name="search" placeholder="Search Tickets" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Newest First</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-desc">Newest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-asc">Oldest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-desc">Accepted: newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-asc">Accepted: oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-asc">Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-desc">Number: Desc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-asc">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-desc">Amount: Highest</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
                                <i class='bx bx-fw bx-note'></i> Add Tickets
                            </button>
                        </div>
                    </div>
                </div>

                <table class="nsm-table" id="ticket-list-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td class="table-icon"></td>
                            <td data-name="Work Order Number">Ticket No.</td>
                            <td data-name="Date Issued">Date Created</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tickets as $ticket){ ?>
                        <tr>
                            <td style="text-align:center;"><input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0"></td>
                            <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                            <td><b><?php echo $ticket->ticket_no; ?></b></td>
                            <td><?php $originalDate = $ticket->created_at;
                                $newDate = date("M d, Y", strtotime($originalDate)); echo $newDate; ?></td>
                            <td><?php echo $ticket->first_name.' '.$ticket->last_name; ?></td>
                            <td><?php echo $ticket->ticket_status; ?></td>
                            <td>$<?php echo number_format($ticket->grandtotal,2); ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo base_url('tickets/viewDetails/' . $ticket->id) ?>">View</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('tickets/editDetails/' . $ticket->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-ticket" href="javascript:void(0);" data-tk-id="<?php echo $ticket->id; ?>">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var ticketListTable = $("#ticket-list-table").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#custom-ticket-searchbar").keyup(function() {
            ticketListTable.search($(this).val()).draw()
        });
    });
</script>
<?php //include viewPath('includes/footer'); ?>
<script>
    $(document).on('click', '.delete-ticket', function(){
        var tkID = $(this).attr('data-tk-id');
            Swal.fire({
                title: 'Delete Service Ticket',
                text: "Are you sure you want to delete this Ticket?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo base_url(); ?>tickets/deleteTicket',
                        dataType: 'json',
                        data: {tkID: tkID},
                        success: function(result) {
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
                        },
                    });

                }
            });
        });

        
        function sucess(information,$id){
            Swal.fire({
                title: 'OK!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        }
</script>
<?php include viewPath('v2/includes/footer'); ?>
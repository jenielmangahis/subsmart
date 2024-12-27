<?php include viewPath('v2/includes/header_clienthub'); ?>

<style>

</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_portal_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When an invoice is created in our CRM, a statement summary of your customer's account listing recent invoices will display here for you to view. The statement shows per invoice not per items.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 grid-mb">
                        <form action="<?php echo base_url('/') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>   
                    </div>                      
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container"></div>
                    </div>
                </div>                 

                <div class="row">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td data-name="Date Issued">Date Issued</td>
                                <td data-name="Invoice Number">Invoice Number</td>
                                <td data-name="Amount">Amount</td>                               
                                <td data-name="Balance">Balance</td>
                                <td data-name="Due Date">Due Date</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Action"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($invoices as $invoice) { ?>                         
                            <tr>
                                <td>
                                    <?php
                                        if( $invoice->date_issued != '' ){
                                            $myDateTime = DateTime::createFromFormat('Y-m-d', $invoice->date_issued);
                                            echo $newDateString = $myDateTime->format('m/d/Y');
                                        }else{
                                            echo 'Not Specified';
                                        }                                
                                    ?>
                                </td>                                
                                <td class="fw-bold nsm-text-primary">                       
                                    <?php echo $invoice->invoice_number; ?>
                                </td>
                                <td>$<?= number_format($invoice->grand_total,2) ?></td>
                                <td>$<?= $invoice->balance > 0 ? number_format($invoice->balance,2) : '0.00'; ?></td>
                                <td>
                                    <?php
                                        if( $invoice->due_date != '' ){
                                            $myDateTime = DateTime::createFromFormat('Y-m-d', $invoice->due_date);
                                            echo $newDateString = $myDateTime->format('m-d-Y');
                                        }else{
                                            echo 'Not Specified';
                                        }                                
                                    ?>                                    
                                </td>
                                <td><?= $invoice->INV_status != '' ? $invoice->INV_status : 'Draft'; ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?php //echo $ticket->id; ?>">View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>" target="_blank">Invoice PDF</a>
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
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));        
    });
</script>

<?php include viewPath('v2/includes/footer_clienthub'); ?>
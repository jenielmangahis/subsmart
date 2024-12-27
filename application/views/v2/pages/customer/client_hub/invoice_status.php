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
                                                <a class="dropdown-item view-invoice-row" href="javascript:void(0);" data-id="<?php echo $invoice->id; ?>">View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?php echo base_url('client_hub/invoice_preview_pdf/'. $invoice->id . '?format=pdf') ?>" target="_blank">Invoice PDF</a>
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

    <div class="modal fade nsm-modal fade" id="modal-quick-view-invoice" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-invoice-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Invoice</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="max-height:700px; overflow: auto;">
                    <input type="hidden" id="view-ticket-id" value="" />
                    <div id="view-invoice-container" class="view-invoice-container"></div>
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
        
        $('.view-invoice-row').on('click', function(){
            var invoice_id = $(this).attr('data-id');
            var format     = 'html';
            var url = base_url + 'client_hub/_quick_view_invoice/public';

            $('#modal-quick-view-invoice').modal('show');

            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {invoice_id: invoice_id, format: format},
                    success: function(result) {
                        $("#view-invoice-container").html(result);
                    },
                    beforeSend: function() {
                        $('#view-invoice-container').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });  
            }, 500);

        });     

    });
</script>

<?php include viewPath('v2/includes/footer_clienthub'); ?>
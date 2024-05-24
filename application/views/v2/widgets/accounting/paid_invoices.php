<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
.widget-tile-paid-invoices:hover{
    cursor:pointer;
}
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Paid Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>">
                See Reports
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row mb-4 mt-2">
            <div class="col-4">
                <select class="nsm-field form-select" name="filter_date" id="widget-paid-invoices-filter-date">                                                
                    <option value="today">Today</option>                        
                    <option value="custom">Custom</option>
                    <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                    <option value="this-month">This month</option>
                    <option value="this-quarter">This quarter</option>
                    <option value="this-year" selected="">This year</option>
                </select>
            </div>
            <div class="col-4">
                <input type="date" id="widget-paid-invoices-filter-from" class="nsm-field form-control date" value="<?= date("Y-01-01"); ?>" />
            </div>
            <div class="col-4">
                <input type="date" id="widget-paid-invoices-filter-to" class="nsm-field form-control date" value="<?= date("Y-12-31"); ?>" required>
            </div>
        </div>   
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="nsm-counter primary mb-2 widget-tile-paid-invoices">
                    <div class="row">
                        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                            <i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="widget-paid-invoices-total-amount">$0.00</h2>
                            <span>Total Amount Paid Invoices</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="nsm-counter primary mb-2 widget-tile-paid-invoices">
                    <div class="row">
                        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                            <i class='bx bx-box'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="widget-paid-invoices-total-number">0</h2>
                            <span>Total Paid invoices</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
$(function(){
    $('#widget-paid-invoices-filter-date').on('change', function(){
        switch($(this).val()) {
            case 'today' :
                var date = new Date();
                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            break;
            case 'this-week' :
                var date = new Date();
                var from = date.getDate() - date.getDay();
                var to = from + 6;

                var from_date = new Date(date.setDate(from));
                var to_date = new Date(date.setDate(to));

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'this-month' :
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'this-quarter' :
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
                switch(currQuarter) {
                    case 1 :
                        var from_date = '01/01/' + date.getFullYear();
                        var to_date = '03/31/'+ date.getFullYear();
                    break;
                    case 2 :
                        var from_date = '04/01/' + date.getFullYear();
                        var to_date = '06/30/'+ date.getFullYear();
                    break;
                    case 3 :
                        var from_date = '07/01/' + date.getFullYear();
                        var to_date = '09/30/'+ date.getFullYear();
                    break;
                    case 4 :
                        var from_date = '10/01/' + date.getFullYear();
                        var to_date = '12/31/'+ date.getFullYear();
                    break;
                }
            break;
            case 'this-year' :
                var date = new Date();

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
            default :
                var from_date = '';
                var to_date = '';
            break;
        }

        $('#widget-paid-invoices-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
        $('#widget-paid-invoices-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

        loadSummaryPaidInvoices();
    });

    loadSummaryPaidInvoices();

    $('#widget-paid-invoices-filter-from, #widget-paid-invoices-filter-to').on('change', function(){
        loadSummaryPaidInvoices();
    });

    function loadSummaryPaidInvoices(){
        var filter_date_from = $('#widget-paid-invoices-filter-from').val();
        var filter_date_to   = $('#widget-paid-invoices-filter-to').val();

        $.ajax({
            url: base_url + 'widgets/_load_paid_invoices_summary',
            method: 'post',
            data: {filter_date_from:filter_date_from,filter_date_to:filter_date_to},
            dataType:'json',
            success: function (response) {
                $('#widget-paid-invoices-total-amount').text('$'+response.paid_invoices_total_amount);
                $('#widget-paid-invoices-total-number').text(response.paid_invoices_total_number);
            }
        });
    }

    $('.widget-tile-paid-invoices').on('click', function(){
        location.href = base_url + 'invoice/tab/5';
    });
});
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>
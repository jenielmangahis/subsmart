<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.row-group-header{
    background-color: #cccccc;
    padding: 5px;
    font-size: 18px;
}
.row-customer-name{
    font-size: 16px;
    font-weight: bold;
    padding-left: 10px;    
}
.nsm-table .bx-user-pin{
    position: relative;
    top: 2px;
}
.row-table-header{
    background-color: #6a4a86;
    color: #ffffff !important;
}
.nsm-button:hover {
    border-color: rgba(106, 74, 134, 0.1);
    background-color: #ffffff;
    color: #6a4a86;
}
</style>
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
                            <button><i class='bx bx-x'></i></button>                                                        
                            History of customer purchased items.
                        </div>                        
                    </div>
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <select id="inventory-list-filter" class="dropdown-toggle nsm-button">
                                <option value="all" <?= $filter == 'all' ? 'selected="selected"' : ''; ?>>All</option>
                                <option value="jobs" <?= $filter == 'jobs' ? 'selected="selected"' : ''; ?>>Jobs</option>
                                <option value="services" <?= $filter == 'services' ? 'selected="selected"' : ''; ?>>Services</option>                                    
                            </select>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr class="row-table-header">
                            <th colspan="5">
                                <span class="row-customer-name"><i class='bx bx-user-pin' ></i> Customer : <?= $customer->first_name . ' ' . $customer->last_name; ?></b></span>
                            </th>
                        </tr>
                        <tr class="row-table-header">
                            <td class="table-icon"></td>
                            <td data-name="Item Name">Item Name</td>
                            <td data-name="Quantity">Quantity</td>
                            <td data-name="Price" style="text-align:right;">Price</td>
                            <td data-name="Total" style="text-align:right;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($inventory)) :
                        ?>
                            <?php
                            foreach ($inventory as $i) :
                            ?>
                                <tr>
                                    <td class="row-group-header">
                                        <div class="table-row-icon">
                                            <i class='bx bx-sitemap'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary row-group-header" colspan="4">
                                        <?php if( $i['type'] == 'job' ){ ?>
                                            <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('job/job_preview/' . $i['job']->id); ?>'"><?= $i['job']->job_number; ?></label>
                                        <?php }else{ ?>
                                            <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('tickets/viewDetails/' . $i['ticket']->id); ?>'"><?= $i['ticket']->ticket_no; ?></label>
                                        <?php } ?>
                                        
                                    </td>
                                </tr>
                                <?php if( $i['type'] == 'job' ){ ?>
                                    <?php $total_amount = 0; ?>
                                    <?php foreach ($i['items'] as $item) { ?>
                                        <?php
                                            $total_row_price = $item->price * $item->qty;
                                            $total_amount += $total_row_price;
                                        ?>
                                        <tr>                                        
                                            <td class="nsm-text-primary" colspan="2">
                                                <label class="nsm-link default d-block fw-bold"><?= $item->title; ?></label>
                                            </td>
                                            <td style="width:10%;"><?= $item->qty; ?></td>
                                            <td style="width:10%;text-align: right;"><?= number_format($item->price, 2); ?></td>
                                            <td style="text-align:right;width:10%;"><?= number_format($total_row_price, 2); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>                                    
                                        <td class="nsm-text-primary" colspan="2">
                                            <label class="nsm-link default d-block fw-bold">Total</label>
                                        </td>
                                        <td colspan="3" style="text-align:right;"><b><?= number_format($total_amount,2); ?></b></td>
                                    </tr>
                                <?php }else{ ?>
                                    <?php $total_amount = 0; ?>
                                    <?php foreach ($i['items'] as $item) { ?>
                                        <?php
                                            $total_row_price = $item->cost * $item->qty;
                                            $total_amount += $total_row_price;
                                        ?>
                                        <tr>                                        
                                            <td class="nsm-text-primary" colspan="2">
                                                <label class="nsm-link default d-block fw-bold"><?= $item->item_name; ?></label>
                                            </td>
                                            <td style="width:10%;"><?= $item->qty; ?></td>
                                            <td style="width:10%;text-align: right;"><?= number_format($item->cost, 2); ?></td>
                                            <td style="text-align:right;width:10%;"><?= number_format($total_row_price, 2); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>                                    
                                        <td class="nsm-text-primary" colspan="2">
                                            <label class="nsm-link default d-block fw-bold">Total</label>
                                        </td>
                                        <td colspan="3" style="text-align:right;"><b><?= number_format($total_amount,2); ?></b></td>
                                    </tr>
                                <?php } ?>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
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
        //$(".nsm-table").nsmPagination();
        $('#inventory-list-filter').on('change', function(){
            var selected = $(this).val();
            if( selected == 'all' ){
                location.href = base_url + 'customer/inventory_list/<?= $cus_id; ?>';
            }else{
                location.href = base_url + 'customer/inventory_list/<?= $cus_id; ?>?filter=' + selected;    
            }
            
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
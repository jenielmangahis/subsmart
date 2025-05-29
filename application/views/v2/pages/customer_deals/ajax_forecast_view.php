<style>
.deal-stage-container{
    min-height:200px;
}
.stage-deal{
    z-index: 9999 !important;
}
</style>

<?php foreach($quarter_months as $key => $value){ ?>
<div class="col">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <div class="row">
                    <div class="col"><div class="d-block h3"><b><i class='bx bx-calendar'></i> <?= $key; ?></b></div></div>
                    <div class="col text-end">
                        <div class="forecast-month-summary">
                            <span><i class='bx bx-chart'></i> $<?= number_format($customerDeals[$key]['sum_others'],2,".",","); ?></span>
                            <span class="forecast-month-won-total">$<?= number_format($customerDeals[$key]['sum_won'],2,".",","); ?></span>
                            <span>$<?= number_format($customerDeals[$key]['sum_total'],2,".",","); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="nsm-card-content">
            <div class="deal-stage-container" id="deal-month-container-<?= strtolower($key); ?>">
                <?php foreach($customerDeals[$key]['deals'] as $deals){ ?>
                    <?php 
                        $drop_date  = $key . ' 01, ' . date("Y");
                        $date_index = date("Y-m-01", strtotime($drop_date)); 
                    ?>
                    <div class="col-12 col-md-12 col-sm-12 stage-deal mt-2 deal-month-item" data-date="<?= $date_index; ?>" data-name="<?= $deals->deal_title; ?>" data-id="<?= $deals->id; ?>">
                        <div class="nsm-card nsm-grid">
                            <div class="nsm-card-title">
                                <div class="stage-deal-title-container">
                                    <span class="stage-deal-name"><?= $deals->deal_title; ?></span>
                                    <div class="float-end stage-deals-actions">
                                        <a class="nsm nsm-button btn-small btn-view-customer-deals" data-id="<?= $deals->id; ?>"><i class='bx bx-search-alt-2'></i></a>
                                        <a class="nsm nsm-button btn-small btn-view-activity-scheduled <?= $deals->is_with_overdue == 1 ? 'btn-activity-scheduled-with-overdue' : ''; ?>" data-id="<?= $deals->id; ?>"><i class='bx bx-calendar'></i></a>
                                    </div>
                                </div>
                                <span class="text-muted"><?= $deals->customer_firstname . ' ' . $deals->customer_lastname; ?></span><br />
                                <span class="text-muted"><i class='bx bx-user-circle' ></i> $<?= number_format($deals->value,2); ?></span>
                                
                            </div>                                
                        </div>
                    </div>
                <?php } ?>
            </div>  
        </div>        
    </div>
</div>
<?php } ?>
<script>
$(function(){
    <?php foreach($quarter_months as $key => $value){ ?>
        $("#deal-month-container-<?= strtolower($key); ?>").droppable({
            accept: ".deal-month-item",
            drop: function(event, ui) {
                let item = $(ui.draggable[0]);
                let deal_id   = item.attr('data-id');
                let date_item = item.attr('data-date');
                if( deal_id > 0 ){
                    let html_content = `
                        <div class="row mark-lost-form">
                            <div class="col-sm-12">
                                <label class="mb-2">Expected close date</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" value='${date_item}' id="expected-close-date" />
                                </div>
                            </div>
                        </div>
                    `;       

                    Swal.fire({            
                        title: 'Change expected close date',            
                        html: html_content,
                        icon: false,
                        confirmButtonColor: '#3085d6',
                        showCancelButton: true,
                        confirmButtonText: 'Save',                    
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let expected_close_date  = $('#expected-close-date').val();
                            $.ajax({
                                type: "POST",
                                url: base_url + "customer_deals/_update_customer_deal_status",
                                data:{deal_id:deal_id, expected_close_date:expected_close_date},
                                dataType:'json',
                                success: function(result) {                            
                                    if( result.is_success == 1 ) {
                                        ui.draggable.remove();
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'Mark as lost',
                                        text: 'Customer deal was updated successfully.',
                                        }).then((result) => {
                                            load_deal_stages();
                                        });
                                    } else {
                                        ui.draggable.draggable('option','revert',true); 
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: result.msg,
                                        });
                                    }
                                }
                            });
                        }
                    });
                }        
            }
        });
    <?php } ?>

    $(".deal-month-item").draggable({
        revert: "invalid",
        helper: "clone",
        start: function(event, ui) {
            ui.helper.width($(this).width());
            $('#customer-deal-lost-container').slideDown(300);
        },
        stop: function(event, ui) {            
            $('#customer-deal-lost-container').hide();
        },
        cursor: "move"
    });
});
</script>
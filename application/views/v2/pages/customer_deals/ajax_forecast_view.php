<style>
.deal-stage-container{
    /* height:calc(100% + 200px); */
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
                        <div class="forecast-month-summary float-end">
                            <span class="forecast-month-others-total" id="<?= strtolower($key); ?>-sum-others"><i class='bx bx-chart'></i> $<?= number_format($customerDeals[$key]['sum_others'],2,".",","); ?></span>
                            <span class="forecast-month-won-total" id="<?= strtolower($key); ?>-sum-won">$<?= number_format($customerDeals[$key]['sum_won'],2,".",","); ?></span>
                            <span class="forecast-month-sum-total" id="<?= strtolower($key); ?>-sum-total">$<?= number_format($customerDeals[$key]['sum_total'],2,".",","); ?></span>
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

    $('.btn-view-customer-deals').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'View customer deal';
        }
    });

    $('.btn-view-activity-scheduled').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Schedule an activity';
        }
    });

    $('.forecast-month-sum-total').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            let amount = $(this).text();
            return `<b>${amount}</b> is the potential value for this period combining the value of won and open deals`;
        }
    });

    <?php foreach($quarter_months as $key => $value){ ?>        
        $("#deal-month-container-<?= strtolower($key); ?>").droppable({
            <?php 
                $drop_date  = $key . ' 01, ' . date("Y");
                $date_index = date("Y-m-01", strtotime($drop_date)); 
            ?>
            accept: ".deal-month-item",
            drop: function(event, ui) {
                let item = $(ui.draggable[0]);
                let deal_id   = item.attr('data-id');
                let deal_date = item.attr('data-date');
                let droppable_date = '<?= $date_index; ?>';
                console.log('droppable_date', droppable_date);
                console.log('deal_date', deal_date);
                if( deal_id > 0 && droppable_date != deal_date ){
                    let html_content = `
                        <div class="row mark-lost-form">
                            <div class="col-sm-12">
                                <label class="mb-2">Pick a new date for the Expected close date</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" value='${droppable_date}' id="expected-close-date" />
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
                                url: base_url + "customer_deals/_update_expected_close_date",
                                data:{deal_id:deal_id, expected_close_date:expected_close_date},
                                dataType:'json',
                                success: function(data) {                            
                                    if( data.is_success == 1 ) {
                                        //ui.draggable.remove();
                                        $("#deal-month-container-<?= strtolower($key); ?>").append(ui.draggable);   
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'Change expected close date',
                                        text: 'Customer deal was updated successfully.',
                                        }).then((result) => {
                                            load_deal_month_summary('<?= $key; ?>');
                                            load_deal_month_summary(data.previous_month);
                                        });
                                    } else {
                                        ui.draggable.draggable('option','revert',true); 
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: data.msg,
                                        });
                                    }
                                }
                            });
                        }
                    });
                }     
                //$(this).append(ui.draggable);           
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

    function load_deal_month_summary(month_name){
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_deal_month_summary",
            data:{month_name:month_name},
            dataType:'json',
            success: function(data) { 

                let sum_others  = `<i class='bx bx-chart'></i> $${parseFloat(data.sum_others).toFixed(2)}`;
                let sum_won     = parseFloat(data.sum_won).toFixed(2);
                let sum_total   = parseFloat(data.sum_total).toFixed(2);
                let month_index = month_name.toLowerCase();
                $(`#${month_index}-sum-others`).html(sum_others);
                $(`#${month_index}-sum-won`).html(sum_won);
                $(`#${month_index}-sum-total`).html(sum_total);
            },
            beforeSend: function() {
                
            }
        });
    }
});
</script>
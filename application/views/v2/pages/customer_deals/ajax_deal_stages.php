<style>
.deal-stage-container{
    min-height:200px;
}
.stage-deal{
    z-index: 9999 !important;
}
</style>
<?php foreach($customerDealStages as $stage){ ?>
<div class="col">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <div class="d-block h5">
                    <b><?= $stage->name; ?></b>
                    <span class="float-end">
                        <a class="nsm nsm-link btn-edit-deal-stage" href="javascript:void(0);" data-id="<?= $stage->id; ?>"><i class='bx bxs-edit'></i></a>
                        <a class="nsm nsm-link btn-delete-deal-stage" href="javascript:void(0);" data-name="<?= $stage->name; ?>" data-id="<?= $stage->id; ?>"><i class='bx bx-trash'></i></a>
                    </span>
                </div>
                <div class="text-muted deal-stage-summary">
                    <span id="stage-<?= $stage->id ?>-total-amount">$<?= number_format($customerDeals[$stage->id]['total_value'],2) ?></span> - 
                    <span id="stage-<?= $stage->id ?>-total-deals"><?= $customerDeals[$stage->id]['total_deals']; ?> <?= $customerDeals[$stage->id]['total_deals'] > 1 ? 'Deals' : 'Deal'; ?></span>
                </div>
            </div>
        </div>
        <hr />
        <div class="nsm-card-content">
            <div class="deal-stage-container" id="deal-stage-container-<?= $stage->id; ?>">
                <?php if( array_key_exists($stage->id, $customerDeals) && $customerDeals[$stage->id]['deals'] ){ ?>
                    <?php foreach( $customerDeals[$stage->id]['deals'] as $deals ){ ?>
                        <div class="col-12 col-md-12 col-sm-12 stage-deal mt-2 deal-stage-item" data-id="<?= $deals->id; ?>">
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
                <?php } ?>  
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12 mt-2">
                    <div class="nsm-grid stage-create-deal-container">
                        <a class="nsm nsm-button stage-quick-add-deal-btn text-center" href="javascript:void(0);" data-id="<?= $stage->id; ?>" style="display:none;"><i class='bx bx-plus'></i></a>
                    </div>
                </div>
            </div>       
        </div>        
    </div>
</div>
<?php } ?>
<script>
$(function(){
    <?php foreach($customerDealStages as $stage){ ?>
        $("#deal-stage-container-<?= $stage->id; ?>").droppable({
            accept: ".deal-stage-item",
            drop: function(event, ui) {
                let item = $(ui.draggable[0]);
                let deal_id  = item.attr('data-id');
                let stage_id = '<?= $stage->id; ?>';
                if( deal_id > 0 ){
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer_deals/_update_customer_deal_stage",
                        data:{deal_id:deal_id, stage_id:stage_id},
                        dataType:'json',
                        success: function(data) {    
                            load_deal_stage_summary(data.previous_stage_id);
                            load_deal_stage_summary(stage_id);
                        },
                        beforeSend: function() {
                            
                        }
                    });
                }
                
                $(this).append(ui.draggable);                
            }
        });
    <?php } ?>
    
    $(".deal-stage-item").draggable({
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

    $('.stage-create-deal-container').hover(
        function(){
            $(this).find('.stage-quick-add-deal-btn').show();
        },
        function(){
            $(this).find('.stage-quick-add-deal-btn').hide();
        }
    );

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

    function load_deal_stage_summary(stage_id){
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_deal_stage_summary",
            data:{stage_id:stage_id},
            dataType:'json',
            success: function(data) {   
                
                let total_deals = data.total_records + ' deal';
                if( data.total_records > 1 ){
                    total_deals = data.total_records + ' deals';
                }

                $(`#stage-${stage_id}-total-amount`).text(data.total_value);
                $(`#stage-${stage_id}-total-deals`).text(total_deals);
            },
            beforeSend: function() {
                
            }
        });
    }
});
</script>
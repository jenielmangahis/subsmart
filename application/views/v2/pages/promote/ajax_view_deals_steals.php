<style>
.box {
    border: 1px solid #dfdfdf;
    padding: 20px;
}
.package-price-original {
    text-decoration: line-through;
}
.text-right{
    text-align: right;
}
</style>
<div class="row page-content g-0">
    <div class="col-md-12 pl-0 pr-0 left" style="background-color: #ffffff !important;">
        <div class="box">
            <div class="form-group">
                <h3 style="font-size: 26px;"><?= $dealsSteals->title; ?></h3>
                <h3 class="text-muted" style="font-size: 16px;">$<?= number_format($dealsSteals->deal_price,2); ?></h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php 
                        $diff_increase  = $dealsSteals->original_price - $dealsSteals->deal_price;
                        $percentage_off = ($diff_increase / $dealsSteals->original_price) * 100; 
                    ?>
                    <span class="text-ter">was <span style="font-size:18px;">$<?= number_format($dealsSteals->original_price,2); ?></span> you get <span style="font-size: 18px;"><?= number_format($percentage_off,2); ?>%</span> off</span>
                </div>
                <div class="col-md-6 text-right">
                    <span class="text-ter"><i class='bx bx-time'></i> Expires in <span data-shop="valid-days">30</span> days</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>" style="width: 100%;">
                </div>                           
                <div class="col-md-12">
                    <hr />
                    <div style="font-size:18px; font-weight: bold; margin-top: 30px;">Terms &amp; Conditions</div>
                    <div style="font-size: 16px;"><?= $dealsSteals->terms_conditions; ?></div>
                </div>
                <div class="col-md-12 text-end">
                    <?php
                        $slug = createSlug($dealsSteals->title,'-');
                        $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
                    ?>  
                    <a class="nsm-button primary" href="<?= $deal_url; ?>" target="_new">View Deal Page</a>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){

});
</script>
<table class="nsm-table" id="widget-nsmart-coupon-codes">
    <thead>
        <tr>
            <td data-name="Name">Code</td>
            <?php if( $is_used == 1 ){ ?>
            <td data-name="Client">Company</td>                
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($coupon_codes) { ?>
            <?php foreach($coupon_codes as $c){ ?>
                <tr>
                    <td class="nsm-text-primary"><?= $c->offer_code; ?></td>
                    <?php if( $is_used == 1 ){ ?>
                    <td class="nsm-text-primary"><?= $c->client_name != '' ? $c->client_name : '---'; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="3">
                    <div class="nsm-empty">
                        <span>No results found</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#widget-nsmart-coupon-codes").nsmPagination();
});
</script>
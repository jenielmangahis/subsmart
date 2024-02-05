<style>
.row-header{
    background-color: #6a4a86;
    color:#ffffff;    
}
.row-subheader{
    background-color:#cccccc;
    font-weight:bold;
}
.row-item-data .nsm-button{
  margin-right:5px;
}
.row-item-data .nsm-button i{
    position: relative;
    top: 2px;
}
</style>
<table class="nsm-table" id="nsm-table-services">
    <thead>
        <tr>
            <td data-name="ServiceName" class="row-header">Service Name</td>
            <td data-name="ServicePrice" class="row-header" style="text-align:right;">Price</td>
        </tr>
    </thead>
    <tbody>
    <?php if( $companyServices ){ ?>
        <?php foreach($companyServices as $item){ ?>
            <tr>
                <td class="row-item-data">
                        <button type="button" class="nsm-button primary small add-services" data-servicename="<?= $item['services']['name']; ?>" data-itemid="<?= $item['services']['id']; ?>" data-itemprice="<?= $item['services']['price']; ?>" data-onhand="1">
                            <i class='bx bx-plus-medical'></i>
                        </button>
                    <?= $item['services']['name']; ?>
                </td>
                <td class="row-item-data" style="text-align:right">$<?= number_format($item['services']['price'],2,'.',''); ?></td>
            </tr>   
        <?php } ?>
    <?php }else{ ?>
        <tr><td colspan="2">No records found</td></tr>
    <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#nsm-table-services").nsmPagination();    

    $('.add-services').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Add services to list';
        } 
    });
});
</script>
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
<table class="nsm-table" id="nsm-table-products">
    <thead>
        <tr>
            <td class="table-icon text-center"></td>
            <td class="table-icon"></td>
        </tr>
    </thead>
    <tbody>
    <?php if( $companyItems ){ ?>
        <?php foreach($companyItems as $item){ ?>
            <tr>
                <td colspan="1" class="row-header">Item Name : <?= $item['item']['name']; ?></td>
                <td class="row-header" style="text-align:right">Price : $<?= number_format($item['item']['price'],2,'.',''); ?></td>
            </tr>   
            <tr>
                <td class="row-subheader">Storage Location</td>
                <td class="row-subheader" style="text-align:right">Quantity</td>
            </tr>         
            <?php foreach($item['storage'] as $storage){ ?>
                <tr>
                    <td>
                        <div class="row-item-data">
                            <button type="button" class="nsm-button primary small add-product" data-productname="<?= $item['item']['name']; ?>" data-storageid="<?= $storage->loc_id; ?>" data-itemid="<?= $item['item']['id']; ?>" data-itemprice="<?= $item['item']['price']; ?>" data-onhand="<?= $storage->qty; ?>">
                                <i class='bx bx-plus-medical'></i>
                            </button>
                            <?= $storage->storage_location == '' ? 'Storage name not found' : $storage->storage_location; ?>
                        </div>
                    </td>
                    <td style="text-align:right"><?= $storage->qty > 0 ? $storage->qty : 0; ?></td>                    
                </tr>
            <?php } ?>
        <?php } ?>
    <?php }else{ ?>
        <tr><td colspan="2">No records found</td></tr>
    <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#nsm-table-products").nsmPagination();    
});
</script>
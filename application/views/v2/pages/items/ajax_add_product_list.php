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
.add-product, .edit-product-stock{
    margin:1px !important;
}
.item-storage-name{
    margin-left:11px;
}
#nsm-table-products tbody{
    display: block;
    max-height:650px;
    overflow-y: scroll;
}
#nsm-table-products thead, #nsm-table-products tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;/* even columns width , fix width of table too*/
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
                <td class="row-subheader" style="text-align:right">Stock</td>
            </tr>         
            <?php foreach($item['storage'] as $storage){ ?>
                <tr>
                    <td>
                        <div class="row-item-data">
                            <button type="button" class="nsm-button primary small add-product" data-productname="<?= $item['item']['name']; ?>" data-storageid="<?= $storage->loc_id; ?>" data-itemid="<?= $item['item']['id']; ?>" data-itemprice="<?= $item['item']['price']; ?>" data-onhand="<?= $storage->qty; ?>">
                                <i class='bx bx-plus-medical'></i>
                            </button>
                            <button type="button" class="nsm-button primary small edit-product-stock" data-storageid="<?= $storage->loc_id; ?>" data-itemid="<?= $item['item']['id']; ?>">
                                <i class='bx bxs-pencil'></i>
                            </button>
                            <span class="item-storage-name"><?= $storage->storage_location == '' ? 'Storage name not found' : $storage->storage_location; ?></span>
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
    $("#nsm-table-products").nsmPagination({itemsPerPage:15});    

    $('.add-product').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Add product to list';
        } 
    });

    $('.edit-product-stock').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Edit product stock';
        } 
    });
});
</script>
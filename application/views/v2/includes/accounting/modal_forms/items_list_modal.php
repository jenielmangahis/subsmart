<!-- Modal -->
<style>
.disabled-button {
    background-color: #ccc;
    cursor: not-allowed;
}
#item_list .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#item_list .modal-body{
    overflow-x:hidden;
}
#item_list #item-table td:nth-child(8){
 text-align:right !important;
}
</style>
<div class="modal fade nsm-modal" id="item_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="items-lists-modal-label">Item Lists</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table id="items_table" class="nsm-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td style="width:50%;">Name</td>
                                    <td>Location</td>
                                    <td style="width:10%;">Qty</td>
                                    <td style="width:10%;text-align:right">Price</td>
                                    <td style="width:5%;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) : ?>
                                    <?php
                                    $qty = $this->items_model->countQty($item->id);
                                    $disabled = $qty <= 0 ? "disabled" : ""; 
                                    $buttonClass = $qty <= 0 ? "disabled-button" : "";
                                    ?>
                                    <tr>
                                    <?php if($item->title !== ''){ ?>
                                        <td><?= $item->title ?></td>
                                        <td><?= $location[0]['name'] ?></td>
                                        <td><?= $qty ?></td>
                                        <td style="text-align:right;"><?= number_format($item->price,2,",",""); ?></td>
                                        <td>
                                            <button data-id="<?= $item->id ?>" type="button" data-bs-dismiss="modal" class="nsm-button select_item <?php //echo $buttonClass ?>" <?php //echo $disabled; ?>>
                                                <i class="bx bx-fw bx-plus"></i>
                                            </button>
                                        </td>
                                        <?php  }  ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#items_table').nsmPagination({itemsPerPage:8});
});
</script>
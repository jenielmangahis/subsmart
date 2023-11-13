<div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">            
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <input id="ITEM_CUSTOM_SEARCH" style="width: 200px;" class="form-control" type="text" placeholder="Search Item...">
                    </div>
                    <div class="col-sm-12">
                        <table id="items_table" class="table table-hover table-sm w-100">                                    
                            <thead class="bg-light">
                                <tr>
                                    <td></td>
                                    <td><strong>Name</strong></td>
                                    <td><strong>On Hand</strong></td>
                                    <td><strong>Price</strong></td>
                                    <td><strong>Type</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) { ?>
                                    <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                        <td style="width: 0% !important;">
                                            <button type="button" data-bs-dismiss="modal" class='nsm-button primary small select_item2a' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                        </td>
                                        <td><?php echo $item->title; ?></td>
                                        <td>
                                            <?php 
                                                foreach($itemsLocation as $itemLoc){
                                                    if($itemLoc->item_id == $item->id){
                                                        echo "<div class='data-block'>";
                                                        echo $itemLoc->name. " = " .$itemLoc->qty;
                                                        echo "</div>";
                                                    } 
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $item->price; ?></td>
                                        <td><?php echo $item->type; ?></td>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
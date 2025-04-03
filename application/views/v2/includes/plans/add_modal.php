<div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">            
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" for="estimate-items-table" id="items_search_field" placeholder="Search List">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table id="estimate-items-table" class="nsm-table" style="width: 100%;">                             
                            <thead>
                                <tr>
                                    <td data-name="Name" style="width:50%;"> Name</td>
                                    <td data-name="Type" style="width:10%;">Type</td>
                                    <td data-name="Qty" style="width:10%;">Qty</td>
                                    <td data-name="Price" style="width:10%;text-align:right">Price</td>
                                    <td data-name="Manage" style="width:5%;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) { ?>
                                    <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">  
                                        <?php
                                            $qty = $this->items_model->countQty($item->id);
                                            $disabled = $qty <= 0 ? "disabled" : ""; 
                                            $buttonClass = $qty <= 0 ? "disabled-button" : "";
                                        ?>                                      
                                        <td class="nsm-text-primary"><?php echo $item->title; ?></td>
                                        <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                        <td><?= $qty; ?></td>
                                        <td style="text-align:right;"><?= number_format($item->price,2,".",""); ?></td>
                                        <td style="width: 0% !important;">
                                            <button type="button" data-bs-dismiss="modal" class='nsm-button select_item2a' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                        </td>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
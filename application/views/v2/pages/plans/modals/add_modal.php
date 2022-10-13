<div class="modal fade nsm-modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <span class="modal-title content-title" id="account-modal-label">Item Lists</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="modal_items_table_estimate" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th><b>Price</b></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($items as $item){ // print_r($item); ?>
                                <tr>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->price; ?></td>
                                    <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-bs-dismiss="modal" class="nsm-button small select_item">
                                    <i class='bx bx-plus'></i>
                                </button></td>
                                </tr>
                                
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-detail">
                <div class="button-modal-list">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
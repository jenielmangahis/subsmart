<div class="modal fade nsm-modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="modal_items_table_estimate" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Name</td>
                                <td> Price</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($items as $item){ // print_r($item); ?>
                                <tr>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->price; ?></td>
                                    <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-bs-dismiss="modal" class="nsm-button select_item">
                                    <i class='bx bx-plus'></i></span>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="item_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="items_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Name</td>
                                <td> Qty</td>
                                <td> Price</td>
                                <td> Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($items as $item) : ?>
                                <tr>
                                    <td><?=$item->title?></td>
                                    <td><?=$this->items_model->countQty($item->id)?></td>
                                    <td><?=$item->price?></td>
                                    <td>
                                        <button data-id="<?=$item->id?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
<!-- Modal -->
<div class="modal fade" id="item_category_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add By Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="item_categories_table" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td> Name</td>
                                    <td> Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categories as $category) : ?>
                                <tr>
                                    <td><?=$category->name?></td>
                                    <td>
                                        <button data-id="<?=$category->item_categories_id?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_category">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
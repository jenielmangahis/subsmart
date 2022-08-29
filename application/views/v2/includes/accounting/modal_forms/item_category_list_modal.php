<!-- Modal -->
<div class="modal fade nsm-modal" id="item_category_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="items-categories-modal-label">Add By Group</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table id="item_categories_table" class="nsm-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categories as $category) : ?>
                                <tr>
                                    <td><?=$category->name?></td>
                                    <td>
                                        <button data-id="<?=$category->item_categories_id?>" type="button" data-bs-dismiss="modal" class="nsm-button select_category">
                                            <i class="bx bx-fw bx-plus"></i>
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
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
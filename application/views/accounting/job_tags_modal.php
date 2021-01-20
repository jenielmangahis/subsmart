<div class="modal right fade" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="tags-list">
            <div class="modal-header">
                <h4 class="modal-title">Manage your tags</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-flex">
                        <button type="button" class="btn btn-outline-secondary m-auto" onclick="getTagForm({}, 'create')">Create Tag</button>
                    </div>
                    <div class="col-12 py-3">
                        <input type="text" name="search_tag" id="search-tag" class="form-control" placeholder="Find tag by name">
                    </div>
                    <div class="col-12">
                        <table id="tags-table" class="table table-bordered table-hover">
                            <thead>
                                <th>Tags</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
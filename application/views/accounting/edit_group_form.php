<div class="modal-content" id="edit-group-form">
    <div class="modal-header">
        <a href="#" class="text-info" onclick="showTagsList(this)"><i class="fa fa-chevron-left"></i> Back</a>
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
    </div>
    <div class="modal-body pt-3">
        <div class="row">
            <div class="col-12">
                <h5>Edit group</h5>
            </div>
            <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col-md-8">
                        <label for="tag_group_name">Group name</label>
                        <input type="text" value="" name="tags_group_name" id="tag_group_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="">&nbsp;</label>
                        <select id="e2" class="form-control" name="group_color" style="background-color: green; color: white">
                            <option value="green" style="background-color:green">Green</option>
                            <option value="yellow" style="background-color:yellow; color: black">Yellow</option>
                            <option value="red" style="background-color:red">Red</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
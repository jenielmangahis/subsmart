<div class="modal fade" id="moveFolderModal" tabindex="-1" role="dialog" aria-labelledby="elementSettingsModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Folder</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="form_id" id="moveFolderFormID">
                <div class="form-group">
                    <label for="folder-move-to">Move to:</label>
                    <select name="folder-move-to" id="folderMoveTo" class="form-control">
                        <option value="1">Uncategorized Forms</option>
                    </select>
                </div>
                <label for="folders">Folders:</label><br>
                <a href="/fb/folders">Manage Folders...</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="handleMoveToFolder()">Move</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
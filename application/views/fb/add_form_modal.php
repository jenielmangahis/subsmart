<div class="modal fade" id="addFormModal" tabindex="-1" role="dialog" aria-labelledby="addFormModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form onsubmit="handleCreateForm(event)">
        <div class="modal-body">
          <p>Start with this form. You'll be able to customize it in the editor.</p>
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Create</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
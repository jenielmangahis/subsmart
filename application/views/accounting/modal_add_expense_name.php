<!-- Modal -->
<div class="modal fade" id="addexpname" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expense Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
            <tr>
                <td>Expense Name</td>
                <td><input type="text" name="" class="form-control"></td>
            </tr>
            <tr>
                <td>Display Name</td>
                <td><input type="text" name="" class="form-control"></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>
                    <select class="form-control">
                        <option>---</option>
                        <option>Fixed Cost</option>
                        <option>Variable Cost</option>
                        <option>Periodic Cost</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Sub Account</td>
                <td>
                    <select class="form-control">
                        <option>---</option>
                        <option>Assets</option>
                        <option>Liability</option>
                        <option>Equity</option>
                    </select>
                </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
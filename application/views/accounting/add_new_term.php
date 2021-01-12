<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog"  id="modal-dialog2" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:left;">New Term</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <table>
              <tr>
                <td><input type="radio" name="type"> Due in fixed number of days</td>
                <td></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" style="width:60px;"></td>
                <td><b style="margin-left:-100px;">days</b></td>
              </tr>
          </table>
          <table>
              <tr>
                <td><input type="radio" name="type"> Due by certain day of the month</td>
                <td></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" style="width:60px;"></td>
                <td><b style="margin-left:-120px;">day of month</b></td>
              </tr>
          </table>
          <table>
              <tr>
                <td><input type="radio" name="type"> Due the next month if issued within</td>
                <td></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" style="width:60px;"></td>
                <td><b style="margin-left:-137px;">days of due date</b></td>
              </tr>
          </table>
           
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper wrapper--loading" role="wrapper">
    <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div>

    <div class="container mt-4">
        <div>
            <h1 class="esigneditor__title">Send Letters (<span></span>)</h1>
        </div>

        <table id="letters" class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" class="table__checkbox table__checkbox--primary"/>
                    </th>
                    <th>Letter Title</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

        <hr>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">
                Choose Letter Send Method
            </button>
        </div>

    </div>
</div>

<div class="modal fade" id="letterModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Title</label>
                <input name="name" class="form-control" readonly>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="letterTextarea"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary esigneditor__btn">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Save Letter
        </button>
      </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer');?>
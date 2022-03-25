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
            <h1>eSign Editor Letters</h1>
            <div class="alert alert-warning" role="alert">
                <p>These letter templates with parameters are used by the Dispute Wizard. Never type customer information directly into these templates. Modifying templates may prevent them from functioning.</p>
            </div>

            <div class="esignEditorLetters">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex">
                        <select class="form-control" id="category">
                            <option value="-1" selected>All Categories</option>
                        </select>
                        <select class="form-control" id="status">
                            <option value="-1" selected>All Statuses</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <a class="btn btn-primary" href="<?=base_url()?>EsignEditor/create">
                        <i class="fa fa-plus mr-1"></i>
                        Create Letter
                    </a>
                </div>
                <table id="letters" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Letter Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Favorite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="previewLetterModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="preview"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">
            Close
        </button>
      </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer');?>
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
            <h1 class="esigneditor__title">Add Letter</h1>
            <div class="alert alert-warning" role="alert">
                <p>Build and automate e-signature workflows in seconds. Speed up e-signing processes. Assign roles, set up steps and send documents for signing.</p>
            </div>
        </div>

        <form class="mb-3" id="addLetterForm">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="category">Category</label>
                    <a class="link" href="#" data-toggle="modal" data-target="#manageTemplateModal">Manage template categories</a>
                </div>
                <select class="form-control" id="category" data-name="category_id"></select>
            </div>
            <div class="form-group">
                <div>
                    <label>Status</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" data-name="is_active" name="is_active" id="status_active" value="1" checked>
                    <label class="form-check-label" for="status_active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" data-name="is_active" name="is_active" id="status_inactive" value="0">
                    <label class="form-check-label" for="status_inactive">Inactive</label>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" data-name="title">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="letter"></textarea>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-primary esigneditor__btn" data-action="submit">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Submit
                </button>
            </div>
        </form>

        <fieldset>
            <legend class="d-flex justify-content-between align-items-center">
                <h2>Placeholders</h2>
                <a class="link" href="#" data-toggle="modal" data-target="#createPlaceholderModal">
                    Manage template placeholders
                </a>
            </legend>
            <ul class="placeholders__list" id="placeholders"></ul>
        </fieldset>
    </div>
</div>

<div class="modal fade" id="manageTemplateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Template Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="d-flex align-items-center" id="addCategoryForm">
            <div class="form-group w-100" style="margin-bottom: 0 !important;">
                <input class="form-control" placeholder="Enter category name">
            </div>
            <button type="button" class="btn btn-primary esigneditor__btn">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Add
            </button>
        </form>

        <div class="mt-4">
            <h6>Categories</h6>
            <div class="categoriesList">
                <template>
                <div class="categoriesList__item">
                    <div class="categoriesList__name"></div>
                    <div class="categoriesList__actions">
                        <button data-action="locked">
                            <i class="fa fa-lock"></i>
                        </button>
                        <button data-action="edit_category">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-action="delete_category">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                </template>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="createPlaceholderModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Template Placeholders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addPlaceholderForm">
            <div class="form-group">
                <label>Code</label>
                <input data-name="code" class="form-control" placeholder="Enter code">
                <small class="form-text text-muted">Only alphanumeric and underscore characters are allowed.</small>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input data-name="description" class="form-control" placeholder="Enter description">
            </div>
            <div class="form-group">
                <label>Value</label>
                <input data-name="value" class="form-control" placeholder="Enter value">
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary esigneditor__btn">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Add
                </button>
            </div>
        </form>

        <div class="mt-4 d-none">
            <h6>My Placeholders</h6>
            <ul class="placeholders__list" id="userplaceholders"></ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer');?>


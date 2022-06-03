<?php include viewPath('v2/includes/header');?>

<div class="row page-content g-0">
    <div class="nsm-page">
        <div class="nsm-page-content">
            <div class="row">
                <div class="col-12 col-md-8 grid-mb">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                            <span>Select Customer Form</span> <i class='bx bx-fw bx-chevron-down'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">Funding</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Office Use</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Papers</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-4 text-end">
                    <form>
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" placeholder="Search label" />
                        </div>
                    </form>
                </div>
            </div>


            <table class="nsm-table" id="customformstable">
                <thead>
                    <tr>
                        <td>Default Name</td>
                        <td>Custom Name</td>
                        <td>Hidden</td>
                        <td class="cell-shrink">Actions</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="cf--modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rename Label</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="mb-3">
            <style>
                #cf--modal .widget-form {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    gap: 8px;
                }
                #cf--modal .widget-form input {
                    border-radius: .25rem !important;
                }
                #cf--modal .widget-form button {
                    border-radius: 5px !important;
                    margin-bottom: 0 !important;
                }
            </style>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">New Name</label>
                <div class="input-group widget-form">
                    <input required placeholder="Enter new name" class="form-control nsm-field" maxlength="50">
                    <button type="submit" class="nsm-button primary">
                        Rename
                    </button>
                </div>
                <small class="form-text text-muted"></small>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="<?=base_url("assets/css/customer_forms/customer_forms.css")?>">
<script type="module"  src="<?=base_url("assets/js/customer_forms/index.js")?>"></script>
<?php include viewPath('v2/includes/footer');?>
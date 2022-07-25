<?php include viewPath('v2/includes/header');?>

<input type="hidden" value="<?=base_url();?>" id="baseurl" />

<div class="fc-loader">
    <span>Loading...</span>
</div>

<div class="row page-content g-0">
    <div class="nsm-page">
        <div class="nsm-page-content">
            <div class="row">
                <div class="col-12 col-md-8 grid-mb">
                    <button role="button" class="nsm-button" id="flashcardcreate">
                        <i class="bx bx-fw bx-card"></i> Create
                    </button>
                </div>

                <div class="col-12 col-md-4 text-end">
                    <form>
                        <div class="nsm-field-group search">
                            <input type="search" class="nsm-field nsm-search form-control mb-2" name="search" placeholder="Search" id="flashcardsearch" />
                        </div>
                    </form>
                </div>
            </div>

            <table class="nsm-table" id="flashcardtable">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>
                        <td>Created By</td>
                        <td>Created At</td>
                        <td class="cell-shrink">Actions</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="flashcardcreatemodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" data-text-default="Create New Deck"></h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>A Deck is a subset of Flashcards in a Class, similar to chapters in a book.</p>
        <form id="flashcardcreateform">
          <div class="form-group mb-3">
            <label class="content-subtitle fw-bold mb-2" for="fc-name">Name</label>
            <input required class="form-control" id="fc-name" placeholder="Enter name">
          </div>
          <div class="form-group form-check">
            <input data-type="is_shared_in_company" type="checkbox" class="form-check-input" id="ss-private">
            <label class="form-check-label" for="ss-private">Allow other admins to manage this deck</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="nsm-button" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="flashcardcreateform" class="nsm-button primary" data-text-default="Save">Save</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="<?=base_url("assets/css/university/flashcard.css")?>">
<script type="module"  src="<?=base_url("assets/js/university/flashcard/flashcard.js")?>"></script>
<?php include viewPath('v2/includes/footer');?>
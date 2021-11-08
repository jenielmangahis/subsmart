<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>

<div class="wrapper docusignSent" role="wrapper">
    <?php include viewPath('includes/sidebars/docusign');?>

    <section class="container-fluid mt-3">
        <div class="card">
            <h1 class="title text-capitalize" id="currentView"></h1>

            <div class="esignActionRequired alert alert-primary">
              <div class="esignActionRequired__inner">
                <i class="fa fa-info-circle esignActionRequired__icon"></i>
                <a class="esignActionRequired__body" href="<?php echo base_url('eSign/manage?view=action_required') ?>">
                  Your action is required for <span class="esignActionRequired__count">0</span> of your eSign documents.
                </a>
              </div>
            </div>

            <table id="documentsTable" class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Last Changed</th>
                        <th>Manage</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
</div>

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Delete Envelope</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You can find all your deleted envelopes in your <strong>Deleted</strong> bin within 24 hours before they're removed permanently.</p>
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger d-flex align-items-center">
            <div class="spinner-border spinner-border-sm mt-0 d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Yes, delete envelope
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmVoid" tabindex="-1" role="dialog" aria-labelledby="confirmVoidLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmVoidLabel">Void Envelope</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
            By voiding this envelope, you are canceling all remaining signing activities. Recipients who have finished signing will
            receive an email notification that includes your reason for voiding. Recipients who have not yet signed will not be able
            to view or sign the enclosed documents.
        </p>


        <div class="form-group">
            <label for="voidReason" style="font-size:14px;">
                <span class="text-danger">*</span> Reason for voiding envelope.
            </label>
            <textarea class="form-control" id="voidReason" rows="3"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger d-flex align-items-center">
            <div class="spinner-border spinner-border-sm mt-0 d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Void envelope
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="historyModalLabel">Envelope History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div><strong>Name</strong></div>
            <div class="ellipsis" data-property-name="name"></div>
          </div>
          <div class="col">
            <div><strong>Status</strong></div>
            <div data-property-name="status"></div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div><strong>Created At</strong></div>
            <div data-property-name="created_at"></div>
          </div>
          <div class="col">
            <div><strong>Last Changed At</strong></div>
            <div data-property-name="updated_at"></div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div><strong>Recipients</strong></div>
            <div data-property-name="recipients"></div>
          </div>
          <div class="col">
            <div><strong>Envelope ID</strong></div>
            <div data-property-name="id"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', async (event) => {
  const urlParams = new URLSearchParams(window.location.search);
  const view = urlParams.get("view");

  if (view === "action_required") {
    return;
  }

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const response = await fetch(`${prefixURL}/DocuSign/apiGetActionRequired`);
  const { data } = await response.json();

  if (data.length === 0) return;

  const $alert = document.querySelector(".esignActionRequired");
  const $count = $alert.querySelector(".esignActionRequired__count");
  $count.textContent = data.length;
  $alert.classList.add("esignActionRequired--show");
});
</script>

<?php include viewPath('includes/footer');?>
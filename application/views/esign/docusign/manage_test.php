<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('v2/includes/header');?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?=base_url("assets/css/esign/docusign/manage/manage.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/esign/esign-builder/esign-builder.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/esign/esign.css")?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url("assets/css/esign/docusign/template-create/template-create.css")?>">



<div class="wrapper " role="wrapper">
  <div class="d-none">
    <?php include viewPath('includes/sidebars/docusign');?>
  </div>

  <section class="container-fluid mt-3">
    <div class="nsm-page-nav mb-3">
      <ul>
        <li class="active">
          <a class="nsm-page-link" href="<?=base_url('esign/Files')?>">
            <span>Send envelope</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="#">
            <span>Sign a document</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="<?=base_url('eSign/manage?view=inbox')?>">
            <span>Inbox</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="<?=base_url('eSign/manage?view=sent')?>">
            <span>Sent</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="<?=base_url('eSign/manage?view=drafts')?>">
            <span>Draft</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="<?=base_url('eSign/manage?view=deleted')?>">
            <span>Deleted</span>
          </a>
        </li>

        <li class="">
          <a class="nsm-page-link" href="<?=base_url('eSign/manage?view=action_required')?>">
            <span>Action Required</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="">
      <div class="esignActionRequired alert alert-primary">
        <div class="esignActionRequired__inner">
          <i class="fa fa-info-circle esignActionRequired__icon"></i>
          <a class="esignActionRequired__body" href="<?php echo base_url('eSign/manage?view=action_required') ?>">
            Your action is required for <span class="esignActionRequired__count">0</span> of your eSign documents.
          </a>
        </div>
      </div>

      <table id="documentsTable" class="nsm-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Last Changed</th>
            <th></th>
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

<style>
  .esignActionRequired__body{
    text-decoration:none;
    color:#6a4a86;
  }
  .a.text-link{
    text-decoration:none;
    color:#6a4a86;
  }
  .docusignSent{
    display:block;
  }
  span{
    margin-right:3px;
  }
  .progress {
    width: 100%;
    height: 5px;
    margin-right: 5px;
  }
</style>

<?php include viewPath('v2/includes/footer');?>
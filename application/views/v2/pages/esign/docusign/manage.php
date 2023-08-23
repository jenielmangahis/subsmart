<?php include viewPath('v2/includes/header'); ?>
<style>
.nsm-table {
    /*display: none;*/
}
.nsm-badge.primary-enhanced {
    background-color: #6a4a86;
}
    table {
    width: 100% !important;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important; 
     cursor: pointer;
}

.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
.table-row-icon{
    display: inline-block;
}
.progress-count, .label-waiting{
    display: inline-block;
}
.nsm-badge.warning {
    color: #fff;
    background-color: #6c757d;
}
.nsm-badge{
    padding: 5px 10px !important;
    border-radius: 0px !important;
    width: 50%;
    text-align: center;
    font-size: 12px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new_job1') ?>'">
        <i class='bx bx-briefcase'></i>
    </div>
</div>

<div class="row page-content g-0">
    <?php if(!empty($this->session->flashdata('alert'))): ?>
        <div class="alert alert-<?= $this->session->flashdata('alert-type') ?>">
            <?= $this->session->flashdata('alert') ?>
        </div>
    <?php endif; ?>
    <div class="col-12 mb-3">        
        <div class="nsm-page-nav mb-3">
        <ul>
            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('esign_v2/Files')?>">
              <!-- <a class="nsm-page-link" href="#" id="send-envelope"> -->
                <span><i class='bx bx-mail-send' ></i> Send envelope</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="#" id="signadocument">
                <span><i class='bx bxs-pen' ></i> Sign a document</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=inbox')?>">
                <span><i class='bx bxs-inbox'></i> Inbox</span>
              </a>
            </li>

            <!-- <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=sent')?>">
                <span><i class='bx bxs-paper-plane' ></i> Sent</span>
              </a>
            </li> -->

            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=drafts')?>">
                <span><i class='bx bxs-detail' ></i> Draft</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=deleted')?>">
                <span><i class='bx bxs-trash-alt' ></i> Deleted</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=action_required')?>">
                <span><i class='bx bxs-alarm-exclamation' ></i> Action Required</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=completed')?>">
                <span><i class='bx bxs-check-circle' ></i> Completed</span>
              </a>
            </li>

            <li class="tabitem">
              <a class="nsm-page-link" href="#">
                <span></span>
              </a>
            </li>
          </ul>
        </div>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                           An effective contract management system should include the ability to support electronic signatures.
                        </div>
                        <div class="esignActionRequired alert alert-primary">
                            <div class="esignActionRequired__inner">
                                <i class='bx bxs-info-circle' ></i> 
                                <a class="esignActionRequired__body" href="<?php echo base_url('eSign_v2/manage?view=action_required') ?>">
                                    Your action is required for <span class="esignActionRequired__count">0</span> of your eSign documents.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="custom-esign-search" placeholder="Search eSign...">
                            
                        </div>
                    </div>
                </div>
                <table id="documentsTable" class="nsm-table">
                    <thead>
                      <tr>
                        <th style="width:2%;"></th>
                        <th>Docfile ID</th>
                        <th>Customer Name</th>
                        <th>Subject</th>                        
                        <th>Status</th>                        
                        <th style="width:10%;">Last Changed</th>
                        <th></th>
                      </tr>
                    </thead>
                </table>
            </div>


            <div class="modal nsm-modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Delete Envelope</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bx bx-fw bx-x m-0"></i>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>You can find all your deleted envelopes in your <strong>Deleted</strong> bin within 24 hours before they're removed permanently.</p>
                    <p>Are you sure you want to delete?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
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

            <div class="modal nsm-modal fade" id="confirmVoid" tabindex="-1" role="dialog" aria-labelledby="confirmVoidLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmVoidLabel">Void Envelope</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-fw bx-x m-0"></i>
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
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
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

            <div class="modal nsm-modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="historyModalLabel">Envelope History</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bx bx-fw bx-x m-0"></i>
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
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal nsm-modal fade" id="selectDocument" tabindex="-1" role="dialog" aria-labelledby="selectDocumentLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 802px;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectDocumentLabel">Sign a document</h5>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                  </button>
                    </div>
                    <div class="modal-body">
                  <div class="fileupload">
                      <div class="custome-fileup">
                          <button class="btn">
                              <img src="<?= $url->assets ?>esign/images/fileup-ic.png" alt="">
                              <span class="nsm-button primary">Upload</span>
                          </button>
                          <input multiple="" type="file" name="docFile" id="docFile" accept="application/pdf,application/vnd.ms-excel" required="">
                      </div>
                  </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="nsm-button primary d-flex align-items-center">
                            <div class="spinner-border spinner-border-sm m-0 d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="ml-1">Sign</span>
                        </button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal nsm-modal fade" id="documentModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-column"></div>
                    </div>
                </div>
            </div>

            <!-- send envelope -->
            <div class="modal nsm-modal fade" id="sendEnvelope" tabindex="-1" role="dialog" aria-labelledby="sendEnvelopeLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 802px;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendEnvelopeLabel">Add Documents to the Envelope</h5>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                  </button>
                    </div>
                    <div class="modal-body">
                  <?php
                    // $this->load->view('esign_v2/Files');
                    // $this->load->view('v2/pages/esign/files');
                    $CI =& get_instance();
                    // $CI =& get_instance()->Esign_v2;
                    //$CI->Files() ;
                  ?>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Notice -->
            <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body"></div>
                    </div>
                </div>
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

  const prefixURL = "";
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
  .progress {
    width: 100%;
    height: 5px;
    margin-right: 5px;
    margin-bottom: 5px;
  }
  table.dataTable thead th,
  table.dataTable.no-footer {
    border-color: rgba(0, 0, 0, 0.3) !important;
  }
</style>
<?php include viewPath('v2/includes/footer'); ?>
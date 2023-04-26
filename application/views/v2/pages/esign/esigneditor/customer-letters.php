<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
ini_set('max_input_vars', 30000);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?=put_header_assets();?>

<div class="wrapper page-content g-0" role="wrapper">
       <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
        </div>
    <!-- <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div> -->

    <div class="container mt-4">
        <div>
            <h1 class="esigneditor__title">Send Letters (<span></span>)</h1>
        </div>

        <div>
            <div class="statusFilter">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="letterStatusFilter2" name="letterStatusFilter" class="custom-control-input" value="all" checked>
                    <label class="custom-control-label" for="letterStatusFilter2">View All Letters</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="letterStatusFilter1" name="letterStatusFilter" class="custom-control-input" value="unprinted">
                    <label class="custom-control-label" for="letterStatusFilter1">View Unprinted/Unsent Letters</label>
                </div>
            </div>
            <table id="letters" class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="table__checkbox table__checkbox--primary"/>
                        </th>
                        <th>Letter Title</th>
                        <th>Created</th>
                        <th>Print Status</th>
                        <th>Date Printed/Sent</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <hr>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" data-action="select-send-option">
                Send Letter
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

<div class="modal fade" id="sendLetterModal" tabindex="-1" role="dialog" data-step-active="select">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Letter Send Method</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div data-step="select">
            <div class="sendLetter__option">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sendOption" id="sendOptionPrint" value="print">
                </div>
                <label class="sendLetter__optionText" for="sendOptionPrint">
                    <h3>Print locally</h3>
                    <p>On your own computer.</p>
                </label>
            </div>

            <div class="sendLetter__option">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sendOption" id="sendOptionEmail" value="email">
                </div>
                <label class="sendLetter__optionText" for="sendOptionEmail">
                    <h3>Send as email</h3>
                    <p>Attach this letter to your email.</p>
                </label>
            </div>
          </div>

          <div data-step="print" style="font-size: 16px;">
            <p>Are you ready to print all selected letters now?</p>
            <p>Continuing will generate a PDF file for you to download and print yourself on your own printer. They will be marked as printed.</p>
            <div class="preview"></div>
          </div>

          <div data-step="email">
            <div class="alert alert-danger d-none" role="alert">
                Something went wrong sending this email.
            </div>
            <form>
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input class="form-control" data-type="subject">
                </div>
                <div class="mb-3">
                    <label class="form-label">Recipient</label>
                    <input type="email" class="form-control" data-type="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="3" data-type="message"></textarea>
                </div>
                <div class="preview"></div>
            </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary esigneditor__btn" data-action="next">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Next
        </button>

        <button type="button" class="btn btn-primary esigneditor__btn" data-action="email">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Send Email
        </button>

        <button type="button" class="btn btn-primary esigneditor__btn" data-action="print">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Yes, continue
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  table.dataTable thead th,
  table.dataTable.no-footer {
    border-color: rgba(0, 0, 0, 0.3) !important;
  }

  .wrapper--loading {
    width: initial;
    height: initial;
  }

  .statusFilter,
  .statusFilter .custom-control {
    display: flex;
    gap: 1rem;
    align-items: center;
  }
  .statusFilter .custom-control {
    gap: 0.3rem;
  }
</style>

<?php include viewPath('v2/includes/footer');?>
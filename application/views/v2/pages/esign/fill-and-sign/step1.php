<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('v2/includes/header');?>

<?=put_header_assets();?>

<style>
  .fillAndSign__header .alert-warning span,
  .fillAndSign__vaultItemTitle,
  .fillAndSign__vaultItemInfo,
  .fillAndSign__docTitle,
  .fillAndSign__docPageCount {
    font-family: Quicksand, sans-serif;
  }
  .fillAndSign__recent,
  .fillAndSign__vault {
    padding: 0;
    list-style-type: none;
    font-family: Quicksand, sans-serif;
  }
  .modal-header::before,
  .modal-header::after {
    content: none;
  }
  .nav-item.active .nav-link {
    isolation: isolate;
    border-color: #e9ecef #e9ecef #dee2e6;
    border-bottom-color: #fff;
  }
  #selectDocumentModal .tab-content {
    max-height: 500px;
    overflow-y: auto;
  }
</style>

<section class="container fillAndSign" data-step="1">
    <div class="fillAndSign__header">
        <div class="nsm-callout primary mt-2" role="alert">
            <button><i class="bx bx-x"></i></button>
            To get started, upload a form from your library or from your local hard drive. Once the document is uploaded successfully, press NEXT. To add text, select the Text button in the main toolbar, click where you’d like to place the text cursor and type. Simply select another item from the toolbar and do it again.
        </div>
    </div>

    <form id="form">
        <div class="d-flex" style="gap: 1rem;">
            <div class="fillAndSign__upload">
                <button class="btn" type="button">
                    <img src="https://localhost/nsmartrac/assets/esign/images/fileup-ic.png" alt="">
                    <span class="nsm-button primary">Select</span>
                </button>
            </div>

            <div class="ml-3 fillAndSign__docPreview d-none">
                <canvas></canvas>
                <div class="fillAndSign__docInfo">
                    <h5 class="fillAndSign__docTitle"></h5>
                    <span class="fillAndSign__docPageCount"></span>
                </div>

                <div class="fillAndSign__uploadProgress" width="100%">
                    <span></span>
                </div>

                <div class="fillAndSign__uploadProgressCheck">
                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>Check</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>

        <div class="fillAndSign__footer">
            <button type="submit" class="nsm-button primary" id="formSubmit" disabled>
                <div class="spinner-border spinner-border-sm d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Next
            </button>
        </div>
    </form>

    <div class="modal fade nsm-modal fillAndSign__modal" id="documentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-fw bx-x m-0"></i>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade nsm-modal fillAndSign__modal" id="selectDocumentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Document</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="true">
                            Recent Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="vault-tab" data-toggle="tab" href="#vault" role="tab" aria-controls="vault" aria-selected="false">
                            Shared Library
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="local" aria-selected="false">
                            Local
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="recent" data-upload-type="recent" role="tabpanel" aria-labelledby="recent-tab">
                        <div>
                            <ul class="fillAndSign__recent"></ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="vault" data-upload-type="vault" role="tabpanel" aria-labelledby="vault-tab">
                        <div>
                            <ul class="fillAndSign__vault"></ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="local" data-upload-type="local" role="tabpanel" aria-labelledby="local-tab">
                        <div class="fillAndSign__selectFile">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileInput" accept="application/pdf">
                                <label class="custom-file-label" for="customFile">
                                    <span class="custom-file-label__inner">Select Document</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary d-flex align-items-center" id="selectDocumentButton">
                    <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Select Document
                </button>
                <button type="button" class="nsm-button" data-dismiss="modal" id="selectDocumentCloseButton">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
  .nav-link,
  .nav-link:hover {
    color: #6a4a86;
  }
</style>

<?php include viewPath('v2/includes/footer');?>
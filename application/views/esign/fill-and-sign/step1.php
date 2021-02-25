<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<section class="container fillAndSign" data-step="1">
    <div class="fillAndSign__header">
        <h1 class="fillAndSign__title">Fill and eSign</h1>
        <div class="alert alert-warning mt-2" role="alert">
            <span style="color:black;">
                To get started, upload a form from your library or from your local hard drive. Once the document is uploaded successfully, press NEXT. To add text, select the Text button in the main toolbar, click where you’d like to place the text cursor and type. Simply select another item from the toolbar and do it again.
            </span>
        </div>
    </div>

    <form id="form">
        <div class="d-flex">
            <div class="fillAndSign__upload">
                <button class="btn" type="button">
                    <img src="https://localhost/nsmartrac/assets/esign/images/fileup-ic.png" alt="">
                    <span>Upload</span>
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
            </div>
        </div>

        <div class="fillAndSign__footer">
            <button type="submit" class="btn" id="formSubmit" disabled>
                <div class="spinner-border spinner-border-sm d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Next
            </button>
        </div>
    </form>

    <div class="modal fillAndSign__modal" id="documentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</section>

<div class="modal fillAndSign__modal" id="selectDocumentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="vault-tab" data-toggle="tab" href="#vault" role="tab" aria-controls="vault" aria-selected="false">
                            Shared Library
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="type" aria-selected="true">
                            Local
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="vault" data-upload-type="vault" role="tabpanel" aria-labelledby="vault-tab">
                        <div>
                            <ul class="fillAndSign__vault"></ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="local" data-upload-type="local" role="tabpanel" aria-labelledby="local-tab">
                        <div class="fillAndSign__selectFile">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileInput">
                                <label class="custom-file-label" for="customFile">
                                    <span class="custom-file-label__inner">Select Document</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary d-flex align-items-center" id="selectDocumentButton">
                    <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Select Document
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="selectDocumentCloseButton">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('includes/footer'); ?>
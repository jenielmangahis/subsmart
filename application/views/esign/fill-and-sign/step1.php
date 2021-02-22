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
                <button class="btn">
                    <img src="https://localhost/nsmartrac/assets/esign/images/fileup-ic.png" alt="">
                    <span>Upload</span>
                </button>
                <input id="fileInput" type="file" name="document" accept="application/pdf" required>
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
            <button type="submit" class="btn">Next</button>
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

<?php include viewPath('includes/footer'); ?>
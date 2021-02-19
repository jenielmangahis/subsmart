<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<section class="container-fluid fillAndSign fillAndSign--step2" data-step="2">
    <div class="fillAndSign__topnav">
        <div class="container">
            <div class="d-flex fillAndSign__actions">
                <div class="fillAndSign__primary">
                    <div class="action action--draggable" title="Text" data-text-type="initial">
                        <i class="fa fa-font"></i>
                    </div>
                    <div class="action action--draggable" title="Bold" data-text-type="bold">
                        <i class="fa fa-bold"></i>
                    </div>
                    <div class="action action--draggable" title="Underline" data-text-type="underline">
                        <i class="fa fa-underline"></i>
                    </div>
                    <div class="action action--draggable" title="Strikethrough" data-text-type="strikethrough">
                        <i class="fa fa-strikethrough"></i>
                    </div>
                    <div class="action action--draggable" title="Italic" data-text-type="italic">
                        <i class="fa fa-italic"></i>
                    </div>
                </div>
                <div class="fillAndSign__secondary">
                    <div class="action" title="Sign" id="addSignatureButton">
                        <i class="fa fa-pencil mr-2"></i><span>Sign</span>
                    </div>
                </div>
            </div>
            <div class="fillAndSign__readonly">
                <p>This document is read-only.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="fillAndSign__header d-none">
            <h1 class="fillAndSign__title">Add Recipients to the Envelope</h1>
            <div class="alert alert-warning mt-2" role="alert">
                <span style="color:black;">
                    Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.
                </span>
            </div>
        </div>

        <div class="fillAndSign__documentContainer" id="documentContainer"></div>
    </div>

    <div class="fillAndSign__footer">
        <button class="btn">Share</button>
    </div>
</section>

<div class="modal fillAndSign__modal" id="signatureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Signature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="true">
                            <i class="fa fa-keyboard-o mr-2"></i>Type
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="draw-tab" data-toggle="tab" href="#draw" role="tab" aria-controls="draw" aria-selected="false">
                            <i class="fa fa-pencil mr-2"></i>Draw
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" data-signature-type="type" id="type" role="tabpanel" aria-labelledby="type-tab">
                        <input class="form-control fillAndSign__signatureInput" spellcheck="false" autocomplete="off" autofocus tabindex="0" aria-label="Type your signature here" maxlength="255" placeholder="Type your signature here">
                    </div>
                    <div class="tab-pane" data-signature-type="draw" id="draw" role="tabpanel" aria-labelledby="draw-tab">
                        <div class="fillAndSign__signaturePad">
                            <canvas width="700" height="200"></canvas>
                            <a href="#">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="signatureApplyButton">Apply Signature</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="signatureModalCloseButton">Close</button>
            </div>
        </div>

    </div>
</div>

<?php echo put_footer_assets(); ?>
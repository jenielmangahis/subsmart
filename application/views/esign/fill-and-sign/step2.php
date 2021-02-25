<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<section class="container-fluid fillAndSign fillAndSign--step2" data-step="2">
    <div class="fillAndSign__topnav">
        <div class="container">
            <div class="d-flex fillAndSign__actions">
                <div class="fillAndSign__primary">
                    <div class="action action--draggable" title="Text" data-text-type="initial">
                        <div style="width: 13px; height: 13px; margin-bottom: 3px; position: relative; top: -2px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25.531 25.531">
                                <path d="M25.198 6.273c-.014.23-.045.389-.087.467-.045.084-.176.145-.392.183-.469.104-.781-.074-.935-.533-.545-1.69-1.194-2.812-1.944-3.374-1.041-.773-2.862-1.161-5.469-1.161-1.054 0-1.633.115-1.734.343a.768.768 0 00-.057.324v18.999c0 .812.188 1.383.571 1.709.382.32 1.069.731 2.201.999.483.103.97.2 1.034.239.46 0 .504 1.057-.376 1.057-.025.016-10.375-.008-10.375-.008s-.723-.439-.074-1.023l.767-.343s1.83-.614 2.211-1.009c.434-.445.648-1.164.648-2.154V2.521c0-.369-.229-.585-.687-.647-.049-.015-.425-.02-1.122-.02-2.415 0-4.191.418-5.338 1.259-.864.622-1.629 1.764-2.303 3.432-.217.52-.517.689-.897.513-.432-.101-.589-.339-.477-.705.445-1.374.668-3.31.668-5.814 0-.292.387-.586 1.163-.533L23.56.064c.709-.104 1.096.012 1.16.343.356 1.689.514 3.645.478 5.866z" />
                            </svg>
                        </div>
                        <span>Text</span>
                    </div>
                    <div class="action action--draggable" title="Bold" data-text-type="bold">
                        <i class="fa fa-bold"></i>
                        <span>Bold</span>
                    </div>
                    <div class="action action--draggable" title="Underline" data-text-type="underline">
                        <i class="fa fa-underline"></i>
                        <span>Underline</span>
                    </div>
                    <div class="action action--draggable" title="Strikethrough" data-text-type="strikethrough">
                        <i class="fa fa-strikethrough"></i>
                        <span>Strikethrough</span>
                    </div>
                    <div class="action action--draggable" title="Italic" data-text-type="italic">
                        <i class="fa fa-italic"></i>
                        <span>Italic</span>
                    </div>
                </div>
                <div class="fillAndSign__secondary">
                    <div class="action" title="Sign" id="addSignatureButton">
                        <i class="fa fa-pencil"></i>
                        <span>Sign</span>
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
        <div class="btn-group dropup">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Share
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#" id="copyLink">Get a link</a>
                <a class="dropdown-item" href="#" id="downloadDocument">Download a copy</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fillAndSign__modal" id="signatureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Signature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="draw-tab" data-toggle="tab" href="#draw" role="tab" aria-controls="draw" aria-selected="false">
                            <i class="fa fa-pencil mr-2"></i>Draw
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="true">
                            <i class="fa fa-keyboard-o mr-2"></i>Type
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" data-signature-type="draw" id="draw" role="tabpanel" aria-labelledby="draw-tab">
                        <div class="fillAndSign__signaturePad">
                            <canvas width="700" height="200"></canvas>
                            <a href="#">Clear</a>
                        </div>
                    </div>
                    <div class="tab-pane" data-signature-type="type" id="type" role="tabpanel" aria-labelledby="type-tab">

                        <div class="dropdown mt-2 mb-2" id="fontSelect">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="fontDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Font
                            </button>
                            <div class="dropdown-menu" aria-labelledby="fontDropdown">
                                <a class="dropdown-item" href="#" data-font="font-1">Font 1</a>
                                <a class="dropdown-item" href="#" data-font="font-2">Font 2</a>
                                <a class="dropdown-item" href="#" data-font="font-3">Font 3</a>
                                <a class="dropdown-item" href="#" data-font="font-4">Font 4</a>
                                <a class="dropdown-item" href="#" data-font="font-5">Font 5</a>
                            </div>
                        </div>

                        <input class="form-control fillAndSign__signatureInput" spellcheck="false" autocomplete="off" autofocus tabindex="0" aria-label="Type your signature here" maxlength="255" placeholder="Type your signature here">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <p>By clicking <strong>Apply Signature</strong>, I agree that the signature will be the electronic representation of my signature for all purposes when
                        I (or my agent) use them on documents, including legally binding contracts - just the same as pen-and-paper signature.</p>
                </div>

                <div class="modal-footer__buttonContainer">
                    <button type="button" class="btn btn-primary d-flex align-items-center" id="signatureApplyButton">
                        <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Apply Signature
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="signatureModalCloseButton">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fillAndSign__shareLink">
    <div class="fillAndSign__shareLinkContent"></div>
    <button class="btn btn-info">Copy link</button>
</div>

<div class="fillAndSign__preview">

</div>

<?php echo put_footer_assets(); ?>
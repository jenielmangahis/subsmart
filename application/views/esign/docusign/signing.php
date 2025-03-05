<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nSmarTrac: eSign</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/esign/docusign/docusign.css'); ?>">
    <script src="https://use.fontawesome.com/f61f458313.js"></script>
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/sweetalert2.min.css'); ?>">

    <style>
        .signing input, .signing select{    
            font-family: Arial !important;
        }
        
        .signing__signatureInput {
            width: 100% !important;
        }

        .signing__signaturePad {
            /* position: relative; */
            display:block;
        }

        .signing__signaturePad .button-container{
            text-align:right;
            margin-right: 15px;
        }

        .signing__signaturePad canvas {
            position: relative;
            z-index: 1;
        }

        .canvas-clear {
            position: relative;
            z-index: 2;
        }

        .canvas-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            color: #e9e9e9;
            text-transform: uppercase;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: inherit;
            opacity: 1;
            pointer-events: none;
        }

        .signing__signaturePad.has-content .canvas-placeholder {
            opacity: 0;
        }

        .max-width-unset {
            max-width: unset !important;
        }

        #signatureModal .modal-dialog {
            overflow: hidden;
        }

        [data-action=download] {
            display: none;
        }

        .signing--finished {
            pointer-events: unset;
        }

        .signing--finished [data-action=download] {
            display: block;
        }

        .progressindicator {
            --height: 25px;
            position: fixed;
            bottom: 1rem;
            right: 1rem;

            padding-left: 10px;
            padding-right: 1rem;
            height: var(--height);
            border-radius: var(--height);
            box-sizing: border-box;
            align-items: center;

            background-color: rgb(230 230 230);
            display: none;
        }

        .progressindicator.error {
            background-color: #e3778f47;
            color: #dc3545;
        }

        .progressindicator.show {
            display: block !important;
        }

        @media only screen and (max-width: 768px) {
            #signatureModal {
                padding: 0 !important;
            }

            #signatureModal .modal-dialog {
                margin: 0;
                max-width: unset;
                width: inherit;
                height: inherit;
            }

            #signatureModal .modal-content {
                height: inherit;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container signing">
        <div class="signing__header">
            <span class="signing__readonly">This document is now complete.</span>
            <button data-action="download" class="btn btn-primary" style="position: absolute;right:1rem;">Download PDF</button>

            <div>
                <!-- <button class="btn btn-primary d-flex align-items-center mt-3" data-action="finish">
                    <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="btn-finish-text">Next</span>
                </button> -->
            </div>
        </div>

        <div class="signing__documentContainer"></div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-primary d-flex align-items-center mt-3 btn-finish" data-action="finish">
                <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="btn-finish-text">Next</span>
            </button>
        </div>
    </div>

    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="loader-finishing d-none">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="signatureModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Signature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist" style="display: none;">
                        <li class="nav-item active">
                            <a class="nav-link active" id="draw-tab" data-toggle="tab" href="#draw" role="tab" aria-controls="draw" aria-selected="false">
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
                            <div class="signing__signaturePad">
                                <canvas width="700" height="200"></canvas>
                                <span class="canvas-placeholder">sign here</span>
                                <div class="button-container">
                                    <a href="#" class="canvas-clear">Clear</a>
                                    <?php if( $company_id > 0 && $debugging == 1 ){ ?>
                                        <a href="javascript:void(0);" class="import-signature">Import</a>
                                    <?php } ?>
                                </div>
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

                            <input class="form-control signing__signatureInput" spellcheck="false" autocomplete="off" autofocus tabindex="0" aria-label="Type your signature here" maxlength="255" placeholder="Type your signature here">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <p>By clicking <strong>Apply Signature</strong>, I agree that the signature will be the electronic representation of my signature for all purposes when
                            I (or my agent) use them on documents, including legally binding contracts - just the same as pen-and-paper signature.</p>
                    </div>

                    <div class="d-flex">
                        <button type="button" class="btn btn-primary d-flex align-items-center" id="signatureApplyButton">
                            <div class="spinner-border spinner-border-sm m-0 mr-2 d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Apply Signature
                        </button>
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="importSignatureModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Signature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Entity</label>
                                <select id="signature-entity" data-cid="<?= $company_id; ?>" class="form-control">
                                    <option value="">- Select -</option>
                                    <option value="user">User</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="modal-quick-send-esign-container"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary d-flex align-items-center" id="signatureImportButton">Import</button>
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="progressindicator" id="statusindicator">Saving...</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script src="<?= base_url('assets/js/esign/libs/pdf.js'); ?>"></script>
    <script src="<?= base_url('assets/js/esign/libs/pdf.worker.js'); ?>"></script>
    <script src="<?= base_url('assets/js/esign/docusign/input.autoresize.js'); ?>"></script>
    <!-- Sweetalert JS -->
    <script src="<?php echo base_url('assets/js/v2/sweetalert2.min.js'); ?>"></script>

    <script src="<?= base_url('assets/js/esign/docusign/o9n.js'); ?>"></script>
    <?php if( $load_mobile_signing_js == 1 ){ ?>
        <script src="<?= base_url('assets/js/esign/docusign/mobile-signing.js'); ?>"></script>
    <?php }else{ ?>
        <script src="<?= base_url('assets/js/esign/docusign/signing.js'); ?>"></script>
    <?php } ?>
    

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
    <script>
        var is_with_action = 0;
        var base_url = '<?php echo base_url(); ?>';
        // $(window).bind('beforeunload', function(){
        //   if( is_with_action == 0 ){
        //     return 'Are you sure you want to leave?';
        //   }      
        // });

        $(document).on('click', '.btn', function(){
            is_with_action = 1;
        });

        <?php if( $company_id > 0 ){ ?>
            $(document).on('click', '.import-signature', function(){
                $('#signatureModal').modal('hide');
                $('#importSignatureModal').modal('show');
            });

            $('#signature-entity').on('change', function(){
                var entity = $(this).val();
                var cid    = $(this).attr('data-cid');
                if( entity != '' ){
                    $.ajax({
                        type: "POST",
                        url: base_url + "esign/_import_signature",
                        data: {entity:entity,cid:cid},
                        beforeSend: function(data) {
                            $("#modal-quick-send-esign-container").html(`<div class="spinner-border" role="status"></div>`);
                        },
                        success: function(html) {
                            $("#modal-quick-send-esign-container").html(html);
                        },
                        complete: function() {

                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }else{
                    $("#modal-quick-send-esign-container").html('');
                }
            });

            $(document).on('change', '#select-import-signature', function(){
                var type = $(this).attr('data-type');
                var signature = $(this).val();
                var field_id = $('#importSignatureModal').attr('data-field-id');
                if( field_id != '' ){

                }
            });
        <?php } ?>

        window.addEventListener("DOMContentLoaded", () => {
            $("#signatureModal").on("shown.bs.modal", () => {                
                $(".canvas-placeholder").fitText();
            });
        });
    </script>
</body>

</html>
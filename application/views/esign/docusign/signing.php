<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>nSmarTrac: DocuSign</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url('assets/css/esign/docusign/docusign.css');?>">
  <script src="https://use.fontawesome.com/f61f458313.js"></script>
</head>
<body>
  <div class="container signing">
    <div class="signing__documentContainer"></div>

    <div class="d-flex justify-content-center">
      <button class="btn btn-primary mt-3">Finish</button>
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
                <ul class="nav nav-tabs" role="tablist">
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

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js"></script>
  <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

  <script src="<?=base_url('assets/js/esign/libs/pdf.js');?>"></script>
  <script src="<?=base_url('assets/js/esign/libs/pdf.worker.js');?>"></script>
  <script src="<?=base_url('assets/js/esign/docusign/signing.js');?>"></script>
</body>
</html>

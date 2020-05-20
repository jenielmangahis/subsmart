<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/signature'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card">


            <div class="container-fluid" style="font-size:14px;">

                <div class="row">
                    <div class="col">
                        <h1 class="m-0">Signature</h1>
                        <p>This is your signature, update any time.</p>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="#">
                                <span class="fa fa-plus"></span> New Signature
                            </a>
                        </div>
                    </div>
                </div>
                        <div class="row">
                            <div class="col-md-12">
                             <div class="signature-holder">
                                <div class="signature-body">
                                    <?php if ( empty( $user->signature ) ){ ?>
                                      <img src="<?=url("");?>uploads/signatures/demo.png" class="img-responsive">
                                    <?php }else{ ?>
                                      <img src="<?=url("");?>uploads/signatures/{{ $user->signature }}" class="img-responsive">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="signature-btn-holder">
                                <a class="btn btn-primary btn-block"  data-toggle="modal" data-target="#updateSignature" data-target="#createFolder" data-backdrop="static" data-keyboard="false"> Update Signature</a>
                            </div>
                            </div>
                        </div>

            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>

<!-- Signature MODAL -->
<div class="modal fade" id="updateSignature" role="dialog">
        <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
      <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Signature </h4>
                </div>
      <ul class="head-links">
        <li type="capture" class="active"><a data-toggle="tab" href="#text">Text</a></li>
        <li type="upload"><a data-toggle="tab" href="#upload">Upload</a></li>
        <li type="draw"><a data-toggle="tab" href="#draw">Draw</a></li>
      </ul>
        <div class="modal-body">
        <div class="tab-content">
            <div id="text" class="tab-pane fade in active">
                      <form>
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                  <label>Type your signature</label>
                                  <input type="text" class="form-control signature-input" name="" placeholder="Type your signature" maxlength="18" value="Your Name">
                                </div>
                                <div class="col-md-6">
                                  <label>Select font</label>
                                  <select class="form-control signature-font" name="">
                                      <option value="Lato">Lato</option>
                                      <option value="Miss Fajardose">Miss Fajardose</option>
                                      <option value="Meie Script">Meie Script</option>
                                      <option value="Petit Formal Script">Petit Formal Script</option>
                                      <option value="Niconne">Niconne</option>
                                      <option value="Rochester">Rochester</option>
                                      <option value="Tangerine">Tangerine</option>
                                      <option value="Great Vibes">Great Vibes</option>
                                      <option value="Berkshire Swash">Berkshire Swash</option>
                                      <option value="Sacramento">Sacramento</option>
                                      <option value="Dr Sugiyama">Dr Sugiyama</option>
                                      <option value="League Script">League Script</option>
                                      <option value="Courgette">Courgette</option>
                                      <option value="Pacifico">Pacifico</option>
                                      <option value="Cookie">Cookie</option>
                                      <option value="Grand Hotel">Grand Hotel</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                  <label>Weight</label>
                                  <select class="form-control signature-weight" name="">
                                      <option value="normal">Regular</option>
                                      <option value="bold">Bold</option>
                                      <option value="lighter">Lighter</option>
                                  </select>
                                </div>
                                <!-- <div class="col-md-4">
                                  <label>Color</label>
                                  <input  class="form-control signature-color jscolor { valueElement:null,borderRadius:'1px', borderColor:'#e6eaee',value:'000000',zIndex:'99999', onFineChange:'updateSignatureColor(this)'}" readonly="">
                                </div> -->
                                <div class="col-md-4">
                                  <label>Style</label>
                                  <select class="form-control signature-style" name="">
                                      <option value="normal">Regular</option>
                                      <option value="italic">Italic</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                      </form>
                      <div class="divider"></div>
                      <h4 class="text-center">Preview</h4>
                      <div class="text-signature-preview">
                          <div class="text-signature" id="text-signature" style="color: #000000">Your Name</div>
                      </div>

            </div>
            <div id="upload" class="tab-pane fade">
                <p>Upload your signature if you already have it.</p>
                  <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Upload your signature</label>
                                <input type="file" name="signatureupload" class="croppie" crop-width="400" crop-height="150">
                          </div>
                      </div>
                  </div>
            </div>
            <div id="draw" class="tab-pane fade text-center">
                    <p>Draw your signature.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="draw-signature-holder"><canvas width="400" height="150" id="draw-signature"></canvas></div>
                            <div class="signature-tools text-center" id="controls">
                                <!-- <div class="signature-tool-item with-picker">
                                    <div><button class="jscolor { valueElement:null,borderRadius:'1px', borderColor:'#e6eaee',value:'000000',zIndex:'99999', onFineChange:'modules.color(this)'}"></button></div>
                                </div> -->
                                <div class="signature-tool-item" id="signature-stroke" stroke="5">
                                    <div class="tool-icon tool-stroke"></div>
                                </div>
                                <div class="signature-tool-item" id="undo">
                                    <div class="tool-icon tool-undo"></div>
                                </div>
                                <div class="signature-tool-item" id="clear">
                                    <div class="tool-icon tool-erase"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save-signature">Save Signature</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script  type="text/javascript">
   @if ( empty( $user->signature ) )
        var signature = '';
        @else
        var signature = '<?=url("");?>uploads/signatures/{{ $user->signature }}';
        @endif

        @if ( is_object($request) && $request->status == "Pending" )
        var signingKey = '{{ $request->signing_key }}';
        var requestPositions = {{ $requestPositions }};
        var requestWidth = {{ $requestWidth }};
        @else
        var signingKey = '';
        @endif

        @if ( $document->is_template == "Yes" )
        var savedWidth = {{ $savedWidth }};
        var templateFields = {{ $templateFields }};
        @endif

    </script>
</script>
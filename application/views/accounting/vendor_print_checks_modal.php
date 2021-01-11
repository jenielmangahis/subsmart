<div class="full-screen-modal">
   <div id="addvendorprintchecksModal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Print Checks Setup
               </div>
               <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="stepwizard">
                                <div class="stepwizard-row">
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-success btn-circle">1</button>
                                        <p>PRINT SAMPLE</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-default btn-circle">2</button>
                                        <p>SET UP PDF READER</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
                                        <p>ADJUST ALIGNMENT</p>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Select a check type and print a sample</h4>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Select the type of checks you use:</p>
                                    <label class="layersMenu">
                                        <div>Voucher</div>
                                        <input type="radio" id="radioZoom14" name="zoomsMBtiles" value="14" checked />
                                        <img src="<?php echo $url->assets ?>img/radio_image.jpg">
                                    </label>

                                    <label class="layersMenu">
                                        <div>Standard</div>
                                        <input type="radio" id="radioZoom18" name="zoomsMBtiles" value="18" />
                                        <img src="<?php echo $url->assets ?>img/radio_image.jpg">
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Load blank paper in your printer.</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button>View preview and print sample</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Place the sample on top of a blank check page. Hold them both up to the light.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6" align="right">
                            <img src="<?php echo $url->assets ?>img/image_print_checks.jpg">
                        </div>
                    </div>
                    

                </div>
                
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>
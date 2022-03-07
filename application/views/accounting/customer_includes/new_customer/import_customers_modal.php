<div id="import-customers-modal">
    <div class="modal-body">
        <ul id="progressbar">
            <li class="active" id="step1">
                <strong>Step 1</strong>
            </li>
            <li id="step2"><strong>Step 2</strong></li>
            <li id="step3"><strong>Step 3</strong></li>
        </ul>
        <div class="progress">
            <div class="progress-bar"></div>
        </div> <br>
        <div class="container">
            <div class="row">
                <i class="fa fa-times close-modal" aria-hidden="true"></i>
                <div class="col-md-12 text-center">
                    <form id="form">
                        <!--import section-->
                        <fieldset id="holder-step-1">
                            <h2>IMPORT YOUR FILES</h2>
                            <div class="file-drop-panel">
                                <div class="panel-title">Attach Document</div>
                                <div class="file-drop-form">
                                    <div id="import_customer">
                                        Drop your files here
                                    </div>
                                </div>
                                <div class="file-deop-label">Acceptable File Types: .xlsx, .xls and .csv only</div>
                                <div class="upload-button">
                                    <button type="button" id="submit-imported-customer-file">Import</button>
                                </div>
                            </div>
                            <input style="display:none" type="button" name="next-step" class="next-step" value="Next Step" />
                        </fieldset>

                        <fieldset id="holder-step-2">

                            <!--1st Row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Welcome To GFG Step 2</h2>
                                </div>
                            </div>
                            <!--2nd Row-->

                            <div class="row marg">
                                <div class="col-md-6">
                                    <h3 class="margi">Checkbox</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="margi">Select</h3>
                                </div>
                            </div>

                            <div class="form-check">

                            </div>



                            <input type="button" name="next-step" class="next-step mt-5" value="Save Now" />
                            <input type="button" name="previous-step" class="previous-step mt-5" value="Previous Step" />
                        </fieldset>
                        <fieldset id="holder-step-3">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                   
                                    <img src="https://localhost/nsmartrac/assets/img/accounting/customers/message.png" style="width: 200px; height:200px; margin:0 auto;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <h2>Saved!</h2>
                                    <h3 style="color:#6a4b86">You've successfully added new customers!!</h3>
                                    
                                
                                </div>
                            </div>                            
                        </fieldset>

                    </form>
                    <div class="col-md-12">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
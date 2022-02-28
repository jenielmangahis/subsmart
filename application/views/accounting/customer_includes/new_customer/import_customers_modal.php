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

                            <div class="row">
                                <!--section 1-->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <h3>
                                                CheckBoxes
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <h3>
                                                Select
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container form-check">
                                <div class="row">
                                </div>
                            </div>
                            <input type="button" name="next-step" class="next-step" value="Next Step" />
                            <input type="button" name="previous-step" class="previous-step" value="Previous Step" />
                        </fieldset>
                        <fieldset id="holder-step-2">
                            <h2>Welcome To GFG Step 3</h2>
                            <input type="button" name="next-step" class="next-step" value="Finish Step" />
                            <input type="button" name="previous-step" class="previous-step" value="Previous Step" />
                        </fieldset>

                    </form>
                    <div class="col-md-12">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
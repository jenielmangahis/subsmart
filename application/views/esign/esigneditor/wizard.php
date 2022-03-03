<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper wrapper--loading" role="wrapper">
    <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div>

    <div class="container mt-4">
        <div>
            <h1 class="esigneditor__title">Letter Wizard (<span></span>)</h1>
        </div>

        <form class="mt-3 wizardForm" id="selectLetterForm">
            <div class="wizardForm__step1">
                <div class="form-group">
                    <label for="category">Letter Category</label>
                    <select class="form-control" id="category" data-name="category_id"></select>
                </div>

                <div class="form-group">
                    <label for="letter">Letter Name</label>
                    <select class="form-control" id="letter" data-name="letter_id"></select>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary esigneditor__btn" type="button">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Next
                    </button>
                </div>
            </div>

            <div class="wizardForm__step2">
                <div class="form-group">
                    <textarea class="form-control" id="letterContent"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button class="link esigneditor__btn">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Export as PDF
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-secondary" type="button">
                            Save For Later
                        </button>

                        <button class="btn btn-primary" type="button">
                            Save & Continue To Print
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>

<?php include viewPath('includes/footer');?>
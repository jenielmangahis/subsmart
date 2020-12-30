<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper px-0">
    <div __wrapper_section class="fb-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pr-5" id="navFormName" href="#">aa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/fb/edit/<?= $form_id ?>">Form Editor</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fb/settings/<?= $form_id ?>">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Results</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-container container-fluid bg-white pt-3 pb-5">
            <div class="row">
                <div class="col-12 col-md-3 border-right">
                    <div class="row">
                        <div class="col-6">
                            <h4>Form Editor</h4>
                        </div>
                        <div class="col-6 pt-2 text-right">
                            <a href="/fb/view/<?= $form_id?>" class="btn btn-outline-primary btn-sm"><i
                                    class="fa fa-eye"></i> View
                                Form</a>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link build-tab builder-tabs" href="/fb/edit/<?= $form_id ?>">Build</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link style-tab builder-tabs" href="/fb/edit/<?= $form_id ?>">Style</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rules-tab builder-tabs active" href="#rulesBuildTab" data-toggle="tab">Rules</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane active" id="rulesBuildTab">
                            <div class="container mt-0">
                                Form Rules
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 position-relative">
                    <div class="container mt-1">
                        <div id="styleSaveContainer" class="indicator text-right">
                            <button onclick="handleFormStyleSave()"
                                class="btn btn-sm btn-primary d-inline-block">Save</button>
                            <button onclick="handleCopyFromFormClicked()"
                                class="btn btn-sm btn-secondary d-inline-block">Clear All</button>
                        </div>
                        <div id="formRulesContainer">
                            <div class="card">
                                <div class="card-header">
                                    Page 1
                                </div>
                                <div class="card-body">
                                    <div class="text-right">
                                        <button class="btn btn-secondary btn-sm">Add Item Rule</button>
                                    </div>
                                    <div class="card">
                                        <p>There are currently no item rules on this page.</p>
                                    </div>
                                    <div class="card">
                                        <h5>After page 1:</h5>
                                        <p>Continue to the default Success Page when no page rules match.</p>
                                        <div class="text-right">
                                            <button class="btn btn-secondary btn-sm">Add Page Rule</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(() => {
    handleOnLoad(<?= $form_id ?>);
});
</script>
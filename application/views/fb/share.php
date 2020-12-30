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
                    <li class="nav-item">
                        <a class="nav-link" href="/fb/edit/<?= $form_id ?>">Form Editor</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fb/settings/<?= $form_id ?>">Settings</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/fb/share/<?= $form_id ?>">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Results</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-container container-fluid bg-white pt-3 pb-5">
            <h4>Share</h4>
            <div class="row">
                <div class="col-12 col-md-3 border-right">
                    <div class="container-fluid px-0 mt-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="list" href="#linksTab">Links</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="list" href="#embedCodeTab">Embed Code</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="list" href="#qrCodeTab">QR Code</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9 position-relative">
                    <div id="loadingContainer" class="bg-primary indicator">
                        <p class="text-white">loading...</p>
                    </div>
                    <div id="dangerIndicator" class="bg-danger indicator">
                        <p class="text-white">error saving changes.</p>
                    </div>
                    <div id="successIndicator" class="bg-success indicator">
                        <p class="text-white">changes saved.</p>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="linksTab">
                            <div class="container mt-0">
                                <h4>Links</h4>
                                <div class="card">
                                    <div class="card-header">
                                        Form Link
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="main-link">This is this form's main link.</label>
                                            <input type="text" class="form-control" name="form-main-link"
                                                id="formMainLink" value="<?= base_url() ?>/fb/view/<?= $form_id ?>"
                                                disabled>
                                            <div class="btn-group mt-1">
                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="handleCopyFormEmbedCode()"><i class="fa fa-copy"></i>
                                                    Copy</button>
                                                <a href="<?= base_url() ?>/fb/view/<?= $form_id ?>"
                                                    class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i>
                                                    View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="embedCodeTab">
                            <div class="container mt-0">
                                <h4>Embed Code</h4>
                                <div class="card">
                                    <div class="card-header">
                                        Embed Code
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="main-link">Paste this embed code into your web page.</label>
                                            <textarea name="form-embed-code" id="formEmbedCode" cols="30" rows="10"
                                                class="form-control" disabled></textarea>
                                            <div class="btn-group mt-1">
                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="handleCopyFormLink()"><i class="fa fa-copy"></i>
                                                    Copy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="qrCodeTab">
                            <div class="container mt-0">
                                <h4>Links</h4>
                                <div class="card">
                                    <div class="card-header">
                                        QR Code
                                    </div>
                                    <div class="card-body">
                                        <div class="container-mt-0">
                                            <div class="py-auto text-center" id="formQRCode">

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
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(() => {
    handleOnLoad(<?= $form_id ?>);
});
</script>
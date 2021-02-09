<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/responsive.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <title>eSign</title>
    <style>
        .hideElement {
            display: none;
        }

        .ui-draggable {
            width: auto !important;
        }

        .menu_listItem-disabledFeature .menu_item.disabled:hover {
            color: #999999;
        }

        .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction {
            position: absolute;
            right: 12px;
        }

        .menu_item-smartContractInfo {
            position: absolute;
            right: 2px;
            visibility: hidden;
            color: #999999;
        }

        .menu_item-smartContractInfoShow:hover * {
            visibility: visible;
        }

        .tab-badge-left-margin {
            margin-left: auto;
        }

        .document-page {
            border: 2px solid black;
            margin-top: 30px;
        }

        .document-page:first-child {
            margin-top: 50px !important;
        }

        /* *** Sidebar *** */
        .edit-sidebar-1 {
            background: #fff;
            width: 300px;
            height: 100vh;
            overflow: auto;
            position: fixed;
            right: 0%;
            top: 0;
            z-index: 10;
            background: #f5f5f5;
            padding: 95px 0 30px;
            transition: .4s linear;
        }

        .edit-sidebar {
            background: #fff;
            width: 300px;
            height: 100vh;
            overflow: auto;
            position: fixed;
            right: 0%;
            top: 0;
            z-index: 10;
            background: #f5f5f5;
            padding: 95px 0 30px;
            transition: .4s linear;
        }

        .edit-sidebar-open {
            right: 0 !important;
            transition: .4s linear;
        }

        .edit-sidebar h3 {
            padding: 15px 30px;
            border-bottom: 1px solid #e0e0e0;
            font-weight: normal;
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .edit-sidebar h3 i {
            margin-right: 5px;
        }

        .edit-sidebar-1 h3 i {
            margin-right: 5px;
        }

        .collapsible-section-card {
            background-color: #f4f4f4;
        }

        .collapsible-section-card .actions {
            display: none;
        }

        .collapsible-section-card:hover .actions {
            display: block;
        }

        .collapsible-section-card:focus-within .actions {
            display: block;
        }

        .collapsible-section-card:hover .action-wrapper {
            border-top: 1px solid #e9e9e9;
        }

        .collapsible-section-card textarea {
            border: 0px;
            resize: none;
        }

        .collapsible-section-card:hover .section-label-header {
            display: block;
        }

        .collapsible-section-card:focus-within .section-label-header {
            display: block;
        }

        .collapsible-section-card .section-label-header {
            display: none;
        }

        .absolute-div-properties-panel {
            position: absolute;
            z-index: 2;
            width: 100%;
            height: 100%;
        }

        body {
            padding-bottom: 0px !important;
        }

        .resize-x-handle-flip {
            transform: rotateX(180deg);
        }

        .x-text-flip-back {
            transform: rotateX(180deg);
        }

        .vertical-scroll {
            min-height: 20px;
            resize: vertical;
            overflow: auto;
        }
        select { font-family: 'FontAwesome', Verdana }
    </style>
    <?php echo put_header_assets(); ?>
</head>

<body style="background: white !important;">
    <?php include viewPath('includes/header'); ?>

    <?php if (isset($next_step) && $next_step == 0) { ?>

        <?php echo form_open_multipart('esign/fileSave', ['id' => 'upload_file', 'class' => 'form-validate esignBuilder', 'autocomplete' => 'off', 'data-form-step' => '1']); ?>
        <input type="hidden" value="1" name="next_step" />
        <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
        <header style="margin-top: 81px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="left-part">
                            <a class="back-step"></a>
                            <p>Upload a Document and Add Envelope Recipients</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="right-part">
                            <ul>
                                <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                                <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">HTML</a></li>
                                        <li><a href="#">CSS</a></li>
                                        <li><a href="#">JavaScript</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="recent-view">Recipient Preview </a></li>
                                <li><a href="<?php echo base_url('esign/Files?next_step=1'); ?>" class="recent-view next-btn">next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Main Wrapper -->
        <section class="main-wrapper" id="custome-fileup" style="background: white;padding-bottom: 15px;">
            <div class="container">
                <h1 class="esignBuilder__title">Add Documents to the Envelope</h1>
                <div class="alert alert-warning mt-2" role="alert">
                    <span style="color:black;">
                        Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.
                    </span>
                </div>

                <div class="d-flex">
                    <div class="custome-fileup">

                        <div class="upload-btn-wrapper">
                            <button class="btn">
                                <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                                <span>Upload</span>
                            </button>
                            <input type="file" name="docFile" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel" required/>
                        </div>

                        <!-- <div class="dropdown">
                                <button class="btn-upl dropdown-toggle" type="button" data-toggle="dropdown">Get from Cloud
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic1.png" alt=""> Box</a></li>
                                    <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic2.png" alt=""> Dropbox</a></li>
                                    <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic3.png" alt=""> Google Drive</a></li>
                                    <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic4.png" alt=""> One Drive</a></li>
                                </ul>
                            </div> -->
                    </div>

                    <div class="ml-3 esignBuilder__docPreview d-none">
                        <canvas></canvas>
                        <div class="esignBuilder__docInfo">
                            <h5 class="esignBuilder__docTitle"></h5>
                            <span class="esignBuilder__docPageCount"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer --->
        <footer>
            <div class="container-fluid">
                <ul>
                    <!-- <li><a href="#">Send Now</a></li> -->
                    <li><button type="submit" class="next-btn esignBuilder__submit">next</button></li>
                </ul>
            </div>
        </footer>

        <div class="modal esignBuilder__modal" id="documentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php } ?>




    <?php /* if(isset($next_step) && $next_step == 0) { ?>

<?php echo form_open_multipart('esign/fileSave', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <input type="hidden" value="0" name="next_step" />
    <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
    <header style="margin-top: 81px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="left-part">
                        <a class="back-step"></a>
                        <p>Upload a Document and Add Envelope Recipients</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="right-part">
                        <ul>
                            <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                            <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="recent-view">Recipient Preview </a></li>
                            <li><a href="<?php echo base_url('esign/Files?next_step=1');?>" class="recent-view next-btn">next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main Wrapper -->
    <section class="main-wrapper"  id="custome-fileup" style="background: white;padding-bottom: 15px;">
        <div class="container">
        <h1>Add Documents to the Envelope</h1>

            <div class="custome-fileup" >
            
                <div class="upload-btn-wrapper">
                    <button class="btn">
                        <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                        <span>Upload</span>
                    </button>
                    <input type="file" name="docFile" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel"/>
                </div>

                <!-- <div class="dropdown">
                    <button class="btn-upl dropdown-toggle" type="button" data-toggle="dropdown">Get from Cloud
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic1.png" alt=""> Box</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic2.png" alt=""> Dropbox</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic3.png" alt=""> Google Drive</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic4.png" alt=""> One Drive</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Footer --->
    <footer>
        <div class="container-fluid">
            <ul>
                <!-- <li><a href="#">Send Now</a></li> -->
                <li><a href="#" onClick="uploadOrNext(true)" class="next-btn">next</a></li>
            </ul>
        </div>
    </footer>
    <!-- End Footer --->
<?php echo form_close(); ?>
<?php } */ ?>

    <?php if (isset($next_step) && $next_step == 2): ?>
        <?php echo form_open_multipart('esign/recipients', ['id' => 'upload_file', 'class' => 'form-validate esignBuilder', 'autocomplete' => 'off', 'data-form-step' => '2']); ?>
        <input type="hidden" value="3" name="next_step" />
        <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
        <header style="margin-top: 81px; z-index : 1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="left-part">
                            <a href="<?php echo base_url('esign/Files?next_step=1'); ?>" class="back-step"><i class="fa fa-angle-left"></i></a>
                            <p>Upload a Document and Add Envelope Recipients</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="right-part">
                            <ul>
                                <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                                <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">HTML</a></li>
                                        <li><a href="#">CSS</a></li>
                                        <li><a href="#">JavaScript</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="recent-view">Recipient Preview </a></li>
                                <li><a href="<?php echo base_url('esign/Files?next_step=2'); ?>" class="recent-view next-btn">next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Main Wrapper -->
        <section class="main-wrapper" id="add-recipeit" style="background: white;padding-bottom: 55px;">
            <div class="container">

                <div class="add-recipeit">
                    <h1 class="esignBuilder__title">Add Recipients to the Envelope</h1>
                    <div class="alert alert-warning mt-2" role="alert">
                        <span style="color:black;">
                            Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="add-note">
                                <p>As the sender, you automatically receive a copy of the completed envelope.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="quick-act">
                                <ul>
                                    <li><a href="#"><i class="fa fa-address-book"></i> Add from contacts</a></li>
                                    <li><a href="#"><i class="fa fa-code-fork"></i> Signing Order</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="rec-envlo-block">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="left-wnvofrm">
                                    <div class="cust-check">
                                        <input type="checkbox" id="html">
                                        <label for="html">Set signing order</label>
                                    </div>

                                    <div id="setup-recipient-list">

                                    </div>

                                    <a class="btn-main esignBuilder__addForm" id="add-recipient-button">
                                        <i class="fa fa-user-plus"></i>Add Recipient
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- Footer --->
        <footer>
            <div class="container-fluid">
                <ul class="d-flex align-items-center justify-content-end">
                    <li><a onClick='onbackclick("<?php echo url('esign/Files?id=' . $file_id . '&next_step=0') ?>")'>Back</a></li>
                    <li><button class="esignBuilder__submit" type="submit">next</button></li>
                </ul>
            </div>
        </footer>
        <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php endif; ?>


    <?php if (isset($next_step) && $next_step == 3) { ?>

        <?php echo form_open_multipart('esign/recipients', ['id' => 'upload_file', 'class' => 'form-validate mb-0', 'autocomplete' => 'off']); ?>
        <input type="hidden" value="3" name="next_step" />
        <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />


        <div class="card p-0 mb-0">
            <div class="site_content">
                <div class="content_wrap" style="position: relative;margin-top: 80px;">
                    <div class="content_sidebar content_sidebar-left resizable ng-scope ng-isolate-scope" style="overflow-x: hidden" ng-class="{'file-drop': markupPalettesCtrl.showDeleteDropZone}" ng-mouseenter="hookCtrl.trigger('mouseenter', $event)">
                        <div class="resize-horizontal resize-right resize-line ng-scope" svg-view-angular-hook="" hook-name="'paletteResizerHandle'" ng-mousedown="hookCtrl.trigger('mousedown', $event); $event.preventDefault();"></div>

                        <div class="sidebar_footer ng-scope"></div>

                        <div class="sidebar-fields sidebar-flex">
                            <div class="sidebar_main ng-scope" data-callout="tagger-sidebar" svg-view-angular-hook="" hook-name="'tabListPanel'" role="region" aria-label="Fields Palette" id="left-panel-tagger">

                                <div class="sidebar-fields ng-scope ng-isolate-scope" olive-scroll-shadow-initialized="true" style="box-shadow: rgba(0, 0, 0, 0.18) 0px -7px 7px -7px inset">
                                    <div class="sidebar_group l-flex-between ng-scope" data-callout="send-fields">
                                        <h5>
                                            <span tabindex="-1" data-qa="search-results-tagger" class="ng-binding ng-scope">Standard Fields</span>
                                        </h5>
                                    </div>
                                    <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    <button id="draggable-signature" draggable=true class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(),'menu_item-isActive': hookCtrl.view.get('selected')}" data-qa="Signature" title="Signature">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-sign"></i></span>
                                                        <span class="u-ellipsis ng-binding">Signature</span>
                                                    </button>
                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Initial" title="Initial">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-initial"></i></span>

                                                        <span class="u-ellipsis ng-binding">Initial</span>
                                                    </button>
                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Stamp" title="Stamp">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-stamp"></i></span>
                                                        <span class="u-ellipsis ng-binding">Stamp</span>
                                                    </button>
                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Date Signed" title="Date Signed">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-date signed"></i></span>
                                                        <span class="u-ellipsis ng-binding">Date Signed</span>
                                                    </button>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem ng-scope ng-isolate-scope">
                                                    <div class="fields menu_item ng-scope" rel='name' data-qa="Name" title="Name">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-name"></i></span>
                                                        <span class="u-ellipsis ng-binding">Name</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope">
                                                    <div class="fields menu_item ng-scope" rel='email' title="Email">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-email"></i></span>
                                                        <span class="u-ellipsis ng-binding">Email</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope">
                                                    <div class="fields menu_item ng-scope" rel='company' data-qa="Company" title="Company">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-company"></i></span>
                                                        <span class="u-ellipsis ng-binding">Company</span>
                                                    </div>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Title" title="Title">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-title"></i></span>
                                                        <span class="u-ellipsis ng-binding">Title</span>

                                                    </button>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                        <div class="menu-fields">

                                            <ul class="menu_list">

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Text" title="Text">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-text"></i></span>

                                                        <span class="u-ellipsis ng-binding">Text</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">


                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Checkbox" title="Checkbox">


                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>

                                                        <span class="u-ellipsis ng-binding">Checkbox</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Dropdown" title="Dropdown">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-dropdown"></i></span>

                                                        <span class="u-ellipsis ng-binding">Dropdown</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Radio" title="Radio">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-radio"></i></span>
                                                        <span class="u-ellipsis ng-binding">Radio</span>

                                                    </button>

                                                </li>
                                            </ul>

                                        </div>

                                    </div>

                                    <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">

                                        <div class="menu-fields">

                                            <ul class="menu_list">
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Formula" title="Formula">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-formula"></i></span>

                                                        <span class="u-ellipsis ng-binding">Formula</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Attachment" title="Attachment">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-attachment"></i></span>

                                                        <span class="u-ellipsis ng-binding">Attachment</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Note" title="Note">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-note"></i></span>

                                                        <span class="u-ellipsis ng-binding">Note</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Approve" title="Approve">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-approve"></i></span>

                                                        <span class="u-ellipsis ng-binding">Approve</span>

                                                    </button>

                                                </li>

                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">

                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Decline" title="Decline">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-decline"></i></span>

                                                        <span class="u-ellipsis ng-binding">Decline</span>

                                                    </button>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="content_main" id="main-pdf-render" style="height: 887px;overflow: auto;    position: relative;margin: 0 auto; text-align: center;" role="region" aria-label="Active Page">
                        <div id="draggable" class="resize-x-handle-flip">
                            <div class="x-text-flip-back">
                                <div class="vertical-scroll">
                                <div  style="border:3px solid black;" class="ui-widget-content sideopne"><p>Signature dd</p></div>
                                </div>
                            </div>
                        </div>
                        <div id="draggable-2" class="resize-x-handle-flip">
                            <div class="x-text-flip-back">
                                <div class="vertical-scroll">
                                <div  style="border:3px solid black;" class="ui-widget-content sideopne-1"><p>Signature 2</p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div ng-class="taggerCtrl.shouldShowPanelSection()" lazy-load-container="thumbNails" svg-view-angular-hook="" hook-name="'documentThumbnailsPanel'" tagger-thumbnails-container="" id="right-panel-tagger" class="ng-scope content_sidebar content_sidebar-right">
                        <div class="sidebar_header l-flex-between" thumbnails-header="">
                            <div>
                                <!-- <span class="ng-binding">Documents</span> -->
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="edit-sidebar" style="display:none">
                            <h3><i class="fa fa-pencil"></i> Signature </h3>
                            <select onchange="this.style.color=this.options[this.selectedIndex].style.color"  style="color : <?=$recipients[0]['color']?>;  font-family : 'FontAwesome', Arial;">
                                <?php foreach ($recipients as $recipient){ ?>
                                    <option style="color : <?=$recipient['color']?>" value="1"><?=$recipient['name']?>  &#xf111;</option>
                                    <!-- <option style="color : green" value="2">Harsh &#xf042;</option> -->
                                <?php } ?>
                            </select>
                            <hr>
                            <div class="cus-check">
                                <div class="form-group">
                                    <input type="checkbox" id="css">
                                    <label for="css">Required Field</label>
                                </div>
                            </div>
                            <!-- <div class="listing-edit faq-wrps">
                                <div class="panel-group" id="accordion-2" role="tablist" aria-multiselectable="true">
                                    
                                </div>
                            </div> -->
                            <div class="side-action">
                                <button class="btn-side">Save As Custom Field</button>
                                <a class="btn-side delbt">Delete</a>
                            </div>
                        </div>
                        <div class="edit-sidebar-1" style="display:none;">
                            <h3 style="padding: 15px 30px; border-bottom: 1px solid #e0e0e0; font-weight: normal; font-size: 16px; color: #333; margin: 0;"><i class="fa fa-pencil"></i> Signature 2</h3>
                            <div class="cus-check">
                                <div class="form-group">
                                    <input type="checkbox" id="css">
                                    <label for="css">Required Field</label>
                                </div>
                            </div>
                            <div class="listing-edit faq-wrps">
                                <div class="panel-group" id="accordion-2" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion-2" href="#collapsefne" aria-expanded="false" aria-controls="collapsefne">Formatting</a>
                                            </h4>
                                        </div>
                                        <div id="collapsefne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfour">
                                            <div class="panel-body">
                                                <div class="frmat-bx">
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                    <p> Scale %</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Data Label</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <div class="frmat-bx dtlab">
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-2" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Tooltip</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                <div class="frmat-bx dtlab">
                                                    <textarea class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingfor">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-2" href="#collapsefor" aria-expanded="false" aria-controls="collapsefor">Location</a>
                                            </h4>
                                        </div>
                                        <div id="collapsefor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfor">
                                            <div class="panel-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="side-action">
                                <button class="btn-side">Save As Custom Field</button>
                                <a class="btn-side delbt-1">Delete</a>
                            </div>
                        </div>

                        <div class="docsWrapper ng-scope ng-isolate-scope" ng-if="taggerCtrl.shouldShowDocumentThumbnails()" envelope-data-manager="taggerCtrl.envelopeDataManager">
                            <div class="singleDocument ng-scope" data-qa="doc-thumbnail-list" ng-repeat="document in thumbCtrl.documents.getSorted() | filter: thumbCtrl.documentPreview_filter">

                                <div id="main-pdf-render-preview" class="documentPageSet drawer down ng-scope full open" style="overflow: auto;height: 866px;">


                                    <!-- <div class="drawer-wrapper ng-scope"><br>
                                <div class="documentPage ng-scope" data-qa="tagger-documents">
                                    <img class="img" data-qa="indvidual-tagger-documents" ng-style="{ 'min-height': 132 / page.get('width') * page.get('height')+ 'px' }" alt="pdf.pdf - Page 1" lazy-load-item="thumbNails" lazy-load-url="page.getImageUrl()" should-unload="document.getPages().length > 100" src="https://app.docusign.com/page-image/accounts/5a4bea64-9f10-42d5-ae11-edd0b58f60d3/envelopes/093ea65e-5cc5-40e1-aa00-15986e27e398/documents/1/pages/1/page_image?lock_token=MTJhNzI5MjYtYmQ3YS00ODk1LTkxNGMtNWIxMWQ3MzE1MjM4&amp;cache_token=2245e9d6-0239-4910-8c1c-f6753cc0d4cb&amp;dpi=150" style="min-height: 170.824px">
                                    <div class="bar-action"> </div>
                                    <div class="column-indicators">
                                </div>

                                <span class="pageNumber ng-binding">1</span>
                            </div> -->



                                </div>

                            </div>

                        </div>

                        <div ng-switch="taggerCtrl.useSupplementalDocumentAttributes">
                            <div class="supplemental-documents-drawer drawer left drawer-properties ng-scope ng-isolate-scope closed" olive-drawer-initial-state="closed" olive-drawer-name="supplementalDocumentsPanel" olive-drawer-direction="left" olive-animation-weight="light" ng-switch-default="" supplemental-document-properties-panel="" sdpp-documents="taggerCtrl.getDocuments()" sdpp-recipients="taggerCtrl.envelope.recipients" olive-drawer-initialized="true" style="width: 0px">
                                <div class="drawer-wrapper">
                                    <div class="drawer-content full-drawer" olive-drawer-content="">
                                        <div class="drawer-properties_header">
                                            <span class="ng-binding">Supplement</span>
                                        </div>
                                        <div class="drawer-properties_main" olive-scroll-shadow="scrollShadowSupplmentalDocuments" olive-scroll-shadow-initialized="true">
                                            <div class="drawer down full open"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="drawer-open-close drawer left drawer-properties ng-isolate-scope closed" olive-drawer-initial-state="closed" olive-drawer-name="propertiesPanel" olive-drawer-direction="left" olive-animation-weight="light" envelope-moderator="taggerCtrl.envelopeModerator" open-signing-preview="taggerCtrl.openRecipientsPreviewOverlay(tabid)" olive-drawer-initialized="true" style="width: 0px">
                            <div class="drawer-wrapper-open-close drawer-wrapper ng-scope" role="region" aria-label="Properties Panel" svg-view-angular-hook="" hook-name="'propertiesPanel'">
                                <div olive-drawer-content="" class="drawer-content full-drawer" template="propertiesPanelDrawerCtrl.markupPropertiesPanelTemplate">


                                    <div class="drawer-properties_footer ng-scope">
                                        <button class="btn btn-block btn-md btn-utility ng-scope ng-hide" type="button" ng-show="hookCtrl.view.canDeleteSelection()" svg-view-angular-hook="" data-qa="properties-panel-delete" hook-name="'destroyMarkupSelection'" ng-click="hookCtrl.trigger('click', $event)">
                                            <span class="ng-binding">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="drawer-open-close drawer left drawer-properties ng-isolate-scope closed d-none" olive-drawer-initial-state="closed" olive-drawer-name="propertiesPanel" olive-drawer-direction="left" olive-animation-weight="light" envelope-moderator="taggerCtrl.envelopeModerator" open-signing-preview="taggerCtrl.openRecipientsPreviewOverlay(tabid)" olive-drawer-initialized="true" style="width: 0px">
                            <div class="drawer-wrapper-open-close drawer-wrapper ng-scope" role="region" aria-label="Properties Panel" svg-view-angular-hook="" hook-name="'propertiesPanel'">
                                <div olive-drawer-content="" class="drawer-content full-drawer" template="propertiesPanelDrawerCtrl.markupPropertiesPanelTemplate">

                                    <div class="drawer-properties_footer ng-scope">
                                        <button class="btn btn-block btn-md btn-utility ng-scope ng-hide" type="button" ng-show="hookCtrl.view.canDeleteSelection()" svg-view-angular-hook="" data-qa="properties-panel-delete" hook-name="'destroyMarkupSelection'" ng-click="hookCtrl.trigger('click', $event)">
                                            <span class="ng-binding">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php include viewPath('esign/esign-page-preview-step-4-style');  ?>
                        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
                        <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
                        <script>
                            var url = "<?php echo base_url('uploads/DocFiles/' . $file_url); ?>";
                        </script>
                        <script src="<?php echo $url->assets ?>/esign/js/main.js"></script>

                    <?php } ?>

                    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/bootstrap.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>

</html>
<script>
    var current_target = 0;

    // $('.next-btn').click(function() {
    //     current_target = current_target + 1;
    //     if (current_target == 0) {
    //         $('#custome-fileup').show();
    //         $("#add-recipeit").hide();
    //         $("#tagspreview").hide();
    //         $('#all-recipients-wrp').hide();
    //     } else if (current_target == 1) {
    //         $('#custome-fileup').hide();
    //         $("#add-recipeit").show();
    //         $("#tagspreview").hide();
    //         $('#all-recipients-wrp').hide();
    //     } else if (current_target == 2) {
    //         $('#custome-fileup').hide();
    //         $("#add-recipeit").hide();
    //         $("#tagspreview").show();
    //         $('#all-recipients-wrp').hide();
    //     } else if (current_target == 3) {
    //         $('#custome-fileup').hide();
    //         $("#add-recipeit").hide();
    //         $("#tagspreview").hide();
    //         $('#all-recipients-wrp').show();
    //     }
    // });
</script>
<style>
    .main-wrapper {
        padding: 213px 0 292px;
        width: 100%;
    }

    #all-recipients-wrp {
        padding: 213px 0 292px;
    }


    /* reception list */
    #setup-recipient-list .form-box {
        margin: 13px 0 13px 0;
    }
</style>
<script>
    function uploadOrNext(next = false) {
        if (next == true) {
            $('input[name="next_step"]').val(1);
        }
        $("#upload_file").submit();
    }

    // function onbackclick(backlink) {
    //     alert(backlink);
    //     window.location.href = backlink;
    // }

    // function addReceiption() {
    //     $('#setup-recipient-list').append(receiptionHtml);
    //     return false;
    // }
</script>
<style>
    /* .draggable-ele {  padding: 0.5em; width:100px; left:250px; top:300px; position: 'absolute'; } */
    /* #draggable {  padding: 0.5em; width:100px; left:250px; top:300px; position: 'absolute'; }
    #draggable-2 {  padding: 0.5em; width:100px; left:250px; top:300px; position: 'absolute'; }
    #draggable-3 {  padding: 0.5em; width:100px; left:250px; top:300px; position: 'absolute'; }
    #testDrag {  padding: 0.5em; width:100px; left:250px; top:300px; position: 'absolute'; }
     */
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script> $(document).ready( function () { $( "#draggable" ).draggable(); }); </script> -->

<script type="text/javascript">
    $('.sideopne').on('click', function() {
        $('.edit-sidebar').show();
        $('.edit-sidebar-1').hide();
    });
    $('.delbt').on('click', function() {
        $('.edit-sidebar').hide();
        $('.edit-sidebar-1').hide();
    });
    $('.sideopne-1').on('click', function() {
        $('.edit-sidebar-1').show();
        $('.edit-sidebar').hide();
    });
    $('.delbt-1').on('click', function() {
        $('.edit-sidebar-1').hide();
        $('.edit-sidebar').hide();
    });
</script>

<!-- UPDATED SCRIPTS -->

<script>
    let recColors = ["#ffd65b", "#acdce6", "#c0a5cf", "#97c9bf", "#f7b994", "#c3d5e6", "#cfdb7f", "#ff9980", "#e6c6e6", "#ffb3c6"];
    let recCount = 0;

    // // Choose Index of color 
    function getIndex() {
        if (recCount <= recColors.length) {
            return recCount - 1;
        } else {
            let cur = recCount % recColors.length || 10;
            return (cur - 1);
        }
    }

    // // Get Receiptent Html
    function getReceiptionHtml() {
        let html = `
        <div id="mainDiv-{{id}}" class="form-box" style="border-left-width: 5px; border-left-color : {{borderColor}}">
            <a  id="closeBox-{{id}}" onclick="removeRecipients({{id}})" class="clos-bx {{isDisplayCloseBox}}"><i class="fa fa-times-circle-o"></i></a>
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="leffm">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="hidden" name="colors[]" value="{{borderColor}}"> 
                            <input type="text" placeholder="" name="recipients[]" class="form-control"> 
                            <a href="#"><i class="fa fa-address-book"></i></a>
                        </div>
                        <div class="form-group"> 
                            <label>Email *</label> 
                            <input type="text" placeholder="" name="email[]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="action-envlo">
                        <ul>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i>Needs to Sign</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Needs to Sign</a></li>
                                    <li><a href="#"><i class="fa fa-clone"></i> Receives a Copy</a></li>
                                    <li><a href="#"><i class="fa fa-eye"></i> Needs to View</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">More</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-key"></i> Add access authentication</a></li>
                                    <li><a href="#"><i class="fa fa-comment"></i> Add private message</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        `;
        html = html.replace(/{{borderColor}}/g, recColors[getIndex()])
        html = html.replace(/{{id}}/g, recCount)
        html = html.replace(/{{isDisplayCloseBox}}/g, recCount == "1" ? 'hideElement' : '');


        return html;
    }

    function addReceiption() {
        // recCount++;
        // $('#setup-recipient-list').append(getReceiptionHtml());
        // return false;
    }

    // // Generate Random String
    function generateField() {
        return Math.floor(Math.random() * (100000 - 1 + 1) + 57);
    }

    // // on input expad text input
    function expand(obj) {
        obj.style.minWidth = ((obj.value.length + 1) * 7) + 'px';
    }

    // // Remove recipients
    function removeRecipients(id) {
        if (id != "1") {
            $('#mainDiv-' + id).remove();
        }
    }

    // // Remove dragged element
    function removeCurrentElement(event) {
        $(event).parent().remove();
        return false;
    }

    $(document).ready(function() {
        // (async () => {
        //     const urlParams = new URLSearchParams(window.location.search);
        //     const id = urlParams.get('id');

        //     const response = await fetch(`/nsmartrac/esign/apiGetDocumentRecipients/${id}`);
        //     const recipients  = await response.json();

        //     if (recipients.length === 0) {
        //         addReceiption();
        //         return;
        //     }

        //     const forms = recipients.map(createForm);
        //     $('#setup-recipient-list').append(forms);
        // })();

        // addReceiption();
        // $('.js-example-basic-single').select2();
    });

    $(function() {

        $(".content_main").droppable({
            drop: function(event, ui) {
                //this if condition is for avoiding multiple time drop and attachment of same item
                if (ui.draggable.hasClass("fields")) {
                    var $item = $(ui.helper).clone(); //getting the cloned item
                    rel = $item.attr('rel');
                    $item.removeClass("fields");
                    let innerHtml = '';
                    let uniqueId = generateField();
                    switch (rel) {
                        case 'name':
                            innerHtml = `<div class='div-name-${uniqueId} subData'> <input class="remove-added-element" onclick="return removeCurrentElement(this)" type="button" value="X" /> <input class='input-name-${uniqueId} subDataInput' placeholder="Enter Your Name" type="text"  oninput="expand(this);"  > </div>`;
                            break;
                        case 'email':
                            innerHtml = `<div class='div-email-${uniqueId} subData'> <input class="remove-added-element" onclick="return removeCurrentElement(this)" type="button" value="X" /> <input class='input-email-${uniqueId} subDataInput' placeholder="Enter Your Email" oninput="expand(this);" type="text"> </div>`;
                            break;
                        case 'company':
                            innerHtml = `<div class='div-company-${uniqueId} subData'> <input class="remove-added-element" onclick="return removeCurrentElement(this)" type="button" value="X" /> <input class='input-company-${uniqueId} subDataInput' placeholder="Copmpany Name" oninput="expand(this);" type="text"> </div>`;
                            break;
                    }
                    $item.html(innerHtml)
                    $(this).append($item);
                    makeDraggable($item);
                }
            }
        })

        // // Draggable Element
        function getSignHtml(){
            
        }

        function makeDraggable($item) {
            $item.draggable({
                start: function() {},
                stop: function() {
                    // console.log('stopped')
                }
            });
        }

        $(".fields").draggable({
            containment: ".content_main",
            appendTo: ".content_main",
            helper: "clone",
            // helper: function(){
            //     return `<div>Email</div>`;
            // },
            start: function() {},
            stop: function() {
                // console.log('stopped')
            }
        });
    })
</script>
<?php echo put_footer_assets(); ?>
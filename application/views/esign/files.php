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
    <?php include viewPath('includes/header');?>

    <?php if (isset($next_step) && $next_step == 0) {?>

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
                    </div>

                    <div class="ml-3 esignBuilder__docPreview d-none">
                        <canvas></canvas>
                        <div class="esignBuilder__docInfo">
                            <h5 class="esignBuilder__docTitle"></h5>
                            <span class="esignBuilder__docPageCount"></span>
                        </div>

                        <div class="esignBuilder__uploadProgress" width="100%">
                            <span></span>
                        </div>

                        <div class="esignBuilder__uploadProgressCheck">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Check</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer --->
        <footer>
            <div class="container-fluid">
                <ul>
                    <li>
                        <button type="submit" class="btn esignBuilder__submit" disabled>
                            Next
                        </button>
                    </li>
                </ul>
            </div>
        </footer>

        <div class="modal esignBuilder__modal" id="documentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php }?>

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
                    <li><button class="esignBuilder__submit" type="submit">Next</button></li>
                </ul>
            </div>
        </footer>
        <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php endif;?>


    <?php if (isset($next_step) && $next_step == 3): ?>
        <?php echo form_open_multipart('esign/recipients', ['id' => 'upload_file', 'class' => 'form-validate mb-0 esignBuilder esignBuilder--step3', 'autocomplete' => 'off', 'data-form-step' => '3', 'data-doc-url' => base_url('uploads/DocFiles/' . $file_url)]); ?>

        <input type="hidden" value="3" name="next_step" />
        <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />

        <div class="card p-0 mb-0">
            <div class="site_content">
                <div class="content_wrap" style="position: relative;">
                    <div class="content_sidebar content_sidebar-left resizable" style="overflow-x: hidden">
                        <div class="sidebar-fields sidebar-flex">
                            <div class="sidebar_main">
                                <div class="dropdown esignBuilder__recipientSelect">
                                    <button
                                        data-recipient-color="<?=$recipients[0]['color'];?>"
                                        data-recipient-id="<?=$recipients[0]['id'];?>"
                                        class="btn btn-secondary dropdown-toggle"
                                        type="button"
                                        id="recipientsSelect"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="fa fa-circle mr-1"></i>
                                        <span><?=$recipients[0]['name'];?></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="recipientsSelect">
                                        <?php foreach ($recipients as $recipient): ?>
                                            <a
                                                href="#"
                                                class="dropdown-item"
                                                data-recipient-color="<?=$recipient['color'];?>"
                                                data-recipient-id="<?=$recipient['id'];?>"
                                            >
                                                <?=$recipient['name'];?>
                                            </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>

                                <div class="sidebar-fields">
                                    <div class="sidebar_group l-flex-between">
                                        <h5>
                                            <span tabindex="-1" class="ng-binding">Standard Fields</span>
                                        </h5>
                                    </div>
                                    <div class="sidebar_item">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-sign"></i></span>
                                                        <span class="u-ellipsis ng-binding">Signature</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-initial"></i></span>
                                                        <span class="u-ellipsis ng-binding">Initial</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-stamp"></i></span>
                                                        <span class="u-ellipsis ng-binding">Stamp</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-date signed"></i></span>
                                                        <span class="u-ellipsis ng-binding">Date Signed</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="sidebar_item">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-name"></i></span>
                                                        <span class="u-ellipsis ng-binding">Name</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-email"></i></span>
                                                        <span class="u-ellipsis ng-binding">Email</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-company"></i></span>
                                                        <span class="u-ellipsis ng-binding">Company</span>
                                                    </div>

                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-title"></i></span>
                                                        <span class="u-ellipsis ng-binding">Title</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="sidebar_item">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-text"></i></span>
                                                        <span class="u-ellipsis ng-binding">Text</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                        <span class="u-ellipsis ng-binding">Checkbox</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-dropdown"></i></span>
                                                        <span class="u-ellipsis ng-binding">Dropdown</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-radio"></i></span>
                                                        <span class="u-ellipsis ng-binding">Radio</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="sidebar_item">
                                        <div class="menu-fields">
                                            <ul class="menu_list">
                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-formula"></i></span>
                                                        <span class="u-ellipsis ng-binding">Formula</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-attachment"></i></span>
                                                        <span class="u-ellipsis ng-binding">Attachment</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-note"></i></span>
                                                        <span class="u-ellipsis ng-binding">Note</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-approve"></i></span>
                                                        <span class="u-ellipsis ng-binding">Approve</span>
                                                    </div>
                                                </li>

                                                <li class="menu_listItem">
                                                    <div class="fields menu_item">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-decline"></i></span>
                                                        <span class="u-ellipsis ng-binding">Decline</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        id="main-pdf-render"
                        role="region"
                    ></div>

                    <div class="ng-scope content_sidebar content_sidebar-right ml-auto">
                        <div class="docsWrapper">
                            <div class="singleDocument">
                                <div id="main-pdf-render-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="esignBuilder__footer">
            <button type="button" class="btn btn-secondary mr-3">Back</button>
            <button type="button" class="btn btn-success" id="submitBUtton">
                <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Send
            </button>
        </div>

        <?php echo form_close(); ?>
        <?php include viewPath('esign/esign-page-preview-step-4-style');?>
    <?php endif;?>

    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>

</html>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php echo put_footer_assets(); ?>
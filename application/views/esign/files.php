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
                    <li><button class="esignBuilder__submit" type="submit">next</button></li>
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
                        <div class="resize-horizontal resize-right resize-line"></div>

                        <div class="sidebar_footer"></div>

                        <div class="sidebar-fields sidebar-flex">
                            <div class="sidebar_main">
                                <div class="sidebar-fields" style="box-shadow: rgba(0, 0, 0, 0.18) 0px -7px 7px -7px inset">
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
                        class="content_main"
                        id="main-pdf-render"
                        style="height: 887px;overflow: auto; position: relative;margin: 0 auto; text-align: center;"
                        role="region"
                    ></div>

                    <div class="ng-scope content_sidebar content_sidebar-right">
                        <div class="docsWrapper">
                            <div class="singleDocument">
                                <div id="main-pdf-render-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo form_close(); ?>
        <?php include viewPath('esign/esign-page-preview-step-4-style');?>
    <?php endif;?>

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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php echo put_footer_assets(); ?>
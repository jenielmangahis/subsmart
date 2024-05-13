<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<style>
    body {
        background-color: unset;
    }

    .form-box {
        padding: 15px;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
        border: 1px solid #d9d9d9;
        position: relative;
        width: 90%;
    }

    .leffm .form-group {
        margin: 0 0 15px;
        position: relative;
    }

    .leffm .form-group i {
        font-size: 16px;
        color: #333;
        position: absolute;
        bottom: 10px;
        right: 15px;
    }

    .fillAndSign__signatureDraw {
        max-height: 40px;
    }

    .signing__signatureInput {
        width: 100% !important;
    }

    .modal-backdrop.in {
        opacity: 0.5 !important;
    }
    .btn-success{
        border-color: #6a4a86;
    }


    .fileupload .custome-fileup .btn span {
        background-color: #6a4a86 !important;
        color: #fff !important;
        width: 150px;
        margin: auto;
    }

    .footer-action {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100vw;
        padding: 1rem;
        display: flex;
        justify-content: flex-end;
    }

    .recipientForm {
        margin-bottom: 1rem;
    }

    .form-box .clos-bx {
        position: absolute;
        font-size: 24px;
        color: #1e1e1e;
        top: 50%;
        transform: translate(0,-50%);
        opacity: 0;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-decoration: none;
        right: -40px;
        cursor: pointer;
    }
    .form-box .clos-bx:hover,
    .recipientForm:hover .clos-bx{
        opacity: 1;
    }
    .esign-file-actions{
        margin-top: 24px;
    }
    .esign-file-actions .dropdown-toggle{
        font-size: 16px;
    }
    .esignBuilder {
        margin-top: 0px !important;        
    }
    #btn-create-esign-tags, #btn-trash-bin-tags{
        margin-top: 18px;
        width: 97%;
        display: block;
        margin-left: 0px !important;    
    }
    #btn-trash-bin-tags{
        margin-top:5px !important;
        margin-bottom: 26px !important;
    }
    .tags-header{
        background-color: #6a4a86;
        padding: 10px;
        color: #ffffff;
        font-size: 12px;
        display: block;
        font-weight: bold;
    }
    .tags-header span{
        display:inline-block;
        font-size:16px;
    }
    #btn-esign-add-new-tag, #btn-edit-esign-add-new-tag {
        background-color: #ffffff !important;
        margin-bottom: 0px !important;
        padding: 2px;
        margin-left: 3px !important;
        float:right;
        font-size: 12px;
        padding-right: 8px;
    }
    .text-tag-name{
        display:inline-block;
        width:94%;
    }
    .btn-delete-row-tag-widget{
        display:inline-block;
    }
    .widget-section-name{
        background-color:#DAD1E0;
        /* color:#ffffff; */
        padding:10px;
        height:54px;
    }
    .sidebar-fields {
        padding-left: 0px !important;
    }
    .content_sidebar{
        padding:9px !important;
    }
    .widget-section-name p{    
        display: inline-block;
        position: relative;
        top: 8px;
    }
    .btn-delete-widget-section, .btn-edit-widget-section{
        display: inline-block;
        margin: 0px;
        height: 34px;
        float: right;
    }
    [class*=icon-] {
        font-family:inherit !important;
    }
    .accordion{
        padding:0px !important;
    }
    .accordion-header{
        background-color:#DAD1E0 !important;
    }
    .widget-actions{
        display:block;
        margin-bottom:10px;
        height:36px;
    }
    .menu_list{
        padding-left:15px !important;
    }
    .accordion-item button i{
        font-size: 23px;
        margin-right: 4px;
    }
    .sidebar_main{
        padding-left:10px;
    }
</style>
<div class="nsm-content-container">
    <div class="nsm-content">
        <div class="row page-content g-4">


            <?php if (isset($next_step) && $next_step == 0) {?>
            <?php echo form_open_multipart('esign/fileSave', ['id' => 'upload_file', 'class' => 'form-validate esignBuilder', 'autocomplete' => 'off', 'data-form-step' => '1']); ?>
            <input type="hidden" value="1" name="next_step" />
            <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
            <header style="margin-top: 81px;" class="d-none">
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
                                    <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-bs-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
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
                <div class="container-1">
                    <div class="nsm-callout primary" role="alert">
                        <button><i class="bx bx-x"></i></button>
                        Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.
                    </div>

                    <div class="d-flex fileupload" id="sortable">
                        <div class="custome-fileup">
                            <div class="upload-btn-wrapper">
                                <button class="btn">
                                    <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                                    <span class="nsm-button primary">Upload</span>
                                </button>
                                <input multiple type="file" name="docFile" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel" required/>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h2 class="form__title">Message to All Recipients</h2>
                        <div class="form-group mb-3">
                            <label for="subject">Subject</label>
                            <input class="form-control" id="subject" placeholder="Please eSign:" maxlength="100" require>
                            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">100</span></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter Message" maxlength="10000"></textarea>
                            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">10000</span></small>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer --->
            <footer class="footer-action">
                <button type="submit" class="nsm-button primary">
                    Next
                </button>
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
            <header style="margin-top: 81px; z-index : 1" class="d-none">
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
                                    <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-bs-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
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
                <div class="container-1">

                    <div class="add-recipeit">
                        <h1 class="esignBuilder__title">Add Recipients to the Envelope</h1>
                        <div class="nsm-callout primary" role="alert">
                            <button><i class="bx bx-x"></i></button>
                            <p>Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.</p>
                            <p>As the sender, you automatically receive a copy of the completed envelope.</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="add-note">
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 d-none">
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
                                        <div class="cust-check d-none">
                                            <input type="checkbox" id="html">
                                            <label for="html">Set signing order</label>
                                        </div>

                                        <div id="setup-recipient-list">

                                        </div>

                                        <a class="nsm-button esignBuilder__addForm" id="add-recipient-button" style="cursor: pointer; display: inline-block;">
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
                    <ul class="d-flex align-items-center" style="list-style-type: none;">
                        <li class="d-none"><a onClick='onbackclick("<?php echo url('esign/Files?id=' . $file_id . '&next_step=0') ?>")'>Back</a></li>
                        <li><button class="nsm-button primary" type="submit">Next</button></li>
                    </ul>
                </div>
            </footer>
            <!-- End Footer --->
            <?php echo form_close(); ?>
        <?php endif;?>


        <?php if (isset($next_step) && $next_step == 3): ?>
            <?php echo form_open_multipart('esign/recipients', ['id' => 'upload_file', 'class' => 'form-validate mb-0 esignBuilder esignBuilder--step3 esignBuilder--loading', 'autocomplete' => 'off', 'data-form-step' => '3', 'data-doc-url' => base_url('uploads/DocFiles/' . $file_url)]); ?>

            <input type="hidden" value="3" name="next_step" />
            <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />

            <div class="loader" style="position:fixed;left:0;top:0;height:100vh;width:100vw;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="card p-0 mb-0">
                <div class="site_content">
                    <div class="content_wrap" style="position: relative;">
                        <div class="content_sidebar content_sidebar-left resizable" style="overflow-x: hidden" id="fieldsSidebar">
                            <div class="sidebar-fields sidebar-flex">
                                <div class="sidebar_main">
                                    <div class="dropdown esignBuilder__recipientSelect <?=$is_self_signing ? "d-none" : ""?>">
                                        <button
                                            data-recipient-color="<?=$recipients[0]['color'];?>"
                                            data-recipient-id="<?=$recipients[0]['id'];?>"
                                            class="nsm-button dropdown-toggle"
                                            style="width: 97%;margin:0;"
                                            type="button"
                                            id="recipientsSelect"
                                            data-bs-toggle="dropdown"
                                        >
                                            <i class="fa fa-circle mr-1"></i>
                                            <span><?=$recipients[0]['name'];?></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="recipientsSelect" style="width: 100%;">
                                            <?php foreach ($recipients as $recipient): ?>
                                                <a
                                                    href="#"
                                                    class="nsm-link dropdown-item"
                                                    style="padding: 8px 16px;"
                                                    data-recipient-color="<?=$recipient['color'];?>"
                                                    data-recipient-id="<?=$recipient['id'];?>"
                                                >
                                                    <?=$recipient['name'];?>
                                                </a>
                                            <?php endforeach;?>
                                        </div>                                        
                                    </div>

                                    <a class="nsm nsm-button primary" id="btn-create-esign-tags" href="javascript:void(0);"><i class='bx bxs-plus-circle' style="position:relative;top:1px;"></i> Create Tags</a>
                                    <a class="nsm nsm-button primary" id="btn-trash-bin-tags" href="javascript:void(0);"><i class='bx bxs-trash' style="position:relative;top:1px;"></i> Thrash Bin</a>

                                    <div class="sidebar-fields">
                                        <div class="accordion" id="esignWidgetAccordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault1">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault1" aria-expanded="true" aria-controls="widgetCollapseDefault1">
                                                        <i class='bx bx-cog'></i> TOOLS
                                                    </button>
                                                </h2>
                                                <div id="widgetCollapseDefault1" class="accordion-collapse collapse" aria-labelledby="widgetDefault1" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Text">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-text"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Text</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Checkbox">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Checkbox</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Dropdown">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-dropdown"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Dropdown</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Radio">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-radio"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Radio</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Formula">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-formula"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Formula</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Attachment">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-attachment"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Attachment</span>
                                                                    </div>
                                                                </li>

                                                                <!-- <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Note">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-note"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Note</span>
                                                                    </div>
                                                                </li> -->

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Approve">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-approve"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Approve</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Decline">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-decline"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Decline</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault2" aria-expanded="true" aria-controls="widgetCollapseDefault2">
                                                    <i class='bx bxs-pen' ></i> ESIGN
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault2" class="accordion-collapse collapse" aria-labelledby="widgetDefault2" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Signature">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-sign"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Signature</span>
                                                                    </div>
                                                                </li>

                                                                <!-- <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Initial">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-initial"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Initial</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Stamp">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-stamp"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Stamp</span>
                                                                    </div>
                                                                </li> -->

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Date Signed">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-date signed"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Date Signed</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault3" aria-expanded="true" aria-controls="widgetCollapseDefault3">
                                                    <i class='bx bxs-user-circle'></i> PROFILE
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault3" class="accordion-collapse collapse" aria-labelledby="widgetDefault3" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Profile Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-name"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Profile Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-name"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Name Second Signatory</span>
                                                                    </div>
                                                                </li>


                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Profile Email">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-email"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Email</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Profile Company">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-company"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Company</span>
                                                                    </div>

                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Profile Title">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-title"></i></span>
                                                                        <span class="u-ellipsis ng-binding">Title</span>
                                                                    </div>
                                                                </li>

                                                                <!-- <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Esign Envelope ID">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-docusign_envelope_id"></i></span>
                                                                        <i class="esign-fa fas fa-wallet"></i>
                                                                        <span class="u-ellipsis ng-binding">Esign Envelope ID</span>
                                                                    </div>
                                                                </li> -->
                                                            </ul>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault4">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault4" aria-expanded="true" aria-controls="widgetCollapseDefault5">
                                                    <i class='bx bxs-user-pin'></i> CUSTOMER
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault4" class="accordion-collapse collapse" aria-labelledby="widgetDefault4" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-subscriber_name"></i></span>
                                                                        <i class="esign-fa fas fa-spell-check"></i>
                                                                        <span class="u-ellipsis ng-binding">Name</span>
                                                                    </div>
                                                                </li>
                                                                
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Address">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-address"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Address</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer City">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-city"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">City</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer County">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-state"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">County</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer State">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-state"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">State</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Zip">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-zip"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">ZIP</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Email">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-subscriber_email"></i></span>
                                                                        <i class="esign-fa far fa-paper-plane"></i>
                                                                        <span class="u-ellipsis ng-binding">Email</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Date of Birth">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-secondary_contact"></i></span>
                                                                        <i class="esign-fa fas fa-mobile-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Date of Birth</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Social Security Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-secondary_contact"></i></span>
                                                                        <i class="esign-fa fas fa-mobile-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Social Security Number</span>
                                                                    </div>
                                                                </li>                                                                                      

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Access Password">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-access_password"></i></span>
                                                                        <i class="esign-fa fas fa-key"></i>
                                                                        <span class="u-ellipsis ng-binding">Access Password</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem" data-type="default-widget" data-key="Customer Abort Code">
                                                                    <div class="fields menu_item">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-abort_code"></i></span>
                                                                        <i class="esign-fa fas fa-key"></i>
                                                                        <span class="u-ellipsis ng-binding">Abort Code</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Equipment">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-equipment"></i></span>
                                                                        <i class="esign-fa fas fa-key"></i>
                                                                        <span class="u-ellipsis ng-binding">Equipment</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Panel Type">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-panel_type"></i></span>
                                                                        <i class="esign-fa fas fa-map-marker-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Panel Type</span>
                                                                    </div>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault5">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault5" aria-expanded="true" aria-controls="widgetCollapseDefault5">
                                                    <i class='bx bx-phone'></i> CUSTOMER EMERGENCY CONTACTS
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault5" class="accordion-collapse collapse" aria-labelledby="widgetDefault5" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Primary Contact Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Primary Contact Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Primary Contact Firstname">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Primary Contact First Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Primary Contact Lastname">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Primary Contact Last Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Primary Contact Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_number"></i></span>
                                                                        <i class="esign-fa fas fa-mobile-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Primary Contact Number</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Secondary Contact Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Secondary Contact Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Secondary Contact Firstname">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Secondary Contact First Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Secondary Contact Lastname">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_name"></i></span>
                                                                        <i class="esign-fa fas fa-user"></i>
                                                                        <span class="u-ellipsis ng-binding">Secondary Contact Last Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Customer Secondary Contact Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact_number"></i></span>
                                                                        <i class="esign-fa fas fa-mobile-alt"></i>
                                                                        <span class="u-ellipsis ng-binding">Secondary Contact Number</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault6">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault6" aria-expanded="true" aria-controls="widgetCollapseDefault6">
                                                    <i class='bx bxs-user-account'></i> ACCOUNT DETAILS
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault6" class="accordion-collapse collapse" aria-labelledby="widgetDefault6" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Checking Account Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-check_num"></i></span>
                                                                        <i class="esign-fa fas fa-money-check"></i>
                                                                        <span class="u-ellipsis ng-binding">Checking Account Number</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Account Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-acct_num"></i></span>
                                                                        <i class="esign-fa fas fa-money-check"></i>
                                                                        <span class="u-ellipsis ng-binding">Account Number</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="CS Account Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-cs_account_number"></i></span>
                                                                        <i class="esign-fa fas fa-wallet"></i>
                                                                        <span class="u-ellipsis ng-binding">CS Account Number</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="ABA">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-aba"></i></span>
                                                                        <i class="esign-fa fas fa-wallet"></i>
                                                                        <span class="u-ellipsis ng-binding">ABA</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Card Number">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_acct_num"></i></span>
                                                                        <i class="esign-fa fas fa-credit-card"></i>
                                                                        <span class="u-ellipsis ng-binding">Card Number</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Card Holder Name">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_name"></i></span>
                                                                        <i class="esign-fa far fa-id-card"></i>
                                                                        <span class="u-ellipsis ng-binding">Card Holder Name</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Card Expiration">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_exp"></i></span>
                                                                        <i class="esign-fa fas fa-calendar-times"></i>
                                                                        <span class="u-ellipsis ng-binding">Card Expiration</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Card Security Code">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_security_code"></i></span>
                                                                        <i class="esign-fa fas fa-fingerprint"></i>
                                                                        <span class="u-ellipsis ng-binding">Card Security Code</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="widgetDefault7">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault7" aria-expanded="true" aria-controls="widgetCollapseDefault7">
                                                    <i class='bx bx-list-ul'></i> INVOICE
                                                </button>
                                                </h2>
                                                <div id="widgetCollapseDefault7" class="accordion-collapse collapse" aria-labelledby="widgetDefault7" data-bs-parent="#esignWidgetAccordion">
                                                    <div class="accordion-body">
                                                        <div class="menu-fields">
                                                            <ul class="menu_list">
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Invoice Equipment Cost">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-equipment_cost"></i></span>
                                                                        <i class="esign-fa fas fa-dollar-sign"></i>
                                                                        <span class="u-ellipsis ng-binding">Equipment Cost</span>
                                                                    </div>
                                                                </li>
                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Invoice Monthly Monitoring Rate">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-equipment_cost"></i></span>
                                                                        <i class="esign-fa fas fa-dollar-sign"></i>
                                                                        <span class="u-ellipsis ng-binding">Monthly Monitoring Rate</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Invoice One Time Activation">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-one_time_activation"></i></span>
                                                                        <i class="esign-fa fas fa-business-time"></i>
                                                                        <span class="u-ellipsis ng-binding">One Time Activation (OTP)</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Invoice Installation Cost">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-installation_cost"></i></span>
                                                                        <i class="esign-fa fas fa-dollar-sign"></i>
                                                                        <span class="u-ellipsis ng-binding">Installation Cost</span>
                                                                    </div>
                                                                </li>

                                                                <li class="menu_listItem">
                                                                    <div class="fields menu_item" data-type="default-widget" data-key="Invoice Total Due">
                                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-total_due"></i></span>
                                                                        <i class="esign-fa fas fa-dollar-sign"></i>
                                                                        <span class="u-ellipsis ng-binding">Total Due</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if( logged('company_id') == 31 || logged('company_id') == 24 || logged('company_id') == 1 ){ ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="widgetDefault8">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault8" aria-expanded="true" aria-controls="widgetCollapseDefault8">
                                                        <i class='bx bx-grid-alt'></i> PANEL TYPE
                                                    </button>
                                                    </h2>
                                                    <div id="widgetCollapseDefault8" class="accordion-collapse collapse" aria-labelledby="widgetDefault8" data-bs-parent="#esignWidgetAccordion">
                                                        <div class="accordion-body">
                                                            <div class="menu-fields">
                                                                <ul class="menu_list">
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel 2 GIG Go Panel 2">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">2 GIG Go Panel 2</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel 2 GIG Go Panel 3">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">2 GIG Go Panel 3</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel Lynx3000">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">Lynx3000</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel LynxTouch">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">LynxTouch</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel Vista/SEM">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">Vista/SEM</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel DSC">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">DSC</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Panel Other">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                                            <span class="u-ellipsis ng-binding">Other</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php if( logged('company_id') == 58 || logged('company_id') == 1 ){ ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="widgetDefault9">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapseDefault9" aria-expanded="true" aria-controls="widgetCollapseDefault5">
                                                        <i class='bx bx-grid-alt'></i> SOLAR INFO
                                                    </button>
                                                    </h2>
                                                    <div id="widgetCollapseDefault9" class="accordion-collapse collapse" aria-labelledby="widgetDefault9" data-bs-parent="#esignWidgetAccordion">
                                                        <div class="accordion-body">
                                                            <div class="menu-fields">
                                                                <ul class="menu_list">
                                                                    <li class="menu_listItem">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Solar KW DC">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-kw_dc"></i></span>
                                                                            <i class="esign-fa fa fa-lightbulb"></i>
                                                                            <span class="u-ellipsis ng-binding">kW DC</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="menu_listItem">
                                                                        <div class="fields menu_item" data-type="default-widget" data-key="Solar System Size">
                                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-system_size"></i></span>
                                                                            <i class="esign-fa fa fa-lightbulb"></i>
                                                                            <span class="u-ellipsis ng-binding">System Size</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php foreach( $tagWidgets as $key => $widget ){ ?>
                                                <div class="accordion-item">                                                    
                                                    <h2 class="accordion-header" id="widget<?= $key; ?>">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widgetCollapse<?= $key; ?>" aria-expanded="true" aria-controls="widgetCollapse<?= $key; ?>">
                                                            <i class='bx bxs-widget'></i> <?= $widget['section']; ?>
                                                        </button>           
                                                    </h2>
                                                    <div id="widgetCollapse<?= $key; ?>" class="accordion-collapse collapse" aria-labelledby="widget<?= $key; ?>" data-bs-parent="#esignWidgetAccordion">
                                                        <div class="accordion-body">
                                                            <div class="widget-actions">
                                                                <a class="btn-delete-widget-section nsm-button primary help-popover-delete-section" data-name="<?= $widget['section']; ?>" data-id="<?= $key; ?>" href="javascript:void:void(0);">
                                                                    <i class="bx bx-trash help-widget-row-remove"></i>
                                                                </a>
                                                                <a class="btn-edit-widget-section nsm-button primary help-popover-edit-section" data-id="<?= $key; ?>" href="javascript:void:void(0);">
                                                                    <i class='bx bxs-edit'></i>
                                                                </a>
                                                            </div>
                                                            <div class="menu-fields">
                                                                <ul class="menu_list">
                                                                    <?php foreach( $widget['tags'] as $tag ){ ?>
                                                                        <li class="menu_listItem">
                                                                            <div class="fields menu_item" data-type="dynamic-widget" data-key="<?= $tag->auto_populate_field; ?>">
                                                                                <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger bx bxs-widget"></i></span>
                                                                                <span class="u-ellipsis ng-binding"><?=  $tag->tag_name; ?></span>
                                                                            </div>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="main-pdf-render__container" role="region">
                            <div id="main-pdf-render" style="display:flex; flex-direction:column; align-items:center;"  ></div>
                        </div>

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
                <button type="button" class="btn btn-secondary mr-3 d-none">Back</button>
                <button type="button" class="nsm-button primary esignBuilder__submit" id="submitBUtton">
                    <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Send
                </button>
            </div>


            <div class="esignBuilder__optionsSidebar">
                <div class="esignBulder-sidebar-header">                    
                    <p class="esignBuilder__optionsSidebarFieldId">                        
                        <i class='bx bx-edit'></i> Edit <span></span>
                        <button type="button" class="esignBulder-sidebar-close" id="closeOption"><i class="bx bx-fw bx-x m-0"></i></button>
                    </p>
                </div>               

                <div class="options mt-3">
                    <div class="row mb-4">
                        <div class="mt-2 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="optionsRequired" value="" id="optionsRequired">
                                <label class="form-check-label" for="optionsRequired">
                                    Required Field
                                </label>
                            </div>
                            <hr/>
                            <div class="col-md-12 mt-2">
                                <label for="optionsFieldName" class="form-label">Field name</label>
                                <input type="text" name="optionsFieldName" id="optionsFieldName" class="form-control">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="optionsFieldValue" class="form-label">Value when selected</label>
                                <input type="text" name="optionsFieldValue" id="optionsFieldValue" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown mt-3">
                    <div class="row mb-4">
                        <div class="mt-2 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requiredDropdown" value="" id="requiredDropdown">
                                <label class="form-check-label" for="requiredDropdown">
                                    Required Field
                                </label>
                            </div>
                            <hr/>
                            <div class="col-md-12 mt-2">
                                <label for="dropdownName" class="form-label">Field name</label>
                                <input type="text" name="dropdownName" id="dropdownName" class="form-control">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="" class="form-label">Options</label>
                                <div class="options__values"></div>
                            </div>
                            <!-- <div>
                                <label>Default Value</label>
                                <select class="custom-select" id="dropdownDefaultValue">
                                    <option selected>Select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> -->
                            <div class="col-md-12 p-0 mt-2">
                                <button class="nsm-button default" id="addDropdownOption">Add Option</button>
                            </div>
                        </div>                        
                    </div>
                </div>

                <div class="text">
                    <div class="row mb-4">
                        <div class="mt-2 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requiredText" value="" id="requiredText">
                                <label class="form-check-label" for="requiredText">
                                    Required Field
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="readOnlyText" value="" id="readOnlyText">
                                <label class="form-check-label" for="readOnlyText">
                                    Required Field
                                </label>
                            </div>
                            <hr />
                            <div class="sidebar-autopopulate-with">
                                <label for="autoPopulateWith">Auto-populate with</label>
                                <select class="form-select form-control" name="autoPopulateWith" id="autoPopulateWith">
                                    <option value="" selected>None</option>
                                    <?php foreach ($recipients as $recipient): ?>
                                        <option value="<?=$recipient['color'];?>">
                                            <?=$recipient['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <small class="form-text text-muted mt-2" style="line-height: 1.3; display: block;">If the data is associated with this role exists, the input field will be automatically filled in.</small>
                                <hr>
                                <small class="form-text text-muted">
                                    <b>Lists of reusable client Field name</b> <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Select Client from the Auto-populate with"><i class="far fa-question-circle"></i></a> <br>
                                    subscriber_fname, subscriber_lname, phone_h, phone_m, address, city, state, zip_code, password, customer_email, country, card_number, equipment_cost, checking_account_n, aba, card_name, card_account_number, card_expiration, card_security_code
                                </small>
                            </div>
                            <hr />

                            <div class="col-md-12 mt-2">
                                <label for="textFieldName" class="form-label">Field name</label>
                                <input type="text" name="textFieldName" id="textFieldName" class="form-control">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="textFieldPlaceholder" class="form-label">Placeholder</label>
                                <input type="text" id="textFieldPlaceholder" class="form-control">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="textFieldValue" class="form-label">Default Text</label>                            
                                <textarea  class="form-control" id="textFieldValue" style="height:50px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dynamic-widget">
                    <div class="row mb-4">
                        <div class="mt-2 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requiredText" value="" id="widgetRequiredText">
                                <label class="form-check-label" for="widgetRequiredText">
                                    Required Field
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="readOnlyText" value="" id="widgetReadOnlyText">
                                <label class="form-check-label" for="widgetReadOnlyText">
                                    Read Only
                                </label>
                            </div>
                            <hr/>
                            <div class="col-md-12 mt-2">
                                <label for="widgetTextFieldName" class="form-label">Field name</label>
                                <input type="text" name="textFieldName" id="widgetTextFieldName" class="form-control" readonly="" disabled="">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="widgetTextFieldPlaceholder" class="form-label">Placeholder</label>
                                <input type="text" id="widgetTextFieldPlaceholder" class="form-control">
                            </div>
                            <div class="col-md-12 p-0 mt-2">
                                <label for="widgetTextFieldValue" class="form-label">Default Text</label>                            
                                <textarea  class="form-control" id="widgetTextFieldValue" style="height:50px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formula">
                    <div class="mb-4">
                        <p class="mt-2 mb-2">
                            Build a formula from number and date fields in your envelope.
                            Field names must be enclosed in square brackets ("[]").
                        </p>

                        <textarea style="width: 100%; height:100px;" id="formulaInput" class="form-control"></textarea>
                        <small class="form-text text-muted">Example: [16160]-[23502]</small>
                    </div>
                </div>

                <div class="note">
                    <p class="mt-2 mb-2">Add Text</p>
                    <textarea style="width: 100%;" id="noteInput"></textarea>
                </div>

                <div class="footer mt-4">
                    <button type="button" class="nsm-button primary btn-block" id="saveOption">
                        <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save
                    </button>

                    <button type="button" class="nsm-button primary btn-block" id="deleteOption">
                        <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Delete
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
            <?php include viewPath('esign/esign-page-preview-step-4-style');?>
            <div class="modal fade" id="selfSigningSend" tabindex="-1" role="dialog" aria-labelledby="selfSigningSendLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selfSigningSendLabel">Sign and Return</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div>
                                <div class="form-group">
                                    <label for="selfSigningSend__name">Full Name</label>
                                    <input class="form-control" id="selfSigningSend__name">
                                    <div class="invalid-feedback">Invalid recipient name</div>
                                </div>

                                <div class="form-group">
                                    <label for="selfSigningSend__email">Email</label>
                                    <input class="form-control" id="selfSigningSend__email">
                                    <div class="invalid-feedback">Invalid recipient email</div>
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <label for="selfSigningSend__subject">Subject</label>
                                    <input class="form-control" id="selfSigningSend__subject" maxlength="100">
                                </div>

                                <div class="form-group">
                                    <label for="selfSigningSend__message">Message</label>
                                    <textarea class="form-control" id="selfSigningSend__message" rows="3" maxlength="10000"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">No Thanks</button>
                        <button type="button" class="btn btn-primary d-flex align-items-center">
                            <div class="spinner-border spinner-border-sm mt-0 d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Send And Close
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <div class="modal fade nsm-modal fade" id="modal-create-tags" tabindex="-1" aria-labelledby="modal-create-tags_label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="frm-add-esign-tags">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="quick_add_job_type_modal_label"><i class="bx bxs-plus-circle"></i> Create Tags</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-3 mb-3">
                                    <label for="exampleInputEmail1">Section Name <span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-section"></span></label>
                                    <input type="text" name="tag_section_name" class="form-control" id="" required="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4 mb-4">
                                <div class="tags-header">
                                    <span><i class='bx bx-cog' ></i> Tags</span>
                                    <a class="nsm-button small ms-0 mb-4" id="btn-esign-add-new-tag"><i class='bx bxs-plus-circle' style="position:relative;top:1px;"></i> Add New Tag</a>
                                </div>
                            </div>
                            <div class="col-12" id="tags-container">
                                <div class="tag-group-1 tag-rows">
                                    <div class="form-group mt-3" style="margin-bottom:8px;">
                                        <label>Tag Name</label>
                                        <input type="text" name="tagNames[]" class="form-control" id="" required="" placeholder="">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" style="margin-top:0px;">
                                            <label>Autopopulate Data</label>
                                            <select name="tagAutoPopulate[]" class="form-control default-dropdown sel-autopopulate-data">
                                                <?php foreach($optionAutoPopulateData as $key => $value){ ?>
                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" style="margin-top:0px;">
                                            <label>Fields</label>
                                            <select name="tagFields[]" class="form-control default-dropdown sel-autopopulate-fields">
                                                <?php foreach($optionCustomerFields as $key => $value){ ?>
                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display:block;">                    
                        <div style="float:right;">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>                            
                            <button type="submit" class="nsm-button primary" id="btn-job-submit">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-edit-tags" tabindex="-1" aria-labelledby="modal-create-tags_label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="frm-update-esign-tags">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="quick_add_job_type_modal_label"><i class="bx bxs-edit"></i> Edit Tags</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body" id="modal-edit-tags-container"></div>
                    <div class="modal-footer" style="display:block;">                    
                        <div style="float:right;">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>                            
                            <button type="submit" class="nsm-button primary" id="btn-job-submit">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-trash-tags" tabindex="-1" aria-labelledby="modal-create-tags_label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="quick_add_job_type_modal_label"><i class='bx bx-trash'></i> Trash Bin</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body" id="modal-trash-bin-container"></div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer');?>
<!-- <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<?php if (isset($next_step) && $next_step == 0): ?>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
<?php endif;?>
<?php if (isset($next_step) && $next_step == 3): ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php endif; ?>
<script>
$(function(){
    var optionCustomerFields = <?= json_encode($optionCustomerFields); ?>;
    var optionCompanyFields  = <?= json_encode($optionCompanyFields); ?>;
    var optionInvoiceFields  = <?= json_encode($optionInvoiceFields); ?>;    
    var optionJobFields      = <?= json_encode($optionJobFields); ?>;
    var is_with_action = 0;

    $('#modal-create-tags').modal({backdrop: 'static', keyboard: false});
    $('#modal-create-tags').modal({backdrop: 'static', keyboard: false});
    $('#modal-edit-tags').modal({backdrop: 'static', keyboard: false});

    $(window).bind('beforeunload', function(){
      if( is_with_action == 0 ){
        return 'Are you sure you want to leave?';
      }      
    });

    $(document).on('click', '.esignBuilder__submit', function(){
        is_with_action = 1;
    });

    $(document).on('click', '.dropdown-menu li a', function(){            
      $(this).parent().parent().parent().find(".btn:first-child").val($(this).text());
      $(this).parent().parent().parent().find(".btn:first-child").html($(this).html());   
    });

    $('#btn-create-esign-tags').on('click', function(){
        $('#modal-create-tags').modal('show');
    });

    $('#help-popover-section').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Tag section / group name';
        } 
    });

    $('.help-popover-delete-section').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Delete Section';
        } 
    });

    $('.help-popover-edit-section').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Edit Section';
        } 
    });
    
    $('.default-dropdown').select2({
        dropdownParent: $("#modal-create-tags")
    });

    $(document).on('change', '.sel-autopopulate-data', function(){
        var selected = $(this).val();
        var $el = $(this).closest('.form-row').find(".sel-autopopulate-fields");
        if( selected == 'Customer' ){
            $el.empty(); 
            $.each(optionCustomerFields, function(key,value) {
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Invoice' ){
            $el.empty(); 
            $.each(optionInvoiceFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Company' ){
            $el.empty(); 
            $.each(optionCompanyFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Job' ){
            $el.empty(); 
            $.each(optionJobFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }
    });

    $(document).on('click', '#btn-esign-add-new-tag', function(){
        var rows = $('.tag-rows').length + 1;
        var component = `
        <div class="tag-group-${rows} tag-rows">
            <div class="form-group mt-3" style="margin-bottom:8px;">
                <label>Tag Name</label><br />
                <input type="text" name="tagNames[]" class="form-control text-tag-name" id="" required="" placeholder="">
                <a class="btn-delete-row-tag-widget nsm-button" data-id="${rows}" href="javascript:void:void(0);"><i class='bx bx-trash help-widget-row-remove'></i></a>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" style="margin-top:0px;">
                    <label>Autopopulate Data</label>
                    <select name="tagAutoPopulate[]" class="form-control default-dropdown sel-autopopulate-data">
                        <?php foreach($optionAutoPopulateData as $key => $value){ ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" style="margin-top:0px;">
                    <label>Fields</label>
                    <select name="tagFields[]" class="form-control default-dropdown sel-autopopulate-fields">
                        <?php foreach($optionCustomerFields as $key => $value){ ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>`;
        $('#tags-container').append(component);
        $('.default-dropdown').select2({
            dropdownParent: $("#modal-create-tags")
        });

        $('.help-widget-row-remove').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Delete Widget';
            } 
        });
    });

    $(document).on('click', '.btn-edit-widget-section', function(){
        var sectionid = $(this).attr('data-id');
        $('#modal-edit-tags').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "esign_v2/_edit_widget",
            data: {sectionid:sectionid},
            success: function(html) {
                $('#modal-edit-tags-container').html(html);
                
            }, beforeSend: function() {
                $('#modal-edit-tags-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });

        $("[data-toggle='popover']").popover('hide');
    });

    $(document).on('click', '.btn-delete-row-tag-widget', function(){        
        var row = $(this).attr('data-id');
        $('.tag-group-'+row).fadeOut("slow", function() {
            $(this).remove();
        });
        $("[data-toggle='popover']").popover('hide');
    });

    $(document).on('submit', '#frm-add-esign-tags', function(e){
        e.preventDefault();

        var formData = new FormData(this);
        var _this    = $(this);
        _this.find("button[type=submit]").html("Saving");

        $.ajax({
            type: "POST",
            url: base_url + "esign_v2/_create_tags",
            data: formData,
            dataType:'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $("#modal-create-tags").modal('hide');
                    Swal.fire({
                        //title: 'Save Successful!',
                        text: "eSign Tag was successfully created.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                          location.reload();  
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                _this.find("button[type=submit]").html("Save");
                //_this.find("button[type=submit]").prop("disabled", false);
                
            }, beforeSend: function() {
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('submit', '#frm-update-esign-tags', function(e){
        e.preventDefault();

        var formData = new FormData(this);
        var _this    = $(this);
        _this.find("button[type=submit]").html("Saving");

        $.ajax({
            type: "POST",
            url: base_url + "esign_v2/_update_widget",
            data: formData,
            dataType:'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $("#modal-edit-tags").modal('hide');
                    Swal.fire({
                        //title: 'Save Successful!',
                        text: "eSign Tag was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                          location.reload();  
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                _this.find("button[type=submit]").html("Save");
                //_this.find("button[type=submit]").prop("disabled", false);
                
            }, beforeSend: function() {
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('.btn-delete-widget-section').on('click', function(){
        var sid = $(this).attr('data-id');
        var section_name = $(this).attr('data-name');
        $("[data-toggle='popover']").popover('hide');

        Swal.fire({   
            //title: "Delete",
            html: "Do you want to delete <b>"+ section_name +"</b> widget?",
            icon: "question",
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {                
                $.ajax({
                    type: 'POST',
                    url: base_url + 'esign_v2/_delete_widget',
                    data:{sid:sid},
                    dataType: 'json',
                    success: function(response) {   
                        if( response.is_success == 1 ){
                            Swal.fire({
                                title: "Success!",
                                text: "Widdget was successfully deleted",
                                icon: "success",
                                confirmButtonText: 'Ok',
                                footer: '<a href="javascript:void(0);" data-id="'+sid+'" class="btn-undo-delete">Undo Delete</a>'
                            }).then((result) => {
                                location.reload();
                            }); 
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        }
                    },
                });                  
            } 
        });
    });

    $('#btn-trash-bin-tags').on('click', function(){
        $('#modal-trash-tags').modal('show');
        $.ajax({
            type: 'POST',
            url: base_url + 'esign_v2/_trash_widgets',
            success: function(html) {   
                $('#modal-trash-bin-container').html(html);
            },
        });  
    });

  //load_tag_sections();

  $(document).on('click', '.btn-undo-delete', function(){
    var sid = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: base_url + 'esign_v2/_undo_delete_widget',
        data:{sid:sid},
        dataType: 'json',
        success: function(response) {   
            if( response.is_success == 1 ){
                Swal.fire({
                    title: "Success!",
                    text: "Widdget was successfully restored",
                    icon: "success",
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload();
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                });
            }
        },
    });
  });

  function load_tag_sections(){
    $.ajax({
        url: base_url + 'esign_v2/_tags_sections',
        type: 'GET',
        success: function(html) {      
            $('.tags-container').html(html);
        }
    });
  }
});
</script>

<?php // echo put_footer_assets(); ?>
<style>
    .esignBuilder__field,
    .ui-draggable-dragging {
        width: initial;
    }

    .ui-draggable-dragging {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px !important;
    }

    .ui-draggable-dragging .swatch {
        margin-right: 8px !important;
        background-color: #ffd65b !important;
        display: none !important;
    }

    .menu_item:hover {
        background: unset;
    }

    .content_wrap {
        padding-top: 1rem !important;
    }

    .esignBuilder__optionsSidebar{
        background-color:#ffffff;
        box-shadow: rgba(0, 0, 0, 0.07) -5px 5px, rgba(0, 0, 0, 0.07) -10px 10px, rgba(0, 0, 0, 0.07) -15px 15px, rgba(0, 0, 0, 0.07) -20px 20px, rgba(0, 0, 0, 0.07) -25px 25px;
    }

    .content_sidebar.content_sidebar-left {
        position: absolute !important;
        padding-top: 0 !important;
        width: 800px !important;
    }
    [id^=pdf-render] {
        border: 1px solid #d8d8d8;
    }
    .nsm-nav .nsm-page-title h4 {
        font-weight: 700 !important;
        margin: unset !important;
        line-height: 0.8 !important;
        font-size: 1.5rem !important;
        /* font-family: inherit !important; */
        text-transform: none !important;
    }
    .btn-success {
        border-color: #198754 !important;
    }
    #fieldsSidebar {
        position: sticky !important;
        top: 0;
    }
    .esignBulder-sidebar-header{
        background-color: #6a4a86;
        color: #ffffff;
        padding: 10px;
        position: relative;
        left: -12px;
        width: 108%;
        font-size:17px;
    }
    .esignBulder-sidebar-close{
        background: none;
        border: none;
        outline: none !important;
        font-size: 1em;
        color: #ffffff;
        float:right;
    }
    #saveOption, #deleteOption{
        width:45%;
    }
</style>

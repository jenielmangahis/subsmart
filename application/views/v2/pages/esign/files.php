<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<style>
    body {
        background-color: unset;
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
</style>

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
        <div class="container">
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
        <div class="container">

            <div class="add-recipeit">
                <h1 class="esignBuilder__title">Add Recipients to the Envelope</h1>
                <div class="nsm-callout primary" role="alert">
                    <button><i class="bx bx-x"></i></button>
                    Sign and send documents for signing from your automated workflows on any device. Quickly configure templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms.
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="add-note">
                            <p>As the sender, you automatically receive a copy of the completed envelope.</p>
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

                                <a class="nsm-button" id="add-recipient-button" style="cursor: pointer; display: inline-block;">
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
            <ul class="d-flex align-items-center justify-content-end" style="list-style-type: none;">
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
                                    style="width: 100%;margin:0;"
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

                            <div class="sidebar-fields">
                                <div class="sidebar_group l-flex-between">
                                    <h5>
                                        <span tabindex="-1" class="ng-binding">Fields</span>
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

                                            <!-- <li class="menu_listItem">
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
                                            </li> -->

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-date signed"></i></span>
                                                    <span class="u-ellipsis ng-binding">Date Signed</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <p class="fw-bold"><small>Profile</small></p>
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
                                            <!-- <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_security_code"></i></span>
                                                    <i class="esign-fa fas fa-fingerprint"></i>
                                                    <span class="u-ellipsis ng-binding">Card Security Code</span>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-bold"><small>Customer / Subscriber</small></p>
                                </div>
                                <div class="sidebar_item">
                                    <div class="menu-fields">
                                        <ul class="menu_list">

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-subscriber_name"></i></span>
                                                    <i class="esign-fa fas fa-spell-check"></i>
                                                    <span class="u-ellipsis ng-binding">Subscriber Name</span>
                                                </div>
                                            </li>
                                            
                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-address"></i></span>
                                                    <i class="esign-fa fas fa-map-marker-alt"></i>
                                                    <span class="u-ellipsis ng-binding">Address</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-city"></i></span>
                                                    <i class="esign-fa fas fa-building"></i>
                                                    <span class="u-ellipsis ng-binding">City</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-state"></i></span>
                                                    <i class="esign-fa far fa-flag"></i>
                                                    <span class="u-ellipsis ng-binding">State</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-zip"></i></span>
                                                    <i class="esign-fa far fa-address-card"></i>
                                                    <span class="u-ellipsis ng-binding">ZIP</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-subscriber_email"></i></span>
                                                    <i class="esign-fa far fa-paper-plane"></i>
                                                    <span class="u-ellipsis ng-binding">Subscriber Email</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-primary_contact"></i></span>
                                                    <i class="esign-fa fas fa-phone-square-alt"></i>
                                                    <span class="u-ellipsis ng-binding">Primary Contact</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-emergency_contact"></i></span>
                                                    <i class="esign-fa fas fa-address-book"></i>
                                                    <span class="u-ellipsis ng-binding">Emergency Contact</span>
                                                </div>
                                            </li>

                                            <!-- <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-secondary_contact"></i></span>
                                                    <i class="esign-fa fas fa-mobile-alt"></i>
                                                    <span class="u-ellipsis ng-binding">Secondary Contact</span>
                                                </div>
                                            </li>  -->                                           

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-access_password"></i></span>
                                                    <i class="esign-fa fas fa-key"></i>
                                                    <span class="u-ellipsis ng-binding">Access Password</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <p class="fw-bold"><small>Account Details</small></p>
                                </div>
                                <div class="sidebar_item">
                                    <div class="menu-fields">
                                        <ul class="menu_list">
                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-check_num"></i></span>
                                                    <i class="esign-fa fas fa-money-check"></i>
                                                    <span class="u-ellipsis ng-binding">Checking Account Number</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-acct_num"></i></span>
                                                    <i class="esign-fa fas fa-money-check"></i>
                                                    <span class="u-ellipsis ng-binding">Account Number</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-aba"></i></span>
                                                    <i class="esign-fa fas fa-wallet"></i>
                                                    <span class="u-ellipsis ng-binding">ABA</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_acct_num"></i></span>
                                                    <i class="esign-fa fas fa-credit-card"></i>
                                                    <span class="u-ellipsis ng-binding">Card Number</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_name"></i></span>
                                                    <i class="esign-fa far fa-id-card"></i>
                                                    <span class="u-ellipsis ng-binding">Card Holder Name</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_exp"></i></span>
                                                    <i class="esign-fa fas fa-calendar-times"></i>
                                                    <span class="u-ellipsis ng-binding">Card Expiration</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-card_security_code"></i></span>
                                                    <i class="esign-fa fas fa-fingerprint"></i>
                                                    <span class="u-ellipsis ng-binding">Card Security Code</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- <div>
                                    <p class="fw-bold"><small>Billing</small></p>
                                </div>
                                <div class="sidebar_item">
                                    <div class="menu-fields">
                                        <ul class="menu_list">
                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-equipment_cost"></i></span>
                                                    <i class="esign-fa fas fa-dollar-sign"></i>
                                                    <span class="u-ellipsis ng-binding">Equipment Cost</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-first_month_monitoring"></i></span>
                                                    <i class="esign-fa fas fa-calendar-alt"></i>
                                                    <span class="u-ellipsis ng-binding">First Month Mon</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-one_time_activation"></i></span>
                                                    <i class="esign-fa fas fa-business-time"></i>
                                                    <span class="u-ellipsis ng-binding">One Time Act</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-total_due"></i></span>
                                                    <i class="esign-fa fas fa-dollar-sign"></i>
                                                    <span class="u-ellipsis ng-binding">Total Due</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> -->
                                

                                <div class="sidebar_item">
                                    <div class="menu-fields">
                                        <ul class="menu_list">
                                            <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-text"></i></span>
                                                    <span class="u-ellipsis ng-binding">Text</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                    <span class="u-ellipsis ng-binding">Checkbox</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-dropdown"></i></span>
                                                    <span class="u-ellipsis ng-binding">Dropdown</span>
                                                </div>
                                            </li>

                                            <li class="menu_listItem <?=$is_self_signing ? "d-none" : ""?>">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-radio"></i></span>
                                                    <span class="u-ellipsis ng-binding">Radio</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="sidebar_item <?=$is_self_signing ? "d-none" : ""?>">
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

                                            <!-- <li class="menu_listItem">
                                                <div class="fields menu_item">
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0"><i class="icon icon-color-tagger icon-palette-field-note"></i></span>
                                                    <span class="u-ellipsis ng-binding">Note</span>
                                                </div>
                                            </li> -->

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
        <p class="esignBuilder__optionsSidebarFieldId">
            Field ID: <span></span>
        </p>

        <div class="options mt-3">
            <div class="mt-2 mb-2">
                <div>
                    <input type="checkbox" name="optionsRequired" id="optionsRequired">
                    <label for="optionsRequired">Required Field</label>
                </div>

                <hr/>

                <div>
                    <label for="optionsFieldName">Field name</label>
                    <input type="text" name="optionsFieldName" id="optionsFieldName" class="w-100">
                </div>

                <div class="options__values">
                    <label>Values</label>
                    <div class="options__valuesItem d-flex align-items-center">
                        <input class="mt-0 mr-2" type="checkbox">
                        <input style="flex-grow: 1;" type="text">
                    </div>
                    <div class="options__valuesSubItems"></div>
                </div>
            </div>
        </div>

        <div class="dropdown mt-3">
            <div class="mt-2 mb-2">
                <div>
                    <input type="checkbox" name="requiredDropdown" id="requiredDropdown">
                    <label for="requiredDropdown">Required Field</label>
                </div>

                <hr/>

                <div>
                    <label for="dropdownName">Field name</label>
                    <input type="text" name="dropdownName" id="dropdownName" class="w-100">
                </div>

                <div>
                    <label>Options</label>
                    <div class="options__values"></div>
                </div>

                <div>
                    <button class="btn btn-block btn-primary mt-2" id="addDropdownOption">+ Add Option</button>
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
            </div>
        </div>

        <div class="text">
            <div class="mt-2 mb-2">
                <div>
                    <input type="checkbox" name="requiredText" id="requiredText">
                    <label for="requiredText">Required Field</label>
                </div>
                <div class="mb-2">
                    <input type="checkbox" name="readOnlyText" id="readOnlyText">
                    <label for="readOnlyText">Read Only</label>
                </div>

                <div>
                    <label for="autoPopulateWith">Auto-populate with</label>
                    <select class="form-select" name="autoPopulateWith" id="autoPopulateWith">
                        <option value="" selected>None</option>
                        <?php foreach ($recipients as $recipient): ?>
                            <option value="<?=$recipient['color'];?>">
                                <?=$recipient['name'];?>
                            </option>
                        <?php endforeach;?>
                    </select>
                    <small class="form-text text-muted" style="line-height: 1.3; display: block;">If the data is associated with this role exists, the input field will be automatically filled in.</small>
                    <hr>
                    <small class="form-text text-muted">
                        <b>Lists of reusable client Field name</b> <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Select Client from the Auto-populate with"><i class="far fa-question-circle"></i></a> <br>
                        subscriber_fname, subscriber_lname, phone_h, phone_m, address, city, state, zip_code, password, customer_email, country, card_number, equipment_cost, checking_account_n, aba, card_name, card_account_number, card_expiration, card_security_code
                    </small>
                </div>

                <hr/>

                <div>
                    <label for="textFieldName"><span>Field name</span></label>
                    <input type="text" name="textFieldName" id="textFieldName" class="w-100">
                </div>

                <div>
                    <label for="textFieldPlaceholder">Add Placeholder</label>
                    <input type="text"  class="w-100" id="textFieldPlaceholder" />
                </div>

                <div>
                    <label for="textFieldValue">Add Text</label>
                    <textarea  class="w-100" id="textFieldValue"></textarea>
                </div>
            </div>
        </div>

        <div class="formula">
            <p class="mt-2 mb-2">
                Build a formula from number and date fields in your envelope.
                Field names must be enclosed in square brackets ("[]").
            </p>

            <textarea style="width: 100%;" id="formulaInput"></textarea>
            <small class="form-text text-muted">Example: [16160]-[23502]</small>
        </div>

        <div class="note">
            <p class="mt-2 mb-2">Add Text</p>
            <textarea style="width: 100%;" id="noteInput"></textarea>
        </div>

        <div class="footer">
            <button type="button" class="btn btn-success btn-block" id="saveOption">
                <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Save
            </button>

            <button type="button" class="btn btn-danger btn-block" id="deleteOption">
                <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Delete
            </button>

            <button type="button" class="btn btn-secondary btn-block" id="closeOption">
                Close
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

    <?php include viewPath('v2/includes/footer');?>
<?php endif;?>

<!-- <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php if (isset($next_step) && $next_step == 0): ?>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
<?php endif;?>

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
    .content_sidebar.content_sidebar-left {
        position: absolute !important;
        padding-top: 0 !important;
    }
    [id^=pdf-render] {
        border: 1px solid #d8d8d8;
    }
    .nsm-nav .nsm-page-title h4 {
        font-weight: 700 !important;
        margin: unset !important;
        line-height: 0.8 !important;
        font-size: 1.5rem !important;
        font-family: inherit !important;
        text-transform: none !important;
    }
    .btn-success {
        border-color: #198754 !important;
    }
    #fieldsSidebar {
        position: sticky !important;
        top: 0;
    }
</style>

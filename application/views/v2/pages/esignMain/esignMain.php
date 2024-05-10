<?php include viewPath('v2/includes/header'); ?>
<style>
#esignsearchresults{
    max-height: 500px;
    overflow: scroll;
}
.docfile-id, .docfile-name{
    font-size: 14px;
}
.docfile-id{
    font-weight: bold;    
}
.modal-dialog-center {
    margin-top: 9%;
}
.modal-gray{
    background-color: #cccccc;
}
.esign-modal-btn{
    display: block;
    font-size: 20px;
}
.esign-modal-btn i{
    font-size:23px;
    position: relative;
    top: 3px;
}
#modal-select-action .modal-dialog{
    width:344px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process. Implementing e-signatures into your existing workflows is easier than you think. Explore all various tools.
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('eSign_v2/templateCreate') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/envelope_builder.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>eSign Builder</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Create template using eSign builder</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('EsignEditor_v2/create') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/editor.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>eSign Editor</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Create eSign using eSign Editor</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('eSign_v2/manager') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/esignmanager.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>eSign Manager</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">eSign Lists.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('vault_v2/mylibrary') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/templates.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Templates</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">View your templates in library vault</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('EsignEditor_v2/letters') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/library.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Library</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">View letters in eSign Editor</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('dropbox') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/dropbox.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Dropbox</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Go to your Dropbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/google_drive.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Google Drive</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Go to your Drive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/box.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Box</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Use a secure cloud content management application</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('FillAndSign_v2/step1') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/fill_and_esign.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>Fill & eSign</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Start filling up and signing eSign</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button" onclick="location.href='<?php echo base_url('eSign_v2/manage?view=inbox') ?>'">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/esign.png') ?>">
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="nsm-card-title mt-4">
                                            <span>eSign</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">Manage your eSigns</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php //if ($users->company_id == 1 /*nsmartrac company*/) : ?>
                        <div class="col-12 col-md-3">
                            <div class="nsm-card primary p-5" role="button" data-bs-toggle="modal" data-bs-target="#searchesignmodal">
                                <div class="nsm-card-content">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img class="nsm-card-img" src="<?php echo base_url('uploads/image/esign/search.png') ?>">
                                        </div>
                                        <div class="col-12 text-center">
                                            <div class="nsm-card-title mt-4">
                                                <span>Search eSign</span>
                                            </div>
                                            <label class="nsm-subtitle d-block">Search eSign by key, name, subject, etc.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php //endif; ?>                    
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade nsm-modal fade" id="modal-select-action" tabindex="-1" aria-labelledby="modal-select-action_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title"><i class='bx bxs-pen' ></i> eSign</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <a class="nsm nsm-button primary esign-modal-btn" href="<?= base_url('eSign_v2/templateCreate'); ?>"><i class='bx bxs-edit'></i> Create New Template</a>
                        <a class="nsm nsm-button primary esign-modal-btn" href="<?= base_url('vault_v2/mylibrary'); ?>"><i class='bx bx-file'></i> Use Existing Template</a>
                        <a class="nsm nsm-button primary esign-modal-btn btn-close-modal-select-action" href="javascript:void(0);"><i class='bx bx-question-mark'></i> Something else?</a>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>

<div class="modal fade nsm-modal" id="searchesignmodal" tabindex="-1" aria-labelledby="searchesignmodal_label" aria-modal="true" role="dialog">
    <style>
        #searchesignmodal .widget-form {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
        }

        #searchesignmodal .widget-form input {
            border-radius: .25rem !important;
        }

        #searchesignmodal .widget-form button {
            border-radius: 5px !important;
            margin-bottom: 0 !important;
        }

        #searchesignmodal .nsm-empty {
            padding: 1rem 0;
        }
    </style>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="searchesignmodal_label">Search eSign</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <form class="mb-3">
                    <div class="col-12 col-md">
                        <div class="input-group widget-form">
                            <input id="esignsearch" placeholder="Search eSign by docfile ID, subject, customer name." class="form-control nsm-field" maxlength="80" type="search">
                        </div>
                    </div>
                </form>

                <div style="">
                    <div id="esignsearchloader" class="d-flex align-items-center justify-content-center esign-loader d-none" style="padding: 4rem 0;">
                        <div class="spinner-border" role="status"></div>
                    </div>

                    <ul id="esignsearchresults" class="list-group d-none">
                    </ul>

                    <div class="nsm-empty">
                        <i class="bx bx-meh-blank"></i>
                        <span>No matching eSigns.</span>
                    </div>
                </div>

                <template id="esignsearchresulttemplate">
                    <li class="list-group-item justify-content-between align-items-center">
                        <div class="row">
                            <div class="col-md-9">
                                <span class="docfile-id"></span><br />
                                <span class="customer docfile-name"></span><br />        
                                <span class="subject docfile-name"></span>        
                            </div>
                            <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                <button data-action="view" id="btnViewDetails" class="nsm-button primary" style="margin-bottom: 0; display: inline-block;">View</button>    
                            </div>
                        </div>
                    </li>
                </template>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="viewesigndocumentdetails">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header modal-gray">
                <h5 class="modal-title"></h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                </button>
            </div>
            <div class="modal-body modal-gray">
                <div class="d-flex align-items-center justify-content-center esign-loader" style="padding: 4rem 0;">
                    <div class="spinner-border" role="status"></div>
                </div>

                <div class="esign-content">
                    <div>
                        <div class="content-title">Subject</div>
                        <div class="esign-subject"></div>
                    </div>

                    <div style="margin-top:5px;">
                        <div class="content-title">Template</div>
                        <div class="esign-template"></div>
                    </div>

                    <div style="margin-top:5px;">
                        <div class="content-title">Customer Name</div>
                        <div class="esign-customer"></div>
                    </div>

                    <div style="margin-top:5px;">
                        <div class="content-title">Recipients</div>
                        <div class="esign-recipients"></div>
                    </div>

                    <div style="margin-top:5px;">
                        <div class="content-title">Created at</div>
                        <div class="esign-created-at"></div>
                    </div>
                    <hr >
                    <div>
                        <div class="content-title">Signing link</div>
                        <a class="esign-link" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; display:block;" target="_blank"></a>
                    </div>

                    <br />

                    <a target="_blank" class="nsm-button primary esign-download" style="margin: 0; display:inline-flex; align-items:center; cursor: pointer;">
                        <i class="bx bxs-download" style="margin-right: 3px;"></i>
                        Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/esign/docusign/v2/search.js") ?>" type="module"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-select-action').modal('show');
        $('.btn-close-modal-select-action').on('click', function(){
            $('#modal-select-action').modal('hide');
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
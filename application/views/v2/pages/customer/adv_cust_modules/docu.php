<style>
.client-agreement-list ul, .photo-id-copy-list ul, .site-photos-list ul{
    list-style: none;
    margin: 10px 0px;
}
.row-header{
    background-color:#6a4a8621;
    padding:7px;
    height:36px;
}
.img-signature{
    border:1px #e6e6e6 solid;
    width:100%;
}
</style>
<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>" module-id="profiledocuments">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Documents</span>
                <span class="float-end">Total : <?= $total_customer_documents > 0 ? $total_customer_documents : '0'; ?></span>
            </div>
            <label class="nsm-subtitle">Issued/Received</label>
        </div>
        <div class="nsm-card-content">
            <input type="file" id="docufileinput" class="d-none" />
            <?php
                $__documentExists = function ($documentType) use ($customer_documents) {
                    if (!isset($customer_documents)) return false;
                    if (!is_array($customer_documents)) return false;

                    foreach ($customer_documents as $document) {
                        if ($document['document_type'] === $documentType) {
                            return true;
                        }
                    }

                    return false;
                };
            ?>
            <style>
                .buttons.has-document [data-action=upload] {
                    /* opacity: 0.3;
                    pointer-events: none;
                    user-select: none; */
                }
                .buttons:not(.has-document) [data-action=download],
                .buttons:not(.has-document) [data-action=delete] {
                    opacity: 0.3;
                    pointer-events: none;
                    user-select: none;
                }
            </style>

            <div class="row g-3">

                <div class="nsm-callout error d-none"></div>

                <div class="upload-wrapper">
                    <div class="col-12" data-document-type="client_agreement">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= count($customer_client_agreements) > 0 ? 'checked="checked"' : ''; ?> value="1" id="client_agreement" name="client_agreement">
                                    <label class="form-check-label" for="client_agreement" data-type="document_label">
                                        Client Agreement
                                    </label>                                    
                                </div>                                
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('client_agreement') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="client_agreement">
                                    Upload
                                </button>
                                <!-- <button type="button" class="nsm-button btn-sm" data-action="download" data-id="<?= $cus_id; ?>">
                                    Download
                                </button>
                                <button type="button" class="nsm-button error btn-sm" data-action="delete" data-type="client_agreement">
                                    Delete
                                </button> -->
                            </div>
                            <div class="client-agreement-list">
                                <?php if( $customer_client_agreements ){ ?>
                                    <ul>
                                        <?php foreach($customer_client_agreements as $ca){ ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6"><span><?= $ca['file_name']; ?></span></div>
                                                    <div class="col-md-6 text-end buttons has-document">
                                                        <button type="button" class="nsm-button btn-sm download-client-agreement" data-id="<?= $ca['id']; ?>">
                                                            Download
                                                        </button>
                                                        <button type="button" class="nsm-button error btn-sm delete-client-agreement" data-id="<?= $ca['id']; ?>">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-document-type="site_photos">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= count($customer_site_photos) > 0 ? 'checked="checked"' : ''; ?> value="1" id="site_photos" name="site_photos">
                                    <label class="form-check-label" for="site_photos" data-type="document_label">
                                        Site Photos
                                    </label>                                    
                                </div>                                
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('site_photos') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="site_photos">
                                    Upload
                                </button>
                            </div>
                            <div class="site-photos-list">
                                <?php if( $customer_site_photos ){ ?>
                                    <ul>
                                        <?php foreach($customer_site_photos as $cp){ ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6"><span><?= $cp['file_name']; ?></span></div>
                                                    <div class="col-md-6 text-end buttons has-document">
                                                        <button type="button" class="nsm-button btn-sm download-site-photos" data-id="<?= $cp['id']; ?>">
                                                            Download
                                                        </button>
                                                        <button type="button" class="nsm-button error btn-sm delete-site-photos" data-id="<?= $cp['id']; ?>">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-document-type="photo_id_copy">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= count($customer_site_photos) > 0 ? 'checked="checked"' : ''; ?> value="1" id="photo_id_copy" name="photo_id_copy">
                                    <label class="form-check-label" for="photo_id_copy" data-type="document_label">
                                        Photo ID Copy
                                    </label>                                    
                                </div>                                
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('photo_id_copy') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="photo_id_copy">
                                    Upload
                                </button>
                            </div>
                            <div class="photo-id-copy-list">
                                <?php if( $customer_photo_id_copy ){ ?>
                                    <ul>
                                        <?php foreach($customer_photo_id_copy as $pid){ ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6"><span><?= $pid['file_name']; ?></span></div>
                                                    <div class="col-md-6 text-end buttons has-document">
                                                        <button type="button" class="nsm-button btn-sm download-photo-id-copy" data-id="<?= $pid['id']; ?>">
                                                            Download
                                                        </button>
                                                        <button type="button" class="nsm-button error btn-sm delete-photo-id-copy" data-id="<?= $pid['id']; ?>">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2" data-document-type="proof_of_residency">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= $__documentExists('proof_of_residency') ? 'checked="checked"' : ''; ?> value="1" id="proof_of_residency" name="proof_of_residency">
                                    <label class="form-check-label" for="proof_of_residency" data-type="document_label">
                                        Proof of Residency
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('proof_of_residency') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="proof_of_residency">
                                    Upload
                                </button>
                                <button type="button" class="nsm-button btn-sm" data-action="download" data-id="<?= $cus_id; ?>">
                                    Download
                                </button>
                                <button type="button" class="nsm-button error btn-sm" data-action="delete" data-type="proof_of_residency">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2" data-document-type="personal_guarantee">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= $__documentExists('personal_guarantee') ? 'checked="checked"' : ''; ?> value="1" id="personal_guarantee" name="personal_guarantee">
                                    <label class="form-check-label" for="personal_guarantee" data-type="document_label">
                                        Personal Guarantee
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('personal_guarantee') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="personal_guarantee">
                                    Upload
                                </button>
                                <button type="button" class="nsm-button btn-sm" data-action="download" data-id="<?= $cus_id; ?>">
                                    Download
                                </button>
                                <button type="button" class="nsm-button error btn-sm" data-action="delete" data-type="personal_guarantee">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-document-type="client_certificate">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= count($customer_certificates) > 0 ? 'checked="checked"' : ''; ?> value="1" id="client_certificate" name="client_certificate">
                                    <label class="form-check-label" for="client_certificate" data-type="document_label">
                                        Client Certificate
                                    </label>                                    
                                </div>                                
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $__documentExists('client_certificate') ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" data-action="upload" data-type="client_certificate">
                                    Upload
                                </button>
                            </div>
                            <div class="client-agreement-list">
                                <?php if( $customer_certificates ){ ?>
                                    <ul>
                                        <?php foreach($customer_certificates as $ca){ ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6"><span><?= $ca['file_name']; ?></span></div>
                                                    <div class="col-md-6 text-end buttons has-document">
                                                        <button type="button" class="nsm-button btn-sm download-client-agreement" data-id="<?= $ca['id']; ?>">
                                                            Download
                                                        </button>
                                                        <button type="button" class="nsm-button error btn-sm delete-client-agreement" data-id="<?= $ca['id']; ?>">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2" data-document-type="customer_signature">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 row-header">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input docu-chk" type="checkbox" <?= $customerSignature ? 'checked="checked"' : ''; ?> value="1" id="customer_signature" name="customer_signature">
                                    <label class="form-check-label" for="customer_signature" data-type="document_label">
                                        Signature
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 row-header text-end buttons <?= $customerSignature ? 'has-document' : ''; ?>">
                                <button type="button" class="nsm-button btn-sm" id="btn-customer-signature">
                                    Change
                                </button>
                                <button type="button" class="nsm-button btn-sm" data-action="download" data-id="<?= $cus_id; ?>">
                                    Download
                                </button>
                                <button type="button" class="nsm-button error btn-sm" data-action="delete" data-type="customer_signature">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php if( $customerSignature ){ ?>
                        <div class="col-8 col-md-4 mt-2">
                            <img class="img-signature img-thumbnail" src="<?= $customerSignature->value; ?>" />
                        </div>
                    <?php } ?>

                    <div class="documents-loader d-flex align-items-center justify-content-center" style="padding-top: 1rem;display:none !important;">
                        <div class="spinner-border" role="status"></div>
                    </div>

                    <template>
                        <div class="col-12">
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-6 position-relative">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="1">
                                        <label class="form-check-label" data-type="document_label"></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 text-end buttons">
                                    <button type="button" class="nsm-button btn-sm" data-action="upload">
                                        Upload
                                    </button>
                                    <button type="button" class="nsm-button btn-sm" data-action="download">
                                        Download
                                    </button>
                                    <button type="button" class="nsm-button error btn-sm" data-action="delete">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <form class="mt-5" id="frm-esign-doc" action="<?= base_url('customer/download_esign_doc'); ?>" method="POST">
                    <div class="upload-wrapper" id="generatedpdfwrapper">
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-7">
                                <div class="input-group rounded">
                                  <input type="search" class="form-control rounded" id="esign-search" placeholder="Search eSign ID" aria-label="Search" aria-describedby="search-addon" />
                                  <span class="input-group-text border-0" id="search-addon">
                                    <i class='bx bx-search-alt-2'></i>
                                  </span>
                                </div>    
                            </div>
                        </div>                
                        <div class="mt-4" id="esign-container"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6 col-md-6 mb-2">
                            <button type="button" class="nsm-button primary w-100 ms-0" id="managecustomerdocumentsbtn">
                                <i class='bx bx-fw bx-list-minus'></i> Customize List
                            </button>                            
                        </div>
                        <div class="col-6 col-md-6 mb-2">
                            <button type="button" class="nsm-button primary w-100 ms-0" id="manageArchivedDocuments" data-id="<?= $cus_id; ?>">
                                <i class='bx bx-fw bx-trash'></i> Archived List
                            </button>                            
                        </div>
                        <div class="col-6 col-md-6 mb-2">
                            <button type="button" class="nsm-button primary w-100 ms-0" id="sendEsign" data-id="<?= $cus_id; ?>">
                                <i class='bx bx-fw bx-pen'></i> Send eSign
                            </button>                            
                        </div>
                        <!-- <div class="col-6 col-md-6 mb-2">
                            <button type="submit" class="nsm-button w-100 ms-0 amt-3" id="managecustomerdocumentsbtn--download">
                                <i class='bx bx-fw bx-import'></i> Download Selected
                            </button>
                        </div> -->
                        <!-- <div class="col-6 col-md-6">
                            <button type="button" class="nsm-button w-100 ms-0 btn-delete-selected" id="managecustomerdocumentsbtn--delete">
                                <i class='bx bx-fw bx-trash'></i>
                                <span class="text">Delete Selected</span>
                            </button>
                        </div> -->
                        <div class="col-6 col-6 col-md-6">
                            <button type="button" class="nsm-button primary w-100 ms-0" data-action="import_esign" data-bs-toggle="modal" data-bs-target="#searchesignmodal">
                                <i class='bx bx-fw bx-import'></i>
                                <span class="text">Import eSign</span>
                            </button>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-document-archived" tabindex="-1" aria-labelledby="modal-quick-add-job-tag-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="quick-add-job-tag-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Document Archived</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="document-archived-container"></div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="managecustomerdocuments">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Documents</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <div class="documents-wrapper">
                <div class="nsm-callout error d-none"></div>

                <form class="mb-3">
                    <style>
                        .document-form {
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                            gap: 8px;
                        }
                        .document-form input {
                            border-radius: .25rem !important;
                        }
                        .document-form button {
                            border-radius: 5px !important;
                            margin-bottom: 0 !important;
                        }
                    </style>
                    <div class="col-12 col-md">
                        <label class="content-subtitle fw-bold mb-2">Document Label</label>
                        <div class="input-group document-form">
                            <input placeholder="Enter document label" class="form-control nsm-field" >
                            <button type="submit" class="nsm-button primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

                <div class="nsm-card mb-2 h-auto" data-document-type="client_agreement">
                    <div class="nsm-card-content">
                        <div class="d-flex">
                            <div>
                                <span class="content-title d-block">
                                    Client Agreement
                                </span>
                            </div>
                            <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                                <div class="form-check form-switch">
                                    <input checked disabled class="form-check-input ms-0" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nsm-card mb-2 h-auto" data-document-type="photo_id_copy">
                    <div class="nsm-card-content">
                        <div class="d-flex">
                            <div>
                                <span class="content-title d-block">
                                    Photo ID Copy
                                </span>
                            </div>
                            <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                                <div class="form-check form-switch">
                                    <input checked disabled class="form-check-input ms-0" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nsm-card mb-2 h-auto" data-document-type="proof_of_residency">
                    <div class="nsm-card-content">
                        <div class="d-flex">
                            <div>
                                <span class="content-title d-block">
                                    Proof of Residency
                                </span>
                            </div>
                            <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                                <div class="form-check form-switch">
                                    <input checked disabled class="form-check-input ms-0" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nsm-card mb-2 h-auto" data-document-type="personal_guarantee">
                    <div class="nsm-card-content">
                        <div class="d-flex">
                            <div>
                                <span class="content-title d-block">
                                    Personal Guarantee
                                </span>
                            </div>
                            <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                                <div class="form-check form-switch">
                                    <input checked disabled class="form-check-input ms-0" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="documents-loader d-flex align-items-center justify-content-center" style="padding: 1rem 0;">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
        </div>

        <template>
            <div class="nsm-card mb-2 h-auto">
                <style>
                    .switch-btn {
                        --size: 20px;
                        padding: 0;
                        border: 0;
                        outline: 0;
                        background-color: transparent;
                        width: var(--size);
                        height: var(--size);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-left: 8px;
                    }
                </style>
                <div class="nsm-card-content">
                    <div class="d-flex">
                        <div>
                            <span class="content-title d-block"></span>
                        </div>
                        <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0" type="checkbox" checked="">
                            </div>
                            <button class="switch-btn delete text-danger">
                                <i class="bx bx-fw bx-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
      </div>
    </div>
  </div>
</div>


<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="viewesigndocumentdetails" style="z-index: 1056;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center justify-content-center esign-loader" style="padding: 4rem 0;">
            <div class="spinner-border" role="status"></div>
        </div>

        <div class="esign-content">
            <div>
                <div class="content-title">Recipients</div>
                <div class="esign-recipients"></div>
            </div>

            <br/>

            <div>
                <div class="content-title">Created at</div>
                <div class="esign-created-at"></div>
            </div>

            <br/>

            <div>
                <div class="content-title">Signing link</div>
                <a class="esign-link" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; display:block;" target="_blank"></a>
            </div>

            <br/>

            <a target="_blank" class="nsm-button primary esign-download" style="margin: 0; display:inline-flex; align-items:center; cursor: pointer;">
                <i class="bx bxs-download" style="margin-right: 3px;"></i>
                Download PDF
            </a>
        </div>
      </div>
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

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="searchesignmodal_label">Search eSign to import</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <form class="mb-3">
                    <div class="col-12 col-md">
                        <div class="input-group widget-form">
                            <input id="esignsearch" placeholder="Search eSign by key, name, subject, etc." class="form-control nsm-field" maxlength="50" type="search">
                        </div>
                    </div>
                </form>

                <div style="min-height: 200px;">
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="name"></span>
                        <div>
                            <button data-action="import" class="nsm-button primary" style="margin-bottom: 0; display: inline-block;">Import</button>
                            <button data-action="view" class="nsm-button" style="margin-bottom: 0; display: inline-block;">View</button>
                        </div>
                    </li>
                </template>
            </div>
        </div>
    </div>
</div>
<!-- Customer Signature -->
    <div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="modal-customer-signature">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Customer Signature</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="signature-pad-container">
                <div class="canvas-wrapper">
                    <canvas></canvas>
                    <span class="canvas-placeholder">sign here</span>
                </div>

                <div class="d-flex justify-content-end">
                    <a class="link nsm-button default" href="#" data-action="clear">Clear</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="nsm-button primary" id="btn-save-signature" data-action="save">Save</button>
            <button type="button" class="nsm-button" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js" integrity="sha512-e2WVdoOGqKU97DHH6tYamn+eAwLDpyHKqPy4uSv0aGlwDXZKGwyS27sfiIUT8gpZ88/Lr4UZpbRt93QkGRgpug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(function(){
    load_esign_doc('');

    $(".docu-chk").click(function() { return false; });

    $('#btn-customer-signature').on('click', function(){            
        initSignatureModal(); 
        $('#modal-customer-signature').modal('show');
    });

    // Start signature script
    function initSignatureModal() {
        const $modal = document.getElementById('modal-customer-signature');
        const $canvasWrapper = $modal.querySelector(".canvas-wrapper");
        const $canvas = $canvasWrapper.querySelector("canvas");
        const $placehoder = $modal.querySelector(".canvas-placeholder");

        let signaturePad = new SignaturePad($canvas); 

        $($modal).on("shown.bs.modal", () => {
            const { height, width } = window.getComputedStyle($canvasWrapper);
            $canvas.setAttribute("height", height);
            $canvas.setAttribute("width", width);
            signaturePad = new SignaturePad($canvas);

            $($placehoder).fitText();

            if (customer_signature != '') {  
                $canvasWrapper.classList.add("has-content");
                signaturePad.fromDataURL(customer_signature);
            }
        });

        $($modal).on("hidden.bs.modal", () => {
          clearCanvas();
          $canvas.removeAttribute("height");
          $canvas.removeAttribute("width");
        });

        const $clear = $modal.querySelector("[data-action=clear]");
            $clear.addEventListener("click", (event) => {
            event.preventDefault();
            clearCanvas();
        });

        signaturePad.onBegin = () => {
            $canvasWrapper.classList.add("has-content");
        };

        const $save = $modal.querySelector("[data-action=save]");
        $save.addEventListener("click", (event) => {
            saveCustomerSignature(getSignatureUrl($canvas));
        });

        function clearCanvas() {
            signaturePad.clear();
            $canvasWrapper.classList.remove("has-content");
        }
    }

    function saveCustomerSignature(signature_value)
    {
        if( signature_value != '' ){
            var customer_id = '<?= $profile_info->prof_id; ?>';
            $.ajax({
                url: base_url + 'customer/_save_signature',
                method: 'post',            
                data: {customer_id:customer_id,signature_value:signature_value},
                dataType:'json',
                success: function (response) {
                    $('#btn-save-signature').html('Save');
                    if( response.is_success == 1 ){
                        customer_signature = signature_value;
                        $('#modal-customer-signature').modal('hide');
                        Swal.fire({
                        icon: 'success',                        
                        text: 'Customer signature has been updated successfully',
                        }).then((result) => {
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-save-signature').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });   
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter customer signature',
            });
        }
    }

    function getSignatureUrl($canvas) 
    {
        if (isCanvasBlank($canvas)) return '';

        const $clonedCanvas = cloneCanvas($canvas);            
        return $clonedCanvas.toDataURL("image/png");
    }

    function isCanvasBlank(canvas) 
    {
        return !canvas
            .getContext("2d")
            .getImageData(0, 0, canvas.width, canvas.height)
            .data.some((channel) => channel !== 0);
    }

    function cloneCanvas(oldCanvas) 
    {
        //create a new canvas
        var newCanvas = document.createElement("canvas");
        var context = newCanvas.getContext("2d");

        //set dimensions
        newCanvas.width = oldCanvas.width;
        newCanvas.height = oldCanvas.height;

        //apply the old canvas to the new one
        context.drawImage(oldCanvas, 0, 0);

        //return the new canvas
        return newCanvas;
    }
    // End signature script 

    function load_esign_doc(search_query){
        var cid = "<?= $customer_id; ?>";
        var url = base_url + "customer/_load_esign_doc";
        var _container = $("#esign-container");

        showLoader(_container);

        $.ajax({
            async:false,
            type: 'POST',
            url: url,
            data: {cid:cid,search_query:search_query},
            success: function(result) {
                _container.html(result);                
            },
        });
    }

    $(document).on('click', '#manageArchivedDocuments', function(){
        var cid = $(this).attr('data-id');

        $('#modal-document-archived').modal('show');
        $.ajax({
            type: 'POST',
            url: base_url + "customer/_get_document_archives",
            data: {cid:cid},           
            success: function(o) {
                $('#document-archived-container').html(o);
            },
        });
    });

    $(document).on('click', '.download-client-agreement', function(){
        var cdi = $(this).attr('data-id');
        window.open(
        `${base_url}customer/download_document/${cdi}`,
        "_blank"
        );
    });

    $(document).on('click', '.download-site-photos', function(){
        var cdi = $(this).attr('data-id');
        window.open(
        `${base_url}customer/download_document/${cdi}`,
        "_blank"
        );
    });

    $(document).on('click', '.delete-client-agreement', function(){
        var cdi = $(this).attr('data-id');
        Swal.fire({
            title: 'Delete Client Agreement',
            html: "Are you sure you want to delete selected client agreement file?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/_delete_client_agreement",
                    data: {cdi:cdi},
                    dataType: 'json',            
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            location.reload();
                        }else{
                            Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                            });
                        }
                    },
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.delete-site-photos', function(){
        var cdi = $(this).attr('data-id');
        Swal.fire({
            title: 'Delete Site Photos',
            html: "Are you sure you want to delete selected site photo?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/_delete_site_photos",
                    data: {cdi:cdi},
                    dataType: 'json',            
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            location.reload();
                        }else{
                            Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                            });
                        }
                    },
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on("click", '.btn-delete-selected', function(e){
        var asmsid = $(this).attr("data-id");
        var url = base_url + 'customer/_delete_esign_documents';

        Swal.fire({
            title: 'Delete Esign Document',
            html: "Are you sure you want to delete selected document(s)?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: $('#frm-esign-doc').serialize(),
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({                                
                                text: "Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    load_esign_doc();
                                //}
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

    $(document).on("keyup", "#esign-search", function(e){
        //if(e.which == 13){
            var inputVal = $(this).val();
            load_esign_doc(inputVal);
        //}
    });       
});
</script>

<script src="<?= base_url("assets/js/esign/docusign/v2/search.js") ?>" type="module"></script>

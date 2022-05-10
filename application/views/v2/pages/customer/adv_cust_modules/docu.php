<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>" module-id="profiledocuments">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Documents</span>
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
                    opacity: 0.3;
                    pointer-events: none;
                    user-select: none;
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
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="client_agreement" name="client_agreement">
                                    <label class="form-check-label" for="client_agreement" data-type="document_label">
                                        Client Agreement
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-end buttons <?= $__documentExists('client_agreement') ? 'has-document' : ''; ?>">
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

                    <div class="col-12" data-document-type="photo_id_copy">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="photo_id_copy" name="photo_id_copy">
                                    <label class="form-check-label" for="photo_id_copy" data-type="document_label">
                                        Photo ID Copy
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-end buttons <?= $__documentExists('photo_id_copy') ? 'has-document' : ''; ?>">
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

                    <div class="col-12" data-document-type="proof_of_residency">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="proof_of_residency" name="proof_of_residency">
                                    <label class="form-check-label" for="proof_of_residency" data-type="document_label">
                                        Proof of Residency
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-end buttons <?= $__documentExists('proof_of_residency') ? 'has-document' : ''; ?>">
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

                    <div class="col-12" data-document-type="personal_guarantee">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="personal_guarantee" name="personal_guarantee">
                                    <label class="form-check-label" for="personal_guarantee" data-type="document_label">
                                        Personal Guarantee
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-end buttons <?= $__documentExists('personal_guarantee') ? 'has-document' : ''; ?>">
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

                    <div class="documents-loader d-flex align-items-center justify-content-center" style="padding-top: 1rem;">
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

                <div class="col-12 col-md-4">
                    <button type="button" class="nsm-button primary w-100 ms-0 mt-3" id="managecustomerdocumentsbtn">
                        <i class='bx bx-fw bx-list-minus'></i> Customize List
                    </button>
                </div>

                <div class="col-12 col-md-4">
                    <button type="button" class="nsm-button w-100 ms-0 mt-3" id="managecustomerdocumentsbtn--download">
                        <i class='bx bx-fw bx-import'></i> Download Selected
                    </button>
                </div>

                <div class="col-12 col-md-4">
                    <button type="button" class="nsm-button w-100 ms-0 mt-3" id="managecustomerdocumentsbtn--delete">
                        <i class='bx bx-fw bx-trash'></i>
                        <span class="text">Delete Selected</span>
                    </button>
                </div>
            </div>
        </div>
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
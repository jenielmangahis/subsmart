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
                                <input class="form-check-input" type="checkbox" value="1" id="photo_copy_id" name="photo_copy_id">
                                <label class="form-check-label" for="photo_copy_id" data-type="document_label">
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
                                <input class="form-check-input" type="checkbox" value="1" id="residency_proof" name="residency_proof">
                                <label class="form-check-label" for="residency_proof" data-type="document_label">
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

                <div class="col-12">
                    <button type="button" class="nsm-button primary w-100 ms-0 mt-3" disabled>
                        <i class='bx bx-fw bx-list-minus'></i> Customize List
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
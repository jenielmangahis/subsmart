<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Documents</span>
            </div>
            <label class="nsm-subtitle">Issued/Received</label>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="client_agreement" name="client_agreement">
                                    <label class="form-check-label" for="client_agreement">
                                        Client Agreement
                                    </label>
                                </div>
                                <input type="file" name="upload_document" class="position-absolute invisible" id="upload_document_1">
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Upload
                                </button>
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Download
                                </button>
                                <button role="button" class="nsm-button error btn-sm" disabled>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="photo_copy_id" name="photo_copy_id">
                                    <label class="form-check-label" for="photo_copy_id">
                                        Photo ID Copy
                                    </label>
                                </div>
                                <input type="file" name="upload_document" class="position-absolute invisible" id="upload_document_4">
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Upload
                                </button>
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Download
                                </button>
                                <button role="button" class="nsm-button error btn-sm" disabled>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="residency_proof" name="residency_proof">
                                    <label class="form-check-label" for="residency_proof">
                                        Proof of Residency
                                    </label>
                                </div>
                                <input type="file" name="upload_document" class="position-absolute invisible" id="upload_document_6">
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Upload
                                </button>
                                <button role="button" class="nsm-button btn-sm" disabled >
                                    Download
                                </button>
                                <button role="button" class="nsm-button error btn-sm" disabled>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6 position-relative">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="1" id="personal_guarantee" name="personal_guarantee">
                                    <label class="form-check-label" for="personal_guarantee">
                                        Personal Guarantee
                                    </label>
                                </div>
                                <input type="file" name="upload_document" class="position-absolute invisible" id="upload_document_6">
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Upload
                                </button>
                                <button role="button" class="nsm-button btn-sm" disabled>
                                    Download
                                </button>
                                <button role="button" class="nsm-button error btn-sm" disabled>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" disabled>
                        <i class='bx bx-fw bx-list-minus'></i> Customize List
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fillandesign__step1">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" id="recent-tab" data-bs-toggle="tab" href="#recent" role="tab" aria-selected="true">
                Fill & eSign Documents
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="my-templates" data-bs-toggle="tab" href="#myTemplates" role="tab" aria-selected="false">
                eSign Templates
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="vault-tab" data-bs-toggle="tab" href="#vault" role="tab" aria-selected="false">
                Shared Library
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="local-tab" data-bs-toggle="tab" href="#local" role="tab" aria-selected="false">
                Local
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="esign-only-tab" data-bs-toggle="tab" href="#esign-only" role="tab" aria-selected="false">
                eSign
            </a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="recent" data-upload-type="recent" role="tabpanel" aria-labelledby="recent-tab">
            <div>
                <ul class="fillAndSign__recent"></ul>
            </div>
        </div>

        <div class="tab-pane" id="vault" data-upload-type="vault" role="tabpanel" aria-labelledby="vault-tab">
            <div>
                <ul class="fillAndSign__vault"></ul>
            </div>
        </div>

        <div class="tab-pane" id="myTemplates" data-upload-type="myTemplates" role="tabpanel" aria-labelledby="my-templates">
            <div>
                <ul class="fillAndSign__vault"></ul>
            </div>
        </div>

        <div class="tab-pane" id="local" data-upload-type="local" role="tabpanel" aria-labelledby="local-tab">
            <div class="fillAndSign__selectFile">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileInput" accept="application/pdf">
                    <label class="custom-file-label" for="customFile">
                        <span class="custom-file-label__inner">Select Document</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="esign-only" role="tabpanel" aria-labelledby="esign-only-tab">

            <div class="mt-3">
                <label>Authorizer Name</label>
                <input id="authorizerName" type="text" class="form-control">
            </div>

            <ul class="nav nav-tabs mt-3" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="esign-only-draw-tab" data-bs-toggle="tab" href="#esign-only-draw" role="tab" aria-controls="draw" aria-selected="false">
                        <i class="fa fa-pencil mr-2"></i>Draw
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="esign-only-type-tab" data-bs-toggle="tab" href="#esign-only-type" role="tab" aria-controls="type" aria-selected="true">
                        <i class="fa fa-keyboard-o mr-2"></i>Type
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" data-signature-type="draw" id="esign-only-draw" role="tabpanel" aria-labelledby="draw-tab">
                    <div class="fillAndSign__signaturePad">
                        <canvas width="700" height="200"></canvas>
                        <a href="#">Clear</a>
                        <div style="height: 10px;"></div>
                    </div>
                </div>
                <div class="tab-pane" data-signature-type="type" id="esign-only-type" role="tabpanel" aria-labelledby="type-tab">

                    <div class="dropdown mt-2 mb-2" id="fontSelect">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="fontDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Font
                        </button>
                        <div class="dropdown-menu" aria-labelledby="fontDropdown">
                            <a class="dropdown-item" href="#" data-font="font-1">Font 1</a>
                            <a class="dropdown-item" href="#" data-font="font-2">Font 2</a>
                            <a class="dropdown-item" href="#" data-font="font-3">Font 3</a>
                            <a class="dropdown-item" href="#" data-font="font-4">Font 4</a>
                            <a class="dropdown-item" href="#" data-font="font-5">Font 5</a>
                        </div>
                    </div>

                    <input class="form-control fillAndSign__signatureInput" spellcheck="false" autocomplete="off" autofocus tabindex="0" aria-label="Type your signature here" maxlength="255" placeholder="Type your signature here">
                </div>
            </div>
        </div>
    </div>
</div>

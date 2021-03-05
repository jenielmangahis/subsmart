<div class="fillandesign__step1">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="true">
                Recent Documents
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="vault-tab" data-toggle="tab" href="#vault" role="tab" aria-controls="vault" aria-selected="false">
                Shared Library
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="local" aria-selected="false">
                Local
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
    </div>
</div>
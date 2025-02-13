<div class="row container-modules mt-4">
    <div class="col-md-6">
        <input type="text" id="search-module" placeholder="Search Module" class="form-control" />
    </div>
    <div class="col-md-6">
        <div class="container-header" style="background-color:#ffffff !important;">
            <h3>&nbsp;</h3>
            <div class="form-check text-end chk-row-allow-all-modules">
                <input class="form-check-input chk-all-modules" id="modules-all" name="roleWidgets[]" value="1" type="checkbox" />
                <label class="form-check-label" for="modules-all">Allow all modules</label>
            </div>
        </div>
    </div>
    <?php foreach( $modules as $key => $module ){ ?>
    <div class="col-md-6 module-container">
        <div class="container-header">
            <h3><?= $module; ?></h3>
            <div class="form-check text-end chk-row-allow-all">
                <input class="form-check-input module-check-input chk-all-rights" data-module="<?= $key; ?>" type="checkbox" id="chk-all-<?= $key; ?>">
                <label class="form-check-label" for="chk-all-<?= $key; ?>">Allow all</label>
            </div>
        </div>
        <ul class="module-permissions">
            <li>
                <div class="form-check">
                    <input class="form-check-input module-check-input chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key; ?>][read]" value="1" id="chk-read-<?= $key; ?>">
                    <label class="form-check-label" for="chk-read-<?= $key; ?>">Read</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input class="form-check-input module-check-input chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key; ?>][write]" value="1" id="chk-write-<?= $key; ?>">
                    <label class="form-check-label" for="chk-write-<?= $key; ?>">Write</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input class="form-check-input module-check-input chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key; ?>][delete]" value="1" id="chk-delete-<?= $key; ?>">
                    <label class="form-check-label" for="chk-delete-<?= $key; ?>">Delete</label>
                </div>
            </li>
        </ul>
    </div>
    <?php } ?>
</div>
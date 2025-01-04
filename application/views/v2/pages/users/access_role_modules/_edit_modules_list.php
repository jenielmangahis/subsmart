<div class="row edit-container-modules mt-4" style="<?= array_key_exists('access-all', $groupRoleAccessModules) ? 'display:none;' : ''; ?>">
    <div class="col-md-12">
        <div class="container-header" style="background-color:#ffffff !important;">
            <h3>&nbsp;</h3>
            <div class="form-check text-end chk-row-allow-all-modules">
                <input class="form-check-input chk-all-modules" id="edit-modules-all" name="roleWidgets[]" value="1" type="checkbox" />
                <label class="form-check-label" for="edit-modules-all">Allow all modules</label>
            </div>
        </div>
    </div>
    <?php foreach( $modules as $key => $module ){ ?>
    <div class="col-md-6">
        <div class="container-header">
            <h3><?= $module; ?></h3>
            <div class="form-check text-end chk-row-allow-all">
                <input class="form-check-input edit-module-check-input edit-chk-all-rights" data-module="<?= $key; ?>" type="checkbox" id="edit-chk-all-<?= $key; ?>">
                <label class="form-check-label" for="edit-chk-all-<?= $key; ?>">Allow all</label>
            </div>
        </div>
        <?php 
            $is_read_allowed = '';
            if( array_key_exists($key, $groupRoleAccessModules) ){
                if( $groupRoleAccessModules[$key]->allow_read == 1 ){
                    $is_read_allowed = 'checked="checked"';
                }
            }

            $is_write_allowed = '';
            if( array_key_exists($key, $groupRoleAccessModules) ){
                if( $groupRoleAccessModules[$key]->allow_write == 1 ){
                    $is_write_allowed = 'checked="checked"';
                }
            }

            $is_delete_allowed = '';
            if( array_key_exists($key, $groupRoleAccessModules) ){
                if( $groupRoleAccessModules[$key]->allow_delete == 1 ){
                    $is_delete_allowed = 'checked="checked"';
                }
            }
        ?>
        <ul class="module-permissions">
            <li>
                <div class="form-check">                    
                    <input class="form-check-input edit-module-check-input edit-chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key ?>][read]" value="1" id="edit-chk-read-<?= $key; ?>" <?= $is_read_allowed; ?>>
                    <label class="form-check-label" for="edit-chk-read-<?= $key; ?>">Read</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input class="form-check-input edit-module-check-input edit-chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key ?>][write]" value="1" id="edit-chk-write-<?= $key; ?>" <?= $is_write_allowed; ?>>
                    <label class="form-check-label" for="edit-chk-write-<?= $key; ?>">Write</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input class="form-check-input edit-module-check-input edit-chk-<?= $key; ?>-rights" type="checkbox" name="permission[<?= $key ?>][delete]" value="1" id="edit-chk-delete-<?= $key; ?>" <?= $is_delete_allowed; ?>>
                    <label class="form-check-label" for="edit-chk-delete-<?= $key; ?>">Delete</label>
                </div>
            </li>
        </ul>
    </div>
    <?php } ?>
</div>
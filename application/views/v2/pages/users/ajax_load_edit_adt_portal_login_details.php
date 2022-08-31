<div class="row gy-3 mb-4">
    <input type="hidden" name="uid" value="<?= $uid; ?>">
    <div class="col-12">
        <label class="content-title">ADT Sales App Login Details</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Username</label>
        <div class="nsm-field-group icon-right">
            <input type="text" class="nsm-field form-control" value="<?= $userPortalAccess ? $userPortalAccess->username : ''; ?>" id="edit_portal_username" name="portal_username" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Password</label>
        <div class="nsm-field-group show icon-right">
            <input type="password" class="nsm-field form-control password-field" value="<?= $userPortalAccess ? $userPortalAccess->password_plain : ''; ?>" id="edit_portal_password" name="portal_password" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Confirm Password</label>
        <div class="nsm-field-group show icon-right">
            <input type="password" class="nsm-field form-control password-field" id="edit_portal_confirm_password" name="portal_confirm_password" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="formGroupExampleInput" class="form-label">Role</label>
        <select class="form-control select-roles" name="role" readonly>
            <?php foreach($roles as $key => $role){ ?>
                <?php if( $key != 7 ){ //Remove admin ?>
                <option value="<?= $key; ?>" <?= $rid == $key ? 'selected="selected"' : ''; ?>><?= $role['name']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
    <div class="col">
        <label for="formGroupExampleInput" class="form-label">Access Type</label>
        <select class="form-control edit-select-access-type" name="access_type">
            <option value="access-all" <?= array_key_exists('access-all', $groupRoleAccessModules) ? 'selected="selected"' : ''; ?>>Access All</option>
            <option value="define-access" <?= !array_key_exists('access-all', $groupRoleAccessModules) ? 'selected="selected"' : ''; ?>>Define Access</option>
        </select>
    </div>
</div>
<div class="nsm-page-nav mt-4 edit-grp-role-access" style="<?= array_key_exists('access-all', $groupRoleAccessModules) ? 'display:none;' : ''; ?>">
    <ul>
        <li class="edit-li-tab active">
            <a class="nsm-page-link edit-role-access-tab" data-type="widgets" href="javascript:void(0);">
                <i class='bx bx-fw bxs-widget'></i>
                <span>Widgets</span>
            </a>
        </li>
        <li class="edit-li-tab">
            <a class="nsm-page-link edit-role-access-tab" data-type="modules" href="javascript:void(0);">
                <i class='bx bx-fw bx-windows'></i>
                <span>Modules</span>
            </a>
        </li>
        <li><label></label></li>
    </ul>
</div>

<div class="edit-grp-role-access" style="<?= array_key_exists('access-all', $groupRoleAccessModules) ? 'display:none;' : ''; ?>">
    <div class="edit-module-list-group" style="display:none;">
        <?php include viewPath('v2/pages/users/access_role_modules/_edit_modules_list'); ?>
    </div>
    <div class="edit-widget-list-group" >
        <?php include viewPath('v2/pages/users/access_role_modules/_edit_widget_list'); ?>
    </div>
</div>

<script>
$(function(){
    $('.edit-chk-all-rights').on('change', function(){
        var module = $(this).attr('data-module');
        if( $(this).is(':checked') ){
            $('.edit-chk-'+module+'-rights').prop('checked', true);
        }else{
            $('.edit-chk-'+module+'-rights').prop('checked', false);
        }
    });

    $('.edit-widget-list-group .chk-all-widgets').on('change', function(){
        if( $(this).is(':checked') ){
            $('.edit-widget-list-group .chk-widgets').prop('checked', true);
        }else{
            $('.edit-widget-list-group .chk-widgets').prop('checked', false);
        }
    });

    $('.edit-role-access-tab').on('click', function(){
        var type = $(this).attr('data-type');

        if( type == 'modules' ){
            $('.edit-module-list-group').show();
            $('.edit-widget-list-group').hide();
        }else{
            $('.edit-widget-list-group').show();
            $('.edit-module-list-group').hide();
        }

        $('.edit-li-tab').removeClass('active');
        $(this).parent('.edit-li-tab').addClass('active');
    });

    $('.edit-select-access-type').on('change', function(){
        var selected = $(this).val();
        if( selected == 'access-all' ){
            $('.edit-grp-role-access').hide();
            //$('.edit-container-modules').hide();            
        }else{
            $('.edit-grp-role-access').show();
            //$('.edit-container-modules').show();
        }
    });

    $('#edit-modules-all').on('change', function(){
        if( $(this).is(':checked') ){
            $('.edit-module-check-input').prop('checked', true);
        }else{
            $('.edit-module-check-input').prop('checked', false);
        }
    });

    $('.edit-chk-all-rights').on('change', function(){
        var module = $(this).attr('data-module');
        if( $(this).is(':checked') ){
            $('.edit-chk-'+module+'-rights').prop('checked', true);
        }else{
            $('.edit-chk-'+module+'-rights').prop('checked', false);
        }
    });
});
</script>
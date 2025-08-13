<?php include viewPath('v2/includes/header'); ?>
<style>
#add_employee_modal .custom-header, #edit_employee_modal .custom-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
    display:block;
}
.swal2-html-container{
    overflow:hidden;
}
.user-change-status{
    text-align:left;
}
.btn-nsm, .btn-nsm:hover {
    background-color: #6a4a86;
    color: #ffffff;
}
#tbl-users-list .nsm-badge{
    font-size: 12px;
    display: block;
    width: 100%;
    text-align: center;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
    <ul class="nsm-fab-options">        
        <li data-bs-toggle="modal" data-bs-target="#add_employee_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Employee</span>
        </li>
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export List</span>
        </li>
        <li id="btn-mobile-archived">
            <div class="nsm-fab-icon">
                <i class='bx bx-archive'></i>
            </div>
            <span class="nsm-fab-label">Archived</span>
        </li>          
    </ul>
    <?php } ?>      
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage Employees.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Employee">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-change-status" href="javascript:void(0);" data-action="change-status">Change Status</a></li>   
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-add-employee"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Employee</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                                    <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="tbl-users-list">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="User">User</td>
                            <td data-name="Email">Employee Number</td>
                            <td data-name="Mobile">Mobile</td>
                            <?php if ($show_pass == 1) : ?>
                                <td data-name="Password">Password</td>
                            <?php endif; ?>
                            <td data-name="Title">Title</td>
                            <td data-name="Rights">Role</td>
                            <td data-name="Last Login">Last Login</td>
                            <td data-name="Status" style="width:5%;">Status</td>
                            <td data-name="App Access" style="width:6%;">App Access</td>
                            <td data-name="Web Access" style="width:6%;">Web Access</td>
                            <td data-name="Manage" style="width:2%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($users)) :
                        ?>
                            <?php
                            foreach ($users as $cnt => $row) :
                            ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="users[]" type="checkbox" value="<?= $row->id; ?>">
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <?php
                                        if ($row->profile_img != '') {
                                            $data_img = $row->profile_img;
                                        } else {
                                            $data_img = 'default.png';
                                        }
                                        ?>
                                        <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($row->id); ?>');" data-img="<?php echo $data_img; ?>"></div>
                                    </td>
                                    <td class="nsm-text-primary show">
                                        <label class="d-block fw-bold"><?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?></label>
                                        
                                        <label class="content-subtitle d-block"><i class='bx bx-envelope' style="position:relative;top:1px;"></i><?php echo $row->email ?></label>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->employee_number != '' && $row->employee_number != '-') {
                                            $employee_number = $row->employee_number;
                                        } else {
                                            $employee_number = '---';
                                        }
                                        ?>
                                        <?= $employee_number; ?>
                                    </td>
                                    <td><?php echo $row->mobile != '' ? formatPhoneNumber($row->mobile) : '---'; ?></td>
                                    <?php if ($show_pass == 1) : ?>
                                        <td><?php echo $row->password_plain ?></td>
                                    <?php endif; ?>
                                    <td><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                                    <td><?php echo getUserType($row->user_type); ?></td>
                                    <td><?php echo date('m/d/Y', strtotime($row->last_login)); ?></td>
                                    <td>
                                        <?php
                                        if ($row->status == 1) :
                                            $status = "Active";
                                            $badge = "success";
                                        else :
                                            $status = "Inactive";
                                            $badge = "";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->has_app_access == 1) :
                                            $status = "Yes";
                                            $badge = "success";
                                        else :
                                            $status = "No";
                                            $badge = "error";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->has_web_access == 1) :
                                            $status = "Yes";
                                            $badge = "success";
                                        else :
                                            $status = "No";
                                            $badge = "error";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" name="btn_view" href="<?php echo url('users/view/' . $row->id) ?>" data-id="<?php echo $row->id ?>">View</a>
                                                </li>
                                                <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                                    <li>
                                                        <a class="dropdown-item edit-item" name="btn_edit" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Edit</a>
                                                    </li>                                                
                                                    <!-- <li>
                                                        <a class="dropdown-item commissions-list" name="" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Commissions</a>
                                                    </li> -->
                                                    <li>
                                                        <a class="dropdown-item update-profile-item" name="btn_update_profile_image" href="javascript:void(0);" data-id="<?php echo $row->id ?>" data-img="<?php echo $data_img; ?>">Update Profile Image</a>
                                                    </li>                                                
                                                    <?php if(isSolarCompany() == 1){ ?>
                                                        <li>
                                                            <a class="dropdown-item change-adt-portal-access" name="btn_adt_portal_access" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Set ADT Portal Access</a>
                                                        </li>
                                                    <?php } ?>
                                                    <li>
                                                        <a class="dropdown-item change-password-item" name="btn_change_pw" href="javascript:void(0);" data-name="<?php echo $row->FName . ' ' . $row->LName; ?>" data-id="<?php echo $row->id ?>">Change Password</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('users', 'delete')){ ?>
                                                    <?php if ($row->id != 1 && logged('id') != $row->id) : ?>
                                                        <li>
                                                            <a class="dropdown-item delete-item" data-name="<?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?>" name="btn_delete" href="javascript:void(0);" data-id="<?= $row->id; ?>">Delete</a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="12">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/users/users_modals'); ?>
<?php include viewPath('v2/pages/users/js/list'); ?>
<?php include viewPath('v2/includes/footer'); ?>
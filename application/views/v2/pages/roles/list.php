<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/modal_forms/job_title_modal'); ?>

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
                            <button><i class='bx bx-x'></i></button>
                            Manage Job Titles.
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-12 col-md-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Job Title" value="">
                        </div>
                     </div> 
                     <div class="col-12 col-md-6 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">  
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>  

                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-new-job-title"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Job Title</button>
                            <?php } ?>
                        </div>
                     </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                              <form id="frm-with-selected">
                              <table id="roles-table" class="nsm-table w-100">
                                 <thead>
                                    <tr>
                                       <td class="table-icon text-center show">
                                          <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                       </td>
                                       <td class="table-icon show"></td>
                                       <td class="show" data-name="Job Title" style="width:35%;">Name</td>
                                       <td data-name="Manage"></td>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (!empty($roles)) { ?>
                                       <?php foreach ($roles as $r) { ?>
                                       <tr>
                                          <td style="text-align:center;">
                                             <?php if( $r->company_id > 0 ){ ?>
                                             <input class="form-check-input row-select table-select" name="roles[]" type="checkbox" name="id_selector" value="<?= $r->id; ?>">
                                             <?php } ?>
                                          </td>
                                          <td>
                                             <div class="table-row-icon">
                                                <i class='bx bx-briefcase-alt-2'></i>
                                             </div>
                                          </td>
                                          <td class="fw-bold nsm-text-primary show"><?= $r->title; ?></td>
                                          <td>
                                                <?php if( $r->company_id > 0 ){ ?>
                                                <div class="dropdown table-management">
                                                   <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                                   <ul class="dropdown-menu dropdown-menu-end">                                                      
                                                      <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                                      <li><a class="dropdown-item btn-row-edit" name="btn_edit" href="javascript:void(0);" data-title="<?= $r->title; ?>" data-id="<?= $r->id; ?>">Edit</a></li>   
                                                      <?php } ?>
                                                      <?php if(checkRoleCanAccessModule('users', 'delete')){ ?>
                                                      <li><a class="dropdown-item btn-row-delete" href="javascript:void(0);" data-title="<?= $r->title; ?>" data-id="<?= $r->id; ?>">Delete</a></li>
                                                      <?php } ?>                                                      
                                                   </ul>
                                                </div>
                                                <?php } ?>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                    <?php }else{ ?>
                                       <tr>
                                          <td colspan="4">
                                                <div class="nsm-empty">
                                                   <span>No results found</span>
                                                </div>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                              </form>
                           </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/pages/roles/js/list'); ?>
<?php include viewPath('v2/includes/footer'); ?>
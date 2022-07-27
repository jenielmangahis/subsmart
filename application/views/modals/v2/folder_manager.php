<style>
 .vaultContainer { padding: 5px 20px !important; }
 .treeview .list-group-item{cursor:pointer}
 .treeview span.indent{margin-left:10px;margin-right:10px}
 .treeview span.icon{width:12px;margin-right:5px}
 .treeview .node-disabled{color:silver;cursor:not-allowed}
 .node-folders_treeview:not(.node-disabled):hover{background-color:#F5F5F5;}
 .page-title, .box-title {
   font-family: Sarabun, sans-serif !important;
   font-size: 1.75rem !important;
   font-weight: 600 !important;
   padding-top: 5px;
 }
 .pr-b10 {
   position: relative;
   bottom: 10px;
 }
 .p-40 {
   padding-top: 40px !important;
 }
 .p-20 {
   padding-top: 25px !important;
   padding-bottom: 25px !important;
   padding-right: 20px !important;
   padding-left: 20px !important;
 }
 @media only screen and (max-width: 600px) {
   .p-40 {
     padding-top: 0px !important;
   }
   .pr-b10 {
     position: relative;
     bottom: 0px;
   }
 }
 
</style>

<link rel="stylesheet" href="<?=base_url('assets/css/esign/esign.css');?>" type="text/css">
<?php if (!$isMain) {?>
<div id="modal-folder-manager" class="modal" role="dialog">
  <div class="modal-dialog" style="max-width: 1500px">

    <!-- Modal content-->
    <div class="modal-content" style="height: 90vh">
      <div class="modal-header" id="modal-folder-manager-title-div">
        <h4 id="modal-folder-manager-title" class="modal-title">File Vault</h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"> <i class="bx bx-fw bx-x m-0"></i> </button>
      <div class="modal-body" style="padding: 1rem !important">
<?php }?>
        <?php
$default_tag = 'Welcome ' . $company_name;

if ($isMyLibrary) {
    $default_tag = 'Hello ' . $user_fname . ' ' . $user_lname;
    ?>
          <input type="hidden" id="vault_type" value="mylibrary" />
        <?php } else if ($isBusinessFormTemplates) {?>
          <input type="hidden" id="vault_type" value="businessformtemplates" />
        <?php } else {?>
          <input type="hidden" id="vault_type" value="sharedlibrary" />
        <?php }?>

        <div class="vaultContainer">

        <div class="nsm-page-nav mb-3">
          <ul>
              <li data-controller="mylibrary">
                  <a class="nsm-page-link" href="<?php echo base_url('vault_v2/mylibrary') ?>">
                      <span>My Library</span>
                  </a>
              </li>
              <li data-controller="index">
                  <a class="nsm-page-link" href="<?php echo base_url('vault_v2') ?>">
                      <span>Shared Library</span>
                  </a>
              </li>
              <li data-controller="businessformtemplates">
                  <a class="nsm-page-link" href="<?php echo base_url('vault_v2/businessformtemplates') ?>">
                      <span>Business Form Templates</span>
                  </a>
              </li>
              <li>
                  <a class="nsm-page-link" href="<?php echo base_url('vault_v2/beforeafter') ?>">
                      <span>Photos Gallery</span>
                  </a>
              </li>

              <!-- Do not remove the last li -->
              <li><label></label></li>
          </ul>
        </div>

        <div class="vault__header">

          <?php if ($isMyLibrary): ?>
            <div class="nsm-callout primary" role="alert">
              <button><i class="bx bx-x"></i></button>
              My Library is a place where you can quickly find and access all of your files, content, and customer information from anywhere, on any device. Create specific or general folders to better categorized your files for quicker access. Format to includes are PDF, DOC, JPEG, GIF, CSV and much more. It is your private storage area for you documents.
            </div>

          <?php elseif ($isBusinessFormTemplates): ?>
            <div class="nsm-callout primary" role="alert">
              <button><i class="bx bx-x"></i></button>
              Our archive of business forms include over 1000 commonly used templates to start, plan, organize, manage, finance and grow your business.
            </div>

          <?php else: ?>
            <div class="nsm-callout primary" role="alert">
              <button><i class="bx bx-x"></i></button>
              Store, share, and manage the company's shared files in this location so you can decide who has access to files in each folder and what permissions they have. Here in Shared Library each user can share their personal files to be used and viewed by others team member. Each org can have up to 100 libraries.
            </div>

          <?php endif;?>

          <div class="esignActionRequired alert alert-primary">
            <div class="esignActionRequired__inner">
              <i class="fa fa-info-circle esignActionRequired__icon"></i>
              <a class="esignActionRequired__body" href="<?php echo base_url('eSign/manage?view=action_required') ?>">
                Your action is required for <span class="esignActionRequired__count">0</span> of your eSign documents.
              </a>
            </div>
          </div>

        </div>

          <div class="pb-0">
            <div class="row">
                <div class="col-md-6">
                  <h5 id="folders_name">
                    <?php echo $default_tag; ?>
                  </h5>
                  <p id="folders_path"></p>
                </div>
                <div class="col-md-6 align-middle">
                  <div class="table-responsive mb-0">
                    <table class="table table-borderless m-0">
                      <tbody>
                        <tr>
                          <td class="p-0 pb-1">
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1" control="set_g_permission" title="Set General Permissions"><i class="fa fa-universal-access"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['trash_folder_file'] == 1) ? '' : 'd-none'); ?>" control="delete" title="Trash Folder/File"><i class="fa fa-trash"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['move_folder_file'] == 1) ? '' : 'd-none'); ?>" control="move" title="Move Folder/File"><i class="fa fa-scissors"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['edit_folder_file'] == 1) ? '' : 'd-none'); ?>" control="edit" title="Edit Folder/File"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['add_file'] == 1) ? '' : 'd-none'); ?>"" control="drop_to_upload" title="Drop to Upload"><i class="fa fa-cloud-upload" title="Drop to Upload"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['add_file'] == 1) ? '' : 'd-none'); ?>" control="add_file" title="Add File">
                             <img width="17px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAgklEQVRIieWU0QqAIAxFj9HHVV/VY9+p/Uc9BQbTnEOwurCXMe+ZGwpf1AIE4HiItRZQYm6ClJpfsbUGqCE1ABWkFiBCXAJg0c1zqDgsNZWUFqBWc8BYUCONJM5ld9bFDeIOnZDL6h9LjqV+hO8fkQTYDX6hpGgGPPqf1AOToblOdQKtNGIZcCZ1AQAAAABJRU5ErkJggg=="/>
                            </a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1 <?php echo (($permissions['create_folder'] == 1) ? '' : 'd-none'); ?>" control="create_folder" title="Create Folder"><i class="fa fa-folder"></i></a>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-0 pb-1">
                          <?php if ($isBusinessFormTemplates) {?>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1" control="category_entry" title="Category Entry"><i class="fa fa-list-ul"></i></a>
                          <?php }?>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1" control="recycle" title="Recycle Bin"><i class="fa fa-recycle" title="Recycle Bin"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1" control="search" title="Search File/Folder"><i class="fa fa-search" title="Search File/Folder"></i></a>
                            <a href="#" class="nodecontrol nsm-button pull-right ml-1" control="view" title="View Details"><i class="fa fa-eye" title="View Details"></i></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <div class="row table-danger pt-1 pb-1 d-none" id="move_details">
              <div class="col-md-9">
                <p class="align-middle" style="margin-bottom: 0 !important">Move <span id="move_f_tag"></span> &ensp;<strong id="move_f_text"></strong></p>
              </div>
              <div class="col-md-3 text-right">
                <button type="button" class="btn btn-sm btn-default" id="move_proceed">Move Here</button>
                <button type="button" class="btn btn-sm btn-default" id="move_cancel">Cancel</button>
              </div>
            </div>
          </div>
          <div class="card-body" style="<?php if (!$isMain) {echo 'height: 64vh !important; overflow: auto';}?>">
            <div id="docusign_templates"></div>
            <div id="quick_access"></div>
            <div id="folders_and_files"></div>
            <?php if (((!$isMyLibrary) && (!$isBusinessFormTemplates)) || ((!$isMyLibrary) && (!$isBusinessFormTemplates) && ($isMain))) {?>
              <!-- <div class="mt-5">
                <div class="row">
                  <div class="col-md-4 border">
                    <h6>Top 10 Most Downloads<span class="fa fa-refresh ml-2" control="refresh_tops" target="most_downloads" title="Reload Top 10 Most Downloads"></span><span class="float-right">Count</span></h6>
                    <ul class="list-group list-group-flush" id="most_downloads">
                    </ul>
                  </div>
                  <div class="col-md-4 border">
                    <h6>Top 10 Most Previews<span class="fa fa-refresh ml-2" control="refresh_tops" target="most_previews" title="Reload Top 10 Most Previews"></span><span class="float-right">Count</span></h6>
                    <ul class="list-group list-group-flush" id="most_previews">
                    </ul>
                  </div>
                  <div class="col-md-4 border">
                    <h6>Most Recent Uploads<span class="fa fa-refresh ml-2" control="refresh_tops" target="recent_uploads" title="Reload Most Recent Uploads"></span><span class="float-right">Days since uploaded</span></h6>
                    <ul class="list-group list-group-flush" id="recent_uploads">
                    </ul>
                  </div>
                </div>
              </div> -->
            <?php }?>
          </div>
        </div>

<?php if (!$isMain) {?>
      </div>
    </div>

  </div>
</div>
<?php }?>

<div id="modal-folder-manager-entry" class="modal fade nsm-modal" role="dialog">
  <div class="modal-dialog" id="modal-folder-manager-entry-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="mfme-modal-content">
      <div class="modal-header">
        <h4 id="modal-folder-manager-entry-title" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="d-none w-100" id="folder_entry">
            <div class="col-md-12 form-group mb-2">
              <label for="folder_name">Folder Name<small> Set name of the folder</small></label>
              <input type="text" class="form-control" name="folder_name" id="folder_name" placeholder="Enter Folder Name" required autofocus />
            </div>
            <div class="col-md-12 form-group mb-2">
              <label for="folder_desc">Description<small> Details about the folder(Max of 255 characters)</small></label>
              <input type="text" class="form-control" name="folder_desc" id="folder_desc" placeholder="Enter Folder Description" maxlength="255" autofocus />
            </div>
          </div>
          <div class="d-none w-100" id="file_entry">
            <div class="col-md-12 form-group mb-2 d-none" id="div_file_path_display">
              <label for="file_path_display">Original File</label>
              <input type="text" class="form-control" name="file_path_display" id="file_path_display" filetitle="" readonly/>
            </div>
            <div class="col-md-12 form-group mb-2">
              <label for="fullfile">Select File<small> (Allowed type: pdf, doc, docx, rtf, png, jpg, gif. Max size 8MB.)</small></label>
              <input type="file" class="form-control" name="fullfile" id="fullfile" placeholder="Upload File" accept=".gif, .jpeg, .jpg, .png, .doc, .rtf, .docx, .pdf" required>
            </div>
            <div class="col-md-12 form-group mb-2">
              <label for="file_desc">Description<small> Details about the file(Max of 255 characters)</small></label>
              <input type="text" class="form-control" name="file_desc" id="file_desc" placeholder="Enter File Description" maxlength="255" autofocus />
            </div>
          </div>
          <?php if ($isBusinessFormTemplates) {?>
            <div class="d-none w-100" id="category_entry">
              <div class="col-md-12 form-group mb-2">
                <label for="category_name">Category Name<small> Set name of the category</small></label>
                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" required autofocus />
              </div>
              <div class="col-md-12 form-group mb-2">
                <label for="category_desc">Description<small> Details about the category(Max of 255 characters)</small></label>
                <input type="text" class="form-control" name="category_desc" id="category_desc" placeholder="Enter Category Description" maxlength="255" autofocus />
              </div>
            </div>
            <div class="w-100" id="category_selection">
              <div class="col-md-12 form-group mb-2">
                <label for="categories">Categories<small> Select category to put the file/folder</small></label>
                <select class="form-control" name="f_category" id="f_category">
                  <option value="">Select Category</option>
                  <?php
foreach ($categories as $category) {
    ?>
                    <option value="<?php echo $category->category_id; ?>" catdesc="<?php echo $category->category_desc; ?>"><?php echo $category->category_name; ?></option>
                <?php }?>
                </select>
              </div>
            </div>
            <div class="w-100 text-center d-none" id="category_controls">
              <button type="button" class="btn btn-default bft-btn-control border-info" id="btn-modal-folder-manager-entry-create-category">Create</button>
              <button type="button" class="btn btn-default bft-btn-control" id="btn-modal-folder-manager-entry-edit-category">Edit</button>
              <button type="button" class="btn btn-default bft-btn-control" id="btn-modal-folder-manager-entry-delete-category">Delete</button>
            </div>
          <?php }?>
          <div class="d-none w-100" id="general_permissions_entry">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-7" style="height: 66vh; overflow: auto">
                  <div class="card">
                    <div class="card-header">
                      <strong>Roles</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered" id="gpe_table_roles" tablefunc="getrolepermissions">
                        <thead>
                          <th class="d-none"></th>
                          <th class="d-none"></th>
                          <th class="font-weight-bold">Title</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <strong>Users</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered" id="gpe_table_users" tablefunc="getuserpermissions">
                        <thead>
                          <th class="d-none"></th>
                          <th class="d-none"></th>
                          <th class="font-weight-bold">Name</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="card">
                    <div class="card-header">
                      <strong>Permissions</strong>
                    </div>
                    <div class="card-body">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_create_folder" type="checkbox" class="form-check-input" value="">Create Folder
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_add_file" type="checkbox" class="form-check-input" value="">Add File
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_edit_folder_file" type="checkbox" class="form-check-input" value="">Edit Folder/File
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_move_folder_file" type="checkbox" class="form-check-input" value="">Move Folder/File
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_trash_folder_file" type="checkbox" class="form-check-input" value="">Trash Folder/File
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input id="gpec_remove_folder_file" type="checkbox" class="form-check-input" value="">Remove Folder/File
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="nsm-button" id="btn-modal-folder-manager-entry-cancel">Cancel</button>
        <button type="button" class="nsm-button primary" id="btn-modal-folder-manager-entry-save">Save</button>
      </div>
    </div>
  </div>
</div>

<div id="modal-folder-manager-alert" class="modal fade nsm-modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="modal-folder-manager-alert-title-div">
        <h4 id="modal-folder-manager-alert-title" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p id="modal-folder-manager-alert-text"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default d-none" id="btn-modal-folder-manager-alert-ok">OK</button>
        <button type="button" class="btn btn-default d-none" id="btn-modal-folder-manager-alert-confirm">Confirm</button>
        <button type="button" class="btn btn-default d-none" id="btn-modal-folder-manager-alert-cancel">Cancel</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-uploading" class="modal fade nsm-modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <h5 id="modal-folder-manager-uploading-title"></h5>
            <span><small>Please do not close the browser or tab</small></span>
          </div>
          <div class="col-md-3">
            <h5 id="modal-folder-manager-uploading-percentage" class="pull-right"></h5>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-view-image" class="modal fade nsm-modal" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content" style="height: 90vh">
      <div class="modal-header">
        <h4 id="modal-folder-manager-view-image-title"></h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body pt-3">
        <table class="table table-bordered border border-0">
          <tbody>
            <tr class="row ml-0 mr-0">
              <td class="col-md-2 text-center font-weight-bold">Date Uploaded : </td>
              <td class="text-center col-md-3" id="view-image-date-created"></td>
              <td class="col-md-2 text-center font-weight-bold">Uploaded By : </td>
              <td class="text-center col-md-3" id="view-image-created-by"></td>
              <td class="col-md-2 border border-0 text-right pt-0">
                <a href="#" class="btn btn-sm btn-default" control="download" title="Download File" data-toggle="tooltip" id="download_image_or_file"><i class="fa fa-download"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div style="height: 70vh"><img id="modal-folder-manager-view-image-file" src="#" class="img-thumbnail w-100 h-100"></div>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-view-folder" class="modal fade nsm-modal" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modal-folder-manager-view-folder-title"></h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body pt-3">
        <ul class="list-group mb-3">
          <li class="list-group-item"><strong>Path : </strong><span id="view-folder-path"></span></li>
          <li class="list-group-item"><strong>Date Created : </strong><span id="view-folder-date-uploaded"></span></li>
          <li class="list-group-item"><strong>Created By : </strong><span id="view-folder-uploaded-by"></span></li>
        </ul>
        <div id="download_div" class="d-none">
          <a href="#" class="btn btn-sm btn-default pull-right" control="download" title="Download File" data-toggle="tooltip"><i class="fa fa-download"></i></a>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-search" class="modal fade nsm-modal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Search File/Folder</h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
      </div>
      <div class="modal-body pt-3">
        <div class="card">
          <div class="card-header">
            <form class="form-inline">
              <input type="text" class="form-control" placeholder="Input Keyword" id="modal-folder-manager-search-keyword">
              <div class="form-check ml-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="modal-folder-manager-search-check-folder" checked> Find Folder(s)
                </label>
              </div>
              <div class="form-check ml-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="modal-folder-manager-search-check-file" checked> Find File(s)
                </label>
              </div>
              <button type="button" class="btn btn-primary ml-3" id="btn-modal-folder-manager-search"><i class="fa fa-search">&ensp;Search</i></button>
            </form>
          </div>
          <div class="card-body">
            <div id="accordion">

              <div class="card" id="search_folders_section">
                <div class="card-header">
                  <a class="card-link" data-bs-toggle="collapse" href="#div_search_table_folders">
                    <i class="fa fa-plus mr-2"></i>Folders
                  </a>
                </div>
                <div id="div_search_table_folders" class="collapse">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="search_table_folders" class="table table-bordered table-sm">
                        <thead>
                          <tr>
                            <th class="d-none">Folder Id</th>
                            <th>Folder Path</th>
                            <th>Folder Name</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card" id="search_files_section">
                <div class="card-header">
                  <a class="collapsed card-link" data-bs-toggle="collapse" href="#div_search_table_files">
                    <i class="fa fa-plus mr-2"></i>Files
                  </a>
                </div>
                <div id="div_search_table_files" class="collapse">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="search_table_files" class="table table-bordered table-sm">
                        <thead>
                          <tr>
                            <th class="d-none">Folder Id</th>
                            <th>File Path</th>
                            <th>File Name</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-recycle-bin" class="modal fade nsm-modal" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 1500px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Recycle Bin</h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
      </div>
      <div class="modal-body pt-2">
          <div class="row mb-4 pt-2 pb-2" style="background-color: rgba(0,0,0,.03)">
            <div class="col-md-8">
              <h6 id="recycle_bin_selected_name" class="mb-0 mt-0">No Folder/File Selected</h6>
              <small id="recycle_bin_selected_path">/../</small>
            </div>
            <div class="col-md-4">
              <ul class="nav justify-content-end">
                <li class="nav-item">
                  <a href="#" class="nodecontrol btn btn-sm btn-default nav-link mr-1" control="restore" title="Restore"><i class="fa fa-recycle" title="Restore"></i></a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nodecontrol btn btn-sm btn-default nav-link mr-1 <?php echo (($permissions['remove_folder_file'] == 1) ? '' : 'd-none'); ?>" control="remove" title="Remove"><i class="fa fa-remove" title="Remove"></i></a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nodecontrol btn btn-sm btn-default nav-link mr-1 <?php echo (($permissions['remove_folder_file'] == 1) ? '' : 'd-none'); ?>" control="empty" title="Empty"><i class="fa fa-trash-o" title="Empty"></i></a>
                </li>
              </ul>
            </div>
        </div>
        <div id="recycle_bin">
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .tmp_mfm_dtu_height{
    height: 50vh
  }
</style>


  <div id="mfm-dtu" class="modal fade nsm-modal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Drop To Upload</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-md-5 form-group">
                <label for="folder-dtu">Drop to Folder</label>
                <div class="bg-light" name="f_folder_name" id="f_folder_name">
                </div>
              </div>
              <?php if ($isBusinessFormTemplates) {?>
                <div class="col-md-7 form-group">
                  <label for="f_category">Categories<small> Select category to put the file/folder</small></label>
                  <select class="form-control" name="dtu_f_category" id="dtu_f_category">
                    <option value="">Select Category</option>
                    <?php
foreach ($categories as $category) {
    ?>
                      <option value="<?php echo $category->category_id; ?>" catdesc="<?php echo $category->category_desc; ?>"><?php echo $category->category_name; ?></option>
                  <?php }?>
                  </select>
                </div>
              <?php }?>
          </div>
          <div class="tmp_mfm_dtu_height align-items-center justify-content-center" style="border: #999 5px dashed; display: flex;" ondrop="displayDroppedFiles(event)" ondragover="return false" id="mfm-dtu-drop-area">
            <div>
              <h5 class="text-center">Drop File(s) Here to Upload</h5>
              <p class="text-center text-muted">Allowed type: pdf, doc, docx, rtf, png, jpg, gif. Max size 8MB.</p>
            </div>
          </div>
          <div id="mfm-dtu-file-list-area" class="d-none table-responsive">
            <table class="table table-bordered table-sm" id="mfm-dtu-file-list">
              <thead>
                <tr>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th style="width: 30%" class="font-weight-bold">File Name</th>
                  <th style="width: 63%" class="font-weight-bold">Status</th>
                  <th style="width: 7%"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <h6 id="upload_counter" class="d-none">Uploading . . . 0/0</h6>
          <button type="button" class="btn btn-default" id="upload_dropped_files">Upload</button>
          <button type="button" class="btn btn-default" id="clear_dropped_files" onclick="clearDroppedFiles()">Reset</button>
          <button type="button" class="btn btn-default" id="cancel_dropped_files">Done</button>
        </div>
      </div>

    </div>
  </div>

<script>
window.addEventListener('DOMContentLoaded', async (event) => {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const response = await fetch(`${prefixURL}/DocuSign/apiGetActionRequired`);
  const { data } = await response.json();

  if (data.length === 0) return;

  const $alert = document.querySelector(".esignActionRequired");
  const $count = $alert.querySelector(".esignActionRequired__count");
  $count.textContent = data.length;
  $alert.classList.add("esignActionRequired--show");
});
</script>
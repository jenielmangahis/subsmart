<style>

 .treeview .list-group-item{cursor:pointer}
 .treeview span.indent{margin-left:10px;margin-right:10px}
 .treeview span.icon{width:12px;margin-right:5px}
 .treeview .node-disabled{color:silver;cursor:not-allowed}
 .node-folders_treeview{}
 .node-folders_treeview:not(.node-disabled):hover{background-color:#F5F5F5;} 

</style>
<?php if(!$isMain){ ?>
<div id="modal-folder-manager" class="modal" role="dialog">
  <div class="modal-dialog" style="max-width: 1500px">

    <!-- Modal content-->
    <div class="modal-content" style="height: 90vh">
      <div class="modal-header" id="modal-folder-manager-title-div">
        <h4 id="modal-folder-manager-title" class="modal-title">File Vault</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding: 1rem !important">
<?php } ?>

        <div class="card">
          <div class="card-header">        
            <div class="row">
                <div class="col-md-6">
                  <h5 id="folders_name">Root</h5>
                  <p id="folders_path"></p>
                </div>
                <div class="col-md-6 align-middle">
                  <div class="table-responsive mb-0">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td class="p-0 pb-1">
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="edit_permission" title="Edit Permission"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="delete" title="Trash Folder/File"><i class="fa fa-trash"></i></a>
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="add_file" title="Add File"><i class="fa fa-file"></i></a>
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="create_folder" title="Create Folder"><i class="fa fa-plus"></i></a>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-0 pb-1">
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="view" title="View Details"><i class="fa fa-eye" title="View Details"></i></a>
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="search" title="Search File/Folder"><i class="fa fa-search" title="Search File/Folder"></i></a>
                            <a href="#" class="nodecontrol btn btn-sm btn-default pull-right" control="recycle" title="Recycle Bin"><i class="fa fa-recycle" title="Recycle Bin"></i></a>
                          </td>  
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div> 
            </div>
          </div>
          <div class="card-body" style="<?php if(!$isMain){ echo 'height: 64vh !important; overflow: auto'; } ?>">
            <div id="folders_and_files">
                
            </div>
            <div class="mt-5">
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
            </div>
          </div>
        </div>

<?php if(!$isMain){ ?>    
      </div>
    </div>

  </div>
</div>
<?php } ?>

<div id="modal-folder-manager-entry" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 id="modal-folder-manager-entry-title" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="row d-none" id="folder_entry">
          <div class="col-md-12 form-group">
            <label for="folder_name">Folder Name<small> Set name of the folder</small></label>
            <input type="text" class="form-control" name="folder_name" id="folder_name" placeholder="Enter Folder Name" required autofocus />
          </div>
          <div class="col-md-12 form-group">
            <label for="folder_desc">Description<small> Details about the folder(Max of 255 characters)</small></label>
            <input type="text" class="form-control" name="folder_desc" id="folder_desc" placeholder="Enter Folder Description" maxlength="255" autofocus />
          </div>
        </div>
        <div class="row d-none" id="file_entry">
          <div class="col-md-12 form-group">
            <label for="fullfile">Select File<small> (Allowed type: pdf, doc, docx, rtf, png, jpg, gif. Max size 8MB.)</small></label>
            <input type="file" class="form-control" name="fullfile" id="fullfile" placeholder="Upload File" accept=".gif, .jpeg, .jpg, .png, .doc, .rtf, .docx, .pdf" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="file_desc">Description<small> Details about the file(Max of 255 characters)</small></label>
            <input type="text" class="form-control" name="file_desc" id="file_desc" placeholder="Enter File Description" maxlength="255" autofocus />
          </div>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-modal-folder-manager-entry-save">Save</button>
        <button type="button" class="btn btn-default" id="btn-modal-folder-manager-entry-cancel">Cancel</button>
      </div>
    </div>  
  </div>
</div>

<div id="modal-folder-manager-alert" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
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

<div id="modal-folder-manager-uploading" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
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

<div id="modal-folder-manager-view-image" class="modal" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content" style="height: 90vh">
      <div class="modal-header">
        <h4 id="modal-folder-manager-view-image-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<div id="modal-folder-manager-view-folder" class="modal" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modal-folder-manager-view-folder-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<div id="modal-folder-manager-search" class="modal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Search File/Folder</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                  <a class="card-link" data-toggle="collapse" href="#div_search_table_folders">
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
                  <a class="collapsed card-link" data-toggle="collapse" href="#div_search_table_files">
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

<div id="modal-folder-manager-recycle-bin" class="modal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Recycle Bin</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body pt-2">
        <nav class="navbar navbar-expand-sm bg-light navbar-light mb-2 justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="#" class="nodecontrol btn btn-sm btn-default nav-link" control="restore" title="Restore"><i class="fa fa-recycle" title="Restore"></i></a>
            </li>
          </ul>
        </nav>
        <div id="recycle_bin">   
        </div>
      </div>
    </div>

  </div>
</div>
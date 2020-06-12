<style>

 .treeview .list-group-item{cursor:pointer}
 .treeview span.indent{margin-left:10px;margin-right:10px}
 .treeview span.icon{width:12px;margin-right:5px}
 .treeview .node-disabled{color:silver;cursor:not-allowed}
 .node-folders_treeview{}
 .node-folders_treeview:not(.node-disabled):hover{background-color:#F5F5F5;} 

</style>

<?php if($isMain){ ?>
  <div style="overflow: auto"> 
    <div id="folders_treeview" class="treeview">
    </div>   
  </div>
<?php } else { ?>
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

<div id="modal-folder-manager-preloader" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <h4>Processing. Please Wait...</h4>
            <span><small>Please don't close your browser to avoid system conflicts</small></span>
          </div>
          <div class="col-md-3">
            <div class="spinner-border text-secondary pull-right"></div> 
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
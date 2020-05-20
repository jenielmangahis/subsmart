<style>

 .treeview .list-group-item{cursor:pointer}
 .treeview span.indent{margin-left:10px;margin-right:10px}
 .treeview span.icon{width:12px;margin-right:5px}
 .treeview .node-disabled{color:silver;cursor:not-allowed}
 .node-folders_treeview{}
 .node-folders_treeview:not(.node-disabled):hover{background-color:#F5F5F5;} 

</style>

<div id="modal-folder-manager" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Folders</h4>
        <small class="modal-folder-manager-selected">Selected : None</small>
      </div>
      <div class="modal-body" style="height: 55vh; overflow: auto"> 
        <div id="folders_treeview" class="treeview">
        </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-edit-permissions-folder-manager">Edit Permissions</button>
        <button type="button" class="btn btn-default" id="btn-create-folder-manager">Create</button>
        <button type="button" class="btn btn-default" id="btn-delete-folder-manager">Delete</button>
        <button type="button" class="btn btn-default" id="btn-select-folder-manager">Select</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-form" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Folders</h4>
        <small class="modal-folder-manager-selected">Selected : None</small>
      </div>
      <div class="modal-body" style="height: 55vh; overflow: auto"> 
        <div class="row">
          <div class="col-md-12">
            <input type="text" class="form-control" id="text-folder-manager" placeholder="Folder Name">
          </div>
        </div> 
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Role Access Permissions</h5>
            <?php 
                if(count($permissions) > 1){
                  foreach ($permissions as $key => $value) { ?>
                    <div class="checkbox">
                      <label><input type="checkbox" class="fm_role_access_permissions" value="<?php echo $value->id; ?>">&ensp;<?php echo $value->title ?></label>
                    </div>
            <?php }} ?>
          </div>
        </div>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-save-folder-manager">Save</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-folder-manager-alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="modal-folder-manager-alert-title-div">
        <button type="button" class="close" data-dismiss="modal" id="modal-folder-manager-alert-close">&times;</button>
        <h4 id="modal-folder-manager-alert-title" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p id="modal-folder-manager-alert-text"></p>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-modal-folder-manager-confirm-delete" style="display: none">Yes</button>
      </div>
    </div>

  </div>
</div>


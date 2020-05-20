<style>

 .treeview .list-group-item{cursor:pointer}
 .treeview span.indent{margin-left:10px;margin-right:10px}
 .treeview span.icon{width:12px;margin-right:5px}
 .treeview .node-disabled{color:silver;cursor:not-allowed}
 .node-folders_treeview{}
 .node-folders_treeview:not(.node-disabled):hover{background-color:#F5F5F5;} 

</style>

<div id="modal-fileVault-SelectFile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Files</h4>
        <small class="modal-fileVault-SelectFile-selected">Selected : None</small>
      </div>
      <div class="modal-body" style="height: 55vh; overflow: auto"> 
        <div id="fileVault_SelectFile_treeview" class="treeview">
        </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-select-fileVault-SelectFile">Select</button>
      </div>
    </div>

  </div>
</div>
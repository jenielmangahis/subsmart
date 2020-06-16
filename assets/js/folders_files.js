$(document).ready(function(){
// Document ready start ----------------------------------------------------------------------------------------

  selected_folder = {};
  selected_file = {};

  current_process = '';
  current_alert_theme = '';

  clear_process = true;

  $('#btn-add-new-folder').click(function(e){
    e.preventDefault();

    selected_folder = {};

    openEntry('create_folder');
  });

  $.initialize('li.node-folders_treeview', function(){
    setNodesButtons($(this)); 
  });

// -------------------------------------------------------------------------------------------------------------
// Folder entry controls
// -------------------------------------------------------------------------------------------------------------

  $('#btn-modal-folder-manager-entry-save').click(function(){
    if(current_process == 'create_folder'){

      var folder_name = $('#folder_name').val();
      var folder_desc = $('#folder_desc').val();

      folder_name = folder_name.trim();
      folder_desc = folder_desc.trim();

      var parent_id = 0;

      if(folderSelectedIsNotEmpty()){
        parent_id = selected_folder.id;
      }

      if(isFolderNameValid(folder_name)){
        $.ajax({
          type: 'POST',
          url: base_url + "folders/create",
          data: {folder_name:folder_name,parent_id:parent_id,folder_desc:folder_desc},
          beforeSend: function(){
            showProcessLoading();
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              showFolderManagerNotif('Error', result.error, 'error');
            } else {
              setFoldersTreeview(result.file_folders);

              closeEntry();
            }

            hideProcessLoading();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            hideProcessLoading();
            
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          }
        });
      } else {
        showFolderManagerNotif('Error', 'Invalid folder name', 'error');
      }                   
    } else if(current_process == 'add_file'){
      var formdata = new FormData();
      var file = $('#fullfile').prop('files')[0];
      var desc = $('#file_desc').val();
      var folder_id = selected_folder.id;

      formdata.append('fullfile', file);
      formdata.append('file_desc', desc.trim());
      formdata.append('folder_id', folder_id);

      $.ajax({
        type: 'POST',
        url: base_url + "vault/add",
        data: formdata,
        contentType: false,
        processData: false,
        beforeSend: function(){
          showProcessLoading();
        }, 
        success: function(data){
          var result = jQuery.parseJSON(data);
          if(result.error != ""){
            hideProcessLoading();

            showFolderManagerNotif('Error', result.error, 'error');  
          } else {
            hideProcessLoading();
            closeEntry();

            var params = {selected_folder:selected_folder.id};

            getFoldersAndFiles(params);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          hideProcessLoading();
            
          showFolderManagerNotif(textStatus, errorThrown, 'error'); 
        }
      });  
    }
  });

  $('#btn-modal-folder-manager-entry-cancel').click(function(){
    closeEntry();
  });

// -------------------------------------------------------------------------------------------------------------
// Confirm alert type controls
// -------------------------------------------------------------------------------------------------------------

  $('#btn-modal-folder-manager-alert-confirm').click(function(){
    if(current_process == 'delete_folder'){
      var folder_id = selected_folder.id;

      $.ajax({
        type: 'POST',
        url: base_url + "folders/delete",
        data: {folder_id:folder_id},
        beforeSend: function(){
          hideFolderManagerNotif();
          showProcessLoading();
        },
        success: function(data){
          var result = jQuery.parseJSON(data);
          if(result.error != ''){
            showFolderManagerNotif('Error', result.error, 'error');      
          } else {
            setFoldersTreeview(result.file_folders); 
          }

          hideProcessLoading();
        },
        error: function(jqXHR, textStatus, errorThrown){
          hideProcessLoading();
            
          showFolderManagerNotif(textStatus, errorThrown, 'error');  
        }
      });
    } else if(current_process == 'delete_file'){
      var file_id = selected_file.id;
      
      $.ajax({
        type: 'POST',
        url: base_url + "vault/delete",
        data: {file_id:file_id},
        beforeSend: function(){
          hideFolderManagerNotif();
          showProcessLoading();
        },
        success: function(data){
          var result = jQuery.parseJSON(data);
          if(result.error != ''){
            showFolderManagerNotif('Error', result.error, 'error');      
          } else {
            hideProcessLoading();

            var params = {selected_folder:result.folder_id};

            getFoldersAndFiles(params); 
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          hideProcessLoading();
            
          showFolderManagerNotif(textStatus, errorThrown, 'error');  
        } 
      });   
    }
  });

  $('#btn-modal-folder-manager-alert-cancel,#btn-modal-folder-manager-alert-ok').click(function(){
    hideFolderManagerNotif();
  });

// -------------------------------------------------------------------------------------------------------------
// Load folders initially
// -------------------------------------------------------------------------------------------------------------
  getFoldersAndFiles();  
// -------------------------------------------------------------------------------------------------------------

// Document ready end ------------------------------------------------------------------------------------------
});

// Functions below ---------------------------------------------------------------------------------------------

function getFoldersAndFiles(params = {}){
  $.ajax({
    type: "GET",
    url: base_url + "folders/getfolders/0/1",
    data: params,
    beforeSend: function(){
      showProcessLoading();
    },
    success: function(data) {
      var result = jQuery.parseJSON(data);
      setFoldersTreeview(result);

      hideProcessLoading();
    },
    error: function(jqXHR, textStatus, errorThrown){
      hideProcessLoading();
            
      showFolderManagerNotif(textStatus, errorThrown, 'error'); 
    }
  });
}

function setFoldersTreeview(folders_data) {
  $("#folders_treeview").treeview({
    expandIcon: "fa fa-folder-o",
    collapseIcon: "fa fa-folder-open-o",
    highlightSelected: false,
    data: folders_data
  });

  selected_folder = $("#folders_treeview").treeview('getExpanded');
  selected_folder = selected_folder[0];

  if(folderSelectedIsNotEmpty()){
    $("#folders_treeview").treeview('revealNode', [selected_folder.nodeId]);
  }
}

function setNodesButtons(liObject){
  var nodeId = liObject.attr('data-nodeid');
  var element = $('#folders_treeview').treeview('getNode', nodeId);

  if(!$('a.nodecontrol[href="'+ element.nodeId +'"][control="edit_permission"]').length){
    var btnEditPermission = '<a href="@href" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="edit_permission" title="Edit Permission" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>';
    var btnDelete = '<a href="@href" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="delete" title="@title" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
    var btnAddFile = '<a href="@href" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="add_file" title="Add File" data-toggle="tooltip"><i class="fa fa-file"></i></a>';
    var btnCreateFolder = '<a href="@href" class="nodecontrol btn btn-sm btn-default pull-right" control="create_folder" title="Create Folder" data-toggle="tooltip"><i class="fa fa-plus"></i></a>';

    data = $('#folders_treeview').treeview('getEnabled');

    var liObject = $('li[data-nodeid="'+ element.nodeId +'"]');
    var nBEP = btnEditPermission.replace('@href', element.nodeId);
    var nBD = btnDelete.replace('@href', element.nodeId);
    var nBCF = btnCreateFolder.replace('@href', element.nodeId);
    var nBAF = btnAddFile.replace('@href', element.nodeId);

    liObject.append(nBEP);

    if(element.isFile){
      nBD = nBD.replace('@title', 'Delete File');

      liObject.append(nBD);
    } else {
      nBD = nBD.replace('@title', 'Delete Folder');
      
      liObject.append(nBD);
      liObject.append(nBAF);
      liObject.append(nBCF);
    }

    $('a[control="create_folder"][href="'+ element.nodeId +'"]').click(function(e){
      e.preventDefault();

      var nodeId = $(this).attr('href');

      selected_folder = $('#folders_treeview').treeview('getNode', nodeId);

      openEntry('create_folder');
    });

    $('a[control="delete"][href="'+ element.nodeId +'"]').click(function(e){
      e.preventDefault();
      
      var nodeId = $(this).attr('href');
      var confirm_text = '';
      var selected = {};

      current_process = '';
      selected_file = {};
      selected_folder = {};

      selected = $('#folders_treeview').treeview('getNode', nodeId);
      if(selected.isFile){
        selected_file = selected;
      } else {
        selected_folder = selected;
      }

      if(folderSelectedIsNotEmpty()){
        current_process = 'delete_folder';
        confirm_text = ' folder ';
      } else if(fileSelectedIsNotEmpty()){
        current_process = 'delete_file';
        confirm_text = ' file ';
      }

      if(current_process != ''){
        showFolderManagerNotif('Confirm Delete',
                               'Delete' + confirm_text + selected.text + '?<br>' + selected.path, 'confirm');
      }
    });

    if(!element.isFile){
      $('a[control="add_file"][href="'+ element.nodeId +'"]').click(function(){
        current_process = 'add_file';

        var nodeId = $(this).attr('href');
        
        selected_folder = $('#folders_treeview').treeview('getNode', nodeId);

        openEntry('add_file'); 
      });
    }
  }
}

function openEntry(type){
  var vTitle = '';

  current_process = type;

  if(type == 'create_folder'){
    vTitle = 'Create Folder';

    $('#folder_name').val("");
    $('#folder_desc').val("");

    $('div#folder_entry').removeClass('d-none');
  } else if(type == 'add_file'){
    vTitle = 'Add File';

    $('#fullfile').val("");
    $('#file_desc').val("");

    $('div#file_entry').removeClass('d-none');
  }

  $('#modal-folder-manager-entry-title').text(vTitle);
  $('#modal-folder-manager-entry').modal('show'); 
}

function closeEntry(){
  if(current_process == 'create_folder'){
    $('div#folder_entry').addClass('d-none');
  } else if(current_process == 'add_file'){
    $('div#file_entry').addClass('d-none');  
  }

  current_process = '';

  $('#modal-folder-manager-entry-title').text('');
  $('#modal-folder-manager-entry').modal('hide');
}

function showProcessLoading(){
  if(!modalIsOpen('#modal-folder-manager-preloader')){
    $('#modal-folder-manager-preloader').modal('show');
  }
}

function hideProcessLoading(){
  if(modalIsOpen('#modal-folder-manager-preloader')){
    $('#modal-folder-manager-preloader').modal('hide');  
  }
}

function isFolderNameValid(folder_name) {
  var isValid = true;
  var invalid_chars = ["\\", "/", ":", "*", "?", '"', "<", ">", "|"];
  var invalid_names = [
    "CON",
    "PRN",
    "AUX",
    "NUL",
    "COM1",
    "COM2",
    "COM3",
    "COM4",
    "COM5",
    "COM6",
    "COM7",
    "COM8",
    "COM9",
    "LPT1",
    "LPT2",
    "LPT3",
    "LPT4",
    "LPT5",
    "LPT6",
    "LPT7",
    "LPT8",
    "LPT9"
  ];

  if (!folder_name) {
    isValid = false;
  }

  if (isValid) {
    $.each(invalid_chars, function(key, value) {
      if (folder_name.includes(value)) {
        isValid = false;
        return isValid;
      }
    });

    $.each(invalid_names, function(key, value) {
      if (folder_name.toLowerCase() == value.toLowerCase()) {
        isValid = false;
        return isValid;
      }
    });
  }

  return isValid;
}

function showFolderManagerNotif(title, text, theme) {
  current_alert_theme = theme;

  var title_class = "bg-info";

  if ((theme == "error") || (theme == "info")) {

    if(theme == "error"){
      title_class = "bg-danger";
    }

    $('#btn-modal-folder-manager-alert-ok').removeClass('d-none');
  } else if (theme == "confirm") {
    title_class = "bg-warning";

    $('#btn-modal-folder-manager-alert-confirm').removeClass('d-none');
    $('#btn-modal-folder-manager-alert-cancel').removeClass('d-none');
  }

  $("#modal-folder-manager-alert-title-div").addClass(title_class);
  $("#modal-folder-manager-alert-title").html(title);
  $("#modal-folder-manager-alert-text").html(text);

  $("#modal-folder-manager-alert").modal("show");
}

function hideFolderManagerNotif(){
  if(current_alert_theme == 'confirm'){
    $('#btn-modal-folder-manager-alert-confirm').addClass('d-none');
    $('#btn-modal-folder-manager-alert-cancel').addClass('d-none');

    $("#modal-folder-manager-alert-title-div").removeClass('bg-warning');
  } else {
    if(current_alert_theme == 'error'){
      $("#modal-folder-manager-alert-title-div").removeClass('bg-danger');  
    } else {
      $("#modal-folder-manager-alert-title-div").removeClass('bg-info');  
    }

    $('#btn-modal-folder-manager-alert-ok').addClass('d-none');  
  }

  current_alert_theme = '';
  $('#modal-folder-manager-alert').modal('hide');
}

function folderSelectedIsNotEmpty() {
  return (
    !jQuery.isEmptyObject(selected_folder) && selected_folder !== undefined
  );
}

function fileSelectedIsNotEmpty() {
  return (
    !jQuery.isEmptyObject(selected_file) && selected_file !== undefined
  );
}

function modalIsOpen(modal_id){
  return ($(modal_id).data('bs.modal') || {})._isShown;
}
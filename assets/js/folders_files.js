$(document).ready(function(){
  selected_folder = {};
  selected_file = {};

  isUpdatePermissions = false;

// -------------------------------------------------------------------------------------------------------------
// Francis scripts 4/14/2020 ph date
// -------------------------------------------------------------------------------------------------------------
  //open folder manager
  $("#btn-folder-manager").click(function() {
    var folder_selected = { selected_folder: 0 };

    if ($("#current_selected_folder_id").length) {
      folder_selected.selected_folder = $("#current_selected_folder_id").val();
    }

    $.ajax({
      type: "GET",
      url: base_url + "folders/getfolders",
      data: folder_selected,
      success: function(data) {
        var result = jQuery.parseJSON(data);
        setFoldersTreeview(result);

        if (folderSelectedIsNotEmpty()) {
          $("#folders_treeview").treeview("selectNode", [
            selected_folder.nodeId
          ]);
          $("#folders_treeview").treeview("revealNode", [
            selected_folder.nodeId
          ]);
          $("#folders_treeview").treeview("expandNode", [
            selected_folder.nodeId
          ]);
        } else {
          selected_folder = $("#folders_treeview").treeview("getSelected");
          if (folderSelectedIsNotEmpty()) {
            selected_folder = selected_folder[0];

            $(".modal-folder-manager-selected").html(
              "Selected : " + selected_folder.path
            );

            $("#folders_treeview").treeview("revealNode", [
              selected_folder.nodeId
            ]);
            $("#folders_treeview").treeview("expandNode", [
              selected_folder.nodeId
            ]);
          }
        }

        $("#modal-folder-manager").modal("show");
      }
    });
  });

  //click create folder
  $("#btn-create-folder-manager").click(function() {
    $("#text-folder-manager").val("");
    $("#text-folder-manager").prop("disabled", false);

    $(".fm_role_access_permissions").each(function(i, obj) {
      $(this).prop("checked", false);
    });

    isUpdatePermissions = false;

    $("#modal-folder-manager-form").modal("show");
  });

  //click save new folder
  $("#btn-save-folder-manager").click(function() {
    var folder_name = $("#text-folder-manager").val();
    var parent_folder_id = 0;
    var permissions = [{}];

    if (selected_folder.length != 0) {
      parent_folder_id = selected_folder.id;
    }

    $(".fm_role_access_permissions").each(function(i, obj) {
      var role_id = $(this).val();
      if ($(this).is(":checked")) {
        permissions.push({ role_id: role_id });
      }
    });

    if (isFolderNameValid(folder_name)) {
      if (!isUpdatePermissions) {
        $.ajax({
          type: "POST",
          url: base_url + "folders/save",
          data: {
            folder_name: folder_name,
            parent_folder_id: parent_folder_id,
            roles: permissions
          },
          success: function(data) {
            var result = jQuery.parseJSON(data);
            if (result.error == "") {
              setFoldersTreeview(result.folders);

              if (folderSelectedIsNotEmpty()) {
                $("#folders_treeview").treeview("selectNode", [
                  selected_folder.nodeId
                ]);
                $("#folders_treeview").treeview("revealNode", [
                  selected_folder.nodeId
                ]);
                $("#folders_treeview").treeview("expandNode", [
                  selected_folder.nodeId
                ]);
              }

              $("#modal-folder-manager-form").modal("hide");
            } else {
              showFolderManagerNotif("Error", result.error);
            }
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: base_url + "folders/update_permissions",
          data: { folder_id: parent_folder_id, roles: permissions },
          success: function(data) {
            var result = jQuery.parseJSON(data);
            if (result.error == "") {
              showFolderManagerNotif(
                "Information",
                "Permissions successfully updated"
              );
            } else {
              showFolderManagerNotif("Error", result.error);
            }
          }
        });
      }
    } else {
      showFolderManagerNotif("Error", "Folder name is invalid");
    }
  });

  //click delete folder
  $("#btn-delete-folder-manager").click(function() {
    if (!folderSelectedIsNotEmpty()) {
      showFolderManagerNotif("Information", "No folder selected");
    } else {
      showFolderManagerNotif(
        "Confirm",
        "Are you sure you want to delete folder",
        true
      );
    }
  });

  //click confirm delete folder
  $("#btn-modal-folder-manager-confirm-delete").click(function() {
    var folder_id = selected_folder.id;
    var parent_node = $("#folders_treeview").treeview(
      "getParent",
      selected_folder
    );
    if (parent_node == null) {
      parent_node = {};
    }

    $.ajax({
      type: "POST",
      url: base_url + "folders/delete",
      data: { folder_id: folder_id },
      success: function(data) {
        var result = jQuery.parseJSON(data);
        if (result.error == "") {
          setFoldersTreeview(result.folders);

          selected_folder = {};

          if (
            !jQuery.isEmptyObject(parent_node) &&
            parent_node.hasOwnProperty("parentId")
          ) {
            $("#folders_treeview").treeview("revealNode", [parent_node.nodeId]);
            $("#folders_treeview").treeview("expandNode", [parent_node.nodeId]);
          }

          $(".modal-folder-manager-selected").html("Selected : None");
          $("#modal-folder-manager-alert").modal("hide");
        } else {
          showFolderManagerNotif("Error", result.error, false);
        }
      }
    });
  });

  //click edit permission of a folder
  $("#btn-edit-permissions-folder-manager").click(function() {
    if (!folderSelectedIsNotEmpty()) {
      showFolderManagerNotif("Information", "No folder selected");
    } else {
      $(".fm_role_access_permissions").each(function(i, obj) {
        $(this).prop("checked", false);
      });

      var folder_id = selected_folder.id;

      $.ajax({
        type: "GET",
        url: base_url + "folders/getFolderPermissions",
        data: { folder_id: folder_id },
        success: function(data) {
          var result = jQuery.parseJSON(data);
          $.each(result, function(key, val) {
            $(
              'input.fm_role_access_permissions[value="' + val.role_id + '"]'
            ).prop("checked", true);
          });

          isUpdatePermissions = true;

          $("#text-folder-manager").val(selected_folder.text);
          $("#text-folder-manager").prop("disabled", true);

          $("#modal-folder-manager-form").modal("show");
        }
      });
    }
  });

  //event handler for on close of folder manager alert modal
  $("#modal-folder-manager-alert").on("hidden.bs.modal", function() {
    $("#modal-folder-manager-alert-title-div").removeClass();
    $("#modal-folder-manager-alert-title-div").addClass("modal-header");
    $("#btn-modal-folder-manager-confirm-delete").hide();
  });

// -------------------------------------------------------------------------------------------------------------


// -------------------------------------------------------------------------------------------------------------
// Francis intercept form submit for creating new file in filevault 4/27/2020
// -------------------------------------------------------------------------------------------------------------

  $("#savefilevault").click(function(){
  	var type = $(this).attr('button_for');
  	var vault_id = $('#vault_id').val();
  	var folder = $('#fm_selected_folder').val();
  	var filename = $('#fullfile').val();

  	$.ajax({
  		type: 'GET',
  		url: base_url + "vault/file_exists",
  		data: {type:type,vault_id:vault_id,filename:filename,folder:folder},
  		success: function(data){
  			if(data){
  				showFolderManagerNotif('Error', 'Filename already exists.<br>Please rename your file.');
  			} else {
  				$('#filevaultform').submit();	
  			}
  		}
  	});
  });

// -------------------------------------------------------------------------------------------------------------


// -------------------------------------------------------------------------------------------------------------
// Francis file selection scripts 4/28/2020 6:51PM ph time
// -------------------------------------------------------------------------------------------------------------

  $("#btn-fileVault-SelectFile").click(function(){
    $.ajax({
      type: "GET",
      url: base_url + "folders/getfiles",
      success: function(data) {
        var result = jQuery.parseJSON(data);
        setFilesTreeview(result);

        if (fileSelectedIsNotEmpty()) {
          $("#fileVault_SelectFile_treeview").treeview("selectNode", [
            selected_file.nodeId
          ]);
          $("#fileVault_SelectFile_treeview").treeview("revealNode", [
            selected_file.nodeId
          ]);
          $("#fileVault_SelectFile_treeview").treeview("expandNode", [
            selected_file.nodeId
          ]);
        }

        $("#modal-fileVault-SelectFile").modal("show");
      }
    }); 	
  });

  $("#btn-select-fileVault-SelectFile").click(function(){
    if (fileSelectedIsNotEmpty()) {
      $('#fs_selected_file_text').val(selected_file.path);
      $('#fs_selected_file').val(selected_file.id);
    } else {
      $('#fs_selected_file_text').val('');
      $('#fs_selected_file').val(0);  
    }

    $("#modal-fileVault-SelectFile").modal("hide");
  });

// -------------------------------------------------------------------------------------------------------------	
});

function setFoldersTreeview(folders_data) {
  $("#folders_treeview").treeview({
    expandIcon: "fa fa-folder-o",
    collapseIcon: "fa fa-folder-open-o",
    data: folders_data,
    onNodeSelected: function(event, data) {
      selected_folder = data;
      $(".modal-folder-manager-selected").html(
        "Selected : " + selected_folder.path
      );
    },
    onNodeUnselected: function(event, data) {
      selected_folder = {};
      $(".modal-folder-manager-selected").html("Selected : None");
    }
  });
}

function setFilesTreeview(files_data){
  $("#fileVault_SelectFile_treeview").treeview({
    expandIcon: "fa fa-folder-o",
    collapseIcon: "fa fa-folder-open-o",
    data: files_data,
    onNodeSelected: function(event, data) {
      if(data.isFile){
        selected_file = data;
        $(".modal-fileVault-SelectFile-selected").html(
          "Selected : " + selected_file.path
        );
      } else {
        selected_file = {};
      }
    },
    onNodeUnselected: function(event, data) {
      selected_folder = {};
      $(".modal-fileVault-SelectFile-selected").html("Selected : None");
    }  
  });
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

function showFolderManagerNotif(title, text, showyesbuttonfordelete = false) {
  var title_class = "bg-info";
  if (title == "Error") {
    title_class = "bg-danger";
  } else if (title == "Confirm") {
    title = "Confirm?";
    title_class = "bg-warning";
  }

  $("#modal-folder-manager-alert-title-div").addClass(title_class);
  $("#modal-folder-manager-alert-title").html(title);
  $("#modal-folder-manager-alert-text").html(text);

  if (showyesbuttonfordelete) {
    $("#btn-modal-folder-manager-confirm-delete").show();
  } else {
    $("#btn-modal-folder-manager-confirm-delete").hide();
  }

  if (!($("#modal-folder-manager-alert").data("bs.modal") || {}).isShown) {
    $("#modal-folder-manager-alert").modal("show");
  }
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
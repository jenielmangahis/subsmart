$(document).ready(function(){
  // Document ready start ----------------------------------------------------------------------------------------
    
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    
    vType = $('#vault_type').val();
    vType = (vType) ? vType.trim() : '';
  
    selected = 0;
    selected_isFolder = 1;
  
    selected_trash = 0;
    selected_trash_isFolder = 1;
  
    selected_move = 0;
    selected_move_isFolder = 1;
    selected_move_fName = '';
  
    current_selected_folder = 0;
    current_process = '';
    current_alert_theme = '';
  
    clear_process = true;
    is_initial = true;
  
    var dtu_files = {};
    var dtu_multiple_uploadable = 0;
    var dtu_multiple_uploaded = 0;
  
    var categories = []; 
  
  // -------------------------------------------------------------------------------------------------------------
  // Load initial functions
  // -------------------------------------------------------------------------------------------------------------
    getFoldersAndFiles();
    get_most_download_files();
    get_most_previewd_files();
    get_recently_uploaded_files();  
  
    if (vType === 'mylibrary') {
      getDocusingTemplates();
    }
  
    if (vType === 'sharedlibrary') {
      getDocusingTemplates(shared=true);
    }
  
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Load Tops events
  // -------------------------------------------------------------------------------------------------------------
    $('span[control="refresh_tops"]').click(function(){
      $(this).addClass('fa-spin');
  
      var top = $(this).attr('target');
      if(top == 'most_downloads'){
        get_most_download_files();
      } else if(top == 'most_previews'){
        get_most_previewd_files();
      } else if(top == 'recent_uploads'){
        get_recently_uploaded_files();
      }
    });
  
  // -------------------------------------------------------------------------------------------------------------
  // Folder entry control events
  // -------------------------------------------------------------------------------------------------------------
  
  // create folder
    $('a[control="create_folder"]').click(function(e){
      e.preventDefault();
  
      openEntry('create_folder');
    });
  
  // delete folder or file
    $('a[control="delete"]').click(function(e){
      e.preventDefault();
      
      if(selected != 0){ 
        if(vType == 'mylibrary'){
          var div = $('td[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
        } else {
          var div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');  
        }
        
        var confirm_text = '';
        var confirm_path = $('#folders_path').text();
  
        confirm_path = confirm_path.trim() + div.attr('fnm');
  
        if(selected_isFolder == 1){
          current_process = 'delete_folder';
          confirm_text = ' Folder ' + div.attr('fnm');
        } else {
          current_process = 'delete_file';
          confirm_text = ' File ' + div.attr('fnm');
        }
  
        if(current_process != ''){
          showFolderManagerNotif('Confirm Delete',
                                  'Trash' + confirm_text + '?<br>' + confirm_path, 'confirm');
        }
      } else {
        showFolderManagerNotif('Error','Please select a file or a folder to trash','error');
      }
    });
  
  // add file
    $('a[control="add_file"]').click(function(e){
      e.preventDefault();
  
      openEntry('add_file');
    });
  
  // view folder or file detail
    $('a[control="view"]').click(function(e){
      e.preventDefault();
  
      vIsMyLibrary = (vType == 'mylibrary');
  
      if(selected != 0){
        if(selected_isFolder == 1){
          showFolderDetails(selected, selected_isFolder, false, vIsMyLibrary);
        } else {
          showFileDetail(selected, selected_isFolder, false, vIsMyLibrary);
        }
      } else {
        showFolderManagerNotif('Error','Please select a file or a folder to view','error');
      }
    });
  
  // download file
    $('a[control="download"]').click(function(e){
      e.preventDefault();
  
      window.open(base_url + 'vault/download_file/' + selected);
  
      get_most_download_files();
    });
  
  // open search modal to search for files or folders
    $('a[control="search"]').click(function(e){
      e.preventDefault();
  
      showFolderManagerSearch();
    });
  
  // open recycle bin
    $('a[control="recycle"]').click(function(e){
      e.preventDefault();
  
      $('#recycle_bin_selected_name').text("No Folder/File Selected");
      $('#recycle_bin_selected_path').text("/../");
      
      getTrashRecords();
    });
  
  // restore selected trash
    $('a[control="restore"]').click(function(e){
      e.preventDefault();
  
      restoreFileOrFolder();
    });
  
  // open drop to upload modal
    $('a[control="drop_to_upload"]').click(function(e){
      e.preventDefault();
  
      showDropToUpload();
    });
  
  // open category entry
    $('a[control="category_entry"]').click(function(e){
      e.preventDefault();
  
      openEntry('add_category');
    });
  
  // initiate move folder or file
    $('a[control="move"]').click(function(e){
      e.preventDefault();
  
      if((selected != 0) && (selected_move == 0)){
        selected_move = selected;
        selected_move_isFolder = selected_isFolder;
        selected_move_fName = $('#folders_name').text();
  
        if(selected_move_isFolder == 1){
          $('#move_f_tag').text('Folder');
        } else {
          $('#move_f_tag').text('File');
        }
  
        $('#move_f_text').text($('#folders_path').text() + $('#folders_name').text());
  
        if($('#move_details').hasClass('d-none')){
          $('#move_details').removeClass('d-none');
        }
      } else if(selected_move != 0){
        showFolderManagerNotif('Error','a file or folder already selected for moving','error');  
      } else {
        showFolderManagerNotif('Error','Please select a file or a folder to move','error');  
      }
    });
  
  // edit file or folder
    $('a[control="edit"]').click(function(e){
      e.preventDefault();
  
      if(selected != 0){ 
        if(selected_isFolder == 1){
          var vUrl = base_url + "folders/getFolder/" + selected;
        } else {
          var vUrl = base_url + "vault/getFile/" + selected;
        }  
  
        $.ajax({
          type:'GET',
          url: vUrl,
          success: function(data){
            var result = jQuery.parseJSON(data);
  
            if(vType == 'businessformtemplates'){
              $('#f_category').val(result.category_id);
            }
  
            if(selected_isFolder == 1){
              $('#folder_name').val(result.folder_name);
              $('#folder_desc').val(result.description);
              
              openEntry('edit_folder');
            } else {
              $('#div_file_path_display').removeClass('d-none');
              $('#file_path_display').val(result.file_path);
              $('#file_path_display').attr('filetitle',result.title);
              $('#file_desc').val(result.description);
  
              openEntry('edit_file');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          }
        });
      } else {
        showFolderManagerNotif('Error','Please select a file or a folder for editing','error');
      }
    });
  
  // remove a folder or file completely
    $('a[control="remove"]').click(function(e){
      e.preventDefault();
  
      if(selected_trash != 0){
        var div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]');
        
        var confirm_text = '';
        var confirm_path = $('#recycle_bin_selected_path').text();
  
        confirm_path = confirm_path.trim() + div.attr('fnm');
  
        if(selected_isFolder == 1){
          current_process = 'remove_folder';
  
          confirmRemoveFolder();
        } else {
          current_process = 'remove_file';
          confirm_text = ' File ' + div.attr('fnm');
  
          showFolderManagerNotif('Confirm Remove',
                                  'Remove' + confirm_text + '?<br>' + confirm_path + '<br>Note: The file or folder will be removed permanently','confirm');
        }
      } else {
        showFolderManagerNotif('Information','Please select a folder or file from the recycle bin','info');
      }
    });
  
  // empty recycle bin
    $('a[control="empty"]').click(function(e){
      current_process = 'empty_trash';
  
      showFolderManagerNotif('Confirm Empty Recycle Bin',
                              'Are you sure you want to empty recycle bin?<br>Please note that only files and folders that you have created will be removed.',
                              'confirm');  
    });
  
  // open general permissions form entry
    $('a[control="set_g_permission"]').click(function(e){
      e.preventDefault();
  
      current_process = 'general_permissions';
  
      resetPermissions();
      
      $.ajax({
        type: 'GET',
        url: base_url + "vault/getrolesandusers",
        success: function(data){
          var result = jQuery.parseJSON(data);
          var append = '';
  
          $('#gpe_table_roles > tbody').empty();
          $('#gpe_table_users > tbody').empty();
  
          $.each(result.roles, function(index, role){
            append += '<tr>';
            append += '<td class="d-none">role</td>';
            append += '<td class="d-none">' + role.id + '</td>';
            append += '<td>' + role.title + '</td>';
            append += '</tr>';
          });
  
          $('#gpe_table_roles > tbody').append(append);
  
          append = '';
  
          $.each(result.users, function(index, user){
            append += '<tr>';
            append += '<td class="d-none">user</td>';
            append += '<td class="d-none">' + user.id + '</td>';
            append += '<td>' + user.FName + ' ' + user.LName + '</td>';
            append += '</tr>';
          });
  
          $('#gpe_table_users > tbody').append(append);
  
          $('#gpe_table_users > tbody > tr > td,#gpe_table_roles > tbody > tr > td').click(function(){
  
            $('#gpe_table_users > tbody > tr.table-primary').removeClass('table-primary');
            $('#gpe_table_roles > tbody > tr.table-primary').removeClass('table-primary');
  
            $(this).parent('tr').addClass('table-primary');
  
            var id = $(this).parent('tr').children('td:eq(1)').text();
            var tablefunc = $(this).closest('table').attr('tablefunc');
  
            $.ajax({
              type: 'GET',
              url: base_url + "vault/"+ tablefunc +"/" + id,
              success: function(data){
                var result = jQuery.parseJSON(data);
  
                if(result != null){
                  $('#gpec_create_folder').prop('checked', (result.create_folder == 1));
                  $('#gpec_add_file').prop('checked', (result.add_file == 1));
                  $('#gpec_edit_folder_file').prop('checked', (result.edit_folder_file == 1));
                  $('#gpec_move_folder_file').prop('checked', (result.move_folder_file == 1));
                  $('#gpec_trash_folder_file').prop('checked', (result.trash_folder_file == 1));
                  $('#gpec_remove_folder_file').prop('checked', (result.remove_folder_file == 1));
                } else {
                  resetPermissions();   
                }
              },
              error: function(jqXHR, textStatus, errorThrown){
                showFolderManagerNotif(textStatus, errorThrown, 'error');  
              }
            });
          });
  
          openEntry('general_permissions');
        },
        error: function(jqXHR, textStatus, errorThrown){
          showFolderManagerNotif(textStatus, errorThrown, 'error');  
        }
      });
    });
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Set general permissions extra
  // -------------------------------------------------------------------------------------------------------------
    function resetPermissions(){
      $('#gpec_create_folder').prop('checked', false);
      $('#gpec_add_file').prop('checked', false);
      $('#gpec_edit_folder_file').prop('checked', false);
      $('#gpec_move_folder_file').prop('checked', false);
      $('#gpec_trash_folder_file').prop('checked', false);
      $('#gpec_remove_folder_file').prop('checked', false);
    }
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Remove files or folders extra
  // -------------------------------------------------------------------------------------------------------------
  
    function confirmRemoveFolder(){
      var div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]');
        
      var confirm_text = '';
      var confirm_path = $('#recycle_bin_selected_path').text();
  
      confirm_path = confirm_path.trim() + div.attr('fnm');
  
      $.ajax({
        type: 'GET',
        url: base_url + "folders/checkFolderContents/" + selected_trash,
        success: function(data){
          var result = jQuery.parseJSON(data);
          if((result.error == "") || (result.error == null)){
            if(result.total > 0){ 
              confirm_text = 'Folder ' + div.attr('fnm') + ' is not empty, continue remove?';
            } else {
              confirm_text = 'Remove Folder ' + div.attr('fnm') + '?';    
            }
  
            confirm_text += '<br>' + confirm_path + '<br>Note: The file or folder will be removed permanently';
  
            showFolderManagerNotif('Confirm Remove',confirm_text,'confirm'); 
          } else {
            showFolderManagerNotif('Error', result.error, 'error');  
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          showFolderManagerNotif(textStatus, errorThrown, 'error'); 
        }
      }); 
    }
  
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Move file or folder extra controls
  // -------------------------------------------------------------------------------------------------------------
    
    $('#move_proceed').click(function(){
      if(selected_move != 0){
        if(selected_move_isFolder == 1){
          var vUrl = base_url + "folders/move/" + current_selected_folder + "/" + selected_move;
          var vTag = 'Folder';
        } else {
          var vUrl = base_url + "vault/move/" + current_selected_folder + "/" + selected_move;
          var vTag = 'File';
        }
  
        $.ajax({
          xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
          },
  
          type: 'POST',
          url: vUrl,
          beforeSend: function(){
            showUploading('Moving ' + vTag + ' ' + selected_move_fName, true);
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
  
            if((result.error == "") || (result.error == null)){
              resetMoveProcess();
              
              getFoldersAndFiles(current_selected_folder);
            } else {
              hideUploading();
  
              showFolderManagerNotif('Error', result.error, 'error');  
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            hideUploading();
  
            showFolderManagerNotif(textStatus, errorThrown, 'error');
          } 
        });
      } else {
        showFolderManagerNotif('Error','Please select a file or a folder to move','error');  
      }
    });
  
    $('#move_cancel').click(function(){
      resetMoveProcess(); 
    });
  
    function resetMoveProcess(){
      selected_move = 0;
      selected_move_isFolder = 1;
      selected_move_fName = '';
  
      $('#move_f_text').text("");
  
      if(!$('#move_details').hasClass('d-none')){
        $('#move_details').addClass('d-none');
      }   
    }
    
  // -------------------------------------------------------------------------------------------------------------
  
  
  // -------------------------------------------------------------------------------------------------------------
  // Drop To Upload extra controls
  // -------------------------------------------------------------------------------------------------------------
  
    $('#mfm-dtu-close-button').click(function(){
      hideDropToUpload();
    });
  
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Folder entry controls
  // -------------------------------------------------------------------------------------------------------------
    $('#btn-modal-folder-manager-entry-save').click(function(){
      var vContinue = true;
      var vCategory = '';
  
      if(vType == 'businessformtemplates'){
        vCategory = $('#f_category').children('option:selected').val();
        vContinue = (vCategory != '');
      }
  
      if(current_process == 'create_folder'){
        if(vContinue){
          var folder_name = $('#folder_name').val();
          var folder_desc = $('#folder_desc').val();
          var parent_id = current_selected_folder;
  
          folder_name = folder_name.trim();
          folder_desc = folder_desc.trim();
  
          if(isFolderNameValid(folder_name)){
            $.ajax({
              type: 'POST',
              url: base_url + "folders/create",
              data: {folder_name:folder_name,parent_id:parent_id,folder_desc:folder_desc,category:vCategory},
              beforeSend: function(){
  
              },
              success: function(data){
                var result = jQuery.parseJSON(data);
                if(result.error != ''){
                  showFolderManagerNotif('Error', result.error, 'error');
                } else {
                  getFoldersAndFiles(current_selected_folder);
  
                  closeEntry();
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                showFolderManagerNotif(textStatus, errorThrown, 'error');  
              }
            });
          } else {
            showFolderManagerNotif('Error', 'Invalid folder name', 'error');
          }
        } else {
          showFolderManagerNotif('Error', 'Please select category', 'error');
        }                   
      } else if(current_process == 'add_file'){
        if(vContinue){
          var formdata = new FormData();
          var file = $('#fullfile').prop('files')[0];
          var desc = $('#file_desc').val();
          var folder_id = current_selected_folder; //selected folder's id
  
          formdata.append('fullfile', file);
          formdata.append('file_desc', desc.trim());
          formdata.append('folder_id', folder_id);
          formdata.append('category', vCategory);
  
          $.ajax({
            xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
            },
            type: 'POST',
            url: base_url + "vault/add",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: function(){
              showUploading(file.name);
            }, 
            success: function(data){
              var result = jQuery.parseJSON(data);
  
              if(result.error != ""){
                hideUploading();
  
                showFolderManagerNotif('Error', result.error, 'error');  
              } else {
                closeEntry();
                getFoldersAndFiles(current_selected_folder);
                get_recently_uploaded_files();
              }
            },
            error: function(jqXHR, textStatus, errorThrown){ 
              hideUploading();
  
              showFolderManagerNotif(textStatus, errorThrown, 'error'); 
            }
          });
        } else {
          showFolderManagerNotif('Error', 'Please select category', 'error'); 
        }  
      } else if(current_process == 'edit_folder'){
        if(vContinue){
          var folder_name = $('#folder_name').val();
          var folder_desc = $('#folder_desc').val();
          var parent_id = current_selected_folder;
  
          folder_name = folder_name.trim();
          folder_desc = folder_desc.trim();
  
          if(isFolderNameValid(folder_name)){
            $.ajax({
              xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
              },
              type: 'POST',
              url: base_url + "folders/update",
              data: {folder_id:selected,folder_name:folder_name,parent_id:parent_id,folder_desc:folder_desc,category:vCategory},
              beforeSend: function(){
                showUploading('Updating folder ' + folder_name, true);
              },
              success: function(data){
                var result = jQuery.parseJSON(data);
                if(result.error != ''){
                  hideUploading();
  
                  showFolderManagerNotif('Error', result.error, 'error');
                } else {
                  getFoldersAndFiles(current_selected_folder);
  
                  closeEntry();
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                hideUploading();
  
                showFolderManagerNotif(textStatus, errorThrown, 'error');  
              }
            });
          } else {
            showFolderManagerNotif('Error', 'Invalid folder name', 'error');
          }
        } else {
          showFolderManagerNotif('Error', 'Please select category', 'error');
        }  
      } else if(current_process == 'edit_file'){ 
        if(vContinue){
          var formdata = new FormData();
          var file = $('#fullfile').prop('files')[0];
          var desc = $('#file_desc').val();
          var folder_id = current_selected_folder; //selected folder's id
          var title = $('#file_path_display').attr('filetitle');
  
          formdata.append('fullfile', file);
          formdata.append('file_id', selected);
          formdata.append('file_desc', desc.trim());
          formdata.append('folder_id', folder_id);
          formdata.append('category', vCategory);
  
          $.ajax({
            xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
            },
            type: 'POST',
            url: base_url + "vault/update",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: function(){
              showUploading('Updating file ' + title, true);
            }, 
            success: function(data){
              var result = jQuery.parseJSON(data);
  
              if(result.error != ""){
                hideUploading();
  
                showFolderManagerNotif('Error', result.error, 'error');  
              } else {
                getFoldersAndFiles(current_selected_folder);
  
                const isUpdateOnRecentlyUploaded = $('.vault__item--isActive').closest('#recentlyUploaded').length >= 1;
                if (isUpdateOnRecentlyUploaded) {
                  get_recently_uploaded_files();
                }
  
                closeEntry();
              }
            },
            error: function(jqXHR, textStatus, errorThrown){ 
              hideUploading();
  
              showFolderManagerNotif(textStatus, errorThrown, 'error'); 
            }
          });
        } else {
          showFolderManagerNotif('Error', 'Please select category', 'error'); 
        }
      } else if(current_process == 'add_category'){
        var vCName = $('#category_name').val();
        var vCDesc = $('#category_desc').val();
  
        if(vCName != ""){
          $.ajax({
            type: 'POST',
            url: base_url + "filefolderscategories/add",
            data: {category_name:vCName,category_desc:vCDesc},
            success: function(data){
              var result = jQuery.parseJSON(data);
              if(result.error == ""){
                $('#f_category').empty();
                $('#dtu_f_category').empty();
  
                var append = '<option value="">Select Category</option>';
  
                $.each(result.categories, function(index, category){
                  append += '<option value="'+ category.category_id +'">' + category.category_name + '</option>';
                }); 
  
                $('#f_category').append(append);
                $('#dtu_f_category').append(append);
                
                closeEntry();
              } else {
                showFolderManagerNotif('Error',result.error,'error');
              }
            },
            error: function(jqXHR, textStatus, errorThrown){ 
              showFolderManagerNotif(textStatus, errorThrown, 'error'); 
            }
          });
        } else {
          showFolderManagerNotif('Information','Please provide category name','info');
        }
      } else if(current_process == 'edit_category'){
        var vCId = $('#f_category').val();
        var vCName = $('#category_name').val();
        var vCDesc = $('#category_desc').val();
        var vError = '';
  
        var vContinue = true;
        if(vCId == ""){
          vContinue = false;
          vError = 'Please select category to edit';
        } else if(vCName == ""){
          vContinue = false;
          vError = 'Please provide category name';
        }
  
        if(vContinue){
          $.ajax({
            type: 'POST',
            url: base_url + "filefolderscategories/edit",
            data: {category_id:vCId,category_name:vCName,category_desc:vCDesc},
            success: function(data){
              var result = jQuery.parseJSON(data);
              if(result.error == ""){
                $('#f_category').empty();
                $('#dtu_f_category').empty();
  
                var append = '<option value="">Select Category</option>';
  
                $.each(result.categories, function(index, category){
                  append += '<option value="'+ category.category_id +'" catdesc="'+ category.category_desc +'">' + category.category_name + '</option>';
                }); 
  
                $('#f_category').append(append);
                $('#dtu_f_category').append(append);
                
                getFoldersAndFiles(current_selected_folder);
  
                closeEntry();
              } else {
                showFolderManagerNotif('Error',result.error,'error');
              }
            },
            error: function(jqXHR, textStatus, errorThrown){ 
              showFolderManagerNotif(textStatus, errorThrown, 'error'); 
            }
          });
        } else {
          showFolderManagerNotif('Information',vError,'info');
        }  
      } else if(current_process == 'delete_category'){
        var vCId = $('#f_category').val();
  
        var vContinue = true;
        if(vCId == ""){
          vContinue = false;
          vError = 'Please select category to delete';
        }
  
        if(vContinue){
          $.ajax({
            type: 'POST',
            url: base_url + "filefolderscategories/delete",
            data: {category_id:vCId},
            success: function(data){
              var result = jQuery.parseJSON(data);
              if(result.error == ""){
                $('#f_category').empty();
                $('#dtu_f_category').empty();
  
                var append = '<option value="">Select Category</option>';
  
                $.each(result.categories, function(index, category){
                  append += '<option value="'+ category.category_id +'" catdesc="'+ category.category_desc +'">' + category.category_name + '</option>';
                }); 
  
                $('#f_category').append(append);
                $('#dtu_f_category').append(append);
  
                $('#category_name').val("");
                $('#category_desc').val("");
              } else {
                showFolderManagerNotif('Error',result.error,'error');
              }
            },
            error: function(jqXHR, textStatus, errorThrown){ 
              showFolderManagerNotif(textStatus, errorThrown, 'error'); 
            }
          });  
        } else {
          showFolderManagerNotif('Information',vError,'info'); 
        }
      } else if(current_process == 'general_permissions'){
        if($('#gpec_create_folder').is(':checked')){
          var gpec_create_folder = '1';
        } else {
          var gpec_create_folder = '0';
        }
  
        if($('#gpec_add_file').is(':checked')){
          var gpec_add_file = '1';
        } else {
          var gpec_add_file = '0';
        }
  
        if($('#gpec_edit_folder_file').is(':checked')){
          var gpec_edit_folder_file = '1';
        } else {
          var gpec_edit_folder_file = '0';
        }
        
        if($('#gpec_move_folder_file').is(':checked')){
          var gpec_move_folder_file = '1';
        } else {
          var gpec_move_folder_file = '0';
        }
  
        if($('#gpec_trash_folder_file').is(':checked')){
          var gpec_trash_folder_file = '1';
        } else {
          var gpec_trash_folder_file = '0';
        }
  
        if($('#gpec_remove_folder_file').is(':checked')){
          var gpec_remove_folder_file = '1';
        } else {
          var gpec_remove_folder_file = '0';
        }
  
        if($('#gpe_table_roles > tbody > tr.table-primary').length){
          var vPId = $('#gpe_table_roles > tbody > tr.table-primary').children('td:eq(1)').text();
          var vPType = 'role'; 
        } else if($('#gpe_table_users > tbody > tr.table-primary').length){
          var vPId = $('#gpe_table_users > tbody > tr.table-primary').children('td:eq(1)').text();
          var vPType = 'user';
        } else {
          var vPId = '';
          var vPType = '';
        }
  
        if(vPId != ''){
          $.ajax({
            type: 'POST',
            url: base_url + "vault/savepermissions",
            data: {
              create_folder:gpec_create_folder,
              add_file:gpec_add_file,
              edit_folder_file:gpec_edit_folder_file,
              move_folder_file:gpec_move_folder_file,
              trash_folder_file:gpec_trash_folder_file,
              remove_folder_file:gpec_remove_folder_file,
              vpid:vPId,
              vptype:vPType
            },
            success: function(data){
              var result = jQuery.parseJSON(data);
  
              if((result.error == '') || (result.error == null)){
                ApplyPermissions(result.permissions);
                
                showFolderManagerNotif('Successful','Permission set to the ' + vPType,'success');
              } else {
                showFolderManagerNotif('Error', result.error, 'error');   
              }
            },
            error: function(jqXHR, textStatus, errorThrown){
              showFolderManagerNotif(textStatus, errorThrown, 'error');  
            }
          });
        } else {
          showFolderManagerNotif('Error','Please select <strong>role</strong> or <strong>user</strong> to apply permissions','error');
        }
      }
    });
  
  // -------------------------------------------------------------------------------------------------------------
  // General Permissions Extras
  // -------------------------------------------------------------------------------------------------------------
    function ApplyPermissions(permissions){
      var b_create_folder = $('a[control="create_folder"]');
      var b_add_file = $('a[control="add_file"]');
      var b_edit_folder_file = $('a[control="edit"]');
      var b_move_folder_file = $('a[control="move"]');
      var b_trash_folder_file = $('a[control="delete"]');
      var b_remove_folder_file = $('a[control="remove"]');
      var b_empty_folder_file = $('a[control="empty"]');
  
      if(permissions.create_folder == '1'){
        if(b_create_folder.hasClass('d-none')){
          b_create_folder.removeClass('d-none');
        }  
      } else {
        if(!b_create_folder.hasClass('d-none')){
          b_create_folder.addClass('d-none');
        }
      }
  
      if(permissions.add_file == '1'){
        if(b_add_file.hasClass('d-none')){
          b_add_file.removeClass('d-none');
        }  
      } else {
        if(!b_add_file.hasClass('d-none')){
          b_add_file.addClass('d-none');
        }
      }
  
      if(permissions.edit_folder_file == '1'){
        if(b_edit_folder_file.hasClass('d-none')){
          b_edit_folder_file.removeClass('d-none');
        }  
      } else {
        if(!b_edit_folder_file.hasClass('d-none')){
          b_edit_folder_file.addClass('d-none');
        }
      }
  
      if(permissions.move_folder_file == '1'){
        if(b_move_folder_file.hasClass('d-none')){
          b_move_folder_file.removeClass('d-none');
        }  
      } else {
        if(!b_move_folder_file.hasClass('d-none')){
          b_move_folder_file.addClass('d-none');
        }
      }
  
      if(permissions.trash_folder_file == '1'){
        if(b_trash_folder_file.hasClass('d-none')){
          b_trash_folder_file.removeClass('d-none');
        }  
      } else {
        if(!b_trash_folder_file.hasClass('d-none')){
          b_trash_folder_file.addClass('d-none');
        }
      }
  
      if(permissions.remove_folder_file == '1'){
        if(b_remove_folder_file.hasClass('d-none')){
          b_remove_folder_file.removeClass('d-none');
        }  
  
        if(b_empty_folder_file.hasClass('d-none')){
          b_empty_folder_file.removeClass('d-none');
        }
      } else {
        if(!b_remove_folder_file.hasClass('d-none')){
          b_remove_folder_file.addClass('d-none');
        }
  
        if(!b_empty_folder_file.hasClass('d-none')){
          b_empty_folder_file.addClass('d-none');
        }
      }
    }
  
  // -------------------------------------------------------------------------------------------------------------
  
    $('#btn-modal-folder-manager-entry-cancel').click(function(){
      closeEntry();
    });
  
  // -------------------------------------------------------------------------------------------------------------
  // Business Form Templates Category Entry Extras
  // -------------------------------------------------------------------------------------------------------------
    $('#btn-modal-folder-manager-entry-create-category').click(function(){
      if(!$('#category_selection').hasClass('d-none')){
        $('#category_selection').addClass('d-none');  
      }
  
      if($('#category_entry').hasClass('d-none')){
        $('#category_entry').removeClass('d-none');
      }
  
      current_process = 'add_category';
  
      $('button.bft-btn-control').removeClass('border-info');
      $(this).addClass('border-info');
    });
  
    $('#btn-modal-folder-manager-entry-edit-category').click(function(){
      if($('#category_selection').hasClass('d-none')){
        $('#category_selection').removeClass('d-none'); 
      }
  
      $('#f_category').val(""); 
  
      if($('#category_entry').hasClass('d-none')){
        $('#category_entry').removeClass('d-none');
      }
  
      current_process = 'edit_category';
  
      $('button.bft-btn-control').removeClass('border-info');
      $(this).addClass('border-info');
    });
  
    $('#btn-modal-folder-manager-entry-delete-category').click(function(){
      if($('#category_selection').hasClass('d-none')){
        $('#category_selection').removeClass('d-none'); 
      }
  
      $('#f_category').val("");
  
      if(!$('#category_entry').hasClass('d-none')){
        $('#category_entry').addClass('d-none');
      }
  
      current_process = 'delete_category';
  
      $('button.bft-btn-control').removeClass('border-info');
      $(this).addClass('border-info');
    });
  
    $('#f_category').on('change', function(){
      if(current_process == 'edit_category'){
        var selected_category = $(this).children('option:selected');
  
        if($(this).val() == ""){
          $('#category_name').val("");
          $('#category_desc').val(""); 
        } else {
          var sc_text = selected_category.text();
          var sc_desc = selected_category.attr('catdesc');
  
          $('#category_name').val(sc_text);
          $('#category_desc').val(sc_desc);
        }
      }
    });
  // -------------------------------------------------------------------------------------------------------------
  
  // -------------------------------------------------------------------------------------------------------------
  // Confirm alert type controls
  // -------------------------------------------------------------------------------------------------------------
    $('#btn-modal-folder-manager-alert-confirm').click(function(){
      if(current_process == 'delete_folder'){
        var folder_id = selected;
  
        $.ajax({
          type: 'POST',
          url: base_url + "folders/delete",
          data: {folder_id:folder_id,section:vType},
          beforeSend: function(){
  
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              hideFolderManagerNotif();
  
              showFolderManagerNotif('Error', result.error, 'error');      
            } else {
              getFoldersAndFiles(current_selected_folder);
  
              hideFolderManagerNotif();
            }
          },
          error: function(jqXHR, textStatus, errorThrown){            
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          }
        });
      } else if(current_process == 'delete_file'){
        var file_id = selected;
        
        $.ajax({
          type: 'POST',
          url: base_url + "vault/delete",
          data: {file_id:file_id,section:vType},
          beforeSend: function(){
  
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              showFolderManagerNotif('Error', result.error, 'error');      
            } else {
              getFoldersAndFiles(current_selected_folder);
  
              hideFolderManagerNotif();
            }
          },
          error: function(jqXHR, textStatus, errorThrown){            
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          } 
        });   
      } else if(current_process == 'remove_folder'){
        var div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]');
  
        var folder_id = selected_trash;
        var folder_name = div.attr('fnm');
  
        $.ajax({
          xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
          },
  
          type: 'POST',
          url: base_url + "folders/remove",
          data: {folder_id:folder_id,section:vType},
          beforeSend: function(){
            hideFolderManagerNotif();
  
            showUploading('Removing folder ' + folder_name, true);
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              hideUploading();
  
              showFolderManagerNotif('Error', result.error, 'error');      
            } else {
              getTrashRecords(false);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){   
            hideUploading();
                      
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          }
        });
      } else if(current_process == 'remove_file'){
        var file_id = selected_trash;
        
        $.ajax({
          type: 'POST',
          url: base_url + "vault/remove",
          data: {file_id:file_id,section:vType},
          beforeSend: function(){
  
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              showFolderManagerNotif('Error', result.error, 'error');      
            } else {
              getTrashRecords(false);
  
              hideFolderManagerNotif();
            }
          },
          error: function(jqXHR, textStatus, errorThrown){            
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          } 
        });
      } else if(current_process == 'empty_trash'){
        $.ajax({
          xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            percentComplete = percentComplete.toFixed(0);
                            $('#modal-folder-manager-uploading-percentage').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
          },
  
          type: 'POST',
          url: base_url + "folders/emptytrash",
          data: {section:vType},
          beforeSend: function(){
            hideFolderManagerNotif();
  
            showUploading('Emptying Recycle Bin', true);
          },
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.error != ''){
              hideUploading();
  
              showFolderManagerNotif('Error', result.error, 'error');      
            } else {
              getTrashRecords(false);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){   
            hideUploading();
                      
            showFolderManagerNotif(textStatus, errorThrown, 'error');  
          }
        });  
      }
    });
  
  // Close folder manager alert modal
    $('#btn-modal-folder-manager-alert-cancel,#btn-modal-folder-manager-alert-ok').click(function(){
      hideFolderManagerNotif();
    });
  
  // Search for folders and files --------------------------------------------------------------------------------
    $('#btn-modal-folder-manager-search').click(function(){
      search_files_and_folders();
    });
  // Document ready end ------------------------------------------------------------------------------------------
  });
  
  // Functions below ---------------------------------------------------------------------------------------------
  function getFoldersAndFiles(parent_id = 0){
    var vUrl = base_url + "folders/getFoldersFiles/" + parent_id;
    
    if(vType == 'mylibrary'){
      vUrl += "/1";
    } else if(vType == 'businessformtemplates'){
      vUrl += "/0/1";
    } 
  
    $.ajax({
      type: 'GET',
      url: vUrl,
      success: function(data){
          var result = jQuery.parseJSON(data);
          var folders = result.folders;
          var files = result.files;
          var paths = result.folders_path;
          var fname = result.folders_name;
  
          if(!is_initial){
            $('#folders_name').html(fname);
          } else {
            is_initial = !is_initial;
          }
  
          $('#folders_path').empty();
          $('#folders_path').append(paths);
          $('#f_folder_name').html(fname);
  
          if(vType == 'mylibrary'){
            setFoldersAndFiles_MyLibrary(folders, files);
          } else if(vType == 'businessformtemplates') {
            setFoldersAndFiles_BusinessFormTemplates(folders, files);
          } else {
            setFoldersAndFiles(folders, files);
          }
  
          $('a[control="gotofolder"]').click(function(e){
            e.preventDefault();
  
            current_selected_folder = $(this).attr('href');
  
            getFoldersAndFiles(current_selected_folder);
          });
      },
      error: function(jqXHR, textStatus, errorThrown){
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      },
      complete: function(jqXHR, textStatus){
        if(modalIsOpen('#modal-folder-manager-search')){
          hideFolderManagerSearch();
        }
  
        if(modalIsOpen('#modal-folder-manager-uploading')){
          hideUploading();
        }
      }
    });
  }
  
  //setFoldersAndFiles - Shared Library
  function setFoldersAndFiles_old(folders, files){
    $('#folders_and_files').empty();
  
    selected = 0;
    selected_isFolder = 1;
  
    var row_trace = 1;
    var col_trace = 1;
    var cur_count = 1;
  
    var append = '<div class="row row-' + row_trace + '">';
    $.each(folders, function(index, folder){
      if(col_trace == 7){
        append += '</div>';
  
        col_trace = 1;
        row_trace++;
  
        if(folders.length >= cur_count){
          append += '<div class="row row-' + row_trace + ' mt-4">';
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
            append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
            append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
            append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
            append += '<td style="width: 20%" class="text-right" id="td_total_contents">('+ folder.total_contents +')</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
          append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
          append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
          append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
          append += '<td style="width: 20%" class="text-right" id="td_total_contents">('+ folder.total_contents +')</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }   
  
      col_trace++;
      cur_count++;
    });
  
    var ex_infos = [];
  
    cur_count = 1;
    $.each(files, function(index, file){
      ex_infos = getfileExInfos(file.title);
  
      if(col_trace == 7){
        append += '</div>';
  
        col_trace = 1;
        row_trace++;
  
        if(files.length >= cur_count){
          append += '<div class="row row-' + row_trace + ' mt-4">';
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                        '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
            append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
            append += '<td style="width: 15%"><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
            append += '<td style="width: 85%" class="pl-2">' + file.title + '</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                        '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
          append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
          append += '<td style="width: 15%"><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
          append += '<td style="width: 85%" class="pl-2">' + file.title + '</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }   
  
      col_trace++;
      cur_count++;
    });
    
    append += '</div>';
  
    $('#folders_and_files').append(append);
  
  //On Select Folder or File
    $('tr.node > td, div.node').click(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node');
        var div = $('div[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      var id = div.attr('fid');
      var isFolder = div.attr('isFolder');
      var proceed = ((selected != id) || 
                      ((selected == id) && (selected_isFolder != isFolder)));
  
      if((selected > 0) && (proceed)){
        var prev_div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
  
        if(prev_div.length){
          prev_div.removeClass('bg-info');
          prev_div.removeClass('text-white');
        }  
      }
  
      div.addClass('bg-info');
      div.addClass('text-white');
  
      selected = id;
      selected_isFolder = isFolder;
  
      $('#folders_name').html(div.attr('fnm'));
    });
  
  // On double click folder or file
    $('tr.node > td, div.node').dblclick(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node');
        var div = $('div[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      selected = div.attr('fid');
      selected_isFolder = div.attr('isFolder');
  
      if(selected_isFolder == 1){
        current_selected_folder = selected;
  
        getFoldersAndFiles(selected);
      } else {
        if($('#fs_selected_file').length){
          var fpath = $('#folders_path').text();
  
          fpath = fpath.trim() + div.attr('fnm');
  
          $('#fs_selected_file_text').val(fpath);
          $('#fs_selected_file').val(selected);
          $('#modal-folder-manager').modal('hide');
        } else {
          showFileDetail(selected, selected_isFolder, false, false);
        }
      }  
    });
  }
  
  //setFoldersAndFiles - My Library
  function setFoldersAndFiles_MyLibrary_old(folders, files){
    $('#folders_and_files').empty();
  
    selected = 0;
    selected_isFolder = 1;
  
    var append = '<div class="table-responsive"><table class="table table-bordered table-sm" id="mylibrary_main"><thead><tr>';
  
    append += '<th class="d-none"></th>';
    append += '<th style="width:5%" class="text-center font-weight-bold">Type</th>';
    append += '<th style="width:25%" class="font-weight-bold">Title</th>';
    append += '<th style="width:70%" class="font-weight-bold">Path</th>';
    append += '</tr></thread><tbody>';
  
    var first_folder = true;
  
    $.each(folders, function(index, folder){
      append += '<tr class="node">';
        append += '<td class="d-none" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                  '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +
                  '" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'"></td>';
  
        if(first_folder){
          append += '<td rowspan="@folders@row@span" class="text-center align-top font-weight-bold">Folders</td>';
          first_folder = !first_folder;
        } 
  
        append += '<td class="fname">' + folder.folder_name + '</td>';
        append += '<td class="fpath">/home' + folder.path + '</td>';
  
      append += '</tr>';
    });
  
    append += '<tr><td colspan="3"></td></tr>';
    
    var first_file = true;
  
    $.each(files, function(index, file){
      append += '<tr class="node">';
        append += '<td class="d-none" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                  '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +
                  '" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'"></td>';
  
        if(first_file){
          append += '<td rowspan="@files@row@span" class="text-center align-top font-weight-bold">Files</td>';
          first_file = !first_file;
        } 
  
        append += '<td class="fname">' + file.title + '</td>';
        append += '<td class="fpath">/home' + file.file_path + '</td>';
  
      append += '</tr>';
    });
  
    append += '</tbody></table></div>';
    append = append.replace('@folders@row@span', folders.length);
    append = append.replace('@files@row@span', files.length);
  
    $('#folders_and_files').append(append);
  
    //On Select Folder or File
    $('#mylibrary_main > tbody > tr.node > td').click(function(){
      var tr = $(this).parent('tr');
      var td = tr.children('td:eq(0)');
      var fid = td.attr('fid');
      var ftype = td.attr('isFolder');
      var fname = td.attr('fnm');
      var fpath = tr.children('td.fpath').text();
  
      if($('tr.node.table-primary').length){
        $('tr.node.table-primary').removeClass('table-primary');
      }
  
      tr.addClass('table-primary');
  
      $('#folders_name').text(fname);
      //$('#folders_path').text(fpath);
  
      selected = fid;
      selected_isFolder = ftype;
      
    }).dblclick(function(){
      var tr = $(this).parent('tr');
      var td = tr.children('td:eq(0)');
      var fid = td.attr('fid');
      var ftype = td.attr('isFolder');
  
      selected = fid;
      selected_isFolder = ftype;
  
      if(ftype == 1){
        current_selected_folder = fid;
  
        getFoldersAndFiles(fid);
      } else {
        showFileDetail(selected, selected_isFolder, false, true);  
      }  
    });   
  }
  
  //setFoldersAndFiles - Business Form Templates
  function setFoldersAndFiles_BusinessFormTemplates(folders, files){
    $('#folders_and_files').empty();
  
    var folders_and_files = $('#folders_and_files');
  
    folders_and_files.append('<div id="accordion">');
  
    selected = 0;
    selected_isFolder = 1;
  
    categories = [];
  
    var cur_count = 1;
    var category = '';
    var cur_body_id = '';
    var cur_row_id = '';
    var card_append = '';
    var append = '';
    var in_categories = false;
  
    $.each(folders, function(index, folder){
      if(category != folder.category_id){
        category = folder.category_id;
  
        in_categories = (category in categories);
  
        if(!in_categories){
          categories[category] = {row:1,col:1};
        }
  
        cur_body_id = 'body_bft_' + category;
        cur_row_id = 'row_bft_' + category + '_' + categories[category]['row'];
        
        if(!in_categories){
          card_append = '<div class="card mb-3" id="bft_' + category + '">';
  
          card_append += '<div class="card-header">'+
                          '<a class="card-link font-weight-bold nsm-link" data-bs-toggle="collapse" href="#div_bft_'+ category +'" >'+
                          '<i class="fa fa-plus mr-2 m-2"></i>'+ folder.category_name +
                          '</a><br>';
  
          if((folder.category_desc != "") && (folder.category_desc != null)){
            card_append += '<a class="card-link nsm-link" data-bs-toggle="collapse" href="#div_bft_'+ category +'" >'+
                            '<i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>'+ folder.category_desc +
                            '</small></a>';
          }
          
          card_append += '</div>';
  
          card_append += '<div id="div_bft_'+ category +'" class="collapse">'+
                          '<div class="card-body" id="'+ cur_body_id +'">'+
                          '<div class="row row-' + categories[category]['row'] + ' mt-4" id="'+ cur_row_id +'">'+
                          '</div>'+ 
                          '</div>'+
                          '</div>';
  
          card_append += '</div>';
  
          folders_and_files.append(card_append);
        }
      }
  
      append = '';
  
      if(categories[category]['col'] == 6){
        if(folders.length >= cur_count){
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
            append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
            append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
            append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
            append += '<td style="width: 20%" class="text-right" id="td_total_contents">('+ folder.total_contents +')</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
  
          $('#' + cur_row_id).append(append);
  
          categories[category]['col'] = 1;
          categories[category]['row']++;
  
          cur_row_id = 'row_bft_' + category + '_' + categories[category]['row'];
          
          append = '<div class="row row-' + categories[category]['row'] + ' mt-4" id="'+ cur_row_id +'"></div>';
  
          $('#' + cur_body_id).append(append);
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
          append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
          append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
          append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
          append += '<td style="width: 20%" class="text-right" id="td_total_contents">('+ folder.total_contents +')</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
  
        $('#' + cur_row_id).append(append);
  
        categories[category]['col']++;
      } 
  
      cur_count++;
    });
  
    cur_count = 1;
    category = '';
    cur_body_id = '';
    cur_row_id = '';
    card_append = '';
    append = '';
  
    var in_categories = false;
    var ex_infos = [];
  
    $.each(files, function(index, file){
      ex_infos = getfileExInfos(file.title);
  
      if(category != file.category_id){
        category = file.category_id;
  
        in_categories = (category in categories);
  
        if(!in_categories){
          categories[category] = {row:1,col:1};
        }
  
        cur_body_id = 'body_bft_' + category;
        cur_row_id = 'row_bft_' + category + '_' + categories[category]['row'];
        
        if(!in_categories){
          card_append = '<div class="card" id="bft_' + category + '">';
  
          card_append += '<div class="card-header">'+
                          '<a class="card-link font-weight-bold nsm-link"data-bs-toggle="collapse" href="#div_bft_'+ category +'">'+
                          '<i class="fa fa-plus mr-2"></i>'+ file.category_name +
                          '</a><br>';
  
          if((file.category_desc != "") && (file.category_desc != null)){
            card_append += '<a class="card-link nsm-link" data-bs-toggle="collapse" href="#div_bft_'+ category +'" >'+
                            '<i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>'+ file.category_desc +
                            '</small></a>';
          }
          
          card_append += '</div>';
  
          card_append += '<div id="div_bft_'+ category +'" class="collapse">'+
                          '<div class="card-body" id="'+ cur_body_id +'">'+
                          '<div class="row row-' + categories[category]['row'] + ' mt-4" id="'+ cur_row_id +'">'+
                          '</div>'+ 
                          '</div>'+
                          '</div>';
  
          card_append += '</div>';
  
          folders_and_files.append(card_append);
        }
      }
  
      append = '';
  
      if(categories[category]['col'] == 6){
        if(files.length >= cur_count){
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                          '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
            append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
            append += '<td style="width: 15%"><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
            append += '<td style="width: 85%" class="pl-2">' + file.title + '</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
  
          $('#' + cur_row_id).append(append);
  
          categories[category]['col'] = 1;
          categories[category]['row']++;
  
          cur_row_id = 'row_bft_' + category + '_' + categories[category]['row'];
          
          append = '<div class="row row-' + categories[category]['row'] + ' mt-4" id="'+ cur_row_id +'"></div>';
  
          $('#' + cur_body_id).append(append);
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                        '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
          append += '<table class="border border-0 mb-0 h-100" style="width: 95%"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
          append += '<td style="width: 15%"><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
          append += '<td style="width: 85%" class="pl-2">' + file.title + '</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
  
        $('#' + cur_row_id).append(append);
  
        categories[category]['col']++;
      } 
  
      cur_count++;  
    });
  
    folders_and_files.append('</div>');
  
  //On Select Folder or File
    $('tr.node > td, div.node').click(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node');
        var div = $('div[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      var id = div.attr('fid');
      var isFolder = div.attr('isFolder');
      var proceed = ((selected != id) || 
                      ((selected == id) && (selected_isFolder != isFolder)));
  
      if((selected > 0) && (proceed)){
        var prev_div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
  
        if(prev_div.length){
          prev_div.removeClass('bg-info');
          prev_div.removeClass('text-white');
        }  
      }
  
      div.addClass('bg-info');
      div.addClass('text-white');
  
      selected = id;
      selected_isFolder = isFolder;
  
      $('#folders_name').html(div.attr('fnm'));
    });
  
  // On double click folder or file
    $('tr.node > td, div.node').dblclick(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node');
        var div = $('div[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      selected = div.attr('fid');
      selected_isFolder = div.attr('isFolder');
  
      if(selected_isFolder == 1){
        current_selected_folder = selected;
  
        getFoldersAndFiles(selected);
      } else {
        if($('#fs_selected_file').length){
          var fpath = $('#folders_path').text();
  
          fpath = fpath.trim() + div.attr('fnm');
  
          $('#fs_selected_file_text').val(fpath);
          $('#fs_selected_file').val(selected);
          $('#modal-folder-manager').modal('hide');
        } else {
          showFileDetail(selected, selected_isFolder, false, false);
        }
      }  
    });
  }
  
  // Search Files and Folders
  function search_files_and_folders(){
    var keyword = $('#modal-folder-manager-search-keyword').val();
  
    keyword = keyword.trim();
    if(keyword == ''){
      showFolderManagerNotif('Information','Please enter a keyword','info');
    } else {
      var search_folders = $('#modal-folder-manager-search-check-folder').prop('checked');
      var search_files = $('#modal-folder-manager-search-check-file').prop('checked');
  
      if(search_folders){
        search_folders = 1;
      } else {
        search_folders = 0;
      }
  
      if(search_files){
        search_files = 1;
      } else {
        search_files = 0;
      }
  
      var vUrl = base_url + "vault/search_files_and_folders";
      if(vType == 'mylibrary'){
        vUrl += "/1";
      } else if(vType == 'businessformtemplates'){
        vUrl += "/0/1";
      }
  
      $.ajax({
        type: 'GET',
        url: vUrl,
        data: {keyword: keyword, search_folders: search_folders, search_files: search_files},
        success: function(data){
          var result = jQuery.parseJSON(data);
          var folders = result.folders;
          var files = result.files;
          var append_folders = '';
          var append_files = '';
  
          $('#search_table_folders tbody').empty();
          $('#search_table_files tbody').empty();
  
          $.each(folders, function(index, folder){
            append_folders += '<tr>';
            append_folders += '<td class="d-none">' + folder.in_folder + '</td>';
            append_folders += '<td>' + folder.full_path + '</td>';
            append_folders += '<td>' + folder.searched_title + '</td>';
            append_folders += '</tr>';
          });
  
          $.each(files, function(index, file){
            append_files += '<tr>';
            append_files += '<td class="d-none">' + file.in_folder + '</td>';
            append_files += '<td>' + file.full_path + '</td>';
            append_files += '<td>' + file.searched_title + '</td>';
            append_files += '</tr>';
          });
  
          $('#search_table_folders tbody').append(append_folders);
          $('#search_table_files tbody').append(append_files);
  
  // On select and double click of row from tables on search
          $('#search_table_folders tbody > tr > td, #search_table_files tbody > tr > td').click(function(){
            var parent_row = $(this).parent('tr');
  
            $('tr.table-primary').removeClass('table-primary');
  
            parent_row.addClass('table-primary');
          });
  
          $('#search_table_folders tbody > tr > td, #search_table_files tbody > tr > td').dblclick(function(){
            var folder_id = 0;
            var parent_row = $(this).parent('tr');
  
            $('tr.table-primary').removeClass('table-primary');
  
            parent_row.addClass('table-primary');
  
            folder_id = parent_row.children('td:eq(0)').html();
            folder_id = folder_id.trim();
            console.log(folder_id);
            getFoldersAndFiles(folder_id);
          });    
        },
        error: function(jqXHR, textStatus, errorThrown){
          showFolderManagerNotif(textStatus, errorThrown, 'error');
        }
      });
    }
  }
  
  // Update preview count function
  function update_preview_count(){
    $.ajax({
      type: 'GET',
      url: base_url + "vault/update_preview/" + selected,
      success: function(){
        get_most_previewd_files();  
      },
      error: function(jqXHR, textStatus, errorThrown){
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      } 
    });
  }
  
  // Functions to load tops
  function get_most_download_files(){
    $.ajax({
      type: 'GET',
      url: base_url + 'vault/most_downloads_files',
      success: function(data){
        var result = jQuery.parseJSON(data);
        var nCur = 1;
        var sAppend = '';
        var sFile_Info = [];
  
        if($('#most_downloads').length){
          $('#most_downloads').empty();
          $.each(result, function(index, file){
            sFile_Info = getfileExInfos(file.title); 
            sAppend += '<li class="list-group-item">'+ nCur +'. <i class="' + sFile_Info['icon'] + ' fa-1x ' + sFile_Info['color'] + '"></i>';
            sAppend += '<a href="#" class="ml-1 d-inline">' + file.title + '</a><span class="d-inline float-right">' + file.downloads_count + '</span></li>';  
            nCur++;
          });
  
          if(nCur < 10){
            var i;
            for (i = nCur; i <= 10 ; i++) {
              sAppend += '<li class="list-group-item">' + i + '. - - - ' + '</li>';
            }
          }
  
          $('#most_downloads').append(sAppend);
          $('span[target="most_downloads"]').removeClass('fa-spin');
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('span[target="most_downloads"]').removeClass('fa-spin');
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      }   
    });
  }
  
  function get_most_previewd_files(){
    $.ajax({
      type: 'GET',
      url: base_url + 'vault/most_previewed_files',
      success: function(data){
        var result = jQuery.parseJSON(data);
        var nCur = 1;
        var sAppend = '';
        var sFile_Info = [];
  
        if($('#most_previews').length){
          $('#most_previews').empty();
          $.each(result, function(index, file){
            sFile_Info = getfileExInfos(file.title); 
            sAppend += '<li class="list-group-item">'+ nCur +'. <i class="' + sFile_Info['icon'] + ' fa-1x ' + sFile_Info['color'] + '"></i>';
            sAppend += '<a href="#" class="ml-1 d-inline">' + file.title + '</a><span class="d-inline float-right">' + file.previews_count + '</span></li>';  
            nCur++;
          });
  
          if(nCur < 10){
            var i;
            for (i = nCur; i <= 10 ; i++) {
              sAppend += '<li class="list-group-item">' + i + '. - - - ' + '</li>';
            }
          }
  
          $('#most_previews').append(sAppend);
          $('span[target="most_previews"]').removeClass('fa-spin');
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('span[target="most_previews"]').removeClass('fa-spin');
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      }   
    });
  }
  
  function get_recently_uploaded_files_old(){
    $.ajax({
      type: 'GET',
      url: base_url + 'vault/recently_uploaded_files',
      success: function(data){
        var result = jQuery.parseJSON(data);
        var nCur = 1;
        var sAppend = '';
        var sFile_Info = [];
  
        if($('#recent_uploads').length){
          $('#recent_uploads').empty();
          $.each(result, function(index, file){
            sFile_Info = getfileExInfos(file.title); 
            sAppend += '<li class="list-group-item">'+ nCur +'. <i class="' + sFile_Info['icon'] + ' fa-1x ' + sFile_Info['color'] + '"></i>';
            sAppend += '<a href="#" class="ml-1 d-inline">' + file.title + '</a><span class="d-inline float-right">' + file.days + '</span></li>';  
            nCur++;
          });
  
          if(nCur < 10){
            var i;
            for (i = nCur; i <= 10 ; i++) {
              sAppend += '<li class="list-group-item">' + i + '. - - - ' + '</li>';
            }
          }
  
          $('#recent_uploads').append(sAppend);
          $('span[target="recent_uploads"]').removeClass('fa-spin');
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('span[target="recent_uploads"]').removeClass('fa-spin');
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      }   
    });
  }
  
  function getfileExInfos(filename){
      var ext = filename.split('.');
      var len = ext.length - 1;
  
      var fIcon = '';
      var fColor = '';
      var fIsImage = false;
      var vReturn = {'icon':'','color':''};
  
      ext = ext[len];
  
      switch (ext) {
        case 'pdf':
          fIcon = 'bx bxs-file-pdf';
          fColor = 'text-danger';
          break;
        case 'doc':
        case 'docx':
          fIcon = 'bx bxs-file-doc';
          fColor = 'text-primary';
          break;
        case 'rtf':
          fIcon = 'bx bxs-file-txt';
          break;
        case 'png':
        case 'jpg':
        case 'gif':
          fIcon = 'bx bx-image';
          fColor = 'text-warning';
          fIsImage = true;
          break;
        default:
          fIcon = 'bx bxs-file-txt';
          fColor = 'text-secondary';
          break;
      }
  
      vReturn['icon'] = fIcon;
      vReturn['color'] = fColor;
      vReturn['isImage'] = fIsImage;
  
      return vReturn;
  }
  
  function openEntry(type){
    var vTitle = '';
  
    current_process = type;
  
    if(type == 'create_folder'){
      vTitle = 'Create Folder';
  
      $('#folder_name').val("");
      $('#folder_desc').val("");
      
      if(vType == 'businessformtemplates'){
        $('#f_category').val("");
      }
  
      $('div#folder_entry').removeClass('d-none');
    } else if(type == 'add_file'){
      vTitle = 'Add File';
  
      $('#fullfile').val("");
      $('#file_desc').val("");
  
      if(vType == 'businessformtemplates'){
        $('#f_category').val("");
      }
  
      $('div#file_entry').removeClass('d-none');
    } else if(type == 'add_category'){
      vTitle = 'Category Entry';
  
      $('#category_name').val("");
      $('#category_desc').val("");
      $('#f_category').val("");
  
      $('div#category_selection').addClass('d-none');
      $('div#category_entry').removeClass('d-none');
      $('div#category_controls').removeClass('d-none');
  
      $('button.bft-btn-control').removeClass('border-info');
      $('#btn-modal-folder-manager-entry-create-category').addClass('border-info');
    } else if(type == 'edit_folder'){
      vTitle = 'Edit Folder';
  
      $('div#folder_entry').removeClass('d-none'); 
    } else if(type == 'edit_file'){
      vTitle = 'Edit File';
  
      $('div#file_entry').removeClass('d-none');  
    } else if(type == 'general_permissions'){
      vTitle = 'General Permissions';
  
      $('div#general_permissions_entry').removeClass('d-none');
      $('div#modal-folder-manager-entry-dialog').addClass('modal-lg');
  
      $('#mfme-modal-content').css({"height":"90vh"});
      if(vType == 'businessformtemplates'){
        $('#category_selection').addClass('d-none');
      }
    }
  
    $('#modal-folder-manager-entry-title').text(vTitle);
    $('#modal-folder-manager-entry').modal('show'); 
  }
  
  function closeEntry(){
    if(current_process == 'create_folder'){
      $('div#folder_entry').addClass('d-none');
    } else if(current_process == 'add_file'){
      $('div#file_entry').addClass('d-none');  
    } else if((current_process == 'add_category') || (current_process == 'edit_category') || (current_process == 'delete_category')){
      if($('div#category_selection').hasClass('d-none')){
        $('div#category_selection').removeClass('d-none');
      }
  
      if(!$('div#category_entry').hasClass('d-none')){
        $('div#category_entry').addClass('d-none');
      }
  
      if(!$('div#category_controls').hasClass('d-none')){
        $('div#category_controls').addClass('d-none');
      }  
    } else if(current_process == 'edit_folder'){
      $('div#folder_entry').addClass('d-none');  
    } else if(current_process == 'edit_file'){
      $('div#file_entry').addClass('d-none');  
    } else if(current_process == 'general_permissions'){
      $('div#general_permissions_entry').addClass('d-none');
      $('div#modal-folder-manager-entry-dialog').removeClass('modal-lg');
      $('#mfme-modal-content').css({"height":""});
      if(vType == 'businessformtemplates'){
        $('#category_selection').removeClass('d-none');
      }
    }
  
    current_process = '';
  
    $('#modal-folder-manager-entry-title').text('');
    $('#modal-folder-manager-entry').modal('hide');
  }
  
  function showUploading(filename, vUseShowProgress = false){
    if(!vUseShowProgress){
      var vText = 'Uploading ' + filename;   
    } else {
      var vText = filename;
    }
  
    if(!modalIsOpen('#modal-folder-manager-uploading')){
      $('#modal-folder-manager-uploading-title').text(vText);
      $('#modal-folder-manager-uploading-percentage').text('0%');
      $('#modal-folder-manager-uploading').modal('show');
    }
  }
  
  function hideUploading(){
    if(modalIsOpen('#modal-folder-manager-uploading')){
      $('#modal-folder-manager-uploading').modal('hide');  
    }
  }
  
  function showFileDetail(vS, vSiF, vIsTrash, vIsMyLibrary){
    if($('#download_image_or_file').hasClass('d-none')){
      $('#download_image_or_file').removeClass('d-none'); 
    }
  
    var fnm = '';
    var fpath = '';
  
    if((!vIsTrash) && (!vIsMyLibrary)){
      var div = $('div[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
    } else if(vIsMyLibrary){
      var div = $('td[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
    } else {
      $('#download_image_or_file').addClass('d-none');
  
      var div = $('div.node_trash[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
    }
  
    var file_info = getfileExInfos(div.attr('fnm'));
  
    if(file_info['isImage']){
      if(!vIsTrash){
        update_preview_count();
      }
  
      fpath = div.attr('path');
      fpath = base_url + 'uploads/' + fpath;
      const createdAt = moment(div.attr('created_date')).format("MM/DD/YYYY");
  
      $('#view-image-date-created').text(createdAt);
      $('#view-image-created-by').text(div.attr('created_by'));
  
      $('#modal-folder-manager-view-image-file').attr('src', fpath);
      $('#modal-folder-manager-view-image-title').text(div.attr('fnm'));
      $('#modal-folder-manager-view-image').modal('show');
    } else {
      showFolderDetails(vS, vSiF, vIsTrash, vIsMyLibrary);
    }
  }
  
  function showFolderDetails(vS, vSiF, vIsTrash, vIsMyLibrary, vDiv = ""){
    if(!$('#download_div').hasClass('d-none')){
      $('#download_div').addClass('d-none');
    }
  
    if((!vIsTrash) && (!vIsMyLibrary)){
      var div = $('div[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
    } else if(vIsMyLibrary){ 
      var div = $('td[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
    } else if(vDiv != ""){
      var div = $(vDiv);
    } else {
      var div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]'); 
    }
  
    if(!vIsTrash){
      var fpath = $('#folders_path').text();
      fpath = fpath.trim() + div.attr('fnm');
    } else {
      var fpath = '/home' + div.attr('path_temp');
    }
  
    const createdAt = moment(div.attr('created_date')).format("MM/DD/YYYY");
  
    $('#view-folder-path').text(fpath);
    $('#view-folder-date-uploaded').text(createdAt);
    $('#view-folder-uploaded-by').text(div.attr('created_by'));
  
    $('#modal-folder-manager-view-folder-title').text(div.attr('fnm'));
    $('#modal-folder-manager-view-folder').modal('show');
  
    if(!vIsTrash){
      if((selected_isFolder == 0) && ($('#download_div').hasClass('d-none'))){
        $('#download_div').removeClass('d-none');   
      }
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
        title_class = "";
      }
  
      $('#btn-modal-folder-manager-alert-ok').removeClass('d-none');
    } else if (theme == "confirm") {
      title_class = "bg-warning";
  
      $('#btn-modal-folder-manager-alert-confirm').removeClass('d-none');
      $('#btn-modal-folder-manager-alert-cancel').removeClass('d-none');
    } else if (theme == "success"){
      title_class = "bg-success";
  
      $('#btn-modal-folder-manager-alert-ok').removeClass('d-none');
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
    } else if((current_alert_theme == 'error') || (current_alert_theme == 'info')){
      if(current_alert_theme == 'error'){
        $("#modal-folder-manager-alert-title-div").removeClass('');  
      } else {
        $("#modal-folder-manager-alert-title-div").removeClass('bg-info');  
      }
  
      $('#btn-modal-folder-manager-alert-ok').addClass('d-none');  
    } else if(current_alert_theme == 'success'){
      $("#modal-folder-manager-alert-title-div").removeClass('bg-success');
      $('#btn-modal-folder-manager-alert-ok').addClass('d-none');  
    }
  
    current_alert_theme = '';
    $('#modal-folder-manager-alert').modal('hide');
  }
  
  function showFolderManagerSearch(){
    $('#modal-folder-manager-search').modal('show');
  }
  
  function hideFolderManagerSearch(){
    $('#modal-folder-manager-search').modal('hide');
  }
  
  
  function getTrashRecords(vShowRecycleBin = true, vUpdateMain = false, vFolder_id = -1){
    var vUrl = base_url + "folders/getTrashRecords";
    if(vType == 'mylibrary'){
      vUrl += "/1";
    } else if(vType == 'businessformtemplates'){
      vUrl += "/0/1";
    }
  
    $.ajax({
      type: 'GET',
      url: vUrl,
      success: function(data){
        var result = jQuery.parseJSON(data);
        var folders = result.folders;
        var files = result.files;
  
        setTrashRecords(folders, files);
      },
      error: function(jqXHR, textStatus, errorThrown){
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      },
      complete: function(jqXHR, textStatus){
        if(vShowRecycleBin){
          showFolderManagerRecycleBin();
        }
  
        if((vUpdateMain) && (vFolder_id >= 0) && (vFolder_id == current_selected_folder)){
          getFoldersAndFiles(vFolder_id);
        }
  
        if(modalIsOpen('#modal-folder-manager-uploading')){
          hideUploading();
        }
      }
    });
  }
  
  function setTrashRecords_old(folders, files){
    $('#recycle_bin').empty();
  
    selected_trash = 0;
    selected_trash_isFolder = 1;
  
    var row_trash_trace = 1;
    var col_trash_trace = 1;
    var cur_trash_count = 1;
  
    var append = '<div class="row row-' + row_trash_trace + '">';
    $.each(folders, function(index, folder){
      if(col_trash_trace == 7){
        append += '</div>';
  
        col_trash_trace = 1;
        row_trash_trace++;
  
        if(folders.length >= cur_trash_count){
          append += '<div class="row row-' + row_trash_trace + ' mt-4">';
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node_trash" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
            append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node_trash" isFolder="1" fid="'+ folder.folder_id +'">';
            append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
            append += '<td style="width: 85%" class="pl-2">' + folder.folder_name + '</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node_trash" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                      '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node_trash" isFolder="1" fid="'+ folder.folder_id +'">';
          append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
          append += '<td style="width: 85%" class="pl-2">' + folder.folder_name + '</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }   
  
      col_trash_trace++;
      cur_trash_count++;
    });
  
    var ex_infos = [];
  
    cur_trash_count = 1;
    $.each(files, function(index, file){
      ex_infos = getfileExInfos(file.title);
  
      if(col_trash_trace == 7){
        append += '</div>';
  
        col_trash_trace = 1;
        row_trash_trace++;
  
        if(files.length >= cur_trash_count){
          append += '<div class="row row-' + row_trash_trace + ' mt-4">';
          append += '<div class="col-md-2">';
            append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node_trash" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                        '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
            append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node_trash" isFolder="0" fid="'+ file.file_id +'">';
            append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
            append += '<td class="pl-2">' + file.title + '</td>';
            append += '</tr></tbody></table></div>';
          append += '</div>';
        }
      } else {
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node_trash" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                        '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node_trash" isFolder="0" fid="'+ file.file_id +'">';
          append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
          append += '<td class="pl-2">' + file.title + '</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }   
  
      col_trash_trace++;
      cur_trash_count++;
    });
    
    append += '</div>';
  
    $('#recycle_bin').append(append);
  
  //On Select Trash Folder or File
    $('tr.node_trash > td, div.node_trash').click(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node_trash');
        var div = $('div.node_trash[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      var id = div.attr('fid');
      var isFolder = div.attr('isFolder');
      var proceed = ((selected_trash != id) || 
                      ((selected_trash == id) && (selected_trash_isFolder != isFolder)));
  
      if((selected_trash > 0) && (proceed)){
        var prev_div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]');
  
        if(prev_div.length){
          prev_div.removeClass('bg-info');
          prev_div.removeClass('text-white');
        }  
      }
  
      div.addClass('bg-info');
      div.addClass('text-white');
  
      selected_trash = id;
      selected_trash_isFolder = isFolder;
  
      $('#recycle_bin_selected_name').text(div.attr('fnm'));
      $('#recycle_bin_selected_path').text('/home' + div.attr('path_temp'));
    });
  
  // On double click trash folder or file
    $('tr.node_trash > td, div.node_trash').dblclick(function(){
      var tag = $(this).prop('tagName');
  
      if(tag == 'TD'){
        var row = $(this).parent('tr.node_trash');
        var div = $('div.node_trash[fid="'+ row.attr('fid') +'"][isFolder="'+ row.attr('isFolder') +'"]');
      } else {
        var div = $(this);
      }
      
      selected_trash = div.attr('fid');
      selected_trash_isFolder = div.attr('isFolder');
  
      if(selected_trash_isFolder == 1){
        showFolderDetails(selected_trash, selected_trash_isFolder, true, false);
      } else {
        showFileDetail(selected_trash, selected_trash_isFolder, true, false);
      }  
    });
  }
  
  function restoreFileOrFolder(){
    if(selected_trash != 0){
      $.ajax({
        type: 'POST',
        url: base_url + "folders/restoreFileOrFolder",
        data: {fid:selected_trash,isFolder:selected_trash_isFolder},
        success: function(data){
          var result = jQuery.parseJSON(data);
          if(result.error == ''){
            getTrashRecords(false, true, result.folder_id);
          } else {
            showFolderManagerNotif('Error',result.error,'error');
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          showFolderManagerNotif(textStatus, errorThrown, 'error');
        },
        complete: function(jqXHR, textStatus){
        }
      });
    } else {
      showFolderManagerNotif('Error','Please select a file or folder to restore','error');
    }
  }
  
  function showFolderManagerRecycleBin(){
    $('#modal-folder-manager-recycle-bin').modal('show');  
  }
  
  // Drop To Upload and Multiple Files Upload feature ----------------------------------------------------------------------------------------------------
  // Upload Statuses
  // 0 - Invalid
  // 1 - Dropped
  // 2 - Uploaded
  // 3 - Upload Invalid
  
  function displayDroppedFiles_old(e){
    e.preventDefault();
  
    $('#mfm-dtu-file-list > tbody').empty();
  
    dtu_files = e.dataTransfer.files;
    var append = '';
    $.each(dtu_files, function(index, file){
      append += '<tr>';
      append += '<td class="d-none upstat" uploadstatus="1"></td>';
      append += '<td class="d-none"></td>'
      append += '<td>' + file.name + '</td>';
      append += '<td></td>';
      append += '<td class="text-center"><button type="button" class="btn btn-sm btn-default fs_dtu" title="Exclude"><i class="fa fa-times"></i></button></td>';
      append += '</tr>';
    });
  
    $('#mfm-dtu-file-list > tbody').append(append);
    $('#mfm-dtu-drop-area').addClass('d-none');
    $('#mfm-dtu-file-list-area').removeClass('d-none');
  
    $('button.fs_dtu').click(function(){
      var tr = $(this).parent('td').parent('tr')
      var td = tr.children('td:eq(0)');
      if(td.attr('uploadstatus') <= 1){
        var td_status_original = tr.children('td:eq(1)');
        var td_status = tr.children('td:eq(3)');
  
        if($(this).attr('title') == 'Exclude'){
          $(this).attr('title', 'Include');
          $(this).removeClass('btn-default');
          $(this).addClass('btn-danger');
  
          var status_new = 'Will not be uploaded';
          var status_original = td_status.text();
  
          status_original = status_original.trim();
  
          td.attr('uploadstatus', "0");
          td_status_original.text(status_original);
          td_status.text(status_new);
  
        } else {
          $(this).attr('title', 'Exclude');
          $(this).removeClass('btn-danger');
          $(this).addClass('btn-default');
  
          var status_original = td_status_original.text();
  
          status_original = status_original.trim();
  
          td.attr('uploadstatus', "1");
          td_status_original.text("");
          td_status.text(status_original);
        }
      }
    });
  }
  
  function clearDroppedFiles(){
    if($('#mfm-dtu-drop-area').hasClass('d-none')){
      $('#mfm-dtu-drop-area').removeClass('d-none');
    }
  
    if(!$('#mfm-dtu-file-list-area').hasClass('d-none')){
      $('#mfm-dtu-file-list-area').addClass('d-none');
    }
  
    $('#mfm-dtu-file-list > tbody').empty();  
  }
  
  function showDropToUpload(){
    $('#mfm-dtu').modal('show');
  }
  
  function hideDropToUpload(){
    $('#mfm-dtu-drop-area').removeClass('d-none');
    $('#mfm-dtu-file-list-area').addClass('d-none');
  
    $('#mfm-dtu-file-list > tbody').empty();
  
    if(modalIsOpen('#mfm-dtu')){
      $('#mfm-dtu').modal('hide');
    } 
  }
  
  function setModeInProcess(InProcess){
    $('#dtu_f_category').prop('disabled', InProcess);
  
    $('#upload_dropped_files').prop('disabled', InProcess);
    $('#clear_dropped_files').prop('disabled', InProcess);
    $('#cancel_dropped_files').prop('disabled', InProcess);
  
    $('button.fs_dtu').prop('disabled', InProcess);
  
    if(InProcess){
      if($('#upload_counter').hasClass('d-none')){
        $('#upload_counter').removeClass('d-none');
      }
    } else {
      if(!$('#upload_counter').hasClass('d-none')){
        $('#upload_counter').addClass('d-none');
      }
    }
  
    updateUploadCounter();
  }
  
  function updateUploadCounter(){
    $('#upload_counter').text('Uploading . . . ' + dtu_multiple_uploaded + '/' + dtu_multiple_uploadable);
  }
  
  // Events -------------------------------------------
    $('#cancel_dropped_files').click(function(){
      hideDropToUpload();
    });
  
    $('#upload_dropped_files').click(function(){
      var vCategory = $('#dtu_f_category').val();
      dtu_multiple_uploadable = $('td.upstat[uploadstatus="1"]').length;
  
      if((dtu_multiple_uploadable > 0) && (vCategory != "")){
        dtu_multiple_uploaded = 0;
  
        setModeInProcess(true);
  
        $('#mfm-dtu-file-list > tbody > tr').each(function(){
          var uploadstatus = $(this).children('td:eq(0)').attr('uploadstatus');
          if(uploadstatus == 1){
            var fIndex = $(this).index();
            
            var formdata = new FormData();
            var file = dtu_files[fIndex];
            var desc = "";
            var folder_id = current_selected_folder; //selected folder's id
  
            formdata.append('fullfile', file);
            formdata.append('file_desc', desc);
            formdata.append('folder_id', folder_id);
            formdata.append('category', vCategory);
  
            $.ajax({
              xhr: function() {
                      var xhr = new window.XMLHttpRequest();
                      xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                              var percentComplete = ((evt.loaded / evt.total) * 100);
                              percentComplete = percentComplete.toFixed(0);
                              var txtStatus = 'Uploading . . . ' + percentComplete + '%';
  
                              $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').text(txtStatus);
                          }
                      }, false);
                      return xhr;
              },
              type: 'POST',
              url: base_url + "vault/add",
              data: formdata,
              contentType: false,
              processData: false,
              beforeSend: function(){
              }, 
              success: function(data){
                var result = jQuery.parseJSON(data);
  
                if(result.error != ""){
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').text(result.error);
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('table-danger');
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('border-danger');
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(0)').attr("uploadstatus", "3");   
                } else {
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('table-success');
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('border-success');
                  $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(0)').attr("uploadstatus", "2");   
                }
              },
              error: function(jqXHR, textStatus, errorThrown){ 
                $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').text(errorThrown);
                $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('table-danger');
                $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(3)').addClass('border-danger');
                $('#mfm-dtu-file-list > tbody').children('tr:eq('+ fIndex +')').children('td:eq(0)').attr("uploadstatus", "3");  
              },
              complete: function(jqXHR, textStatus){
                dtu_multiple_uploaded++;
                updateUploadCounter();
  
                if(dtu_multiple_uploaded == dtu_multiple_uploadable){
                  setModeInProcess(false);
                  getFoldersAndFiles(current_selected_folder);
                }    
              }
            });  
          }
        });
      } else {
        var sMsg = 'No Files to Upload';
        if(vCategory == ""){
          sMsg = 'Please select category';
        } else if($('#mfm-dtu-drop-area').hasClass('d-none')){
          sMsg += '.<br>Please Reset Uploads List';
        }
  
        showFolderManagerNotif('Information',sMsg,'info');
      }
    });
  // --------------------------------------------------
  
  // Drop To Upload and Multiple Files Upload feature ----------------------------------------------------------------------------------------------------
  
  function folderSelectedIsNotEmpty() {
  
  }
  
  function fileSelectedIsNotEmpty() {
  
  }
  
  function modalIsOpen(modal_id){
    return ($(modal_id).data('bs.modal') || {})._isShown;
  }
  
  
  // herbert's code
  function onClickFolder({ folder_id, folder_name }) {
    selected = folder_id;
    selected_isFolder = 1;
    $('#folders_name').html(folder_name)
  }
  
  function onDoubleClickFolder({ folder_id }) {
    current_selected_folder = folder_id;
    getFoldersAndFiles(folder_id);
  }
  
  function onClickFile({ file_id, title }) {
    selected = file_id;
    selected_isFolder = 0;
    $('#folders_name').html(title);
  }
  
  function onDoubleClickFile({ file_id, title }) {
    if (!$('#fs_selected_file').length) {
      showFileDetail(file_id, 0, false, false);
      return;
    }
  
    const folderPath = $('#folders_path').text().trim() + title;
    $('#fs_selected_file_text').val(folderPath);
    $('#fs_selected_file').val(file_id);
    $('#modal-folder-manager').modal('hide');
  }
  
  function setFoldersAndFiles(folders, files) {
    const currPath = $('#folders_path').text();
    const currPathWithoutSlash = currPath.replace(/^\/|\/$/g, '');
    const $quickAccess = $("#quick_access");
  
    if (currPathWithoutSlash !== 'home') {
      $quickAccess.hide();
    } else {
      $quickAccess.show();
    }
  
    $('#folders_and_files').empty();
    $('#folders_and_files').append(`
      <div class="row vault">
        <div class="vault__folders">
            <h6 class="vault__title">Folders</h6>
            <div class="vault__spacer"></div>
            <div class="vault__foldersGrid"></div>
        </div>
        <div class="vault__spacer vault__spacer--isLarge"></div>
        <div class="vault__files">
            <h6 class="vault__title">Files</h6>
            <div class="vault__spacer"></div>
            <div class="vault__filesGrid"></div>
        </div>
      </div>
    `);
  
    const folderElements = folders.map((folder) => (
      createFolder(folder, { 
        onClick: onClickFolder, 
        onDoubleClick: onDoubleClickFolder
      })
    ));
  
    const fileElements = files.map((file) => (
      createFile(file, {
        onClick: onClickFile,
        onDoubleClick: onDoubleClickFile
      })
    ));
  
    $('#folders_and_files .vault__foldersGrid').append(
      folderElements.length > 0 ? folderElements : emptyMessage()
    );
  
    $('#folders_and_files .vault__filesGrid').append(
      fileElements.length > 0 ? fileElements : emptyMessage()
    );
  }
  
  function setFoldersAndFiles_MyLibrary(folders, files) {
    setFoldersAndFiles(folders, files);
  }
  
  function emptyMessage() {
    return `<div class="vault__emptyMessage">🤷‍♀️ Nothing to display here</div>`;
  }
  
  function get_recently_uploaded_files() {
    $('#quick_access').empty();
    $('#quick_access').append(`
      <div class="row vault" id="recentlyUploaded">
        <div class="vault__files">
            <h6 class="vault__title">Recently Uploaded</h6>
            <div class="vault__spacer"></div>
            <div class="vault__filesGrid"></div>
        </div>
      </div>
      <div class="vault__spacer vault__spacer--isLarge"></div>
    `);
  
    const $grid = $('#recentlyUploaded .vault__filesGrid');
    $grid.append(fileLoader(7));
  
    $.ajax({
      type: 'GET',
      url: base_url + 'vault/recently_uploaded_files',
      success: function(data){
        const result = jQuery.parseJSON(data);
        const fileElements = result.map((file) => (
          createFile(file, {
            showCreatedDate: true,
            onClick: onClickFile,
            onDoubleClick: onDoubleClickFile,
          })
        ));
  
        $grid.empty();
        $grid.append(fileElements.length > 0 ? fileElements : emptyMessage());
      },
      error: function(_, textStatus, errorThrown){
        $('span[target="recent_uploads"]').removeClass('fa-spin');
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      }   
    });
  }
  
  function getDocusingTemplates(shared=false) {
    $('#docusign_templates').empty();
    $('#docusign_templates').append(`
      <div class="row vault" id="docusigntTemplates">
        <div class="vault__files">
            <h6 class="vault__title">eSign Templates</h6>
            <div class="vault__spacer"></div>
            <div class="vault__filesGrid"></div>
        </div>
      </div>
      <div class="vault__spacer vault__spacer--isLarge"></div>
    `);
  
    const $grid = $('#docusigntTemplates .vault__filesGrid');
    $grid.append(fileLoader(7));
  
    $.ajax({
      type: 'GET',
      url: `${base_url}DocuSign/apiTemplates?shared=${shared}`,
      success: function({ data }) {
        const fileElements = data.map((file) => (
          createDocusignTemplate(file, {
            showCreatedDate: true,
          })
        ));
  
        $grid.empty();
        $grid.append(fileElements.length > 0 ? fileElements : emptyMessage());
      },
      error: function(_, textStatus, errorThrown){
        $('span[target="recent_uploads"]').removeClass('fa-spin');
        showFolderManagerNotif(textStatus, errorThrown, 'error');
      }   
    });
  }
  
  function fileLoader(count = 3) {
    return [...Array(count)].map(() => (
      '<div class="vault__fileLoader"><span></span></div>'
    ));
  }
  
  function createFile(file, options = {}) {
    const { title, FCreatedBy, LCreatedBy, folder_name, file_path, file_id, created } = file;
    const { isTrash = false, showCreatedDate = false, onClick = null, onDoubleClick = null } = options;
  
    const { icon, color: iconColor, isImage } = getfileExInfos(title);
    const createdString = moment(created).format("MMMM DD, YYYY");
    const previewUrl = isImage ? `${base_url}uploads/${folder_name}${file_path}` : null;
  
    const html = `
    <div class="col-md-2 vault__file" title="${title}">
      <div
        class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 ${isTrash ? "node_trash " : "node"} vault__fileInner"
        isfolder="0"
        fid="${file_id}" 
        created_date="${created}"
        created_by="${FCreatedBy} ${LCreatedBy}"
        fnm="${title}"
        path="${folder_name}${file_path}"
        path_temp="${file_path}"
      >
          <table class="border border-0 mb-0 h-100" style="width: 95%">
            <tbody>
                <tr class="node" isfolder="0" fid="${file_id}">
                  <td
                    style="--bg-image: url('${previewUrl}')"
                    isfolder="0"
                    fid="${file_id}" 
                    created_date="${created}"
                    created_by="${FCreatedBy} ${LCreatedBy}"
                    fnm="${title}"
                    path="${folder_name}${file_path}"
                    path_temp="${file_path}"
                  >
                    ${isImage ? '' : `<i class="${icon} fa-2x ${iconColor}"></i>`}
                  </td>
                  <td style="width: 85%" class="pl-2">
                    <div>
                      <i class="${icon} fa-2x align-middle ${iconColor} ml-2"></i>
                      <span class="vault__fileName">${title}</span>
                    </div>
                    ${showCreatedDate ? `<span class="vault__fileDate">${createdString}</span>` : ''}
                  </td>
                </tr>
            </tbody>
          </table>
      </div>
    </div>
    `;
  
    const element = createElementFromHTML(html);
    const $element = $(element);
    const $elementInner = $element.find('.vault__fileInner');
  
    $element.click(function () {
      removeCurrentHighlighted();
      $element.addClass('vault__item--isActive');
      $elementInner.addClass('bg-info');
      $elementInner.addClass('text-white');
  
      if (onClick) onClick(file);
    });
  
    $element.dblclick(function() {
      if (onDoubleClick) onDoubleClick(file);
    });
  
    return element;
  }
  
  function createDocusignTemplate(file, options = {}) {
      //const prefixURL = "http://127.0.0.1/ci/nsmart_v2";
      const prefixURL = "";
  
      const { id, name, created_at, is_shared } = file;
      const { onClick = null, onDoubleClick = null } = options;
      const createdString = moment(created_at).format("MMMM DD, YYYY");
      const templateUrl = `${prefixURL}/eSign_v2/templatePrepare?id=${id}`;
  
      const svgIcon = `<svg style="width: inherit; height: inherit;" viewBox="0 0 640 512"><path fill="currentColor" d="M623.2 192c-51.8 3.5-125.7 54.7-163.1 71.5-29.1 13.1-54.2 24.4-76.1 24.4-22.6 0-26-16.2-21.3-51.9 1.1-8 11.7-79.2-42.7-76.1-25.1 1.5-64.3 24.8-169.5 126L192 182.2c30.4-75.9-53.2-151.5-129.7-102.8L7.4 116.3C0 121-2.2 130.9 2.5 138.4l17.2 27c4.7 7.5 14.6 9.7 22.1 4.9l58-38.9c18.4-11.7 40.7 7.2 32.7 27.1L34.3 404.1C27.5 421 37 448 64 448c8.3 0 16.5-3.2 22.6-9.4 42.2-42.2 154.7-150.7 211.2-195.8-2.2 28.5-2.1 58.9 20.6 83.8 15.3 16.8 37.3 25.3 65.5 25.3 35.6 0 68-14.6 102.3-30 33-14.8 99-62.6 138.4-65.8 8.5-.7 15.2-7.3 15.2-15.8v-32.1c.2-9.1-7.5-16.8-16.6-16.2z"/></svg>`;
  
      const html = `
      <div class="col-md-2 vault__file vault__docusignTemplate" title="${name}">
        <div class="ribbon ribbon-top-left"><span>default</span></div>
        <div
          class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 vault__fileInner"
          isfolder="0"
        >
            <table class="border border-0 mb-0 h-100" style="width: 95%">
              <tbody>
                  <tr class="node" isfolder="0">
                    <td class="preview" isfolder="0" style="position: relative;">
                      <span style="--size: 85px; width: var(--size); height: var(--size); color: var(--green)">
                        ${svgIcon}
                      </span>
                    </td>
                    <td style="width: 85%" class="pl-2 templateFooter">
                      <div class="templateFooter__info">
                        <div>
                          <span style="--size: 25px; width: var(--size); height: var(--size); color: var(--green);" class="mr-2">
                            ${svgIcon}
                          </span>
                          <span class="vault__fileName">${name}</span>
                        </div>
                        <span class="vault__fileDate">${createdString}</span>
                      </div>
  
                      <div class="dropdown">
                        <button class="btn dropdown-toggle templateFooter__actions" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </button>
  
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-action="use">Use</a>
                          <a class="dropdown-item ${is_shared ? 'd-none' : ''}" href="#" data-action="edit">Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);" data-action="copy">Duplicate</a>
                          <a class="dropdown-item ${is_shared ? 'd-none' : ''}" href="#" data-action="makedefault">Set as default</a>
                          <a class="dropdown-item ${is_shared ? 'd-none' : ''}" href="#" data-action="delete">Delete</a>
                          <a class="dropdown-item ${is_shared ? 'd-none' : ''}" href="#" data-action="share">Share with users</a>
                          <a class="dropdown-item ${is_shared ? 'd-none' : ''}" href="#" data-action="uploadThumbnail">Change thumbnail</a>
                        </div>
                      </div>
                    </td>
                  </tr>
              </tbody>
            </table>
        </div>
      </div>
      `;
  
      const element = createElementFromHTML(html);
      const $element = $(element);
      const $elementInner = $element.find('.vault__fileInner');
  
      if (file.is_default) {
        const $prevDefault = $(".vault__docusignTemplate--isDefault");
        $prevDefault.removeClass("vault__docusignTemplate--isDefault");
        $element.addClass("vault__docusignTemplate--isDefault");
      }
  
      const actions = {
        use: () => {
          const urlParams = new URLSearchParams(window.location.search);
          const customerId = urlParams.get("customer_id");
          if (customerId) {
            window.location = `${templateUrl}&customer_id=${customerId}`;
          } else {
            window.location = templateUrl;
          }
        },
        makedefault: async () => {
          try {
            const response = await fetch(`${prefixURL}/DocuSign/apiSetDefault`, {
              method: "POST",
              body: JSON.stringify({ template_id: id }),
              headers: {
                accepts: "application/json",
                "content-type": "application/json",
              },
            });
            const json = await response.json();
            const $prevDefault = $(".vault__docusignTemplate--isDefault");
            $prevDefault.removeClass("vault__docusignTemplate--isDefault");
            $element.addClass("vault__docusignTemplate--isDefault");
          } catch (error) {
            console.log(error);
          }
        },
        copy: async function () {
          Swal.fire({            
              html: "Proceed with duplicating selected template?",
              icon: 'question',
              confirmButtonText: 'Proceed',
              showCancelButton: true,
              cancelButtonText: "Cancel"
          }).then((result) => {
              if (result.value) { 
                $.ajax({
                  url: `${prefixURL}/DocuSign/apiCopyTemplate/${id}`,
                  type: "POST",
                  dataType:'json',
                  success: function (response) {
                    window.location = `${prefixURL}/eSign_v2/templateEdit?id=${response.data.id}`;
                  },
                });
              }
          });          
        },
        share: function () {
          showUsersModal(id);
        },
        delete: function () {
          showDeleteTemplateModal(id);
        },
        uploadThumbnail: function () {
          const $modal = $("#uploadTemplateThumbnail");
          const $input = $modal.find("#uploadTemplateThumbnailFile");
          const $button = $modal.find(".nsm-button.primary");
          const $inputName = $input.parent().find(".custom-file-label__inner");
          const $preview = $modal.find("#uploadTemplateThumbnailFilePreview");
  
          $modal.off();
          $button.off();
  
          $modal.modal("show");
          $modal.on("hidden.bs.modal", function () {
            $input.val("");
            $preview.attr("src", "#");
            $inputName.html("");
          })
  
          $input.on("change", function () {
            const fileName = $(this).val();
            $inputName.html(fileName);
            $preview.attr("src", URL.createObjectURL($input.get(0).files[0]));
          });
  
          $button.on("click", async function () {
            $button.attr("disabled", true);
            $button.find(".spinner-border").removeClass("d-none");
  
            const formData = new FormData();
            formData.append("thumbnail", $input.get(0).files[0]);
            formData.append("template_id", id);
  
            const response = await fetch(`${prefixURL}/DocuSign/apiUploadTemplateThumbnail`, {
              method: "POST",
              body: formData,
            });
  
            const { data } = await response.json();
            $button.attr("disabled", false);
            $button.find(".spinner-border").addClass("d-none");
            $input.val("");
  
            $modal.modal("hide");
            actions.showThumbnail(data);
          });
        },
        showThumbnail: function (thumbnail) {
          const $preview = $element.find(".preview");
          const { filepath } = thumbnail;
          const backgroundImage = base_url + filepath.replace(/\//, "");
          $preview.css({ "--bg-image": `url('${backgroundImage}')` });
          $preview.find("span").css({ display: "none" });
        },
        edit: function () {
          window.location = `${prefixURL}/eSign_v2/templateEdit?id=${id}`;
        }
      }
  
      if (file.thumbnail) {
        actions.showThumbnail(file.thumbnail);
      }
    
      $element.click(function () {
        removeCurrentHighlighted();
        $element.addClass('vault__item--isActive');
        $elementInner.addClass('bg-info');
        $elementInner.addClass('text-white');
    
        if (onClick) onClick(file);
      });
    
      $element.dblclick(function() {
        if (onDoubleClick) onDoubleClick(file);
      });
  
      $element.find(".dropdown-item").click(async function (event) {
        const action = $(this).attr("data-action");
  
        if (action) {
          event.preventDefault();
        }

        if (actions[action]) {
          await actions[action]();
        }
      });
    
      return element;
    }
    
  function createFolder(folder, options = {}) {
    const { folder_id, create_date, FCreatedBy, LCreatedBy, folder_name, c_folder, path, total_contents } = folder;
    const { isTrash = false, onClick = null, onDoubleClick = null } = options;
  
    const html = `
    <div class="col-md-2 vault__folder" title="${folder_name}">
      <div
        class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 ${isTrash ? "node_trash " : "node"} vault__folderInner"
        isfolder="1"
        fid="${folder_id}"
        created_date="${create_date}"
        created_by="${FCreatedBy} ${LCreatedBy}"
        fnm="${folder_name}"
        path="${c_folder}${path}"
        path_temp="${path}"
      >
          <table class="border border-0 mb-0 h-100" style="width: 95%">
            <tbody>
                <tr class="node" isfolder="1" fid="21">
                  <td 
                  isfolder="1"
                  fid="${folder_id}"
                  created_date="${create_date}"
                  created_by="${FCreatedBy} ${LCreatedBy}"
                  fnm="${folder_name}"
                  path="${c_folder}${path}"
                  path_temp="${path}"
                  style="width: 15%"
                ><i class="fa fa-folder fa-2x align-middle text-primary ml-2"></i></td>
                  <td style="width: 65%" class="pl-2">${folder_name}</td>
                  <td style="width: 20%" class="text-right" id="td_total_contents">(${total_contents})</td>
                </tr>
            </tbody>
          </table>
      </div>
    </div>
    `;
  
    const element = createElementFromHTML(html);
    const $element = $(element);
    const $elementInner = $element.find('.vault__folderInner');
  
    $element.click(function () {
      removeCurrentHighlighted();
      $element.addClass('vault__item--isActive');
      $elementInner.addClass('bg-info');
      $elementInner.addClass('text-white');
  
      if (onClick) onClick(folder);
    });
  
    $element.dblclick(function() {
      if (onDoubleClick) onDoubleClick(folder);
    });
  
    return element;
  }
  
  // https://stackoverflow.com/a/494348/8062659
  function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();
    return div.firstChild; 
  }
  
  function removeCurrentHighlighted() {
    $('.vault__item--isActive').removeClass('vault__item--isActive');
  
    $folderActive = $('.vault__folderInner.bg-info.text-white');
    $folderActive.removeClass('bg-info');
    $folderActive.removeClass('text-white');
  
    $fileActive = $('.vault__fileInner.bg-info.text-white');
    $fileActive.removeClass('bg-info');
    $fileActive.removeClass('text-white');
  }
  
  function displayDroppedFiles(event) {
    event.preventDefault();
    $('#mfm-dtu-file-list > tbody').empty();
  
    // these are from Uploadlib.php
    let validExtensions = 'gif|jpg|png|jpeg|doc|pdf|rtf|docx|xls|xlsx';
    validExtensions = validExtensions.split('|');
  
    const { files: fileList } = event.dataTransfer;
    const files = [...fileList];
  
    const validFiles = files.filter(({ name }) => {
      const fileExtension = name.split('.').pop();
      return validExtensions.includes(fileExtension);
    });
  
    if (validFiles.length === 0) {
      return;
    }
  
    dtu_files = files;
    var append = '';
    $.each(validFiles, function(index,  file){
      append += '<tr>';
      append += '<td class="d-none upstat" uploadstatus="1"></td>';
      append += '<td class="d-none"></td>'
      append += '<td>' + file.name + '</td>';
      append += '<td></td>';
      append += '<td class="text-center"><button type="button" class="btn btn-sm btn-default fs_dtu" title="Exclude"><i class="fa fa-times"></i></button></td>';
      append += '</tr>';
    });
  
    $('#mfm-dtu-file-list > tbody').append(append);
    $('#mfm-dtu-drop-area').addClass('d-none');
    $('#mfm-dtu-file-list-area').removeClass('d-none');
  
    $('button.fs_dtu').click(function(){
      var tr = $(this).parent('td').parent('tr')
      var td = tr.children('td:eq(0)');
      if(td.attr('uploadstatus') <= 1){
        var td_status_original = tr.children('td:eq(1)');
        var td_status = tr.children('td:eq(3)');
  
        if($(this).attr('title') == 'Exclude'){
          $(this).attr('title', 'Include');
          $(this).removeClass('btn-default');
          $(this).addClass('btn-danger');
  
          var status_new = 'Will not be uploaded';
          var status_original = td_status.text();
  
          status_original = status_original.trim();
  
          td.attr('uploadstatus', "0");
          td_status_original.text(status_original);
          td_status.text(status_new);
  
        } else {
          $(this).attr('title', 'Exclude');
          $(this).removeClass('btn-danger');
          $(this).addClass('btn-default');
  
          var status_original = td_status_original.text();
  
          status_original = status_original.trim();
  
          td.attr('uploadstatus', "1");
          td_status_original.text("");
          td_status.text(status_original);
        }
      }
    });
  }
  
  function setTrashRecords(folders, files) {
    $('#recycle_bin').empty();
    $('#recycle_bin').append(`
      <div class="row vault">
        <div class="vault__folders">
            <h6 class="vault__title">Folders</h6>
            <div class="vault__spacer"></div>
            <div class="vault__foldersGrid"></div>
        </div>
        <div class="vault__spacer vault__spacer--isLarge"></div>
        <div class="vault__files">
            <h6 class="vault__title">Files</h6>
            <div class="vault__spacer"></div>
            <div class="vault__filesGrid"></div>
        </div>
      </div>
    `);
  
    const onClickFolder = ({ folder_id, folder_name, path }) => {
      selected_trash = folder_id;
      selected_trash_isFolder = 1;
      $('#recycle_bin_selected_name').text(folder_name);
      $('#recycle_bin_selected_path').text('/home' + path);
    };
  
    const onDoubleClickFolder = ({ folder_id }) => {
      selected_trash = folder_id;
      selected_trash_isFolder = 1;
      showFolderDetails(selected_trash, selected_trash_isFolder, true, false);
    }
  
    const onClickFile = ({ file_id, title, file_path }) => {
      selected_trash = file_id;
      selected_trash_isFolder = 0;
      $('#recycle_bin_selected_name').text(title);
      $('#recycle_bin_selected_path').text('/home' + file_path);
    };
  
    const onDoubleClickFile = ({ file_id }) => {
      selected_trash = file_id;
      selected_trash_isFolder = 0;
      showFileDetail(selected_trash, selected_trash_isFolder, true, false);
    }
  
    const folderElements = folders.map((folder) => (
      createFolder(folder, {
        isTrash: true, 
        onClick: onClickFolder, 
        onDoubleClick: onDoubleClickFolder
      })
    ));
  
    const fileElements = files.map((file) => (
      createFile(file, {
        isTrash: true,
        onClick: onClickFile,
        onDoubleClick: onDoubleClickFile
      })
    ));
  
    $('#recycle_bin .vault__foldersGrid').append(
      folderElements.length > 0 ? folderElements : emptyMessage()
    );
  
    $('#recycle_bin .vault__filesGrid').append(
      fileElements.length > 0 ? fileElements : emptyMessage()
    );
  }
  
  function showUsersModal(templateId) {
    const $table = $("#usersTable");
    const urlPrefix = "";
  
    const table = $table.DataTable({
      searching: false,
      destroy: true,
      ajax: `${urlPrefix}/DocuSign/apiGetUsers/${templateId}`,
      columns: [
        {
          data: "id",
          checkboxes: {
            selectRow: true,
            select: true
          },
        },
        {
          sortable: false,
          render: function (_, _, row) {
            return `${row.FName} ${row.LName}`;
          },
        },
        {
          sortable: false,
          data: "email",
        },
      ],
      rowId: function (row) {
        return `row${row.id}`;
      },
      createdRow: function (row, data) {
        $(row).attr("data-id", data.id);
      },
      order: [[1, "asc"]],
      initComplete: function(_, { data }) {
        table.rows().every(function () {
          const $node = $(this.node());
          const id = $node.attr("data-id");
          const { is_selected } = data.find(d => d.id == id);
          $node.find(".dt-checkboxes").attr("checked", is_selected);
        });
      }
    });
  
    const $modal = $("#usersModal");
    const $submit = $modal.find(".nsm-button.primary");
  
    $modal.modal("show");
    $submit.off("click");
  
    $submit.on("click", async function () {
      $this = $(this);
      $spinner = $this.find(".spinner-border");
  
      $spinner.removeClass("d-none");
      $this.prop("disabled", true);
  
      let selectedIds = [];
      table.rows().every(function () {
        const $node = $(this.node());
        if ($node.find(".dt-checkboxes").is(":checked")) {
          selectedIds.push($node.attr("data-id"));
        }
      });
  
      const payload = {
        user_ids: selectedIds,
        template_id: templateId
      };
  
      const response = await fetch(`${urlPrefix}/DocuSign/apiShareTemplate`, {
        method: "POST",
        body: JSON.stringify(payload),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });
  
      const { data } = await response.json();
      console.log(data);
  
      $spinner.addClass("d-none");
      $this.prop("disabled", false);
      $modal.modal("hide");
    });
  }
  
  
  function showDeleteTemplateModal(templateId) {
    //const urlPrefix = "http://127.0.0.1/ci/nsmart_v2";
    const urlPrefix = "";
  
    const $modal = $("#deleteTemplateModal");
    const $submit = $modal.find(".nsm-button.primary");
  
    $modal.modal("show");
    $submit.off("click");
  
    $submit.on("click", async function () {
      $this = $(this);
      $spinner = $this.find(".spinner-border");
  
      $spinner.removeClass("d-none");
      $this.prop("disabled", true);
  
      const response = await fetch(`${urlPrefix}/DocuSign/apiDeleteTemplate/${templateId}`, {
        method: "DELETE",
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });
  
      const { data } = await response.json();
      console.log(data);
  
      $spinner.addClass("d-none");
      $this.prop("disabled", false);
      $modal.modal("hide");
  
      if (vType === 'mylibrary') {
        getDocusingTemplates();
      }
    
      if (vType === 'sharedlibrary') {
        getDocusingTemplates(shared=true);
      }
    });
  }
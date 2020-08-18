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

  current_selected_folder = 0;
  current_process = '';
  current_alert_theme = '';

  clear_process = true;
  is_initial = true;

// -------------------------------------------------------------------------------------------------------------
// Load initial functions
// -------------------------------------------------------------------------------------------------------------
  getFoldersAndFiles();
  get_most_download_files();
  get_most_previewd_files();
  get_recently_uploaded_files();  
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
            closeEntry();

            showUploading(file.name);
          }, 
          success: function(data){
            var result = jQuery.parseJSON(data);

            hideUploading();

            if(result.error != ""){
              showFolderManagerNotif('Error', result.error, 'error');  
            } else {
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

              var append = '<option value="">Select Category</option>';

              $.each(result.categories, function(index, category){
                append += '<option value="'+ category.category_id +'">' + category.category_name + '</option>';
              }); 

              $('#f_category').append(append);

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
      var folder_id = selected;

      $.ajax({
        type: 'POST',
        url: base_url + "folders/delete",
        data: {folder_id:folder_id},
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
        data: {file_id:file_id},
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
    }
  });
}

//setFoldersAndFiles - Shared Library
function setFoldersAndFiles(folders, files){
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
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
          append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
          append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
          append += '<td style="width: 20%" class="text-center" id="td_total_contents">('+ folder.total_contents +')</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }
    } else {
      append += '<div class="col-md-2">';
        append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                   '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
        append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
        append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
        append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
        append += '<td style="width: 20%" class="text-center" id="td_total_contents">('+ folder.total_contents +')</td>';
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
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
          append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
          append += '<td class="pl-2">' + file.title + '</td>';
          append += '</tr></tbody></table></div>';
        append += '</div>';
      }
    } else {
      append += '<div class="col-md-2">';
        append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                     '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
        append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
        append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
        append += '<td class="pl-2">' + file.title + '</td>';
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
function setFoldersAndFiles_MyLibrary(folders, files){
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
      append += '<td class="fpath">/root/' + folder.path + '</td>';

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
      append += '<td class="fpath">/root' + file.file_path + '</td>';

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

  var categories = [];

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
        card_append = '<div class="card" id="bft_' + category + '">';

        card_append += '<div class="card-header">'+
                       '<a class="card-link" data-toggle="collapse" href="#div_bft_'+ category +'">'+
                       '<i class="fa fa-plus mr-2"></i>'+ folder.category_name +
                       '</a>'+
                       '</div>';

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

    if(categories[category]['col'] == 7){
      if(folders.length >= cur_count){
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="1" fid="'+ folder.folder_id +'" created_date="'+ folder.create_date +
                   '" created_by="'+ folder.FCreatedBy + ' ' + folder.LCreatedBy + '" fnm="'+ folder.folder_name +'" path="'+ folder.c_folder + folder.path +'" path_temp="'+ folder.path +'">';
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
          append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
          append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
          append += '<td style="width: 20%" class="text-center" id="td_total_contents">('+ folder.total_contents +')</td>';
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
        append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="1" fid="'+ folder.folder_id +'">';
        append += '<td style="width: 15%"><i class="fa fa-folder-open-o fa-2x align-middle text-primary ml-2"></i></td>';
        append += '<td style="width: 65%" class="pl-2">' + folder.folder_name + '</td>';
        append += '<td style="width: 20%" class="text-center" id="td_total_contents">('+ folder.total_contents +')</td>';
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
                       '<a class="card-link" data-toggle="collapse" href="#div_bft_'+ category +'">'+
                       '<i class="fa fa-plus mr-2"></i>'+ file.category_name +
                       '</a>'+
                       '</div>';

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

    if(categories[category]['col'] == 7){
      if(files.length >= cur_count){
        append += '<div class="col-md-2">';
          append += '<div class="table-responsive shadow-sm rounded border border-secondary h-100 py-2 node" isFolder="0" fid="'+ file.file_id +'" created_date="'+ file.created +
                       '" created_by="'+ file.FCreatedBy + ' ' + file.LCreatedBy + '" fnm="'+ file.title +'" path="'+ file.folder_name + file.file_path +'" path_temp="'+ file.file_path +'">';
          append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
          append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
          append += '<td class="pl-2">' + file.title + '</td>';
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
        append += '<table class="border border-0 mb-0 h-100"><tbody><tr class="node" isFolder="0" fid="'+ file.file_id +'">';
        append += '<td><i class="'+ ex_infos['icon'] +' fa-2x align-middle '+ ex_infos['color'] +' ml-2"></i></td>';
        append += '<td class="pl-2">' + file.title + '</td>';
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

function get_recently_uploaded_files(){
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
        fIcon = 'fa fa-file-pdf-o';
        fColor = 'text-danger';
        break;
      case 'doc':
      case 'docx':
        fIcon = 'fa fa-file-word-o';
        fColor = 'text-primary';
        break;
      case 'rtf':
        fIcon = 'fa fa-file-text-o';
        break;
      case 'png':
      case 'jpg':
      case 'gif':
        fIcon = 'fa fa-file-image-o';
        fColor = 'text-warning';
        fIsImage = true;
        break;
      default:
        fIcon = 'fa fa-file-o';
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

    $('div#folder_entry').removeClass('d-none');
  } else if(type == 'add_file'){
    vTitle = 'Add File';

    $('#fullfile').val("");
    $('#file_desc').val("");

    $('div#file_entry').removeClass('d-none');
  } else if(type == 'add_category'){
    vTitle = 'Category Entry';

    $('#category_name').val("");
    $('#category_desc').val("");

    $('div#category_selection').addClass('d-none');
    $('div#category_entry').removeClass('d-none');
  }

  $('#modal-folder-manager-entry-title').text(vTitle);
  $('#modal-folder-manager-entry').modal('show'); 
}

function closeEntry(){
  if(current_process == 'create_folder'){
    $('div#folder_entry').addClass('d-none');
  } else if(current_process == 'add_file'){
    $('div#file_entry').addClass('d-none');  
  } else if(current_process == 'add_category'){
    $('div#category_selection').removeClass('d-none');
    $('div#category_entry').addClass('d-none');  
  }

  current_process = '';

  $('#modal-folder-manager-entry-title').text('');
  $('#modal-folder-manager-entry').modal('hide');
}

function showUploading(filename){
  if(!modalIsOpen('#modal-folder-manager-uploading')){
    $('#modal-folder-manager-uploading-title').text('Uploading ' + filename);
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

    $('#view-image-date-created').text(div.attr('created_date'));
    $('#view-image-created-by').text(div.attr('created_by'));

    $('#modal-folder-manager-view-image-file').attr('src', fpath);
    $('#modal-folder-manager-view-image-title').text(div.attr('fnm'));
    $('#modal-folder-manager-view-image').modal('show');
  } else {
    showFolderDetails(vS, vSiF, vIsTrash, vIsMyLibrary);
  }
}

function showFolderDetails(vS, vSiF, vIsTrash, vIsMyLibrary){
  if(!$('#download_div').hasClass('d-none')){
    $('#download_div').addClass('d-none');
  }

  if((!vIsTrash) && (!vIsMyLibrary)){
    var div = $('div[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
  } else if(vIsMyLibrary){ 
    var div = $('td[fid="'+ vS +'"][isFolder="'+ vSiF +'"]');
  } else {
    var div = $('div.node_trash[fid="'+ selected_trash +'"][isFolder="'+ selected_trash_isFolder +'"]'); 
  }

  if(!vIsTrash){
    var fpath = $('#folders_path').text();
    fpath = fpath.trim() + div.attr('fnm');
  } else {
    var fpath = '/root' + div.attr('path_temp');
  }

  $('#view-folder-path').text(fpath);
  $('#view-folder-date-uploaded').text(div.attr('created_date'));
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
    }
  });
}

function setTrashRecords(folders, files){
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

function displayDroppedFiles(e){
  e.preventDefault();

  $('#mfm-dtu-file-list').empty();

  var files = e.dataTransfer.files;
  var append = '';
  $.each(files, function(index, file){
    append += '<li class="list-group-item">' + file.name + '</li>';
  });

  $('#mfm-dtu-file-list').append(append);
  $('#mfm-dtu-drop-area').addClass('d-none');
  $('#mfm-dtu-file-list-area').removeClass('d-none');
}

function showDropToUpload(){
  $('#mfm-dtu').modal('show');
}

function hideDropToUpload(){
  $('#mfm-dtu-drop-area').removeClass('d-none');
  $('#mfm-dtu-file-list-area').addClass('d-none');

  if(modalIsOpen('#mfm-dtu')){
    $('#mfm-dtu').modal('hide');
  } 
}

function folderSelectedIsNotEmpty() {

}

function fileSelectedIsNotEmpty() {

}

function modalIsOpen(modal_id){
  return ($(modal_id).data('bs.modal') || {})._isShown;
}
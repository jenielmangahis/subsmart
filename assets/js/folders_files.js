$(document).ready(function(){
// Document ready start ----------------------------------------------------------------------------------------
  
  $(document).on('show.bs.modal', '.modal', function (event) {
      var zIndex = 1040 + (10 * $('.modal:visible').length);
      $(this).css('z-index', zIndex);
      setTimeout(function() {
          $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      }, 0);
  });
  
  current_selected_folder = 0;

  selected = 0;
  selected_isFolder = 1;

  current_process = '';
  current_alert_theme = '';

  clear_process = true;

  row_trace = 1;
  col_trace = 1;

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
      var div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
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
                               'Delete' + confirm_text + '?<br>' + confirm_path, 'confirm');
      }
    } else {
      showFolderManagerNotif('Error','Please select a file or a folder to delete','error');
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

    if(selected != 0){
      if(selected_isFolder == 1){
        showFolderDetails();
      } else {
        showFileDetail();
      }
    } else {
      showFolderManagerNotif('Error','Please select a file or a folder to view','error');
    }
  });

// download file
  $('a[control="download"]').click(function(e){
    e.preventDefault();

    window.open(base_url + 'vault/download_file/' + selected);
  });
// -------------------------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------------------------
// Folder entry controls
// -------------------------------------------------------------------------------------------------------------
  $('#btn-modal-folder-manager-entry-save').click(function(){
    if(current_process == 'create_folder'){

      var folder_name = $('#folder_name').val();
      var folder_desc = $('#folder_desc').val();
      var parent_id = current_selected_folder;

      folder_name = folder_name.trim();
      folder_desc = folder_desc.trim();

      if(isFolderNameValid(folder_name)){
        $.ajax({
          type: 'POST',
          url: base_url + "folders/create",
          data: {folder_name:folder_name,parent_id:parent_id,folder_desc:folder_desc},
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
    } else if(current_process == 'add_file'){
      var formdata = new FormData();
      var file = $('#fullfile').prop('files')[0];
      var desc = $('#file_desc').val();
      var folder_id = current_selected_folder; //selected folder's id

      formdata.append('fullfile', file);
      formdata.append('file_desc', desc.trim());
      formdata.append('folder_id', folder_id);

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
          if(result.error != ""){
            showFolderManagerNotif('Error', result.error, 'error');  
          } else {
            hideUploading();

            getFoldersAndFiles(current_selected_folder);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){ 
          hideUploading();

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

  $('#btn-modal-folder-manager-alert-cancel,#btn-modal-folder-manager-alert-ok').click(function(){
    hideFolderManagerNotif();
  });

// Document ready end ------------------------------------------------------------------------------------------
});

// Functions below ---------------------------------------------------------------------------------------------
function getFoldersAndFiles(parent_id = 0){
  $.ajax({
    type: 'GET',
    url: base_url + "folders/getFoldersFiles/" + parent_id,
    success: function(data){
        var result = jQuery.parseJSON(data);
        var folders = result.folders;
        var files = result.files;
        var paths = result.folders_path;
        var fname = result.folders_name;

        setFoldersAndFiles(folders, files);

        $('#folders_name').html(fname);
        $('#folders_path').empty();
        $('#folders_path').append(paths);

        $('a[control="gotofolder"]').click(function(e){
          e.preventDefault();

          current_selected_folder = $(this).attr('href');

          getFoldersAndFiles(current_selected_folder);
        });
    },
    error: function(jqXHR, textStatus, errorThrown){
      showFolderManagerNotif(textStatus, errorThrown, 'error');
    }
  });
}

function setFoldersAndFiles(folders, files){
  $('#folders_and_files').empty();

  selected = 0;
  selected_isFolder = 1;

  row_trace = 1;
  col_trace = 1;

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
        showFileDetail();
      }
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

function showFileDetail(){
  var div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
  var file_info = getfileExInfos(div.attr('fnm'));

  if(file_info['isImage']){ 
    var fpath = div.attr('path');

    fpath = base_url + '/uploads/' + fpath;

    $('#view-image-date-created').text(div.attr('created_date'));
    $('#view-image-created-by').text(div.attr('created_by'));

    $('#modal-folder-manager-view-image-file').attr('src', fpath);
    $('#modal-folder-manager-view-image-title').text(div.attr('fnm'));
    $('#modal-folder-manager-view-image').modal('show');
  } else {
    showFolderDetails();
  }
}

function showFolderDetails(){
  if(!$('#download_div').hasClass('d-none')){
    $('#download_div').addClass('d-none');
  }

  var div = $('div[fid="'+ selected +'"][isFolder="'+ selected_isFolder +'"]');
  var fpath = $('#folders_path').text();

  fpath = fpath.trim() + div.attr('fnm');

  $('#view-folder-path').text(fpath);
  $('#view-folder-date-uploaded').text(div.attr('created_date'));
  $('#view-folder-uploaded-by').text(div.attr('created_by'));

  $('#modal-folder-manager-view-folder-title').text(div.attr('fnm'));
  $('#modal-folder-manager-view-folder').modal('show');

  if((selected_isFolder == 0) && ($('#download_div').hasClass('d-none'))){
    $('#download_div').removeClass('d-none');   
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

}

function fileSelectedIsNotEmpty() {

}

function modalIsOpen(modal_id){
  return ($(modal_id).data('bs.modal') || {})._isShown;
}
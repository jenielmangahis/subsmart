<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /* Set the size of the div element that contains the map */
  #map_canvas, 
  .ToFit {
    height: 100% !important;
    width: 100%;
  }

  .trac360_main_sections {
    height: 65vh;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }


  .trac360_side_transparent,
  button.trac360_side_controls:hover,
  button.trac360_side_controls:active:hover {
    background-color: transparent !important;
  }

  .trac360_side_controls:focus,
  .trac360_side_controls:hover,
  .trac360_side_controls:hover {
    outline-style: none !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
  }
 </style>

<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
   <!--<div wrapper__section>-->
   <div id="main_body" class="container-fluid" style="background-color: #6241A4">     
      <div class="row">
         <div class="col-md-12">
            <div class="page-title-box">
               <div class="row align-items-center">
                  <div class="col-md-1">
                  </div>
                  <div class="col-sm-6">
                     <h1 class="page-title text-white">Trac360</h1>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active text-white">Search the globe online</li>
                     </ol>
                  </div>
                  <div class="col-sm-5">
                      
                  </div>
               </div>
            </div>
         </div>
      </div>               
      <div class="row pt-2 pb-5">
        <div class="col-md-1 trac360_main_sections trac360_side_transparent">
          <div class="btn-group-vertical">
            <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id="btn_open_trac360_groups"><span class="fa fa-users fa-3x" class="text-center"></span>Group</button>
            <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id="btn_open_trac360_places"><span class="fa fa-map-marker fa-3x" class="text-center"></span>Places</button>
          </div>
        </div>
        <div class="col-md-4 trac360_main_sections">
          <div class="card p-0 ToFit">
            <div class="card-header pl-1 pr-1">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="m-0" id="cur_tab_title" style="padding-left: 10px">People</h5>
                  <button class="btn btn-sm btn-default border-0 font-weight-bold d-none" style="background-color: transparent !important;" id="prev_tab" prev_tab=""><i class="fa fa-arrow-circle-o-left mr-1"></i>Go Back</button>
                </div>
                <div class="col-md-6">
                  <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="trac360_add_record" title="Add New Record"><i class="fa fa-plus"></i></a>
                  <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="trac360_del_record" title="Remove Record"><i class="fa fa-trash"></i></a>
                  <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1 d-none" control="trac360_save_record" title="Save Record"><i class="fa fa-check"></i></a> 
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pb-0 pl-1 pr-1" style="overflow: auto">
              <div class="tab-content">
                <div class="tab-pane container pl-0 pr-0 active" diventry="people_entry" title="People" id="trac360_groups_people" prev_tab="">

                </div>
                <div class="tab-pane container pl-0 pr-0 fade" diventry="groups_entry" title="Groups" id="groups_tab" prev_tab="">
                  <div class="table-responsive">
                    <table class="table table-bordered mb-0" id="trac360_groups_table">
                      <thead>
                        <tr>
                          <th class="d-none"></th>
                          <th class="font-weight-bold" style="width: 30%">Group Name</th>
                          <th class="font-weight-bold" style="width: 50%">Description</th>
                          <th class="font-weight-bold" style="width: 20%">Record Tag</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($categories as $category){ ?>
                          <tr>
                            <td class="d-none"><?php echo $category->id; ?></td>
                            <td style="width: 30%"><?php echo $category->category_name; ?></td>
                            <td style="width: 50%"><?php echo $category->category_desc; ?></td>
                            <td style="width: 20%"><?php echo $category->category_tag; ?></td> 
                          </tr>
                        <?php } ?>  
                      </tbody>
                    </table>
                  </div>  
                </div>
                <div class="tab-pane container pl-0 pr-0 fade" diventry="places_entry" title="Places" id="places_tab" prev_tab="">
                </div>
                <div class="tab-pane container trac360_entry fade" id="people_entry" title="People Form" prev_tab="">
                  <div class="row mt-4">
                    <div class="col-md-7 form-group">
                      <label for="trac360_people_entry_categories"><strong>Group</strong><small> Select group to add user</small></label>
                      <select class="form-control" name="trac360_people_entry_categories" id="trac360_people_entry_categories">
                        <option value="">Select Group</option>
                        <?php 
                          foreach($categories as $category){
                        ?>
                          <option value="<?php echo $category->id; ?>" catdesc="<?php echo $category->category_desc; ?>"><?php echo $category->category_name; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-5 form-group">
                      <label for="trac360_people_entry_users"><strong>User</strong><small> Select user to trace</small></label>
                      <select class="form-control" name="trac360_people_entry_users" id="trac360_people_entry_users">
                        <option value="">Select User</option>
                        <?php 
                          foreach($users as $user){
                        ?>
                          <option value="<?php echo $user->id; ?>"><?php echo $user->FName . ' ' . $user->LName; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="trac360_people_entry_latitude"><strong>Latitude</strong><small> Initial latitude position</small></label>
                      <input type="number" class="form-control" name="trac360_people_entry_latitude" id="trac360_people_entry_latitude" value="0" required autofocus />
                    </div>
                    <div class="col-md-6">
                      <label for="trac360_people_entry_longitude"><strong>Longitude</strong><small> Initial longitude position</small></label>
                      <input type="number" class="form-control" name="trac360_people_entry_longitude" id="trac360_people_entry_longitude" value="0" required autofocus />
                    </div>
                  </div>
                </div>
                <div class="tab-pane container trac360_entry fade" id="groups_entry" title="Groups Form" prev_tab="">
                  <div class="row mt-4">
                    <div class="col-md-12">
                      <label for="trac360_group_entry_name"><strong>Group Name</strong><small> Name of the group to be displayed in people page</small></label>
                      <input type="text" class="form-control" name="trac360_group_entry_name" id="trac360_group_entry_name" required autofocus />
                    </div>
                    <div class="col-md-12">
                      <label for="trac360_group_entry_desc"><strong>Description</strong><small> Additional details of the group record</small></label>
                      <input type="text" class="form-control" name="trac360_group_entry_desc" id="trac360_group_entry_desc" required autofocus />
                    </div>
                    <div class="col-md-12">
                      <label for="trac360_group_entry_tag"><strong>Record Tag</strong><small> Column Header Name to be used in people page</small></label>
                      <input type="text" class="form-control" name="trac360_group_entry_tag" id="trac360_group_entry_tag" required autofocus />
                    </div>  
                  </div>      
                </div>
                <div class="tab-pane container trac360_entry fade" id="places_entry" title="Places Form" prev_tab="">
                </div>
              </div>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-md-7 trac360_main_sections">
          <?php echo $map ?>
        </div>
         <!-- end row -->           
      </div>
   </div>
   <!--</div>-->
   <!-- end container-fluid -->
<!-- </div> -->

<!-- page wrapper end -->
<?php echo $trac360_manager ?>
<?php include viewPath('includes/footer'); ?>
<?php echo $map_js; ?>
<script>
  $(document).ready(function(){

    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    initialAllLoadStateDone = false;
    initialMapCenter = null;

    groups = {};
    tracking = {};
    requests = {};

    all_users = [];

    new_records_checker = null;
    new_checker_status = 'idle';

    current_theme = '';
    current_process = '';
    current_data = null;

    InitializeBody();
    InitializeMarkers();

// node controls -------------------------------------------------------------
    $('a[control="trac360_add_record"]').click(function(e){
      e.preventDefault();

      var button = $('#prev_tab');
      var tab = $('div.tab-pane.active');
      var entry = 'div#' + tab.attr('diventry');

      tab.removeClass('active');
      tab.addClass('fade');

      $(entry).removeClass('fade');
      $(entry).addClass('active');
    
      button.attr("prev_tab",tab.attr("id"));
      button.removeClass('d-none');

      processNodeControlButtons(tab.attr('diventry'));
    });

    $('a[control="trac360_del_record"]').click(function(e){
      e.preventDefault();

      var row = $('tr.trac360_row.table-primary');
      if(row.length){
        var table_type = row.attr("card");
        if(table_type == "people"){
          var vName = row.children('td:eq(1)').text();

          current_process = 'delete_person';
          current_data = row;

          showAlert('confirm','Are you sure you want to stop tracking <strong>' + vName + '</strong>?','Confirm Stop Tracking');
        }
      } else {
        showAlert('info','No record selected','Delete Record');
      }
    });

    $('a[control="trac360_save_record"]').click(function(){
      var tab = $('div.tab-pane.active');

      if(tab.hasClass('trac360_entry')){
        var id = tab.attr("id");
        
        processSave(id);  
      }  
    });
// ----------------------------------------------------------------------------------

// Other controls -------------------------------------------------------------------
    $('#prev_tab').click(function(){
      var prev_tab = 'div#' + $(this).attr("prev_tab");
      var tab = $('div.tab-pane.active');

      tab.removeClass('active');
      tab.addClass('fade');

      $(prev_tab).removeClass('fade');
      $(prev_tab).addClass('active');

      processNodeControlButtons($(this).attr("prev_tab"));

      if($(prev_tab).attr('prev_tab') != ""){
        $(this).attr("prev_tab",$(prev_tab).attr('prev_tab'));
      } else {
        $(this).attr("prev_tab","");
      }
    });

    $('#btn-modal-trac360-alert-confirm').click(function(){
      if(current_process == 'delete_person'){
        var group_id = current_data.attr('categoryid');
        var user_id = current_data.children('td:eq(0)').text();

        $.ajax({
          type: 'POST',
          url: base_url + "trac360/deletepeople",
          data: {user_id:user_id},
          beforeSend(){
            hideAlert();
          },
          success: function(data){
            var result = jQuery.parseJSON(data);

            if((result.error == "") || (result.error == null)){
              var vUser = groups[group_id]['members'][user_id];
              var vIdx = vUser.idx;

              requests[vIdx]['removed'] = true;
              marker = markers_map[vIdx];
              marker.setMap(null);
              
              markers_map.splice(vIdx, 1);
              current_data.remove();

              showAlert('success','Person successfully added to tracking list','Successful');  
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            showAlert('error',errorThrown,'Error ' + textStatus);  
          },
          complete: function(jqXHR, textStatus){
            current_data = null;
          } 
        }); 
      }
    });

    $('#btn-modal-trac360-alert-ok,#btn-modal-trac360-alert-cancel').click(function(){
      hideAlert();
    });
// ----------------------------------------------------------------------------------

// People Entries events ------------------------------------------------------------
    $('#trac360_people_entry_latitude').on('change', function(){
      if($(this).val() == ""){
        $(this).val(0);  
      }
    });

    $('#trac360_people_entry_longitude').on('change', function(){
      if($(this).val() == ""){
        $(this).val(0);  
      }
    });
// ----------------------------------------------------------------------------------

// Groups Page ----------------------------------------------------------------------
    $('#btn_open_trac360_groups').click(function(){
      var button = $('#prev_tab');
      var tab = $('div.tab-pane.active');
      var groups_tab = $('#groups_tab');

      tab.removeClass('active');
      tab.addClass('fade');

      groups_tab.removeClass('fade');
      groups_tab.addClass('active');

      button.attr("prev_tab",tab.attr("id"));
      button.removeClass('d-none');

      processNodeControlButtons('groups_tab');  
    });
// ----------------------------------------------------------------------------------
  });

// ----------------------------------------------------------------------------------
  function processSave(vEntry){
    if(vEntry == 'people_entry'){
      var category = $('#trac360_people_entry_categories').val();
      var user = $('#trac360_people_entry_users').val();
      var latitude = $('#trac360_people_entry_latitude').val();
      var longitude = $('#trac360_people_entry_longitude').val();

      if(category == ""){
        showAlert('info','Please select group','People Entry');
      } else if(user == ""){
        showAlert('info','Please select user','People Entry');  
      } else {
        $.ajax({
          type: 'POST',
          url: base_url + "trac360/addnewpeople",
          data: {category_id:category,user_id:user,latitude:latitude,longitude:longitude},
          success: function(data){
            var result = jQuery.parseJSON(data);

            if((result.error == "") || (result.error == null)){
              clearPeopleEntries();

              $('#prev_tab').click();

              showAlert('success','Person successfully added to tracking list','Successful');
            } else {
              showAlert('error',result.error,'Error');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            showAlert('error',errorThrown,'Error ' + textStatus);
          } 
        });  
      }
    } else if(vEntry == 'groups_entry'){
      
    }  
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function processNodeControlButtons(vCurTab){
    if((vCurTab == "trac360_groups_people") ||
       (vCurTab == "groups_tab") ||
       (vCurTab == "places_tab")){

      $('a[control="trac360_add_record"]').removeClass('d-none');
      $('a[control="trac360_del_record"]').removeClass('d-none');
      $('a[control="trac360_save_record"]').addClass('d-none');

      if((vCurTab == "groups_tab") || (vCurTab == "places_tab")){
        if($('#prev_tab').hasClass("d-none")){
          $('#prev_tab').removeClass("d-none");
        }
      } else {
        if(!$('#prev_tab').hasClass("d-none")){
          $('#prev_tab').addClass("d-none");  
        }
      }
    } else if((vCurTab == "people_entry") ||
              (vCurTab == "groups_entry") ||
              (vCurTab == "places_tab")){

      $('a[control="trac360_add_record"]').addClass('d-none');
      $('a[control="trac360_del_record"]').addClass('d-none');
      $('a[control="trac360_save_record"]').removeClass('d-none');
      $('#prev_tab').removeClass('d-none');
    }

    $('#cur_tab_title').text($('#' + vCurTab).attr("title"));
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function clearPeopleEntries(){
    $('#trac360_people_entry_categories').val("");
    $('#trac360_people_entry_users').val("");
    $('#trac360_people_entry_latitude').val(0);
    $('#trac360_people_entry_longitude').val(0);   
  }

  function clearGroupEntries(){
    $('#trac360_group_entry_name').val("");
    $('#trac360_group_entry_desc').val("");
    $('#trac360_group_entry_tag').val("");  
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function InitializeBody(){
    var header_height = $('header').css('height');

    header_height = header_height.replace('px','');
    header_height = parseInt(header_height) + 10;
    header_height += 'px';

    $('#main_body').css('padding-top',header_height);
  }
// ----------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------- 
  function InitializeMarkers(){
    $.ajax({
      xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        percentComplete = percentComplete.toFixed(0);
                        $('#modal-trac360-processing-percentage').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
      },
      type: 'GET',
      url: base_url + "trac360/getUsersCategories",
      beforeSend: function(){
        showProcessing();
      },
      success: function(data){
        var result = jQuery.parseJSON(data);
        var categories = result.categories;
        var categories_length = categories.length;

        var users = result.users;
        var first_show = true;
        var first_show_tag = '';
        var append = '';

        $('#trac360_groups_people').empty();

        $.each(categories, function(index, category){
          if(first_show){
            first_show_tag = ' show';

            first_show = !first_show;
          } else {
            first_show_tag = '';
          }

          groups[category.id] = {count:0,members:{}};

          append = '';

          append += '<div class="card mb-0 p-1" id="trac360_card_'+ category.id +'">';
          append += '<div class="card-header">';
          append += '<a class="card-link" data-toggle="collapse" href="#trac360_card_table_'+ category.id +'">';
          append += '<i class="fa fa-plus mr-2"></i><strong>' + category.category_name + '</strong>';
          append += '</a><br>';

          if(category.category_desc != ''){
            append += '<a class="card-link" data-toggle="collapse" href="#trac360_card_table_'+ category.id +'">'+
                      '<i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>'+ category.category_desc +
                      '</small></a>';  
          }

          append += '</div>';     
          append += '</div>';

          $('#trac360_groups_people').append(append);

          append = '';

          append += '<div id="trac360_card_table_'+ category.id +'" categoryid='+ category.id +' class="collapse'+ first_show_tag +'" data-parent="#trac360_groups_people">';
          append += '<div class="card-body p-1">';
          append += '<div class="table-responsive">';
            append += '<table class="table table-bordered mb-0" id="trac360_table_'+ category.id +'">';
              append += '<thead>';
                append += '<tr>';
                  append += '<th class="d-none"></th>';
                  append += '<th style="width: 60%" class="font-weight-bold">' + category.category_tag + '</th>';
                  append += '<th style="width: 20%" class="font-weight-bold text-center">Latitude</th>';
                  append += '<th style="width: 20%" class="font-weight-bold text-center">Longitude</th>';
                append += '</tr>';
              append += '</thead>';
              append += '<tbody>';
              append += '</tbody>';
            append += '</table>';
          append += '</div>';
          append += '</div>';
          append += '</div>';

          $('#trac360_card_' + category.id + ' > div.card-header').after(append);
        });

        if(categories_length > 0){
          var first_category = true;
          var first_show = true;
          var category_id = 0;
          
          $.each(users, function(index, user){
            all_users.push(user.user_id);

            if(category_id == user.category_id){
              append = '';

              append += '<tr class="marker_'+ user.user_id +' trac360_row" gtype="user_trace" card="people" categoryid='+ category_id +'>';
                append += '<td class="d-none">'+ user.user_id +'</td>';
                append += '<td style="width: 60%">' + user.FName + ' ' + user.LName + '</td>';
                append += '<td style="width: 20%" class="text-center">'+ user.latitude +'</td>';
                append += '<td style="width: 20%" class="text-center">'+ user.longitude +'</td>';
              append += '</tr>';

              $('#trac360_table_' + category_id + ' > tbody > tr:last').after(append);

              addNewUserMarkerToMap(user, first_show);  
            } else {
              if((category_id > 0) && (first_show)){
                first_show = !first_show; 
              }

              category_id = user.category_id;
              category_default = '';

              if(first_category){
                category_default = ' show';

                first_category = !first_category;
              }

              append = '';

              append += '<tr class="marker_'+ user.user_id +' trac360_row" gtype="user_trace" card="people" categoryid='+ category_id +'>';
                append += '<td class="d-none">'+ user.user_id +'</td>';
                append += '<td style="width: 60%">' + user.FName + ' ' + user.LName + '</td>';
                append += '<td style="width: 20%" class="text-center">'+ user.latitude +'</td>';
                append += '<td style="width: 20%" class="text-center">'+ user.longitude +'</td>';
              append += '</tr>';

              $('#trac360_table_' + category_id + ' > tbody').append(append);

              addNewUserMarkerToMap(user, first_show);

              if(initialMapCenter == null){
                initialMapCenter = new google.maps.LatLng(user.latitude, user.longitude);

                $("#trac360_table_"+ category_id + " > tbody").children('tr:eq(0)').addClass('table-primary');
              }

              $("#trac360_card_table_"+ category_id).on('shown.bs.collapse', function () {
                var cur_catid = $(this).attr('categoryid');
                var cur_group = groups[cur_catid]['members'];
                var cur_first = true;

                $.each(cur_group, function(index, member){
                  var cur_marker = markers_map[member.idx];
                  var cur_lat = parseFloat(member.info.latitude);
                  var cur_lon = parseFloat(member.info.longitude);

                  cur_marker.setVisible(true);

                  requests[member.idx]['visible'] = true;

                  if(cur_first){
                    map.setCenter({lat:cur_lat,lng:cur_lon});

                    $("#trac360_table_"+ cur_catid + " > tbody").children('tr:eq(0)').addClass('table-primary');

                    cur_first = !cur_first;
                  }
                });
              });

              $("#trac360_card_table_"+ category_id).on('hidden.bs.collapse', function () {
                var cur_catid = $(this).attr('categoryid');
                var cur_group = groups[cur_catid]['members'];

                $.each(cur_group, function(index, member){
                  var cur_marker = markers_map[member.idx];

                  cur_marker.setVisible(false);

                  requests[member.idx]['visible'] = false;
                });  

                $("#trac360_table_"+ cur_catid + " > tbody").children('tr.table-primary').removeClass('table-primary');  
              });
            }  
          });
        }
      },
      complete: function(jqXHR, textStatus){
        google.maps.event.addDomListener(window, 'load', function(){
          if(!initialAllLoadStateDone){
            $.each(markers_map, function(index, marker_map){
              marker_map.setMap(map);
            });

            initialAllLoadStateDone = true;

            map.setCenter(initialMapCenter);
          }  
        });

        new_records_checker = setInterval(function(){
          if(new_checker_status == 'idle'){
            new_checker_status = ''
            var group_ids = '';
            $.each(groups, function(index, group){
              if(group_ids == ''){
                group_ids = index;
              } else {
                group_ids += ',' + index; 
              }  
            });


            var user_ids = '';
            for(var i = 0; i < all_users.length; i++){
              if(user_ids == ''){
                user_ids = all_users[i];
              } else {
                user_ids += ',' + all_users[i]; 
              }
            }

            $.ajax({
              type: 'POST',
              url: base_url + "trac360/getnewgeoinfos",
              data: {user_ids:user_ids,group_ids:group_ids},
              success: function(data){
                var result = jQuery.parseJSON(data);
                //Checker of new groups
                if(result.groups_count > 0){
                  $.each(result.groups, function(index, group){
                    var append = '';
                    var InGroups = (group.id in groups);
                    if(!InGroups){
                      append += '<div class="card mb-0 p-1" id="trac360_card_'+ group.id +'">';
                      append += '<div class="card-header">';
                      append += '<a class="card-link" data-toggle="collapse" href="#trac360_card_table_'+ group.id +'">';
                      append += '<i class="fa fa-plus mr-2"></i><strong>' + group.category_name + '</strong>';
                      append += '</a><br>';

                      if(group.category_desc != ''){
                        append += '<a class="card-link" data-toggle="collapse" href="#trac360_card_table_'+ group.id +'">'+
                                  '<i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>'+ group.category_desc +
                                  '</small></a>';  
                      }

                      append += '</div>';     
                      append += '</div>';

                      $('#trac360_groups_people').append(append);

                      append = '';

                      append += '<div id="trac360_card_table_'+ group.id +'" categoryid='+ group.id +' class="collapse" data-parent="#trac360_groups_people">';
                      append += '<div class="card-body p-1">';
                      append += '<div class="table-responsive">';
                        append += '<table class="table table-bordered mb-0" id="trac360_table_'+ group.id +'">';
                          append += '<thead>';
                            append += '<tr>';
                              append += '<th class="d-none"></th>';
                              append += '<th style="width: 60%" class="font-weight-bold">' + group.category_tag + '</th>';
                              append += '<th style="width: 20%" class="font-weight-bold text-center">Latitude</th>';
                              append += '<th style="width: 20%" class="font-weight-bold text-center">Longitude</th>';
                            append += '</tr>';
                          append += '</thead>';
                          append += '<tbody>';
                          append += '</tbody>';
                        append += '</table>';
                      append += '</div>';
                      append += '</div>';
                      append += '</div>';

                      $('#trac360_card_' + group.id + ' > div.card-header').after(append);

                      groups[group.id] = {count:0,members:{}};    
                    }
                  });
                }

                //Checker of new users
                if(result.users_count > 0){
                  $.each(result.users, function(index, user){
                    var append = '';
                    var table = $('#trac360_table_' + user.category_id);
                    var tbody = table.children('tbody');
                    
                      append += '<tr class="marker_'+ user.user_id +' trac360_row" gtype="user_trace" card="people" categoryid='+ user.category_id +'>';
                        append += '<td class="d-none">'+ user.user_id +'</td>';
                        append += '<td style="width: 60%">' + user.FName + ' ' + user.LName + '</td>';
                        append += '<td style="width: 20%" class="text-center">'+ user.latitude +'</td>';
                        append += '<td style="width: 20%" class="text-center">'+ user.longitude +'</td>';
                      append += '</tr>';

                    if(tbody.children('tr').length > 0){
                      tbody.children('tr:last').after(append);
                    } else {
                      tbody.append(append);
                    }

                    all_users.push(user.user_id);

                    var CategoryVisible = $('#trac360_card_table_' + user.category_id).hasClass('show');
                    addNewUserMarkerToMap(user, CategoryVisible); 
                  });
                }
              },
              complete: function(jqXHR, textStatus){
                new_checker_status = 'idle';
              }
            });
          }
        }, 1500);

        hideProcessing();  
      }
    });
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function addNewUserMarkerToMap(vUser, vShowOnMap){
    var UserPhoto = '';
    if(vUser.img_type != ""){
      UserPhoto = base_url + "uploads/users/user-profile/p_" + vUser.user_id + "." + vUser.img_type;
    } else {
      UserPhoto = base_url + "uploads/users/default.png";
    }

    var UserLatLng = new google.maps.LatLng(vUser.latitude, vUser.longitude);
    var UserIcon = {
      url: UserPhoto,
      scaledSize: new google.maps.Size(30,30)
    };

    var UserMarker = {
      map: map,
      position: UserLatLng,
      title: vUser.FName + ' ' + vUser.LName,
      icon: UserIcon,
      visible: vShowOnMap
    };

    var tMarker = createMarker_map(UserMarker);
    
    var cmmi = markers_map.length - 1;
    var cmmi_info = {'process':'idle','visible':vShowOnMap,'removed':false};

    var vUserInfo = {'idx':cmmi,'info':vUser};

    groups[vUser.category_id]['members'][vUser.user_id] = vUserInfo;
    groups[vUser.category_id]['count'] = groups[vUser.category_id]['count'] + 1;
 
    requests[cmmi] = cmmi_info;
    tracking[cmmi] = setInterval(function(){
      if((requests[cmmi]['process'] == 'idle') && (requests[cmmi]['visible']) && (!requests[cmmi]['removed'])){
        requests[cmmi]['process'] = 'ongoing';
        var user_geo = $('#trac360_table_'+ vUser.category_id +' > tbody').children('tr.marker_' + vUser.user_id);
        var user_old_lat = user_geo.children('td:eq(2)').text();
        var user_old_lng = user_geo.children('td:eq(3)').text();

        $.ajax({
          type: 'GET',
          url: base_url + "trac360/getusergeoposition/" + vUser.user_id,
          success: function(data){
            var result = jQuery.parseJSON(data);
            if(result.length > 0){
              var new_lat = result.latitude;
              var new_lng = result.longitude;

              if((user_old_lat != new_lat) || (user_old_lng != new_lng)){
                user_geo.children('td:eq(2)').text(new_lat);
                user_geo.children('td:eq(3)').text(new_lng);

                vMarker = markers_map[groups[vUser.category_id]['members'][vUser.user_id].idx];
                vMarker.setPosition(new google.maps.LatLng(new_lat, new_lng));     
              }
            }
          },
          complete: function(jqXHR, textStatus){
            requests[cmmi]['process'] = 'idle';
          }
        });
      }
    }, 1000);

    $('#trac360_table_'+ vUser.category_id +' > tbody').children('tr.marker_' + vUser.user_id).children('td').click(function(){
      var table = $(this).closest('table');
      var row = $(this).parent('tr');

      if(!row.hasClass('table-primary')){
        if(table.children('tbody').children('tr.table-primary').length){
          table.children('tbody').children('tr.table-primary').removeClass('table-primary');  
        }

        var lat = row.children('td:eq(2)').text();
        var lng = row.children('td:eq(3)').text();

        lat = lat.trim();
        lng = lng.trim();

        map.setCenter(new google.maps.LatLng(lat, lng));

        row.addClass('table-primary');
      } else {
        row.removeClass('table-primary');
      }
    });
  }

// ----------------------------------------------------------------------------------
  function showProcessing(){
    $('#modal-trac360-processing').modal('show');   
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function hideProcessing(){
    $('#modal-trac360-processing').modal('hide');  
  }
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
  function showAlert(vTheme, vText, vTitle){
    current_theme = vTheme;

    var bg_color = '';
    var show_ok = false;
    var show_confirm = false;
    var show_cancel = false;

    if(vTheme == 'info'){
      bg_color = 'bg-info';

      show_ok = true;
    } else if(vTheme == 'warning'){
      bg_color = 'bg-warning';

      show_ok = true;
    } else if(vTheme == 'confirm'){
      bg_color = 'bg-warning';

      show_confirm = true;
      show_cancel = true;
    } else if(vTheme == 'error'){
      bg_color = 'bg-danger';
      
      show_ok = true;   
    } else if(vTheme == 'success'){
      bg_color = 'bg-success';

      show_ok = true;
    }

    if(bg_color != ''){
      $('#modal-trac360-alert-title-div').addClass(bg_color);
    }

    $('#modal-trac360-alert-text').append(vText);
    $('#modal-trac360-alert-title').text(vTitle);

    if(show_ok){
      $('#btn-modal-trac360-alert-ok').removeClass('d-none');
    }

    if(show_confirm){
      $('#btn-modal-trac360-alert-confirm').removeClass('d-none');
    }

    if(show_cancel){
      $('#btn-modal-trac360-alert-cancel').removeClass('d-none');
    }

    $('#modal-trac360-alert').modal('show');
  }

  function hideAlert(){
    var bg_color = '';
    var hide_ok = false;
    var hide_confirm = false;
    var hide_cancel = false;

    if(current_theme == 'info'){
      bg_color = 'bg-info';

      hide_ok = true;
    } else if(current_theme == 'warning'){
      bg_color = 'bg-warning';

      hide_ok = true;
    } else if(current_theme == 'confirm'){
      bg_color = 'bg-warning';

      hide_confirm = true;
      hide_cancel = true;
    } else if(current_theme == 'error'){
      bg_color = 'bg-danger';

      hide_ok = true;
    } else if(current_theme == 'success'){
      bg_color = 'bg-success';

      hide_ok = true;
    }

    $('#modal-trac360-alert-title-div').removeClass(bg_color);
    $('#modal-trac360-alert-text').empty();
    $('#modal-trac360-alert-title').empty();

    if(hide_ok){
      $('#btn-modal-trac360-alert-ok').addClass('d-none');
    }

    if(hide_confirm){
      $('#btn-modal-trac360-alert-confirm').addClass('d-none');
    }

    if(hide_cancel){
      $('#btn-modal-trac360-alert-cancel').addClass('d-none');
    }

    current_theme = '';

    $('#modal-trac360-alert').modal('hide');
  }
// ----------------------------------------------------------------------------------
</script>
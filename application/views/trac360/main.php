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
            <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5"><span class="fa fa-users fa-3x" class="text-center"></span>Group</button>
            <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5"><span class="fa fa-map-marker fa-3x" class="text-center"></span>Places</button>
          </div>
        </div>
        <div class="col-md-4 trac360_main_sections">
          <div class="card p-0 ToFit">
            <div class="card-header pl-1 pr-1">
              <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="trac360_new_person" title="Add New Person"><i class="fa fa-plus"></i></a>
              <a href="#" class="nodecontrol btn btn-sm btn-default pull-right ml-1" control="trac360_del_person" title="Remove Person"><i class="fa fa-trash"></i></a>  
            </div>
            <div class="card-body pt-0 pb-0 pl-1 pr-1">
              <div id="trac360_groups_people">

              </div>
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
    initialAllLoadStateDone = false;
    initialMapCenter = null;

    last_category_open = 0;

    groups = {};
    tracking = {};
    requests = {};

    all_users = [];

    new_records_checker = null;

    InitializeBody();
    InitializeMarkers();
  });

  function InitializeBody(){
    var header_height = $('header').css('height');

    header_height = header_height.replace('px','');
    header_height = parseInt(header_height) + 10;
    header_height += 'px';

    $('#main_body').css('padding-top',header_height);
  }

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
        var users = result.users;
        var append = '';

        $('#trac360_groups_people').empty();

        $.each(categories, function(index, category){
          groups[category.id] = {count:0,members:{}};

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
        });

        if(append != ''){
          $('#trac360_groups_people').append(append);

          var first_category = true;
          var first_show = true;
          var category_id = 0;
          
          $.each(users, function(index, user){
            all_users.push(user.user_id);

            if(category_id == user.category_id){
              append += '<tr class="marker_'+ user.user_id +'" gtype="user_trace">';
                append += '<td class="d-none">'+ user.user_id +'</td>';
                append += '<td style="width: 65%">' + user.FName + ' ' + user.LName + '</td>';
                append += '<td style="width: 17.5%" class="text-center">'+ user.latitude +'</td>';
                append += '<td style="width: 17.5%" class="text-center">'+ user.longitude +'</td>';
              append += '</tr>';

              $('#trac360_table_' + category_id + ' > tbody > tr:last').after(append);

              addNewUserMarkerToMap(user, first_show);

              append = '';  
            } else {
              if(category_id > 0){
                first_show = !first_show; 
              }

              category_id = user.category_id;
              category_default = '';

              if(first_category){
                last_category_open = category_id

                category_default = ' show';

                first_category = !first_category;
              }

              append = '';

              append += '<div id="trac360_card_table_'+ category_id +'" categoryid='+ category_id +' class="collapse'+ category_default +'" data-parent="#trac360_groups_people">';
              append += '<div class="card-body p-1">';
              append += '<div class="table-responsive">';
                append += '<table class="table table-bordered mb-0" id="trac360_table_'+ category_id +'">';
                  append += '<thead>';
                    append += '<tr>';
                      append += '<th class="d-none"></th>';
                      append += '<th style="width: 65%" class="font-weight-bold">' + user.category_tag + '</th>';
                      append += '<th style="width: 17.5%" class="font-weight-bold text-center">Latitude</th>';
                      append += '<th style="width: 17.5%" class="font-weight-bold text-center">Longitude</th>';
                    append += '</tr>';
                  append += '</thead>';
                  append += '<tbody>';
                    append += '<tr class="marker_'+ user.user_id +'" gtype="user_trace">';
                      append += '<td class="d-none">'+ user.user_id +'</td>';
                      append += '<td style="width: 65%">' + user.FName + ' ' + user.LName + '</td>';
                      append += '<td style="width: 17.5%" class="text-center">'+ user.latitude +'</td>';
                      append += '<td style="width: 17.5%" class="text-center">'+ user.longitude +'</td>';
                    append += '</tr>';
                  append += '</tbody>';
                append += '</table>';
              append += '</div>';
              append += '</div>';
              append += '</div>';

              $('#trac360_card_' + category_id + ' > div.card-header').after(append);

              addNewUserMarkerToMap(user, first_show);

              if(initialMapCenter == null){
                initialMapCenter = new google.maps.LatLng(user.latitude, user.longitude);

                $("#trac360_table_"+ category_id + " > tbody").children('tr:eq(0)').addClass('table-primary');
              }

              $("#trac360_card_table_"+ category_id).on('shown.bs.collapse', function () {
                if(last_category_open > 0){
                  var last_group = groups[last_category_open]['members'];
                  $.each(last_group, function(index, member){
                    var last_marker = markers_map[member.idx];

                    last_marker.setVisible(false);
                  });
                }  

                $('tr[gtype="user_trace"].table-primary').removeClass('table-primary');

                var cur_group = groups[$(this).attr('categoryid')]['members'];
                $.each(cur_group, function(index, member){
                  var cur_marker = markers_map[member.idx];

                  cur_marker.setVisible(true);

                  if(index == 0){
                    map.setCenter(cur_marker.position);

                    $("#trac360_table_"+ category_id + " > tbody").children('tr:eq(0)').addClass('table-primary');
                  }
                });

                last_category_open = $(this).attr('categoryid');
              });

              $("#trac360_card_table_"+ category_id).on('hidden.bs.collapse', function () {

              });

              append = '';
            }  
          });
        }
      },
      complete: function(){
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
          var ids = '';
          for(var i = 0; i < all_users.length; i++){
            if(ids == ''){
              ids = all_users[i];
            } else {
              ids += ',' + all_users[i]; 
            }
          }

          $.ajax({
            type: 'POST',
            url: base_url + "trac360/getnewusersgeoposition",
            data: {ids:ids},
            success: function(data){
              var result = jQuery.parseJSON(data);
              if(result.count > 0){
                $.each(result.users, function(index, user){
                  var table = $('#trac360_table_' + user.category_id);
                   
                });
              }
            }
          });
        }, 1500);

        hideProcessing();  
      }
    });
  }

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
    var cmmi_info = {'process':'idle','visible':vShowOnMap};

    var vUserInfo = {'idx':cmmi,'info':vUser};

    groups[vUser.category_id]['members'][vUser.user_id] = vUserInfo;
    groups[vUser.category_id]['count'] = groups[vUser.category_id]['count'] + 1;
 
    requests[cmmi] = cmmi_info;
    tracking[cmmi] = setInterval(function(){
      if((requests[cmmi]['process'] == 'idle') && (requests[cmmi]['visible'])){
        requests[cmmi]['process'] = 'ongoing';
        var user_geo = $('#trac360_table_'+ vUser.category_id +' > tbody').children('tr.marker_' + vUser.user_id);
        var user_old_lat = user_geo.children('td:eq(2)').text();
        var user_old_lng = user_geo.children('td:eq(3)').text();

        $.ajax({
          type: 'GET',
          url: base_url + "trac360/getusergeoposition/" + vUser.user_id,
          success: function(data){
            var result = jQuery.parseJSON(data);
            var new_lat = result.latitude;
            var new_lng = result.longitude;

            if((user_old_lat != new_lat) || (user_old_lng != new_lng)){
              user_geo.children('td:eq(2)').text(new_lat);
              user_geo.children('td:eq(3)').text(new_lng);

              vMarker = markers_map[groups[vUser.category_id]['members'][vUser.user_id].idx];
              vMarker.setPosition(new google.maps.LatLng(new_lat, new_lng));     
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

  function showProcessing(){
    $('#modal-trac360-processing').modal('show');   
  }

  function hideProcessing(){
    $('#modal-trac360-processing').modal('hide');  
  }
</script>
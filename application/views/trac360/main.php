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
    groups = {};
    tracking = {};
    requests = {};

    InitializeBody();
    InitializeMarkers();

    $('#table_users_positions > tbody > tr').each(function(index, row){
      requests[index] = 'idle';
      tracking[index] = setInterval(function(){
        if(requests[index]['process'] == 'idle'){
          requests[index]['process'] = 'ongoing';
          var user_geo = $('#table_users_positions > tbody').children('tr:eq('+ index +')');
          var user_id = user_geo.children('td:eq(0)').text();
          var user_old_lat = user_geo.children('td:eq(2)').text();
          var user_old_lng = user_geo.children('td:eq(3)').text();

          $.ajax({
            type: 'GET',
            url: base_url + "trac360/getusergeoposition/" + user_id,
            success: function(data){
              var result = jQuery.parseJSON(data);
              var new_lat = result.latitude;
              var new_lng = result.longitude;

              if((user_old_lat != new_lat) || (user_old_lng != new_lng)){
                user_geo.children('td:eq(2)').text(new_lat);
                user_geo.children('td:eq(3)').text(new_lng);

                vMarker = markers_map[index];
                vMarker.setPosition(new google.maps.LatLng(new_lat, new_lng));     
              }
            },
            complete: function(jqXHR, textStatus){
              requests[index] = 'idle';
            }
          });
        }
      }, 1000);
    });
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
          var category_id = 0;
          
          $.each(users, function(index, user){
            if(category_id == user.category_id){
              append += '<tr>';
                append += '<td class="d-none">'+ user.user_id +'</td>';
                append += '<td style="width: 65%">' + user.FName + ' ' + user.LName + '</td>';
                append += '<td style="width: 17.5%" class="text-center">'+ user.longitude +'</td>';
                append += '<td style="width: 17.5%" class="text-center">'+ user.latitude +'</td>';
              append += '</tr>';

              $('#trac360_table_' + category_id + ' > tbody > tr:last').after(append);

              append = '';  
            } else {
              category_id = user.category_id;
              category_default = '';

              if(first_category){
                category_default = ' show';

                first_category = !first_category;
              }

              append = '';

              append += '<div id="trac360_card_table_'+ category_id +'" class="collapse'+ category_default +'" data-parent="#trac360_groups_people">';
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
                    append += '<tr>';
                      append += '<td class="d-none">'+ user.user_id +'</td>';
                      append += '<td style="width: 65%">' + user.FName + ' ' + user.LName + '</td>';
                      append += '<td style="width: 17.5%" class="text-center">'+ user.longitude +'</td>';
                      append += '<td style="width: 17.5%" class="text-center">'+ user.latitude +'</td>';
                    append += '</tr>';
                  append += '</tbody>';
                append += '</table>';
              append += '</div>';
              append += '</div>';
              append += '</div>';

              $('#trac360_card_' + category_id + ' > div.card-header').after(append);

              append = '';
            }  
          });

          if(append != ''){
            $('#trac360_table_' + category_id + ' > tbody > tr:last').after(append);  
          }
        }
      },
      complete: function(){
        hideProcessing();  
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
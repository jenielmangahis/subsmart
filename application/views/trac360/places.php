<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
    /* Set the size of the div element that contains the map */
    #map_canvas,
    .ToFit {
        height: 100% !important;
        width: 100%;
    }

    .trac360_main_sections {
        height: 65vh;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
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
<div id="main_body" class="container-fluid" style="background-color: #6241A4; padding-top:103px;">
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
                <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id=""><span class="fa fa-users fa-3x" class="text-center"></span><br>Group</button>
                <a href="<?= base_url() ?>/trac360" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id=""><span class="fa fa-user fa-3x" class="text-center"></span><br>People</a>
                <a href="<?= base_url() ?>/trac360/places" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id=""><span class="fa fa-map-marker fa-3x" class="text-center"></span><br>Places</a>
                <button type="button" class="btn btn-primary trac360_side_transparent trac360_side_controls pb-5" id=""><span class="fa fa-map fa-3x" class="text-center"></span><br>History</button>
            </div>
        </div>
        <div class="col-md-4 trac360_main_sections">
            <div class="card p-0 ToFit">
                <div class="card-header pl-1 pr-1">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="m-0" id="cur_tab_title" style="padding-left: 10px">Places</h5>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-pane container pl-0 pr-0 active" diventry="people_entry" title="People" id="trac360_groups_people" prev_tab="">
                                    <div class="card mb-0 p-1" id="trac360_card_1">
                                        <div class="card-header"><a class="card-link" data-toggle="collapse" href="#trac360_card_table_1" aria-expanded="true"><i class="fa fa-plus mr-2"></i><strong>Add New Place</strong></a><br><a class="card-link" data-toggle="collapse" href="#trac360_card_table_1" aria-expanded="true"><i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>Enter an address and click submit to a new place.</small></a></div>
                                        <div id="trac360_card_table_1" categoryid="1" class="collapse show" data-parent="#trac360_groups_people">
                                            <div class="card-body p-1">
                                                <form id="location-form">
                                                    <div class="row">
                                                        <div class="col-md-8"><input type="text" id="location-input" class="form-control form-control-lg" placeholder="Enter address here."></div>
                                                        <div class="col-md-4"><button type="submit" class="btn btn-primary btn-block">Search</button></div>
                                                    </div>
                                                </form>
                                                <div class="card-block" id="formatted-address"></div>
                                                <div class="card-block" id="formatted-components"></div>
                                                <div class="card-block" id="formatted-geometry"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0 p-1" id="trac360_card_2">
                                        <div class="card-header"><a class="card-link collapsed" data-toggle="collapse" href="#trac360_card_table_2" aria-expanded="false"><i class="fa fa-plus mr-2"></i><strong>ADI</strong></a><br><a class="card-link collapsed" data-toggle="collapse" href="#trac360_card_table_2" aria-expanded="false"><i class="fa fa-plus mr-2 font-weight-none" style="color: transparent"></i><small>Field Representatives</small></a></div>
                                        <div id="trac360_card_table_2" categoryid="2" class="collapse" data-parent="#trac360_groups_people" style="">
                                            <div class="card-body p-1">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="trac360_table_2">
                                                        <thead>
                                                            <tr>
                                                                <th class="d-none"></th>
                                                                <th style="width: 60%" class="font-weight-bold">TECHS</th>
                                                                <th style="width: 20%" class="font-weight-bold text-center">Latitude</th>
                                                                <th style="width: 20%" class="font-weight-bold text-center">Longitude</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-md-7 trac360_main_sections">
            <?php echo $map
            ?>
        </div>
        <!-- end row -->
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<?php echo $map_js; ?>
<script>
    var locationForm = document.getElementById("location-form");
    locationForm.addEventListener('submit', geocode)

    function geocode(e) {
        e.preventDefault();
        var location = document.getElementById("location-input").value;
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
            params: {
                address: location,
                key: 'AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU'
            }
        }).then(function(response) {
            console.log(response);
            var formatted_address = response.data.results[0].formatted_address;
            var formatted_address_output = `
<ul class="list-group">
  <li class="list-group-item"><strong>Formatted Address: </strong>${formatted_address}</li>
</ul>
        `;
            var address_components = response.data.results[0].address_components;
            var address_components_output = `<ul class="list-group">`;
            for (var i = 0; i < address_components.length; i++) {
                address_components_output += `<li class="list-group-item"><strong>${address_components[i].types[0]}:</strong> ${address_components[i].long_name}</li>`;
            }
            address_components_output += `</ul>`;

            var lat = response.data.results[0].geometry.location.lat;
            var lng = response.data.results[0].geometry.location.lng;
            document.getElementById("formatted-address").innerHTML = formatted_address_output;
            document.getElementById("formatted-components").innerHTML = address_components_output;
            document.getElementById("formatted-geometry").innerHTML = `
        <ul class="list-group">
          <li class="list-group-item"><strong>Lat:</strong> ${lat}</li>
          <li class="list-group-item"><strong>Lng:</strong> ${lng}</li>
        </ul>`;
        }).catch(function(error) {
            console.log(error);
        });
    }
</script>
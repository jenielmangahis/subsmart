<?php include viewPath('v2/includes/header'); ?>
<style>
#trac360-map{
    height:600px;
    border:1px #6a4a86  solid;
}
.maplibregl-marker{
    background-size:cover;
    border-radius:34px;
}
.map-user, .map-address, .map-date{
    display:block;
}
.map-user{
    font-size:12px;
    font-weight:bold;
}
.autocomplete-left{
display: inline-block;
width: 65px;
}
.autocomplete-right{
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
.autocomplete-img {
    height: 50px;
    width: 50px;
}
.mapboxgl-popup-content, .maplibregl-popup-content{
  background-color:#6a4a86 !important;
  color:#ffffff !important;
}
.maplibregl-popup-tip{
    border-top-color : #6a4a86 !important;
}
.maplibregl-popup-close-button{
    color:#ffffff !important;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Employees Last Aux Locations.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 col-md-5" style="padding-right:0px;">
                        <div class="filter-container nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title"><span><i class='bx bxs-map'></i>&nbsp;Filter Map Marker</span></div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Employee</label>
                                <div class="col-sm-7">
                                    <select id="list-company-users" class="form-control" multiple=""></select>                                    
                                </div>                                
                            </div>    
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Date From</label>
                                <div class="col-sm-6">
                                    <input type="date" id="date-from" class="form-control" value="<?= date("Y-m-d"); ?>" />                                    
                                </div>                                
                            </div>    
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Date To</label>
                                <div class="col-sm-6">
                                    <input type="date" id="date-to" class="form-control" value="<?= date("Y-m-d"); ?>" />                                    
                                </div>                                
                            </div>    
                            <div class="col-md-10 mt-5">                                    
                            <a class="nsm-button primary btn-reset-map" href="javascript:void(0);" style="float:right;">Reset</a>                                    
                                <a class="nsm-button primary btn-filter-marker" href="javascript:void(0);" style="float:right;">Filter Map</a>                                    
                            </div>                        
                        </div>
                    </div>
                    <div class="col-7 col-md-7">
                        <div class="nsm-card primary">
                            <div id="trac360-map"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>
    
<script type="text/javascript">

var myAPIKey = "41ddeb87ff654af488b283ba54ba576f";   
var default_lat = '8.8888';
var default_lon = '11.5812';

var center = {
    lat: default_lat,
    lon: default_lon
};
var map_zoom_level = '1'; 
var map_style = 'klokantech-basic';
var geojson = {
    'type': 'FeatureCollection',
    'features': <?= json_encode($geoDataFeatures); ?>
};

var map = new maplibregl.Map({
center: [center.lon, center.lat],
zoom: map_zoom_level,
container: 'trac360-map',
style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
});
map.addControl(new maplibregl.NavigationControl()); 

// add markers to map
var currentMarkers=[];
geojson.features.forEach((marker) => {
    // create a DOM element for the marker
    const el = document.createElement('div');
    el.className = 'marker';    
    el.style.backgroundImage =
            `url(${marker.properties.image})`;
    el.style.width = `${marker.properties.iconSize[0]}px`;
    el.style.height = `${marker.properties.iconSize[1]}px`;

    // el.addEventListener('click', () => {
    //     window.alert(marker.properties.message);
    // });

    // create the popup
    const popup = new maplibregl.Popup({offset: 25}).setHTML(
        marker.properties.message
    );

    // add marker to map
    var marker = new maplibregl.Marker({element: el})
        .setLngLat(marker.geometry.coordinates)
        .setPopup(popup)
        .addTo(map);

    currentMarkers.push(marker);
});

$(function(){
    
    $('.btn-reset-map').on('click', function(){
        location.reload();
    });

    $('.btn-filter-marker').on('click', function(){
        var uid = $('#list-company-users').val();
        var date_from = $('#date-from').val();
        var date_to   = $('#date-to').val();

        if (currentMarkers!==null) {
            for (var i = currentMarkers.length - 1; i >= 0; i--) {                
                currentMarkers[i].remove();
            }
        }

        $.ajax({
            type: "POST",
            url: base_url + "trac360/_create_user_geolocation_features",
            dataType: 'json',
            data: {uid:uid, date_from:date_from, date_to:date_to},
            success: function(data) {
                if (data.is_valid) {
                    var geojson = {
                            'type': 'FeatureCollection',
                            'features': data.geoFeatures
                    }; 

                    geojson.features.forEach((marker) => {
                        // create a DOM element for the marker
                        const el = document.createElement('div');
                        el.className = 'marker';    
                        el.style.backgroundImage =
                                `url(${marker.properties.image})`;
                        el.style.width = `${marker.properties.iconSize[0]}px`;
                        el.style.height = `${marker.properties.iconSize[1]}px`;

                        // create the popup
                        const popup = new maplibregl.Popup({offset: 25}).setHTML(
                            marker.properties.message
                        );

                        // add marker to map
                        var marker = new maplibregl.Marker({element: el})
                            .setLngLat(marker.geometry.coordinates)
                            .setPopup(popup)
                            .addTo(map);

                        currentMarkers.push(marker);
                    });
                }
            },
            beforeSend: function() {

            }
        });
    });

    $('#list-company-users').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select User',
        maximumSelectionLength: 5,
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }
});

</script>

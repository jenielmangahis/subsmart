<div class="card no-padding">
    <div class="card-body" style="padding:0 !important;">
        <div class="col-md-12 no-padding">
            <div id="streetView" class=" text-center">
                <p class="muted">System is loading street view...</p>
            </div>
        </div>
        <br>
    </div>
</div>
<input type="hidden" value="<?= $address ?>" id="addressValue" />
<input type="hidden" value="<?= google_credentials()['api_key'] ?>" id="api_key" />

<script type="text/javascript">
    $(document).ready(function () {
        loadStreetView();
    });

    function loadStreetView() {

        var userLocation = $('#addressValue').val();
        var apiKey = $('#api_key').val();
        var address = 'https://maps.googleapis.com/maps/api/streetview?location=' + userLocation + '&size=280x200&key='+apiKey;
        $('#streetView').html('<img style="width:100%;" src="' + address + '">');
    }



</script>

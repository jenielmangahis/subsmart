          
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 d-flex mt-4">
                    <span class="content-subtitle">Copyright © 2020 nSmarTrac. All rights reserved.</span>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Chart JS -->
    <script src="<?= base_url("assets/js/v2/chart.min.js") ?>"></script> 
    <!-- Boostrap JS -->
    <script src="<?= base_url("assets/js/v2/bootstrap.bundle.min.js") ?>" crossorigin="anonymous"></script>
    <!-- Sweetalert JS -->
    <script src="<?= base_url("assets/js/v2/sweetalert2.min.js") ?>"></script>
    <!-- Pusher JS -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Datepicker -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/bootstrap-datepicker.min.js") ?>"></script>
    <!-- Main Script -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/main.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.draggable.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.table.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/customer.js") ?>"></script>
    <script type="text/javascript">
        var baseURL = '<?= base_url() ?>';        
    </script>
<script>

jQuery(document).ready(function() {
   
    jQuery(document).ready(function() {
        
        // var attr = $('button').attr('name');

        // // For some browsers, `attr` is undefined; for others,
        // // `attr` is false.  Check for both.
        // if (typeof attr !== 'undefined' && attr !== false) {
        //     attr.attr("name","name");
        // }

        // $( "li.item-ii" ).find( allListElements );
        $( "div" ).find( "button" ).attr( "name", "name-button" );
        $( "div" ).find( "img" ).attr( "alt", "image" );
        $( "div" ).find( "frame" ).attr( "title", "frame" );
        $( "div" ).find( "frame" ).attr( "iframe", "iframe" );
        $( "div" ).find( "a" ).attr( "name", "link" );


    });


});

</script>
  </body>

</html>
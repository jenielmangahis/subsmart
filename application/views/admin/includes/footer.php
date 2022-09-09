<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!-- jQuery 3 -->
<script src="<?php echo $assets ?>/js/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $assets ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $assets ?>/plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
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

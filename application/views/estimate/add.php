<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="w-100 vh-100">
                <?php if($type == 2) {?>
                        <iframe src="/fb/view/103" frameborder="0" class="w-100 h-100"></iframe>
                <?php }elseif($type == 3){?>
                        <iframe src="/fb/view/104" frameborder="0" class="w-100 h-100"></iframe>
                <?php }else{?>
                        <iframe src="/fb/view/102" frameborder="0" class="w-100 h-100"></iframe>
                <?php }?>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>


<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper">
    <div __wrapper_section>
        <div class="card my-2" style="height: 1250px">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li id="breadcrumbBack" class="breadcrumb-item"><a>Terms and Conditions</a></li>
                    <li id="breadcrumbTitle" class="breadcrumb-item active">a</li>
                </ol>
            </nav>
            <div class="text-left" id="titleContainer">
                <h1></h1>
            </div>
            <div id="contentContainer">

            </div>
        </div>
    </div>
</div>

<?php include viewPath('includes/footer'); ?>

<script>
$.ajax({
    url: `${baseUrl}/terms-and-conditions/get-one-by-id/${<?= $terms_and_conditions_id ?>}`,
    method: 'GET',
    success: (res) => {
        const data = res.data;
        $('#contentContainer').html(data.content);
        $('#titleContainer h1').html(data.title);
        $('#breadcrumbTitle').html(data.title);
        $('#breadcrumbBack a').attr('href', '/terms-and-conditions');
    }
})
</script>
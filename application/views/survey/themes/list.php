<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>


<style>

    div.theme-card{
        padding: 0;
        border: 0;
    }

    div.theme-card:hover{
        transition-duration: 300ms;
        transform: scale(1.05);
        box-shadow: 0px 0px 10px #000000;
    }

    div.color-slots{
        display: inline-block;
    }

    div.color-slot{
        padding: 5px 15px;
        margin: 0 10px 0 0;
        background-color: #333333;
        float: left;
    }

    .theme-image{
        width: 100%;
        max-height: 100px;
        height: auto;
        object-fit: cover;
    }

    .theme-info{
        position: absolute;
    }

</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>

    <!-- start of page wrapper -->
    <div wrapper__section>
    
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url()?>/survey">Back to Survey List</a>
                    <div class="row">
                        <div class="col-6">
                            <h2>Survey Themes</h2>                
                            <p>Here are some themes to help you get more people attracted to your survey.</p>
                        </div>
                        <!-- <div class="col-6 text-right">
                            <a href="<?= base_url()?>survey/themes/create" class="btn btn-success">
                                <i class="fa fa-plus"></i> Add New Theme
                            </a>
                        </div> -->
                    </div>
                    <hr/>
                    

                    <div class="row">
                        <?php foreach($themes as $key => $theme){?>
                        <div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 col-sm-6 col-md-4 col-xl-3">
                            <a href="<?= base_url()?>survey/themes/<?= $theme->sth_rec_no ?>">
                                <div class="card theme-card">

                                    <img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                                    <div class="theme-info">
                                            <div class="card-body">
                                                <h4 style="color: <?= $theme->sth_text_color?>"><?= $theme->sth_theme_name?></h4>
                                                <div class="color-slots">
                                                    <div class="color-slot" style="background-color: <?= $theme->sth_primary_color ?>"></div>
                                                    <div class="color-slot" style="background-color: <?= $theme->sth_secondary_color ?>"></div>
                                                    <div class="color-slot" style="background-color: <?= $theme->sth_tertiary_color ?>"></div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- end of page wrapper -->
</div>

<script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>
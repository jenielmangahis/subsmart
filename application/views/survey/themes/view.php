<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<style>

    .color-box{
        padding: 25px;
        background-color: #333333;
        display: inline-block;
    }
    
    .line-separator{
        padding: 3px 10px;
        background-color: #fff;
        width: 100px;
        margin: 10px auto;
    }

    .theme-sample{
        overflow: none;
        padding: 10px 0;
    }

    .theme-sample-content{
        position: absolute;
        z-index: 1;
        height: 100%;
        padding: 15% 0;
    }

    .theme-image{
        width: 100%;
        height: 350pt;
        object-fit: cover;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>

    <!-- start of page wrapper -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url()?>survey/themes">Back to Themes</a>
                    <div class="d-flex w-100 justify-content-between">
                        <h2><?= $theme->sth_theme_name?></h2>
                        <div>
                            <a class="btn btn-success stretched-link" href="<?=base_url()?>survey/themes/edit/<?=$theme->sth_rec_no?>"><i class="fa fa-edit"></i> Edit Theme</a>
                        </div>
                        <!-- <div class="col-6 text-right">
                            <a href="#button" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Show</a>
                            <a href="#button" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> Hide</a>
                            <a href="#button/edit/<?=$theme->sth_rec_no?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                            <a href="#button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </div> -->
                    </div>
                    <hr/>
                    
                    <div class="row">
                        
                        <div class="col-12">
                            <div class="row justify-content-md-center">
                                
                                <!-- Elements -->
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_primary_color?>"></div>
                                        <p>Primary Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_primary_color?></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_secondary_color?>"></div>
                                        <p>Secondary Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_secondary_color?></strong>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_tertiary_color?>"></div>
                                        <p>Tertiary Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_tertiary_color?></strong>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        
                        <div class="col-12">
                            <div class="row justify-content-md-center">
                        
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_success_color?>"></div>
                                        <p>Success Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_success_color?></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_info_color?>"></div>
                                        <p>Info Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_info_color?></strong>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_warning_color?>"></div>
                                        <p>Warning Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_warning_color?></strong>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="card color-slot">
                                        <div class="color-box" style="background-color: <?= $theme->sth_danger_color?>"></div>
                                        <p>Danger Color: </p>
                                        <span>
                                            <small>HEX</small>
                                            <strong><?= $theme->sth_danger_color?></strong>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <!-- theme sample -->
                        <div class="col-12">
                            <div class="theme-sample">
                                <div class="theme-sample-content container-fluid">
                                    <div class="text-center">
                                        <h1 style="color: <?= $theme->sth_text_color?>">Lorem Ipsum</h1>
                                        <div class="line-separator" style="background-color: <?= $theme->sth_secondary_color?>"></div>
                                        <p style="color: <?= $theme->sth_text_color?>">This is where the text will be placed. Another sentence to fill in the spaces of your survey.</p>
                                        <button type="button" class="btn " style="background-color: <?=$theme->sth_primary_color?>; color: <?= $theme->sth_text_color?>">Button</button>
                                    </div>
                                
                                </div>
                                <img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class ?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="theme-sample">
                                        <div class="theme-sample-content container-fluid">
                                            <div class="text-center">
                                                <h1 style="color: <?= $theme->sth_text_color?>">A yes or no?</h1>
                                                <div class="line-separator" style="background-color: <?= $theme->sth_secondary_color?>"></div>
                                                <p style="color: <?= $theme->sth_text_color?>">This is where the text will be placed. I am a Yes or no question?</p>
                                                <button type="button" class="btn " style="background-color: <?=$theme->sth_success_color?>; color: <?= $theme->sth_text_color?>">Yes</button>
                                                <button type="button" class="btn " style="background-color: <?=$theme->sth_danger_color?>; color: <?= $theme->sth_text_color?>">No</button>
                                            </div>
                                        
                                        </div>
                                        <img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class ?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="theme-sample">
                                        <div class="theme-sample-content container-fluid">
                                            <div class="text-center">
                                                <h1 style="color: <?= $theme->sth_text_color?>">Remove User</h1>
                                                <div class="line-separator" style="background-color: <?= $theme->sth_secondary_color?>"></div>
                                                <p style="color: <?= $theme->sth_text_color?>">I am supposed to ask you a question with a mix of warning?</p>
                                                <button type="button" class="btn " style="background-color: <?=$theme->sth_warning_color?>; color: <?= $theme->sth_text_color?>">Button</button>
                                            </div>
                                        
                                        </div>
                                        <img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class ?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                                    </div>
                                </div>
                            </div>
                            
                        </div>


                    </div>
                </div>
            </>

        </div>
    </div>
    <!-- end of page wrapper -->
</div>

<script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>
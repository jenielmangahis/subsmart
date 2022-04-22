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
                <div class="page-title-box" style="padding:14px 0 0 0;">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Survey Themes</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('survey/themes/create'); ?>" class="btn btn-primary" style="position: relative;bottom: 2px;"><i
                                                class="fa fa-plus"></i> Add New Theme</a>
                                    <a href="<?= base_url('survey'); ?>" class="btn btn-primary" style="position: relative;bottom: 2px;">Back to Survey List</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Here are some themes to help you get more people attracted to your survey.</span>
                  </div>
                </div>

                <div class="card-body">                    
                    <div class="row">
                        <?php foreach($themes as $key => $theme){?>
                        <div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 col-sm-6 col-md-4 col-xl-3"> 
                            <a href="<?= base_url()?>survey/themes/<?= $theme->sth_rec_no ?>">                           
                            <div class="card theme-card-1" style="margin-bottom: 4px;padding: 0px;">
                                <?php                                     
                                $image = base_url('./uploads/survey/themes/'.$theme->company_id.'/'.$theme->sth_primary_image);
                                $path  = './uploads/survey/themes/'.$theme->company_id.'/'.$theme->sth_primary_image;
                                if( !file_exists($path) ){
                                  $image = base_url('./uploads/survey/themes/default_theme_img.jpg'); 
                                }
                                ?>
                                <img src="<?= $image; ?>" style="<?= $theme->sth_primary_image_class?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                                <div class="theme-info">
                                    <div class="card-body" style="height:100px;">
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
                            <div style="width:101%; margin:0 auto; display:block;">
                                <a class="btn btn-primary" href="<?= base_url()?>survey/themes/edit/<?= $theme->sth_rec_no ?>" style="width:49%;"><i class="fa fa-pencil"></i> Edit</a>
                                <a class="btn btn-primary btn-delete-theme" data-id="<?= $theme->sth_rec_no; ?>" href="javascript:void(0);" style="width:49%;"><i class="fa fa-trash"></i> Delete</a>
                            </div>
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
<script>
$(document).on('click', ' .btn-delete-theme', function(){
    var tid = $(this).attr('data-id');
    Swal.fire({
        title: 'Delete Theme',
        text: "Are you sure you want to delete this theme?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                data:{tid:tid},
                url: "<?php echo base_url(); ?>survey/_delete_theme",
                dataType:'json',
                success: function(result) {
                    if( result.success == 1 ){
                        Swal.fire({
                            title: 'Good job!',
                            text: "Data Deleted Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            confirmButtonColor: '#32243d',
                            html: 'Cannot find data'
                          });
                    }                    
                },
            });
        }
    });
});
</script>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/responsive.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=$url->assets?>plugins/select2/dist/css/select2.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/css/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/js/toastr.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/css/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/js/toastr.js"></script>
    
    <title>Add Library</title>
</head>

<body style="background: white !important;">
    <input type="hidden" id="siteurl" value="<?php echo url(); ?>">
    <!-- Header -->
    <header id="topnav">
        <!-- for js programing -->
        <div class="topbar-main">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo container-->
                    <div class="logo col-auto d-none d-lg-inline-flex"><a href="<?php echo url('dashboard'); ?>" class="logo">
                            <img width="200" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""> </a>
                    </div><!-- End Logo container-->
                    <!-- MENU Start -->

                    <?php include viewPath('includes/nav'); ?>
                    <div class="menu-extras topbar-custom col-auto justify-content-end">
                        <ul class="navbar-right list-inline float-right mb-0">
                            <li class="menu-item list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines"><span></span> <span></span> <span></span></div>
                                </a>
                            </li>
                            <li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""> </a></li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="/users/timesheet_user" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-clock-o" aria-hidden="true"></i></a> </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                            </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>

                            </li>


                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa fa-line-chart" aria-hidden="true"></i></a>

                            </li>


                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></a>

                            </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i> <span class="badge badge-pill badge-danger noti-icon-badge">3</span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text">Notifications (258)</h6>
                                    <div class="slimscroll notification-item-list">
                                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details">Your order is placed<span class="text-muted">Dummytext of the printing and typesetting industry.</span></p>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                            <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                        </a> <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy
                                                    text of the printing and typesetting industry.</span></p>
                                        </a> <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                            </div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a>
                                    </div><!-- All--> <a href="javascript:void(0);" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="dropdown notification-list list-inline-item">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <?php /*<img src="<?php //echo (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets ?>" alt="user" class="rounded-circle">*/ ?>
                                        <?php
                                        /*$image = (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets;
                                            if( !@getimagesize($image) ){
                                                $image = base_url('uploads/users/default.png');
                                            }*/
                                        $image = base_url('uploads/users/default.png');
                                        ?>
                                        <img src="<?php echo $image; ?>" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                        <a class="dropdown-item" href="<?php echo url('dashboard') ?>"><i class="mdi mdi-account-circle m-r-5"></i>Dashboard</a>
                                        <a class="dropdown-item" href="<?php echo url('profile') ?>"><i class="mdi mdi-account-circle m-r-5"></i>Public Profile</a>
                                        <a class="dropdown-item" href="<?php echo url() ?>"><i class="mdi mdi-account-circle m-r-5"></i>nSmart Home</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Join our community</a>
                                        <?php //if (hasPermissions('activity_log_list')): 
                                        ?>
                                        <a href="<?php echo url('activity_logs') ?>">
                                            <i class="mdi mdi-account-circle m-r-5"></i><span>Activity Logs</span>
                                        </a>
                                        <?php //endif 
                                        ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="<?php echo url('/logout') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div><!-- end menu-extras -->
                    <div class="clearfix"></div>
                </div><!-- end container -->
            </div><!-- end container -->
        </div><!-- end topbar-main -->

    </header>
    <!-- End Navigation Bar-->


    <!-- Main Selection -->
    <section class="main-wrapper" id="custome-fileup" style="background: white;padding-bottom: 15px;">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=base_url('esign/libraryList')?>">Back To Library List</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=form_open_multipart('', ['id' => 'createLibrary']); ?>
                        <div class="form-group">
                            <label for="">Library Name</label>
                            <input required type="text" class="form-control" name="libraryName" id="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                        </div>
                    <?=form_close(); ?>
                </div>
            </div>
        </div>    
    </section>
    <script>
        $(document).ready(function() {
            $("#createLibrary").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '<?=base_url('esign/createLibrary') ?>',
                    type: 'post',
                    data : $("#createLibrary").serialize(),
                    success: function(res, status) {
                        try {
                            res = JSON.parse(res);
                            if(status != "success" || !res.status){
                                throw "errr";
                            }
                            $('#createLibrary')[0].reset();
                            toastr.success("Data Has Been added Successfully");
                        } catch (error) {
                            console.error('Execption Generated : ',error)
                            toastr.warning('Something Went Wrong Please Try Again');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
        
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <title>Category Management</title>
    <style>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

.notFavorite { 
    color: #5f5f5f
}
.favorite {
    color : tomato;
}
input {
  margin: 5px;
}
.trashColor{
    color : tomato;
}
</style>
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
                <!-- <a href="<?=base_url('esign/addCategory')?>" class="btn btn-info">Add New Category</a>             -->
            </div>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($templates AS $template){?>
                        <tr>
                            <form class="editCategory" id="formId-<?=$template['category_id']?>">
                                <td>
                                    <input type="text" name="categoryName" value="<?=$template['categoryName']?>">
                                    <input type="hidden" name="categoryId" value="<?=$template['category_id']?>">
                                </td>
                                <td>
                                    <?php if(!$template['isDefault']){?>
                                        <button type="submit"><i class="fa fa-edit"></i></button>
                                        <a class="trashColor" href="#"><i id="deleteId-<?=$template['category_id']?>" class="fa fa-trash"></i></a>
                                    <?php }else {?>
                                        <a><i class="fa fa-lock"></i></a>
                                    <?php }?>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>    
    </section>

    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                columnDefs: [
                  { orderable: false, targets: -1 },
                ]
            });
            
            $('#myTable').on( 'dblclick', 'tbody td', function (e) {
                console.log($(this).html())
            });

            $('#myTable tbody').on( 'click', 'i.fa-trash', function () {
               table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
                let id= $(this).prop('id').split('-')[1] || 0;
                deleteCategory(id);
            });
            function deleteCategory(categoryId){
                $.get("deleteCategory/"+categoryId, function(data, status){
                    try {
                        data = JSON.parse(data);
                        if(status != "success" || !data.status){
                            throw "errr";
                        }
                    } catch (error) {
                        alert('Something Went Wrong Please Try Again');
                        location.reload();
                    }
                });
            }

            $('.editCategory').submit(function (e){
                e.preventDefault();
                let submittedData = {};
                if(!$(this).hasClass('loading')){
                    $(this).addClass('loading');
                    let thisEleId = $(this).prop('id');
                    updateCategory($(this).serialize(),thisEleId)
                    // for(let subData of $(this).serializeArray()){
                    //     submittedData[subData.name] = subData.value; 
                    // }
                }
                return true;
            });
        });

        function updateCategory(data, thisEleId){
                console.log("before send : "+thisEleId)
                $.ajax({
                    url: '<?=base_url('esign/updateCategory') ?>',
                    type: 'post',
                    dataType: 'application/json',
                    data,
                    success: function(res, status) {
                        console.log('My Res Data ',res)
                        console.log("from el ",thisEleId);
                        // $("#"+thisEleId).removeClass('loading');
                        // try {
                        //     data = JSON.parse(data);
                        //     if(status != "success" || !data.status){
                        //         throw "errr";
                        //     }
                        // } catch (error) {
                        //     // alert('Something Went Wrong Please Try Again');
                        //     // location.reload();
                        // }
                    }
                });
                // return true;
            }
    </script>
</body>
</html>
        
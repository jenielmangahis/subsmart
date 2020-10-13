<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/responsive.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/    .min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <title><?=isset($template) ? "Update Template" : "Create Template" ?></title>
    <style>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

input {
  margin: 5px;
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
            <?=form_open_multipart('esign/saveCreatedTemplate', ['id' => 'createTemplate']); ?>
                <div class="form-group">
                    <label for="letterTitle">Title : </label>
                    <input type="text" value="<?=isset($template) ? $template->title : ""?>" name="letterTitle" id="">
                </div>
                <?php
                    if(isset($template)){
                        ?>
                        <input type="hidden" value="<?=$template->esignLibraryTemplateId?>" name="esignLibraryTemplateId" id="">
                        <?php
                    }
                ?>
                <div class="form-group">
                    <label for="category">Category : </label>
                    <select name="category_id" id="category" class="dropdown">
                        <?php foreach($categories as $category){ ?>
                            <option <?=isset($template) && $template->category_id ==  $category['category_id'] ? "selected" : "" ?> value="<?=$category['category_id']?>"><?=$category['categoryName']?></option>
                        <?php } ?>
                    </select>
                    <a href="categoryList">Manage template category</a>
                </div>
                <div class="form-group">
                    <label for="">Status : </label>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio1">
                            <input <?=isset($template) && $template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio1" name="status" value="1" checked>Active
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio2">
                            <input <?=isset($template) && !$template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio2" name="status" value="0">In Active
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea id="summernote" name="template"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div>
            <?=form_close(); ?>
            <?php if(isset($_GET['isSuccess']) && $_GET['isSuccess'] == 1){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                Saved Successfully  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php } ?>
        </div>

        <div class="container">
            <fieldset>
                <legend><h3>Placeholder Information</h3></legend>
                <div style="padding-left:0px; padding-right:20px; float:left;"> 
                    {company_logo} - <b>Company logo</b><br>
                    {client_suffix} - <b>Suffix of client</b><br>
                    {client_first_name} - <b>First name of client</b><br>
                    {client_middle_name} - <b>Middle name of client</b><br>
                    {client_last_name} - <b>Last name of client</b><br>
                    {client_address} - <b>Address of client</b><br>
                    {client_previous_address} - <b>Previous address of client</b><br>
                    {bdate} - <b>Birth date of client</b><br>
                    {ss_number} - <b>Last 4 of SSN of client</b><br>
                    {t_no} - <b>Telephone number of client</b><br>
                    {curr_date} - <b>Current date</b><br>
                    {client_signature} - <b>Client's signature</b><br>
                </div>	
                <div style="padding-left:10px; float:left"> 	
                    {bureau_name} - <b>Credit bureau name</b><br>
                    {bureau_address} - <b>Credit bureau name and address</b><br>
                    {account_number} - <b>Account number</b><br>	
                    {dispute_item_and_explanation} - <b>Dispute items and explanation</b><br>
                    {creditor_name} - <b>Creditor/Furnisher name</b><br>
                    {creditor_address} - <b>Creditor/Furnisher address</b><br>
                    {creditor_phone} - <b>Creditor/Furnisher phone number</b><br>
                    {creditor_city} - <b>Creditor/Furnisher city</b><br>
                    {creditor_state} - <b>Creditor/Furnisher state</b><br>
                    {creditor_zip} - <b>Creditor/Furnisher zip</b><br>
                    {report_number} - <b>Report number</b><br>
                </div>
            </fieldset>
        </div>
    </section>

    <script>
        let defaultText = `<p>{client_first_name}&nbsp;{client_last_name}<br />{client_address}<br />{client_previous_address}<br />{bdate}<br />{ss_number}&nbsp;<br /><br />{bureau_address}</p>
<p>Attn.: Consumer Relations&nbsp;</p>
<p>{curr_date}&nbsp;</p>
<p>To Whom It May Concern,&nbsp;</p>
<p>On (DATE), I wrote to you requesting an investigation into items that I believed were (CHOOSE:&nbsp; INNACCURATE, OUTDATED OR OBSOLETE). To date, I have not received a reply from you or any acknowledgment that an investigation has begun. In my previous request, I listed my reasons for disputing the information. I have enclosed it again and request that you reply within a reasonable amount of time.</p>
<p>Since this is my (SECOND, THIRD,FOURTH, ETC) ) request, I will also be sending a copy of this letter to the Federal Trade Commission notifying them that I have signed receipts for letters sent to you and you have not complied with my request. I regret that I am being forced to take such action.&nbsp;<br /><br />Please see my reasons for dispute below:&nbsp;<br /><br />{dispute_item_and_explanation}<br /><br />I also understand that you are required to notify me of your investigation results within 30 days and provide me with an updated copy of my credit report. My contact information is provided below.&nbsp;</p>
<p><br />Sincerely,&nbsp;<br /><br />{client_signature}<br />_____________________________</p>
<p>{client_first_name}&nbsp;{client_last_name}</p>`;
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Type Here ... ',
                tabsize: 2,
                height: 450,
            });
            <?php
            if(!isset($template)){
            ?>
                $('#summernote').summernote('code', defaultText);
            <?php
            }else {
            ?>
                $('#summernote').summernote('code', `<?=isset($template) ? $template->content : ""?>`);
            <?php
            }
            ?>
        });
    </script>
</body>
</html>
       
 <!--                // code : `<?=isset($template) ? $template->content : ""?>`
  -->
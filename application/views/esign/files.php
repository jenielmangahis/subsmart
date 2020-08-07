<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
     <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css" >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>esign/css/responsive.css" />
    <title>DocuSign</title>
</head>
<body style="background: white !important;">
<input type="hidden" id="siteurl" value="<?php echo url();?>">
    <!-- Header -->
    <header id="topnav">
	 <!-- for js programing -->
        <div class="topbar-main">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo container-->
                    <div class="logo col-auto d-none d-lg-inline-flex"><a href="<?php echo url('dashboard');?>" class="logo">
                        <img width="200" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a>
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
							<li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a></li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="/users/timesheet_user" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-clock-o" aria-hidden="true"></i></a>

                            </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                            </li>
							                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>

                            </li>


							 <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa fa-line-chart" aria-hidden="true"></i></a>

                            </li>


							                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></a>

                            </li>
							<li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i> <span class="badge badge-pill badge-danger noti-icon-badge">3</span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text">Notifications (258)</h6>
                                    <div class="slimscroll notification-item-list">
										<a href="javascript:void(0);" class="dropdown-item notify-item active"><div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div><p class="notify-details">Your order is placed<span class="text-muted">Dummytext of the printing and typesetting industry.</span></p>
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
                                        </a>  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                            </div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a>
									</div><!-- All--> <a href="javascript:void(0);"
									class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
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
                                        <a class="dropdown-item" href="<?php echo url('dashboard')?>"><i class="mdi mdi-account-circle m-r-5"></i>Dashboard</a>
                                        <a class="dropdown-item" href="<?php echo url('profile')?>"><i class="mdi mdi-account-circle m-r-5"></i>Public Profile</a>
                                        <a class="dropdown-item" href="<?php echo url()?>"><i class="mdi mdi-account-circle m-r-5"></i>nSmart Home</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Join our community</a>
										<?php //if (hasPermissions('activity_log_list')): ?>
											<a href="<?php echo url('activity_logs') ?>">
											<i class="mdi mdi-account-circle m-r-5"></i><span>Activity Logs</span>
											</a>
										<?php //endif ?>
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

    </header><!-- End Navigation Bar-->
    

    <?php if(isset($next_step) && $next_step == 0) { ?>

        <?php echo form_open_multipart('esign/fileSave', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <input type="hidden" value="0" name="next_step" />
			<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
            <header style="margin-top: 81px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="left-part">
                                <a class="back-step"></a>
                                <p>Upload a Document and Add Envelope Recipients</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="right-part">
                                <ul>
                                    <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                                    <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">HTML</a></li>
                                            <li><a href="#">CSS</a></li>
                                            <li><a href="#">JavaScript</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" class="recent-view">Recipient Preview </a></li>
                                    <li><a href="<?php echo base_url('esign/Files?next_step=1');?>" class="recent-view next-btn">next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header -->

            <!-- Main Wrapper -->
            <section class="main-wrapper"  id="custome-fileup" style="background: white;padding-bottom: 15px;">
                <div class="container">
                <h1>Add Documents to the Envelope</h1>

                    <div class="custome-fileup" >
                    
                        <div class="upload-btn-wrapper">
                            <button class="btn">
                                <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                                <span>Upload</span>
                            </button>
                            <input type="file" name="docFile" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel"/>
                        </div>

                        <!-- <div class="dropdown">
                            <button class="btn-upl dropdown-toggle" type="button" data-toggle="dropdown">Get from Cloud
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic1.png" alt=""> Box</a></li>
                                <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic2.png" alt=""> Dropbox</a></li>
                                <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic3.png" alt=""> Google Drive</a></li>
                                <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic4.png" alt=""> One Drive</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </section>

            <!-- Footer --->
            <footer>
                <div class="container-fluid">
                    <ul>
                        <!-- <li><a href="#">Send Now</a></li> -->
                        <li><a href="#" onClick="uploadOrNext(true)" class="next-btn">next</a></li>
                    </ul>
                </div>
            </footer>
            <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php } ?>




    <?php /* if(isset($next_step) && $next_step == 0) { ?>

<?php echo form_open_multipart('esign/fileSave', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <input type="hidden" value="0" name="next_step" />
    <input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
    <header style="margin-top: 81px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="left-part">
                        <a class="back-step"></a>
                        <p>Upload a Document and Add Envelope Recipients</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="right-part">
                        <ul>
                            <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                            <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="recent-view">Recipient Preview </a></li>
                            <li><a href="<?php echo base_url('esign/Files?next_step=1');?>" class="recent-view next-btn">next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main Wrapper -->
    <section class="main-wrapper"  id="custome-fileup" style="background: white;padding-bottom: 15px;">
        <div class="container">
        <h1>Add Documents to the Envelope</h1>

            <div class="custome-fileup" >
            
                <div class="upload-btn-wrapper">
                    <button class="btn">
                        <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                        <span>Upload</span>
                    </button>
                    <input type="file" name="docFile" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel"/>
                </div>

                <!-- <div class="dropdown">
                    <button class="btn-upl dropdown-toggle" type="button" data-toggle="dropdown">Get from Cloud
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic1.png" alt=""> Box</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic2.png" alt=""> Dropbox</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic3.png" alt=""> Google Drive</a></li>
                        <li><a href="#"><img src="<?php echo $url->assets ?>esign/images/clude-ic4.png" alt=""> One Drive</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Footer --->
    <footer>
        <div class="container-fluid">
            <ul>
                <!-- <li><a href="#">Send Now</a></li> -->
                <li><a href="#" onClick="uploadOrNext(true)" class="next-btn">next</a></li>
            </ul>
        </div>
    </footer>
    <!-- End Footer --->
<?php echo form_close(); ?>
<?php } */ ?>

    <?php if(isset($next_step) && $next_step == 2) { ?>

        <?php echo form_open_multipart('esign/recipients', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <input type="hidden" value="3" name="next_step" />
		<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
        <header style="margin-top: 81px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="left-part">
                            <a href="<?php echo base_url('esign/Files?next_step=1');?>" class="back-step"><i class="fa fa-angle-left"></i></a>
                            <p>Upload a Document and Add Envelope Recipients</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="right-part">
                            <ul>
                                <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                                <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">HTML</a></li>
                                        <li><a href="#">CSS</a></li>
                                        <li><a href="#">JavaScript</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="recent-view">Recipient Preview </a></li>
                                <li><a href="<?php echo base_url('esign/Files?next_step=2');?>" class="recent-view next-btn">next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Main Wrapper -->
        <section class="main-wrapper" id="add-recipeit" style="background: white;padding-bottom: 55px;">
            <div class="container">

            <div class="add-recipeit" >
                <h1>Add Recipients to the Envelope</h1>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="add-note">
                            <p>As the sender, you automatically receive a copy of the completed envelope.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="quick-act">
                            <ul>
                                <li><a href="#"><i class="fa fa-address-book"></i> Add from contacts</a></li>
                                <li><a href="#"><i class="fa fa-code-fork"></i> Signing Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="rec-envlo-block">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="left-wnvofrm">
                                <div class="cust-check">
                                    <input type="checkbox" id="html">
                                    <label for="html">Set signing order</label>
                                </div>

                                <div id="setup-recipient-list">
                                    <div class="form-box">
                                        <a href="#" class="clos-bx"><i class="fa fa-times-circle-o"></i></a>
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7">
                                                <div class="leffm">
                                                    <div class="form-group">
                                                        <label>Name *</label>
                                                        <input type="text" placeholder="" class="form-control" id="recipients" name="recipients[]">
                                                        <a href="#"><i class="fa fa-address-book"></i></a>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email *</label>
                                                        <input required type="email" id="email" name="email[]" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="action-envlo">
                                                    <ul>
                                                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i>Needs to Sign</a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#"><i class="fa fa-pencil"></i> Needs to Sign</a></li>
                                                                <li><a href="#"><i class="fa fa-clone"></i> Receives a Copy</a></li>
                                                                <li><a href="#"><i class="fa fa-eye"></i> Needs to View</a></li>
                                                            </ul>
                                                        </li>
                                                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">More</a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#"><i class="fa fa-key"></i> Add access authentication</a></li>
                                                                <li><a href="#"><i class="fa fa-comment"></i> Add private message</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="btn-main" onClick="addReceiption()"><i class="fa fa-user-plus"></i> Add Recipient</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer --->
        <footer>
            <div class="container-fluid">
                <ul>
                    <li><a onClick='onbackclick("<?php echo url('esign/Files?id='.$file_id.'&next_step=0') ?>")'  >Back</a></li>
                    <li><a class="next-btn" onClick="uploadOrNext(true)">next</a></li>
                </ul>
            </div>
        </footer>
        <!-- End Footer --->
        <?php echo form_close(); ?>
    <?php } ?>


    <?php if(isset($next_step) && $next_step == 3) { ?>
    
		<?php echo form_open_multipart('esign/recipients', [ 'id' => 'upload_file', 'class' => 'form-validate mb-0', 'autocomplete' => 'off' ]); ?>
			<input type="hidden" value="3" name="next_step" />
			<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
			
            



            <div class="card p-0 mb-0">
                <div class="site_content">
                    <div class="content_wrap" style="position: relative;margin-top: 80px;">
                        <div class="content_sidebar content_sidebar-left resizable ng-scope ng-isolate-scope" style="overflow-x: hidden" ng-class="{'file-drop': markupPalettesCtrl.showDeleteDropZone}" ng-mouseenter="hookCtrl.trigger('mouseenter', $event)">
                            <div class="resize-horizontal resize-right resize-line ng-scope" svg-view-angular-hook="" hook-name="'paletteResizerHandle'" ng-mousedown="hookCtrl.trigger('mousedown', $event); $event.preventDefault();"></div>
                            
                            <div class="sidebar_footer ng-scope"></div>
                            
                            <div class="sidebar-fields sidebar-flex">
                                <div class="sidebar_main ng-scope" data-callout="tagger-sidebar" svg-view-angular-hook="" hook-name="'tabListPanel'" role="region" aria-label="Fields Palette" id="left-panel-tagger">
                                    
                                    <div class="sidebar-fields ng-scope ng-isolate-scope" olive-scroll-shadow-initialized="true" style="box-shadow: rgba(0, 0, 0, 0.18) 0px -7px 7px -7px inset">
                                        <div class="sidebar_group l-flex-between ng-scope" data-callout="send-fields" >
                                            <h5>
                                                <span tabindex="-1" data-qa="search-results-tagger" class="ng-binding ng-scope">Standard Fields</span>
                                            </h5>
                                        </div>
                                        <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                            <div class="menu-fields">
                                                <ul class="menu_list">
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style>
                                                            .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }
                                                        </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(),'menu_item-isActive': hookCtrl.view.get('selected')}" data-qa="Signature" title="Signature">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-sign"></i></span>
                                                            <span class="u-ellipsis ng-binding">Signature</span>
                                                        </button>
                                                    </li>
                                                
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style> 
                                                            .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }
                                                        </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Initial" title="Initial">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-initial"></i></span>
                                                            
                                                            <span class="u-ellipsis ng-binding">Initial</span>
                                                        </button>
                                                    </li>
                                            
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style>
                                                            .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }
                                                        </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Stamp" title="Stamp">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-stamp"></i></span>  
                                                            <span class="u-ellipsis ng-binding">Stamp</span>
                                                        </button>
                                                    </li>
                                                    
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style> .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; }
                                                                .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }
                                                        </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Date Signed" title="Date Signed">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-date signed"></i></span>
                                                            <span class="u-ellipsis ng-binding">Date Signed</span>
                                                        </button>
                                                        
                                                    </li>
                                                
                                                </ul>
                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                            <div class="menu-fields">
                                                <ul class="menu_list">
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                        
                                                        <style> .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; } </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Name" title="Name">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-name"></i></span> <span class="u-ellipsis ng-binding">Name</span>
                                                        </button>
                                                    </li>
                                                    
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style>  .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px;} .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; } </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Email" title="Email">
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-email"></i></span>
                                                            <span class="u-ellipsis ng-binding">Email</span>
                                                        </button>
                                                    </li>
                                                    
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style> .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; } </style>
                                                    
                                                        <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Company" title="Company">
                                                    
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-company"></i></span>
                                                            
                                                            <span class="u-ellipsis ng-binding">Company</span></button>
                                                            
                                                    </li>
                                                    
                                                    <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                    
                                                        <style> .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo {position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; } </style>
                                                        
                                                        <button class="menu_item ng-scope" type="button" ng-class="{'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Title" title="Title">
                                                    
                                                            <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-title"></i></span>
                                                            <span class="u-ellipsis ng-binding">Title</span>
                                                        
                                                        </button>
                                                    
                                                    </li>
                                                
                                                </ul>
                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups"><div class="menu-fields">
                                        
                                            <ul class="menu_list">
                                            
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                
                                                    <style> .menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Text" title="Text">
                                                    
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-text"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Text</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Checkbox" title="Checkbox">
                                                    
                                                    
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-checkbox"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Checkbox</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
        
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Dropdown" title="Dropdown">
                                                    
                                                    <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-dropdown"></i></span>
                                                    
                                                    <span class="u-ellipsis ng-binding">Dropdown</span>
                                                
                                                    </button>

                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Radio" title="Radio">

                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-radio"></i></span>
                                                        <span class="u-ellipsis ng-binding">Radio</span>

                                                    </button>
                                                    
                                                </li>
                                            </ul>
                                        
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="sidebar_item ng-scope" ng-repeat="tabGroup in tabPaletteCtrl.tabGroups">
                                        
                                        <div class="menu-fields">
                                        
                                            <ul class="menu_list">
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Formula" title="Formula">
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-formula"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Formula</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Attachment" title="Attachment">
                                                        
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-attachment"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Attachment</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}" >
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Note" title="Note">
                                                    
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-note"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Note</span>
                                                        
                                                    </button>
                                                    
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Approve" title="Approve">
                                                    
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-approve"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Approve</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                                
                                                <li class="menu_listItem ng-scope ng-isolate-scope" ng-class="{'menu_listItem-disabledFeature' : !tpiCtrl.isEnabled()}">
                                                
                                                    <style>.menu_listItem-disabledFeature .menu_item.disabled:hover { color: #999999; } .menu_listItem-disabledFeature .menu_item.disabled .menu_hoverAction { position: absolute; right: 12px; } .menu_item-smartContractInfo { position: absolute; right: 2px; visibility: hidden; color: #999999; } .menu_item-smartContractInfoShow:hover * { visibility: visible; } .tab-badge-left-margin { margin-left: auto; }</style>
                                                    
                                                    <button class="menu_item ng-scope" type="button" ng-class="{ 'disabled': !tpiCtrl.isEnabled(), 'menu_item-isActive': hookCtrl.view.get('selected') }" data-qa="Decline" title="Decline">
                                                        
                                                        <span class="swatch swatch-recipient swatch-lg swatch-ext-0" aria-hidden="true"><i class="icon icon-color-tagger icon-palette-field-decline"></i></span>
                                                        
                                                        <span class="u-ellipsis ng-binding">Decline</span>
                                                    
                                                    </button>
                                                
                                                </li>
                                            
                                            </ul>
                                        
                                        </div>
                                    
                                    </div>
                                
                                </div>
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    <style> .document-page { border:2px solid black;  margin-top:30px; } .document-page:first-child { margin-top:50px !important; } </style>
                    <div class="content_main" id="main-pdf-render" style="height: 887px;overflow: auto;    position: relative;margin: 0 auto; text-align: center;" role="region" aria-label="Active Page"> </div>
                    
                    <div ng-class="taggerCtrl.shouldShowPanelSection()" lazy-load-container="thumbNails" svg-view-angular-hook="" hook-name="'documentThumbnailsPanel'" tagger-thumbnails-container="" id="right-panel-tagger" class="ng-scope content_sidebar content_sidebar-right">
                        <div class="sidebar_header l-flex-between" thumbnails-header=""><div>
                            <!-- <span class="ng-binding">Documents</span> -->
                        </div>
                    <div>
                </div>
            </div>
                
                <div class="docsWrapper ng-scope ng-isolate-scope" ng-if="taggerCtrl.shouldShowDocumentThumbnails()" envelope-data-manager="taggerCtrl.envelopeDataManager">
                    <div class="singleDocument ng-scope" data-qa="doc-thumbnail-list" ng-repeat="document in thumbCtrl.documents.getSorted() | filter: thumbCtrl.documentPreview_filter">
                        
                        <div id="main-pdf-render-preview" class="documentPageSet drawer down ng-scope full open" style="overflow: auto;height: 866px;">
                            <!-- <div class="drawer-wrapper ng-scope"><br>
                                <div class="documentPage ng-scope" data-qa="tagger-documents">
                                    <img class="img" data-qa="indvidual-tagger-documents" ng-style="{ 'min-height': 132 / page.get('width') * page.get('height')+ 'px' }" alt="pdf.pdf - Page 1" lazy-load-item="thumbNails" lazy-load-url="page.getImageUrl()" should-unload="document.getPages().length > 100" src="https://app.docusign.com/page-image/accounts/5a4bea64-9f10-42d5-ae11-edd0b58f60d3/envelopes/093ea65e-5cc5-40e1-aa00-15986e27e398/documents/1/pages/1/page_image?lock_token=MTJhNzI5MjYtYmQ3YS00ODk1LTkxNGMtNWIxMWQ3MzE1MjM4&amp;cache_token=2245e9d6-0239-4910-8c1c-f6753cc0d4cb&amp;dpi=150" style="min-height: 170.824px">
                                    <div class="bar-action"> </div>
                                    <div class="column-indicators">
                                </div>

                                <span class="pageNumber ng-binding">1</span>
                            </div> -->

                            
                        
                        </div>
                    
                    </div>
                
                </div>
                
                <div ng-switch="taggerCtrl.useSupplementalDocumentAttributes">
                    <div class="supplemental-documents-drawer drawer left drawer-properties ng-scope ng-isolate-scope closed" olive-drawer-initial-state="closed" olive-drawer-name="supplementalDocumentsPanel" olive-drawer-direction="left" olive-animation-weight="light" ng-switch-default="" supplemental-document-properties-panel="" sdpp-documents="taggerCtrl.getDocuments()" sdpp-recipients="taggerCtrl.envelope.recipients" olive-drawer-initialized="true" style="width: 0px">
                        <div class="drawer-wrapper">
                            <div class="drawer-content full-drawer" olive-drawer-content="">
                            <div class="drawer-properties_header">
                                <span class="ng-binding">Supplement</span>
                            </div>
                            <div class="drawer-properties_main" olive-scroll-shadow="scrollShadowSupplmentalDocuments" olive-scroll-shadow-initialized="true">
                                <div class="drawer down full open"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="drawer left drawer-properties ng-isolate-scope closed" olive-drawer-initial-state="closed" olive-drawer-name="propertiesPanel" olive-drawer-direction="left" olive-animation-weight="light" envelope-moderator="taggerCtrl.envelopeModerator" open-signing-preview="taggerCtrl.openRecipientsPreviewOverlay(tabid)" olive-drawer-initialized="true" style="width: 0px">
                <div class="drawer-wrapper ng-scope" role="region" aria-label="Properties Panel" svg-view-angular-hook="" hook-name="'propertiesPanel'">
                    <div olive-drawer-content="" class="drawer-content full-drawer" template="propertiesPanelDrawerCtrl.markupPropertiesPanelTemplate">
                    
                        <style aria-hidden="true" class="ng-scope">.collapsible-section-card { background-color: #f4f4f4; } .collapsible-section-card .actions { display: none; } .collapsible-section-card:hover .actions { display: block; } .collapsible-section-card:focus-within .actions { display: block; } .collapsible-section-card:hover .action-wrapper { border-top: 1px solid #e9e9e9; } .collapsible-section-card textarea { border: 0px; resize: none; } .collapsible-section-card:hover .section-label-header { display: block; } .collapsible-section-card:focus-within .section-label-header { display: block; } .collapsible-section-card .section-label-header { display: none; } .absolute-div-properties-panel { position: absolute; z-index: 2; width: 100%; height: 100%; } </style>
                    
                        <div class="drawer-properties_footer ng-scope">
                            <button class="btn btn-block btn-md btn-utility ng-scope ng-hide" type="button" ng-show="hookCtrl.view.canDeleteSelection()" svg-view-angular-hook="" data-qa="properties-panel-delete" hook-name="'destroyMarkupSelection'" ng-click="hookCtrl.trigger('click', $event)">
                                <span class="ng-binding">Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
		<?php echo form_close(); ?>
	</div>

    <?php include viewPath('esign/esign-page-preview-step-4-style');  ?>
    <style> body { padding-bottom: 0px !important; } </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        var url = "<?php echo base_url('uploads/DocFiles/'.$file_url); ?>";
    </script>
    <script src="<?php echo $url->assets ?>/esign/js/main.js"></script>
    <?php } ?>
    
    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/jquery.min.js"></script> 
    <script type="text/javascript" src="<?php echo $url->assets ?>/esign/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    var current_target = 0;
    
    $('.next-btn').click(function() {
        current_target = current_target + 1;
        if(current_target == 0)
        {
            $('#custome-fileup').show();
            $("#add-recipeit").hide();
            $("#tagspreview").hide();
            $('#all-recipients-wrp').hide();
        }
        else if(current_target == 1)
        {
            $('#custome-fileup').hide();
            $("#add-recipeit").show();
            $("#tagspreview").hide();
            $('#all-recipients-wrp').hide();
        }
        else if(current_target == 2)
        {
            $('#custome-fileup').hide();
            $("#add-recipeit").hide();
            $("#tagspreview").show();
            $('#all-recipients-wrp').hide();
        }
        else if(current_target == 3)
        {
            $('#custome-fileup').hide();
            $("#add-recipeit").hide();
            $("#tagspreview").hide();
            $('#all-recipients-wrp').show();
        }  
    });

</script>
<style>
    .main-wrapper {
    padding: 213px 0 292px;
    width: 100%;
}
#all-recipients-wrp {
    padding: 213px 0 292px;
}


/* reception list */
#setup-recipient-list .form-box  {
    margin:13px 0 13px 0;
}
</style>
<script>
    function uploadOrNext(next = false) {
        if(next == true) { $('input[name="next_step"]').val(1); }
        $("#upload_file").submit();
    }

    // function onbackclick(backlink) {
    //     alert(backlink);
    //     window.location.href = backlink;
    // }

    function addReceiption () {

        $('#setup-recipient-list').append('<div class="form-box"><a href="#" class="clos-bx"><i class="fa fa-times-circle-o"></i></a><div class="row"><div class="col-md-7 col-sm-7"><div class="leffm"><div class="form-group"><label>Name *</label><input type="text" name="" placeholder="" class="form-control"> <a href="#"><i class="fa fa-address-book"></i></a></div><div class="form-group"> <label>Email *</label> <input type="text" name="" placeholder="" class="form-control"></div></div></div><div class="col-md-5 col-sm-5"><div class="action-envlo"><ul><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i>Needs to Sign</a><ul class="dropdown-menu"><li><a href="#"><i class="fa fa-pencil"></i> Needs to Sign</a></li><li><a href="#"><i class="fa fa-clone"></i> Receives a Copy</a></li><li><a href="#"><i class="fa fa-eye"></i> Needs to View</a></li></ul></li><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">More</a><ul class="dropdown-menu"><li><a href="#"><i class="fa fa-key"></i> Add access authentication</a></li><li><a href="#"><i class="fa fa-comment"></i> Add private message</a></li></ul></li></ul></div></div></div></div>');
        return false;
    }
</script>
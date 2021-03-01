<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php
    $this->load->view('includes/sidebars/api_connectors', $sidebar);

    $url = $platform->authUrl(array(
        'redirectUri' => $RINGCENTRAL_REDIRECT_URL,
        'state' => 'initialState',
        'brandId' => '',
        'display' => '',
        'prompt' => ''
    ));
    ?>
    <style>
        .box{
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }
        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }
        .box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title {
            display: inline-block;
            font-size: 18px;
            margin: 2px !important;
            line-height: 1;
        }
        .box-header > .box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }
        .box.box-solid > .box-header > .box-tools .btn {
            border: 0;
            box-shadow: none;
        }
        .btn-box-tool {
            padding: 5px;
            font-size: 12px;
            background: transparent;
            color: #97a0b3;
        }
        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }
        .box .nav-stacked > li {
            border-bottom: 1px solid #f4f4f4;
            margin: 0;
        }
        .nav-stacked > li {
            float: none;
        }
        .nav-pills > li {
            float: left;
            width:100%;
            padding: 10px 0 !important;
        }
        .nav > li {
            position: relative;
            display: block;
        }
        .box-primary{
            border-top-color: #3c8dbc;
        }
        .bg-light-blue, .label-primary{
            background-color: #3c8dbc !important;
            color: white;
            font-weight: 500;
            padding: 3px;
            border-radius: 7px;
            font-size: 12px;
        }
        .has-feedback .form-control {
            padding-right: 42.5px;
            height:30px;
            font-size: 12px;
        }
        .form-control-feedback {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            pointer-events: none;
        }
        .glyphicon-search::before {
            font-family: 'FontAwesome';
            content: '\f002';
            position: absolute;
            right: 6px;
        }
    </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-0 bg-white">
                <div class="card p-0">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title">Ring Central</h3>
                            <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    Call, Message, and Meet Seamlessly
                                    The Ring Central app's intuitive and unified user interface allows you to seamlessly transition between phone calls, video meetings, and team chat without
                                    losing track of what you’re working on. Less toggling between communications applications and solutions means your projects move forward, your teams
                                    stay connected, and your productivity increases.
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-md-3 float-left">
                                <a href="" class="btn btn-primary btn-block margin-bottom">Compose</a>
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Folders</h3>

                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                                                    <span class="label label-primary pull-right">12</span></a></li>
                                            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                            <li><a href="#"><i class="fa fa-phone"></i> Call Logs</a></li>
                                        </ul>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                            <div class="col-md-9 float-left">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Inbox</h3>

                                        <div class="box-tools pull-right">
                                            <div class="has-feedback">
                                                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <div class="mailbox-controls">
                                            <!-- Check all button -->
                                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                                            </div>
                                            <!-- /.btn-group -->
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                            <div class="pull-right">
                                                1-50/200
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                </div>
                                                <!-- /.btn-group -->
                                            </div>
                                            <!-- /.pull-right -->
                                        </div>
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td><div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                                        <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                                                        </td>
                                                        <td class="mailbox-attachment"></td>
                                                        <td class="mailbox-date">5 mins ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                                        <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                                                        </td>
                                                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                                        <td class="mailbox-date">28 mins ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                                        <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                                                        </td>
                                                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                                        <td class="mailbox-date">11 hours ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                                        <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                                                        </td>
                                                        <td class="mailbox-attachment"></td>
                                                        <td class="mailbox-date">15 hours ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                                        <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                                                        </td>
                                                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                                        <td class="mailbox-date">Yesterday</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <!-- /.table -->
                                        </div>
                                        <!-- /.mail-box-messages -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer no-padding">
                                        <div class="mailbox-controls">
                                            <!-- Check all button -->
                                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                                            </div>
                                            <!-- /.btn-group -->
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                            <div class="pull-right">
                                                1-50/200
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                </div>
                                                <!-- /.btn-group -->
                                            </div>
                                            <!-- /.pull-right -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /. box -->
                            </div>
                        </div>

                        <!--                        <div class="col-sm-12">
                        <?php if (!$this->session->isRCLogin) : ?>
                                                                                <a class="btn btn-primary btn-small" onclick="oauth.loginPopup()" href="#">Login RingCentral Account</a>
                        <?php else: ?>
                                                                                <a class="btn btn-primary btn-small" href="<?= base_url('ring_central/logout') ?>">Logout</a>
                        <?php endif; ?>
                                                        <pre id="token" style="background-color:#efefef;padding:1em;overflow-x:scroll"></pre>
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include viewPath('includes/footer');

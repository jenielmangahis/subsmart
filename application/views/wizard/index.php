<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>


<style>
    .wizard>.content>.body {
    width: 100%;
    height: 100%;
    padding: 30px 0 0;
    position: static;
}
.small-box h3, .small-box p {
    z-index: 5;
}
.small-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
}
.bg-danger, .bg-info, .bg-info>a {
    color: #fff!important;
}
.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box>.inner {
    padding: 10px;
}
.small-box>.small-box-footer {
    background-color: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.bg-info, .bg-info>a, .bg-success, .bg-success>a, .bg-warning, .bg-warning>a  {
    color: #fff!important;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}
small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}
.small-box .icon>i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear,-webkit-transform .3s linear;
}
.add-wizard-bx{
    position: relative;
    background: #52b0b0;
    height: 90px;
    width: 100%;
    border-radius: 6px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16);
}
.temp-box{
    position: relative;
    border-radius: 6px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16);
    margin: 0 0 30px;
}
.temp-box img{
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 6px;
}
.add-wizard-bx a i{
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50%;
    line-height: 40px;
    font-size: 20px;
    color: #52b0b0;
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    box-shadow: 0 3px 3px rgba(0,0,0,0.16);
    -webkit-transform: translate(-50%,-50%);
    -moz-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/wizard_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-card primary">
            <div class="nsm-card-content">
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="add-wizard-bx">
                                    <a href="<?php echo base_url('/wizard/add_wizard') ?>"><i class='bx bx-plus'></i></a>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 01</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 02</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 03</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 04</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 05</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 06</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="text-ter margin-bottom-sec fw-bold" style="margin-top: 20px;">Recent Open</div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 04</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 01</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-counter success">
                                    <div class="row ">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center action-btn dropdown">
                                            <button type="button" style="border: none;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">View</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h3> 02</h3>
                                            <span>Template</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  end recent open-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_wizard'); ?>

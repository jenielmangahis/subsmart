<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper">
    <div __wrapper_section class="fb-wrapper">

        <div class="fb-header py-2">
            <h2 class="text-gray d-inline-block">Create New Form</h2>
        </div>

        <div class="content-wrapper container-fluid">
            <div class="row">
                <div class="col-2">
                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                    <ul id="accordion" class="accordion">
                        <li>
                            <div class="link"></i>Blank Form<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                            </ul>
                        <li>
                            <div class="link"></i>Test Templates<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#">Blank Form</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="link"></i>Lorem Ipsum<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#">Blank Form</a></li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </div>
                <div class="col-10 vh-100">
                    <div id="formViewer" class="border border-secondary h-50">
                        <div class="text-center py-5">
                            <h1>BLANK FORM</h1>
                            <h1><i class="fa fa-file"></i></h1>
                        </div>
                    </div>
                    <div class="w-100 text-center mt-3"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addFormModal">Create New Form</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include viewPath('includes/footer'); ?>
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
                            <div class="link">Blank Form<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" onclick="setActiveTemplate(0)">Blankk Form</a></li>
                            </ul>
                        </li>
                        <li id="folder-1">
                            <div class="link">Business<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-2">
                            <div class="link">Registration Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-3">
                            <div class="link">Order Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-4">
                            <div class="link">Marketing<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-5">
                            <div class="link">Health Care<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-6">
                            <div class="link">Education<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-7">
                            <div class="link">Human Resources<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-8">
                            <div class="link">Service Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-9">
                            <div class="link">Contact Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-10">
                            <div class="link">Legal Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-11">
                            <div class="link">Survey<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-12">
                            <div class="link">Government<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-13">
                            <div class="link">Entertainment<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-14">
                            <div class="link">Events<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-15">
                            <div class="link">Travel<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-16">
                            <div class="link">Nonprofit<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                        <li id="folder-17">
                            <div class="link">Example Forms<i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="submenu">
                                <li><a href="#" class="empty-container" onclick="setActiveTemplate(0)">More Templates
                                        Coming</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-10 page-element h-100 border border-secondary container mt-0" id="formTemplatePreviewPage">
                    <div id="formTemplatePreview" class="row form-container-element" onclick="toggleCreate()">
                        <div class="col-12" id="blankFormPlaceHolder">
                            <div class="text-center py-5">
                                <h1>BLANK FORM</h1>
                                <h1><i class="fa fa-file"></i></h1>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 text-center mt-3"><button class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#addFormModal">Create New Form</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include viewPath('includes/footer'); ?>
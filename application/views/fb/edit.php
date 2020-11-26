<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper px-0">
    <div __wrapper_section class="fb-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pr-5" id="navFormName" href="#">aa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Form Editor</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Results</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-container container-fluid bg-white pt-3 pb-5">
            <div class="row">
                <div class="col-12 col-md-3 border-right">
                    <div class="row">
                        <div class="col-6">
                            <h4>Form Editor</h4>
                        </div>
                        <div class="col-6 pt-2 text-right">
                            <a href="/fb/view" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> View
                                Form</a>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="#editBuildTab" data-toggle="tab">Build</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#styleBuildTab" data-toggle="tab">Style</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#rulesBuildTab" data-toggle="tab">Rules</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane active" id="editBuildTab">
                            <div class="container-fluid px-0 mt-0">
                                <ul id="accordion" class="accordion">
                                    <li>
                                        <div class="link"></i>Common Items<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <div class="submenu">
                                            <div class="container-fluid mt-0 py-2">
                                                <table class="item-type-table" cellpadding="0" cellspacing="12"
                                                    border="0">
                                                    <tbody id="commonItemTypes">
                                                        <tr>
                                                            <td class="item-type" id="radioButton">
                                                                <div class="form-elements-template" element_type="RadioButton">
                                                                    <i class="fa fa-dot-circle-o template-icon"></i>
                                                                    Radio Button
                                                                </div>
                                                            </td>
                                                            <td class="item-type" id="dropDown">
                                                                <div class="form-elements-template" element_type="Dropdown">
                                                                    <i
                                                                        class="fa fa-caret-square-o-down template-icon"></i>
                                                                    Dropdown
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="item-type" id="checkBox">
                                                                <div class="form-elements-template" element_type="Checkbox">
                                                                    <i class="fa fa-check-square-o template-icon"></i>
                                                                    Check Box
                                                                </div>
                                                            </td>
                                                            <td class="item-type" id="emailAddress">
                                                                <div class="form-elements-template" element_type="Email">
                                                                    <i class="fa fa-envelope template-icon"></i> Email
                                                                    Address
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="item-type" id="checkBox">
                                                                <div class="form-elements-template" element_type="LongAnswer">
                                                                    <i class="fa fa-text-width template-icon"></i> Long
                                                                    Answer
                                                                </div>
                                                            </td>
                                                            <td class="item-type" id="emailAddress">
                                                                <div class="form-elements-template">
                                                                    <i class="fa fa-font template-icon"></i> Short
                                                                    Answer
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="item-type" id="calendar">
                                                                <div class="form-elements-template">
                                                                    <i class="fa fa-calendar template-icon"></i>
                                                                    Calendar
                                                                </div>
                                                            </td>
                                                            <td class="item-type" id="emailAddress">
                                                                <div class="form-elements-template">
                                                                    <i class="fa fa-font template-icon"></i> Number
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <li>
                                    <li>
                                        <div class="link"></i>Formatting Items<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="submenu">
                                            <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                                        </ul>
                                    <li>
                                    <li>
                                        <div class="link"></i>Email Items<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="submenu">
                                            <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                                        </ul>
                                    <li>
                                    <li>
                                        <div class="link"></i>Order Form Items<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="submenu">
                                            <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                                        </ul>
                                    <li>
                                    <li>
                                        <div class="link"></i>Matrix/Grid Items<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="submenu">
                                            <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                                        </ul>
                                    <li>
                                    <li>
                                        <div class="link"></i>Item Blocks<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="submenu">
                                            <li><a href="#" onclick="setActiveTemplate(0)">Blank Form</a></li>
                                        </ul>
                                    <li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="styleBuildTab">
                            <div class="container mt-0">
                                lorem ipsum
                            </div>
                        </div>
                        <div class="tab-pane" id="rulesBuildTab">
                            <div class="container mt-0">
                                lorem ipsum
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 position-relative">
                    <div class="container mt-1">
                        <div id="loadingContainer" class="bg-primary indicator">
                            <p class="text-white">loading...</p>
                        </div>
                        <div id="dangerIndicator" class="bg-danger indicator">
                            <p class="text-white">error saving changes.</p>
                        </div>
                        <div id="successIndicator" class="bg-success indicator">
                            <p class="text-white">changes saved.</p>
                        </div>
                        <div id="formBuilderContainer" class="row">
                            <div class="col-12" id="blankFormPlaceHolder">
                                Drag items from the left and drop them here.
                            </div>
                        </div>
                        <div class="view-form text-center">
                            <a class="btn btn-primary" href="/fb/view/<?= $form_id ?>">View Form</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(() => {
    handleOnLoad(<?= $form_id ?>);
});
</script>
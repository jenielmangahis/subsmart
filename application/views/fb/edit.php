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
                        <a class="nav-link" href="/fb/edit/<?= $form_id ?>">Form Editor</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fb/settings/<?= $form_id ?>">Settings</a>
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
                <div class="col-12 col-md-3 border-right" id="builderSidebar">
                    <div class="row">
                        <div class="col-6">
                            <h4>Form Editor</h4>
                        </div>
                        <div class="col-6 pt-2 text-right">
                            <a href="/fb/view/<?= $form_id?>" class="btn btn-outline-primary btn-sm"><i
                                    class="fa fa-eye"></i> View
                                Form</a>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link build-tab builder-tabs active" href="#editBuildTab"
                                data-toggle="tab">Build</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link style-tab builder-tabs" href="#styleBuildTab" data-toggle="tab">Style</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rules-tab builder-tabs" href="/fb/rules/<?= $form_id ?>">Rules</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane active" id="editBuildTab">
                            <div class="container-fluid px-0 mt-0">
                                <div class="row sidebar-container">
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Common Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RadioButton">
                                            <i class="fa fa-dot-circle-o template-icon"></i>
                                            Radio Button
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Dropdown">
                                            <i class="fa fa-caret-square-o-down template-icon"></i>
                                            Dropdown
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Checkbox">
                                            <i class="fa fa-check-square-o template-icon"></i>
                                            Check Box
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Email">
                                            <i class="fa fa-envelope template-icon"></i> Email
                                            Address
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="LongAnswer">
                                            <i class="fa fa-text-width template-icon"></i> Long
                                            Answer
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ShortAnswer">
                                            <i class="fa fa-font template-icon"></i> Short
                                            Answer
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Calendar">
                                            <i class="fa fa-calendar template-icon"></i>
                                            Calendar
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="NumberInput">
                                            <i class="fa fa-font template-icon"></i> Number
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="FileUpload">
                                            <i class="fa fa-file template-icon"></i> File Upload
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="TextList">
                                            <i class="fa fa-list template-icon"></i> Text List
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ShortAnswerGroup">
                                            <i class="fa fa-list template-icon"></i> Short Answer Group
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Rating">
                                            <i class="fa fa-star-half-alt template-icon"></i>
                                            Rating
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Ranking">
                                            <i class="fa fa-boxes template-icon"></i> Ranking
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="HiddenField">
                                            <i class="fa fa-eye-slash template-icon"></i> Hidden
                                            Field
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Signature">
                                            <i class="fa fa-signature template-icon"></i> Signature
                                        </div>
                                    </div>
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Formatting Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Heading">
                                            <i class="fa fa-heading template-icon"></i>
                                            Heading
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="BlankSpace">
                                            <i class="fa arrows-alt-h template-icon"></i>
                                            Blank Space
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="FormattedText">
                                            <i class="fa fa-align-center template-icon"></i>
                                            Formatted Text
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Image">
                                            <i class="fa fa-image template-icon"></i>
                                            Image
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Link">
                                            <i class="fa fa-link template-icon"></i>
                                            Link
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CustomCode">
                                            <i class="fa fa-code template-icon"></i>
                                            Custom Code
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ContainerBlock">
                                            <i class="fa fa-columns template-icon"></i>
                                            Container Block
                                        </div>
                                    </div>
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Email Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="Email">
                                            <i class="fa fa-envelope template-icon"></i> Email
                                            Address
                                        </div>
                                    </div>
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Ordering Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RadioButtonPricing">
                                            <i class="fa fa-dot-circle-o text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i> Radio Button
                                            Pricing
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="DropdownPricing">
                                            <i class="fa fa-caret-square-o-down text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i> Dropdown
                                            Pricing
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CheckboxPricing">
                                            <i class="fa fa-check-square-o text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i> Checkbox
                                            Pricing
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="TextboxPricing">
                                            <i class="fa fa-font text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i> Textbox
                                            Pricing
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="TextboxQuantity">
                                            <i class="fa fa-font template-icon"></i>
                                            Textbox Quantity
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="TextboxQuantity">
                                            <i class="fa fa-list-ol template-icon"></i>
                                            Quantity List
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RadioButtonPercent">
                                            <i class="fa fa-dot-circle-o text-sm template-icon"></i>
                                            <i class="fa fa-percent text-sm template-icon"></i>
                                            Radio Button Percent
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="DropdownPercent">
                                            <i class="fa fa-caret-square-o-down text-sm template-icon"></i>
                                            <i class="fa fa-percent text-sm template-icon"></i>
                                            Dropdown Percent
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ImageListPricing">
                                            <i class="fa fa-image text-sm template-icon"></i>
                                            <i class="fa fa-percent text-sm template-icon"></i>
                                            Image List Pricing
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CouponCode">
                                            <i class="fa fa-sqauare text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i>
                                            Coupon Code
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RunningTotal">
                                            <i class="fa fa-calculator text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i>
                                            Running Total
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ProductOrdering">
                                            <i class="fa fa-calculator text-sm template-icon"></i>
                                            <i class="fa fa-dollar-sign text-sm template-icon"></i>
                                            Product Ordering
                                        </div>
                                    </div>
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Matrix Grid Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RadioButtonMatrix">
                                            <i class="fa fa-dot-circle-o template-icon"></i> Radio
                                            Button Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="RadioButtonMatrixMultiScale">
                                            <i class="fa fa-dot-circle-o template-icon"></i> Radio
                                            Button Matrix Multi Scale
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="DropdownMatrix">
                                            <i class="fa fa-caret-square-o-down template-icon"></i> Dropdown Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="DropdownMatrixMultiScale">
                                            <i class="fa fa-caret-square-o-down template-icon"></i> Dropdown Matrix
                                            Multi
                                            Scale
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CheckboxMatrix">
                                            <i class="fa fa-check-square-o template-icon"></i> Checkbox Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CheckboxMatrixMultiScale">
                                            <i class="fa fa-check-square-o template-icon"></i> Checkbox Matrix Multi
                                            Scale
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ShortAnswerMatrix">
                                            <i class="fa fa-font template-icon"></i> Short Answer Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="LongAnswerMatrix">
                                            <i class="fa fa-text-width template-icon"></i> Long Answer Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="StarMatrix">
                                            <i class="fa fa-star template-icon"></i> Star Matrix
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="ZoneList">
                                            <i class="fa fa-star template-icon"></i> Zone List
                                        </div>
                                    </div>
                                    <div class="col-12 element-group-label my-2">
                                        <p class="sidebar-title"><span>Company Items</span></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CustomerSelect">
                                            <i class="fa fa-users template-icon"></i> Customer Select
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="CustomerSelect">
                                            <i class="fa fa-map-marker template-icon"></i> Job Location
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-elements-template in-parent" element_type="PaymentMethods">
                                            <i class="fa fa-map-marker template-icon"></i> Payment Methods
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="styleBuildTab">
                            <div class="container-fluid px-0 mt-0">
                                <ul class="accordion" id="styleAccordion">
                                    <li>
                                        <div class="link"></i>Themes<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <div class="submenu">
                                            <div class="container-fluid mt-0 py-2">
                                                <h6>Style: </h6>
                                                <div class="row p-1">
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('default')"
                                                            class="bg-secondary default-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Default</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('big')"
                                                            class="bg-secondary big-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Big</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('bigger')"
                                                            class="bg-secondary bigger-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Bigger</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('slim')"
                                                            class="bg-secondary slim-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Slim</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('rounded')"
                                                            class="bg-secondary rounded-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Rounded</p>
                                                                <div class="w-100 h-25 border d-block rounded-pill">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block rounded-pill">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('narrow')"
                                                            class="bg-secondary narrow-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Narrow</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('modern')"
                                                            class="bg-secondary modern-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Modern</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('casual')"
                                                            class="bg-secondary casual-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Casual</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('airy')"
                                                            class="bg-secondary airy-control style-display-container form-style p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Airy</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleStyleChangePreview('bubbly')"
                                                            class="bg-secondary bubbly-control style-display-container form-style p-1 text-center font-bubbly">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <p>Bubbly</p>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block">Button</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6>Colors: </h6>
                                                <div class="row p-1">
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('primary')"
                                                            class="bg-secondary form-primary form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-primary mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-primary">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('orange')"
                                                            class="bg-secondary form-orange form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-orange mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-warning text-dark">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('violet')"
                                                            class="bg-secondary form-violet form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-violet mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-violet">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('sky-blue')"
                                                            class="bg-secondary form-sky-blue form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-sky-blue mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-sky-blue">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('persian-green')"
                                                            class="bg-secondary form-persian-green form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-persian-green mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-persian-green-fields">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="w-100 h-25 border d-block bg-persian-green-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('green')"
                                                            class="bg-secondary form-green form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-green mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block bg-green-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-green-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('san-marino-blue')"
                                                            class="bg-secondary form-san-marino-blue form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-san-marino-blue mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-san-marino-blue-fields">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="w-100 h-25 border d-block bg-san-marino-blue-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('mulberry')"
                                                            class="bg-secondary form-mulberry form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-mulberry mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-mulberry-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-mulberry-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('valencia')"
                                                            class="bg-secondary form-valencia form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-valencia mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-valencia-fields">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="w-100 h-25 border d-block bg-valencia-button text-dark">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('sandy')"
                                                            class="bg-secondary form-sandy form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-sandy mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block bg-sandy-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-sandy-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('terracotta')"
                                                            class="bg-secondary form-terracotta form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-terracotta mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-terracotta-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-terracotta-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('comet')"
                                                            class="bg-secondary form-comet form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-comet mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block bg-comet-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-comet-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('jungle')"
                                                            class="bg-secondary form-jungle form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-jungle mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block bg-jungle-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-jungle-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('light-brown')"
                                                            class="bg-secondary form-light-brown form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-light-brown mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-light-brown-fields">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="w-100 h-25 border d-block bg-light-brown-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('dark-theme')"
                                                            class="bg-secondary form-dark-theme form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 border bg-dark-theme">
                                                                <div class="w-100 h-25 d-block mb-1">
                                                                    <div class="bg-dark-theme-heading">Header</div>
                                                                </div>
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-dark-theme-fields">
                                                                </div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-dark-theme-button">
                                                                Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('secondary')"
                                                            class="bg-secondary form-secondary form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div
                                                                    class="w-100 h-25 border d-block bg-secondary mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-secondary">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('success')"
                                                            class="bg-secondary form-success form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-success mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-success">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('danger')"
                                                            class="bg-secondary form-danger form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-danger mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-danger">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('warning')"
                                                            class="bg-secondary form-warning form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-warning mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-warning">Button
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('info')"
                                                            class="bg-secondary form-info form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block  bg-info mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-info">Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('light')"
                                                            class="bg-secondary form-light form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light text-dark">
                                                                <div class="w-100 h-25 border d-block bg-light mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-light text-dark">
                                                                Button</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 p-1 mb-4">
                                                        <div onclick="handleColorChangePreview('dark')"
                                                            class="bg-secondary form-dark form-color style-display-container p-1 text-center">
                                                            <div class="p-2 mb-1 bg-light">
                                                                <div class="w-100 h-25 border d-block bg-dark mb-1">
                                                                    <p>Header</p>
                                                                </div>
                                                                <div class="w-100 h-25 border d-block"></div>
                                                            </div>

                                                            <div class="w-100 h-25 border d-block bg-dark">Button</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="link"></i>Customize<i class="fa fa-chevron-down"></i>
                                        </div>
                                        <div class="submenu">
                                            <div class="container-fluid mt-0 py-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="p-2">
                                                            <select name="customize-select" id="customizeSelect"
                                                                class="form-control" size="10"
                                                                onchange="handleCustomizeSelectChange()">
                                                                <optgroup label="Page">
                                                                    <option value="page-background" selected="selected">
                                                                        Page
                                                                        Background</option>
                                                                    <option value="page-background-size">Page Background
                                                                        Size
                                                                    </option>
                                                                    <option value="page-font-family">
                                                                        Font Family</option>
                                                                    <option value="page-font-size">Font Size
                                                                    </option>
                                                                    <option value="page-header-footer-text-color">
                                                                        Header/Footer Text Color</option>
                                                                    <option value="page-link-color">Link Color
                                                                    </option>
                                                                </optgroup>
                                                                <optgroup label="Form">
                                                                    <option value="form-border-color">
                                                                        Form Border Color</option>
                                                                    <option value="form-border-rounding">
                                                                        Form Border Rounding</option>
                                                                    <option value="form-border-width">Form Border
                                                                        Width
                                                                    </option>
                                                                    <option value="form-background">
                                                                        Form Background</option>
                                                                    <option value="form-background-size">
                                                                        Form Background Size</option>
                                                                    <option value="form-shadow">Form Shadow
                                                                    </option>
                                                                    <option value="form-text-color"> Form Text Color
                                                                    </option>
                                                                    <option value="heading-text-color">Heading Text
                                                                        Color
                                                                    </option>
                                                                    <option value="heading-background">Heading
                                                                        Background</option>
                                                                    <option value="heading-background-size">Heading
                                                                        Background Size</option>
                                                                    <option value="heading-border-rounding">
                                                                        Heading Border Rounding</option>
                                                                    <!-- <option value="error-background">
                                                                        Error
                                                                        Background</option>
                                                                    <option value="error-text-color">Error Text Color
                                                                    </option> -->
                                                                </optgroup>
                                                                <optgroup label="Items">
                                                                    <option value="item-required-icon">Required
                                                                        Icon
                                                                    </option>
                                                                    <option value="item-label-bold">
                                                                        Label Bold</option>
                                                                    <option value="item-highlight">
                                                                        Highlight</option>
                                                                    <option value="field-border-color">
                                                                        Field Border Color</option>
                                                                    <option value="field-border-rounding">
                                                                        Field Border Rounding</option>
                                                                    <option value="field-border-width">
                                                                        Field Border Width</option>
                                                                    <option value="field-font-family">
                                                                        Field Font Family</option>
                                                                    <option value="field-font-size">
                                                                        Field Font Size</option>
                                                                    <option value="field-background">
                                                                        Field Background</option>
                                                                    <option value="field-text-color">
                                                                        Field
                                                                        Text Color</option>
                                                                    <option value="field-padding">
                                                                        Field
                                                                        Padding</option>
                                                                    <option value="item-padding">Item
                                                                        Padding</option>
                                                                    <option value="item-spacing">
                                                                        Item Spacing</option>
                                                                </optgroup>
                                                                <optgroup label="Matrix/Multi-Scale Rows">
                                                                    <option value="matrix-header-text">
                                                                        Header Text</option>
                                                                    <option value="matrix-header-background">
                                                                        Header Background</option>
                                                                    <option value="matrix-sub-header-background">
                                                                        Sub Header Background</option>
                                                                    <option value="matrix-row-text-color">Row Text
                                                                        Color
                                                                    </option>
                                                                    <option value="matrix-row-header-color">
                                                                        Row Header Color</option>
                                                                    <option value="matrix-row-color">
                                                                        Row Color</option>
                                                                    <option value="matrix-alt-row-text-color">Alt Row
                                                                        Text
                                                                        Color</option>
                                                                    <option value="matrix-alt-row-header-color">
                                                                        Alt Row Header Color</option>
                                                                    <option value="matrix-alt-row-color">
                                                                        Alt Row Color</option>
                                                                    <option value="matrix-grid-lines">
                                                                        Grid Lines</option>
                                                                </optgroup>
                                                                <optgroup label="Submit Button">
                                                                    <option value="submit-background">Button
                                                                        Background
                                                                    </option>
                                                                    <option value="submit-hover-background">Button
                                                                        Hover
                                                                        Background</option>
                                                                    <option value="submit-background-size">
                                                                        Button Background Size</option>
                                                                    <option value="submit-border-style">Button Border
                                                                        Style</option>
                                                                    <option value="submit-border-width">Button Border
                                                                        Width</option>
                                                                    <option value="submit-bold">Button Bold
                                                                    </option>
                                                                    <option value="submit-rounding">Button
                                                                        Rounding
                                                                    </option>
                                                                    <option value="submit-text-color">
                                                                        Button Text Color</option>
                                                                    <option value="submit-width">Button Width
                                                                    </option>
                                                                    <option value="submit-height-padding">Button Height
                                                                        Padding
                                                                    </option>
                                                                    <option value="submit-font-family">Button Font
                                                                        Family
                                                                    </option>
                                                                    <option value="submit-font-size">Button Font Size
                                                                    </option>
                                                                    <option value="submit-capitalization">Button
                                                                        Capitalization</option>
                                                                    <option value="submit-shadows">Button Shadow
                                                                    </option>
                                                                    <option value="submit-hide">Hide Buttons
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                            <div class="d-none">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a
                                                                            href="#customizeColorTab">color</a></li>
                                                                    <li><a href="#customizeBackgroundSizeTab">bg
                                                                            size</a></li>
                                                                    <li><a href="#customizeFontFamilyTab">font
                                                                            family</a></li>
                                                                    <li><a href="#customizeFontSizeTab">font
                                                                            size</a></li>
                                                                    <li><a href="#customizeBorderRoundingTab">border
                                                                            rounding</a></li>
                                                                    <li><a href="#customizeBorderWidthTab">border
                                                                            width</a></li>
                                                                    <li><a href="#customizeShadowTab">shadow</a></li>
                                                                    <li><a href="#customizeHideTab">hide</a></li>
                                                                    <li><a href="#customizeRequiredIconTab">required
                                                                            icon</a></li>
                                                                    <li><a href="#customizeBoldTab">bold</a></li>
                                                                    <li><a href="#customizePaddingTab">padding</a></li>
                                                                    <li><a href="#customizeSpacingTab">spacing</a></li>
                                                                    <li><a href="#customizeWidthTab">width</a></li>
                                                                    <li><a
                                                                            href="#customizeCapitalizationTab">capitalization</a>
                                                                    </li>
                                                                    <li><a
                                                                            href="#customizeBorderStyleTab">BorderStyle</a>
                                                                    </li>
                                                                    <li><a href="#menu3">Menu 3</a></li>
                                                                </ul>
                                                                <input type="hidden" name="page-background"
                                                                    id="page-background-input"
                                                                    onchange="handleCustomStyleChange('#page-background-input', '.page-element', 'background')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="p-2">
                                                            <div class="tab-content" id="customStyleInputControls">
                                                                <input type="hidden" name="active-option"
                                                                    id="active-option">
                                                                <div class="tab-pane active" id="customizeColorTab">
                                                                    <div id="colorPicker"></div>
                                                                </div>
                                                                <div class="tab-pane" id="customizeBackgroundSizeTab">
                                                                    <select name="background-size"
                                                                        id="page-background-size-input" size="10"
                                                                        onchange="handleCustomStyleChange('#page-background-size-input', '.page-element', 'background-size')"
                                                                        class="form-control">
                                                                        <option value="tile">Tile</option>
                                                                        <option value="cover">Full Cover</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeSpacingTab">
                                                                    <select name="spacing" id="item-spacing-input"
                                                                        size="10"
                                                                        onchange="handleCustomStyleChange('#item-spacing-input', '.page-element', 'margin')"
                                                                        class="form-control">
                                                                        <option value="0">None</option>
                                                                        <option value="1px">1px</option>
                                                                        <option value="2px">2px</option>
                                                                        <option value="5px">5px</option>
                                                                        <option value="8px">8px</option>
                                                                        <option value="10px">10px</option>
                                                                        <option value="15px">15px</option>
                                                                        <option value="20px">20px</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizePaddingTab">
                                                                    <select name="padding" id="item-padding-input"
                                                                        size="10"
                                                                        onchange="handleCustomStyleChange('#item-padding-input', '.page-element', 'margin')"
                                                                        class="form-control">
                                                                        <option value="0">None</option>
                                                                        <option value="1px">1px</option>
                                                                        <option value="2px">2px</option>
                                                                        <option value="5px">5px</option>
                                                                        <option value="8px">8px</option>
                                                                        <option value="10px">10px</option>
                                                                        <option value="15px">15px</option>
                                                                        <option value="20px">20px</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeFontFamilyTab">
                                                                    <select name="font-family"
                                                                        id="page-font-family-input" size="10"
                                                                        onchange="handleCustomStyleChange('#page-font-family-input', '.page-element', 'font-family')"
                                                                        class="form-control">
                                                                        <option
                                                                            value="Arial,'Helvetica Neue',Helvetica,sans-serif">
                                                                            Arial</option>
                                                                        <option
                                                                            value="'Century Gothic',CenturyGothic, AppleGothic, sans-serif">
                                                                            Century Gothic</option>
                                                                        <option value="'Courier New',Courier,mono">
                                                                            Courier</option>
                                                                        <option value="Georgia,serif">Georgia</option>
                                                                        <option
                                                                            value="'Lucida Sans Unicode','Lucida Grande',sans-serif">
                                                                            Lucida</option>
                                                                        <option value="Tahoma,sans-serif">Tahoma
                                                                        </option>
                                                                        <option value="'Times New Roman',Times,serif">
                                                                            Times New Roman</option>
                                                                        <option value="Verdana,Geneva,sans-serif">
                                                                            Verdana</option>
                                                                        <option value="'Alfa Slab One',cursive">Alfa
                                                                            Slab One</option>
                                                                        <option value="'Architects Daughter',cursive">
                                                                            Architects Daughter</option>
                                                                        <option value="'Arvo',serif">Arvo</option>
                                                                        <option value="'Chewy',cursive">Chewy</option>
                                                                        <option value="'Cinzel',serif">Cinzel</option>
                                                                        <option value="'Cutive Mono',courier">Cutive
                                                                            Mono</option>
                                                                        <option value="'Dosis',sans-serif">Dosis
                                                                        </option>
                                                                        <option value="'Droid Serif', serif">Droid Serif
                                                                        </option>
                                                                        <option value="'Great Vibes',cursive">Great
                                                                            Vibes</option>
                                                                        <option value="'Handlee',cursive">Handlee
                                                                        </option>
                                                                        <option value="'Kaushan Script',cursive">Kaushan
                                                                            Script</option>
                                                                        <option value="'Lato',sans-serif">Lato</option>
                                                                        <option value="'Lobster',cursive">Lobster
                                                                        </option>
                                                                        <option value="'Lora', serif">Lora</option>
                                                                        <option value="'Luckiest Guy',cursive">Luckiest
                                                                            Guy</option>
                                                                        <option value="'Merriweather',serif">
                                                                            Merriweather</option>
                                                                        <option value="'Muli',sans-serif">Muli</option>
                                                                        <option value="'Oswald',sans-serif">Oswald
                                                                        </option>
                                                                        <option value="'Open Sans',sans-serif">Open Sans
                                                                        </option>
                                                                        <option
                                                                            value="'Open Sans Condensed',sans-serif">
                                                                            Open Sans Condensed</option>
                                                                        <option value="'Pacifico',cursive">Pacifico
                                                                        </option>
                                                                        <option value="'Playball',cursive">Playball
                                                                        </option>
                                                                        <option value="'Poiret One',cursive">Poiret One
                                                                        </option>
                                                                        <option value="'Questrial',sans-serif">Questrial
                                                                        </option>
                                                                        <option value="'Raleway',sans-serif">Raleway
                                                                        </option>
                                                                        <option value="'Roboto',sans-serif">Roboto
                                                                        </option>
                                                                        <option value="'Roboto Slab',serif">Roboto Slab
                                                                        </option>
                                                                        <option value="'Sanchez',serif">Sanchez</option>
                                                                        <option value="'Share Tech Mono',courier">Share
                                                                            Tech Mono</option>
                                                                        <option value="'Sigmar One',cursive">Sigmar One
                                                                        </option>
                                                                        <option value="'Signika',sans-serif">Signika
                                                                        </option>
                                                                        <option value="'Titillium Web',sans-serif">
                                                                            Titillium Web</option>
                                                                        <option value="'Ubuntu',sans-serif">Ubuntu
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeFontSizeTab">
                                                                    <select name="font-size" id="page-font-size-input"
                                                                        size="10"
                                                                        onchange="handleCustomStyleChange('#page-font-size-input', '.page-element', 'font-size')"
                                                                        class="form-control">
                                                                        <option value="10px">10px</option>
                                                                        <option value="11px">11px</option>
                                                                        <option value="12px">12px</option>
                                                                        <option value="13px">13px</option>
                                                                        <option value="14px">14px</option>
                                                                        <option value="16px">16px</option>
                                                                        <option value="18px">18px</option>
                                                                        <option value="20px">20px</option>
                                                                        <option value="24px">24px</option>
                                                                        <option value="30px">30px</option>
                                                                        <option value="36px">36px</option>
                                                                        <option value="48px">48px</option>
                                                                        <option value="56px">56px</option>
                                                                        <option value="72px">72px</option>
                                                                        <option value="90px">90px</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeBorderRoundingTab">
                                                                    <select name="border-rounding"
                                                                        id="form-border-rounding-input" size="10"
                                                                        onchange="handleCustomStyleChange('#form-border-rounding-input', '.form-container-element', 'border-rounding')"
                                                                        class="form-control">
                                                                        <option value="0px">Off</option>
                                                                        <option value="2px">2px</option>
                                                                        <option value="4px">4px</option>
                                                                        <option value="6px">6px</option>
                                                                        <option value="8px">8px</option>
                                                                        <option value="10px">10px</option>
                                                                        <option value="12px">12px</option>
                                                                        <option value="16px">16px</option>
                                                                        <option value="20px">20px</option>
                                                                        <option value="24px">24px</option>
                                                                        <option value="30px">30px</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeBorderWidthTab">
                                                                    <select name="border-width"
                                                                        id="form-border-width-input" size="10"
                                                                        onchange="handleCustomStyleChange('#form-border-width-input', '.form-container-element', 'border-width')"
                                                                        class="form-control">
                                                                        <option value="0px">None</option>
                                                                        <option value="1px">1px</option>
                                                                        <option value="2px">2px</option>
                                                                        <option value="3px">3px</option>
                                                                        <option value="5px">5px</option>
                                                                        <option value="10px">10px</option>
                                                                        <option value="15px">15px</option>
                                                                        <option value="20px">20px</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeWidthTab">
                                                                    <select name="width" id="form-width-input" size="10"
                                                                        onchange="handleCustomStyleChange('#form-width-input', '.form-container-element', 'width')"
                                                                        class="form-control">
                                                                        <option value="0">auto (default)</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeShadowTab">
                                                                    <select name="shadow" id="form-shadow-input"
                                                                        size="10"
                                                                        onchange="handleCustomStyleChange('#form-shadow-input', '.form-container-element', 'shadow')"
                                                                        class="form-control">
                                                                        <option value="none">Hide</option>
                                                                        <option value="rgba(0, 0, 0, 0.3) 0px 1px 6px;">Show</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeHideTab">
                                                                    <select name="hide" id="form-hide-input"
                                                                        size="10"
                                                                        onchange="handleCustomStyleChange('#form-hide-input', '.form-container-element', 'display')"
                                                                        class="form-control">
                                                                        <option value="none">Hide</option>
                                                                        <option value="inline-block">Show</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeCapitalizationTab">
                                                                    <select name="capitalization"
                                                                        id="submit-capitalization-input" size="10"
                                                                        onchange="handleCustomStyleChange('#submit-capitalization-input', '.submit-button-element', 'text-transform')"
                                                                        class="form-control">
                                                                        <option value="none">Normal</option>
                                                                        <option value="uppercase">All Caps</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeBorderStyleTab">
                                                                    <select name="border-style"
                                                                        id="submit-border-style-input" size="10"
                                                                        onchange="handleCustomStyleChange('#submit-border-style-input', '.submit-button-element', 'border-style')"
                                                                        class="form-control">
                                                                        <option value="none">None</option>
                                                                        <option value="solid">Solid</option>
                                                                        <option value="dotted">Dotted</option>
                                                                        <option value="dashed">Dashed</option>
                                                                        <option value="double">Double</option>
                                                                        <option value="groove">Groove</option>
                                                                        <option value="outset">Raised</option>
                                                                        <option value="ridge">Ridge</option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeRequiredIconTab">
                                                                    <select name="required-icon"
                                                                        id="item-required-icon-input" size="10"
                                                                        onchange="handleCustomStyleChange('#item-required-icon-input', '.item-container-element', 'shadow')"
                                                                        class="form-control">
                                                                        <option value="none">None</option>
                                                                        <option value="asterisk">Asterisk</option>
                                                                        <option value="asterisk_red">Red Asterisk
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="tab-pane" id="customizeBoldTab">
                                                                    <select name="bold" id="bold-icon" size="10"
                                                                        onchange="handleCustomStyleChange('#bold-icon', '.item-container-element', 'font-weight')"
                                                                        class="form-control">
                                                                        <option value="normal">Normal</option>
                                                                        <option value="bold">Bold</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="rulesBuildTab">
                            <div class="container mt-0">
                                lorem ipsum
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-12 col-md-9 position-relative page-element" id="builderFormColumn">
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
                        <div id="styleSaveContainer" class="indicator text-right">
                            <button onclick="handleFormStyleSave()"
                                class="btn btn-sm btn-primary d-inline-block">Save</button>
                            <button onclick="handleCopyFromFormClicked()"
                                class="btn btn-sm btn-secondary d-inline-block"
                                onclick="handleCopyFromFormClicked()">Copy From Form...</button>
                        </div>
                        <div id="formBuilderContainer" class="row form-container-element">
                            <div class="col-12" id="blankFormPlaceHolder">
                                Drag items from the left and drop them here.
                            </div>
                        </div>
                        <div class="view-form text-center">
                            <a class="btn submit-button-element" href="/fb/view/<?= $form_id ?>" target="__blank">View
                                Form</a>
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
    // console.log(<?= base_url('assets/fb/images/backgrounds/public/business-bg-1.jpg')?>)
});
</script>
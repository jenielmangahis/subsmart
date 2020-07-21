<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php /*include viewPath('includes/sidebars/accounting/taxes');*/ ?>
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
  <!-- Turn Off Sales Tax Popup -->
    <div class="modal" id="make-inactive">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="turnoff-box">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Change Alabama Department of Revenue to inactive</h3>
                    <p>Are you sure you want to make this tax agency inactive? This means that you'll stop collecting tax for it. </p>
                    <p>We'll save your tax info, and you can always make it active later.</p>

                    <div class="act-btn-off">
                        <a href="#" class="btn-of">Cancel</a>
                        <a href="#" class="btn-of yesbtn">Make inactive</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Turn Off Sales Tax Popup -->

    <!-- Turn Off Sales Tax Popup -->
    <div class="modal" id="turnoff-pop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="turnoff-box">
                    <div class="alert-msg">
                        <i class="fal fa-exclamation-circle"></i>
                        <p>Are you sure you want to turn off sales tax?</p>
                    </div>

                    <div class="act-btn-off">
                        <a href="#" class="btn-of">No</a>
                        <a href="#" class="btn-of yesbtn">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Turn Off Sales Tax Popup -->

    <!-- Add Agency Sidebar -->
    <div id="overlay" class=""></div>
    <div id="side-menu" class="main-side-nav">
        <div class="side-title">
            <h4>Add agency</h4>
            <a id="close-menu" class="menuCloseButton" onclick="closeSideNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div class="mainMenu nav">
            <div class="add-frm">
                <div class="form-group">
                    <label>Agency</label>
                    <select class="form-control">
                        <option>Select an Agency</option>
                        <option>Agency 1</option>
                        <option>Agency 2</option>
                        <option>Agency 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Filing frequency</label>
                    <select class="form-control">
                        <option>Choose a frequency</option>
                        <option>frequency 1</option>
                        <option>frequency 2</option>
                        <option>frequency 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="" placeholder="" class="form-control">
                </div>
            </div>
        </div>

        <div class="save-act">
            <button class="savebtn">Save</button>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

    <!-- Edit Agency Sidebar -->
    <div id="overlay-edit" class=""></div>
    <div id="side-menu-edit" class="main-side-nav">
        <div class="side-title">
            <h4>Alabama details <span>Alabama Department of Revenue</span></h4>
            <a id="close-menu-edit" class="menuCloseButton" onclick="closeSideNav2()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div class="mainMenu nav">
            <div class="add-frm">
                <div class="form-group">
                    <label>Filing frequency</label>
                    <select class="form-control">
                        <option>Choose a frequency</option>
                        <option>frequency 1</option>
                        <option>frequency 2</option>
                        <option>frequency 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Start of tax period</label>
                    <p>January</p>
                </div>

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="" placeholder="" class="form-control">
                </div>
            </div>
        </div>

        <div class="save-act">
            <button class="btn-cmn">Make inactive</button>
            <button class="savebtn">Save</button>
        </div>
    </div>
    <!-- End Edit Agency Sidebar -->

    <!-- Add Custom Tax Sidebar -->
    <div id="overlay-cus-tx" class=""></div>
    <div id="side-menu-cus-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Add a custom sales tax rate</h4>
            <a id="close-menu-cus-tx" class="menuCloseButton" onclick="closeSideNav3()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div class="mainMenu nav">
            <div class="add-frm">
                <div class="form-group">
                    <div class="cusradio">
                        <input type="radio" id="test1" name="radio-group" checked>
                        <label for="test1">Single</label>                        
                    </div>
                    <div class="cusradio">
                        <input type="radio" id="test2" name="radio-group">
                        <label for="test2">Combined</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="" placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Agency</label>
                    <select class="form-control">
                        <option>Choose a Agency</option>
                        <option>Agency 1</option>
                        <option>Agency 2</option>
                        <option>Agency 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Rate (%)</label>
                    <input type="text" name="" placeholder="" class="form-control">
                </div>
            </div>
        </div>

        <div class="save-act">
            <button class="btn-cmn">Cancel</button>
            <button class="savebtn">Save</button>
        </div>
    </div>
    <!-- End Add Custom Tax Sidebar -->

    <!-- Taxs -->
    <section class="taxs-wrp edit-tax-wrp">      
        <div class="tax-iner-wrp">
            <div class="container-fluid">
                <div class="taxs-header">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="left-taxs">
                                <a href="index.html" class="backstep"><i class="fal fa-chevron-left"></i> Back to sales tax center</a>
                                <h1>Edit settings</h1>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="action-bar">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#turnoff-pop" class="btn-cmn">Turn off sales tax</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tax-agencies-block">
                    <div class="table-head">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h3>Tax agencies</h3>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="tax-tble-act">
                                    <a href="javascript:void(0);" id="menuButton" onclick="openSideNav()" class="btn-cmn">Add agency</a>
                                    <div class="setting-drop dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i></a>

                                        <!-- <div class="dropdown-menu">
                                            <h6>Other</h6>

                                            <div class="checkcu">
                                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                <label for="vehicle1"> Include inactive</label>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tax-tbl-block">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>AGENCY</th>
                                    <th>FILING FREQUENCY</th>
                                    <th>START OF TAX PERIOD</th>
                                    <th>START DATE</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Florida Department of Revenue</td>
                                    <td>Monthly</td>
                                    <td>January</td>
                                    <td>01/01/2012</td>
                                    <td><a href="javascript:void(0);" id="menuButton" onclick="openSideNav2()">Edit</a>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#make-inactive">Make inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Florida Department of Revenue</td>
                                    <td>Monthly</td>
                                    <td>January</td>
                                    <td>01/01/2012</td>
                                    <td><a href="javascript:void(0);" id="menuButton" onclick="openSideNav2()">Edit</a>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Make inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Florida Department of Revenue</td>
                                    <td>Monthly</td>
                                    <td>January</td>
                                    <td>01/01/2012</td>
                                    <td><a href="javascript:void(0);" id="menuButton" onclick="openSideNav2()">Edit</a>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Make inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Florida Department of Revenue</td>
                                    <td>Monthly</td>
                                    <td>January</td>
                                    <td>01/01/2012</td>
                                    <td><a href="javascript:void(0);" id="menuButton" onclick="openSideNav2()">Edit</a>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Make inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pager-table">
                        <ul>
                            <li><a href="#">< First</a></li>
                            <li><a href="#">Previous</a></li>
                            <li class="active"><a href="#">1-4 of 4</a></li>
                            <li><a href="#">Next</a></li>
                            <li><a href="#">Last ></a></li>
                        </ul>
                    </div>
                </div>

                <div class="tax-agencies-block">
                    <div class="table-head">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h3>Custom rates</h3>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="tax-tble-act">
                                    <a href="javascript:void(0);" id="menuButton" onclick="openSideNav3()" class="btn-cmn">Add rate</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tax-tbl-block custom-rate">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>AGENCY</th>
                                    <th>RATE</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <p>Nothing to see here yet. Add a rate to get this party started.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
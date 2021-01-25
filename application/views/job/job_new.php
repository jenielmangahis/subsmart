<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .left-sidebar-main .card {
        padding: 0px;
    }
    .left-sidebar-main .card .page-title {
        display: flex;
        align-items: center;    
    }
    .left-sidebar-main .card .page-title svg {
        margin-right: 0px !;
    }
    .form-group-icon {
        position: relative;
    }
    .form-group-icon i {
        position: absolute;
        left: 10px;
        top: 16px;
        color: #222222;
    }
    .form-group-icon input {
        padding: 15px 35px;
    }
    .btn-primary.text-link {
        padding: 6px 8px;
        background: none;
        color: #45a73c; 
    }
    .btn-primary.text-link:hover {
        background-color: #45a73c;
        color: #fff;
    }
    .table-custom table th,
    .table-custom table td {
        border: none;
    }
    .table-custom table {
        border: none;
    }
    .table-custom table td a i {
        color: #45a73c;
        padding-left: 0px;
    }
    .table-custom table td.d-flex {
        padding-top: 23px;
    }
    .table-custom table td a {
        padding-left: 11px;
    }
    .table-hover tbody tr:hover, .table-striped tbody tr:nth-of-type(odd), .thead-default th {
        background-color: #fff;
    }
    .upload input[type=file]:before {
        width: 100%;
        height: 60px;
        font-size: 16px;
        line-height: 32px;
        content: 'Import Existing Estimate';
        display: inline-block;
        background: #45a73c;
        padding: 5px 10px;
        text-align: center;
        color: #fff;
        border-radius: 0px;
    }
    .upload.workorder input[type=file]:before {
        content: 'Import Workorder';
    }
    .upload.invoice input[type=file]:before {
        content: 'Import Invoice';
    }
    .upload input[type=file] {
        cursor: pointer;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }
    .card-body .edit-icon {
        position: absolute;
        right: 20px;
        top: 25px;
    }
    .card-body .edit-icon button{
        padding: 0px;
        border: none;
        background: none;
    }
    .label-width label {
        width: 125px;
    }
    #new_customer .modal-lg {
        max-width: 100%;
    }
    .contact-info h3{
        color: rgba(0, 0, 0, 0.87);
        font-size: 16px;
        font-weight: 500;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        line-height: 1.5em;
        display: flex;
        align-items: center;
    } 
    .contact-info svg {
        margin-right:15px;
    }
    .address-proof {
        width: 100%;
    }
    .address-proof iframe {
        width:100%;
        max-height: 250px;
    }
    .modal-footer-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: block;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
    width: 100%;
}
.card-header .btn:after {
    content: '-';
    font-size: 50px;
    color: green;
    position: absolute;
    top: -5px;
    right: 18px;
}

.card-header .btn.collapsed:after {
    content: '+';
    font-size: 34px;
    color: green;
    position: absolute;
    top: 7px;
    /* left: 0px; */
    right: 20px;
}
.card-header .btn, .card-header .btn:hover, .card-header .btn:focus, .card-header .btn.focus {
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #e5e5e5;
    box-shadow: none;
    padding: 0px;
    width: 100%;
}
.card-header {
    border: none;
    padding: 0px;
    background: none;
}
.accordion .card-body {
    padding-left: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
}
.accordion .card-body .form-group {
    margin-bottom: 0px !important;
}
.accordion .card-body {
    padding-bottom: 16px;
}
.left-sidebar-main .accordion .card {
    border: none !important;
}
.left-sidebar-main .card .accordion .page-title {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #e9ecef !important;
    margin: 0px;
    padding: 10px 0px;
}
.label-width .form-control {
    width: 42%;
}
.left-sidebar-main .card.table-custom .modal {
    padding-right: 0px !important;
}
.block-btn-main .btn-full {
    padding: 12px 8px;
}
.block-btn-main .btn-full .btn {
    width: 100%;
}

.file-upload-drag {
    display: block;
    position: relative;
    width: 60%;
}
.file-upload-drag .drop {
    width: 100%;
    height: 100%;
    border: 4px dashed #45a73c;
    border-spacing: 25px;
    overflow: hidden;
    text-align: center;
    -webkit-transition: all 0.5s ease-out;
    -moz-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
    -ms-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    margin: auto;
    /* position: absolute; */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: table;
    text-align: center;
    border-radius: 24px;
    -webkit-border-radius: 24px;
    -moz-border-radius: 24px;
    -ms-border-radius: 24px;
    -o-border-radius: 24px;
    color: #000;
}
.file-upload-drag .drop .cont {
    width: 100%;
    height: 100px;
    color: #fff;
    -webkit-transition: all 0.5s ease-out;
    -moz-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
    margin: auto;
    /* position: absolute; */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
.file-upload-drag .drop .cont p {
    font-size: 20px;
    line-height: 20px;
    margin: 15px 0px;
    color: #000;
    font-weight: bold;
}
.file-upload-drag .drop input[type=file] {
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: transparent;
    opacity: 0;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
.file-upload-drag .drop .cont p.or-text {
    color: #e0e0e0;
    font-size: 16px;
}
.color-box-custom {
    padding: 20px 0px;
}
.color-box-custom ul {
    margin: 0px;
    padding: 0px;
    list-style: none;
}
.color-box-custom ul li {
    display: inline-block;
}
.color-box-custom ul li span {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #000;
    display: block;
}
.color-box-custom ul li span.bg-1 {
    background-color: #4baf51;
}
.color-box-custom ul li span.bg-2 {
    background-color: #d86566;
}
.color-box-custom ul li span.bg-3 {
    background-color: #e57399;
}
.color-box-custom ul li span.bg-4 {
    background-color: #b273b3;
}
.color-box-custom ul li span.bg-5 {
    background-color: #8b63d7;
}
.color-box-custom ul li span.bg-6 {
    background-color: #678cda;
}
.color-box-custom ul li span.bg-7 {
    background-color: #59bdb3;
}
.color-box-custom ul li span.bg-8 {
    background-color: #64ae89;
}
.color-box-custom ul li span.bg-9 {
    background-color: #f1a740;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border left-sidebar-main">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;position: relative; top: 1.4px;"><path d="M9 11.75c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zm6 0c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.05-.86 2.36-1.05 4.23-2.98 5.21-5.37C11.07 8.33 14.05 10 17.42 10c.78 0 1.53-.09 2.25-.26.21.71.33 1.47.33 2.26 0 4.41-3.59 8-8 8z"></path></svg> &nbsp;Customer</h6>
                            <hr>
                            <div class="form-group form-group-icon">
                               <input type="text" name="search" id="search" class="form-control" placeholder="Name, email, phone, or address">
                               <i class="fa fa-search"></i>
                            </div>

                            <button type="button" class="btn btn-primary pull-right text-link" data-toggle="modal" data-target="#new_customer">+ New Customer</button>
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path></svg>  &nbsp; &nbsp;Schedule Job</h6>
                            <div class="edit-icon">
                            <button class="MuiButtonBase-root MuiIconButton-root" tabindex="0" type="button"><span class="MuiIconButton-label"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path></svg></span><span class="MuiTouchRipple-root"></span></button>
                            </div>
                            <hr>
                            <div class="form-group label-width d-flex align-items-center">
                               <label>From</label>
                               <input type="date" class="form-control mr-2">
                               <select id="inputState" class="form-control">
                                <option selected="">Start time</option>
                                <option>...</option>
                              </select>
                            </div>
                            <div class="form-group label-width d-flex align-items-center">
                               <label >To</label>
                               <input type="date" class="form-control mr-2">
                               <select id="inputState" class="form-control">
                                <option selected="">End time</option>
                                <option>...</option>
</select>
                            </div>
                            <select id="inputState" class="form-control">
                                <option selected="">Assign Employee</option>
                                <option>...</option>
                              </select>

                              <div class="color-box-custom">
                                  <h4>Event Color on Calendar</h4>
                                  <ul>
                                      <li>
                                        <span class="color-scheme bg-1"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-2"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-3"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-4"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-5"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-6"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-7"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-8"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-9"></span>
                                      </li>
                                  </ul>
                               </div>
                               <h4>Customer Reminder Notification</h4>
                               <select id="inputState" class="form-control">
                                <option selected="">1 day free</option>
                                <option>...</option>
                              </select>
                              <h4>Timezon</h4>
                               <select id="inputState" class="form-control">
                                <option selected="">Central Time (UTC -5)</option>
                                <option>...</option>
                              </select>
                            <button type="button" class="btn btn-primary pull-right text-link">+ Assign to</button>
                        </div>
                        
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Private notes</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;">
                                                <g>
                                                    <path d="M6.535,10.29l6.585,6.683c0.289,0.294,0.723,0.294,1.013,0l1.663-1.689c0.362-0.294,0.362-0.806,0.072-1.028l-6.584-6.68 c0.651-1.689,0.29-3.671-1.085-5.066C6.752,1.042,4.582,0.748,2.844,1.555l3.112,3.157l-2.17,2.203L0.601,3.758 c-0.868,1.762-0.507,3.963,0.94,5.432C2.917,10.584,4.87,10.953,6.535,10.29z"></path>
                                                    <path d="M21.708,12.354c-0.926-3.883-4.409-6.774-8.576-6.774c-0.538,0-1.06,0.062-1.571,0.154l0.518,2.057 c0.344-0.055,0.693-0.093,1.053-0.093c2.988,0,5.519,1.956,6.386,4.655H17.12l3.404,3.724l3.404-3.724H21.708z"></path>
                                                    <path d="M13.132,21.115c-3.126,0-5.746-2.144-6.49-5.038h2.232L5.47,12.354l-3.404,3.723h2.403 c0.782,4.075,4.361,7.156,8.664,7.156c2.982,0,5.615-1.482,7.212-3.749l-1.784-1.177C17.345,20.001,15.375,21.115,13.132,21.115z"></path>
                                                </g>
                                            </svg>  &nbsp; &nbsp;Services Box</h6>
                                            </button>
                                        </h2>
                                        </div>

                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Private notes</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Private notes</h6>
                                            </button>
                                        </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Job Tags</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Job Tags</h6>
                                        </button>
                                    </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><circle cx="12" cy="12" r="3.2"></circle><path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"></path></svg>  &nbsp; &nbsp;Photos / attachments</h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Url link</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Url link</h6>
                                        </button>
                                    </h2>
                                    </div>

                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                    <div class="form-group">
                                                            <input type="text" class="form-control">
                                                            </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="prev-btn float-right">
                       <button type="button" class="btn btn-primary">Preview</button>
                    </div> -->

                </div>
                <div class="col-md-7">
                    <div class="card table-custom">
                        <div class="card-body">
                            <h6 class="page-title">&nbsp;Add line items</h6>
                            <hr>
                            <table class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th>Services</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td><svg class="MuiSvgIcon-root jss72" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M20 9H4v2h16V9zM4 15h16v-2H4v2z"></path></svg></td>
                                       <td>
                                          <input type="text" name="check_description[]" class="form-control checkDescription" placeholder="Item name">
                                       </td>
                                       <td><input type="text" name="check_description[]" class="form-control checkDescription" placeholder="Qty"></td>
                                       <td><input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0" placeholder="Unit Price"></td>
                                       <td style="text-align: center" class="d-flex">$00<a href="#" class="remove-check-row"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                    </tr>
                                    </tr>
                                        <tr>
                                        <td class="upload" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload workorder" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload invoice" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="5">
                                           <button type="button" class="btn btn-primary">Import +</button>
                                        </td>
                                    </tr>
                                    
                                 </tbody>
                             </table>
                             <div class="file-upload-drag">
                               <div class="drop">
                                    <div class="cont">
                                        <div class="tit">
                                            <p>Thumbnail</p>
                                            <p class="or-text">Or</p>
                                            <p>PDF</p>
                                            <p class="or-text">Or</p>
                                            <p>URL Link</p>
                                            <p>To see import source</p>
                                            <!-- <p class="or-text">Or</p>
                                            <label>Choose File</label> -->
                                        </div>
                                    </div>
                                    <input id="filetoupload" name="filetoupload" type="file" />
                                    <!-- <img id="dis_image" style="display:none;" src="#" alt="your image" /> -->
                                </div>
                             </div>
                            <div class="prev-btn mt-4">
                                <button type="button" class="btn btn-primary">Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<!-- Modal -->
<div class="modal fade" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newcustomerLabel">Add new customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contact-info">
            <h3 class="c13 c20"><svg class="MuiSvgIcon-root-362 jss355" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M9 11.75c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zm6 0c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.05-.86 2.36-1.05 4.23-2.98 5.21-5.37C11.07 8.33 14.05 10 17.42 10c.78 0 1.53-.09 2.25-.26.21.71.33 1.47.33 2.26 0 4.41-3.59 8-8 8z"></path></svg>Contact info</h3>
            <div class="row">
                <form>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                 
                                    <input type="text" class="form-control"  placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Mobile Phone">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Display name(shown on invices)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Home Phone">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="email" class="form-control"  placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Work Phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Company">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Job Title">
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                          <label class="form-check-label" for="exampleRadios1">
                            Homeowner
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                          <label class="form-check-label" for="exampleRadios2">
                            Business
                          </label>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
        <div class="contact-info">
            <h3 class="c13 c20"><svg class="MuiSvgIcon-root-362 jss355" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>Address</h3>
            <div class="row">
                <form>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Street">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <select id="inputState" class="form-control">
                                <option selected>State</option>
                                <option>...</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Zip">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Address Note">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary pull-left text-link">+ Address</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="address-proof">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d389100.8208036594!2d-73.13514834535813!3d40.3678466330292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1611070455636!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
        <div class="contact-info">
            <h3 class="c13 c20"><svg class="MuiSvgIcon-root-362 jss355" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>Notes</h3>
            <div class="row">
                <form>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Customer notes">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="This customer bills to">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Customer tags (press enter)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Lead Source" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer modal-footer-detail">
        <div class="checkbox-modal">
            <input type="checkbox" id="receive" name="receive" value="receive">
            <label for="receive"> Receive notifications</label><br>
        </div>
        <div class="button-modal-list">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include viewPath('includes/footer'); ?>
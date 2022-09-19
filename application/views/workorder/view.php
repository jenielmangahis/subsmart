<?php 
    include viewPath('v2/includes/header'); 
    add_css(array(
        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        //'assets/frontend/css/workorder/main.css',
        // 'assets/css/beforeafter.css',
    ));
?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>
<style>
/* common */
.ribbon {
  width: 120px;
  height: 120px;
  overflow: hidden;
  position: absolute;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid #2980b9;
}
.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 15px 0;
  background-color: #3498db;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font: 700 18px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
  text-transform: uppercase;
  text-align: center;
}

/* top left*/
.ribbon-top-left {
  top: -10px;
  left: -2px;
}
.ribbon-top-left::before,
.ribbon-top-left::after {
  border-top-color: transparent;
  border-left-color: transparent;
}
.ribbon-top-left::before {
  top: 0;
  right: 0;
}
.ribbon-top-left::after {
  bottom: 0;
  left: 0;
}
.ribbon-top-left span {
  right: -40px;
  top: 20px;
  transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
  top: -10px;
  right: -10px;
}
.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent;
}
.ribbon-top-right::before {
  top: 0;
  left: 0;
}
.ribbon-top-right::after {
  bottom: 0;
  right: 0;
}
.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
  bottom: -10px;
  left: -10px;
}
.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
  border-bottom-color: transparent;
  border-left-color: transparent;
}
.ribbon-bottom-left::before {
  bottom: 0;
  right: 0;
}
.ribbon-bottom-left::after {
  top: 0;
  left: 0;
}
.ribbon-bottom-left span {
  right: -25px;
  bottom: 30px;
  transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
  bottom: -10px;
  right: -10px;
}
.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
  border-bottom-color: transparent;
  border-right-color: transparent;
}
.ribbon-bottom-right::before {
  bottom: 0;
  left: 0;
}
.ribbon-bottom-right::after {
  top: 0;
  right: 0;
}
.ribbon-bottom-right span {
  left: -25px;
  bottom: 30px;
  transform: rotate(-225deg);
}

#signature-pad {min-height:200px;}
#signature-pad canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2 {min-height:200px;}
#signature-pad2 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3 {min-height:200px;}
#signature-pad3 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-padM {min-height:200px;}
#signature-padM canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2M {min-height:200px;}
#signature-pad2M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3M {min-height:200px;}
#signature-pad3M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #10ab06;
}

input:focus + .slider {
  box-shadow: 0 0 1px #10ab06;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.tr_qty{
    width:150px;
}


nav > .nav.nav-tabs{

border: none;
  color:#fff;
  background:#272e38;
  border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
border: none;
  padding: 18px 25px;
  color:#fff;
  background:#272e38;
  border-radius:0;
}

/* nav > div a.nav-item.nav-link.active:after
{
content: "";
position: relative;
bottom: -60px;
left: -10%;
border: 15px solid transparent;
border-top-color: #e74c3c ;
} */
.tab-content{
background: #fdfdfd;
  line-height: 25px;
  border: 1px solid #ddd;
  border-top:5px solid #e74c3c;
  border-bottom:5px solid #e74c3c;
  padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
border: none;
  background: #e74c3c;
  color:#fff;
  border-radius:0;
  transition:background 0.20s linear;
}

.signature_mobile
{
    display: none;
}

.show_mobile_view
{
    display: none;
}

@media only screen and (max-device-width: 600px) {
    .label-element{
        position:absolute;
        top:-8px;
        left:25px;
        font-size:12px;
        color:#666;
        }
    .input-element{
        padding:30px 5px 10px 8px;
        width:100%;
        height:55px;
        /* border:1px solid #CCC; */
        font-weight: bold;
        margin-top: -15px;
        }

    .select-wrap 
    {
    border: 2px solid #e0e0e0;
    /* border-radius: 4px; */
    margin-top: -10px;
    /* margin-bottom: 10px; */
    padding: 0 5px 5px;
    width:100%;
    /* background-color:#ebebeb; */
    }

    .select-wrap label
    {
    font-size:10px;
    text-transform: uppercase;
    color: #777;
    padding: 2px 8px 0;
    }

    .m_select
    {
    /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }
    .select2 .select2-container .select2-container--default{
        /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #fff !important;
    border-radius: 4px;
    }

    .sub_label{
        font-size:12px !important;
    }

    .signature_web
    {
        display: none;
    }

    .signature_mobile
    {
        display: block;
    }

    .hidden_mobile_view{
        display: none;
    }

    .show_mobile_view
    {
        display: block;
    }

    .table_mobile
    {
        font-size:14px;
    }

    div.dropdown-wrapper select { 
    width:115% /* This hides the arrow icon */; 
    background-color:transparent /* This hides the background */; 
    background-image:none; 
    -webkit-appearance: none /* Webkit Fix */; 
    border:none; 
    box-shadow:none; 
    padding:0.3em 0.5em; 
    font-size:13px;
    }
    .signature-pad-canvas-wrapper {
    margin: 15px 0 0;
    border: 1px solid #cbcbcb;
    border-radius: 3px;
    overflow: hidden;
    position: relative;
}

    .signature-pad-canvas-wrapper::after {
        content: 'Name';
        border-top: 1px solid #cbcbcb;
        color: #cbcbcb;
        width: 100%;
        margin: 0 15px;
        display: inline-flex;
        position: absolute;
        bottom: 10px;
        font-size: 13px;
        z-index: -1;
    }

	.mobile_size
	{
		font-size:14px !important;
		margin-left:50% !important;
	}

	.mobile_div
	{
		margin-left:0px !important;
	}

	.map_area_mobile
	{
		width:400px !important;
	}

	/* .mobile_btn a
	{
		width:100px !important;
		height:20px !important;
	} */

	.user-menu
	{
		margin-right:0px !important;
	}

	.mobile_header
	{
		margin:5% !important;
	}
}

.multipleInput-container {
     border:1px #999 solid;
     padding:1px;
     padding-bottom:0;
     cursor:text;
     font-size:15px;
     width:100%;
	border-radius: 6px
}
 
.multipleInput-container input {
    font-size:15px;
    clear:both;
    height:60px;
    border:0;
    margin-bottom:1px;
}
 
.multipleInput-container ul {
    list-style-type:none;
}
 
li.multipleInput-email {
    float:left;
    padding:6px ;
    color: #fff;
	background: #FD9160;
	margin-top: 0;
	border-radius: 6px;
	margin: 6px 2px 6px 6px;
}
 
.multipleInput-close {
    width:16px;
    height:16px;
    display:block;
    float:right;
    margin: -2px 0px 0px 8px;
	color: #fff;
	font-size: 16px;
}
.box-left-mini{
    /* float:left; */
    background-image:url(website-content/hotcampaign.png);
    /* width:292px; */
    /* height:141px; */
}

.box-left-mini .front {
    display: block;
    z-index: 5;
    position: relative;
}
.box-left-mini .front span {
    background: #fff
}

.box-left-mini .behind_container {
    background-color: #ff0;
    position: relative;
    top: -18px;
}
.box-left-mini .behind {
    display: block;
    z-index: 3;
}
img.company-logo2 {
    width: 170px;
    /* height: 70px; */
    object-fit: contain;
    margin: 0 auto;
    margin-top: 8px;
}

.dwn:hover {
  background-color: #76D3DB;
  text-decoration: underline;
}

#chartdiv {
  width: 100%;
  height: 400px;
}

.SolarLogo
 {
	display : none;
 }
 
 .standardLogo
 {
	display : block !important;
 }
 
 .notIncluded
 {
	display : block !important;
 }

/* @media print {
 
 body
 {
	 font-size:9px;
	 margin:0px;
 }
 
 .SolarLogo
 {
	display : block;
 }

 .notIncluded
 {
	display : none !important;
 }
 .notIncluded span
 {
	display : none !important;
 }
 .standardLogo
 {
	display : none !important;
 }
 
 } */
 /* #chartdiv {
  width: 100%;
  height: 400px;
} */
input:focus {
    background-color: #ffa;
}
/* .table-responsive {
    display: table;
} */
table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:14px;
}
/* 
table input[type=checkbox] {
    width: 100%;
} */

.itemTable{
    width:100%;
}

#eye {
  position:absolute;
  right:80%;
  top:6.5%;
}

table input.form-control {
   height:25px !important;
}

.input-group-text
{
    padding:3px !important;
}
.itemTable td:nth-of-type(1) {width:30%;}
.itemTable  td:nth-of-type(2) {width: 15%;}
.itemTable  td:nth-of-type(3) {width:15%;}
.itemTable  td:nth-of-type(4) {width:20%;}

.itemTable2 td:nth-of-type(1) {max-width:80px;}
.itemTable2  td:nth-of-type(2) {
    white-space:nowrap;
   /* border: 1px solid black; */
   max-width: 100px;
   overflow-y:hidden;
}
/* .itemTable2  td:nth-of-type(3) {width:25%;} */
.itemTable2  td:nth-of-type(4) {width:15%;}

@media screen and (max-width:500px){
    body{
        /* color:white; */
        font-size:10px !important;
    }  
    table thead
    {
        font-size:12px;
    }
    /* .summary_total
    {
        font-size: 10px !important;
    }
    .summary_total h4 input span
    {
        font-size: 10px !important;
    } */
    /* .equipment_cost
    {
        font-size: 14px !important;
    } */
    .itemTable span
    {
        font-size:10px;
    }
    .itemTable td
    {
        padding:0;
    }
    .itemTable input[type=text]
    {
        height:100% !important;
    }
}

@media screen and (max-width:1400px){
    table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:10px;
    }
    /* table input[type=checkbox] {
        width: 80%;
    } */
    table thead
    {
        font-size:14px;
    }
    .withCheck
    {
        width:100% !important;
    }
}

.item {
  width: 100px;
  border: 1px solid #000;
  height: 20px;
  flex: 80px 1;
  text-align: center;
  color: #000;
}
::-webkit-scrollbar
{
  height: 6px;
  background-color: green;
  overflow-x: auto;
}

/* .summaryTanan table, td, th {
  border: 1px solid;
  padding:1%;
} */
.summaryTanan table {
  width:60%;
}

.summaryTanan table {
  width: 100%;
  border-collapse: collapse;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
</div>

	 

 
<!-- <div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
  <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
          <span class="mdc-bottom-navigation__list-item__text">Recents</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
          <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
            </svg>
          </span>
          <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
        </span>
      </nav>
    </div> 
</div> -->

<!-- MODAL CLONE WORKORDER -->
<div class="modal fade" id="modalCloneWorkorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Clone Work Order</h4>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            You are going create a new work order based on <b>Work Order #<span
                                        class="work_order_no"></span> <input type="hidden" id="wo_id" name="wo_id"> </b>.<br>
                            Afterwards you can edit the newly created work order.
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button id="clone_workorder" class="btn btn-primary" type="button" data-clone-modal="submit">Clone
                        Work Order
                    </button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="sharePreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share This Link</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="sharePreviewAgree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share This Link</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view_agreement/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="sharePreviewSolar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share This Link</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view_solar/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	
	
	<div class="modal fade" id="shareLinkToEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share link to email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo form_open_multipart('workorder/sendLinkToEmail', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                        <div class="validation-error" style="display: none;"></div>
                        <p>
							<b>To</b><br>
                            <input type="email" class="form-control" name="emails_list" id="my_input" >
							<input type="hidden" class="form-control" name="" id="my_input_hidden" value="<?php echo $workorder->email ?>" >
							<inpupt type="hidden" name="email_list[]" class="email_list" value="<?php echo $workorder->email ?>"><br><br>
							
							<b>Content</b>
							<textarea name="email_content" id="email_content_share" style="height:1000px;">

							<p dir="rtl" style="text-align:center">
								<!-- <span style="color:#ffffff"><span style="font-size:30px"><span style="background-color:#9b59b6">&nbsp; <?php //echo $company->business_name ?> &nbsp;&nbsp;</span></span></span> -->
								<img src="<?= getCompanyBusinessProfileImage(); ?>"  style="width:100px;height:100px;" />
							</p>
							
							
							<p>W O R K O R D E R # &nbsp;<?php echo $workorder->work_order_number ?>&nbsp; F R O M &nbsp; <?php echo $company->business_name ?></p>
							<br />

							<p>DEAR <?php echo $customer->contact_name .''. $customer->first_name ?>,<br /><br />
							THANK YOU FOR CHOOSING <?php echo $company->business_name ?>! <br />
							YOUR WORKORDER# <?php echo $workorder->work_order_number ?> IS ATTACHED. &nbsp; THE WORK ORDER CAN BE FOUND IN THE ATTACHED PDF FILE.<br /><br />

							CLICK THE LINK TO VIEW THE WORK ORDER ONLINE. <br>
							<a href="<?php echo base_url('share_Link/public_view_solar/'.$workorder->id) ?>"><?php echo base_url('share_Link/public_view/'.$workorder->id) ?></a><br /><br />

							REGARDS,<br /><br />
							<?php echo $company->business_name ?><br /><br /><br /><br />

							<p style="text-align:center">Powered by nSmarTrac</p>

							</textarea>

							<div id="testArea"></div>
							<br>
							<center><input type="submit" value="Send Email" class="btn btn-success"></center>
                        </p>
					<?php echo form_close(); ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="docusignTemplateModal" tabindex="-1" role="dialog" aria-labelledby="docusignTemplateModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="docusignTemplateModalLabel">Select Template</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<table id="templatesTable" class="table" style="width: 100%;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		</div>
		</div>
	</div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initialize&libraries=&v=weekly"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&libraries=places"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=myMap"></script> -->
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script>
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("googleMap"), {
	center: { lat: -34.397, lng: 150.644 },
	zoom: 8,
  });
}
</script>

<script>
    CKEDITOR.replace('email_content_share');
</script>

<script>
function myCopyFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
//   alert("Copied the text: " + copyText.value);
}
</script>

<script>
	$(function() {
		
	var acctType  = $(".account_typeClass").val();

		if (acctType == 'Commercial')
		{
			$('.commercialDet').show();
		}else
		{
			$('.commercialDet').hide();
		}
	});
</script>
<script>
(function( $ ){
 
 $.fn.multipleInput = function() {

	  return this.each(function() {

		   // create html elements

		   // list of email addresses as unordered list
		   $list = $('#testArea');
		   var valueEmail = $('#my_input_hidden').val();

		   // input
		   var $input = $('<input type="text" value="'+ valueEmail +'"/>').keyup(function(event) {

				if(event.which == 32 || event.which == 188) {
					 // key press is space or comma
					var val = $(this).val().slice(0, -1); // remove space/comma from value

					 // append to list of emails with remove button
					 $list.append($('<li class="multipleInput-email"><span> ' + val + '</span><inpupt type="text" name="email_list[]" class="email_list" value="'+ val +'"></li>')
						  .append($('<a href="#" class="multipleInput-close" title="Remove">x</a>')
							   .click(function(e) {
									$(this).parent().remove();
									e.preventDefault();
							   })
						  )
					 );
					 $(this).attr('placeholder', '');
					 // empty input
					 $(this).val('');
				}

		   });

		   // container div
		   var $container = $('<div class="multipleInput-container" />').click(function() {
				$input.focus();
		   });

		   // insert elements into DOM
		   $container.append($list).append($input).insertAfter($(this));

		   // add onsubmit handler to parent form to copy emails into original input as csv before submitting
		   var $orig = $(this);
		   $(this).closest('form').submit(function(e) {

				var emails = new Array();
				$('.multipleInput-email span').each(function() {
					 emails.push($(this).html());
				});
				emails.push($input.val());

				$orig.val(emails.join());

		   });

		   return $(this).hide();

	  });

 };
})( jQuery );

$('#my_input').multipleInput();
</script>

<script>
// $(document).on('click','.testAlert',function(){
// 	var test = $('.email_list').val();
// 	// alert('test'  +  test);
// 	var email_list = $('input[name="email_list[]"]').map(function(){ 
//                     return this.value; 
//                 }).get();

// 	// var users = $(this).find('.email_list').map(function(i, el) {
// 	// 	return el.value;
// 	// });
// 	var users = $("input[name='email_list[]']").map(function(){return $(this).val();}).get();
		
// 		console.log(test);

//                 // $.ajax({
//                 //     type: 'POST',
//                 //     url: 'users.php',
//                 //     data: {
//                 //         'email_list[]': email_list,
//                 //         // other data
//                 //     },
//                 //     success: function() {

//                 //     }
//                 // });

// });
</script>

<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
	
	$(".phoneFormat").text(function(i, text) {
        text = text.replace(/(\d{3})(\d{3})(\d{4})/, "$1.$2.$3");
        return text;
    });
	
	$(".phoneFormat2").text(function(i, text) {
        text = text.replace(/(\d{3})(\d{3})(\d{4})/, "$1.$2.$3");
        return text;
    });

    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageItemsById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
						markup = "<tr>" +
                                "<td></td>"+
								"<td></td>"+
                                "<td>Item Name</td>"+
                                "<td>Quantity</td>"+
                                "<td>Price</td>"+
                            "</tr>";
                        tableBody = $("#packageItemsTitle");
                        tableBody.append(markup);

                $.each(response['pItems'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<tr>" +
                                "<td></td>"+
								"<td></td>"+
                                "<td>"+ v.title +"</td>"+
                                "<td>"+ v.quantity +"</td>"+
                                "<td>"+ v.price +"</td>"+
                            "</tr>";
                        tableBody2 = $("#packageItems"+v.package_id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });

	
	// var changed = $("#view_ssn").text();
});
</script>

<script>
var ssn = $("#view_ssn").html();
// var ssn = "123-45-6789";
//     vis = mainStr.slice(-4),
//     countNum = '';

// for(var i = (mainStr.length)-4; i>0; i--){
//     countNum += 'X';
// }
var output = ssn.replace(/\d(?=.{5,})/g, "X");
$("#view_ssn").text(output);
</script>

<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
                $.each(response['pName'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<b>"+ v.pname +
                            "</b>";
                        tableBody2 = $("#PaName_"+v.id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });
});
</script>

<script>


// $(document).ready(function()
// {
// 	var changed = $("#view_ssn").text();
// 	// alert(ssn);
// 	changed.value = new Array(account.value.length-3).join('x') + account.value.substr(account.value.length-4, 4);
// });

</script>

<script>
$(document).on('click touchstart','.send_to_customer',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToAcs",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
// else 
// {
// 	alert('no');
// }

});
</script>
<script>
$(document).on('click touchstart','.send_to_company',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Company?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToCompany",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
// else 
// {
// 	alert('no');
// }

});
</script>

<script>
$(document).on('click touchstart','.send_to_customer_alarm',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToAcsAlarm",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
else 
{
	alert('no');
}

});
</script>

<script>
$(document).on('click touchstart','.download_work_order_pdf',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/work_order_pdf",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
else 
{
	alert('no');
}

});
</script>

<script>
$(document).on('click touchstart','.clone-workorder',function(){

var num = $(this).attr('data-wo_num');
var id = $(this).attr('data-id');
// alert(id);
$('.work_order_no').text(num)
$('#wo_id').val(id)


});

$(document).on('click touchstart','#clone_workorder',function(){

// var num = $(this).attr('data-wo_num');
// var wo_num = $('.work_order_no').text();
var wo_num = $('#wo_id').val();
// alert(id);
// $('.work_order_no').text(num);
$.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>workorder/duplicate_workorder",
    data : {wo_num: wo_num},
    success: function(result){
        sucess("Data Cloned Successfully!");
    },
    });


});

function sucess(information,$id){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        }
</script>

<script>
// $(document).on('click','#delete_workorder',function(){
//     // alert('test');
    
// });

// function myFunction() {
// $('#delete_workorder').on('click', function(){
$(document).on('click touchstart','#delete_workorder',function(){

    var id = $(this).attr('work-id');
    // alert(id);
  
  var r = confirm("Are you sure you want to delete this Work Order?");

  if (r == true) {
    $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>workorder/delete_workorder",
    data : {id: id},
    success: function(result){
        // $('#res').html('Signature Uploaded successfully');
        // if (confirm('Some message')) {
        //     alert('Thanks for confirming');
        // } else {
        //     alert('Why did you press cancel? You should have confirmed');
        // }

        // location.reload();
        sucess("Data Deleted Successfully!");
		var url = "<?php echo base_url(); ?>workorder";
		window.location = url; 
    },
    });
  } 
  else 
  {
    alert('no');
  }

});

function sucess(information,$id){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        }
</script>

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

<!-- Resources -->
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>

function primaryName(){
     // $('.invAetf').keyup(function(e){
      // alert('kk');
      var one = $('#firstname').val();
      var two = $('#lastname').val();
      $('#primary_account_holder_name').val(one +' '+ two);
  }
/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */


am4core.useTheme(am4themes_animated);

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingTop = 40;
// Add data
chart.data = [{
  "category": "J",
  "value": 1240
}, {
  "category": "F",
  "value": 1000
}, {
  "category": "M",
  "value": 450
}, {
  "category": "A",
  "value": 700
}, {
  "category": "M",
  "value": 800
}, {
  "category": "J",
  "value": 800
}, {
  "category": "J",
  "value": 780
}, {
  "category": "A",
  "value": 500
}, {
  "category": "S",
  "value": 100
}, {
  "category": "O",
  "value": 1000
}, {
  "category": "N",
  "value": 900
}, {
  "category": "D",
  "value": 620
}
];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

function createValueAxis(title, showgrid) {
  
  // Create axis
  var axis = chart.yAxes.push(new am4charts.ValueAxis());
  axis.renderer.grid.template.disabled = !showgrid;
    
  // Set up axis title
  axis.title.text = title;
  
  return axis;
}

function createSeries(key, title, axis) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueY = key;
  series.dataFields.categoryX = "category";
  series.yAxis = axis;
  return series;
}

createSeries(
  "value",
  "Series #1",
  createValueAxis("KWH", true)
);

// createSeries(
//   "value2",
//   "Series #2",
//   createValueAxis("Funding", false)
// );
</script>
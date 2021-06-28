<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
        /* body
        {
            margin:5px;
        } */
table {
 border-collapse: collapse;
}

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
        margin-bottom:10px;
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

    .mobile_view
    {
        font-size:12px;
    }

    .sigWrapper
    {
        overflow: hidden; 
    }

    .mobile_view_table
    {
        min-width: 350px !important;
        margin-left: -20px !important;
    }

    .add_mobile
    {
        margin-left: -22px !important;
    }

    .mobile_qty
    {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 0px 0px 0px 0px !important;
        text-align: center;
    }


.tabs { list-style: none; }
.tabs li { display: inline; }
.tabs li a 
{ 
    color: black; 
    float: left; 
    display: block; 
    /* padding: 4px 10px;  */
    /* margin-left: -1px;  */
    position: relative; 
    /* left: 1px;  */
    background: #a2a5a3; 
    text-decoration: none; 
}
.tabs li a:hover 
{ 
    background: #ccc; 
}
.group:after 
{ 
    visibility: hidden; 
    display: block; 
    font-size: 0; 
    content: " "; 
    clear: both; 
    height: 0; 
}

.box-wrap 
{ 
    position: relative; 
    min-height: 250px; 
}
.tabbed-area div div 
{ 
    background: white; 
    padding: 20px; 
    min-height: 250px; 
    position: absolute; 
    top: -1px; 
    left: 0; 
    width: 100%; 
}

.tabbed-area div div, .tabs li a 
{ 
    border: 1px solid #ccc; 
}

#box-one:target, #box-two:target, #box-three:target {
  z-index: 1;
}

.group li.active a,
.group li a:hover,
.group li.active a:focus,
.group li.active a:hover{
  background-color: #52cc6e;
  color: black; 
}
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:1%;">
    
        <div style="padding: 2%;">
        <img src="<?php echo base_url('uploads/users/business_profile/'.$company_id.'/'.$business_logo); ?>" style="width:110px;height:80px;">
        </div>

        <div style="margin-top:5%">

        <div class="card">
                      <?php if($estimate){ ?>
                      <div class="d-block">
                        <div class="col-md-12" style="text-align: right;margin-bottom: 60px;">
                          <a class="btn btn-success" href="<?php echo base_url('estimate/send_customer/' . $estimate->id) ?>"><span class="fa fa-envelope-open-o icon"></span> SEND TO CUSTOMER</a>
                          <a class="btn btn-info" href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span class="fa fa-pencil icon"></span> EDIT</a>
                          <a class="btn btn-info" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>"><span class="fa fa-file-pdf-o icon"></span> PDF</a>
                          <a class="btn btn-info" href="<?php echo base_url('estimate/') ?>">BACK TO ESTIMATE LIST</a>
                        </div>
                        <div class="col-xl-5 left" style="margin-bottom: 33px;">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> From <span class="invoice-txt"> <?= $client->business_name; ?></span></h5>
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $client->business_address; ?></span><br />
                            <span class="">EMAIL: <?= $client->email_address; ?></span><br />
                            <span class="">PHONE: <?= $client->phone_number; ?></span>
                          </div>
                        </div>
                        <div class="col-xl-5 right" style="float: right">
                          <div style="text-align: right;">
                            <h5 style="font-size:30px;margin:0px;">ESTIMATE</h5>
                            <small style="font-size: 14px;">#<?= $estimate->estimate_number; ?></small>
                          </div>
                          <div class="" style="text-align: right;margin-top: 20px;">
                            <table style="width: 100%;text-align: right;">
                              <tr>
                                <td style="text-align: right;width: 70%;">Estimate Date :</td>
                                <td><?= date("F d, Y",strtotime($estimate->estimate_date)); ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: right;width: 70%;">Expiry Date :</td>
                                <td><?= date("F d, Y",strtotime($estimate->expiry_date)); ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="clear"></div>
                        <div class="col-xl-5 left">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> To <span class="invoice-txt"> <?= $customer->first_name . ' ' . $customer->last_name; ?></span></h5> 
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $customer->mail_add . " " . $customer->city ?></span><br /><br />
                            <span class="">EMAIL: <span class=""><?= $customer->email; ?></span></span><br />
                            <span class="">PHONE: <span class=""><?= $customer->phone_w; ?></span></span><br />
                          </div>
                        </div>
                        <br class="clear"/>    
                        <table class="table-print table-items" style="width: 100%; border-collapse: collapse;margin-top: 55px;">
                        <thead>
                            <tr>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Items</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Item Type</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Price</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Discount</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- <?php //$estimateItems = unserialize($estimate->estimate_items); ?>
                        <?php //if( $estimateItems ){ ?>
                          <?php //$total_amount = 0; $row = 1; foreach($estimateItems as $item){ ?>
                            <tr class="table-items__tr">
                              <td valign="top" style="width:30px; text-align:center;"><?= $row; ?></td>
                              <td valign="top" style="width:45%;"><?= $item['item']; ?></td>
                              <td valign="top" style="width:20%;"><?= ucwords($item['item_type']); ?></td>
                              <td valign="top" style="width: 50px; text-align: right;"><?= $item['quantity']; ?></td>
                              <td valign="top" style="width: 80px; text-align: right;"><?= number_format($item['discount'],2); ?></td>
                              <td valign="top" style="width: 80px; text-align: right;"><?= number_format($item['price'],2); ?></td>
                            </tr>
                          <?php 
                            // $total_amount += $item['price'];
                            // $row++;
                          ?>
                          <?php //} ?>
                        <?php //} ?> -->
                        <?php foreach($items_data as $itemData){ ?>
                            <tr class="table-items__tr">
                              <td valign="top" style="width:30px; text-align:center;"></td>
                              <td valign="top" style="width:45%;"><?= $itemData->title; ?></td>
                              <td valign="top" style="width:20%;"><?= $itemData->type; ?></td>
                              <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData->iCost,2); ?></td>
                              <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->qty; ?></td>
                              <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->discount; ?></td>
                              <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData->iTotal,2); ?></td>
                            </tr>
                          <?php } ?>
                        
                        <tr><td colspan="6"><hr/></td></tr>
                        <tr>
                          <td colspan="6" style="text-align: right;"><b>Subtotal</b></td>
                          <td style="text-align: right;"><b>$<?= number_format($estimate->sub_total, 2); ?></b></td>
                        </tr>
                        <tr>
                          <td colspan="6" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                          <td style="text-align: right;"><b>$<?= number_format($estimate->grand_total, 2); ?></b></td>
                        </tr>
                      </tbody>
                      </table>
                      </div>

                      <hr />
                      <p><b>Instructions</b><br /><br /><?= $estimate->instructions; ?></p>
                      <p><b>Message</b><br /><br /><?= $estimate->customer_message; ?></p>
                      <p><b>Terms</b><br /><Br /><?= $estimate->terms_conditions; ?></p>

                      <?php }else{ ?>
                        <div class="alert alert-primary" role="alert">
                          Invalid record
                        </div>
                      <?php } ?>

                      <div class="row" style="margin-top: 30px;">
                          <div class="col-md-4 form-group">
                              <a href="<?php echo base_url('estimate') ?>" class="btn btn-primary" aria-expanded="false">
                                <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate List
                              </a>
                          </div>
                      </div>

                  </div>

        </div>

    </div>
</body>
</html>

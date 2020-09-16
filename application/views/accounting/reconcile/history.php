<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
    .hide-toggle::after {
        display: none;
    }
    .show>.btn-primary.dropdown-toggle {
    background-color: #32243D;
    border: 1px solid #32243D;
}
    .p-padding{
        padding-left: 10%;
    }
    .dropdown-menu[x-placement^=top] {
    margin-left: -50px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background: #32243D;
}
.loader
{
    display: none !important;
}
 .line{
width: 1000px;
height: 4px;
border-bottom: 1px solid black;
position: absolute;
}
.dott{
  border:none;
  border-top:1px dotted #000;
  color:#fff;
  background-color:#fff;
  height:1px;
  width:40%;
  margin-top:20px; 
}
.upload-btn-wrapper,.ubw
{
    height: 150px !important;
}
</style>

<!-- Add Custom Tax Sidebar -->
    <div id="overlay-cus-tx" class=""></div>
    <div id="side-menu-cus-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Statement attachments - <div id="pop_name">Cash on hand</div></h4>
            <a id="close-menu-cus-tx" class="menuCloseButton" onclick="closeSideNav3()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        
        <?php echo form_open_multipart('accounting/reconcile/do_upload2/'.$rows[0]->chart_of_accounts_id);?>
        <div class="mainMenu nav">
            <div class="file-upload-block">
                <div class="upload-btn-wrapper">
                    <button class="btn ubw">
                        <i class="fa fa-cloud-upload"></i>
                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                    </button>
                    <input type="file" name="userfile" id="userfile"/>
                </div>
            </div>
        </div>

        <div class="save-act">
            <button type="button" class="btn-cmn" onclick="closeSideNav3()">Cancel</button>
            <button type="submit" class="savebtn">Done</button>
        </div>
    </div>
    <!-- End Add Custom Tax Sidebar -->

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box" style="margin-top: 30px !important">
              <div class="row">
                    <div class="col-md-9">
                      <h1 class="page-title">History by account</h1>
                    </div>
                    <div class="col-md-3">
                       <a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a> | <a href="<?=url('accounting/reconcile')?>">Reconcile</a> 
                    </div>
                </div>
            </div>
            <!-- end row -->
           
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                             <div class="row align-items-center">
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <label>Account</label>
                                        <select class="form-control" id="account_name" name="account_name">
                                            <?php
                                               $i=1;
                                               foreach($this->chart_of_accounts_model->select() as $row)
                                               {
                                                ?>
                                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                                <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                                              <?php
                                              $i++;
                                              }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <label>Report period</label>
                                        <select class="form-control" id="report_period" name="report_period" onchange="onChange()">
                                            <option value="all">All</option>
                                            <option value="365">Since 365 Days Ago</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="history_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                              <thead>
                                <tr>
                                    <th>STATEMENT ENDING DATE</th>
                                    <th>RECONCILED ON</th>
                                    <th>ENDING BALANCE</th>
                                    <th>CHANGES</th>
                                    <th>AUTO ADJUSTMENT</th>
                                    <th>STATEMENT</th>
                                    <th>ACTION</th>
                                </tr>
                              </thead>
                              <tbody id="changeme">
                                  <?php $i=0;?>
                                <?php foreach($rows as $row){?>
                                <?php
                                  $accBalance = $this->chart_of_accounts_model->getBalance($row->chart_of_accounts_id);
                                  $adjustment = $row->ending_balance-(($accBalance-$row->service_charge)+$row->interest_earned);
                                ?>
                                <tr>
                                  <td><?=$row->ending_date?></td>
                                  <td><?=$row->adjustment_date?></td>
                                  <td><?=$row->ending_balance?></td>
                                  <td>0.00</td>
                                  <td><?=number_format($adjustment,2);?></td>
                                  <?php $name=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id);?>
                                  <td><a href="#" onclick="openSideNav3('<?=$name?>')">Attach</a></td>
                                  <td>
                                    <div class="dropdown show">
                                      <a class="dropdown-toggle" href="<?=url('accounting/reconcile/view/report/').$row->chart_of_accounts_id?>" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <a href="<?=url('accounting/reconcile/view/report/').$row->chart_of_accounts_id?>">View Report</a>
                                      </a>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" href="<?=url('accounting/reconcile/view/report_print/').$row->chart_of_accounts_id?>" >Print</a>
                                      </div> 
                                    </div>
                                  </td>
                                </tr>
                                <?php $i++;?>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
function openSideNav3(name) {
    $('#pop_name').text(name);
    jQuery("#side-menu-cus-tx").addClass("open-side-nav");
    jQuery("#overlay-cus-tx").addClass("overlay");
}

function closeSideNav3() {
   
    jQuery("#side-menu-cus-tx").removeClass("open-side-nav");
    jQuery("#overlay-cus-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
  
  var table = $('#history_table').DataTable({sDom: 'lrtip'});
  function onChange()
  {   
    var selectBox = document.getElementById("report_period");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if(selectedValue=='365')
    {
      var arr = [];
      $("#history_table tr").each(function(){
          arr.push($(this).find("td:first").text());
      });
      var xxx = "";
      for (i=1;i<arr.length;i++)
      {
       var dt = arr[i];
       var d = dt.split(".");
       var newdt = new Date(d[2],d[1]-1,d[0]);
       var today = new Date();
       var dateLimit = new Date(new Date().setDate(today.getDate() - 365));
       if (newdt > dateLimit) 
       {    
          if(xxx == '')
            {
                xxx =newdt;
            }
            else
            {
                xxx = xxx+'|'+newdt;
            }

       }
      }
      table.search(newdt,true,false).draw(); 
      
    }
    else
    {
        table.search( '' ).columns().search( '' ).draw();
    }
  }
</script>
<script type="text/javascript">
$('#account_name').on('change', function() {
 getReport(this.value);
});
function getReport(chart_of_accounts_id)
{
  var chart_of_accounts_id = chart_of_accounts_id;
  if(chart_of_accounts_id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/historyajax/') ?>"+chart_of_accounts_id,
        method: "POST",
        success:function(data)
        {
           $("#changeme").html(data);
        }
    })
  }
}
</script>
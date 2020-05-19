<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">           
               <h1 class="page-title">Workorders</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage workorder</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-md-block">
                  <div class="dropdown">
                    <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                        <a href="<?php echo url('workorder/add') ?>" class="btn btn-primary" aria-expanded="false">
                            <i class="mdi mdi-settings mr-2"></i> New Workorder
                        </a>   
                     <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->                     
      <div class="row" >
         <div class="col-xl-12">
            <div class="card">
              <div class="d-block d-none  hid-deskx">
                <?php 
                $id = logged('id');
  
        $servername = "localhost";
        $username = "oscuz_sony";
        $password = "Sony@123";
        $dbname = "oscuz_nsmart";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

         $sql = "SELECT  * from workorders WHERE `user_id`=$id";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $ss=$row['id'];
           ?>
                <div card__columns>
                  <div class="c__header">
                    <h4> <?php echo 'WO-00'.$row['id']; ?></h4>
                    <div class="card__columns_dec">
                      <div><i class="fa fa-user" aria-hidden="true"></i> <?php echo $row['contact_name'];?></div>
                      <div><i class="fa fa-users" aria-hidden="true"></i> <?php echo $row['contact_mobile'];?></div>
                      <div><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('M d, Y', strtotime($row->workorder_date));?></div>
                       <h4 ><span><a href="http://oscuz.com/nsmartfrontend/workorder/edit/<?php echo $ss; ?>">View Workorder</a></span></h4>
                    </div>
                  </div>
                </div>
         <?php                   
          }
        } else {
          echo "No Workorders";
        } ?>       
      </div>
               <div class="card-body hid-desk">              
                  <h4 class="mt-0 header-title mb-5">List of Workorders</h4>
                  <div class="row">
                     <div class="col-lg-12 table-responsive">
                     <table id="dataTable1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Work Order#</th>                              
                                <th>Date Issued</th>
                                <th>Sale Person</th>
                                <th>Customer</th>           
                                <th>Mobile</th>   
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>        
                                <?php foreach($workorders as $row){ ?>
                                <tr>
                                    <td><?php echo 'WO-00'.$row->id?></td>       
                                    <td><?php echo date('M d, Y', strtotime($row->workorder_date));?></td>
									<td><?php echo $this->users_model->getRowById($row->user_id, 'name')?></td>   
                                    <td><?php echo $row->contact_name;?></td>
                                    <td><?php echo $row->contact_mobile;?></td>                                  
                                    <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Manage
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                        <?php if (hasPermissions('WORKORDER_MASTER')): ?>                     
                                            <li><a href="<?php echo url('workorder/edit/'.$row->id) ?>">Edit</a></li>    
                                        <?php endif ?>                                   
                                        </ul>
                                    </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end row -->
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<style>
  .hid-deskx{
display: none !important;
 }


  @media only screen and (max-width: 600px) {
  .hid-desk{
display: none !important;
 }
 .hid-deskx{
display: block !important;
 }
}
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
  $('#dataTable1').DataTable({

    "order": [[ 0, "desc" ]]
  });

  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html, {size: 'small'});
});

window.updateUserStatus = (id, status) => {
  $.get( '<?php echo url('company/change_status') ?>/'+id, {
    status: status
  }, (data, status) => {
    if (data=='done') {
      // code
    }else{
      alert('Unable to change Status ! Try Again');
    }
  })
}

</script>
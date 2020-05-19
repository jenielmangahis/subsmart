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
               <h1 class="page-title"><?php echo $page->title;?></h1>
               <!-- <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage workorder</li>
               </ol> -->
            </div>           
         </div>
      </div>
      <!-- end row -->     
      <?php echo form_open_multipart('report/workorder_to_csv', [ 'class' => 'form-validate', 'id'=> 'workorder_form', 'autocomplete' => 'off' ]); ?>                   
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">              
                    <!-- <h4 class="mt-0 header-title mb-5">List of Workorders</h4> -->                 
                    <div class="row">
                        <div class="col-lg-12">
                        <!-- <a href="#" style="float: right;"><span class="fa fa-download"></span>CSV Export</a> -->    
                        <select name="select_type" id="select_type">
                          <option value="tt">All Types</option>
                          <option value="Residential" <?php echo (($this->uri->segment(3)) && $this->uri->segment(3) == 'Residential') ? 'selected' : '';?>>Residential</option>
                          <option value="Commercial" <?php echo (($this->uri->segment(3)) && $this->uri->segment(3) == 'Commercial') ? 'selected' : '';?>>Commercial</option>
                        </select>     
                        <select name="select_status" id="select_status">
                          <option value="ss">All Statuses</option>
                          <option value="New" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'New') ? 'selected' : '';?>>New</option>
                          <option value="Scheduled" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Scheduled') ? 'selected' : '';?>>Scheduled</option>
                          <option value="Started" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Started') ? 'selected' : '';?>>Started</option>
                          <option value="Paused" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Paused') ? 'selected' : '';?>>Paused</option>
                          <option value="Completed" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Completed') ? 'selected' : '';?>>Completed</option>
                          <option value="Invoiced" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Invoiced') ? 'selected' : '';?>>Invoiced</option>
                          <option value="Withdrawn" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Withdrawn') ? 'selected' : '';?>>Withdrawn</option>
                          <option value="Closed" <?php echo (($this->uri->segment(4)) && $this->uri->segment(4) == 'Closed') ? 'selected' : '';?>>Closed</option>
                        </select>  
                        <select name="select_emp" id="select_emp">
                          <option value="0">All Employees</option>  
                          <?php foreach($users as $row) { ?>

                              <option value="<?php echo $row->id;?>" <?php echo ($this->uri->segment(5) && $this->uri->segment(5) == $row->id) ? 'selected' : '';?>><?php echo $row->username;?></option>
                          <?php }?>                      
                        </select>    
                        <button type="submit" style="float: right;"><span class="fa fa-download"></span>CSV Export</button>
                            <table class="table table-bordered table-striped">                              
                                <thead>
                                    <tr>
                                        <th>Work Order#</th>  
                                        <th>Customer Name</th>                              
                                        <th>Type</th>                              
                                        <th>WO Status</th>                              
                                        <th>Assigned To</th>                              
                                        <th>Date Issued</th>                                              
                                        <th>Total Price</th>   
                                        <th>Expenses</th>   
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>        
                                    <?php $sum=0; foreach($workorders as $row){ 
                                        
                                            $workorder_items = unserialize($row->workorder_items);    
                                            $sum = $sum + $workorder_items[0]['price'];
                                            $assign_to = ($row->assign_to) ? $row->assign_to : 0;
                                            
                                            $query = $this->db->query("select username from users where id in ($assign_to)");
                                            $query11 = $query->result();
                                            $employee_name = '';

                                            if(count($query11) > 0){

                                              for($i=0; $i<count($query11); $i++) {

                                                 $employee_name .= $query11[$i]->username.', ';
                                              }
                                           }                                       
                                          
                                        ?>
                                        <tr>
                                            <td><?php echo 'WO-00'.$row->id?><input type="hidden" name="workorder_id[]" value="<?php echo 'WO-00'.$row->id;?>"></td>    
                                            <td><?php echo ucfirst($row->contact_name);?><input type="hidden" name="contact_name[]" value="<?php echo ucfirst($row->contact_name);?>"></td>                                                                                                      
                                            <td><?php echo $row->customer_type?><input type="hidden" name="customer_type[]" value="<?php echo $row->customer_type;?>"></td>                                   
                                            <td><?php echo $row->workorder_status?><input type="hidden" name="workorder_status[]" value="<?php echo $row->workorder_status;?>"></td>                                   
                                            <td><?php echo rtrim($employee_name, ', ');?><input type="hidden" name="assign_to[]" value="<?php echo rtrim($employee_name, ', ');?>"></td>                                   
                                            <td><?php echo date('M d, Y', strtotime($row->workorder_date));?><input type="hidden" name="workorder_date[]" value="<?php echo date('M d, Y', strtotime($row->workorder_date));?>"></td>                                            
                                            <td><?php echo ($workorder_items[0]['price']) ? '$'.number_format($workorder_items[0]['price'], 2) : '$0.00';?><input type="hidden" name="workorder_price[]" value="<?php echo ($workorder_items[0]['price']) ? '$'.number_format($workorder_items[0]['price'], 2) : '$0.00';?>"></td>                                                                
                                            <td>$0.00</td>                                                                
                                            <td>$0.00</td>                                                                
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b><?php echo '$'.number_format($sum, 2);?></b></td>
                                        <td><b>$0.00</b></td>
                                        <td><b>$0.00</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- end row -->
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
<?php include viewPath('includes/footer'); ?>
<script>
  $('#dataTable1').DataTable({

    "ordering": false
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

$(document).on('change', '#select_type', function(e) {

    var select_type = $(this).val();
    var select_status = $('#select_status').val();
    var select_emp = $('#select_emp').val();
    
    window.location.href = '<?php echo base_url()?>report/searchByKeyword/'+select_type+'/'+select_status+'/'+select_emp;
});

$(document).on('change', '#select_status', function(e) {

  var select_status = $(this).val();
  var select_type = $('#select_type').val();
  var select_emp = $('#select_emp').val();

  window.location.href = '<?php echo base_url()?>report/searchByKeyword/'+select_type+'/'+select_status+'/'+select_emp;
});

$(document).on('change', '#select_emp', function(e) {

  var select_emp = $(this).val();
  var select_status = $('#select_status').val();
  var select_type = $('#select_type').val();

  window.location.href = '<?php echo base_url()?>report/searchByKeyword/'+select_type+'/'+select_status+'/'+select_emp;
});

</script>
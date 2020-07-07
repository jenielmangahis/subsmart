<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); 
   $states = array(

    'AK'=>'Alaska',
    'AL'=>'Alabama',
    'AR'=>'Arkansas',
    'AZ'=>'Arizona',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DC'=>'District of Columbia',
    'DE'=>'Delaware',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'IA'=>'Iowa',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'MA'=>'Massachusetts',
    'MD'=>'Maryland',
    'ME'=>'Maine',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MO'=>'Missouri',
    'MS'=>'Mississippi',
    'MT'=>'Montana',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'NE'=>'Nebraska',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NV'=>'Nevada',
    'NY'=>'New York',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VA'=>'Virginia',
    'VT'=>'Vermont',
    'WA'=>'Washington',
    'WI'=>'Wisconsin',
    'WV'=>'West Virginia',
    'WY'=>'Wyoming'
);
   ?>
<?php include viewPath('includes/header'); ?>

<!-- page wrapper start -->
<div class="wrapper">
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Workorders</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage workorders</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                     <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                        <a href="<?php echo url('workorder') ?>" class="btn btn-primary" aria-expanded="false">
                            <i class="mdi mdi-settings mr-2"></i> Go Back to Workorder
                        </a>   
                     <?php //endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->    
      <?php echo form_open_multipart('workorder/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>                 
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="mt-0 header-title mb-5">New Work Order</h4>
                  <div class="row">                   
                     <div class="col-md-4 form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required placeholder="Enter Name" autofocus />
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Enter Email" required/>
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">                    
                     <div class="col-md-4 form-group">
                        <label for="contact_mobile">Mobile</label>
                        <input type="text" class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Enter Mobile" required/>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="contact_phone">Phone</label>
                        <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Enter Phone" />
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Customer Type</label><br/>
                        <label class="radio-inline">
                        <input type="radio" name="customer_type" value="Residential" checked>Residential
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="customer_type" value="Commercial">Commercial
                        </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                         <label class="checkbox-inline">
                            <input type="checkbox" name="notify_by[]" value="Email" checked>Notify By Email
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="notify_by[]" value="SMS" checked>Notify By SMS/Text
                        </label>
                    </div>
                  </div>
                  <div class="row">                   
                     <div class="col-md-4 form-group">
                         <label for="street_address">Street Address</label>
                         <input type="text" class="form-control" name="street_address" id="street_address" placeholder="Enter Address"/>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="suit">Suit/Unit</label>
                        <input type="text" class="form-control" name="suit" id="suit" placeholder="Enter Suit/Unit"/>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City"/>
                     </div>
                     <div class="col-md-4 form-group">
                        <label for="zip">Zip/Postal Code</label>
                        <input type="text" class="form-control" name="zip" id="zip" placeholder="Enter Zip/Postal Code"/>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                            <label for="state">State/Province</label>
                            <select name="state" id="state" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($states as $key=>$val) { ?>

                                <option value="<?php echo $key?>"><?php echo $val;?></option>
                                <?php }?>
                            </select>
                     </div>                    
                  </div>
                  <div class="row">
                    <div class=" col-md-9">
                        <div class="work_nore">
                            <h6>Work Order Items</h6>
                            <p> You can set up the products or services for this work order. </p>
                            <p><strong class="red">Note: prices will not be shown to the assigned employees but only to you. </strong></p>
                            <!-- <a href="" class="add_itemms_button">Add Items</a> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Show qty as:</label>
                        <select class="custom-select form-control">
                            <option>Quanity</option>
                        </select>
                    </div>
                 </div><br/>
                 <div class="row">
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <input type="hidden" name="count" value="0" id="count">
                            <thead>
                                <tr>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Tax(%)</th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                <tr>
                                <td>
                                    <input type="text" class="form-control" name="item[]">
                                </td>
                                <td>
                                    <select name="type[]" class="form-control">
                                        <option value="Service">Service</option>
                                        <option value="Material">Material</option>
                                        <option value="Product">Product</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1">
                                </td>
                                <td>
                                    <input type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0">
                                </td>
                                <td>
                                    <span id="span_discount_0">0.00 (0.00%)</span>
                                </td>
                                <td>
                                    <span id="span_tax_0">0.00 (7.5%)</span>
                                </td>
                                <td>
                                    <span id="span_total_0">0.00</span>
                                </td>
                                </tr>                
                            </tbody>
                            </table>
                            <a href="#" class="btn btn-primary" id="add_another">Add Items</a>                                        
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-9">
                            <div class="work_nore">
                                <h6>Checklist</h6>
                                <p> You can set up a checklist for employees. </p>
                                
                                <!-- <a href="" class="add_itemms_button">Add Items</a> -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checklistModal">+Select Checklist</button>
                            </div>
                        </div>
                     </div>
                     <?php if(count($users) > 0) { ?>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <h6>Assign To <span>(Optional)</span></h6>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="checbox_lable">                                      
                                    <?php foreach($users as $row) { ?>

                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="<?php echo $row->id;?>" name="assign_to[]" value="<?php echo $row->id;?>"><?php echo ucfirst($row->name);?>
                                        </label> 
                                    <?php }?> 
                                </div>
                            </div>
                        </div>                       
                    <?php }?>   
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control" name="start_date" id="start_date" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="start_time">Start Time</label>
                            <input type="text" class="form-control" name="start_time" id="start_time" />
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="end_time">End Time</label>
                            <input type="text" class="form-control" name="end_time" id="end_time" />
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label>Customer Reminder Notification</label>
                            <select name="custom_reminder" id="custom_reminder" class="form-control custom-select">
                                <option value="">None</option>
                                <option value="5M">5 minutes before</option>
                                <option value="15M">15 minutes before</option>
                                <option value="30M">30 minutes before</option>
                                <option value="1H">1 hour before</option>
                                <option value="2H">2 hours before</option>
                                <option value="4H">4 hours before</option>
                                <option value="6H">6 hours before</option>
                                <option value="8H">8 hours before</option>
                                <option value="2H">12 hours before</option>
                                <option value="16H">16 hours before</option>
                                <option value="1D">1 day before</option>
                                <option value="2D">2 days before</option>                   
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Event Color</label>
                            <div class="color_checkbox p-0">
                                <input type="color" class="form-control" name="event_color" id="event_color" style="width: 85%;height: 30px !important;padding: 2px;"/>
                            </div>
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="contact_name">Date Issued</label>
                            <input type="text" class="form-control" name="date_issued" id="date_issued" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="job_type">Job Type</label>
                            <select name="job_type" id="job_type" class="form-control custom-select">
                                <option value="Service">Service</option>
                                <option value="Design">Design</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Repair">Repair</option>
                                <option value="Replace">Replace</option>
                            </select>
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="job_name">Job Name</label>
                            <input type="text" class="form-control" name="job_name" id="job_name" required  autofocus />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="job_desc">Job Description</label>
                            <textarea name="job_desc" id="job_desc" cols="5" rows="2" class="form-control"></textarea> 
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="workorder_status">Status</label>
                            <select name="workorder_status" id="workorder_status" class="form-control custom-select">
                                <option value="New">New</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Started">Started</option>
                                <option value="Paused">Paused</option>
                                <option value="Completed">Completed</option>
                                <option value="Invoiced">Invoiced</option>
                                <option value="Withdrawn">Withdrawn</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="workorder_priority">Priority</label>
                            <select name="workorder_priority" id="workorder_priority" class="form-control custom-select">
                                <option value="Emergency">Emergency</option>
                                <option value="Low">Low</option>
                                <option value="Standard">Standard</option>
                                <option value="Urgent">Urgent</option>                
                            </select>
                        </div>                                           
                    </div>

                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="purchase_order">Purchase Order# (optional)</label>
                            <input type="text" class="form-control" name="purchase_order" id="purchase_order" /> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="instructions">Instructions</label>
                            <p style="font-weight: 10;">Some remarks or notes for employees</p>
                            <textarea name="instructions" id="instructions" cols="5" rows="2" class="form-control"></textarea>
                        </div>                                           
                    </div>
                    <div class="row">                        
                        <div class="form-group col-md-4">
                            <label for="attachment">Attachments</label>
                            <p style="font-weight: 10;">Optionally attach files to this work order. Allowed type: pdf, doc, docx, png, jpg, gif.</p>
                             <input type="file" class="form-control" name="attachment" id="attachment">
                        </div>                                                                
                    </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                        <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancle this</a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <div class="modal fade" id="checklistModal" role="dialog">
                <div class="modal-dialog">            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Checklists</h4>
                    </div>
                    <div class="modal-body">
                    <p></p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
                    </div>
                </div>                
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
  $(document).ready(function() {
    $('.form-validate').validate();

      //Initialize Select2 Elements
    $('.select2').select2()

  })

  function previewImage(input, previewDom) {

    if (input.files && input.files[0]) {

      $(previewDom).show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $(previewDom).find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $(previewDom).hide();
    }

  }

  function createUsername(name) {
      return name.toLowerCase()
        .replace(/ /g,'_')
        .replace(/[^\w-]+/g,'')
        ;;
  }

  $(document).on('focusout', '.price', function(){

      var counter = $(this).data('counter');
      calculation(counter);    
  });

  $(document).on('focusout', '.quantity', function(){

      var counter = $(this).data('counter');
      calculation(counter);    
  });

  function calculation(counter) {

      var price = $('#price_'+counter).val();
      var quantity = $('#quantity_'+counter).val();
      var tax = (parseFloat(price)*7.5/100);
      var tax1 = ((parseFloat(price)*7.5/100) * parseFloat(quantity)).toFixed(2);
      var total = ((parseFloat(price)+parseFloat(tax))*parseFloat(quantity)).toFixed(2);

      $('#span_total_'+counter).text(total);
      $('#span_tax_'+counter).text(tax1);
  }

  $(document).on('click', '#add_another', function(e){

    e.preventDefault();
    var count = parseInt($('#count').val())+1;
    $('#count').val(count);

    var html = '<tr>\n'+
                '<td>\n'+
                  '<input type="text" class="form-control" name="item[]">\n'+
                '</td>\n'+
                '<td>\n'+
                  '<select name="type[]" class="form-control">\n'+
                      '<option value="Service">Service</option>\n'+
                      '<option value="Material">Material</option>\n'+
                      '<option value="Product">Product</option>\n'+
                  '</select>\n'+
                '</td>\n'+
                '<td>\n'+
                  '<input type="text" class="form-control quantity" name="quantity[]" data-counter="'+count+'" id="quantity_'+count+'" value="1">\n'+
                '</td>\n'+
                '<td>\n'+
                  '<input type="number" class="form-control price" name="price[]" data-counter="'+count+'" id="price_'+count+'" min="0" value="0">\n'+
                '</td>\n'+
                '<td>\n'+
                  '<span id="span_discount_'+count+'">0.00 (0.00%)</span>\n'+
                '</td>\n'+
                '<td>\n'+
                  '<span id="span_tax_'+count+'">0.00 (7.5%)</span>\n'+
                '</td>\n'+
                '<td>\n'+
                  '<span id="span_total_'+count+'">0.00</span>\n'+
                '</td>\n'+
                '<td>\n'+
                  '<a href="#" class="remove">X</a>\n'+
                '</td>\n'+
              '</tr> ';

        $('#table_body').append(html);
  });

  $(document).on('click', '.remove', function(e){

    e.preventDefault();
    $(this).parent().parent().remove();
    //var count = parseInt($('#count').val())-1;
   // $('#count').val(count);
  });

  $( function() {
    $( "#date_issued" ).datepicker();
    $( "#start_date" ).datepicker();
    $('#end_time').timepicker({});
    $('#start_time').timepicker({});
    $('#end_date').datepicker();
  } );

</script>
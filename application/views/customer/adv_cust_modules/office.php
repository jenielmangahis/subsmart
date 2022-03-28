<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="office module ui-state-default" data-id="<?= $id ?>"   id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Office</h6>
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Welcome Kit :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ if($office_info->welcome_sent == 1){echo "On";}else{echo "Off";} }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CSO :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ if($office_info->commision_scheme == 1){echo "On";}else{echo "Off";} }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Rep Comm. :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->rep_comm; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Rep Pay :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Tech Comm. :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->tech_comm; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Tech Pay :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; }; ?></b> </label>
                            </td>
                        </tr>
                        <!--<tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >RepHold :</span> </label>
                            </td>
                            <td width="50%" align="left" valign="top">
                                <label class="alarm_answer"><b> 110</b> </label>
                            </td>
                        </tr>-->
                        </tbody>
                    </table>
                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                    <label>Install Date: <b>Guardian</b></label>-->
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Rep Payroll :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->rep_charge_back; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >PSO :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->pso; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Points :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->points_include; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Price Point :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($office_info)){ echo $office_info->price_per_point; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Purchase $ :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->purchase_price; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Purchase X's :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->purchase_multiple; }; ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-left:30px;  padding-top:30px;" align="left" class="normaltext1">
                <a class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="window.open('<?= base_url('job_checklists/list'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');" style="color:#ffffff;">Checklists</a>&nbsp;&nbsp;
                <a class="btn btn-sm btn-primary btn-send-welcome-letter" href="javascript:void(0);" style="color:#ffffff;">Welcome Email</a>&nbsp;&nbsp;
                <a class="btn btn-sm btn-primary"  href="javascript:void(0);" onclick="window.open('<?= base_url('survey'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');" style="color:#ffffff;">Survey</a>
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>


            <!-- Modal send welcome email -->
            <div class="modal fade bd-example-modal-md" id="modal-welcome-email" tabindex="-1" role="dialog" aria-labelledby="modalWelcomeEmailTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-envelope-o"></i> Send Welcome Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="frm-send-welcome-email" method="post">
                            <input type="hidden" name="cid" value="<?= $cus_id; ?>">                            
                            <div class="modal-body welcome-email-container"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-send-welcome-email">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', '.btn-send-welcome-letter', function(){        
        var url = base_url + 'customer/_load_welcome_email_form';
        var cid = "<?= $cus_id; ?>";

        $('#modal-welcome-email').modal('show');        
        $(".welcome-email-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {cid:cid},
             success: function(o)
             {  
                $('.welcome-email-container').html(o);
             }
          });
        }, 800);
    });

    $("#frm-send-welcome-email").submit(function(e){
      e.preventDefault();
      var url = base_url + '/customer/_send_welcome_email';
      $(".btn-send-welcome-email").html('<span class="spinner-border spinner-border-sm m-0"></span>');

      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
      }

      var formData = new FormData($("#frm-send-welcome-email")[0]);   

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {       
                $('#modal-welcome-email').modal('hide');    

                if( o.is_success == 1 ){
                  Swal.fire({
                      text: 'Welcome email was successfully sent',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      //location.reload();
                  });
                }else{
                  
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 
                $(".btn-send-welcome-email").html('Send');
             }
          });
      }, 800);
    });
});
</script>
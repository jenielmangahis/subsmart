<style>
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 5px;
    }
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
    .pr-b10 {
      position: relative;
      bottom: 10px;
    }
    .left {
      float: left;
    }
    .p-40 {
      padding-left: 15px !important;
      padding-top: 10px !important;
    }
    .card.p-20 {
        padding-top: 18px !important;
    }
    .fr-right {
      float: right;
      justify-content: flex-end;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
    }
    .pd-17 {
      position: relative;
      left: 17px;
    }
    @media only screen and (max-width: 1300px) {
      .card-deck-upgrades div a {
          min-height: 440px;
      }
    }
    @media only screen and (max-width: 1250px) {
      .card-deck-upgrades div a {
          min-height: 480px;
      }
      .card-deck-upgrades div {
        padding: 10px !important;
      }
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 62px !important;
    }
    .cb-logo{
        height: 22px;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
    <?php include viewPath('includes/notifications'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card_holder">
                <div class="page-title-box" style="padding:14px 0 0 0;">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Credit Bureau</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('credit_bureau/add_new') ?>" class="btn btn-primary" style="position: relative;bottom: 2px;"><i
                                                class="fa fa-plus"></i> Add Credit Bureau</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Credit Bureau</span>
                  </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <?php include viewPath('flash'); ?>
                            <table id="creditBureauList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width:8%;"></th>
                                    <th style="width:60%;">Name</th>
                                    <th style="width:10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($creditBureaus as $cb){ ?>
                                        <tr>
                                            <td>
                                                <img class="cb-logo" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>">
                                            </td>
                                            <td><?= $cb->name; ?></td>
                                            <td class="text-right" style="vertical-align:top;">
                                                <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="<?php echo base_url('credit_bureau/edit/' . $cb->id) ?>">
                                                                <span class="fa fa-pencil-square-o icon"></span> Edit
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" class="delete-credit-bureau" href="javascript:void(0);" data-name="<?= $cb->name; ?>" data-id="<?= $cb->id; ?>">
                                                                <span class="fa fa-trash-o icon"></span> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <!-- Modal Delete Quick Note -->
                        <div class="modal fade bd-example-modal-md" id="modal-delete-credit-bureau" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'frm-delete-credit-bureau', 'autocomplete' => 'off' ]); ?>
                              <?php echo form_input(array('name' => 'cbid', 'type' => 'hidden', 'value' => '', 'id' => 'cbid'));?>
                              <div class="modal-body">
                                  <p>Are you sure you want to delete credit bureau <span id="cb-name"></span>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger btn-delete-credit-bureau">Yes</button>
                              </div>
                              <?php echo form_close(); ?>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(function(){
        $('#creditBureauList').DataTable()
        $(".delete-credit-bureau").click(function(){
            var cb_id   = $(this).attr('data-id');            
            var cb_name = $(this).attr('data-name');

            $("#cbid").val(cb_id);
            $('#cb-name').html('<b>'+cb_name+'</b>');
            $("#modal-delete-credit-bureau").modal('show');
        });

        $("#frm-delete-credit-bureau").submit(function(e){
          e.preventDefault();
          var url = base_url + 'credit_bureau/_delete_credit_bureau';
          $(".btn-delete-credit-bureau").html('<span class="spinner-border spinner-border-sm m-0"></span>');

          var formData = new FormData($("#frm-delete-credit-bureau")[0]);   

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
                    $("#modal-delete-credit-bureau").modal('hide');

                    if( o.is_success == 1 ){
                      Swal.fire({
                          title: 'Great!',
                          text: 'Credit Bureau was successfully deleted.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          location.reload();
                      });
                    }else{                      
                      Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        confirmButtonColor: '#32243d',
                        html: o.msg
                      });
                    } 
                    $(".btn-delete-credit-bureau").html('Delete');
                 }
              });
          }, 800);
        });
    });    
</script>

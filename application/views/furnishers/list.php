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
                            <h1 class="page-title">Creditors / Furnishers</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('creditor_furnisher/add_new') ?>" class="btn btn-primary" style="position: relative;bottom: 2px;"><i
                                                class="fa fa-plus"></i> Add New</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage your creditors / furnishers</span>
                  </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <?php include viewPath('flash'); ?>
                            <table id="furnisherList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width:30%;">Nane</th>
                                    <th style="width:40%;">Address</th>
                                    <th style="width:10%;">Phone</th>
                                    <th style="width:10%;">Account Type</th>
                                    <th style="width:10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($creditorFurnishers as $f){ ?>
                                        <tr>
                                            <td><?= $f->name; ?></td>
                                            <td><span><?= $f->address; ?></span></td>
                                            <td>(<?= $f->ext; ?>) <?= $f->phone; ?></td>
                                            <td><?= $f->account_type; ?></td>
                                            <td class="text-right" style="vertical-align:top;">
                                                <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="<?php echo base_url('creditor_furnisher/edit/' . $f->id) ?>">
                                                                <span class="fa fa-pencil-square-o icon"></span> Edit
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" class="delete-furnisher" href="javascript:void(0);" data-name="<?= $f->name; ?>" data-id="<?= $f->id; ?>">
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
                        <div class="modal fade bd-example-modal-md" id="modal-delete-furnisher" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'frm-delete-furnisher', 'autocomplete' => 'off' ]); ?>
                              <?php echo form_input(array('name' => 'fid', 'type' => 'hidden', 'value' => '', 'id' => 'fid'));?>
                              <div class="modal-body">
                                  <p>Are you sure you want to delete creditor / furnisher <span class="furnisher-name"></span>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger btn-delete-furnisher">Yes</button>
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
        $('#furnisherList').DataTable();

        $(".delete-furnisher").click(function(){
            var fid = $(this).attr('data-id');      
            var fname = $(this).attr('data-name');      

            $("#fid").val(fid);
            $(".furnisher-name").html("<b>"+fname+"</b>");
            $("#modal-delete-furnisher").modal('show');
        });

        $("#frm-delete-furnisher").submit(function(e){
          e.preventDefault();
          var url = base_url + 'creditor_furnisher/_delete_creditor_furnisher';
          $(".btn-delete-furnisher").html('<span class="spinner-border spinner-border-sm m-0"></span>');

          var formData = new FormData($("#frm-delete-furnisher")[0]);   

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
                    $("#modal-delete-furnisher").modal('hide');

                    if( o.is_success == 1 ){
                      Swal.fire({
                          title: 'Great!',
                          text: 'Creditor / Furnisher was successfully deleted.',
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
                    $(".btn-delete-furnisher").html('Delete');
                 }
              });
          }, 800);
        });        
    });    
</script>

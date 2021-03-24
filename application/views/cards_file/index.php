<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
.card-help {
    padding-left: 45px;
    padding-top: 10px;
}
.text-ter {
    color: #888888;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired{
  color:red;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Cards File</h3>
                        </div>
                        <div class="col-sm-6 right dashboard-container-1">
                            <div class="text-right">
                                <a class="btn btn-info" href="<?php echo base_url('cards_file/add_new'); ?>"><i class="fa fa-file"></i> Add New</a>
                            </div>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing all your credit cards saved on file.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Card</th>
                                    <th style="width: 10%;">Card holder</th>
                                    <th style="width: 10%;text-align: center;">Primary Card</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cardsFile as $c){ ?>
                                    <tr>
                                        <td>   
                                          <?php 
                                            $card_type = strtolower($c->cc_type); 
                                            $card_type = str_replace(" ", "", $card_type);
                                          ?>
                                          <span class="card-type <?= $card_type; ?>"></span>                                       
                                          <?php 
                                            $card_number = maskCreditCardNumber($c->card_number);
                                            echo $card_number;
                                          ?>   
                                          <?php
                                            $today = date("y-m-d");  
                                            $day   = date("d");                                 
                                            $expires = date("y-m-d",strtotime($c->expiration_year . "-" . $c->expiration_month . "-" . $day));
                                            $expired = 'expires';
                                            if( strtotime($expires) < strtotime($today) ){
                                              $expired = 'expired';
                                            }
                                            
                                          ?>
                                          <span class="<?= $expired; ?>"> (<?= $expired; ?> <?= $c->expiration_month . "/" . $c->expiration_year; ?>)</span>
                                          <?php if($c->is_primary == 1){ ?>
                                            <div class="card-help text-ter">
                                              This is the card used for membership and purchases.
                                            </div> 
                                          <?php } ?>
                                        </td>
                                        <td><?= $c->card_owner_name; ?></td>
                                        <td style="text-align: center;">
                                          <?php 
                                            $is_checked = '';
                                            if( $c->is_primary == 1 ){
                                              $is_checked = 'checked="checked"';
                                            }
                                          ?>
                                          <label class="custom-control custom-checkbox">
                                            <input type="checkbox" <?= $is_checked; ?> class="custom-control-input cc-is-primary" data-id="<?= $c->id; ?>">
                                            <span class="custom-control-indicator"></span>
                                          </label>
                                        </td>
                                        <td>
                                          <div class="dropdown dropdown-btn">
                                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                  <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                              </button>
                                              <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit"> 
                                                  <li role="presentation">
                                                      <a role="menuitem" class="delete-card" data-id="<?= $c->id; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                  </li>  
                                              </ul>
                                          </div>
                                      </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->

        <!-- Modal Delete Addon  -->
        <div class="modal fade bd-example-modal-sm" id="modalDeleteCard" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCardTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('cards_file/delete_card', ['id' => 'delete-card', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
              <div class="modal-body">
                  <p>Delete selected card?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger btn-delete-card">Yes</button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script type="text/javascript">
$(function(){
    $(".cc-is-primary").change(function(){
      var url = base_url + 'cards_file/_update_primary_card';
      var id  = $(this).attr("data-id");
      $(".cc-is-primary").not(this).prop('checked', false);  

      $.ajax({
         type: "POST",
         url: url,
         dataType: "json",
         data: {id:id},
         success: function(o)
         {
            location.reload();
         }
      });

    });

    $(".delete-card").click(function(){
      var cid = $(this).attr('data-id');
      $("#cid").val(cid);
      $("#modalDeleteCard").modal('show');
    });

    $("#delete-card").submit(function(e){
      e.preventDefault();
      var url = base_url + 'cards_file/delete_card';
      $(".btn-delete-card").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: $("#delete-card").serialize(),
           success: function(o)
           {
              if( o.is_success ){ 
                  Swal.fire({
                    icon: 'success',
                    title: 'Card has been deleted',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  setTimeout(function(){location.reload();},1000);  
              }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Cannot delete',
                    text: 'Cannot find record'
                  });
              }

              $(".btn-delete-card").html('Yes');
              $("#modalDeleteCard").modal('hide');
           }
        });
      }, 1000);
    });
});
</script>

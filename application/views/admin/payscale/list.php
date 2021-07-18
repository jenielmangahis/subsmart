<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
    .table-responsive {
        overflow-x:hidden;
    }
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 0px;
      position: relative;
      bottom: 10px;
    }
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
    button.btn-info {
      background: #32253c !important;
    }
    .pr-b10 {
      position: relative;
      bottom: 15px;
    }
    .page-title-box {
        padding-bottom: 2px !important;
        padding-top: 10px !important;
    }
    .float-right.d-none.d-md-block {
        position: relative;
        top: 0px;
    }
    .p-40 {
      padding-top: 40px !important;
      padding-left: 30px !important;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    button#addPayscale {
      border: 1px solid transparent;
      box-shadow: none;
      font-size: 16px;
      transition: none;
    }
    .btn{
        border-radius: 0px !important;
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .float-right.d-none.d-md-block {
          position: relative;
          bottom: 0px;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- <div class="page-title-box">
                <div class="row align-items-center">
                </div>
            </div> -->
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12 pl-0">
                    <div class="card">
                        <div style="padding: 10px 0px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="page-title">Pay Scale list</h3>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <button class="btn btn-primary btn-md add-employee" id="addPayscale"><i class="fa fa-user-plus"></i> Add Pay Scale</button>
                                </div>
                            </div>
                            <div class="pl-3 pr-3 mt-0 row" style="position: relative;bottom: 10px;">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                              </div>
                            </div>
                            <div class="row" style="position: relative;bottom: 10px;">
                                <div class="col-lg-12 table-responsive">
                                    <table id="payscaleTable" data-page-length='25' class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 30%;">Company</th>
                                            <th style="width: 60%;">Pay Scale</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($payscale as $p){ ?>
                                            <tr>
                                                <td><?= $p->business_name; ?></td>
                                                <td><?= $p->payscale_name; ?></td>
                                                <td class="center">
                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm editPayscale" data-id="<?= $p->id?>" title="Edit Pay Scale" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" title="Delete Pay Scale" data-toggle="tooltip" data-id="<?= $p->id?>" class="btn btn-danger btn-sm btn-delete-payscale"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
    <!-- page wrapper end -->
</div>
<!--Edit Payscale modal-->
<div class="modal fade" id="modalEditPayScale">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Pay Scale</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="frm-edit-payscale">
                <div class="modal-body modal-edit-pay-scale"></div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="updatePayscale">Save</button>
            </div>
        	</form>

        </div>
    </div>
</div>
<!--Delete Payscale modal-->
<div class="modal fade modal-sm" id="modalDeletePayscale" style="margin:auto 50%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Pay Scale</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="dpid" value="">
                <p>Are you sure you want to delete selected item?</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="btn-modal-delete-payscale">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Create Payscale modal-->
<div class="modal fade" id="modalAddPayScale">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add Pay Scale</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="frm-add-payscale">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Company</label>
                            <select class="form-control" name="company_id" required="" id="company-id">
                                <?php foreach($companies as $c){ ?>
                                    <option value="<?= $c->id; ?>"><?= $c->business_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br />
                	<div class="row">
                		<div class="col-md-12">
                			<label for="">Pay Scale Name</label>
                            <input type="text" name="payscale_name" id="payscale_name" class="form-control" required="">
                		</div>
                	</div>
                </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="addPayscale">Save</button>
            </div>
        	</form>
        </div>
    </div>
</div>
<!--end of modal-->
<?php include viewPath('includes/admin_footer'); ?>
<script>
    $(document).ready(function () {
        $('#payscaleTable').DataTable({"sort":false});

        $(document).on('click','#addPayscale',function () {
            $('#modalAddPayScale').modal({backdrop: 'static', keyboard: false});
        });

        $(document).on('click','#editPayscale',function () {
            $('#modalEditPayScale').modal({backdrop: 'static', keyboard: false});
        });

        $(document).on('click','.btn-delete-payscale',function () {
            var pid = $(this).attr("data-id");
            $("#dpid").val(pid);
            $('#modalDeletePayscale').modal({backdrop: 'static', keyboard: false});
        });

        $(".editPayscale").click(function(){
            var pid = $(this).attr("data-id");
            $('#modalEditPayScale').modal({backdrop: 'static', keyboard: false});
            $.ajax({
                url: base_url + "admin/_edit_payscale",
                type:"POST",
                dataType: "html",
                data:{pid:pid},
                success:function (data) {
                    $(".modal-edit-pay-scale").html(data);
                }
            });
        });

        $("#btn-modal-delete-payscale").click(function(){
            var pid = $("#dpid").val();
            $.ajax({
                url: base_url + 'admin/_delete_payscale',
                type:"POST",
                dataType:"json",
                data:{pid:pid},
                success:function (data) {
                    if (data.is_success){
                        $("#modalDeletePayscale").modal('hide');
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Payscale was successfully deleted",
                                icon: 'success'
                            });
                        location.reload();
                    }else{
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                text: data.msg,
                                icon: 'warning'
                            });
                    }
                }
            });
        });

        $("#frm-add-payscale").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: base_url + 'admin/_add_payscale',
                type:"POST",
                dataType:"json",
                data:$("#frm-add-payscale").serialize(),
                success:function (data) {
                    if (data.is_success){
                        $("#modalAddPayScale").modal('hide');
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Payscale was successfully saved",
                                icon: 'success'
                            });
                        location.reload();
                    }else{
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                text: data.msg,
                                icon: 'warning'
                            });
                    }
                }
            });
        });

        $("#frm-edit-payscale").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: base_url + 'admin/_update_payscale',
                type:"POST",
                dataType:"json",
                data:$("#frm-edit-payscale").serialize(),
                success:function (data) {
                    if (data.is_success){
                        $("#modalEditPayScale").modal('hide');
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Payscale was successfully updated",
                                icon: 'success'
                            });
                        location.reload();
                    }else{
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                text: data.msg,
                                icon: 'warning'
                            });
                    }
                }
            });
        });

    });

</script>

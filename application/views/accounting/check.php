<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
.loader
{
    display: none !important;
}
.upload-btn-wrapper,.ubw
{
    height: 150px !important;
}
.Checkhide
{
    display: none;
}
</style>
    <!-- Add Check -->
    <div id="overlay-check-tx" class=""></div>
    <div id="side-menu-check-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <h4 id="memo_sc_nm"></h4>
                <a id="close-menu-check-tx" class="menuCloseButton" onclick="closeCheck()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="check_payee_popup" id="check_payee_popup" class="form-control">
                            <option value="" disabled="" selected>Payee</option>
                            <?php
                            foreach($this->AccountingVendors_model->select() as $ro)
                            {
                            ?>
                            <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control fa" name="check_account_popup" id="check_account_popup">
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
                               <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance: $0.00</h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <h6 id="checkamount">Amount:$0.00</h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="check_mailing_add" id="check_mailing_add" rows="4"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="check_date_popup" id="check_date_popup" class="form-control" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" id="check_checkno" value="" class="form-control"/>
                        </br>
                        </br> 
                        <input type="checkbox" name="check_print_check" class="form-control">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="check_permitno" value="" class="form-control" />
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantCheckTable">
                        <thead>
                            <tr>
                               <th></th>
                               <th>#</th>
                               <th>Category</th>
                               <th>Description</th>
                               <th>Amount</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="trClickCheckMain()" style="display: none;">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account' id='check_expense_account' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp" name="check_descp" value="" placeholder="What did you paid for?">
                                    <div class="check_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge" name="check_service_charge" value="">
                                    <div class="check_service_charge"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr onclick="trClickCheck(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account_2' id='check_expense_account_2' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_2" name="check_descp_2" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_2" name="check_service_charge_2" value="">
                                    <div class="check_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="pr participantCheckRow Checkhide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='check_expense_account_' id='check_expense_account_' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_" name="check_descp_" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_" name="check_service_charge_" value="">
                                    <div class="check_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add_check">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear_check">Clear All Lines</a>
                    </div>
                    <div class="btn-group hidemecheck" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickCheck()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickCheck()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="check_memo_sc" id="check_memo_sc" rows="4"></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="checktotal">Total : $0.00</h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramecheck" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="checkForm" enctype="multipart/form-data" target="hiddenFramecheck">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_newcheck" />
                            <input type="hidden" name="reconcile_id">
                            <input type="hidden" name="subfix" value="newcheck">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="openSideNav()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCheck()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <a href="#" style="margin-left: 30%" >Make recurring</a>
            <button type="button" class="savebtn" onclick="save_check()" >Save and close</button>
        </div>
    </div>
    <!-- End Add Check -->

    <!-- Make account -->
    <div id="overlay-account-tx" class=""></div>
    <div id="side-menu-account-tx" class="main-side-nav" style="display: none;">
        <?php echo form_open_multipart('accounting/chart_of_accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">New Chart of account</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Account</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                     <label for="account_type">Account Type</label>
                                    <select name="account_type" id="account_type" class="form-control " required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_model->get() as $row): ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->account_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="detail_type">Detail Type</label>
                                    <select name="detail_type" id="detail_type" class="form-control " onchange="showOptions(this)" required>
                                        <?php foreach ($this->account_detail_model->get() as $row_detail): ?>
                                            <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"
                                              placeholder="Enter Description" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                          Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                          <p>Typically only property managers use this type of account.</p>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check()"/>
                                    <label for="formClient-Status">Is sub account</label>
                                    <select name="sub_account_type" id="sub_account_type" class="form-control " required disabled="disabled">
                                          <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option value="<?php echo $row_sub->sub_acc_id ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label for="choose_time">When do you want to start tracking your finances from this account in Nsmartrac?</label>
                                    <span></span>
                                    <select name="choose_time" id="choose_time" class="form-control " required onchange="showdiv()">
                                            <option selected="selected" disabled="disabled">Choose one</option>
                                            <option value="Beginning of this year">Beginning of this year</option>
                                            <option value="Beginning of this month">Beginning of this month</option>
                                            <option value="Today">Today</option>
                                            <option value="Other" onclick="hidediv()">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-div" style="display: none;">
                                     <label for="balance">Balance</label>
                                    <input type="text" class="form-control" name="balance" id="balance" required
                                           placeholder="Enter Balance"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-date" style="display: none;">
                                     <label for="time_date">Date</label>
                                     <div class="col-xs-10 date_picker">
                                        <input type="text" class="form-control" name="time_date" id="time_date"
                                           placeholder="Enter Date" onchange="showdiv2()" autofocus/>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit"  name="save" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                                <div class="col-md-4 form-group">
                                    <a href="#" class="btn btn-flat btn-primary" onclick="closeAddaccount()">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
    </div>
    
    <!-- End Make account -->

<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
addCheck();
$(document).ready(function() {
        addCheck();
 });
function addCheck()
{
    jQuery("#side-menu-check-tx").addClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","100%");
    jQuery("#side-menu-check-tx").css("overflow-y","auto");
    jQuery("#side-menu-check-tx").css("overflow-x","hidden");
    jQuery("#overlay-check-tx").addClass("overlay");
}
function closeCheck() 
{
   
    jQuery("#side-menu-check-tx").removeClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","0%");
    jQuery("#overlay-check-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
     /* Variables */
    var p = 1;
    var row_check = $(".participantCheckRow");

    function addRowCheck() {
      row_check.clone(true, true).removeClass('Checkhide table-line').appendTo("#participantCheckTable");
      var index_check =$('#participantCheckTable tr').length -1;
      var final_index_check = index_check-1;
      $('#participantCheckTable tr:eq('+index_check+')').attr("onclick","trClickCheck("+final_index_check+")");
      $('#participantCheckTable tr:eq('+index_check+') td:eq(1)').text(index_check-2);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("id","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("name","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('div').attr("class","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("id","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("name","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('div').attr("class","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("id","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("name","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('div').attr("class","check_service_charge_"+final_index_check);
    }

    function removeRowCheck(buttoncheck) {
        console.log(buttoncheck.closest("tr").text());
      buttoncheck.closest("tr").remove();
      var totcheck = $('#checktotal').text().substr(9)-buttoncheck.closest("tr").find('td:eq(4)').text().trim();
      $('#checktotal').text('Total : $'+totcheck.toFixed(2));
      $('#checkamount').text('Amount : $'+totcheck.toFixed(2));
      if(buttoncheck.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttoncheck.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_check(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_check").on('click', function () {
      if($("#participantCheckTable tr").length < 17) {
        addRowCheck();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantCheckTable");
      if ($("#participantCheckTable tr").length === 3) {
        $(".remove_check").hide();
      } else {
        $(".remove_check").show();
      }
    });
    $(".remove_check").on('click', function () {
      if($("#participantCheckTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_check").hide();
      } else if($("#participantCheckTable tr").length - 1 ==3) {
        $(".remove_check").hide();
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantCheckTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowCheck();
        }
        $("#participantCheckTable #addButtonRow").appendTo("#participantCheckTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_check").on('click', function () {
      if($("#participantCheckTable tr").length - 1 >3) {
        x = 1;
        $('#participantCheckTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totcheck_clear = $('#checktotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#checktotal').text('Total : $'+totcheck_clear.toFixed(2));
                $('#checkamount').text('Amount : $'+totcheck_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });


    function trClickCheckMain()
    {
        if($('#check_expense_account').css("display")== 'none')
        {
            $('.check_expense_account').css('display','none');
            $('#check_expense_account').show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge').attr("type")== 'hidden')
        {
            $('.check_service_charge').css('display','none');
            $('#check_service_charge').removeAttr('type','hidden');
            $('#check_service_charge').attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp').attr("type")== 'hidden')
        {
            $('.check_descp').css('display','none');
            $('#check_descp').removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }

    function trClickCheck(index_check)
    {
        if($('#check_expense_account_'+index_check).css("display")== 'none')
        {
            $('.check_expense_account_'+index_check).css('display','none');
            $('#check_expense_account_'+index_check).show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge_'+index_check).attr("type")== 'hidden')
        {
            $('.check_service_charge_'+index_check).css('display','none');
            $('#check_service_charge_'+index_check).removeAttr('type','hidden');
            $('#check_service_charge_'+index_check).attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp_'+index_check).attr("type")== 'hidden')
        {
            $('.check_descp_'+index_check).css('display','none');
            $('#check_descp_'+index_check).removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }
    function rightclickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('.check_expense_account').text($('#check_expense_account').val());
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('.check_service_charge').text($('#check_service_charge').val());
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('.check_descp').text($('#check_descp').val());
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();

        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('.check_expense_account_'+i).text($('#check_expense_account_'+i).val());
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('.check_service_charge_'+i).text($('#check_service_charge_'+i).val());
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('.check_descp_'+i).text($('#check_descp_'+i).val());
            $('#check_descp_'+i).attr('type','hidden');
        }

        var total_check = 0;
       // total_check += parseInt($('.check_service_charge').text());
        for(var i = 2 ; i <= length_check ; i++)
        {
            if($('.check_service_charge_'+i).text() != '')
            {total_check += parseInt($('.check_service_charge_'+i).text());}
        }
        $('#checktotal').text('Total : $'+total_check.toFixed(2));
        $('#checkamount').text('Amount : $'+total_check.toFixed(2));
    }
    function crossClickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();
        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('#check_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
    $('#check_account_popup').on('change', function (e) {
          if($('#check_account_popup').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    function openAddAccount()
    {
        jQuery("#side-menu-account-tx").show();
        jQuery("#side-menu-account-tx").addClass("open-side-nav");
        jQuery("#side-menu-account-tx").css("width","50%");
        jQuery("#side-menu-account-tx").css("overflow-y","auto");
        jQuery("#side-menu-account-tx").css("overflow-x","hidden");
        jQuery("#overlay-account-tx").addClass("overlay");
    }
    function closeAddaccount() 
    {
        jQuery("#side-menu-account-tx").removeClass("open-side-nav");
        jQuery("#side-menu-account-tx").css("width","0%");
        jQuery("#overlay-account-tx").removeClass("overlay");
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.form-validate').validate();

        //Initialize Select2 Elements

        $('.select2').select2()

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

    })
    $('#account_type').on('change', function() {
      var account_id = this.value;
      if(account_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/chart_of_accounts/fetch_acc_detail') ?>",
            method: "POST",
            data: {account_id:account_id},
            success:function(data)
            {
                $("#detail_type").html(data);
            }
        })
      }
    });
       
    function showOptions(s) {
        var option_text = document.getElementById(s[s.selectedIndex].id).innerHTML;
        $('#name').val(option_text);
    }

    function check() {
      var x = document.getElementById("check_sub").checked;
      if(x == true)
      {
        $('#sub_account_type').removeAttr('disabled','disabled');
      }
      else
      {
        $('#sub_account_type').attr('disabled','disabled');
      }
    }

    function showdiv() {
        $('.hide-div').css('display','block');
        if($('#choose_time').find(":selected").text()=='Other')
        {
            $('.hide-div').css('display','none');
            $('.hide-date').css('display','block');
        }
        else
        {
            $('.hide-date').css('display','none');
        }
    }
    function showdiv2() {
        if($('.day').hasClass('active'))
        {
            $('.hide-div').css('display','block');
        }
        else
        {
            $('.hide-div').css('display','none');
        }
    }
    $(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
    });
</script>
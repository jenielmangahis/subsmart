<?php include viewPath('v2/includes/header'); ?>
<style>
.popover-holder .popover {
  background: #f3f3f3;
  border: 1px solid rgb(235, 235, 235);
  border-radius: 50%;
  color: #737373;
  position: relative;
  width: 15px;
  height: 15px;
  z-index: 9;
}

.popover-questionmark {
  margin: -2px 0px 3px 3px;
  font-size: 12px;
}

.popover {
  box-shadow: rgba(0, 0, 0, 0.3) 0 2px 10px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('cards_file/add_new'); ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage your credit cards on file.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(checkRoleCanAccessModule('cards-on-file', 'write')){ ?>
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_link" class="nsm-button primary btn-add-cards-file">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Card" style="width:85%;">Card</td>
                            <td data-name="Primary Card" class="text-center">Primary Card</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cardsFile)) : ?>
                            <?php foreach ($cardsFile as $c) : ?>
                                <?php
                                    $card_number = maskCreditCardNumber($c->card_number);

                                    $today = date("y-m-d");
                                    $day   = date("d");
                                    $expires = date("y-m-d", strtotime($c->expiration_year . "-" . $c->expiration_month . "-" . $day));
                                    $expired = 'expires';
                                    if (strtotime($expires) < strtotime($today)) {
                                        $expired = 'expired';
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        $card_type = strtolower($c->cc_type);
                                        $card_type = str_replace(" ", "", $card_type);

                                        if ($card_type == 'visa') {
                                            $card_icon = 'bxl-visa';
                                        } else if ($card_type == 'mastercard') {
                                            $card_icon = 'bxl-mastercard';
                                        }
                                        ?>
                                        <div class="table-row-icon">
                                            <i class='bx <?= $card_icon ?>'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">                                        
                                        <label class="d-block fw-bold"><?php echo $card_number; ?> (<?= $expired; ?> <?= $c->expiration_month . "/" . $c->expiration_year; ?>)</label>
                                        <?php if ($c->is_primary == 1) : ?>
                                            <label class="content-subtitle fst-italic d-block">This is the card used for membership and purchases.</label>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $is_checked = '';
                                        if ($c->is_primary == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <input class="form-check-input select-primary" type="checkbox" data-id="<?= $c->id; ?>" <?= $is_checked ?>>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('cards-on-file', 'write')){ ?>
                                                <li><a class="dropdown-item btn-edit-cards-file" name="dropdown_edit" data-id="<?= $c->id; ?>" href="javascript:void(0);">Edit</a></li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('cards-on-file', 'delete')){ ?>
                                                <li><a class="dropdown-item delete-item" name="dropdown_delete" data-card="<?= $card_number; ?>" href="javascript:void(0);" data-id="<?= $c->id; ?>">Delete</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else :?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Create cards file -->
            <div class="modal fade nsm-modal fade" id="modalCreateCardsFile" aria-labelledby="modalCreateCardsFileLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Create card on vault</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <?= form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-create-card-file', 'autocomplete' => 'off' ]); ?>
                        <div class="modal-body">
                            <div class="row">                                                                
                                <div class="col-md-12">
                                    <label for="">Your Name (as it appears on your card)</label><br/>
                                    <input type="text" required="" value="" placeholder="First Name" class="nsm-field form-control" name="card_owner_first_name" id="card_owner_first_name" required="" style="width: 49%;display:inline-block;">
                                    <input type="text" required="" value="" placeholder="Last Name" class="nsm-field form-control" name="card_owner_last_name" id="card_owner_last_name" style="width: 49%;display:inline-block;" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Card Number</label>
                                    <input type="text" required="" value="" class="nsm-field form-control" name="card_number" id="card_number" required="">
                                </div>  
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group" id="customer_type_group">
                                      <label for="">Expiration</label>
                                      <select name="expiration_month" class="form-control" required="">
                                        <option>- month -</option>
                                        <option value="01">01 - Jan</option>
                                        <option value="02">02 - Feb</option>
                                        <option value="03">03 - Mar</option>
                                        <option value="04">04 - Apr</option>
                                        <option value="05">05 - May</option>
                                        <option value="06">06 - Jun</option>
                                        <option value="07">07 - Jul</option>
                                        <option value="08">08 - Aug</option>
                                        <option value="09">09 - Sep</option>
                                        <option value="10">10 - Oct</option>
                                        <option value="11">11 - Nov</option>
                                        <option value="12">12  -Dec</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" id="customer_type_group">
                                      <label for=""><br /></label>
                                      <select name="expiration_year" class="nsm-field form-control" required="">
                                        <option>- year-</option>
                                        <?php for($x = date("Y"); $x <= date("Y",strtotime("+10 years")); $x++){ ?>
                                          <option value="<?= $x; ?>"><?= $x; ?></option>  
                                        <?php } ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="customer_type_group">
                                      <label for="">Card CVV <i id="help-popover-cvc" class="bx bx-fw bx-help-circle"></i>
                                    <div class="hide" id="help-popover-cvc-content" style="display: none;margin-bottom: 20px;">
                                      <span class="help"> Please insert your card security number/CVV number. For all cards, except American Express, this is the <b>last 3 digits on the back of your card</b>. For American Express, this is the <b>4 digits printed on the front of your card</b>, above the 15 digit card number.</span><br> <img src="<?= base_url("assets/img/cvv.png"); ?>">
                                    </div></label>
                                      <input type="text" required="" maxlength="4" value="" class="nsm-field form-control" name="card_cvv" id="card_cvv" required="">
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_create_sms_template" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary btn-create-card-file">Save</button>
                        </div>
                        <?= form_close(); ?>                    
                    </div>
                </div>
            </div>

            <!-- Edit card file -->
            <div class="modal fade nsm-modal fade" id="modalEditCardsFile" aria-labelledby="modalEditCardsFileLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit card on vault</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <?= form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-update-card-file', 'autocomplete' => 'off' ]); ?>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button name="btn_close_create_sms_template" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary btn-update-card-file">Save</button>
                        </div>
                        <?= form_close(); ?>                    
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $('#help-popover-cvc').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return $('#help-popover-cvc-content').html();
            } 
        });  

        $(document).on("change", ".select-primary", function() {
            let id = $(this).attr("data-id");
            let primary = $(this).prop("checked") ? 1 : 0;
            let url = "<?php echo base_url('cards_file/_update_primary_card'); ?>";

            $(".select-primary").not(this).prop("checked", false);
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {
                    id: id,
                    primary: primary
                },
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Success',
                            text: "Primary card was updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });

                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                }
            });
        });

        $("#frm-create-card-file").submit(function(e){
            e.preventDefault();
            var url = base_url + 'cards_file/_create_card_vault';
            $(".btn-create-card-file").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#frm-create-card-file").serialize(),
                     dataType: 'json',
                     success: function(o)
                     {
                        if( o.is_success == 1 ){
                            $('#modalCreateCardsFile').modal('hide');
                            Swal.fire({
                                title: 'Card on Vault',
                                text: 'Data was successfully created.',
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
                              title: 'Cannot save data.',
                              text: o.msg
                            });
                        }

                        $(".btn-create-card-file").html('Save');
                     }
                });
            }, 300);        
        });

        $("#frm-update-card-file").submit(function(e){
            e.preventDefault();
            var url = base_url + 'cards_file/_update_card_vault';
            $(".btn-update-card-file").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#frm-update-card-file").serialize(),
                     dataType: 'json',
                     success: function(o)
                     {
                        if( o.is_success == 1 ){
                            $('#modalEditCardsFile').modal('hide');
                            Swal.fire({
                                title: 'Card on Vault',
                                text: 'Data was successfully updated.',
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
                              title: 'Cannot save data.',
                              text: o.msg
                            });
                        }

                        $(".btn-update-card-file").html('Save');
                     }
                });
            }, 300);        
        });
    });

    $(document).on('click','.btn-add-cards-file', function(){
        $('#modalCreateCardsFile').modal('show');
    });

    $(document).on('click', '.btn-edit-cards-file', function(){
        var cvid = $(this).data('id');
        var url = base_url + 'cards_file/_edit_card_vault';

        $('#modalEditCardsFile').modal('show');
        $("#modalEditCardsFile .modal-body").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {cvid:cvid},
             success: function(o)
             {          
                $('#modalEditCardsFile .modal-body').html(o);
             }
          });
        }, 800);
        
    });

    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');
        let card_number = $(this).attr('data-card');

        Swal.fire({
            title: 'Delete Card',
            html: `Are you sure you want to delete credit card number <b>${card_number}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "cards_file/_delete_credit_card",
                    data: {
                        cid: id
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Success',
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Cannot find record',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
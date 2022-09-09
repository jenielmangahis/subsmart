<?php include viewPath('v2/includes/header'); ?>

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
                            Listing all your credit cards saved on file.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_link" class="nsm-button primary" onclick="location.href='<?php echo base_url('cards_file/add_new'); ?>'">
                                <i class='bx bx-fw bx-credit-card'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Card">Card</td>
                            <td data-name="Card Holder">Card Holder</td>
                            <td data-name="Primary Card">Primary Card</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($cardsFile)) :
                        ?>
                            <?php
                            foreach ($cardsFile as $c) :
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
                                        <label class="d-block fw-bold"><?php echo $card_number; ?> (<?= $expired; ?> <?= $c->expiration_month . "/" . $c->expiration_year; ?>)</label>
                                        <?php if ($c->is_primary == 1) : ?>
                                            <label class="content-subtitle fst-italic d-block">This is the card used for membership and purchases.</label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $c->card_owner_first_name . " " . $c->card_owner_last_name; ?></td>
                                    <td>
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
                                                <li>
                                                    <a class="dropdown-item" name="dropdown_edit" href="<?php echo url('cards_file/edit/' . $c->id) ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-id="<?= $c->id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

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
                            text: 'An error occured. Try again later.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                }
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Card',
                text: "Are you sure you want to delete this card?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('cards_file/delete_card'); ?>",
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
                                    if (result.value) {
                                        location.reload();
                                    }
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
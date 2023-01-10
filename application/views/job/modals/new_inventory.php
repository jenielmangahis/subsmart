<!-- Items Modal -->
<div class="modal fade" id="new_inventory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1000px !important;">
        <div class="modal-content INVENTORY_FORM_CONTENT">
            <!-- <form id="new_inventory_form"> -->
                <div class="modal-body">
                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary INVENTORY_MODAL_CANCEL" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.INVENTORY_FORM_CONTENT').load('<?php echo base_url("/inventory/add"); ?> .GET_INVENTORY_FORM_UI', function(){
        $('.CANCEL_BUTTON_INVENTORY').attr('onclick', '$("#new_inventory").modal("hide");');
        $("#inventory_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/inventory/save_new_item",
                data: form.serialize(), // serializes the form's elements.
            });
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Item was added successfully!',
            }).then((result) => {
                // if (result.isConfirmed) {
                    $("#new_inventory").modal("hide");
                // }
            });
        });
    });
    
</script>

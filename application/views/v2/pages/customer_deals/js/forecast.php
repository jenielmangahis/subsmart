<script type="text/javascript">
$(function(){
    load_calendar();

    $("#customer-deal-lost").droppable({
        accept: ".deal-month-item",
        hoverClass: "lost-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);
            let deal_id = item.attr('data-id');
            let status  = 'Lost';
            if( deal_id > 0 ){
                let html_content = `
                    <div class="row mark-lost-form">
                        <div class="col-sm-12">
                            <label class="mb-2">Lost Reason</label>
                            <div class="input-group mb-3">
                                <select class="form-select select-lost-reason" id="lost-reason">
                                <?php foreach( $optionLostReasons as $reason ){ ?>
                                    <option value="<?= $reason; ?>"><?= $reason; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Comments</label>
                            <div class="input-group mb-3">
                                <textarea id="lost-comment" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>Manage lost reasons in <a class="nsm nsm-link" href="<?= base_url('customer/customer_deal_lost_reasons') ?>">Customer Settings</a></p>
                        </div>
                    </div>
                `;       

                Swal.fire({
                    title: 'Mark as lost',
                    html: html_content,
                    icon: false,
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    confirmButtonText: 'Mark as lost',                    
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let lost_reason  = $('#lost-reason').val();
                        let lost_comment = $('#lost-comment').val();
                        $.ajax({
                            type: "POST",
                            url: base_url + "customer_deals/_update_customer_deal_status",
                            data:{deal_id:deal_id, lost_reason:lost_reason, lost_comment:lost_comment, status:status},
                            dataType:'json',
                            success: function(result) {                            
                                if( result.is_success == 1 ) {
                                    ui.draggable.remove();
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Mark as lost',
                                    text: 'Customer deal was updated successfully.',
                                    }).then((result) => {
                                        load_calendar();
                                    });
                                } else {
                                    ui.draggable.draggable('option','revert',true); 
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            }
                        });
                    }
                });
            }
        }
    });

    $("#customer-deal-won").droppable({
        accept: ".deal-month-item",
        hoverClass: "won-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);
            let deal_id = item.attr('data-id');
            let status  = 'Won';
            if( deal_id > 0 ){
                $.ajax({
                    type: "POST",
                    url: base_url + "customer_deals/_update_customer_deal_status",
                    data:{deal_id:deal_id, status:status},
                    dataType:'json',
                    success: function(data) {    
                        load_calendar();

                        Swal.fire({
                        icon: 'success',
                        text: 'Customer deals was successfully updated.',
                        }).then((result) => {                            
                            //e.params.args.originalEvent.currentTarget.remove();
                        });
                    },
                    beforeSend: function() {
                        
                    }
                });
            }
            ui.draggable.remove();
        }
    });

    $("#customer-deal-delete").droppable({
        accept: ".deal-month-item",
        hoverClass: "delete-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);            
            let customer_deal_id = item.attr('data-id');
            let deal_title = item.attr('data-name');

            Swal.fire({
                title: 'Delete Customer Deal',
                html: `Are you sure you want to delete customer deal <b>${deal_title}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer_deals/_delete_customer_deal",
                        data: {customer_deal_id:customer_deal_id},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                ui.draggable.remove();
                                Swal.fire({
                                icon: 'success',
                                title: 'Delete Customer Deal',
                                text: 'Customer deal was successfully deleted.',
                                }).then((result) => {
                                    load_calendar();
                                });
                            } else {
                                ui.draggable.draggable('option','revert',true); 
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        }
    });
        
    function load_calendar(){        
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_forecast_view",
            success: function(html) {    
                $('#deal-forecast').html(html);
            },
            beforeSend: function() {
                $('#deal-forecast').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    }
});
</script>
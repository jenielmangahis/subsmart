<div class="modal fade" id="addSms" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addSmsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title nsm-text">Sms Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <form id='smsForm'>
                        <div class="col-12">
                            <textarea name="sms_message" id="sms_automation_msg" cols="30" rows="2" class="form-control ckeditor"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="smsForm" class="nsm-button primary">
                    <i class='bx bx-fw bx-check'></i> Save and close
                </button>
            </div>
        </div>
    </div>
</div>
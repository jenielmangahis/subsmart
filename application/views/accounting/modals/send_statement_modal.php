<!-- Modal for customize email -->
<div id="showEmailModal" class="modal fade modal-fluid" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                <h4 class="modal-title">Send Statement</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <?php if(isset($email)) : ?>
                        <p>Email</p>
                        <p><?= $email ?></p>
                        <?php else : ?>
                        <p>You are sending <?= $customer_count ?> statements. Please compose your message below.</p>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" value="Statement from <?= $company_name ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="email-body">Body</label>
                            <textarea name="body" id="email-body" class="form-control" style="height: 265px !important">
<?php if(isset($customer_name)) : ?>
Dear <?= $customer_name ?>,

<?php endif; ?>
Your statement is attached.  Please remit payment at your earliest convenience.
Thank you for your business - we appreciate it very much.

Thanks for your business!
<?= $company_name; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <iframe id="showPdf" src="/accounting/show-pdf?pdf=<?= $filename ?>" frameborder="0" style="width: 100%;    height: 700px;"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <div class="row w-100">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="submit" class="nsm nsm-button primary float-right" style="border:none;">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function closeModal() {
        $('#sendEmailModal').modal('hide'); 
    }

    CKEDITOR.replace( 'email-body', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '265px',
    });
</script>
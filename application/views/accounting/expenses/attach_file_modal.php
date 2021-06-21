<!-- Select category modal -->
<div class="modal fade" id="attach_file_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto" role="document" style="width: 40%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Attachments</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form id="attach-file-form" action="/accounting/expenses/attach/<?=$transactionType?>/<?=$id?>" method="post">
            <div class="modal-body" style="max-height: 800px;">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0">
                            <div class="card-body" style="padding-bottom: 1.25rem">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="attachments pb-3 border-bottom">
                                            <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                            <span>Maximum size: 20MB</span>
                                            <div id="bill-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                <div class="dz-message" style="margin: 20px;border">
                                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Attach existing</h5>
                                        <div class="form-group w-50">
                                            <select id="attachments-filter" class="form-control">
                                                <option value="unlinked">Unlinked</option>
                                                <option value="all">All</option>
                                            </select>
                                        </div>

                                        <div class="row attachments-container">
                                            <?php foreach($attachments as $attachment) : ;?>
                                                <div class="col-md-3">
                                                    <div class="card border p-0">
                                                        <img class="card-img-top m-0" src="/uploads/accounting/attachments/<?=$attachment['stored_name']?>" alt="<?=$attachment['uploaded_name'].'.'.$attachment['file_extension']?>">
                                                        <div class="card-body p-2">
                                                            <h6 class="card-title"><?=$attachment['uploaded_name'].'.'.$attachment['file_extension']?></h6>
                                                            <p class="card-subtitle mb-2 text-muted"><?=date("m/d/Y", strtotime($attachment['created_at']))?></p>
                                                            <ul class="d-flex justify-content-around">
                                                                <li><a href="#" class="text-info attach-to-transaction" data-id="<?=$attachment['id']?>">Add</a></li>
                                                                <li><a href="/uploads/accounting/attachments/<?=$attachment['stored_name']?>" target="_blank" class="text-info">Preview</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end select category modal -->
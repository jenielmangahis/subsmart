<div class="modal fade nsm-modal fade" id="quick_links_modal" tabindex="-1" aria-labelledby="quick_links_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_links_modal_label">Quick Links</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row shortcut-container mb-0">
                    <div class="col-4 col-md-3">
                        <div class="shortcut-item print-check">
                            <div class="nsm-list-icon success">
                                <i class='bx bx-printer'></i>
                            </div>
                            <label class="content-subtitle">Print a Check</label>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="shortcut-item process-payment">
                            <div class="nsm-list-icon">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            <label class="content-subtitle">Process Payment</label>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="shortcut-item receive-payment">
                            <div class="nsm-list-icon secondary">
                                <i class='bx bx-wallet'></i>
                            </div>
                            <label class="content-subtitle">Receive Payments</label>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="shortcut-item" onclick="location.href='<?= base_url('invoice/add') ?>'">
                            <div class="nsm-list-icon default">
                                <i class='bx bx-detail'></i>
                            </div>
                            <label class="content-subtitle">Add Invoice</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="nsm-button primary">Save</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_feed_modal" tabindex="-1" aria-labelledby="new_feed_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-feeds">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label"><i class="bx bx-fw bx-comment"></i> Create News Feed</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Title" name="feed_subject" id="feedSubject" class="nsm-field form-control mb-2" required />
                        <textarea style="height:130px;" name="feed_message" id="feedMessage" class="form-control" placeholder="Message" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="news_letter_modal" tabindex="-1" aria-labelledby="news_letter_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="news_letter_modal_label"><i class="bx bx-fw bx-news"></i> Create News Letter</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-newsletter" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Title" name="news_subject" id="news-subject" class="nsm-field form-control mb-2" required />
                            <textarea style="height:130px;" class="form-control mb-2" name="news_content" id="news-content" placeholder="News Bulletin" required></textarea>
                            <input class="float-left" id="file" name="newsletter_file" type="file" value="Upload File" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modalTaskHubList" tabindex="-1" aria-labelledby="modalTaskHubListLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label"><i class='bx bx-task'></i> Taskhub List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body modal-taskhub-list-container" style="max-height:600px; overflow-y: auto;overflow-x: hidden;"></div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modalAddTaskHub" tabindex="-1" aria-labelledby="modalAddTaskHubLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label"><i class='bx bx-plus-medical' ></i> Add New Task</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form action="" id="frm-add-new-task">
            <div class="modal-body modal-add-new-task-container"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary btn-save-task">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modalViewNewsLetter" tabindex="-1" aria-labelledby="modalViewNewsLetterLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="newsletter_modal_label"><i class="bx bx-fw bx-news"></i> Newsletter</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="modal-view-newsletter-container"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modalConnectAdtPortal" tabindex="-1" aria-labelledby="modalTaskHubListLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">            
            <div class="modal-body"><span class="adt-connect-msg"></span></div>            
        </div>
    </div>
</div>
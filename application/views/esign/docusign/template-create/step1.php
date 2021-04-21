<h1 class="title text-capitalize" id="pageTitle">New Template</h1>
<form class="form" id="templateForm" style="min-width: 800px;">
    <div id="templateInfo">
        <h2 class="form__title">Template Name and Description</h2>

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Template Description (optional)"></textarea>
        </div>

        <div class="docusignTemplateCreate__spacer"></div>
    </div>


    <div id="templateDocument">
        <h2 class="form__title">Add Document</h2>
        <div class="form-group">
            <div class="fileupload">
                <div class="custome-fileup">
                    <div class="upload-btn-wrapper">
                        <button type="button" class="btn">
                            <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                            <span>Upload</span>
                        </button>
                        <input multiple type="file" name="docFile" id="docFile" accept="application/pdf,application/vnd.ms-excel" required="">
                    </div>
                </div>
            </div>
        </div>

        <div class="docusignTemplateCreate__spacer"></div>
    </div>

    <div>
        <h2 class="form__title">Add Recipients</h2>
        <p>As the sender, you automatically receive a copy of the completed envelope.</p>

        <div id="setup-recipient-list"></div>

        <button type="button" class="btn btn-sm btn-secondary" id="add-recipient-button">
            <i class="fa fa-user-plus mr-1"></i>Add Recipient
        </button>

        <div class="docusignTemplateCreate__spacer"></div>
    </div>

    <div>
        <h2 class="form__title">Message to All Recipients</h2>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input class="form-control" id="subject" placeholder="Please Docusign:" maxlength="100">
            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">100</span></small>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="3" placeholder="Enter Message" maxlength="10000"></textarea>
            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">10000</span></small>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary d-flex align-items-center">
            <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text">Next</span>
        </button>
    </div>
</form>

<div class="modal fillAndSign__modal" id="documentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column"></div>
        </div>
    </div>
</div>
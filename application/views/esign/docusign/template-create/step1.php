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
            <div class="fileupload" id="sortable">
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
            <input class="form-control" id="subject" placeholder="Please eSign:" maxlength="100">
            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">100</span></small>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="3" placeholder="Enter Message" maxlength="10000"></textarea>
            <small class="form-text text-muted d-none">Characters remaining: <span class="limit">10000</span></small>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a id="discardChanges" href="<?php echo base_url('vault/mylibrary') ?>" class="btn btn-secondary align-items-center mr-1 d-none">
            Discard Changes
        </a>

        <button id="saveandclose" type="button" class="btn btn-secondary align-items-center mr-1 d-none">
            <div class="spinner-border spinner-border-sm mt-0 mr-1 d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text">Save And Close</span>
        </button>

        <button id="copylink" type="button" class="btn btn-secondary align-items-center mr-1 d-none">
            <span class="text" data-default-text="Copy Link"></span>
        </button>

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

<div class="modal fade" id="deleteRecipient" tabindex="-1" role="dialog" aria-labelledby="deleteRecipientLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="deleteRecipientLabel">Delete Recipient</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
         <p>This recipient has <span class="total-fields">0</span> assigned fields. By deleting this recipient, you will also delete their fields. Would you like to delete the recipient and fields?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary">Delete</button>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteDocument" tabindex="-1" role="dialog" aria-labelledby="deleteDocumentLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="deleteDocumentLabel">Delete Document</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
         <p>Are you sure you want to delete this document? All <span class="total-fields">0</span> fields will be lost.</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary">Delete</button>
		</div>
		</div>
	</div>
</div>

<script>
  (() => {
    const urlParams = new URLSearchParams(window.location.search);
    const customerId = urlParams.get("customer_id");
    const $copyLink = document.getElementById("copylink");
    const $text = $copyLink.querySelector(".text");

    const linkText = $text.dataset.defaultText;
    $text.textContent = linkText;

    if (!customerId) {
      $copyLink.classList.add("d-none");
    } else {
      $copyLink.classList.remove("d-none");
    }
    
    $copyLink.addEventListener("click", () => {
      $text.textContent = "Copied!";
      window.navigator.clipboard.writeText(window.location.href);

      window.setTimeout(() => {
        $text.textContent = linkText;
      }, 300);
    });
  })();
</script>
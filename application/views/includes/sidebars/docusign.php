<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #32243d;
        padding: 20px;
        margin-bottom: 0px;
        color: #45a73c;
    }
    div[role="wrapper"] .navbar-side {
        background-color: #32243d;
    }
    ul.nav li.submenus:hover {
        background: #45a73c;
        background: -moz-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: -webkit-linear-gradient(top, #45a73c 0%,#67ce5e 100%);
        background: linear-gradient(to bottom, #45a73c 0%,#67ce5e 100%);
    }
    div[role="wrapper"] .navbar-side .nav li > a {
        color: #fff;
        text-align: left;
    }
    img.company-logo {
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin: 0 auto;
      max-height: 120px;
      border-radius: 69px;
    }
    /* svg#svg-sprite-menu-close {
      position: relative;
      bottom: 64px;
    } */
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav">

        <span class="nav-close">
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%">
                <path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path>
            </svg>
        </span>

        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">
            <img src="<?=getCompanyBusinessProfileImage();?>" class="company-logo"/>
        </li>

        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">DOCUSIGN</li>

        <li class="submenus">
            <a href="<?=base_url('esign/Files')?>" title="Send Envelope">
            <span class="fa fa-envelope"></span>Send envelope</a>
        </li>

        <li class="submenus" id="signadocument">
            <a href="#" title="Sign a document">
            <span class="fa fa-pencil"></span>Sign a document</a>
        </li>

        <li class="submenus">
            <a href="<?=base_url('eSign/manage?view=inbox')?>" title="Inbox">
            <span class="fa fa-inbox"></span>Inbox</a>
        </li>

        <li class="submenus">
            <a href="<?=base_url('eSign/manage?view=sent')?>" title="Sent">
            <span class="fa fa-send"></span>Sent</a>
        </li>

        <li class="submenus">
            <a href="<?=base_url('eSign/manage?view=drafts')?>" title="Drafts">
            <span class="fa fa-pencil"></span>Drafts</a>
        </li>

        <li class="submenus">
            <a href="<?=base_url('eSign/manage?view=deleted')?>" title="Deleted">
            <span class="fa fa-trash"></span>Deleted</a>
        </li>

        <li class="submenus">
            <a href="<?=base_url('eSign/manage?view=action_required')?>" title="Action Required">
            <span class="fa fa-info-circle"></span></span>Action Required</a>
        </li>
    </ul>
</nav>

<div class="modal fade" id="selectDocument" tabindex="-1" role="dialog" aria-labelledby="selectDocumentLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width: 802px;">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="selectDocumentLabel">Sign a document</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
            <div class="fileupload">
                <div class="custome-fileup">
                    <div class="upload-btn-wrapper">
                        <button class="btn">
                            <img src="https://localhost/nsmartrac/assets/esign/images/fileup-ic.png" alt="">
                            <span>Upload</span>
                        </button>
                        <input multiple="" type="file" name="docFile" id="docFile" accept="application/pdf,application/vnd.ms-excel" required="">
                    </div>
                </div>
            </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary d-flex align-items-center">
				<div class="spinner-border spinner-border-sm m-0 d-none" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<span class="ml-1">Sign</span>
			</button>
		</div>
		</div>
	</div>
</div>

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
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
            <div class="d-flex fileupload">
                <div class="custome-fileup">
                    <div class="upload-btn-wrapper">
                        <button type="button" class="btn">
                            <img src="<?php echo $url->assets ?>esign/images/fileup-ic.png" alt="">
                            <span>Upload</span>
                        </button>
                        <input type="file" name="docFile" id="docFile" accept="application/pdf,application/vnd.ms-excel" required="">
                    </div>
                </div>

                <div class="ml-3 esignBuilder__docPreview d-none">
                    <canvas></canvas>
                    <div class="esignBuilder__docInfo">
                        <h5 class="esignBuilder__docTitle"></h5>
                        <span class="esignBuilder__docPageCount"></span>
                    </div>

                    <div class="esignBuilder__uploadProgress" width="100%">
                        <span></span>
                    </div>

                    <div class="esignBuilder__uploadProgressCheck">
                        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>Check</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                            </g>
                        </svg>
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
            <div class="modal-body"></div>
        </div>
    </div>
</div>
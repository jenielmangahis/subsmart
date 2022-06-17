<?php include viewPath('v2/includes/header');?>

<div class="ss-loader">
    <span>Loading...</span>
</div>

<div class="row page-content g-0">
    <div class="nsm-page">
        <div class="nsm-page-content">
            <div class="row">
                <div class="col-12 col-md-8 grid-mb">
                    <button role="button" class="nsm-button" id="slidesharecreate">
                        <i class="bx bx-fw bx-video-plus"></i> Create
                    </button>
                </div>

                <div class="col-12 col-md-4 text-end">
                    <form>
                        <div class="nsm-field-group search">
                            <input type="search" class="nsm-field nsm-search form-control mb-2" name="search" placeholder="Search" id="slidesharesearch" />
                        </div>
                    </form>
                </div>
            </div>


            <table class="nsm-table" id="slidesharetable">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>
                        <td>Size</td>
                        <td>Uploaded At</td>
                        <td class="cell-shrink">Actions</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="slidesharemodalpreview">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body" style="min-height: 200px;">

        <div class="video-wrapper mb-2">
          <video controls class="video video-js vjs-default-skin" preload="none" data-setup="{}">
            <source src=".mp4" type="video/mp4" />
            <p class="vjs-no-js">
              To view this video please enable JavaScript, and consider upgrading to a
              web browser that
              <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
          </video>
        </div>

        <div class="description"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="slidesharemodalcreate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" data-text-default="Upload Demo"></h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="slidesharcreateform">
          <div class="form-group mb-3 upload-group">
            <label class="content-subtitle fw-bold mb-2" for="ss-file">File</label>
            <div role="button" class="nsm-button ss-upload-btn">
              <i class="bx bx-fw bx-video-plus"></i> <span class="text" data-text-default="Select File"></span>
              <input required data-type="name" id="ss-file" />
            </div>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group mb-3">
            <label class="content-subtitle fw-bold mb-2" for="ss-name">Name</label>
            <input required data-type="display_name" class="form-control" id="ss-name" placeholder="Enter name">
          </div>
          <div class="form-group mb-3">
            <label class="content-subtitle fw-bold mb-2" for="ss-description">Description</label>
            <textarea data-type="description" class="form-control" id="ss-description" rows="3" placeholder="Enter description"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="nsm-button" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="slidesharcreateform" class="nsm-button primary" data-text-default="Save">Save</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

<link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>

<link rel="stylesheet" href="<?=base_url("assets/css/university/slideshare.css")?>">
<script type="module"  src="<?=base_url("assets/js/university/slideshare.js")?>"></script>
<script type="module"  src="<?=base_url("assets/js/university/plupload.full.min.js")?>"></script>
<?php include viewPath('v2/includes/footer');?>
<div class="modal fade wo-signatureModal nsm-modal" tabindex="-1" role="dialog" id="company-representative-approval-signature">
  <div class="modal-dialog modal-lg mobileHeight" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Company Representative Approval</h5>
        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
        </div>

        <div class="canvas-wrapper">
            <canvas></canvas>
            <span class="canvas-placeholder">sign here</span>
        </div>

        <div class="d-flex justify-content-end">
            <a class="link" href="#" data-action="clear">Clear</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-action="save">Add signature</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade wo-signatureModal nsm-modal" tabindex="-1" role="dialog" id="primary-account-holder-signature">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Company Representative Approval</h5>
        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
        </div>

        <div class="canvas-wrapper">
            <canvas></canvas>
            <span class="canvas-placeholder">sign here</span>
        </div>

        <div class="d-flex justify-content-end">
            <a class="link" href="#" data-action="clear">Clear</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-action="save">Add signature</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade wo-signatureModal nsm-modal" tabindex="-1" role="dialog" id="secondary-account-holder-signature">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Company Representative Approval</h5>
        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
        </div>

        <div class="canvas-wrapper">
            <canvas></canvas>
            <span class="canvas-placeholder">sign here</span>
        </div>

        <div class="d-flex justify-content-end">
            <a class="link" href="#" data-action="clear">Clear</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-action="save">Add signature</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>
  .wo-signatureModal canvas {
    width: 100%;
    border: 1px solid #e4e4e4;
    position: relative;
    z-index: 1;
  }

  .wo-signatureModal .modal-body {
    display: flex;
    flex-direction: column;
  }

  .wo-signatureModal .canvas-wrapper {
    flex-grow: 1;
    position: relative;
  }

  .wo-signatureModal .canvas-wrapper.is-loading::after {
    content: "Loading...";
    font-size: 13px;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    background-color: #fff;
    color: #b6b6b6;
  }

  .wo-signatureModal .canvas-wrapper.has-content .canvas-placeholder {
    opacity: 0;
  }

  .wo-signatureModal .canvas-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    color: #e9e9e9;
    text-transform: uppercase;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
    opacity: 1;
  }

  @media (max-width: 768px) {
    .wo-signatureModal .modal-dialog {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      max-width: unset;
    }

    .wo-signatureModal .modal-content {
      height: auto;
      min-height: 100%;
      border-radius: 0;
    }
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js" integrity="sha512-e2WVdoOGqKU97DHH6tYamn+eAwLDpyHKqPy4uSv0aGlwDXZKGwyS27sfiIUT8gpZ88/Lr4UZpbRt93QkGRgpug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  window.addEventListener('DOMContentLoaded', (event) => {
    const modalIds = [
      'company-representative-approval-signature',
      'primary-account-holder-signature',
      'secondary-account-holder-signature'
    ];

    const onSaveModal = {
      'company-representative-approval-signature': (signature) => {
        const $wrapper = document.getElementById("companyrep");
        const $wrapperField = document.getElementById("company_representative_div");
        $($wrapper).html(`<br><img src="${signature}">`);
        $($wrapperField).html(`<input type="hidden" name="company_representative_approval_signature1aM_web" value="${signature}">`);
        // $("#company_representative_approval_signature1aM_web").val(signature);
        // alert(signature);wrapperField
      },
      'primary-account-holder-signature': (signature) => {
        const $wrapper = document.getElementById("primaryrep");
        const $wrapperField = document.getElementById("primary_representative_div");
        $($wrapper).html(`<br><img src="${signature}">`);
        $($wrapperField).html(`<input type="hidden" name="primary_representative_approval_signature1aM_web" value="${signature}">`);
      },
      'secondary-account-holder-signature': (signature) => {
        const $wrapper = document.getElementById("secondaryrep");
        const $wrapperField = document.getElementById("secondary_representative_div");
        $($wrapper).html(`<br><img src="${signature}">`);
        $($wrapperField).html(`<input type="hidden" name="secondary_representative_approval_signature1aM_web" value="${signature}">`);
      },
    };

    modalIds.forEach(modalId => {
      const $modal = document.getElementById(modalId);
      const config = {
        onSave: (signature) => {
          onSaveModal[modalId](signature);
          $($modal).modal("hide");
        }
      };

      initSignatureModal($modal, config);
    })









    function initSignatureModal($modal, config = {}) {
        const $canvasWrapper = $modal.querySelector(".canvas-wrapper");
        const $canvas = $canvasWrapper.querySelector("canvas");
        const $placehoder = $modal.querySelector(".canvas-placeholder");

        toggleLoader();
        let signaturePad = new SignaturePad($canvas);

        $($modal).on("shown.bs.modal", () => {
          toggleLoader();

          const { height, width } = window.getComputedStyle($canvasWrapper);
          $canvas.setAttribute("height", height);
          $canvas.setAttribute("width", width);
          signaturePad = new SignaturePad($canvas);

          $($placehoder).fitText();

          if ($canvas.dataset.prev && $canvas.dataset.prev.length) {
              signaturePad.fromDataURL($canvas.dataset.prev);
          }

          toggleLoader(false);
        });

        $($modal).on("hidden.bs.modal", () => {
          // Remember signature state, on close modal. Still buggy, so will reset for now. :/
          // $canvas.setAttribute("data-prev", getSignatureUrl($canvas, false));

          clearCanvas();
          toggleLoader();

          $canvas.removeAttribute("height");
          $canvas.removeAttribute("width");
        });

        const $save = $modal.querySelector("[data-action=save]");
        $save.addEventListener("click", (event) => {
          if (config.onSave && typeof config.onSave === "function") {
            config.onSave(getSignatureUrl($canvas));
          }
        });

        const $clear = $modal.querySelector("[data-action=clear]");
        $clear.addEventListener("click", (event) => {
          event.preventDefault();
          clearCanvas();
        });

        signaturePad.onBegin = () => {
          $canvasWrapper.classList.add("has-content");
        };

        function clearCanvas() {
          signaturePad.clear();
          $canvasWrapper.classList.remove("has-content");
        }

        function toggleLoader(isShown = true) {
          if (isShown) {
            $canvasWrapper.classList.add("is-loading");
          } else {
            $canvasWrapper.classList.remove("is-loading");
          }
        }
    }

    function getSignatureUrl($canvas, shouldTrim = true) {
      if (isCanvasBlank($canvas)) return '';

      const $clonedCanvas = cloneCanvas($canvas);
      if (shouldTrim) {
        trimCanvas($clonedCanvas.getContext("2d"));
      }

      return $clonedCanvas.toDataURL("image/png");
    }

    // https://stackoverflow.com/a/17386803/8062659
    function isCanvasBlank(canvas) {
        return !canvas
            .getContext("2d")
            .getImageData(0, 0, canvas.width, canvas.height)
            .data.some((channel) => channel !== 0);
    }

    // https://stackoverflow.com/a/45873660/8062659
    function trimCanvas(ctx) {
        // removes transparent edges
        var x, y, w, h, top, left, right, bottom, data, idx1, idx2, found, imgData;
        w = ctx.canvas.width;
        h = ctx.canvas.height;
        if (!w && !h) {
            return false;
        }
        imgData = ctx.getImageData(0, 0, w, h);
        data = new Uint32Array(imgData.data.buffer);
        idx1 = 0;
        idx2 = w * h - 1;
        found = false;
        // search from top and bottom to find first rows containing a non transparent pixel.
        for (y = 0; y < h && !found; y += 1) {
            for (x = 0; x < w; x += 1) {
            if (data[idx1++] && !top) {
                top = y + 1;
                if (bottom) {
                // top and bottom found then stop the search
                found = true;
                break;
                }
            }
            if (data[idx2--] && !bottom) {
                bottom = h - y - 1;
                if (top) {
                // top and bottom found then stop the search
                found = true;
                break;
                }
            }
            }
            if (y > h - y && !top && !bottom) {
            return false;
            } // image is completely blank so do nothing
        }
        top -= 1; // correct top
        found = false;
        // search from left and right to find first column containing a non transparent pixel.
        for (x = 0; x < w && !found; x += 1) {
            idx1 = top * w + x;
            idx2 = top * w + (w - x - 1);
            for (y = top; y <= bottom; y += 1) {
            if (data[idx1] && !left) {
                left = x + 1;
                if (right) {
                // if left and right found then stop the search
                found = true;
                break;
                }
            }
            if (data[idx2] && !right) {
                right = w - x - 1;
                if (left) {
                // if left and right found then stop the search
                found = true;
                break;
                }
            }
            idx1 += w;
            idx2 += w;
            }
        }
        left -= 1; // correct left
        if (w === right - left + 1 && h === bottom - top + 1) {
            return true;
        } // no need to crop if no change in size
        w = right - left + 1;
        h = bottom - top + 1;
        ctx.canvas.width = w;
        ctx.canvas.height = h;
        ctx.putImageData(imgData, -left, -top);
        return true;
    }

    // https://stackoverflow.com/a/8306028/8062659
    function cloneCanvas(oldCanvas) {
        //create a new canvas
        var newCanvas = document.createElement("canvas");
        var context = newCanvas.getContext("2d");

        //set dimensions
        newCanvas.width = oldCanvas.width;
        newCanvas.height = oldCanvas.height;

        //apply the old canvas to the new one
        context.drawImage(oldCanvas, 0, 0);

        //return the new canvas
        return newCanvas;
    }
  });
</script>

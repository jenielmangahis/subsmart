let pdfDoc = null,
  pageNum = 1,
  pageIsRendering = false,
  pageNumIsPending = null;
pdfjsLib.GlobalWorkerOptions.workerSrc =
  "//mozilla.github.io/pdf.js/build/pdf.worker.js";

// Render the page
const renderPage = (num, status) => {
  pageIsRendering = true;
  //min-height: 170.824px;

  if (status == 1) {
    $("#main-pdf-render").append(
      '<canvas class="document-page" id="pdf-render-' + num + '" ></canvas>'
    );
    const scale = 1.5,
      canvas = document.querySelector("#pdf-render-" + num),
      canvasPreview = document.querySelector("#pdf-render-" + num + "-preview"),
      ctx = canvas.getContext("2d");
    // Get page

    pdfDoc.getPage(num).then((page) => {
      // Set scale
      var viewport = page.getViewport({ scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;
      var renderCtx = {
        canvasContext: ctx,
        viewport,
      };
      page.render(renderCtx).promise.then(() => {
        pageIsRendering = false;
      });
    });
  } else if (status == 2) {
    $("#main-pdf-render-preview").append(
      '<div class="drawer-wrapper ng-scope"><br> <div class="documentPage ng-scope">' +
        '<canvas class="document-page-preview" id="pdf-render-' +
        num +
        '-preview" style="width: 100%;" ></canvas>' +
        '<div class="bar-action"> </div><div class="column-indicators"></div><span class="pageNumber ng-binding">Page ' +
        num +
        "</span></div>"
    );

    const scale = 1.5,
      canvas = document.querySelector("#pdf-render-" + num + "-preview"),
      ctx = canvas.getContext("2d");
    // Get page
    pdfDoc.getPage(num).then((page) => {
      // Set scale
      var viewport = page.getViewport({ scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;
      var renderCtx = {
        canvasContext: ctx,
        viewport,
      };
      page.render(renderCtx).promise.then(() => {
        pageIsRendering = false;
      });
    });
  }
};

// Get Document
// var url = 'http://localhost/PROJECTS/WEB-DEV/esign/nsmartrac/uploads/DocFiles/dummy.pdf';

var loadingTask = pdfjsLib.getDocument(url);
loadingTask.promise.then(function (pdfDoc_) {
  pdfDoc = pdfDoc_;
  // document.querySelector('#page-count').textContent = pdfDoc.numPages;
  for (let index = 1; index <= pdfDoc.numPages; index++) {
    renderPage(index, 1);
  }
});

loadingTask.promise.then(function (pdfDoc_) {
  pdfDoc = pdfDoc_;
  // document.querySelector('#page-count').textContent = pdfDoc.numPages;
  for (let index = 1; index <= pdfDoc.numPages; index++) {
    renderPage(index, 2);
  }
});

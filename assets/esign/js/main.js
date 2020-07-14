

let pdfDoc = null,
  pageNum = 1,
  pageIsRendering = false,
  pageNumIsPending = null;



// Render the page
const renderPage = num => {
  pageIsRendering = true;
  
  $('#main-pdf-render').append('<canvas class="document-page" id="pdf-render-'+num+'" ></canvas>');
  const scale = 1.5,
  canvas = document.querySelector('#pdf-render-'+num),
  ctx = canvas.getContext('2d');
  // Get page
  pdfDoc.getPage(num).then(page => {
    // Set scale
    const viewport = page.getViewport({ scale });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    const renderCtx = {
      canvasContext: ctx,
      viewport
    };

    page.render(renderCtx).promise.then(() => {
      pageIsRendering = false;
    });

    // Output current page
    document.querySelector('#page-num').textContent = num;
  });
};

// Check for pages rendering
const queueRenderPage = num => {
  if (pageIsRendering) {
    pageNumIsPending = num;
  } else {
    // renderPage(num);
  }
};

// Get Document
const url = '/PROJECTS/WEB-DEV/esign/nsmartrac/uploads/DocFiles/dummy.pdf';
pdfjsLib
  .getDocument(url)
  .promise.then(pdfDoc_ => {
    pdfDoc = pdfDoc_;
  
    document.querySelector('#page-count').textContent = pdfDoc.numPages;

    for (let index = 1; index <= pdfDoc.numPages; index++) {
      alert(index);
      renderPage(index);
    }
    
  })
  .catch(err => {
    // Display error
    const div = document.createElement('div');
    div.className = 'error';
    div.appendChild(document.createTextNode(err.message));
  });

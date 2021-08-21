$(document).on("click", "div.widget .body.marchant-details .fa-angle-down.see-more-btn", function(event) {
    $(this).attr("class", "fa fa-angle-up see-more-btn");
    $(".widget .body.marchant-details .marchant-info-hiden").fadeIn();
});
$(document).on("click", "div.widget .body.marchant-details .fa-angle-up.see-more-btn", function(event) {
    $(this).attr("class", "fa fa-angle-down see-more-btn");
    $(".widget .body.marchant-details .marchant-info-hiden").fadeOut();
});

$(document).on("click", ".widget button.view-invoice-btn", function(event) {
    $("#pdf-viewer-modal .container .the-body").html(`<iframe id="pdf-iframe" src="` + $(this).attr("data-file") + `" frameborder="0"></iframe>`);
    $("#pdf-viewer-modal").fadeIn();
})
$(document).on("click", "#pdf-viewer-modal .container .close-btn", function(event) {
    $("#pdf-viewer-modal").fadeOut();
})

$(document).on("click", ".widget button.download-btn", function(event) {
    var link = document.createElement('a');
    link.href = $(this).attr("data-file");
    link.download = "Invoice " + $(this).attr("data-inv") + ".pdf";
    link.click();
    link.remove();
});
$(document).on("click", ".widget button.print-btn", function(event) {
    document.getElementById('pdf-iframe').contentWindow.print();
});
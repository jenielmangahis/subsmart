$(document).on("click", "#import-customer", function(event) {
    $("#import-customers-modal").fadeIn();
});
$(document).on("click", "#import-customers-modal .close-modal", function(event) {
    $("#import-customers-modal").fadeOut();
});

$(document).ready(function() {

    // DISABLE TEMPORARY TO AVOID JS ERRORS
    // var checkDropzone = new Dropzone('div#import_customer', {
    //     url: baseURL + "accounting/import_customers",
    //     autoProcessQueue: false,
    //     uploadMultiple: false,
    //     maxFilesize: 128,
    //     addRemoveLinks: true,
    //     acceptedFiles: ".xlsx, .xls, .csv",
    //     init: function() {
    //         var submitButton = document.querySelector("#submit-imported-customer-file");
    //         myDropzone = this;
    //         submitButton.addEventListener("click", function() {
    //             if ($("#import-customers-modal .dz-error-message span").html() == "") {
    //                 $("#loader-modal").show();
    //                 myDropzone.processQueue();
    //             }
    //         });
    //         this.on("complete", function() {
    //             if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0 && $("#import-customers-modal .dz-error-message span").html() == "") {
    //                 // window.location.replace(baseURL + "accounting");
    //                 $("#loader-modal").hide();
    //             }
    //         });
    //         this.on("addedfile", function() {
    //             $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/excel.png");
    //             if (this.files[1] != null) {
    //                 this.removeFile(this.files[0]);
    //             }
    //         });
    //     },
    //     error(file, message) {
    //         $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/error.png");
    //         if (file.previewElement) {
    //             file.previewElement.classList.add("dz-error");
    //             if (typeof message !== "string" && message.error) {
    //                 message = message.error;
    //             }
    //             for (let node of file.previewElement.querySelectorAll(
    //                     "[data-dz-errormessage]"
    //                 )) {
    //                 node.textContent = message;
    //             }
    //         }
    //     },
    // });
});
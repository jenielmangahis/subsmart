let import_new_customer_dropzone = new Dropzone("div#import_customer", {
    url: baseURL + "import/customer",
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    acceptedFiles: '.xlsx, .xls, .csv',
    accept(file, done) {
        return done();
    },
    error(file, message) {
        if (typeof message !== "string" && message.error) {
            message = message.error;
        }
        console.log(message);
    }
});
// The dropzone method is added to jQuery elements and can
// be invoked with an (optional) configuration object.
import_new_customer_dropzone.on("complete", function(file) {
    import_new_customer_dropzone.removeFile(file);
});
$(document).on("click", "#import-customers-modal .modal-body .upload-button button", function(event) {
    import_new_customer_dropzone.processQueue();

});
const handleOnLoad = (form_id) => {
    generateQR(form_id);
    setupEmbedCode(form_id);
}

const generateQR = (form_id) => {
    $("#formQRCode").qrcode(`${window.origin}/fb/view/${form_id}`);
}

const setupEmbedCode = (form_id) => {
    const embed_code = `<div class="container" id="embedManager" form_id="<?= $form_id ?>" onload="loadForm()">
                            <form action="" method="post">
                                <div id="formContainer" class="row bg-white"></div>
                                <div class="w-100 text-center">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <script src="${window.origin}/assets/fb/js/embed.js"></script>`;
    $('#formEmbedCode').val(embed_code);
}
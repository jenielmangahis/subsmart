/*
 * Start jQuery
 */
$(document).ready(function() {

    
/*
 * on signature type 
 */
$(".signature-input").keyup(function() {
    textSignature = $(this).val();
    if (textSignature == "") {
        textSignature = "Your Name";
    }
    $(".text-signature").text(textSignature);
})

/*
 * change signature style
 */
$(".signature-style").change(function() {
    var signatureStyle = $(this).val();
    $(".text-signature").css("font-style", signatureStyle);
})

/*
 * change signature color
 */
// function updateSignatureColor(color) {
//     $(".text-signature").css("color", "#"+color);
//     $(".signature-color").css("color", "#"+color);
// }

/*
 * Initilize signature drawing
 */
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).parent().attr("type");
    if (target === "draw") {
        initDrawing()
    }
});

/*
 * change signature weight
 */
$(".signature-weight").change(function() {
    var signatureWeight = $(this).val();
    $(".text-signature").css("font-weight", signatureWeight);
})

/*
 * change signature font
 */
$(".signature-font").change(function() {
    var signatureFont = $(this).val();
    $(".text-signature").css("font-family", signatureFont);
})

/*
 * on stroke size click
 */
$("#signature-stroke").click(function() {
    stroke = parseInt($(this).attr("stroke"));
    if (stroke == 3) {
        updateStroke(5);
    }else if(stroke == 5){
        updateStroke(7);
    }else if(stroke == 7){
        updateStroke(3);
    }
});

/*
 * update stroke
 */
 function updateStroke(stroke){
    modules.stroke(stroke);
    $("#signature-stroke").attr("stroke", stroke);
 }

/*
 * change signature font
 */
$(".save-signature").click(function() {
    signatureType = $("#updateSignature .head-links").find("li.active").attr("type");
    if (signatureType === "capture") {
        saveTextSignature();
    }else if(signatureType === "upload"){
        saveUploadSignature();
    }else if(signatureType === "draw"){
        saveSignature($('#draw-signature').getCanvasImage('png'));
    }
});

/*
 * save text signature
 */
 function saveTextSignature(){
    html2canvas([document.getElementById("text-signature")], {
        onrendered: function(canvas) {
            var imagedata = canvas.toDataURL('image/png'); 
            saveSignature(imagedata);
        }
    })
 }

/*
 * save text signature
 */
 function saveDrawnSignature(){
    html2canvas([document.getElementById("draw-signature")], {
        onrendered: function(canvas) {
            var imagedata = canvas.toDataURL('image/png'); 
            saveSignature(imagedata);
        }
    })
 }

/*
 * save uploaded signature 
 */
 function saveUploadSignature(){
    signature = $("input[name=signatureupload]").val();
    if (signature !== '') {
        saveSignature(signature);
    }
 }

/*
 * save signature to server
 */
 function saveSignature(signature){
    if (auth) {
        server({
            url: saveSignatureUrl,
            data: {
                "signature": signature,
                "csrf-token": Cookies.get("CSRF-TOKEN")
            },
            loader: true
        });
    }else{
        sessionStorage.setItem('signature', signature);
        $('#updateSignature').modal('hide');
        toastr.success("Signature successfully saved.","Alright!", {timeOut: 2000, closeButton: true, progressBar: false});
    }
 }

/*
 * change signature font
 */
 function signatureCallback(image){
    $(".signature-body img").attr("src", image);
    $('#updateSignature').modal('hide');
 }




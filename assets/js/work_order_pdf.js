// $(document).on("click",".pdf_sheet", function(){
//     // window.open(url, '_blank');
//     alert('yes!');
//     // var subjectID = $("#subjectID").val();
//     // var session = $("#SessionFrom").val()+"-"+$("#SessionTo").val();
//     // var courseID = $("#classesID").val();
//     // var yearsOrSemester = $("#yearSemesterID").val();
//     // var form = '';
//     // form += '<input type="hidden" name="subjectID" value="' + subjectID + '">';
//     // form += '<input type="hidden" name="session" value="' + session + '">';
//     // form += '<input type="hidden" name="courseID" value="' + courseID + '">';
//     // form += '<input type="hidden" name="yearsOrSemester" value="' + yearsOrSemester+ '">';
//     // form += '</form>';
//     // $('body').append(form);
//     // $('#static_form').submit();
//     $.ajax({
//         type : 'POST',
//         url : '<?php echo base_url(); ?>accounting/testSave',
//         data : {dataURL: dataURL},
//         success: function(result){
//         // $('#res').html('Signature Uploaded successfully');
//         console.log(dataURL)
//         // location.reload();
        
//         },
//     });
// });
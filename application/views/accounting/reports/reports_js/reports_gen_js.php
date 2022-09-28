<script>
    var tbl_data = [];
    
    $(document).ready(function() {
        $("#runReport").submit(function(e) {
            var customerCol = [];
            var customerColText = [];
            var estimateCol = [];
            var estimateColText = [];
            var sThisVal = [];
            e.preventDefault(); // avoid to execute the actual submit of the form.

            $("input.customer:checkbox:checked").each(function() {
                customerCol.push($(this).val());
                customerColText.push($(this).next('label').text());
            });
            $("input.estimate:checkbox:checked").each(function() {
                estimateCol.push($(this).val());
                estimateColText.push($(this).next('label').text());
            });
            var date_from = new Date($('#filter_from').val());
            var date_to = new Date($('#filter_to').val());
            var filter_from_date = getInputDate(date_from);
            var filter_to_date = getInputDate(date_to);
            var group_by = $('#group_by_filter :selected').val();

            const fd = new FormData();
            fd.append('customerCol', JSON.stringify(customerCol));
            fd.append('estimateCol', JSON.stringify(estimateCol));
            fd.append('estimateColText', JSON.stringify(estimateColText));
            fd.append('customerColText', JSON.stringify(customerColText));
            fd.append('date_from', filter_from_date);
            fd.append('date_to', filter_to_date);
            fd.append('group_by', group_by);
            fetch('<?= base_url('accounting_controllers/reports/view_reports_data') ?>',{
                method: 'POST',
                body: fd
            }).then(response => response.json()).then(response => {
                var {success , data, header, column} = response;
                tbl_data = response;
                console.log(tbl_data);
                if(success){
                    $('#filtered_tbl thead > tr').empty();
                    $('#filtered_tbl tbody').empty();
                    $('#defaultTbl').hide();
                    $("#customizeModal").modal('hide');

                    if(header){
                        //size of the table
                        if(header['header']){
                            if(header['header'].length > 7){ 
                                $( "#main" ).removeClass( "col-md-8 offset-md-2" ).addClass( "col-md-12 offset-md-0" );
                            }else{
                                if($('#main').hasClass('col-md-12 offset-md-0')){
                                    $( "#main" ).removeClass( "col-md-12 offset-md-0" ).addClass( "col-md-8 offset-md-2" );
                                }
                            }

                            //set thead
                            for(var x=0; x<header['header'].length; x++){
                                $('#head_tbl').append(
                                '<td>'+ header['header'][x] +'</td>'
                                )
                            }
                        }else{
                            $('#head_tbl').append(
                                '<td>NAME</td><td>NUM</td><td>ESTIMATES STATUS</td><td>ACCEPTED DATE</td><td>EXPIRATION DATE</td><td>AMOUNT</td>'
                                )
                        }

                        //set tbody
                        for(var y=0; y<data.length; y++){
                            $('#body_tbl').append('<tr id="body_tr'+y+'"></tr>');
                            for(var i=0; i<header['column'].length; i++){
                                var key = header['column'][i];
                                $estimate_data = (data[y][key] != null) ? data[y][key] : 'N/A';
                                $('#body_tr'+y+'').append(
                                    '<td>'+ $estimate_data +'</td>'
                                    );
                            }   
                        }
                    }
                }
            }).catch((error)=>{
                console.log(error);
            })

        })
    })

    $('#printThis').click(function(e){
        console.log(tbl_data);
        $('#print_accounts_modal').modal('show');

        var {success , data, header, column} = tbl_data;

        if(success){
            $('#filtered_tbl_print thead > tr').empty();
            $('#filtered_tbl_print tbody').empty();

            if(header){
                //size of the table
                // if(header['header'].length > 7){ 
                //     $( "#main" ).removeClass( "col-md-8 offset-md-2" ).addClass( "col-md-12 offset-md-0" );
                // }else{
                //     if($('#main').hasClass('col-md-12 offset-md-0')){
                //         $( "#main" ).removeClass( "col-md-12 offset-md-0" ).addClass( "col-md-8 offset-md-2" );
                //     }
                // }

                //set thead
                for(var x=0; x<header['header'].length; x++){
                    $('#head_tbl_print').append( 
                    '<td>'+ header['header'][x] +'</td>'
                    )
                }

                //set tbody
                for(var y=0; y<data.length; y++){
                    $('#body_tbl_print').append('<tr id="body_tr_print'+y+'"></tr>');
                    for(var i=0; i<header['column'].length; i++){
                        var key = header['column'][i];
                        $estimate_data = (data[y][key] != null) ? data[y][key] : 'N/A';
                        $('#body_tr_print'+y+'').append(
                            '<td>'+ $estimate_data +'</td>'
                            );
                    }   
                }
            }
        }
    })

    function getInputDate(date){
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return (year+ '-' + month + '-' + day);
    }
    function general(){
        var class_name = document.getElementById('gen').className;
        var genHeader = document.getElementById('gen');
        var genLabel = document.getElementById('genLabel');
        var genDiv = document.getElementById('general');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            genHeader.classList.remove("bxs-right-arrow");
            genHeader.classList.add("bxs-down-arrow");
            genLabel.classList.add("fw-bold");
            genLabel.style.color = "#6a4a86";
            genDiv.style.display = 'inline';
        }else{
            genHeader.classList.add("bxs-right-arrow");
            genHeader.classList.remove("bxs-down-arrow");
            genLabel.classList.remove("fw-bold");
            genLabel.style.color = "black";
            genDiv.style.display = 'none';

        }
    }
    function column(){
        var class_name = document.getElementById('custom_row_col').className;
        var colHeader = document.getElementById('custom_row_col');
        var colLabel = document.getElementById('custom_row_col_label');
        var colDiv = document.getElementById('column');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            colHeader.classList.remove("bxs-right-arrow");
            colHeader.classList.add("bxs-down-arrow");
            colLabel.classList.add("fw-bold");
            colLabel.style.color = "#6a4a86";
            colDiv.style.display = 'inline';
        }else{
            colHeader.classList.add("bxs-right-arrow");
            colHeader.classList.remove("bxs-down-arrow");
            colLabel.classList.remove("fw-bold");
            colLabel.style.color = "black";
            colDiv.style.display = 'none';

        }
    }
    function headerFooter(){
        var class_name = document.getElementById('header_footer').className;
        var headFootHeader = document.getElementById('header_footer');
        var headFootLabel = document.getElementById('header_footer_label');
        var headFootDiv = document.getElementById('head_foot');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            headFootHeader.classList.remove("bxs-right-arrow");
            headFootHeader.classList.add("bxs-down-arrow");
            headFootLabel.classList.add("fw-bold");
            headFootLabel.style.color = "#6a4a86";
            headFootDiv.style.display = 'inline';
        }else{
            headFootHeader.classList.add("bxs-right-arrow");
            headFootHeader.classList.remove("bxs-down-arrow");
            headFootLabel.classList.remove("fw-bold");
            headFootLabel.style.color = "black";
            headFootDiv.style.display = 'none';

        }
    }

    function dates(){
        var filter_report_period = document.getElementById('filter_report_period').value;
        var date_filter_from = document.getElementById('date_filter_from');
        var date_filter_to = document.getElementById('date_filter_to');
        var filter_to = document.getElementById('filter_to');
        var filter_from = document.getElementById('filter_from');
        const D = new Date(); 
        var month = D.getMonth() + 1;  // 10 (PS: +1 since Month is 0-based)
        var day = D.getDate();       // 30
        var year = D.getFullYear(); // 2022

        if(filter_report_period == 'all-dates'){
            date_filter_from.style.display = 'none';
            date_filter_to.style.display = 'none';
        }else if(filter_report_period == 'this-week'){
            var numberOfDaysToAdd = 7;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var week = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (week.getMonth() + 1)+"/"+week.getDate()+"/"+week.getFullYear();
        }else if(filter_report_period == 'this-month'){
            var numberOfDaysToAdd = 30;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var res_month = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (res_month.getMonth() + 1)+"/"+res_month.getDate()+"/"+res_month.getFullYear();
        }else{
            date_filter_from.style.display = 'inline';
            date_filter_to.style.display = 'inline';
        }
    }
    function ccl() {
        var x = document.getElementById("changeCol");
        
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    
    
    function PrintTable() {
        $('#basic').on("click", function () {
            $('.demo').printThis({
                base: "https://jasonday.github.io/printThis/"
            });
        });
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title></title>');
 
        //Print the Table CSS.
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("divTbl").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
<script>
    $("#panel_type").select2({
        placeholder: "Select Panel Type"
    });
    $("#acct_type").select2({
        placeholder: "Select Account Type"
    });
    $("#status").select2({
        placeholder: "Select Status"
    });
    $("#state").select2({
        placeholder: "Select State"
    });
    $("#technician").select2({
        placeholder: "Select Technician"
    });
    $("#contract_term").select2({
        placeholder: "Select Contract Term"
    });
    var table_cust_list =$('#customer_list_table').DataTable({
        "lengthChange": true,
        "searching" : true,
        "pageLength": 10,
        "info": true,
        "responsive": true,

        "order": [],
        // initComplete: function () {
        //     this.api().columns([11]).every( function () {
        //         var column = this;
        //         var select = $('<select class="input_select" style="padding: 5px;border-radius: 5px;display: inline-block !important;"><option value="">All</option></select>').appendTo($(".dataTables_filter"))
        //             .on( 'change', function () {
        //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
        //                 column.search( val ? val : '', false, true ).draw();
        //                 $(this).val();
        //             } );
        //         column.data().unique().sort().each( function ( d, j ) {
        //             //var val = $('<div/>').html(d).text();
        //             //select.append( '<option value="' + val + '">' + val + '</option>' );
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //             //console.log(val);
        //         });
        //     } );
        // }
    });

    $(".delete_cust").on( "click", function( event ) {
        var ID=this.id;
        // alert(ID);
        Swal.fire({
            title: 'Are you sure you want to DELETE this customer?',
            text: "All customer data will be remove as well as module information.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/customer/remove_customer",
                    data: {prof_id : ID}, // serializes the form's elements.
                    success: function(data)
                    {
                        if(data === "Done"){
                            sucess("Customer Remove Successfully!");
                        }else{
                            console.log(data);
                        }
                    }
                });
                // window.location.href="/customer";
            }
        });
    });

    function sucess(information){
        Swal.fire({
            title: 'Good job!',
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                window.location.href="/customer";
            }
        });
    }
</script>
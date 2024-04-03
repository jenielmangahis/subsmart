<?php if( $deletedEsignTagsSections ){ ?> 
    <table class="nsm-table" id="widget-trash-bin">
        <thead>
            <tr>
                <td data-name="WidgetSectionName">Widget Name</td>
                <td data-name="Manage"></td>                    
            </tr>
            <tbody>
                <?php foreach( $deletedEsignTagsSections as $section ){ ?>
                    <tr>
                        <td><?= $section->section_name; ?></td>
                        <td>
                            <div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-trash-restore" data-name="<?= $section->section_name; ?>" data-id="<?= $section->id; ?>" href="javascript:void(0);">Restore</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </thead>
    </table>
<?php }else{ ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Widget Trash Bin is empty.</span>
    </div>
<?php } ?>

<script>
$(function(){
    $("#widget-trash-bin").nsmPagination({itemsPerPage:5});

    $('.btn-trash-restore').on('click', function(){
        var sid = $(this).attr('data-id');
        var section_name = $(this).attr('data-name');

        Swal.fire({   
            //title: "Delete",
            html: "Do you want to restore <b>"+ section_name +"</b> widget?",
            icon: "question",
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {                                
                $.ajax({
                    type: 'POST',
                    url: base_url + 'esign_v2/_restore_widget',
                    data:{sid:sid},
                    dataType: 'json',
                    success: function(response) {   
                        if( response.is_success == 1 ){
                            $('#modal-trash-tags').modal('hide');
                            Swal.fire({
                                title: "Success!",
                                text: "Widdget was successfully restored",
                                icon: "success",
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                location.reload();
                            }); 
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        }
                    },
                });           
            } 
        });
    });
});
</script>
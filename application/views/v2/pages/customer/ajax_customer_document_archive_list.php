<table class="nsm-table" id="customer-archived-documents">
    <thead>
        <tr>
            <td data-name="Name">Filename</td>
            <td data-name="Name">Document Type</td>
            <td data-name="Name">Date Created</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($archivedDocuments) { ?>
            <?php foreach($archivedDocuments as $doc){ ?>
                <tr>
                    <td class="nsm-text-primary"><?= $doc->file_name; ?></td>
                    <td class="nsm-text-primary"><?= $doc->document_label; ?></td>
                    <td><?= date("m/d/Y H:i:s", strtotime($doc->date_created)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-row-archived-restore" href="javascript:void(0);" data-name="<?= $doc->file_name; ?>" data-id="<?= $doc->id; ?>">Restore</a></li>   
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="3">
                    <div class="nsm-empty">
                        <span>No data found</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#customer-archived-documents").nsmPagination();

    $('.btn-row-archived-restore').on('click', function(){
        var cdi = $(this).attr('data-id');
        var docname = $(this).attr('data-name');

        Swal.fire({
            title: 'Restore Document',
            html: `Are you sure you want to restore document <b>${docname}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/_restore_archived_document",
                    data: {cdi:cdi},
                    dataType: 'json',            
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            location.reload();
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
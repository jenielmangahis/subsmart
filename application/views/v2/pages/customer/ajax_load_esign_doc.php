<style>
.row-details{
    display: block;
    margin-bottom: 5px;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-success {
    color: #fff;
    background-color: #28a745;
}
.badge{
    width: 95%;
    padding: 5px;
}
.list-description{
    list-style: none;
    padding: 0px;
}
.list-description li{
    display: inline-block;
}
.list-description > :first-child {
    width: 5%;
    vertical-align: top;
}
</style>
<div class="nsm-page">
    <div class="nsm-page-content">
        <div class="row">
            <div class="col-12">                
                <table class="nsm-table" id="customer-esign-doc">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Description"></td>
                            <td data-name="Status"></td>
                            <td data-name="Action"></td>
                        </tr>
                    </thead>
                    <?php foreach($esignDoc as $e){ ?>
                    <tr>                
                        <td style="width:90%;">
                            <ul class="list-description">
                                <li>
                                    <?php if( $e->user_docfile_generated_pdfs_id > 0 ){ ?>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="esignPdf[]"  value="<?= $e->id; ?>" id="">                      
                                    </div>
                                    <?php } ?>
                                </li>
                                <li>
                                    <?php if( $e->user_docfile_generated_pdfs_id > 0 ){ ?>
                                    
                                    <?php } ?>
                                    <span class="row-details">Doc Name : <b><?= $e->docfile_name != '' ? $e->docfile_name : 'Docfile name not specified'; ?></b></span>
                                    <span class="row-details">Date Created : <?= date("F j, Y g:i A", strtotime($e->date_created)); ?></span>
                                    <hr />
                                    <span class="row-details">eSign ID : <b><?= $e->docusign_envelope_id; ?></b></span>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <?php if( $e->user_docfile_generated_pdfs_id > 0 ){ ?>
                                <label class="badge badge-success status-verified-popover">Verified</label>                       
                            <?php }else{ ?>
                                <label class="badge badge-danger status-not-verified-popover">Not Verified</label>                       
                            <?php } ?>
                        </td>
                        <td style="width:5%;">
                            <?php if( $e->user_docfile_generated_pdfs_id > 0 ){ ?>
                                <a class="nsm-button primary btn-sm btn-view-pdf" data-pid="<?= $e->user_docfile_generated_pdfs_id; ?>" href="javascript:void(0);"><i class='bx bx-search-alt-2'></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>             
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#customer-esign-doc").nsmPagination({itemsPerPage:5});

    $('.status-not-verified-popover').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'eSign Document not yet completed';
        } 
    });

    $('.status-verified-popover').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'eSign Document Completed and ready for download';
        } 
    });

    $('.btn-view-pdf').on('click', function(){        
        var pid = $(this).attr('data-pid');
        var url = base_url + 'customer/_check_customer_esign_pdf';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',            
            data: {pid:pid},
            success: function(o)
                {          
                    if( o.is_valid == 1 ){ 
                        var pdf = base_url + o.path;  
                        window.open(pdf, '_blank');
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                      });
                    } 
                }
            });
    });
});
</script>
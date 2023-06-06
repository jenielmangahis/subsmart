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
</style>
<div class="row">
    <div class="col-12">
        <table class="table">
            <?php foreach($esignDoc as $e){ ?>
            <tr>
                <td st style="width:5%;">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">                      
                    </div>
                </td>                
                <td>
                    <span class="row-details">Doc Name : <b><?= $e->docfile_name; ?></b></span>
                    <span class="row-details">Date Created : <?= date("F j, Y g:i A", strtotime($e->date_created)); ?></span>
                    <br />
                    <span class="row-details">eSign ID : <?= $e->docusign_envelope_id; ?></span>
                        
                </td>
                <td>
                    <?php if( $e->user_docfile_generated_pdfs_id > 0 ){ ?>
                        <label class="badge badge-success">Verified</label>                       
                    <?php }else{ ?>
                        <label class="badge badge-danger">Not Verified</label>                       
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

<script>
$(function(){
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
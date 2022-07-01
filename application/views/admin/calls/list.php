<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Company Call Logs.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/calls') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Logs" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_calls') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>                        
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">Company Name</td>
                            <td data-name="Name">To Number</td>
                            <td data-name="Phone" style="width:10%;">Start Call</td>     
                            <td data-name="Phone" style="width:10%;">End Call</td>
                            <td data-name="Company Name">API</td>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($companyCallLogs)) : ?>
                            <?php foreach ($companyCallLogs as $log) : ?>
                                <tr>
                                    <td><?= $log->business_name; ?></td>  
                                    <td><?= $log->to_number; ?></td>                  
                                    <td><?= date("Y-m-d G:i A", strtotime($log->start_call)); ?></td>
                                    <td><?= date("Y-m-d G:i A", strtotime($log->end_call)); ?></td>
                                    <td><?= ucfirst($log->api_type); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/calls';
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>
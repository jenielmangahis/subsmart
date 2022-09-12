<?php include viewPath('v2/includes/header'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/call_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Call Logs.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('calls/logs') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Logs" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" name="btn_search" class="nsm-button primary" style="margin:0px;">Search</button>
                        </form>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">To Number</td>
                            <td data-name="Phone" style="width:10%;">Start Call</td>     
                            <td data-name="Phone" style="width:10%;">End Call</td>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($companyCallLogs)) : ?>
                            <?php foreach ($companyCallLogs as $log) : ?>
                                <tr>
                                    <td><?= $log->to_number; ?></td>                  
                                    <td><?= date("Y-m-d G:i A", strtotime($log->start_call)); ?></td>
                                    <td><?= date("Y-m-d G:i A", strtotime($log->end_call)); ?></td>
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
                                        <li class="page-item"><a class="page-link disabled" href="#" name="btn_prev">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#" name="btn_link">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#" name="btn_next">Next</a></li>
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
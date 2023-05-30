<style type="text/css">
    #ITEM_DETAILS_HISTORY_TABLE_length, 
    #ITEM_DETAILS_HISTORY_TABLE_filter, 
    #ITEM_DETAILS_HISTORY_TABLE_info {
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 5px;
    }
    table.dataTable.no-footer {
        border: 1px solid lightgray;
    }
    table.dataTable, table.dataTable th, table.dataTable td {
        box-sizing: border-box;
    }
</style>

<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Item Details</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="ITEM_DETAILS_HISTORY_TABLE" class="table table-hover w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Job</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($item_details as $item_detail) {
                                ?>
                                <tr>
                                    <td><?php echo $item_detail->title; ?></td>
                                    <td><?php echo $item_detail->type; ?></td>
                                    <td><?php echo $item_detail->qty; ?></td>
                                    <td><?php echo $item_detail->job_number; ?></td>
                                </tr>
                                <?php 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
       var ITEM_DETAILS_HISTORY_TABLE = $("#ITEM_DETAILS_HISTORY_TABLE").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        }); 
    });
</script>
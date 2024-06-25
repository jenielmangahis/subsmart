<style>
.nsm-profile {
    height:35px;
    width:35px;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
</style>
<?php if ($customers) { ?>
    <div class="form-group">
        <input type="text" class="nsm-field nsm-search form-control mb-2" id="customer-search" placeholder="Search Customer..." style="width:100%;">
    </div>
    <table class="nsm-table" id="customer-list">
        <thead>
            <tr>
                <td></td>
                <td class="table-icon"></td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) { ?>
                <tr>
                    <td style="text-align:center;"><input class="form-check-input chk-customer" type="checkbox" value="<?= $customer->email; ?>" id=""></td>
                    <td>
                        <div class="nsm-profile">
                            <span><?php echo getLoggedNameInitials($customer->id); ?></span>
                        </div>
                    </td>
                    <td class="nsm-text-primary">
                        <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                        <label class="content-subtitle fst-italic d-block"><?= $customer->email != '' ? $customer->email : 'Not Specified' ?></label>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }else{ ?>
    <div class="nsm-empty">
        <span>No results found.</span>
    </div>
<?php } ?>
<script>
$(function(){
    <?php if ($customers) { ?>
    var customerListTable = $("#customer-list").DataTable({
        "ordering": false,
        "info": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $("#customer-search").keyup(function() {
        customerListTable.search($(this).val()).draw()
    });
    <?php } ?>
});
</script>
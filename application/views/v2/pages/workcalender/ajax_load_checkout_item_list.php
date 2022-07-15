<div class="col-12">
    <div class="nsm-field-group search mw-100">
        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by Name" for="checkout_item_table">
    </div>
</div>
<div class="col-12">
    <table class="nsm-table" id="checkout_item_table">
        <thead>
            <tr>
                <td data-name="Item Name">Item Name</td>
                <td data-name="Item Type">Item Type</td>
                <td data-name="Item Price">Item Price</td>
                <td data-name="Manage"></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $i) { ?>
                <tr>
                    <td class="nsm-text-primary fw-bold"><?= $i->title; ?></td>
                    <td><?= ucwords($i->type); ?></td>
                    <td>$<?= number_format($i->price, 2); ?></td>
                    <td class="text-end"><button class="nsm-button btn-sm btn-add-item-row" data-id="<?= $i->id; ?>">Add</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#checkout_item_table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
            console.log("TEST");
        }, 1000));
    });
</script>
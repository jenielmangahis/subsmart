<table id="item-locations-list" class="nsm-table">
    <thead>
        <tr>
            <td data-name="Location">Storage Location</td>
            <td data-name="Quantity">Quantity</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($itemLocations as $location){ ?>
            <tr>
                <td><?= $location['storage_location_name']; ?></td>
                <td><?= $location['qty']; ?></td>
                <td>
                    <div class='dropdown table-management'>
                        <a href='javascript:void(0);' class='dropdown-toggle' data-bs-toggle='dropdown'>
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                        </a>
                        <ul class='dropdown-menu dropdown-menu-end'>
                            <li>
                            <a class='dropdown-item edit-location-item' href='javascript:void(0);' data-qty="<?= $location['qty']; ?>" data-item-id="<?= $location['item_id']; ?>" data-id='<?= $location['id']; ?>'>Edit</a>
                            </li>
                            <li>
                                <a class='dropdown-item delete-location-item' href='javascript:void(0);' data-id='<?= $location['id']; ?>'>Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#item-locations-list").nsmPagination({itemsPerPage:10});

});
</script>
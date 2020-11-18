<table class="table">
<thead>
  <th>Item Name</th>
  <th></th>
</thead>
<tbody>
  <?php foreach($checklistItems as $item){ ?>
    <?php 
      $eid = hashids_encrypt($item->id, '', 15);
    ?>
    <tr>
      <td><?= $item->item_name; ?></td>
      <td>
        <a class="btn btn-sm btn-default btn-delete-checklist-item" data-id="<?= $eid; ?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
        <a class="btn btn-sm btn-default btn-edit-checklist-item" href="javascript:void(0);" data-name="<?= $item->item_name; ?>" data-id="<?= $eid; ?>"><i class="fa fa-pencil"></i></a>
      </td>
    </tr>
  <?php } ?>
</tbody>
</table>
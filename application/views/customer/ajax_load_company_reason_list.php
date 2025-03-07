<?php foreach($reasons as $r){ ?>
    <tr id="row-reason-<?= $r->id; ?>">
        <td><?= $r->reason; ?></td>
        <td style="width:5%;">
            <?php if( $r->company_id > 0 ){ ?>
            <a href="javascript:void(0);" class="nsm-button btn-small row-reason-delete" data-id="<?= $r->id; ?>"><i class='bx bxs-trash'></i></a>
            <?php } ?>
        </td>
    </tr>
<?php } ?>
<div class="modal fade" id="modal_customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Customers List</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="table"  id="customer_list_table">
                <thead>
                <tr>
                    <th width="100px">Name</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Email</th>
                    <th>Sales Rep</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($profiles) && !empty($profiles)) :  ?>
                    <?php foreach ($profiles as $customer) : ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('/customer/index/tab2/'.$customer->prof_id).''; ?>" style="color:#32243d;">
                                    <?= ($customer) ? $customer->first_name.' '.$customer->last_name : ''; ?>
                                </a>
                            </td>
                            <td><?php echo  $customer->city; ?></td>
                            <td><?php echo  $customer->state; ?></td>
                            <td><?php echo $customer->email; ?></td>
                            <td><?php echo ($customer) ? $customer->FName. ' ' .$customer->LName : ''; ?></td>
                            <td><?php echo $customer->status; ?></td>
                            <td>
                                <a href="<?= base_url('/customer/index/tab2/'.$customer->prof_id); ?>" style="text-decoration:none;display:inline-block;" title="View Customer">
                                    <img src="/assets/img/customer/search.png" width="16px" height="16px" border="0" title="View Customer">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
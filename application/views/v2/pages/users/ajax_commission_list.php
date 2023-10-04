<table class="nsm-table" id="commision-list">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="JobNumber" style="width:30%;">Job Number</td>
            <td data-name="CommissionDate" style="width:20%;">Date</td>
            <td data-name="IsPaid">Is Paid</td>
            <td data-name="CommissionAmount" style="text-align:right;" style="width:30%;">Commission Amount</td>            
            <td data-name="Manage" style="width:10%;"></td>
        </tr>
    </thead>
    <tbody>
        <?php $total_commission = 0; ?>
        <?php if( isset($employee_commissions['jobs']) ){ ?>
            <?php foreach( $employee_commissions['jobs'] as $ec ){ ?>
            <?php $total_commission = $total_commission + $ec['commission_amount']; ?>
            <tr>
                <td><div class="table-row-icon"><i class="bx bx-briefcase"></i></div></td>
                <td>
                    <a class="view-job-row" href="javascript:void(0);" data-id="<?= $ec['job_id']; ?>">
                    <?= $ec['job_number']; ?>
                    </a>
                </td>
                <td><?= date("d/m/Y", strtotime($ec['commission_date'])); ?></td>
                <td>
                    <?php if( $ec['is_paid'] == 1 ){ ?>
                        <span class="nsm-badge nsm-badge-primary" style="width:100%;display:block;text-align:center;">Yes</span>
                    <?php }else{ ?>
                        <span class="nsm-badge nsm-badge-primary" style="width:100%;display:block;text-align:center;">No</span>
                    <?php } ?>
                </td>
                <td style="text-align:right;">
                    <label class="row-commission-amount-<?= $ec['commission_id']; ?>"><?= number_format($ec['commission_amount'],2); ?></label>
                    <div class="row-commission-form-group-<?= $ec['commission_id']; ?>" style="display:none;">
                        <input type="number" value="<?= number_format($ec['commission_amount'],2); ?>" class="nsm-field form-control" step="any" id="row-employee-commission-<?= $ec['commission_id']; ?>" style="display:inline-block;width:74%;" />
                        <a class="nsm-button primary small" href="javascript:void(0);" style="display: inline-block;padding: 6px;margin: 0px;"><i class='bx bxs-save' style="position:relative;top:3px;"></i></a>
                    </div>
                </td>
                <td>
                    <div class="dropdown table-management">
                        <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">                        
                            <li>
                                <a class="dropdown-item edit-employee-commission-item" name="btn_edit" href="javascript:void(0);" data-id="<?= $ec['commission_id']; ?>">Edit</a>
                            </li>                        
                            <li>
                                <a class="dropdown-item delete-employee-commission-item" name="" href="javascript:void(0);" data-id="<?= $ec['commission_id']; ?>">Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>        
        <tr>
            <td colspan="4"><b>Total</b></td>
            <td style="text-align:right;"><b><?= number_format($total_commission,2); ?></b></td>
        </tr>
    </tbody>
</table>

<div class="modal fade nsm-modal fade" id="modal-quick-view-job" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Job</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" style="max-height:700px; overflow: auto;">
                <div class="view-schedule-container row"></div>
            </div>                                    
        </div>        
    </div>
</div>
<script>
$(function(){
    $("#commision-list").nsmPagination();    
});
</script>
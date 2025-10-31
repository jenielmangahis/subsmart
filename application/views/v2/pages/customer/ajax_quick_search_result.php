<style>
    .nsm-profile {
        color: white !important;
    }
</style>
<table class="nsm-table" id="customer-search-result">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Name">Name</td>
            <td data-name="Manage" style="width:1%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($customers) { ?>
            <?php foreach($customers as $customer){ ?>
                <tr>
                    <td>
                        <div class="nsm-text-primary nsm-profile show">
                            <?php $initials = ucwords($customer->name)[0]; ?>
                            <span><?= $initials; ?></span>
                        </div>
                    </td>
                    <td class="nsm-text-primary show cursor-pointer" onclick="window.location.href = `${window.origin}/customer/module/<?php echo $customer->prof_id; ?>`;"><?= $customer->name; ?><br><small class="text-muted"><?= $customer->email; ?></small></td>
                    <td style="width:5%;" class="show">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/module/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Dashboard</a></li>   
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/add_advance/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Edit</a></li>
                                <li><a class="dropdown-item btn-quick-customer-send-esign" href="javascript:void(0);" data-name="<?= $customer->name; ?>" data-id="<?= $customer->prof_id; ?>">Send eSign</a></li>      
                                <!-- <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/preview/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Preview</a></li>    -->
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="3">
                    <div class="nsm-empty">
                        <span>No results found</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#customer-search-result").nsmPagination();
});
</script>
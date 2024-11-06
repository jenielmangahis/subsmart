<table class="nsm-table" id="customer-search-result">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Name">Name</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($customers) { ?>
            <?php foreach($customers as $customer){ ?>
                <tr>
                    <td>
                        <div class="nsm-profile">
                            <?php $initials = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]); ?>
                            <span><?= $initials; ?></span>
                        </div>
                    </td>
                    <td class="nsm-text-primary"><?= $customer->first_name . ' ' . $customer->last_name; ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/module/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Dashboard</a></li>   
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/add_advance/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Edit</a></li>   
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.open('<?php echo base_url('customer/preview/'.$customer->prof_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">Preview</a></li>   
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
<style>
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-primary {
    color: #fff;
    background-color: #007bff;
}
.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}
.badge{
    width: 100%;
    display: block;
}
#nsm-taskhub-list thead tr{
    background-color:#cccccc;
}
</style>
<table class="nsm-table" id="nsm-taskhub-list">
    <thead>
        <tr>            
            <td class="Subject">Subject</td>
            <td data-name="Customer">Customer</td>                            
            <td data-name="Assigned">Assigned User</td>                  
            <td data-name="Date Completion" style="width:15%;">Due Date</td>                      
            <td data-name="Priority" style="width:8%;">Priority</td>
            <td data-name="Status" style="width:8%;">Status</td>            
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($tasksHub)) :
        ?>
            <?php
            foreach ($tasksHub as $th) :
            ?>
                <tr>                    
                    <td><?= $th->subject; ?></td>                                    
                    <td><?= $th->customer_name ? $th->customer_name : 'No customer assigned'; ?></td>
                    <td><?= getTaskAssignedUser($th->task_id); ?></td>
                    <td><?= date("F d, Y",strtotime($th->estimated_date_complete)); ?></td>
                    <td><span class="badge badge-info" style="background-color: <?= $th->status_color; ?>;display: block;width:100%;"><?= $th->status_text; ?></span></td>
                    <td>
                        <?php 
                            switch ($th->priority):
                                case 'High':
                                    $class_priority = "badge-danger";
                                    break;
                                case 'Medium':
                                    $class_priority = "badge-primary";
                                    break;
                                case 'Low':
                                    $class_priority = "badge-secondary";
                                    break;
                            endswitch;
                        ?>
                        <span class="badge <?= $class_priority; ?>"><?= ucwords($th->priority); ?></span>
                    </td>                    
                </tr>
            <?php
            endforeach;
            ?>
        <?php
        else :
        ?>
            <tr>
                <td colspan="3">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>
        <?php
        endif;
        ?>
    </tbody>
</table>
<script>
$(function(){
    $("#nsm-taskhub-list").nsmPagination({itemsPerPage:10});  
});
</script>
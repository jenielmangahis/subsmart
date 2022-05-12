<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>TaskHub</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2 btn-task-list" href="javascript:void(0);">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content taskhub-container">
        <div class="nsm-loader">
            <i class='bx bx-loader-alt bx-spin'></i>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        loadTasks();
    });

    $(document).on('click','.btn-task-list',function(){
        var url = base_url + 'taskhub/_load_taskhub_list';

        $('#modalTaskHubList').modal('show');
        $(".modal-taskhub-list-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {          
                $('.modal-taskhub-list-container').html(o);
             }
          });
        }, 800);        
    });

    $(document).on('click','.btn-add-task',function(){
        var url = base_url + 'taskhub/_add_new_task';

        $('#modalTaskHubList').modal('hide');
        $('#modalAddTaskHub').modal('show');
        $(".modal-add-new-task-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {          
                $('.modal-add-new-task-container').html(o);
             }
          });
        }, 800);        
    });

    $(document).on('submit', '#frm-add-new-task', function(e){
        e.preventDefault();
        var url = base_url + 'taskhub/_save_task';
        $(".btn-save-task").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-task")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddTaskHub").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Task was successfully created.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-save-task").html('Save');
             }
          });
        }, 800);
    });

    function loadTasks(){
        $.ajax({
            url: '<?php echo base_url(); ?>taskhub/loadV2WidgetContents',
            method: 'get',
            data: {},
            success: function (response) {
                $('.taskhub-container').html(response);
            }
        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>
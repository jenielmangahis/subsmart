<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter.h-100.yellow {
        background-color: #fef5e0;
    }

    i.bx.bx-box.subs {
        background-color: #ffeab9;
        color: #cda030;
    }

</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Technician Scorecard</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row mb-4 mt-2">
            <div class="col-12">
                <label for="" class="mb-2">Filter by technician:</label>
                <select class="nsm-field form-select" name="filter_date" id="filter-by-technician">
                    <?php 
                    foreach($technician_items as $tech):
                    ?>
                    <option value="<?= $tech->id; ?>"><?= $tech->technician; ?></option>                        
                    
                    <?php
                    endforeach;
                    ?>
                
                </select>
            </div>
        </div>     
        <div class="row" id="tech_scorecard_details">
           
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        loadTechScorecard();
     
        function loadTechScorecard(){
        var filter_by_technician = $('#filter-by-technician').val();

        $.ajax({
            url: base_url + 'widgets/loadTechScorecard',
            method: 'post',
            data: {filter_by_technician},
            success: function (response) {
                $('#tech_scorecard_details').html(response);
            }
        });
    }
    });

    
</script>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<style>
    .nsm-card .nsm-card-content.wow {
    display: block;
    height: 50px;
}
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Sales Leaderboard</span>
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
        <div class="nsm-widget-table">
            <div class="row mb-4 mt-2">
                <div class="col-4">
                    <select class="nsm-field form-select" name="filter_date" id="sales-leader-board-filter-date">                                                
                        <option value="today">Today</option>                        
                        <option value="custom">Custom</option>
                        <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                        <option value="this-month">This month</option>
                        <option value="this-quarter">This quarter</option>
                        <option value="this-year" selected="">This year</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="date" id="sales-leaderboard-filter-from" class="nsm-field form-control date" value="<?= date("Y-01-01"); ?>" />
                </div>
                <div class="col-4">
                    <input type="date" id="sales-leaderboard-filter-to" class="nsm-field form-control date" value="<?= date("Y-12-31"); ?>" required>
                </div>
            </div>            
            <div id="sales_leaderboard_v2"></div>
        </div>
    </div>      

</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>

<script type="text/javascript">
    $(document).ready(function(){
        loadSalesLeaderboards(); 
        
        $('#sales-leader-board-filter-date').on('change', function(){
            switch($(this).val()) {
                case 'today' :
                    var date = new Date();
                    var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                break;
                case 'this-week' :
                    var date = new Date();
                    var from = date.getDate() - date.getDay();
                    var to = from + 6;

                    var from_date = new Date(date.setDate(from));
                    var to_date = new Date(date.setDate(to));

                    from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
                case 'this-month' :
                    var date = new Date();
                    var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                    from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
                case 'this-quarter' :
                    var date = new Date();
                    var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                    
                    switch(currQuarter) {
                        case 1 :
                            var from_date = '01/01/' + date.getFullYear();
                            var to_date = '03/31/'+ date.getFullYear();
                        break;
                        case 2 :
                            var from_date = '04/01/' + date.getFullYear();
                            var to_date = '06/30/'+ date.getFullYear();
                        break;
                        case 3 :
                            var from_date = '07/01/' + date.getFullYear();
                            var to_date = '09/30/'+ date.getFullYear();
                        break;
                        case 4 :
                            var from_date = '10/01/' + date.getFullYear();
                            var to_date = '12/31/'+ date.getFullYear();
                        break;
                    }
                break;
                case 'this-year' :
                    var date = new Date();

                    var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                    var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
                break;
                default :
                    var from_date = '';
                    var to_date = '';
                break;
            }

            $('#sales-leaderboard-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
            $('#sales-leaderboard-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

            loadSalesLeaderboards();
        });

        $('#sales-leaderboard-filter-from, #sales-leaderboard-filter-to').on('change', function(){
            loadSalesLeaderboards();
        });
    });

    function loadSalesLeaderboards(){
        var sales_leaderboard_date_from = $('#sales-leaderboard-filter-from').val();
        var sales_leaderboard_date_to   = $('#sales-leaderboard-filter-to').val();
        $.ajax({
            url: base_url + 'widgets/loadV2SalesLeaderBoard',
            method: 'post',
            data: {sales_leaderboard_date_from:sales_leaderboard_date_from, sales_leaderboard_date_to:sales_leaderboard_date_to},
            success: function (response) {
                $('#sales_leaderboard_v2').html(response);
            }
        });
    }
</script>
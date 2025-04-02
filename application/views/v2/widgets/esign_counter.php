<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
//     // Your dynamic load code here if any
// }
$category = "esign";
$thumbanailName = "eSign";
$description = "eSign manages digital document approvals. This card displays the count of completed signatures and those waiting for others.";
$icon = '<i class="fas fa-signature"></i>';
?>
<style> .display_none { display: none; }</style>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo $icon; ?>&nbsp;&nbsp;<?php echo $thumbanailName; ?> <span class="badge bg-secondary position-absolute opacity-25">Thumbnail</span>
                    </a>
                    <div class="dropdown float-end">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeThumbnail('<?php echo $id; ?>');">Remove Thumbnail</a></li>
                        </ul>
                    </div>
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <select class="form-select w-100" onChange="filterThumbnail(this.value, '<?php echo $id; ?>', '<?php echo $category; ?>')">
                    <option value="all">All time</option>
                    <option value="week">Last 7 days</option>
                    <option value="two-week">Last 14 days</option>
                    <option value="month">Last 30 days</option>
                    <option value="two-month">Last 60 days</option>
                </select>
            </div>
        </div>
        <div class="row esignContent">
            <?php
                $output = "";
                foreach ($esign as $data) {
                    $output .= "<div class='col'>";
                    $output .=   "<div class='text-center p-2'>";
                    $output .=       "<strong class='text-muted text-uppercase'>".htmlspecialchars($data->status)."</strong>";
                    $output .=       "<h2 class='mb-0'>".htmlspecialchars($data->status_count)."</h2>";
                    $output .=   "</div>";
                    $output .= "</div>";
                }
                echo $output;
            ?>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>







<!-- 


<div class="<?php echo htmlspecialchars($class); ?>" data-id="<?php echo htmlspecialchars($id); ?>"
    id="thumbnail_<?php echo htmlspecialchars($id); ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="summary-report-header-sub">
                        <div class="icon-summary-estimate">
                            <i class="bx bx-fw bx-palette"></i>
                        </div>
                        <a role="button" class="btn-sm m-0 me-2" href="esignmain" style="color:#6a4a86 !important;">
                            Esign
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)"
                            onclick="removeThumbnail('<?php echo htmlspecialchars($id); ?>');">Remove Thumbnail</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <select class="nsm-field form-select" style='width: 55%; border: none;'
            onChange="filterThumbnail(this.value, '<?php echo htmlspecialchars($id); ?>', 'esign')">
            <option value="all">All time</option>
            <option value="week">Last 7 days</option>
            <option value="two-week">Last 14 days</option>
            <option value="month">Last 30 days</option>
            <option value="two-month">Last 60 days</option>
        </select>
    </div>
    <div class="nsm-card-content" style="height: calc(100% - 120px);"
        id="thumbnail_content_list<?php echo htmlspecialchars($id); ?>">
        <div class="row h-100 ">
            <div class="col-12 col-lg-12" id="esign-content">
                <?php
                        $output = '';
                        foreach ($esign as $data) {
                            $output .= '<div class="row js-row-dash mb-2">';
                            $output .= '<div class="col-9 marg-top">';
                            $output .= '<div class="jname">'.htmlspecialchars($data->status).'</div>';
                            $output .= '</div>';
                            $output .= '<div class="col-3 col-center">';
                            $output .= '<div class="row">';
                            $output .= '<div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'.htmlspecialchars($data->status_count).'</span></div>';
                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '</div>';
                        }
                        echo $output;
                        ?>
            </div>
        </div>
    </div>
</div> -->

<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
//     // Your dynamic load code here if any
// }
?>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    // Your dynamic load code here if any
}
?>

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
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
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
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    // Your dynamic load code here if any
}
?>
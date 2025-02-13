<div class="row container-modules mt-4">
    <div class="col-md-6">
        <input type="text" id="search-widget" placeholder="Search Widget" class="form-control" />
    </div>
    <div class="col-md-6">
        <div class="container-header" style="background-color:#ffffff !important;">
            <h3>&nbsp;</h3>
            <div class="form-check text-end chk-row-allow-all-widgets">
                <input class="form-check-input chk-all-widgets" id="widget-all" name="roleWidgets[]" value="1" type="checkbox" />
                <label class="form-check-label" for="widget-all">Allow all widgets</label>
            </div>
        </div>
    </div>
    <?php foreach( $widgets as $widget ){ ?>
    <div class="col-md-6 widget-container">
        <div class="container-header">
            <h3><?= $widget->w_name; ?></h3>
            <div class="form-check text-end chk-row-allow-all">
                <input class="form-check-input chk-widgets" id="widget-<?= $widget->w_id; ?>" name="roleWidgets[]" value="<?= $widget->w_id; ?>" type="checkbox" />
                <label class="form-check-label" for="widget-<?= $widget->w_id; ?>">Allow</label>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
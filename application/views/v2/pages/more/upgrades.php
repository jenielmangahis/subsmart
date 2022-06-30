<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/more/more_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
        <div class="nsm-page-subnav mt-3">
            <ul>
                <li class="active" id="btn_addon_list">
                    <a class="nsm-page-link" href="javascript:void(0);">
                        <span>Add-Ons List</span>
                    </a>
                </li>
                <li class="" id="btn_addon_actives">
                    <a class="nsm-page-link" href="javascript:void(0);">
                        <span>Active Add-Ons</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A plugin is a piece of software that acts as an add-on to a web browser and gives the browser additional functionality. Plugins can allow a web browser to display additional content it was not originally designed to display.  Integration to these plug-ins will help your company have more functionality to maneuver in tougher markets.
                        </div>
                    </div>
                </div>
                <div class="row g-3" id="addons_container">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadAddOnsList();

        $("#btn_addon_list").on("click", function(){
            let _this = $(this);

            _this.addClass("active");
            _this.siblings("li").removeClass("active");
            loadAddOnsList();
        });

        $("#btn_addon_actives").on("click", function(){
            let _this = $(this);

            _this.addClass("active");
            _this.siblings("li").removeClass("active");
            loaddActiveAddOns();
        });

        $(document).on("click", ".btn-addon", function(){
            let _this = $(this);
            let aid = $(this).attr("data-id");
            let url = "<?php echo base_url('more/_load_plugin_details'); ?>";
            let _modal = $("#addon_modal");
            showLoader($("#addon_details"));

            _modal.find("#pid").val(aid);

            if(_this.hasClass("availed")){
                _modal.find(".modal-footer").hide();
                _modal.find(".modal-title").html("Addon Details");
            }
            else{
                _modal.find(".modal-footer").show();
                _modal.find(".modal-title").html("Avail Addon");
            }

            $.ajax({
                type: "POST",
                url: url,
                data: {aid:aid},
                success: function(result) {
                    $("#addon_details").html(result);
                    _modal.modal("show");
                }
            });
        });
    });

    function loadAddOnsList(){
        let _container = $("#addons_container");
        let url = "<?php echo base_url('more/_load_addons_list'); ?>";

        $.ajax({
            type: "POST",
            url: url,
            success: function(result) {
                _container.html(result).fadeIn();
            }
        });
    }

    function loaddActiveAddOns(){
        let _container = $("#addons_container");
        let url = "<?php echo base_url('more/_load_active_addons_list'); ?>";

        $.ajax({
            type: "POST",
            url: url,
            success: function(result) {
                _container.html(result).fadeIn();
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>
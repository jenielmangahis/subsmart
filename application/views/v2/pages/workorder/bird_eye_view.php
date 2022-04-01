<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>
                <form id="map-filter">
                    <div class="row gx-3">
                        <div class="col-12 col-md-2">
                            <div class="nsm-field-group calendar">
                                <input type="text" class="nsm-field form-control datepicker mb-2" placeholder="Date From">
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="nsm-field-group calendar">
                                <input type="text" class="nsm-field form-control datepicker mb-2" placeholder="Date To">
                            </div>
                        </div>
                        <div class="col-12 col-md grid-mb text-end">
                            <input type="hidden" name="job_status">
                            <div class="dropdown d-inline">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span>Filter by All</span> <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" id="select_status">
                                    <li><a class="dropdown-item" href="#" data-value="all">All</a></li>
                                    <?php
                                    foreach ($job_status as $key => $value) :
                                    ?>
                                        <li><a class="dropdown-item" href="#" data-value="<?= $key; ?>"><?= $value; ?></a></li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                            <input type="hidden" name="user">
                            <div class="dropdown d-inline">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span>Select Employee</span> <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" id="select_employee">
                                    <li><a class="dropdown-item" href="#" data-value="all">All Employees</a></li>
                                    <?php
                                    foreach ($companyUsers as $user) :
                                    ?>
                                        <li><a class="dropdown-item" href="#" data-value="<?= $user->id; ?>"><?= $user->FName . ' ' . $user->LName; ?></a></li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="map-container nsm-map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        load_map_route();
        
        $(".datepicker").datepicker({
            format: 'mm/dd/yyyy',
            orientation: "bottom",
            autoclose: true
        });
        $(".datepicker").datepicker("setDate", new Date());

        $(".datepicker").on("changeDate", function(){
            load_map_route();
        });

        $("#select_status .dropdown-item").on("click", function(){
           $("input[name=job_status]").val($(this).attr("data-value"));
           load_map_route();
        });

        $("#select_employee .dropdown-item").on("click", function(){
           $("input[name=user]").val($(this).attr("data-value"));
           load_map_route();
        });
    });

    function load_map_route() {
        var msg = '<div class="nsm-loader"><i class="bx bx-loader-alt bx-spin"></i></div>';
        var url = "<?= base_url('/workorder/_load_map_routes') ?>";

        $(".map-container").html(msg);
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: url,
                data: $("#map-filter").serialize(),
                success: function(o) {
                    $(".map-container").html(o);
                    resizeSidebar();
                }
            });
        }, 1000);
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>
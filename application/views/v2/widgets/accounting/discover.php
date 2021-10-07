<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Discover More</span>
        </div>
        <div class="nsm-card-controls">
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
    <div class="nsm-card-content">
        <div id="discover_carousel" class="carousel slide h-100 pb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="1" aria-current="true" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="2" aria-current="true" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="3" aria-current="true" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="4" aria-current="true" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="5" aria-current="true" aria-label="Slide 6"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item h-100 active">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Keep your signs with the times</span>
                            <span class="content-subtitle d-block mb-2">Your team will know their rights. You'll be complaint. Update your labor law posters.</span>
                            <a href="#" class="content-subtitle nsm-link d-block">Get your posters</a>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg')"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Share securely with others</span>
                            <span class="content-subtitle d-block mb-2">New present custom roles help you delegate access, only in nSmartrac Online Advance.</span>
                            <a href="#" class="content-subtitle nsm-link d-block">See how it works</a>
                            <div class="nsm-divider green"></div>
                            <div class="nsm-divider dot green"></div>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104533/2_new-Bolt_lifestyle_TIPS_ACCOUNTING.svg')"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Goodbye, paper timesheets!</span>
                            <span class="content-subtitle d-block mb-2">Employees track time on any device, and it automatically appears in nSmartrac.</span>
                            <a href="#" class="content-subtitle nsm-link d-block">Try TSheets for Free</a>
                            <div class="nsm-divider orange"></div>
                            <div class="nsm-divider dot orange"></div>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104804/2_new-Bolt_lifestyle_TIPS_TIMETRACKING.svg')"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Work even smarter</span>
                            <span class="content-subtitle d-block mb-2">Easily track KPI is with automated performance dashboards in nSmartrac Online Advanced.</span>
                            <a href="#" class="content-subtitle nsm-link d-block">See how it works</a>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg')"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Pay worker's comp as you go</span>
                            <span class="content-subtitle d-block mb-2">Do you know workers' comp can be automatically paid with payroll?</span>
                            <a href="#" class="content-subtitle nsm-link d-block">Get started</a>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg')"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 order-last order-md-first">
                            <span class="content-title mb-2">Find the right insurance</span>
                            <span class="content-subtitle d-block mb-2">Explore affordable coverage options and protect your business right from nSmartrac.</span>
                            <a href="#" class="content-subtitle nsm-link d-block">See coverage option</a>
                        </div> 
                        <div class="col-12 col-md-6">
                            <div class="nsm-img" style="background-image: url('https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>

<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Score</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-7">
                    <div class="row g-2">
                        <div class="col-12 col-md-4">
                            <img class="w-100" src="https://app.creditrepaircloud.com/application/images/equifax.png">
                        </div>
                        <div class="col-12 col-md-4">
                            <img class="w-100" src="https://app.creditrepaircloud.com/application/images/experian.png">
                        </div>
                        <div class="col-12 col-md-4">
                            <img class="w-100" src="https://app.creditrepaircloud.com/application/images/trans_union.png">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <canvas id="score_chart" class="nsm-chart"></canvas>
                </div>
                <div class="col-12">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <button role="button" class="nsm-button w-100 ms-0">
                                <i class='bx bx-fw bx-arrow-from-left'></i> Manual Entry
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button role="button" class="nsm-button primary w-100 ms-0">
                                <i class='bx bx-fw bx-export'></i> Pull Credit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
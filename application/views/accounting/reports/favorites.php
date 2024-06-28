<?php foreach ($reportGroups as $reportGroup) { ?>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $reportGroup->id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $reportGroup->id; ?>">
                                        <?php echo $reportGroup->description; ?>
                                    </button>
                                </h2>
                                <div id="collapse-<?php echo $reportGroup->id; ?>" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <?php $reportTypesColumns = count($reportGroup->report_types) > 8 ? array_chunk($reportGroup->report_types, ceil(count($reportGroup->report_types) / 2)) : [$reportGroup->report_types]; ?>
                                            <?php foreach ($reportTypesColumns as $colRepTypes) { ?>
                                            <div class="col-12 col-md-5">
                                                <ul class="list-unstyled m-0">
                                                    <?php foreach ($colRepTypes as $reportType) { ?>
                                                    <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id')); ?>
                                                    <li class="border-bottom p-3 cursor-pointer">
                                                        <span onclick="location.href='<?php echo is_null($reportType->url) ? base_url('/accounting/reports/view-report/'.$reportType->id) : base_url($reportType->url); ?>'"><?php echo $reportType->name; ?></span>
                                                        <a href="#" style="color: #888888" data-bs-toggle="collapse" data-bs-target="#<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse" aria-expanded="false" aria-controls="<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse">
                                                            <i class="bx bx-fw bx-help-circle"></i>
                                                        </a>

                                                        <div class="dropdown float-end d-inline-block" style="min-width: 23px; min-height: 1px">
                                                            <?php if ($reportType->customizable) { ?>
                                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" style="color: #888888">
                                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">Customize</a>
                                                                </li>
                                                            </ul>
                                                            <?php } ?>
                                                        </div>
                                                        <?php if ($reportType->favoritable === '1') { ?>
                                                        <a href="#" data-id="<?php echo $reportType->id; ?>" class="float-end <?php echo is_null($favorite) ? 'add-to-favorites' : 'remove-from-favorites'; ?>" style="color: <?php echo is_null($favorite) ? '#888888' : '#408854'; ?>">
                                                            <i class="bx bx-fw <?php echo is_null($favorite) ? 'bx-star' : 'bxs-star'; ?>"></i>
                                                        </a>
                                                        <?php } ?>
                                                        
                                                        <div class="accordion-collapse collapse" id="<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse">
                                                            <div class="accordion-body">
                                                                <p class="m-0"><?php echo $reportType->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                <?php } ?>
<div class="modal fade nsm-modal fade" id="manage_widgets_modal" tabindex="-1"
    aria-labelledby="manage_widgets_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="manage_widgets_modal_label">Manage Widgets</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <label class="content-subtitle">Select the widgets/thumbnails you would like to display in your
                            dashboard</label>
                    </div>
                    <div class="container-fluid mt-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1"
                                            role="tab" aria-controls="tab1" aria-selected="true">Widgets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
                                            aria-controls="tab2" aria-selected="false">Thumbnails</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                        aria-labelledby="tab1-tab">
                                        <div class="col-12" id="add_widget_container">
                                            <div class="nsm-loader">
                                                <i class='bx bx-loader-alt bx-spin'></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                    <div class="my-5 text-center">
                                    <label class="content-subtitle">Select 8 different widgets to display in  your dashboard.</label>
                                    </div>
                                    <div class="col-12" id="add_thumbnail_container">
                                            <div class="nsm-loader">
                                                <i class='bx bx-loader-alt bx-spin'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <label class="content-subtitle mb-2 d-block">Track stats important to your business</label>
                        <button type="button" class="nsm-button primary"
                            onclick="location.href='<?php echo base_url('mycrm/membership'); ?>'">UPGRADE PLAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
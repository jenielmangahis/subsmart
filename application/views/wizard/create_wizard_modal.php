<div id="createWizard" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content" style="padding:5px !important;">
            <div class="modal-header">
                <h5 class="modal-title">Create a Wiz!</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="wizTab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="name-tab" data-toggle="pill" href="#name" role="tab" aria-controls="v-pills-home" aria-selected="true">Name your Wiz</a>
                            <a class="nav-link" id="trigger-tab" data-toggle="pill" href="#trigger" role="tab" aria-controls="v-pills-profile" aria-selected="false">Choose a Trigger</a>
                            <a class="nav-link" id="action-tab" data-toggle="pill" href="#action" role="tab" aria-controls="v-pills-messages" aria-selected="false">Choose an Action</a>
                            <a class="nav-link" id="final-tab" data-toggle="pill" href="#final" role="tab" aria-controls="v-pills-settings" aria-selected="false">Finalize It!</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="name" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="form-group">
                                    <label>Name of Wiz</label>
                                    <input type="text" name="" placeholder="Please enter name of wiz" class="form-control">
                                </div>
                                <div class="mt-8 form-group float-right">
                                    <a prev="name" next="trigger" class="btn btn-success btnNext" >Next</a>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="trigger" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="app-search-block">
                                    <div class="search-compair-bx">
                                        <div class="form-group">
                                            <label>Please Select a Trigger App</label>
                                            <input type="text" name="" placeholder="Search for an app" class="form-control">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 form-group float-right">
                                    <a prev="name" next="trigger" class="btn btn-warning btnPrevious" >Previous</a>
                                    <a prev="trigger" next="action" class="btn btn-success btnNext" >Next</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="action" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                
                                <div class="app-search-block">
                                    <div class="search-compair-bx">
                                        <div class="form-group">
                                            <label>Please Select an Action App</label>
                                            <input type="text" name="" placeholder="Search for an action app" class="form-control">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 form-group float-right">
                                    <a prev="trigger" next="action" class="btn btn-warning btnPrevious" >Previous</a>
                                    <a prev="action" next="final" class="btn btn-success btnNext" >Next</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                <div class="mt-8 form-group float-right">
                                    <a prev="action" next="final" class="btn btn-warning btnPrevious" >Previous</a>
                                    <a class="btn btn-success" >Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        
        
        $('.btnNext').click(function () {
            var prev = $(this).attr('prev');
            var next = $(this).attr('next');

            $('#' + prev + '-tab').removeClass('active');
            $('#' + prev).removeClass('show');
            $('#' + prev).removeClass('active');

            $('#' + next + '-tab').addClass('active');
            $('#' + next).addClass('show');
            $('#' + next).addClass('active');
        });

        $('.btnPrevious').click(function () {
            var prev = $(this).attr('prev');
            var next = $(this).attr('next');

            $('#' + prev + '-tab').addClass('active');
            $('#' + prev).addClass('show');
            $('#' + prev).addClass('active');

            $('#' + next + '-tab').removeClass('active');
            $('#' + next).removeClass('show');
            $('#' + next).removeClass('active');
        });
    })
</script>    

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/survey/survey_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('survey/themes/create') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-brush"></i>
            </div>
            <span class="nsm-fab-label">Add new themes</span>
        </li>
        <li onclick="location.href='location.href='<?php echo url('survey/add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-list-check"></i>
            </div>
            <span class="nsm-fab-label">Add new survey</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('survey/themes/create') ?>'">
                                <i class='bx bx-fw bx-brush'></i> Add new themes
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('survey/add') ?>'">
                                <i class='bx bx-fw bx-list-check'></i> Add new survey from scratch
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('survey/workspace') ?>'">
                                <i class='bx bx-fw bx-desktop'></i>
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('survey/themes') ?>'">
                                <i class='bx bx-fw bx-brush'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Recently Opened</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3" id="recently_opened">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Workspaces</span>
                                </div>
                                <div class="nsm-card-controls">
                                    <a role="button" class="nsm-button btn-sm m-0" href="<?php echo base_url('survey/workspace') ?>">
                                        View in separated page
                                    </a>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-2">
                                        <button type="button" class="nsm-button primary w-100 m-0 mb-3" data-bs-toggle="modal" data-bs-target="#new_workspace_modal">
                                            <i class='bx bx-fw bx-desktop'></i> Add new workspace
                                        </button>
                                        <ul class="nav workspace-list d-none d-md-block">
                                            <?php foreach ($survey_workspaces as $workspace) : ?>
                                                <li class="nsm-button ms-0 disable-select" data-bs-toggle="tab" data-bs-target="#workspace_item_<?= $workspace->id ?>" type="button" role="tab" aria-controls="workspace-item-<?= $workspace->id ?>" aria-selected="false"><?= $workspace->name ?> <span class="nsm-badge success"><?= (count($workspace->surveys) > 0) ? count($workspace->surveys) : "" ?></span></li>
                                            <?php endforeach; ?>
                                        </ul>

                                        <div class="dropdown workspace-list d-md-none nav">
                                            <button type="button" class="dropdown-toggle nsm-button w-100 mx-0" data-bs-toggle="dropdown">
                                                <span>Select Workspace</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php foreach ($survey_workspaces as $workspace) : ?>
                                                    <li class="dropdown-item" data-bs-toggle="tab" data-bs-target="#workspace_item_<?= $workspace->id ?>" type="button" role="tab" aria-controls="workspace-item-<?= $workspace->id ?>" aria-selected="false"><span class="workspace-name"><?= $workspace->name ?></span> <span class="nsm-badge success"><?= (count($workspace->surveys) > 0) ? count($workspace->surveys) : "" ?></span></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <div class="tab-content" id="workspace_tabs">
                                            <div class="tab-pane fade show active" id="workspace_item_0" role="tabpanel" aria-labelledby="workspace-item-0">
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">Recently created surveys</label>
                                                        <label class="nsm-subtitle d-block">Showing recently created surveys in all workspace</label>
                                                    </div>
                                                </div>
                                                <div class="row" id="recent_surveys_container"></div>
                                            </div>
                                            <?php foreach ($survey_workspaces as $workspace) : ?>
                                                <div class="tab-pane fade" id="workspace_item_<?= $workspace->id ?>" role="tabpanel" aria-labelledby="workspace-item-<?= $workspace->id ?>">
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="content-title"><?= $workspace->name ?></label>
                                                            <label class="nsm-subtitle d-block"><?= count($workspace->surveys) ?> survey<?= (count($workspace->surveys) > 1) ? "s" : "" ?> in this workspace</label>
                                                        </div>
                                                        <div class="col-12 col-md-6 text-end">
                                                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('survey/themes/create') ?>'">
                                                                <i class='bx bx-fw bx-plus'></i>
                                                            </button>
                                                            <button type="button" class="nsm-button edit-workspace" data-id="<?= $workspace->id ?>" data-name="<?= $workspace->name ?>">
                                                                <i class='bx bx-fw bx-edit'></i>
                                                            </button>
                                                            <button type="button" class="nsm-button delete-workspace" data-id="<?= $workspace->id ?>">
                                                                <i class='bx bx-fw bx-x-circle'></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <?php foreach ($workspace->surveys as $key => $survey) : ?>
                                                            <div class="col-12 col-md-3">
                                                                <div class="nsm-card p-0 workspace-item" role="button" data-id="<?= $survey->id ?>">
                                                                    <div class="nsm-card-content">
                                                                        <div class="row">
                                                                            <div class="col-12 thumbnail-header">
                                                                                <div class="nsm-card-controls">
                                                                                    <div class="dropdown">
                                                                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                                                        </a>
                                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                                            <li><a class="dropdown-item" href="<?= base_url('survey/preview/') ?><?= $survey->id ?>">Preview</a></li>
                                                                                            <li><a class="dropdown-item" href="<?= base_url('survey/edit/') ?><?= $survey->id ?>">Edit</a></li>
                                                                                            <li><a class="dropdown-item" href="<?= base_url('survey/share/') ?><?= $survey->id ?>">Share</a></li>
                                                                                            <li><a class="dropdown-item" href="<?= base_url('survey/delete/') ?><?= $survey->id ?>">Delete</a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                                if ($survey->survey_theme == null || $survey->theme_id === null) :
                                                                                    $survey_thumbnail = 'https://via.placeholder.com/150';
                                                                                else :
                                                                                    if ($survey->backgroundImage != null && $survey->useBackgroundImage == true) :
                                                                                        if ($survey->customBackgroundImage != "") :
                                                                                            $survey_thumbnail = base_url('uploads/survey/image_custom_background_db/') . $survey->customBackgroundImage;
                                                                                        else :
                                                                                            $survey_thumbnail = base_url('assets/survey/template_images/') . $survey->backgroundImage;
                                                                                        endif;
                                                                                    else :
                                                                                        $survey_thumbnail = base_url('uploads/survey/themes/') . $survey->survey_theme->sth_primary_image;
                                                                                    endif;
                                                                                ?>
                                                                                <?php endif; ?>
                                                                                <div class="nsm-card-thumbnail" style="background-image: url('<?= $survey_thumbnail ?>')"></div>
                                                                            </div>
                                                                            <div class="col-12 text-center p-3">
                                                                                <div class="nsm-card-title">
                                                                                    <span><?= $survey->title ?></span>
                                                                                </div>
                                                                                <label class="nsm-subtitle d-block"><?= $survey->date_created ?></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Templates</span>
                                    <label class="nsm-subtitle d-block">Here are the list of templates that include all the questions at your disposal.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="accordion accordion-flush" id="templates_parent">
                                            <?php foreach ($template_categories as $key => $category) : ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="template-heading-<?= $key ?>">
                                                        <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#template-item-<?= $key ?>" aria-expanded="false" aria-controls="template-item-<?= $key ?>">
                                                            <?= $category ?>
                                                        </div>
                                                    </h2>
                                                    <div id="template-item-<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="template-heading-<?= $key ?>" data-bs-parent="#templates_parent">
                                                        <div class="accordion-body py-3 px-0">
                                                            <div class="row g-3">
                                                                <?php
                                                                foreach ($survey_templates as $template) :
                                                                    if ($template->category === $category) :
                                                                        $theme = null;

                                                                        if ($template->theme_id !== null) :
                                                                            foreach ($survey_themes as $key => $survey_theme) :
                                                                                if ($template->theme_id == $survey_theme->sth_rec_no) :
                                                                                    $theme = $survey_theme;
                                                                                    break;
                                                                                endif;
                                                                            endforeach;
                                                                        endif;
                                                                ?>
                                                                        <div class="col-12 col-md-3">
                                                                            <div class="nsm-card p-0 template-item" role="button" data-id="<?= $template->id ?>">
                                                                                <div class="nsm-card-content">
                                                                                    <div class="row">
                                                                                        <div class="col-12 thumbnail-header">
                                                                                            <?php
                                                                                            if (empty($template->background_image)) :
                                                                                                $image = base_url("uploads/survey/themes/") . $theme->sth_primary_image;
                                                                                            else :
                                                                                                $image = base_url("assets/survey/template_images/") . $template->background_image;
                                                                                            endif;
                                                                                            ?>
                                                                                            <div class="nsm-card-thumbnail" style="background-image: url('<?= $image ?>')"></div>
                                                                                        </div>
                                                                                        <div class="col-12 text-center p-3">
                                                                                            <div class="nsm-card-title">
                                                                                                <span><?= $template->name ?></span>
                                                                                            </div>
                                                                                            <label class="nsm-subtitle d-block"><?= $category ?></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                <?php
                                                                    endif;
                                                                endforeach;
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
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
    let viewingTemplate = null;
    let templates = <?= json_encode($survey_templates) ?>;
    let templateQuestions = <?= json_encode($survey_question_templates) ?>;
    let recentSurveys = <?= json_encode($surveys) ?>;
    recentSurveys.sort((a, b) => {
        if (a.date_created > b.date_created) {
            return -1;
        }
        if (a.date_created < b.date_created) {
            return 1
        }
        return 0;
    }).splice(5);

    $(document).ready(function() {
        $("ul.workspace-list li").on("click", function() {
            $(this).closest("ul").find("li.active").removeClass('active')
            $(this).parent('li').addClass('active')
        });

        $("div.workspace-list li").on("click", function() {
            $("div.workspace-list button.dropdown-toggle > span").html($(this).find(".workspace-name").html());
        });

        $(document).on("click", ".workspace-item", function(e) {
            let id = $(this).attr("data-id");
            location.href = "<?= base_url() ?>survey/result/" + id;;
        });

        $(document).on("click", ".workspace-item .dropdown-toggle", function(e) {
            e.stopPropagation();
        });

        $(document).on("click", ".edit-workspace", function(e) {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#workspace_id").val(id);
            $("#txtWorkspaceName").val(name);
            $("#edit_workspace_modal").modal("show");
        });

        $("#edit_workspace").on("click", function() {
            let _this = $(this);
            let id = $("#workspace_id").val();
            let name = $("#txtWorkspaceName").val();
            let url = "<?php echo base_url(); ?>survey/workspace/edit/" + id;
            let workspace_data = {
                'txtWorkspaceName': name
            }

            _this.html("Saving");
            _this.prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: workspace_data,
                success: function(result) {
                    Swal.fire({
                        title: 'Update Successful!',
                        text: "Workspace has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    $("#edit_workspace_modal").modal('hide');
                    $("#txtWorkspaceName").val('');

                    _this.html("Save");
                    _this.prop("disabled", false);
                },
            });
        })

        $(document).on("click", ".delete-workspace", function(e) {
            let id = $(this).attr("data-id");

            Swal.fire({
                title: 'Delete Workspace',
                text: "Are you sure you want to delete this Workspace?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo base_url(); ?>survey/workspace/delete/" + id,
                        success: function(result) {
                            Swal.fire({
                                title: 'Good job!',
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });

        $(document).on("click", ".template-item", function(e) {
            let id = $(this).attr("data-id");
            let _container = $("#template_details_container");
            showLoader(_container);

            viewingTemplate = templates.find(data => {
                if (data.id === parseInt(id)) {
                    return data
                }
            });

            
            let questionContent = `<div class="row g-3">`;
            questionContent += `<div class="col-12"><label class="content-title">Recently created surveys</label></div>`;

            viewingTemplate.questions.map((question) => {
                let tempQuestion = templateQuestions.find(data => {
                    if (data.id === question.temp_id) return data
                });

                questionContent += `<div class="col-12 d-flex p-2 align-items-center"><div class="nsm-questions-icon" style="background-color: ${tempQuestion.color}"><i class='bx bx-circle'></i></div> <label class="content-title fw-normal">${question.question}</label> </div>`;
            });
            questionContent += `</div>`;

            _container.html(questionContent);

            $("#template_modal").modal("show");
        });

        $("#btn_use_template").on("click", function(e){
            location.href = `<?= base_url()?>survey/add?th=${viewingTemplate.id}`;
        });

        recentSurveys.map((item) => {
            document.querySelector("#recent_surveys_container").innerHTML += `
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-0 workspace-item" role="button" data-id="${item.id}">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 thumbnail-header">
                                        <div class="nsm-card-thumbnail" style="background-image: url('${item.survey_theme == null || item.theme_id === null ? "https://via.placeholder.com/150" : (item.backgroundImage != null && item.useBackgroundImage === true) ? (item.backgroundImage != null && item.useBackgroundImage == true) ? "<?= base_url() ?>uploads/survey/image_custom_background_db/"+item.customBackgroundImage : "<?= base_url() ?>assets/survey/template_images/"+item.backgroundImage : "<?= base_url() ?>uploads/survey/themes/"+item.survey_theme.sth_primary_image}')"></div>
                                    </div>
                                    <div class="col-12 text-center p-3">
                                        <div class="nsm-card-title">
                                            <span>${item.title}</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">${item.date_created}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        });

        JSON.parse(localStorage.getItem('survey_ro')).map((item) => {
            document.querySelector('#recently_opened').innerHTML += `
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-0 workspace-item" role="button" data-id="${item.id}">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 thumbnail-header">
                                        <div class="nsm-card-thumbnail" style="background-image: url('${item.survey_theme == null || item.theme_id === null ? "https://via.placeholder.com/150" : (item.backgroundImage != null && item.useBackgroundImage === true) ? (item.backgroundImage != null && item.useBackgroundImage == true) ? "<?= base_url() ?>uploads/survey/image_custom_background_db/"+item.customBackgroundImage : "<?= base_url() ?>assets/survey/template_images/"+item.backgroundImage : "<?= base_url() ?>uploads/survey/themes/"+item.survey_theme.sth_primary_image}')"></div>
                                    </div>
                                    <div class="col-12 text-center p-3">
                                        <div class="nsm-card-title">
                                            <span>${item.title}</span>
                                        </div>
                                        <label class="nsm-subtitle d-block">${item.date_created}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
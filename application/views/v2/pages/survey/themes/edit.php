<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<style>
    input[type="color" i]{
        border: none;
        padding: 0;
        margin: 0;
        width: 100%;
    }

    .line-separator{
        padding: 3px 10px;
        background-color: #fff;
        width: 100px;
        margin: 10px auto;
    }

    #themeSampleWrapper{
        
        z-index: 0;
    }

    .theme-sample{
        /*display: flex;*/
        overflow: none;
        padding: 10px 0;
        height: 100%;
        width: 100%;
    }

    .theme-sample-content{
        /*position: absolute;
        z-index: 1;
        padding: 15% 0;*/

        position: absolute;
        z-index: 110px;
        padding: 15% 0;
        top: 204px;
        right: 852px;
        font-weight: bold;
        width: 47%;
    }

    .theme-image{
        width: 100%;
        /*height: 350pt;*/
        object-fit: cover;
    }
    .theme-image{
        /*margin: 0 50%;*/
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <div>Edit theme<br /><br /><i class='bx bxs-info-circle' ></i> Before submitting your theme, make sure you view first your design before submitting your theme.</div>
                        </div>
                    </div>
                </div>

                <?= form_open_multipart('survey/themes/update/'.$theme->sth_rec_no, array('id'=>'frm-add-survey-theme'))?>

                    <div id="imagePreviewError" style="display: none" class="alert alert-danger w-100">
                        <i class="fa fa-times"></i>
                        Image has not yet been set. Add an image to see the design.
                    </div>
                    
                    <div class="row">
                        <div id="themeSampleWrapper" class="col-md-8">
                            <div class="theme-sample">
                                <div class="theme-sample-content container-fluid">
                                    <div class="text-center">
                                        <h1 id="sampleHeaderText">Lorem Ipsum</h1>
                                        <div id="sampleLineSeparator" class="line-separator"></div>
                                        <p id="sampleParagraph">This is where the text will be placed. Another sentence to fill in the spaces of your survey.</p>
                                        <button id="samplePrimaryButton" type="button" class="nsm-button primary">Primary Button</button>
                                        <button id="sampleSecondaryButton" type="button" class="nsm-button primary ">Secondary Button</button>
                                    </div>
                                
                                </div>
                                <img id="imageContainer" src="https://via.placeholder.com/1200x500/fff" alt="uploaded-image" class="theme-image">
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="form-group mb-5">
                                <label for="txtName">What's the name of your theme?</label>
                                <input type="text" name="sth_theme_name" id="txtName" class="form-control" placeholder="Enter name here"/>
                                <div id="themeNameError" class="invalid-feedback" >
                                    Please provide a name.
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label for="filePrimaryImage">Choose your background image</label><br />                                
                                <input class="form-control" type="file" name="filePrimaryImage" id="filePrimaryImage" >
                            </div>
                            <div class="theme-colors">
                                <label>Theme colors:</label>
                                <div class="form-row row">
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_primary_color" id="colPrimary" value="#9D344B" data-toggle="tooltip" data-placement="top" title="Primary Color">
                                        <small>Primary Button</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_secondary_color" id="colSecondary" value="#257059" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <small>Secondary Button</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_tertiary_color" id="colTertiary" value="#8AA236" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <small>Tertiary</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_success_color" id="colSuccess" value="#00BC0C">
                                        <small>Success</small>
                                    </div>
                                </div>
                                <div class="form-row row">                                    
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_info_color" id="colInfo" value="#045899">
                                        <small>Info</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_warning_color" id="colWarning" value="#EF6C00">
                                        <small>Warning</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-3 text-center">
                                        <input class="form-control" type="color" name="sth_danger_color" id="colDanger" value="#EF0000">
                                        <small>Danger</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <label>Text colors:</label>
                                <div class="form-row row">
                                    <div class="form-group col-xs-6 col-sm-4 col-md-6 text-center">
                                        <input class="form-control" type="color" name="sth_text_color" id="colTextMain" value="#ffffff">
                                        <small>Text</small>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-6 text-center">
                                        <input class="form-control" type="color" name="sth_dark_text_color" id="colTextDark" value="#222222">
                                        <small>Dark Mode Text</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-12 mt-3 text-end">
                          <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('survey') ?>'">Go Back to Survey List</button>
                          <button id="btnPreview" class="nsm-button primary" type="button" style="margin:5px;">Preview</button>
                          <button id="btnSubmit" class="nsm-button primary" type="submit" style="margin:5px;">Update Theme</button>                          
                      </div>
                    </div>

                    <div class="row container">
                      <div id="workspace-text-card" class="col-xs-12 col-sm-6 card" style="display: none">
                        <span class="h3" id="workspace-text">No workspace selected</span>
                        <button class="btn btn-link btn-block btn-info text-white" data-toggle="modal" data-target="#modalSelectWorkspace">Change workspace</button>
                      </div>
                    </div>


                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    let imageContainer = document.querySelector('#imageContainer');
    let uploadedImage = document.querySelector("#filePrimaryImage");
    let fileReader = new FileReader();

    document.querySelector('#txtName').value = `<?=$theme->sth_theme_name?>`;
    document.querySelector('#colPrimary').value = `<?=$theme->sth_primary_color?>`;
    document.querySelector('#colSecondary').value = `<?=$theme->sth_secondary_color?>`;
    document.querySelector('#colTertiary').value = `<?=$theme->sth_tertiary_color?>`;
    document.querySelector('#colSuccess').value = `<?=$theme->sth_success_color?>`;
    document.querySelector('#colInfo').value = `<?=$theme->sth_info_color?>`;
    document.querySelector('#colWarning').value = `<?=$theme->sth_warning_color?>`;
    document.querySelector('#colDanger').value = `<?=$theme->sth_danger_color?>`;
    document.querySelector('#colTextMain').value = `<?=$theme->sth_text_color?>`;
    document.querySelector('#colTextDark').value = `<?=$theme->sth_dark_text_color?>`;

    <?php if( $theme->company_id > 0 ){ ?>
        imageContainer.src = `<?=base_url()?>uploads/survey/themes/<?= $theme->company_id; ?>/<?=$theme->sth_primary_image?>`;
    <?php }else{ ?>
        imageContainer.src = `<?=base_url()?>uploads/survey/themes/<?=$theme->sth_primary_image?>`;
    <?php } ?>
    
    document.querySelector('#sampleHeaderText').style.color = `<?=$theme->sth_text_color?>`;
    document.querySelector('#sampleParagraph').style.color = `<?=$theme->sth_text_color?>`;
    document.querySelector('#sampleLineSeparator').style.backgroundColor = `<?=$theme->sth_secondary_color?>`;
    document.querySelector('#samplePrimaryButton').style.backgroundColor = `<?=$theme->sth_primary_color?>`;
    document.querySelector('#samplePrimaryButton').style.color = `<?=$theme->sth_text_color?>`;
    document.querySelector('#sampleSecondaryButton').style.backgroundColor = `<?=$theme->sth_secondary_color?>`;
    document.querySelector('#sampleSecondaryButton').style.color = `<?=$theme->sth_text_color?>`;

    uploadedImage.addEventListener('change', () => {
        document.querySelector('#themeSampleWrapper').style.display = 'flex';
        if(uploadedImage.files && uploadedImage.files[0]){
                document.querySelector('#imagePreviewError').style.display = 'none';
                fileReader.onload = e => {
                    imageContainer.src = e.target.result;
                }
                fileReader.readAsDataURL(uploadedImage.files[0]);
        }
    });

    document.querySelector('#btnPreview').addEventListener('click',() => {
        
        document.querySelector('#sampleHeaderText').style.color = document.querySelector('#colTextMain').value;
        document.querySelector('#sampleParagraph').style.color = document.querySelector('#colTextMain').value;
        document.querySelector('#sampleLineSeparator').style.backgroundColor = document.querySelector('#colSecondary').value;
        document.querySelector('#samplePrimaryButton').style.backgroundColor = document.querySelector('#colPrimary').value;
        document.querySelector('#samplePrimaryButton').style.color = document.querySelector('#colTextMain').value;
        document.querySelector('#sampleSecondaryButton').style.backgroundColor = document.querySelector('#colSecondary').value;
        document.querySelector('#sampleSecondaryButton').style.color = document.querySelector('#colTextMain').value;
    })

    document.querySelector('#btnasdfubmit').addEventListener('click',(e) => {
        e.preventDefault();
        let error = false;
        if(document.querySelector('#txtName').value === '' || !uploadedImage.files[0] ){
                if(document.querySelector('#txtName').value === ''){
                    console.log("Please enter a name.")
                    document.querySelector('#themeNameError').style.display = "inline-block";
                }else{
                    document.querySelector('#themeNameError').style.display = "none";
                }

                if(!uploadedImage. files[0]){
                    console.log("Add an image");
                }
                error = true;
        }

        let data = {
            'sth_theme_name' : document.querySelector('#txtName').value,
            'sth_primary_color': document.querySelector('#colPrimary').value,
            'sth_secondary_color': document.querySelector('#colSecondary').value,
            'sth_tertiary_color': document.querySelector('#colTertiary').value,
            'sth_success_color': document.querySelector('#colSuccess').value,
            'sth_info_color': document.querySelector('#colInfo').value,
            'sth_warning_color': document.querySelector('#colWarning').value,
            'sth_danger_color': document.querySelector('#colDanger').value,
            'sth_text_color': document.querySelector('#colTextMain').value,
            'sth_dark_text_color': document.querySelector('#colTextDark').value,
            'sth_primary_image': document.querySelector('#txtName').value,
            'image': document.querySelector('#filePrimaryImage'),
        }
    });
});
</script>
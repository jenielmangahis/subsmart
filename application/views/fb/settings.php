<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper px-0">
    <div __wrapper_section class="fb-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pr-5" id="navFormName" href="#">aa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/fb/edit/<?= $form_id ?>">Form Editor</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/fb/settings/<?= $form_id ?>">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Results</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-container container-fluid bg-white pt-3 pb-5">
            <h4>Form Settings</h4>
            <div class="row">
                <div class="col-12 col-md-3 border-right">
                    <div class="container-fluid px-0 mt-0">
                        <ul id="accordion" class="accordion">
                            <li>
                                <div class="link"></i>General<i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="submenu">
                                    <div class="container-fluid mt-0 py-2">
                                        <ul class="nav flex-column text-left">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#formDescriptionTab"
                                                    data-toggle="tab">Description</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#formOpenCloseTab"
                                                    data-toggle="tab">Open/Close</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#formSecurityTab"
                                                    data-toggle="tab">Security</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#formDailySummaryTab" data-toggle="tab">Daily
                                                    Summary</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- <li>
                                <div class="link"></i>Notifications<i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="submenu">
                                    <div class="container-fluid mt-0 py-2 text-left text-white">
                                        lorem ipsum
                                    </div>
                                </div>
                            </li> -->
                            <!-- <li>
                                <div class="link"></i>Success Pages<i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="submenu">
                                    <div class="container-fluid mt-0 py-2 text-left">
                                        <div class="form-group text-white">
                                            <label for="form-default-success-page">Default Page:</label>
                                            <select class="form-control my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                            </select>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm mr-1">+ New Success Page</button>
                                            <button class="btn btn-secondary btn-sm">Copy From...</button>
                                        </div>
                                        <div class="container-fluid mt-2 bg-secondary text-dark">
                                            <b>New Success Page</b>
                                            <p>Not Saved Yet</p>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9 position-relative">
                    <div id="loadingContainer" class="bg-primary indicator">
                        <p class="text-white">loading...</p>
                    </div>
                    <div id="dangerIndicator" class="bg-danger indicator">
                        <p class="text-white">error saving changes.</p>
                    </div>
                    <div id="successIndicator" class="bg-success indicator">
                        <p class="text-white">changes saved.</p>
                    </div>                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="formDescriptionTab">
                            <div class="container mt-0">
                                <h4>General</h4>
                                <div class="card">
                                    <div class="card-header">
                                        Description
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="form-name">Form Name:</label>
                                            <input type="text" class="form-control" id="formName" name="form-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="form-private-notes">Private Notes:</label>
                                            <textarea class="form-control" name="form-private-notes"
                                                id="formPrivateNotes" cols="30" rows="10"></textarea>
                                            <small><i>Internal notes or comments</i></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-social-description">Social Description:</label>
                                            <textarea class="form-control" name="form-social-description"
                                                id="formSocialDescription" cols="30" rows="10"
                                                value="View this in nsmartrac"></textarea>
                                            <small><i>This will appear as this form's description when shared on
                                                    social networks.</i></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-social-image">Social Image <a href="#">(Choose
                                                    Image...)</a></label>
                                            <input type="text" class="form-control" id="formSocialImage"
                                                name="form-social-image">
                                        </div>
                                        <div class="w-100 text-center">
                                            <button class="btn btn-success" onclick="handleDescriptionSave(<?= $form_id ?>)">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="formOpenCloseTab">
                            <div class="container mt-0">
                                <h4>General</h4>
                                <div class="card">
                                    <div class="card-header">
                                        Open Close
                                    </div>
                                    <div class="container mt-0">
                                        <div class="container bg-secondary mt-2 py-4">
                                            <div class="form-check">
                                                <input class="form-check-input open-close-limit" type="checkbox" value=""
                                                    id="chkStartDate">
                                                <label class="form-check-label" for="chkStartDate">
                                                    Use Start Date...
                                                </label>
                                                <br><small><i>Open this form after this date.</i></small>
                                                <div class="container mt-2 d-none">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="form-start-time">Start Date:</label>
                                                                <input type="text" class="form-control datepicker"
                                                                    id="formStartDate">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="form-start-time">Time:</label>
                                                                <input type="text" class="form-control"
                                                                    id="formStartTime">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-start-time-title">Title</label>
                                                        <input type="text" class="form-control" id="formStartTimeTitle"
                                                            name="form-start-time-title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-start-time-message">Message</label>
                                                        <textarea cols="30" rows="10" class="form-control"
                                                            id="formStartTimeMessage"
                                                            name="form-start-time-message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container bg-secondary mt-2 py-4">
                                            <div class="form-check">
                                                <input class="form-check-input open-close-limit" type="checkbox" value=""
                                                    id="chkEndDate">
                                                <label class="form-check-label" for="chkEndDate">
                                                    Use End Date...
                                                </label>
                                                <br><small><i>Close this form after this date.</i></small>
                                                <div class="container mt-2 d-none">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="form-end-time">End Date:</label>
                                                                <input type="text" class="form-control datepicker"
                                                                    id="formEndDate">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="form-end-time">Time:</label>
                                                                <input type="text" class="form-control"
                                                                    id="formEndTime">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-result-limit-title">Title</label>
                                                        <input type="text" class="form-control" id="formEndTimeTitle"
                                                            name="form-result-limit-title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-result-limit-message">Message</label>
                                                        <textarea cols="30" rows="10" class="form-control"
                                                            id="formEndTimeMessage"
                                                            name="form-result-limit-message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container bg-secondary mt-2 py-4">
                                            <div class="form-check">
                                                <input class="form-check-input open-close-limit" type="checkbox" value=""
                                                    id="chkResultsLimit">
                                                <label class="form-check-label" for="chkResultsLimit">
                                                    Use Results Limit...
                                                </label>
                                                <br><small><i>Close this form after this many stored
                                                        results.</i></small>
                                                <div class="container mt-2 d-none">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="form-end-time">Results Limit:</label>
                                                                <input type="number" class="form-control datepicker"
                                                                    id="formResultLimit">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-end-time-title">Title</label>
                                                        <input type="text" class="form-control"
                                                            id="formResultLimitTitle" name="form-end-time-title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-end-time-message">Message</label>
                                                        <textarea cols="30" rows="10" class="form-control"
                                                            id="formResultLimitMessage"
                                                            name="form-end-time-message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="formSecurityTab">
                            <div class="container mt-0">
                                <h4>General</h4>
                                <div class="card">
                                    <div class="card-header">
                                        Security
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group w-50">
                                            <label for="form-password">Form Password:</label>
                                            <input type="password" name="form-password" id="form-password"
                                                class="form-control">
                                        </div>
                                        <div class="form-check w-50">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="formSecurityBadge">
                                            <label class="form-check-label" for="formSecurityBadge">
                                                Show "Secured By Nsmartrac" badge
                                            </label>
                                        </div>
                                        <div class="form-group w-50 mt-3">
                                            <label class="d-block">reCAPTCHA</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="formReCaptcha" id="formReCaptchaOff">
                                                <label class="form-check-label" for="formReCaptchaOff">Off</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="formReCaptcha" id="formReCaptchaAutoShow" selected="true">
                                                <label class="form-check-label" for="formReCaptchaAutoShow">Auto Show</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="formReCaptcha" id="formReCaptchaAlwaysShow">
                                                <label class="form-check-label" for="formReCaptchaAlwaysShow">Always Show</label>
                                            </div>
                                            <small class="d-block"><i>Require users to solve a captcha to submit this form.</i></small>
                                        </div>
                                        <div class="form-group w-50">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="formAnonymousSubmissions">
                                                <label class="form-check-label" for="formAnonymousSubmissions">
                                                    Anonymous submissions
                                                </label>
                                            </div>   
                                            <small class="d-block"><i>Do not store IP and browser info for results.</i></small>
                                        </div>
                                        <div class="form-group w-50">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="formMultipleSubmissions">
                                                <label class="form-check-label" for="formMultipleSubmissions">
                                                    Prevent multiple submissions per user
                                                </label>
                                            </div>   
                                        </div>    
                                        <div class="form-group w-50">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="formAnonymousSubmissions">
                                                <label class="form-check-label" for="formAnonymousSubmissions">
                                                    Require login to access files
                                                </label>
                                            </div>   
                                            <small class="d-block"><i>Enhanced security, control, and audit trails. Usually necessary to meet compliance standards.</i></small>
                                        </div>                                                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="formDailySummaryTab">
                            <div class="container mt-0">
                                <h4>General</h4>
                                <div class="card">
                                    <div class="card-header">
                                        DailySummary
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group w-75">
                                                <label for="daily-summary-emails">To Email Addresses:</label>
                                                <input type="text" name="daily-summary-emails" id="dailySummaryEmails" class="form-control">
                                            </div>
                                            <div class="w-100 text-center">
                                                <button class="btn btn-success">Save</button>
                                            </div>
                                        </form>
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
<?php include viewPath('includes/footer'); ?>
<script>
$(() => {
    refreshForm(<?= $form_id ?>);
});
</script>
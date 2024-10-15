<div class="row duplicateManagementContent d-none">
    <div class="col-lg-12 mb-3 dupWizardStep1">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-residential-tab" data-bs-toggle="pill" data-bs-target="#pills-residential" type="button" role="tab">Residential</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-commercial-tab" data-bs-toggle="pill" data-bs-target="#pills-commercial" type="button" role="tab">Commercial</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-residential" role="tabpanel">
                <table id="customerDuplicateTable" class="table table-hover w-100 border-0" style="border-color: #cdcdcd !important;">
                    <thead>
                        <tr>
                            <th>CUSTOMER</th>
                            <th>TYPE</th>
                            <th>ADDRESS</th>
                            <th>LOGS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-commercial" role="tabpanel">
                <table id="commercialDuplicateTable" class="table table-hover w-100 border-0" style="border-color: #cdcdcd !important;">
                    <thead>
                        <tr>
                            <th>COMMERCIAL</th>
                            <th>TYPE</th>
                            <th>ADDRESS</th>
                            <th>LOGS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-3 dupWizardStep2 displayHide">
        <div class="container-fluid mb-3 mt-3">
            <div class="row">
                <h4 class="fw-bold">Compare and Merge</h4>
                <p>Select specific fields to be used for the merged output entry.</p>
            </div>
        </div>
        <div class="row flexWrapUnset">
            <div class="col-lg-1 w-auto entryFields">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="float-end align-middle invisible"><span>PLACEHOLDER</span></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle">
                                <div class="nsm-profile invisible"><span>PLACEHOLDER</span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>STATUS:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>CUSTOMER TYPE:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>BUSINESS NAME:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>CUSTOMER GROUP:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>SALES AREA:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>FIRST NAME:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>MIDDLE NAME:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>LAST NAME:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>NAME PREFIX:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>SUFFIX:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>COUNTRY:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>ADDRESS:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>CITY:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>COUNTY:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>STATE:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>ZIP CODE:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>CROSS STREET:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>SUBDIVISION:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>SOCIAL SECURITY NO.:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>BIRTHDATE:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>EMAIL:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>PHONE:</strong></td>
                        </tr>
                        <tr>
                            <td class="float-end align-middle text-muted"><strong>MOBILE:</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-1 w-auto fetchingDataLoader"><strong>COLLECTING DATA PLEASE WAIT...</strong></div>
            <div class="col-lg-1 w-auto">
                <div class="d-flex h-100">
                    <div class="vr"></div>
                </div>
            </div>
            <div class="col-lg-2 mergeOutputEntryWidth">
                <form id="mergeEntryForm">
                    <table class="table table-hover destinationData">
                        <tbody>
                            <tr>
                                <td class="align-middle fw-xnormal"><small class="entryDestinationLogsCount">0 activity logs</small></td>
                            </tr>
                            <tr>
                                <td class="align-middle destinationProfileData">
                                    <div class="float-start">
                                        <div class="nsm-profile"><span class="entryDestinationInitials">?</span></div>
                                    </div>
                                    <div class="mergeProfile">
                                        <label class="nsm-link default d-block fw-bold"><span class="entryDestinationName">Customer Name</span><small class="text-muted float-end entryDestinationID">#00000</small></label>
                                        <label class="nsm-link default content-subtitle fst-italic d-block"><span class="entryDestinationEmail">Email Address</span></label>
                                        <input type="hidden" name="destinationCustomerID" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationStatus" required>
                                        <option selected value="">—</option>
                                        <?php foreach ($customer_status as $customer_statuses): ?>
                                        <option value="<?php echo $customer_statuses->name ?>"><?php echo $customer_statuses->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationCustomerType" required>
                                        <option selected value="">—</option>
                                        <option value="Residential">Residential</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationBusinessName" placeholder="—">
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationCustomerGroup" required>
                                        <option selected value="">—</option>
                                        <?php foreach ($customer_group as $customer_groups): ?>
                                        <option value="<?php echo $customer_groups->id ?>"><?php echo $customer_groups->title ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationSalesArea" required>
                                        <option selected value="">—</option>
                                        <?php foreach ($sales_area as $sales_areas): ?>
                                        <option value="<?php echo $sales_areas->sa_id ?>"><?php echo $sales_areas->sa_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationFirstName" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationMiddleName" placeholder="—">
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationLastName" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationNamePrefix">
                                        <option selected value="">None</option>
                                        <option value="Captain">Captain</option>
                                        <option value="Cnl.">Cnl.</option>
                                        <option value="Colonel">Colonel</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Gen.">Gen.</option>
                                        <option value="Judge">Judge</option>
                                        <option value="Lady">Lady</option>
                                        <option value="Lieutenant">Lieutenant</option>
                                        <option value="Lord">Lord</option>
                                        <option value="Lt.">Lt.</option>
                                        <option value="Madam">Madam</option>
                                        <option value="Major">Major</option>
                                        <option value="Master">Master</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mister">Mister</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Maj.">Maj.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Pastor">Pastor</option>
                                        <option value="Private">Private</option>
                                        <option value="Prof.">Prof.</option>
                                        <option value="Pvt.">Pvt.</option>
                                        <option value="Rev.">Rev.</option>
                                        <option value="Sergeant">Sergeant</option>
                                        <option value="Sgt">Sgt</option>
                                        <option value="Sir">Sir</option>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <select class="form-select fw-bold border-0" name="destinationSuffix">
                                        <option selected value="">None</option>
                                        <option value="DS">DS</option>
                                        <option value="Esq.">Esq.</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV.">IV.</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="MA">MA</option>
                                        <option value="MBA">MBA</option>
                                        <option value="MD">MD</option>
                                        <option value="MS">MS</option>
                                        <option value="PhD">PhD</option>
                                        <option value="RN">RN</option>
                                        <option value="Sr.">Sr.</option>
                                    </select>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationCountry" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationAddress" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationCity" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationCounty" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationState" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationZipCode" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationCrossStreet" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationSubdivision" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationSocialSecurityNo" maxlength="11" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="date" name="destinationBirthdate" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="email" name="destinationEmail" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationPhone" maxlength="12" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle padding2px">
                                    <input class="form-control fw-bold border-0" type="text" name="destinationMobile" maxlength="12" placeholder="—" required>
                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="float-end">
                        <input class="form-control fw-bold border-0" type="hidden" name="originFirstname">
                        <input class="form-control fw-bold border-0" type="hidden" name="originLastname">
                        <input class="form-control fw-bold border-0" type="hidden" name="originBusinessName">
                        <button type="button" class="nsm-button sm backToDuplicateList"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Back</button>
                        <button type="submit" class="nsm-button primary sm"><i class="fas fa-copy"></i>&nbsp;&nbsp;Merge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var loadStatus = 0;

    $(document).on('click', '.profileData', function() {
        $('.profileData').css({
            'outline': '0px dashed darkblue'
        });
        $(this).css({
            'outline': '1px dashed darkblue'
        });
        $('.destinationProfileData').css({
            'outline': '1px dashed green'
        });
        // =======
        const logsCount = $(this).attr('data-logscount');
        const nameInitials = $(this).find('.entryDuplicateInitials').text();
        const name = $(this).find('.entryDuplicateName').text();
        const id = $(this).find('.entryDuplicateID').text();
        const email = $(this).find('.entryDuplicateEmail').text();
        $('.entryDestinationLogsCount').text(logsCount);
        $('.entryDestinationInitials').text(nameInitials);
        $('.entryDestinationName').text(name);
        $('.entryDestinationID').text(id);
        $('.entryDestinationEmail').text(email);
        $('input[name="destinationCustomerID"]').val(id.replace(/[#\s]/g, ''));
    });

    $(document).on('click', '.statusField', function() {
        $('.statusField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const status = $(this).find('span').text();
        if (status != "—" && status != "NULL") {
            $('select[name="destinationStatus"] option:contains("' + status + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.customerTypeField', function() {
        $('.customerTypeField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const customer_type = $(this).find('span').text();
        if (customer_type != "—" && customer_type != "NULL") {
            $('select[name="destinationCustomerType"] option:contains("' + customer_type + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.businessNameField', function() {
        $('.businessNameField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const businessName = $(this).find('span').text();
        if (businessName != "—" && businessName != "NULL") {
            $('input[name="destinationBusinessName"]').val(businessName).change();
            $('input[name="originBusinessName"]').val(businessName).change();
        }
    });

    $(document).on('click', '.customerGroupField', function() {
        $('.customerGroupField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const customer_group = $(this).find('span').text();
        if (customer_group != "—" && customer_group != "NULL") {
            $('select[name="destinationCustomerGroup"] option:contains("' + customer_group + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.salesAreaField', function() {
        $('.salesAreaField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const sales_area = $(this).find('span').text();
        if (sales_area != "—" && sales_area != "NULL") {
            $('select[name="destinationSalesArea"] option:contains("' + sales_area + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.firstNameField', function() {
        $('.firstNameField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const firstName = $(this).find('span').text();
        if (firstName != "—" && firstName != "NULL") {
            $('input[name="destinationFirstName"]').val(firstName).change();
            $('input[name="originFirstname"]').val(firstName).change();
        }
    });

    $(document).on('click', '.middleNameField', function() {
        $('.middleNameField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const middleName = $(this).find('span').text();
        if (middleName != "—" && middleName != "NULL") {
            $('input[name="destinationMiddleName"]').val(middleName).change();
        }
    });

    $(document).on('click', '.lastNameField', function() {
        $('.lastNameField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const lastName = $(this).find('span').text();
        if (lastName != "—" && lastName != "NULL") {
            $('input[name="destinationLastName"]').val(lastName).change();
            $('input[name="originLastname"]').val(lastName).change();
        }
    });

    $(document).on('click', '.namePrefixField', function() {
        $('.namePrefixField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const prefix = $(this).find('span').text();
        if (prefix != "—" && prefix != "NULL") {
            $('select[name="destinationNamePrefix"] option:contains("' + prefix + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.suffixField', function() {
        $('.suffixField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const suffix = $(this).find('span').text();
        if (suffix != "—" && suffix != "NULL") {
            $('select[name="destinationNamePrefix"] option:contains("' + suffix + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.countryField', function() {
        $('.countryField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const country = $(this).find('span').text();
        if (country != "—" && country != "NULL") {
            $('input[name="destinationCountry"]').val(country).change();
        }
    });

    $(document).on('click', '.addressField', function() {
        $('.addressField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const address = $(this).find('span').text();
        if (address != "—" && address != "NULL") {
            $('input[name="destinationAddress"]').val(address).change();
        }
    });

    $(document).on('click', '.cityField', function() {
        $('.cityField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const city = $(this).find('span').text();
        if (city != "—" && city != "NULL") {
            $('input[name="destinationCity"]').val(city).change();
        }
    });

    $(document).on('click', '.countyField', function() {
        $('.countyField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const county = $(this).find('span').text();
        if (county != "—" && county != "NULL") {
            $('input[name="destinationCounty"]').val(county).change();
        }
    });

    $(document).on('click', '.stateField', function() {
        $('.stateField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const state = $(this).find('span').text();
        if (state != "—" && state != "NULL") {
            $('input[name="destinationState"]').val(state).change();
        }
    });

    $(document).on('click', '.zipCodeField', function() {
        $('.zipCodeField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const zip = $(this).find('span').text();
        if (zip != "—" && zip != "NULL") {
            $('input[name="destinationZipCode"]').val(zip).change();
        }
    });

    $(document).on('click', '.crossStreetField', function() {
        $('.crossStreetField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const crossStreet = $(this).find('span').text();
        if (crossStreet != "—" && crossStreet != "NULL") {
            $('input[name="destinationCrossStreet"]').val(crossStreet).change();
        }
    });

    $(document).on('click', '.subDivisionField', function() {
        $('.subDivisionField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const subdivision = $(this).find('span').text();
        if (subdivision != "—" && subdivision != "NULL") {
            $('input[name="destinationSubdivision"]').val(subdivision).change();
        }
    });

    $(document).on('click', '.socialSecurityNoField', function() {
        $('.socialSecurityNoField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const socialSecurityNo = $(this).find('span').text();
        if (socialSecurityNo != "—" && socialSecurityNo != "NULL") {
            $('input[name="destinationSocialSecurityNo"]').val(socialSecurityNo).change();
        }
    });

    $(document).on('click', '.birthDateField', function() {
        $('.birthDateField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const birthdate = $(this).find('span').text();
        if (birthdate != "—" && birthdate != "NULL") {
            $('input[name="destinationBirthdate"]').val(birthdate).change();
        }
    });

    $(document).on('click', '.emailField', function() {
        $('.emailField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const email = $(this).find('span').text();
        if (email != "—" && email != "NULL") {
            $('input[name="destinationEmail"]').val(email).change();
        }
    });

    $(document).on('keyup change', 'input[name="destinationEmail"]', function() {
        const email = $(this).val();
        if (email != "—" && email != "NULL") {
            $('.entryDestinationEmail').text(email);
        }
    });

    $(document).on('click', '.phoneField', function() {
        $('.phoneField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const phone = $(this).find('span').text();
        if (phone != "—" && phone != "NULL") {
            $('input[name="destinationPhone"]').val(phone).change();
        }
    });

    $(document).on('click', '.mobileField', function() {
        $('.mobileField').css({
            'color': 'black',
            'font-weight': '500',
        }).find('.checkSize').css('display', 'none');
        $(this).css({
            'color': 'green',
            'font-weight': 'bolder',
        }).find('.checkSize').css('display', 'block');
        // =======
        const mobile = $(this).find('span').text();
        if (mobile != "—" && mobile != "NULL") {
            $('input[name="destinationMobile"]').val(mobile).change();
        }
    });

    $('input[name="destinationSocialSecurityNo"]').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 6) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('input[name="destinationPhone"], input[name="destinationMobile"]').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('select[name="destinationCustomerType"]').change(function(e) {
        const customerType = $(this).val();
        if (customerType == "Commercial" || customerType == "Business") {
            $('input[name="destinationBusinessName"]').attr('required', 'required').change();
        } else {
            $('input[name="destinationBusinessName"]').removeAttr('required').change();
        }
    });

    $(document).on('click', '.removeDuplicatedEntry', function() {
        const entryID = $(this).attr('data-prof_id');
        const entryType = $(this).attr('data-customer-type');
        const entryName = $(this).attr('data-entry-name');
        const entryNumber = $(this).attr('data-number');
        const dataSelector = $(this).attr('data-selector');

        Swal.fire({
            icon: "warning",
            title: "Remove Entry",
            html: "Are you sure you want to remove entry <strong>" + entryName + " #" + entryNumber + "</strong> ?",
            showCancelButton: true,
            confirmButtonText: "Remove",
        }).then((result) => {
            if (result.isConfirmed) {
                ($('tr[data-selector="' + dataSelector + '"]:visible').length <= 3) ? $('tr[data-selector="' + dataSelector + '"]').hide(): $(this).parent().parent().hide();
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/ajax_delete_customer",
                    data: "cid=" + entryID,
                    success: function(response) {
                        Swal.fire({
                            title: "Removed Successfully!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.removeDuplicatedEntry2', function() {
        const entryID = $(this).attr('data-prof_id');
        const entryName = $(this).attr('data-entry-name');

        Swal.fire({
            icon: "warning",
            title: "Remove Entry",
            html: "Are you sure you want to remove entry <strong>" + entryName + " #" + entryID + "</strong> ?",
            showCancelButton: true,
            confirmButtonText: "Remove",
        }).then((result) => {
            if (result.isConfirmed) {
                $('.data_' + entryID).remove();
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/ajax_delete_customer",
                    data: "cid=" + entryID,
                    success: function(response) {}
                });
            }
        });
    });

    $(document).on('click', '.copyColumnEntry', function() {
        const entryID = $(this).attr('data-prof_id');
        $('.data_' + entryID + ' > tbody > tr > td').click();
    });

    var data_selector = "";
    $(document).on('click', '.openCompareUI', function() {
        const customerType = $(this).attr('data-customer-type');
        const firstName = $(this).attr('data-firstname');
        const lastName = $(this).attr('data-lastname');
        const businessName = $(this).attr('data-business-name');
        window.data_selector = $(this).attr('data-selector');
        // ============
        resetOutputEntry();
        $('.dupWizardStep1').hide();
        $('.dupWizardStep2').show();
        $('.fetchingDataLoader').show();
        $('.mergeOutputEntryWidth').hide();
        $('.entryDuplicateData').hide();
        // ============
        $.ajax({
            type: "POST",
            url: URL_ORIGIN + "/Customer/getSpecificDuplicatesToMerge",
            data: {
                entryFName: firstName,
                entryLName: lastName,
                entryBusinessName: businessName,
                entryType: customerType
            },
            success: function(response) {
                $('.dupWizardStep2').show();
                $('.entryDuplicateData').remove();
                $('.fetchingDataLoader').hide();
                $('.mergeOutputEntryWidth').show();
                $('.entryDuplicateData').hide();
                $('.entryFields').after(response);
            }
        });
    });

    $(document).on('click', '.backToDuplicateList', function() {
        Swal.fire({
            icon: "warning",
            title: "Go back to Duplicate List",
            html: "Unsaved changes may disappear",
            showCancelButton: true,
            confirmButtonText: "Proceed, Go back to list",
        }).then((result) => {
            if (result.isConfirmed) {
                $('.dupWizardStep1').show();
                $('.dupWizardStep2').hide();
                $('.fetchingDataLoader').show();
                $('.mergeOutputEntryWidth').hide();
                $('.entryDuplicateData').hide();
            }
        });
    });

    $(document).on('submit', '#mergeEntryForm', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const entryID = $('input[name="destinationCustomerID"]').val();

        if (entryID == "") {
            Swal.fire({
                icon: "warning",
                title: "Unable to proceed",
                html: "Please select main entry source first before merging.",
                showConfirmButton: false,
                showCloseButton: true,
            });
        } else {
            $.ajax({
                type: "POST",
                url: URL_ORIGIN + "/Customer/entryMergeProcess",
                data: formData,
                beforeSend: function(formData, jqForm, options) {
                    Swal.fire({
                        icon: "info",
                        title: "Merging Entry!",
                        html: "Please wait while the merging process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    if (response == true) {
                        $('tr[data-selector="' + window.data_selector + '"]').hide();
                        Swal.fire({
                            icon: "success",
                            title: "Merge complete!",
                            html: "Entry has been merged successfully along with its data categories such as jobs, invoices, estimates, etc.",
                            showConfirmButton: true,
                            confirmButtonText: "Proceed",
                            showCloseButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('.dupWizardStep1').show();
                                $('.dupWizardStep2').hide();
                                $('.fetchingDataLoader').show();
                                $('.mergeOutputEntryWidth').hide();
                                $('.entryDuplicateData').hide();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed to merge",
                            html: "Entries failed to merge, Please try again.",
                            showConfirmButton: false,
                            showCloseButton: true,
                        });
                    }
                }
            });
        }
    });

    function resetOutputEntry() {
        $('input[name="destinationCustomerID"]').val(null).change();
        $('select[name="destinationStatus"] option:contains("—")').prop('selected', true).change();
        $('select[name="destinationCustomerType"] option:contains("—")').prop('selected', true).change();
        $('input[name="destinationBusinessName"]').val(null).change();
        $('select[name="destinationCustomerGroup"] option:contains("—")').prop('selected', true).change();
        $('select[name="destinationSalesArea"] option:contains("—")').prop('selected', true).change();
        $('input[name="destinationFirstName"]').val(null).change();
        $('input[name="destinationMiddleName"]').val(null).change();
        $('input[name="destinationLastName"]').val(null).change();
        $('select[name="destinationNamePrefix"] option:contains("None")').prop('selected', true).change();
        $('select[name="destinationSuffix"] option:contains("None")').prop('selected', true).change();
        $('input[name="destinationCountry"]').val(null).change();
        $('input[name="destinationAddress"]').val(null).change();
        $('input[name="destinationCity"]').val(null).change();
        $('input[name="destinationCounty"]').val(null).change();
        $('input[name="destinationState"]').val(null).change();
        $('input[name="destinationZipCode"]').val(null).change();
        $('input[name="destinationCrossStreet"]').val(null).change();
        $('input[name="destinationSubdivision"]').val(null).change();
        $('input[name="destinationSocialSecurityNo"]').val(null).change();
        $('input[name="destinationBirthdate"]').val(null).change();
        $('input[name="destinationEmail"]').val(null).change();
        $('input[name="destinationPhone"]').val(null).change();
        $('input[name="destinationMobile"]').val(null).change();
        $('.entryDestinationLogsCount').text('0 activity logs');
        $('.entryDestinationInitials').text('?');
        $('.entryDestinationName').text('Customer Name');
        $('.entryDestinationID').text('#00000');
        $('.entryDestinationEmail').text('sample@email.com');
        $('.destinationProfileData').css({
            'outline': '0px dashed green'
        });
    }

    function loadDuplicateCustomerData(status, customerType) {
        switch (status) {
            case "Initialize":
                if (customerType == "Residential") {
                    $.ajax({
                        type: "POST",
                        url: URL_ORIGIN + "/Customer/getDuplicateList/Residential",
                        success: function(response) {
                            loadStatus++;
                            $('#customerDuplicateTable > tbody').html(response);
                            window.customerDuplicateTable = $('#customerDuplicateTable').DataTable({
                                "ordering": false,
                                "pageLength": 25
                            });
                            if (loadStatus == 2) {
                                $('.duplicateManagementContentLoader').remove();
                                $('.duplicateManagementContent').removeClass('d-none');
                                loadStatus = 0;
                            }
                        }
                    });
                } else if (customerType == "Commercial" || customerType == "Business") {
                    $.ajax({
                        type: "POST",
                        url: URL_ORIGIN + "/Customer/getDuplicateList/Commercial",
                        success: function(response) {
                            loadStatus++;
                            $('#commercialDuplicateTable > tbody').html(response);
                            window.commercialDuplicateTable = $('#commercialDuplicateTable').DataTable({
                                "ordering": false,
                                "pageLength": 25
                            });
                            if (loadStatus == 2) {
                                $('.duplicateManagementContentLoader').remove();
                                $('.duplicateManagementContent').removeClass('d-none');
                                loadStatus = 0;
                            }
                        }
                    });
                }
                break;
            case "Reload":
                if (customerType == "Residential") {
                    const currentPageResidential = window.customerDuplicateTable.page();
                    $.ajax({
                        type: "POST",
                        url: URL_ORIGIN + "/Customer/getDuplicateList/Residential",
                        success: function(response) {
                            // Destroy the DataTable
                            window.customerDuplicateTable.clear().destroy();

                            // Reinitialize DataTable with previous configuration
                            $('#customerDuplicateTable > tbody').html(response);
                            window.customerDuplicateTable = $('#customerDuplicateTable').DataTable({
                                "ordering": false,
                                "pageLength": 25
                            });

                            // Set page to the stored index
                            window.customerDuplicateTable.page(currentPageResidential).draw('page');

                            $('.dupEntryButton').removeClass('d-none');
                            $('.dupEntryCount').text('(' + $(document).find('.fa-caret-right').length + ')');
                        }
                    });
                } else if (customerType == "Commercial" || customerType == "Business") {
                    const currentPageCommercial = window.commercialDuplicateTable.page();
                    $.ajax({
                        type: "POST",
                        url: URL_ORIGIN + "/Customer/getDuplicateList/Commercial",
                        success: function(response) {
                            // Destroy the DataTable
                            window.commercialDuplicateTable.clear().destroy();

                            // Reinitialize DataTable with previous configuration
                            $('#commercialDuplicateTable > tbody').html(response);
                            window.commercialDuplicateTable = $('#commercialDuplicateTable').DataTable({
                                "ordering": false,
                                "pageLength": 25
                            });

                            // Set page to the stored index
                            window.commercialDuplicateTable.page(currentPageCommercial).draw('page');

                            $('.dupEntryButton').removeClass('d-none');
                            $('.dupEntryCount').text('(' + $(document).find('.fa-caret-right').length + ')');
                        }
                    });
                }
                break;
        }
    }
    loadDuplicateCustomerData("Initialize", "Residential");
    loadDuplicateCustomerData("Initialize", "Commercial");

    function viewEntry(entryID) {
        const left = (screen.width - 1280) / 2;
        const top = (screen.height - 720) / 2;
        window.open(URL_ORIGIN + "/customer/module/" + entryID, "Customer Dashboard", "width=" + 1280 + ", height=" + 720 + ", top=" + top + ", left=" + left);
    }
</script>
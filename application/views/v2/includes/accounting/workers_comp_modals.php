<div class="modal fade nsm-modal getQuote" id="getQuote" tabindex="" role="dialog" aria-labelledby="myModalLabel2" style="font-family:'Quicksand', sans-serif !important;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_vendors_modal_label">
                    <!-- <img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" /> -->
                </span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <!-- <form id="regForm" action="<?php echo site_url('accounting/addQuote');?>" method="POST"> -->
            <?php echo form_open_multipart('accounting/addQuote', [ 'id' => 'regForm', 'autocomplete' => 'off' ]); ?> 
            <div class="modal-body">
                <div class="stepper-wrapper" style="width:80%; margin-left: auto; margin-right: auto">
                    <div class="stepper-item completed">
                        <div class="step-counter">1</div>
                        <div class="step-name">Get started</div>
                    </div>
                    <div class="stepper-item ">
                        <div class="step-counter">2</div>
                        <div class="step-name">Details</div>
                    </div>
                    <div class="stepper-item ">
                        <div class="step-counter">3</div>
                        <div class="step-name">Quote</div>
                    </div>
                </div>

                <div class="tab">
                    <h4>Your business</h4>
                    <p>Finding the right classification for your business ensures that your quote will be as accurate as possible. But don't worry if you don't find an exact match – an agent will review this before anything is finalized.</p>

                    General industry
                    <select class="form-control nsm-field" name="general_industry">
                        <!-- <option value="">Select General industry</option> -->
                        <option value="Advertising, Graphic Design, Photography and Printing">Advertising, Graphic Design, Photography and Printing</option>
                        <option value="Agriculture, Forestry, Fishing and Hunting">Agriculture, Forestry, Fishing and Hunting</option>
                        <option value="Arts, Entertainment and Recreation">Arts, Entertainment and Recreation</option>
                        <option value="Communications, Electric or Gas Service">Communications, Electric or Gas Service</option>
                        <option value="Educational and Social Services">Educational and Social Services</option>
                        <option value="Health Care, Social Assistance and Public Administration">Health Care, Social Assistance and Public Administration</option>
                        <option value="Legal, Finance, Insurance and Real Estate">Legal, Finance, Insurance and Real Estate</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Membership, Religious and Fraternal Organizations9">Membership, Religious and Fraternal Organizations</option>
                        <option value="Personal and Business Services">Personal and Business Services</option>
                        <option value="Restaurants and Lodging">Restaurants and Lodging</option>
                        <option value="Retail Trade - Nonstore">Retail Trade - Nonstore</option>
                        <option value="Retail Trade - Storefront">Retail Trade - Storefront</option>
                        <option value="Specialty Trade Contractors">Specialty Trade Contractors</option>
                        <option value="Technology, Engineering and Consulting">Technology, Engineering and Consulting</option>
                        <option value="Transportation & Warehousing">Transportation & Warehousing</option>
                        <option value="Wholesale Trade">Wholesale Trade</option>
                        <!-- <option></option> -->
                    </select>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            Type of business
                            <select class="form-control nsm-field" name="type_of_business">
                                <!-- <option value="">Select type of business</option> -->
                                <option value="Apparel, Piece Goods and Notions">Apparel, Piece Goods and Notions</option>
                                <option value="Beer, Wine and Distilled Alcoholic Beverages">Beer, Wine and Distilled Alcoholic Beverages</option>
                                <option value="Chemicals and Allied Products">Chemicals and Allied Products</option>
                                <option value="Drugs, Drug Proprietaries and Druggists' Sundries">Drugs, Drug Proprietaries and Druggists' Sundries</option>
                                <option value="Electrical Goods">Electrical Goods</option>
                                <option value="Furniture and Home furnishings">Furniture and Home furnishings</option>
                                <option value="Groceries and Related Products">Groceries and Related Products</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            Standard industry classification (SIC)
                            <select class="form-control nsm-field" name="classification">
                                <!-- <option value="">Select Standard industry classification</option> -->
                                <option value="Confectionery">Confectionery</option>
                                <option value="Dairy Products, Except Dried Or Canned">Dairy Products, Except Dried Or Canned</option>
                                <option value="Fish and Seafoods">Fish and Seafoods</option>
                                <option value="Fresh Fruits and Vegetables">Fresh Fruits and Vegetables</option>
                                <option value="Groceries and Related Products, Not Elsewhere Classified">Groceries and Related Products, Not Elsewhere Classified</option>
                                <option value="Groceries, General Line">Groceries, General Line</option>
                                <option value="Meats and Meat Products">Meats and Meat Products</option>
                                <option value="Meats and Meat Products (with butchering or slaughtering)">Meats and Meat Products (with butchering or slaughtering)</option>
                                <option value="Packaged Frozen Foods">Packaged Frozen Foods</option>
                                <option value="Poultry and Poultry Products">Poultry and Poultry Products</option>
                                <!-- <option></option> -->
                            </select>
                        </div>
                    </div>
                    
                    <br>Business name <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                    <input type="text" class="form-control nsm-field" name="business_name" style="font-family: 'Quicksand', sans-serif !important">

                    <br>Principal business address <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                    <input type="text" class="form-control nsm-field"  name="business_address" style="font-family: 'Quicksand', sans-serif !important">
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            Suite/Floor <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                            <br><input type="text" class="form-control nsm-field" style="" name="suite" style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                        <div class="col-md-4">
                            Year business started <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                            <br>
                            <select class="form-control nsm-field" id="year" style="" name="year_started">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            Legal entity type<br>
                            <select class="form-control nsm-field" name="legal_entity_type">
                                <option value="Corporation">Corporation</option>
                                <option value="Limited Liability Company">Limited Liability Company</option>
                                <option value="Non-Profit">Non-Profit</option>
                                <option value="Partnership">Partnership</option>
                                <option value="Sole Proprietor">Sole Proprietor</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>                    

                    <br>Federal Identification Number <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                    <input type="text" class="form-control nsm-field" style="width:40%;" name="federal_identification_number" style="font-family: 'Quicksand', sans-serif !important">
                </div>
                <div class="tab">
                    <h4>Your owners, officers, and employees</h4>
                    <p>List all owners/officers and W-2 employees. In most cases, owners and officers may be excluded from a workers' comp policy, but this varies from state to state. Learn more</p>

                    <table class="table">
                        <thead>
                            <th>NAME</th>
                            <th>CLASS CODE</th>
                            <th>ROLE</th>
                            <th>OWNERSHIP</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody id="employeesTable">
                        </tbody>
                    </table>
                    <br>
                    <a class="link-modal-open text-decoration-none" href="#" id="" data-bs-toggle="modal" data-bs-target="#employee_list">Add new employee or owner</a>
                    <br>
                    <br>Total estimated annual payroll <span style="color:red;">*</span><span class="required_fields" style="color:red;display:none;">Required Field</span>
                    <input type="text" class="form-control nsm-field" name="total_est_annual_payroll" style="font-family: 'Quicksand', sans-serif !important">

                    <br>Payroll frequency
                    <select class="form-control nsm-field" name="payroll_frequency">
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Biweekly">Biweekly</option>
                    </select>
                </div>
                <div class="tab">
                    <h4>A few more details about your business</h4>
                    <p>Answer these questions to help us get a better picture of your business</p><br>

                    <table>
                        <tr>
                            <td><label class="switch">
                                <input class="switch-input" id="switch-input" name="check_01" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Does the business have any 1099 workers?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_02" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td> Do you have certificates of insurance for all 1099 employees?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_03" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Has the business had any workers' comp claims in the past 3 years?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_04" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Work performed underground or above 15 feet?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_05" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Any group transportation provided?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_06" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Any seasonal employees?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_07" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Do employees travel out of state?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_08" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>I/they have had a business insurance policy cancelled or non-renewed in the past 3 years.</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_09" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Labor interchange with other business/subsidiary?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_10" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>Do any employees predominantly work at home?</td>
                        </tr>
                        <tr>
                            <td>
                            <label class="switch">
                                <input class="switch-input" id="switch-input" name="check_11" type="checkbox" />
                                <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                <span class="switch-handle"></span> 
                            </label></td>
                            <td>I/they have filed for bankruptcy in the past 5 years.</td>
                        </tr>
                    </table>
                </div>
                <div class="tab">
                    <h4>Is this contact info up to date?</h4>
                    <p>Let our insurance partner, AP Intego, know how to reach you to discuss and finalize your quote.</p>

                    <div class="row">
                        <div class="col-md-6">
                            First name
                            <input type="text" class="form-control nsm-field" name="first_name" style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                        <div class="col-md-6">
                            Last name
                            <input type="text" class="form-control nsm-field" name="last_name" style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            Phone
                            <input type="text" class="form-control nsm-field" name="phone" style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                        <div class="col-md-6">
                            Email
                            <input type="email" class="form-control nsm-field" name="email" style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            Requested policy start date
                            <input type="text" class="form-control nsm-field" id="datepicker_date" value="<?php echo date('m/d/Y', strtotime("+1 day")); ?>" name="policy_start_date"  style="font-family: 'Quicksand', sans-serif !important">
                        </div>
                        <!-- <div class="col-md-6">
                            Email
                            <input type="email" class="form-control nsm-field">
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" onclick="nextPrev(-1)" id="prevBtn">Previous</button>
                <button type="button" class="nsm-button primary" onclick="nextPrev(1)" id="nextBtn">Next</button>
                <button type="submit" class="nsm-button success" id="completeBtn" style="display: none">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="employee_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">
                    Add new employee or owner
                </span> <i>(Optional)</i>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="divpopemp">
                <p>Adding employees and owners here will help you get the most accurate quote. Need to add this info in nSmarTrac? Go to <strong>Workers > Employees.</strong></p>
                <div class="row">
                    <div class="col-md-6 col-12">
                        Name
                        <input type="text" class="form-control nsm-field" id="fullName" style="font-family: 'Quicksand', sans-serif !important">
                    </div>
                    <div class="col-md-6 col-12">
                        Role
                        <select class="form-control nsm-field" id="mRole">
                            <option value="Employee">Employee</option>
                            <option value="Excluded owner/office">Excluded owner/officer</option>
                            <option value="Included owner/officer">Included owner/officer</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        Class code
                        <select class="form-control nsm-field" id="classCode">
                            <option value="2107 - Fruit Packing (Fresh, Not Citrus)">2107 - Fruit Packing (Fresh, Not Citrus)</option>
                            <option value="2108 - Fruit Packing (Citrus">2108 - Fruit Packing (Citrus)</option>
                            <option value="2109 - Fruit Packing (Dried)">2109 - Fruit Packing (Dried)</option>
                            <option value="2123 - Fruit or Vegetable Processing - Fresh Ready-to-Eat">2123 - Fruit or Vegetable Processing - Fresh Ready-to-Eat</option>
                            <option value="8810 - Clerical Office Employees">8810 - Clerical Office Employees</option>
                            <option value="8742 - Salespersons or Collectors - Outside">8742 - Salespersons or Collectors - Outside</option>
                            <option value="I’m not sure, let an agent help">I’m not sure, let an agent help</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Individual estimated annual payroll
                        <input type="number" class="form-control nsm-field" id="annualPayroll">
                    </div>
                    <div class="col-md-6">
                        Ownership
                        <input type="text" class="form-control nsm-field" id="mOwnership" style="font-family: 'Quicksand', sans-serif !important">
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-detail">
                <div class="button-modal-list">
                    <button class="nsm-button success addEmployeeData" id="addEmployeeData" data-bs-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal connectPolicy" id="connectPolicy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_vendors_modal_label">
                    <img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" />
                </span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="regForm" action="<?php echo site_url('accounting/addQuote');?>">
                    <div style="padding:3%;border: solid gray 1px;width:60%;margin:-5px 20% 1% 20%;">
                        <h4>Connect your policy to nSmarTrac</h4>

                        <div class="row">
                            <div class="col-md-6">
                                Current insurance carrier
                                <select class="form-control nsm-field" id="mRole">
                                    <option value="AmTrust">AmTrust</option>
                                    <option value="The Hartford">The Hartford</option>
                                    <option value="Employers">Employers</option>
                                    <option value="FirstComp/Markel">FirstComp/Markel</option>
                                    <option value="CNA">CNA</option>
                                    <option value="Travelers">Travelers</option>
                                    <option value="Guard">Guard</option>
                                    <option value="Other (please specify)">Other (please specify)</option>
                                </select> 
                                <input type="text" class="form-control nsm-field" id="insuranceCarrier" style="margin-top:10px;" style="font-family: 'Quicksand', sans-serif !important">
                                <br>
                                Policy renewal date
                                <table class="table">
                                    <tr>
                                    <td>
                                        <select class="form-control nsm-field" id="renewaldateMonth">
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control nsm-field" id="renewaldateyears">
                                        </select>
                                    </td>
                                    </tr>
                                </table>
                                <p style="font-size: 12px;margin-bottom:10px;">Connecting your policy does not change anything about your current policy or billing method.</p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-6" style="padding:5%;">
                                <p style="font-weight:bold;font-size:20px;">Why connect?</p>
                                <div class="container">
                                    <!-- completed -->
                                    <div class="step2 completed">
                                        <div class="v-stepper">
                                            <div class="circle"></div>
                                            <div class="line"></div>
                                        </div>

                                        <div class="content" style="padding:1%;">
                                            Sign up for automatic policy renewal reminders to help you stay covered at the best price. <br><br>
                                        </div>
                                    </div>
                                
                                    <!-- active -->
                                    <div class="step2 completed">
                                        <div class="v-stepper">
                                            <div class="circle"></div>
                                            <div class="line"></div>
                                        </div>

                                        <div class="content" style="padding:1%;">
                                            Learn if your policy qualifies for Pay As You Go billing through nSmarTrac.<br><br>
                                        </div>
                                    </div>
                                
                                    <!-- regular -->
                                    <div class="step2 completed">
                                        <div class="v-stepper">
                                            <div class="circle"></div>
                                            <div class="line"></div>
                                        </div>

                                        <div class="content" style="padding:1%;">
                                            Gain access to trusted insurance experts.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button success">Get connected</button>
            </div>
        </div>
    </div>
</div>

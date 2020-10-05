<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card">

<h1>Services</h1>

<div class="row">
    <div class="col-md-24 col-lg-24 col-xl-18"><form id="form-business-services" method="post" action="#">

    <div class="card">
        <div class="margin-bottom">
            Selected services:
            <div class="cat-selected" id="cat-selected">
            <span class="label label-default tag">Security<a class="cat-tag-remove" id="cat-tag-remove-93" href="#"><span class="icon fa fa-remove"></span></a></span>            <script async="" src="https://www.google-analytics.com/analytics.js"></script><script id="cat-selected-tag" type="text/x-handlebars-template">
            <span class="label label-default tag">{{name}}<a class="cat-tag-remove" id="cat-tag-remove-{{id}}" href="#"><span class="icon fa fa-remove"></span></a></span>
            </script>
            </div>
        </div>

        <div class="validation-error" style="display: none;"></div>

        
        <div class="service-type">

            <div class="checkbox checkbox-sec" data-action="toggle" data-id="servicetype3" data-checked="">
                <span class="icon">+</span>
                <label><span class="section-header">Auto</span></label>
                <div class="section-body" data-off-for="servicetype3" style="display: block;">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body" data-on-for="servicetype3" style="display: none;">
                <div class="row">
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="199" class="cat-cat" id="category-199">
                            <label for="category-199"><span>AC Repair</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="202" class="cat-cat" id="category-202">
                            <label for="category-202"><span>Alarm - Remote</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="201" class="cat-cat" id="category-201">
                            <label for="category-201"><span>Audio - Video Tech</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="193" class="cat-cat" id="category-193">
                            <label for="category-193"><span>Body Shop </span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="197" class="cat-cat" id="category-197">
                            <label for="category-197"><span>Brakes</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="192" class="cat-cat" id="category-192">
                            <label for="category-192"><span>Bumper - Dents</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="191" class="cat-cat" id="category-191">
                            <label for="category-191"><span>Detail Wash</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="189" class="cat-cat" id="category-189">
                            <label for="category-189"><span>Headlight Restoration</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="203" class="cat-cat" id="category-203">
                            <label for="category-203"><span>Locksmith</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="196" class="cat-cat" id="category-196">
                            <label for="category-196"><span>Mechanic</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="200" class="cat-cat" id="category-200">
                            <label for="category-200"><span>Paint Jobs - Restore</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="204" class="cat-cat" id="category-204">
                            <label for="category-204"><span>Towing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="198" class="cat-cat" id="category-198">
                            <label for="category-198"><span>Transmission </span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="194" class="cat-cat" id="category-194">
                            <label for="category-194"><span>Upholstery</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="190" class="cat-cat" id="category-190">
                            <label for="category-190"><span>Window Tint</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="208" class="cat-cat" id="category-208">
                            <label for="category-208"><span>Windshield</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="195" class="cat-cat" id="category-195">
                            <label for="category-195"><span>Wraps - Graphics</span></label>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
        
        <div class="service-type">

            <div class="checkbox checkbox-sec checkbox-checked" data-action="toggle" data-id="servicetype1" data-checked="1">
                <span class="icon">-</span>
                <label><span class="section-header">Residential</span></label>
                <div class="section-body" data-off-for="servicetype1" style="display: none;">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body" data-on-for="servicetype1" style="display: block;">
                <div class="row">
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="168" class="cat-cat" id="category-168">
                            <label for="category-168"><span>Acoustical Covering</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="147" class="cat-cat" id="category-147">
                            <label for="category-147"><span>Air Duct  - Dryer vent cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="175" class="cat-cat" id="category-175">
                            <label for="category-175"><span>Appliance</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="90" class="cat-cat" id="category-90">
                            <label for="category-90"><span>Architect - Engineer</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="240" class="cat-cat" id="category-240">
                            <label for="category-240"><span>Art - Picture Framing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="244" class="cat-cat" id="category-244">
                            <label for="category-244"><span>Assembly</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="122" class="cat-cat" id="category-122">
                            <label for="category-122"><span>Cabinets</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="73" class="cat-cat" id="category-73">
                            <label for="category-73"><span>Carpentry - Finish</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="171" class="cat-cat" id="category-171">
                            <label for="category-171"><span>Carpentry - Rough</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="179" class="cat-cat" id="category-179">
                            <label for="category-179"><span>Carpet - Tile Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="94" class="cat-cat" id="category-94">
                            <label for="category-94"><span>Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="153" class="cat-cat" id="category-153">
                            <label for="category-153"><span>Concrete - Paving</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="149" class="cat-cat" id="category-149">
                            <label for="category-149"><span>Countertop</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="123" class="cat-cat" id="category-123">
                            <label for="category-123"><span>Doors - Windows</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="151" class="cat-cat" id="category-151">
                            <label for="category-151"><span>Drywall</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="70" class="cat-cat" id="category-70">
                            <label for="category-70"><span>Electrical</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="89" class="cat-cat" id="category-89">
                            <label for="category-89"><span>Electronics</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="140" class="cat-cat" id="category-140">
                            <label for="category-140"><span>Fence - Gate</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="163" class="cat-cat" id="category-163">
                            <label for="category-163"><span>Fire Protection</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="77" class="cat-cat" id="category-77">
                            <label for="category-77"><span>Flooring Carpet</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="124" class="cat-cat" id="category-124">
                            <label for="category-124"><span>Garage Doors</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="80" class="cat-cat" id="category-80">
                            <label for="category-80"><span>General Contractor</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="238" class="cat-cat" id="category-238">
                            <label for="category-238"><span>Gutter Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="69" class="cat-cat" id="category-69">
                            <label for="category-69"><span>Handyman</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="242" class="cat-cat" id="category-242">
                            <label for="category-242"><span>Hardwood Flooring</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="79" class="cat-cat" id="category-79">
                            <label for="category-79"><span>Heating &amp; Air Conditioning Contractor</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="125" class="cat-cat" id="category-125">
                            <label for="category-125"><span>Home Inspection</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="246" class="cat-cat" id="category-246">
                            <label for="category-246"><span>Installation</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="160" class="cat-cat" id="category-160">
                            <label for="category-160"><span>Insulation</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="88" class="cat-cat" id="category-88">
                            <label for="category-88"><span>Interior Designer</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="141" class="cat-cat" id="category-141">
                            <label for="category-141"><span>Junk Removal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="74" class="cat-cat" id="category-74">
                            <label for="category-74"><span>Landscaping</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="78" class="cat-cat" id="category-78">
                            <label for="category-78"><span>Locksmith</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="178" class="cat-cat" id="category-178">
                            <label for="category-178"><span>Maid Service</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="166" class="cat-cat" id="category-166">
                            <label for="category-166"><span>Masonry</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="177" class="cat-cat" id="category-177">
                            <label for="category-177"><span>Organizing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="68" class="cat-cat" id="category-68">
                            <label for="category-68"><span>Painting</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="76" class="cat-cat" id="category-76">
                            <label for="category-76"><span>Pest Control</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="161" class="cat-cat" id="category-161">
                            <label for="category-161"><span>Plastering</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="95" class="cat-cat" id="category-95">
                            <label for="category-95"><span>Plumbing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="75" class="cat-cat" id="category-75">
                            <label for="category-75"><span>Pool Services</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="139" class="cat-cat" id="category-139">
                            <label for="category-139"><span>Power Wash</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="235" class="cat-cat" id="category-235">
                            <label for="category-235"><span>Professional Lighting</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="71" class="cat-cat" id="category-71">
                            <label for="category-71"><span>Remodeling</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="187" class="cat-cat" id="category-187">
                            <label for="category-187"><span>Restoration</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="205" class="cat-cat" id="category-205">
                            <label for="category-205"><span>Resurfacing - Reglazing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="72" class="cat-cat" id="category-72">
                            <label for="category-72"><span>Roofing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="93" checked="checked" class="cat-cat" id="category-93">
                            <label for="category-93"><span>Security</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="157" class="cat-cat" id="category-157">
                            <label for="category-157"><span>Septic Tank</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="156" class="cat-cat" id="category-156">
                            <label for="category-156"><span>Sheet Metal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="183" class="cat-cat" id="category-183">
                            <label for="category-183"><span>Snow Removal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="250" class="cat-cat" id="category-250">
                            <label for="category-250"><span>Softwash</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="121" class="cat-cat" id="category-121">
                            <label for="category-121"><span>Solar</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="173" class="cat-cat" id="category-173">
                            <label for="category-173"><span>Swamp Cooler</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="185" class="cat-cat" id="category-185">
                            <label for="category-185"><span>Tree Services</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="170" class="cat-cat" id="category-170">
                            <label for="category-170"><span>Welding</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="181" class="cat-cat" id="category-181">
                            <label for="category-181"><span>Window Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="252" class="cat-cat" id="category-252">
                            <label for="category-252"><span>Window Coverings</span></label>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
        
        <div class="service-type">

            <div class="checkbox checkbox-sec" data-action="toggle" data-id="servicetype2" data-checked="">
                <span class="icon">+</span>
                <label><span class="section-header">Commercial</span></label>
                <div class="section-body" data-off-for="servicetype2" style="display: block;">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body" data-on-for="servicetype2" style="display: none;">
                <div class="row">
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="169" class="cat-cat" id="category-169">
                            <label for="category-169"><span>Acoustical Covering</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="148" class="cat-cat" id="category-148">
                            <label for="category-148"><span>Air Duct  - Dryer vent cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="176" class="cat-cat" id="category-176">
                            <label for="category-176"><span>Appliance</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="118" class="cat-cat" id="category-118">
                            <label for="category-118"><span>Architect - Engineer</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="241" class="cat-cat" id="category-241">
                            <label for="category-241"><span>Art - Picture Framing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="245" class="cat-cat" id="category-245">
                            <label for="category-245"><span>Assembly</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="91" class="cat-cat" id="category-91">
                            <label for="category-91"><span>Banners Signs</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="126" class="cat-cat" id="category-126">
                            <label for="category-126"><span>Cabinets</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="108" class="cat-cat" id="category-108">
                            <label for="category-108"><span>Carpentry - Finish</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="172" class="cat-cat" id="category-172">
                            <label for="category-172"><span>Carpentry - Rough</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="180" class="cat-cat" id="category-180">
                            <label for="category-180"><span>Carpet - Tile Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="248" class="cat-cat" id="category-248">
                            <label for="category-248"><span>Cellphone - Electronics Repair</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="104" class="cat-cat" id="category-104">
                            <label for="category-104"><span>Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="154" class="cat-cat" id="category-154">
                            <label for="category-154"><span>Concrete - Paving</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="150" class="cat-cat" id="category-150">
                            <label for="category-150"><span>Countertop</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="127" class="cat-cat" id="category-127">
                            <label for="category-127"><span>Doors - Windows</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="152" class="cat-cat" id="category-152">
                            <label for="category-152"><span>Drywall</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="105" class="cat-cat" id="category-105">
                            <label for="category-105"><span>Electrical</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="117" class="cat-cat" id="category-117">
                            <label for="category-117"><span>Electronics</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="146" class="cat-cat" id="category-146">
                            <label for="category-146"><span>Fence - Gate</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="164" class="cat-cat" id="category-164">
                            <label for="category-164"><span>Fire Protection</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="112" class="cat-cat" id="category-112">
                            <label for="category-112"><span>Flooring Carpet</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="138" class="cat-cat" id="category-138">
                            <label for="category-138"><span>Garage Doors</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="115" class="cat-cat" id="category-115">
                            <label for="category-115"><span>General Contractor</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="239" class="cat-cat" id="category-239">
                            <label for="category-239"><span>Gutter Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="103" class="cat-cat" id="category-103">
                            <label for="category-103"><span>Handyman</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="243" class="cat-cat" id="category-243">
                            <label for="category-243"><span>Hardwood Flooring</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="114" class="cat-cat" id="category-114">
                            <label for="category-114"><span>Heating &amp; Air Conditioning Contractor</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="128" class="cat-cat" id="category-128">
                            <label for="category-128"><span>INSPECTION</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="247" class="cat-cat" id="category-247">
                            <label for="category-247"><span>Installation</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="159" class="cat-cat" id="category-159">
                            <label for="category-159"><span>Insulation</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="116" class="cat-cat" id="category-116">
                            <label for="category-116"><span>Interior Designer</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="144" class="cat-cat" id="category-144">
                            <label for="category-144"><span>Junk Removal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="109" class="cat-cat" id="category-109">
                            <label for="category-109"><span>Landscaping</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="113" class="cat-cat" id="category-113">
                            <label for="category-113"><span>Locksmith</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="167" class="cat-cat" id="category-167">
                            <label for="category-167"><span>Masonry</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="102" class="cat-cat" id="category-102">
                            <label for="category-102"><span>Painting</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="111" class="cat-cat" id="category-111">
                            <label for="category-111"><span>Pest Control</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="162" class="cat-cat" id="category-162">
                            <label for="category-162"><span>Plastering</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="119" class="cat-cat" id="category-119">
                            <label for="category-119"><span>Plumbing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="110" class="cat-cat" id="category-110">
                            <label for="category-110"><span>Pool Services</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="145" class="cat-cat" id="category-145">
                            <label for="category-145"><span>Power Wash</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="236" class="cat-cat" id="category-236">
                            <label for="category-236"><span>Professional Lighting</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="106" class="cat-cat" id="category-106">
                            <label for="category-106"><span>Remodeling</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="188" class="cat-cat" id="category-188">
                            <label for="category-188"><span>Restoration</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="206" class="cat-cat" id="category-206">
                            <label for="category-206"><span>Resurfacing - Reglazing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="107" class="cat-cat" id="category-107">
                            <label for="category-107"><span>Roofing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="120" class="cat-cat" id="category-120">
                            <label for="category-120"><span>Security Network</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="158" class="cat-cat" id="category-158">
                            <label for="category-158"><span>Septic Tank</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="155" class="cat-cat" id="category-155">
                            <label for="category-155"><span>Sheet Metal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="184" class="cat-cat" id="category-184">
                            <label for="category-184"><span>Snow Removal</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="251" class="cat-cat" id="category-251">
                            <label for="category-251"><span>Softwash</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="137" class="cat-cat" id="category-137">
                            <label for="category-137"><span>Solar</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="174" class="cat-cat" id="category-174">
                            <label for="category-174"><span>Swamp Cooler</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="186" class="cat-cat" id="category-186">
                            <label for="category-186"><span>Tree Services</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="165" class="cat-cat" id="category-165">
                            <label for="category-165"><span>Welding</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="182" class="cat-cat" id="category-182">
                            <label for="category-182"><span>Window Cleaning</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="253" class="cat-cat" id="category-253">
                            <label for="category-253"><span>Window Coverings</span></label>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
        
        <div class="service-type">

            <div class="checkbox checkbox-sec" data-action="toggle" data-id="servicetype5" data-checked="">
                <span class="icon">+</span>
                <label><span class="section-header">Moving</span></label>
                <div class="section-body" data-off-for="servicetype5" style="display: block;">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body" data-on-for="servicetype5" style="display: none;">
                <div class="row">
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="99" class="cat-cat" id="category-99">
                            <label for="category-99"><span>Assemble/ disassemble</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="96" class="cat-cat" id="category-96">
                            <label for="category-96"><span>Auto transport</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="129" class="cat-cat" id="category-129">
                            <label for="category-129"><span>Hourly rate service</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="81" class="cat-cat" id="category-81">
                            <label for="category-81"><span>Moving</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="97" class="cat-cat" id="category-97">
                            <label for="category-97"><span>Packing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="98" class="cat-cat" id="category-98">
                            <label for="category-98"><span>Storage space</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="130" class="cat-cat" id="category-130">
                            <label for="category-130"><span>Wall Mount / Dismount</span></label>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
        
        <div class="service-type">

            <div class="checkbox checkbox-sec" data-action="toggle" data-id="servicetype4" data-checked="">
                <span class="icon">+</span>
                <label><span class="section-header">Event</span></label>
                <div class="section-body" data-off-for="servicetype4" style="display: block;">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body" data-on-for="servicetype4" style="display: none;">
                <div class="row">
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="85" class="cat-cat" id="category-85">
                            <label for="category-85"><span>Bartending</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="87" class="cat-cat" id="category-87">
                            <label for="category-87"><span>Catering</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="134" class="cat-cat" id="category-134">
                            <label for="category-134"><span>Comedy Acts</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="249" class="cat-cat" id="category-249">
                            <label for="category-249"><span>Craft / Sewing</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="136" class="cat-cat" id="category-136">
                            <label for="category-136"><span>Dancers</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="101" class="cat-cat" id="category-101">
                            <label for="category-101"><span>Florist</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="133" class="cat-cat" id="category-133">
                            <label for="category-133"><span>Impersonators</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="135" class="cat-cat" id="category-135">
                            <label for="category-135"><span>Kids Entertainment</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="100" class="cat-cat" id="category-100">
                            <label for="category-100"><span>Limo /  Rentals</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="86" class="cat-cat" id="category-86">
                            <label for="category-86"><span>Magician Illusion</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="84" class="cat-cat" id="category-84">
                            <label for="category-84"><span>Music / DJ / karaoke</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="83" class="cat-cat" id="category-83">
                            <label for="category-83"><span>Photo Videography</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="82" class="cat-cat" id="category-82">
                            <label for="category-82"><span>Planning Staging</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="237" class="cat-cat" id="category-237">
                            <label for="category-237"><span>Professional Lighting</span></label>
                        </div>
                    </div>
                                        <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox" name="categories[]" value="132" class="cat-cat" id="category-132">
                            <label for="category-132"><span>Stylist</span></label>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
            </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		    		<button class="btn btn-default btn-lg" name="btn-save" type="button">Save</button> <span class="alert-inline-text margin-left hide">Saved</span>
    		    	</div>
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="businessdetail">« Back</a>
    		    		    		<a href="credentials" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
    		    	</div>
    </div>
</div>
</form>

<div class="modal alert-modal" id="alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add More Services</h4>
            </div>
            <div class="modal-body">
                <p>
                    You reached the maximum number of services for your plan.
                </p>
                <!--
                <p>
                    If you want to add more services, you need to upgrade your current plan.
                </p>
                 -->
            </div>
            <div class="modal-footer">
                <!--
                <a class="btn btn-primary" href="https://www.markate.com/pro/account/plan">Upgrade Now</a>
                 -->
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>    </div>
</div>
    </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
   <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
         <span class="mdc-bottom-navigation__list-item__text">Recents</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
         <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">
               <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                  <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
               </svg>
            </span>
            <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
         </span>
      </nav>
   </div>
</div>
<?php include viewPath('includes/footer'); ?>


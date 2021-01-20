<div class="modal fade" id="elementSettingsModal" tabindex="-1" role="dialog" aria-labelledby="elementSettingsModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Element Settings</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form onsubmit="handleSaveEelement(event)" id="elementSettings">
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="#elementSettingsTab" data-toggle="tab">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementDefaultValueTab" data-toggle="tab">Default Value</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementRulesTab" data-toggle="tab">Rules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementInventoryTab" data-toggle="tab">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementCalculationsTab" data-toggle="tab">Calculation</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <input type="hidden" name="id" id="elementID">
                        <input type="hidden" name="element_type" id="elementType">
                        <input type="hidden" name="element_order" id="elementOrder">
                        <input type="hidden" name="element_container" id="elementContainer">
                        <input type="hidden" name="save_method" id="saveMethod">
                        <div class="tab-pane active" id="elementSettingsTab">
                            <div class="container mt-0">
                                <div id="elementPreview" class="w-100 h-auto element-setting-container" tag="preview">
                                </div>
                                <div tag="question" class="element-setting-container">
                                    <textarea name="elementQuestionInput" oninput="handleQuestionInput(this.value)"
                                        id="elementQuestionInput" cols="30" rows="100" class="form-control"
                                        placeholder="Question?"></textarea>
                                    <div class="w-100 d-block text-right">
                                        <a href="#">Enable Text Editor</a>
                                    </div>
                                </div>
                                <div class="w-100 row mt-2" id="elementSettingsChoices">
                                    <div tag="text_field" class="element-setting-container col-12 col-md-6">
                                        <h4>Text Field</h4>
                                        <div class="form-group">
                                            <label for="placeholder-text">Placeholder Text:</label>
                                            <input type="text" id="placeholderText" name="placeholder-text"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 element-setting-container" tag="editor">
                                        <textarea name="elementQuestionEditor" id="elementQuestionEditor" cols="30"
                                            rows="100" class="form-control" placeholder="Question?"></textarea>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="image">
                                        <h4>Image</h4>
                                        <div class="form-group">
                                            <label for="image-url">Url: <a href="#">(Choose image...)</a></label>
                                            <input type="text" class="form-control" name="image-url" id="imageUrl">
                                        </div>
                                        <div class="form-group">
                                            <label for="image-alt-text">Alternate Text:</label>
                                            <input type="text" class="form-control" name="image-alt-text"
                                                id="imageAltText">
                                        </div>
                                        <div class="form-group">
                                            <label for="optional-link-url">Optional link URL:</label>
                                            <input type="text" class="form-control" name="optional-link-url"
                                                id="optionalLinkURL">
                                        </div>
                                        <div class="form-group">
                                            <label for="optionalLinkAction" class="d-block">Optional Link
                                                Action:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="optionalLinkAction"
                                                    id="newWindow" value="new-window">
                                                <label class="form-check-label" for="newWindow">New Window</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="optionalLinkAction"
                                                    id="sameWindow" value="same-window">
                                                <label class="form-check-label" for="sameWindow">Same Window</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="optionalLinkAction"
                                                    id="topFrame" value="top-frame">
                                                <label class="form-check-label" for="topFrame">Top Frame</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 element-setting-container" tag="matrix">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <h4>Sub-Questions (Rows)</h4>
                                                <ul class="nav nav-pills nav-fill">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#addMatrixRowsTab"
                                                            data-toggle="tab">Add
                                                            MatrixRows</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#editMatrixRowsTab"
                                                            data-toggle="tab">Edit
                                                            MatrixRows</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#funnelMatrixRowsTab"
                                                            data-toggle="tab">Funnel
                                                            MatrixRows</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content py-4">
                                                    <div class="addMatrixRowsTab">
                                                        <textarea name="elementMatrixRowsInput"
                                                            id="elementMatrixRowsInput" cols="30" rows="10"
                                                            class="form-control h-50"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <h4>Choices (Columns)</h4>
                                                <ul class="nav nav-pills nav-fill">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#addMatrixChoicesTab"
                                                            data-toggle="tab">Add
                                                            MatrixChoices</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#editMatrixChoicesTab"
                                                            data-toggle="tab">Edit
                                                            MatrixChoices</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#funnelMatrixChoicesTab"
                                                            data-toggle="tab">Funnel
                                                            MatrixChoices</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content py-4">
                                                    <div class="addMatrixChoicesTab">
                                                        <textarea name="elementMatrixChoicesInput"
                                                            id="elementMatrixColumnsInput" cols="30" rows="10"
                                                            class="form-control h-50"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 element-setting-container" tag="choices_and_prices">
                                        <h4>Choices and Prices</h4>
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#addChoicesAndPricesRowsTab"
                                                    data-toggle="tab">Add
                                                    Choices And Prices Rows</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#editChoicesAndPricesRowsTab"
                                                    data-toggle="tab">Edit
                                                    ChoicesAndPricesRows</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content py-4">
                                            <div class="addChoicesAndPricesRowsTab">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <textarea name="elementChoicesAndPricesChoiceInput"
                                                            id="elementChoicesAndPricesChoiceInput" cols="30" rows="10"
                                                            class="form-control h-50"></textarea>
                                                    </div>
                                                    <div class="col-6">
                                                        <textarea name="elementChoicesAndPricesPriceInput"
                                                            id="elementChoicesAndPricesPriceInput" cols="30" rows="10"
                                                            class="form-control h-50"></textarea>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switch"
                                                        class="custom-control-input" id="percentageExcludeSwitch">
                                                    <label class="custom-control-label"
                                                        for="percentageExcludeSwitch">Exclude from percentage
                                                        calculation</label>
                                                </div>
                                                <small><i>Example: exclude a shipping cost from a tax
                                                        percentage.</i></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="url">
                                        <h4>URL</h4>
                                        <div class="form-group">
                                            <label for="url-text">Text:</label>
                                            <input type="text" class="form-control" name="url-text" id="urlText">
                                        </div>
                                        <div class="form-group">
                                            <label for="url">URL:</label>
                                            <input type="text" class="form-control" name="url" id="url">
                                        </div>
                                        <div class="form-group">
                                            <label for="urlAction" class="d-block">Optional Link Action:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="urlAction"
                                                    id="urlNewWindow" value="new-window">
                                                <label class="form-check-label" for="urlNewWindow">New Window</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="urlAction"
                                                    id="urlSameWindow" value="same-window">
                                                <label class="form-check-label" for="urlSameWindow">Same Window</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="urlAction"
                                                    id="urlTopFrame" value="top-frame">
                                                <label class="form-check-label" for="urlTopFrame">Top Frame</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 element-setting-container" tag="code">
                                        <h4>Custom Code</h4>
                                        <div class="form-group">
                                            <label for="custom-code">Code:</label>
                                            <textarea class="form-control" name="custom-code" id="customCode" cols="30"
                                                rows="20"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="choices">
                                        <h4>Choices</h4>
                                        <ul class="nav nav-pills nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#addChoicesTab" data-toggle="tab">Add
                                                    Choices</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#editChoicesTab" data-toggle="tab">Edit
                                                    Choices</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#funnelChoicesTab" data-toggle="tab">Funnel
                                                    Choices</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content py-4">
                                            <div class="addChoicesTab">
                                                <textarea name="elementChoicesInput" id="elementChoicesInput" cols="30"
                                                    rows="10" class="form-control h-50"></textarea>
                                                <div class="form-group w-50">
                                                    <label for="preFillChoices">Pre-fill choices:</label>
                                                    <select name="prefillChoices" id="prefillChoices"
                                                        class="form-control" onchange="handlePreFillChoicesChanged()">
                                                        <option value="none">none</option>
                                                        <option value="agree_disagree">Agree/Disagree</option>
                                                        <option value="age">Age</option>
                                                        <option value="education">Education</option>
                                                        <option value="employment_status">Employment Status</option>
                                                        <option value="race_ethnicity">Race/Ethnicity</option>
                                                        <option value="income">Income</option>
                                                        <option value="us_states">List of US States</option>
                                                        <option value="countries">List of Countries</option>
                                                        <option value="satisfied_dissatisfied">Satisfied/Dissatisfied</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="textarea">
                                        <h4>Textarea</h4>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Size:</label>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label>Columns: </label>
                                                    <input type="number" name="columns" id="columns"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Rows: </label>
                                                    <input type="number" name="rows" id="rows" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Length:</label>
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <label>Min: </label>
                                                    <input type="number" name="min_char" id="minChar"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>Max: </label>
                                                    <input type="number" name="max_char" id="maxChar"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Unit: </label>
                                                    <select name="limit_unit" id="limitUnit" class="form-control">
                                                        <option value="characters">Characters</option>
                                                        <option value="words">Words</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <p><small><em>Amount of text allowed in the text field.
                                                    </em></small></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="text">
                                        <h4>Text</h4>
                                        <div class="row mb-2">
                                            <div class="col-2">
                                                <label for="element-font-family">Font:</label>
                                            </div>
                                            <div class="col-4">
                                                <select name="element-font-family" id="elementFontFamily"
                                                    class="form-control">
                                                    <option value=""></option>
                                                    <option value="Arial,'Helvetica Neue',Helvetica,sans-serif">Arial
                                                    </option>
                                                    <option
                                                        value="'Century Gothic',CenturyGothic, AppleGothic, sans-serif">
                                                        Century Gothic</option>
                                                    <option value="'Courier New',Courier,mono">Courier</option>
                                                    <option value="Georgia,serif">Georgia</option>
                                                    <option value="'Lucida Sans Unicode','Lucida Grande',sans-serif">
                                                        Lucida</option>
                                                    <option value="Tahoma,sans-serif">Tahoma</option>
                                                    <option value="'Times New Roman',Times,serif">Times New Roman
                                                    </option>
                                                    <option value="Verdana,Geneva,sans-serif">Verdana</option>
                                                    <option value="'Alfa Slab One',cursive">Alfa Slab One</option>
                                                    <option value="'Architects Daughter',cursive">Architects Daughter
                                                    </option>
                                                    <option value="'Arvo',serif">Arvo</option>
                                                    <option value="'Chewy',cursive">Chewy</option>
                                                    <option value="'Cinzel',serif">Cinzel</option>
                                                    <option value="'Cutive Mono',courier">Cutive Mono</option>
                                                    <option value="'Dosis',sans-serif">Dosis</option>
                                                    <option value="'Droid Serif', serif">Droid Serif</option>
                                                    <option value="'Great Vibes',cursive">Great Vibes</option>
                                                    <option value="'Handlee',cursive">Handlee</option>
                                                    <option value="'Kaushan Script',cursive">Kaushan Script</option>
                                                    <option value="'Lato',sans-serif">Lato</option>
                                                    <option value="'Lobster',cursive">Lobster</option>
                                                    <option value="'Lora', serif">Lora</option>
                                                    <option value="'Luckiest Guy',cursive">Luckiest Guy</option>
                                                    <option value="'Merriweather',serif">Merriweather</option>
                                                    <option value="'Muli',sans-serif">Muli</option>
                                                    <option value="'Oswald',sans-serif">Oswald</option>
                                                    <option value="'Open Sans',sans-serif">Open Sans</option>
                                                    <option value="'Open Sans Condensed',sans-serif">Open Sans Condensed
                                                    </option>
                                                    <option value="'Pacifico',cursive">Pacifico</option>
                                                    <option value="'Playball',cursive">Playball</option>
                                                    <option value="'Poiret One',cursive">Poiret One</option>
                                                    <option value="'Questrial',sans-serif">Questrial</option>
                                                    <option value="'Raleway',sans-serif">Raleway</option>
                                                    <option value="'Roboto',sans-serif">Roboto</option>
                                                    <option value="'Roboto Slab',serif">Roboto Slab</option>
                                                    <option value="'Sanchez',serif">Sanchez</option>
                                                    <option value="'Share Tech Mono',courier">Share Tech Mono</option>
                                                    <option value="'Sigmar One',cursive">Sigmar One</option>
                                                    <option value="'Signika',sans-serif">Signika</option>
                                                    <option value="'Titillium Web',sans-serif">Titillium Web</option>
                                                    <option value="'Ubuntu',sans-serif">Ubuntu</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <select name="element-font-size" id="elementFontSize"
                                                    class="form-control">
                                                    <option value="12">12</option>
                                                    <option value="14">14</option>
                                                    <option value="16">16</option>
                                                    <option value="18">18</option>
                                                    <option value="24">24</option>
                                                    <option value="30" selected>30</option>
                                                    <option value="36">36</option>
                                                    <option value="48">48</option>
                                                    <option value="56">56</option>
                                                    <option value="72">72</option>
                                                    <option value="90">90</option>
                                                    <option value="112">112</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switch"
                                                        class="custom-control-input" id="textBoldSwitch">
                                                    <label class="custom-control-label"
                                                        for="textBoldSwitch">Bold</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <label>Align:</label>
                                            </div>
                                            <div class="col-5">
                                                <select name="element-font-horizontal-alignment"
                                                    id="elementFontHorizontalAlignment" class="form-control">
                                                    <option value="left">left</option>
                                                    <option value="center">center</option>
                                                    <option value="right">right</option>
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <select name="element-font-certical-alignment"
                                                    id="elementFontVerticalAlignment" class="form-control">
                                                    <option value="top">top</option>
                                                    <option value="middle">middle</option>
                                                    <option value="bottom">bottom</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Color: <span id="fontColorValue"></span></label>
                                            <br>
                                            <div id="fontColorPicker"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="background">
                                        <h4>Background</h4>
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link active"
                                                    href="#backgroundColorTab">Color</a>
                                            </li>
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link"
                                                    href="#backgroundImageTab">Image</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content my-2">
                                            <div class="tab-pane active" id="backgroundColorTab">
                                                <label>Color: <span id="backgroundColorValue"></span></label>
                                                <br>
                                                <div id="backgroundColorPicker"></div>
                                            </div>
                                            <div class="tab-pane" id="backgroundImageTab">
                                                <div class="form-group">
                                                    <label for="background-size">Background Size:</label>
                                                    <select name="background-size" id="backgroundSize"
                                                        class="form-control">
                                                        <option value="tile">Tile</option>
                                                        <option value="full cover" selected="selected">Full Cover
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-5">Darken</div>
                                                        <div class="col-2 text-center">|</div>
                                                        <div class="col-5 text-right">Lighten</div>
                                                    </div>
                                                    <input type="range" class="custom-range" min="-95" max="95" step="1"
                                                        value="0" id="backgroundOverlay">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="thumb-wrap" id="business-bg-1.jpg"
                                                                title="business-bg-1.jpg"
                                                                onclick="setPreviewBackgroundImage('<?= base_url('assets/fb/images/backgrounds/public/business-bg-1.jpg')?>')">
                                                                <div class="thumb"
                                                                    style="background-image: url('<?= base_url('assets/fb/images/backgrounds/public/business-bg-1.jpg')?>');">
                                                                </div><span>business-bg-1.jpg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="options">
                                        <h4>Options</h4>
                                        <div class="form-group">
                                            <label for="element_span">Width</label>
                                            <select name="element_span" id="elementSpan" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="form-group element-setting-container" tag="height">
                                            <label for="element_height">Height</label>
                                            <select name="element_height" id="elementHeight" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="custom-control custom-switch element-setting-container"
                                            tag="inline">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input"
                                                id="inlineSwitch">
                                            <label class="custom-control-label" for="inlineSwitch">Inline</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input"
                                                id="requiredSwitch">
                                            <label class="custom-control-label" for="requiredSwitch">Required</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input"
                                                id="readOnlySwitch">
                                            <label class="custom-control-label" for="readOnlySwitch">Read Only</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input"
                                                id="adminItemSwitch">
                                            <label class="custom-control-label" for="adminItemSwitch">Admin Item</label>
                                        </div>
                                        <p><small><em>Admin Items are not shown when users fill out your form.
                                                </em></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="elementRulesTab">
                            <div class="container mt-0">
                                <h4>Display Rules</h4>
                                <p>Conditionally show or hide this item. Use the Rules page to configure Rules for all
                                    items at once</p>
                                <div class="container-fluid bg-primary text-light py-2">
                                    <h5 class="modal-element-name">Element Name</h5>
                                    <div class="container-fluid mt-0 bg-secondary py-2">
                                        <div class="form-inline bg-secondary">
                                            <select class="custom-select my-1 mr-sm-2" id="ruleAction"
                                                name="rule_action">
                                                <option value="1">show</option>
                                                <option selected value="0">hide</option>
                                            </select>
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">This item when
                                            </label>
                                            <select class="custom-select my-1 mr-sm-2" id="ruleJoin" name="rule_join"
                                                onchange="setOperatorText(this)">
                                                <option selected value="1">Any</option>
                                                <option value="2">All</option>
                                            </select>
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">of its criteria
                                                match:</label>
                                        </div>
                                    </div>
                                    <div class="rule-items">
                                        <div class="row mt-2 rule-item-container">
                                            <div class="col-4 rule-element-selector">
                                                <select class="custom-select my-1 mr-sm-2" id="ruleItem"
                                                    name="rule_item" onchange="showFields(this)">
                                                    <option selected value="null">Elements</option>
                                                </select>
                                            </div>
                                            <div class="col-2 rule-method-selector">
                                                <select class="custom-select my-1 mr-sm-2" id="ruleCondition"
                                                    name="rule_condition">
                                                    <option selected value="1">is</option>
                                                    <option value="2">is not</option>
                                                    <option value="3">greater than</option>
                                                    <option value="4">less than</option>
                                                </select>
                                            </div>
                                            <div class="col-4 rule-element-answer-selector">
                                                <!-- <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                                    <option selected>Any response</option>
                                                </select> -->
                                                <input type="text" id="ruleAnswer" name="rule_answer"
                                                    class="form-control">
                                            </div>
                                            <div class="col-2 element-rule-actions">
                                                <div class="btn-group align-middle pt-1">
                                                    <button type="button"
                                                        class="btn btn-sm btn-success rounded-circle align-middle m-1"
                                                        onclick="addItemRule()">+</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger rounded-circle align-middle m-1"
                                                        onclick="removeItemRule(this)">-</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
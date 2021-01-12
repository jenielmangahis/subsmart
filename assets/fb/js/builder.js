let tempElements, tempStyle, tempColor, editor;
const styles = ['default', 'big', 'bigger', 'slim', 'rounded', 'narrow', 'casual', 'modern', 'airy', 'bubbly'];
const customize_items = {};
const tab_assignment = {
    'page-background' : 'customizeColorTab',
    'page-background-size' : 'customizeBackgroundSizeTab',
    'page-font-family' : 'customizeFontFamilyTab',
    'page-font-size' : 'customizeFontSizeTab',
    'page-link-color' : 'customizeColorTab',
    'form-border-color' : 'customizeColorTab',
    'form-border-rounding' : 'customizeBorderRoundingTab',
    'form-border-width' : 'customizeBorderWidthTab',
    'form-background' : 'customizeColorTab',
    'form-background-size' : 'customizeBackgroundSizeTab',
    'form-shadow' : 'customizeShadowTab',
    'form-text-color' : 'customizeColorTab',
    'heading-text-color' : 'customizeColorTab',
    'heading-background' : 'customizeColorTab',
    'heading-background-size' : 'customizeBackgroundSizeTab',
    'heading-border-rounding' : 'customizeBorderRoundingTab',
    'item-required-icon' : 'customizeRequiredIconTab',
    'item-label-bold' : 'customizeBoldTab',
    'item-highlight' : 'customizeColorTab',
    'field-border-color' : 'customizeColorTab',
    'field-border-rounding' : 'customizeBorderRoundingTab',
    'field-border-width' : 'customizeBorderWidthTab',
    'field-font-family' : 'customizeFontFamilyTab',
    'field-font-size' : 'customizeFontSizeTab',
    'field-background' : 'customizeColorTab',
    'field-text-color' : 'customizeColorTab',
    'field-spacing' : 'customizeSpacingTab',
    'field-padding' : 'customizePaddingTab',
    'item-spacing' : 'customizeSpacingTab',
    'submit-background': 'customizeColorTab',
    'submit-background-size': 'customizeBackgroundSizeTab',
    'submit-bold': 'customizeBoldTab',
    'submit-border-style': 'customizeBorderStyleTab',
    'submit-border-width': 'customizeBorderWidthTab',
    'submit-capitalization': 'customizeCapitalizationTab',
    'submit-font-family': 'customizeFontFamilyTab',
    'submit-font-size': 'customizeFontSizeTab',
    'submit-height-padding': 'customizePaddingTab',
    'submit-hide': 'customizeHideTab',
    'submit-hover-background': 'customizeColorTab',
    'submit-rounding': 'customizeBorderRoundingTab',
    'submit-shadows': 'customizeShadowTab',
    'submit-text-color': 'customizeColorTab',
    'submit-width': 'customizeWidthTab',
    'matrix-alt-row-color' : "customizeColorTab",
    'matrix-alt-row-header-color' : "customizeColorTab",
    'matrix-alt-row-text-color' : "customizeColorTab",
    'matrix-grid-lines' : "customizeColorTab",
    'matrix-header-background' : "customizeColorTab",
    'matrix-header-text' : "customizeColorTab",
    'matrix-row-color' : "customizeColorTab",
    'matrix-row-header-color' : "customizeColorTab",
    'matrix-row-text-color' : "customizeColorTab",
    'matrix-sub-header-background' : "customizeColorTab",
}
const colors = ['primary', 'secondary', 'danger', 'warning', 'info', 'success', 'dark', 'light', 'orange', 'violet', 'sky-blue', 'persian-green', 'green', 'san-marino-blue', 'mulberry', 'valencia', 'sandy', 'terracotta', 'comet', 'jungle', 'light-brown', 'dark-theme'];
var rule_item_el = $('div.rule-items').html();
const ruleOrOperator = `<div class="row mt-2 operator-container"><div class="col-12"><h6>OR</h6></div></div>`;
const ruleAndOperator = `<div class="row mt-2 operator-container"><div class="col-12"><h6>AND</h6></div></div>`;
let start_elements = [], container_start_elements = [];
$('#formBuilderContainer').sortable({
    placeholder: 'placeholder-hor',
    grid: [20, 20],
    items: '> .in-parent',
    connectWith: '.container-block',
    handle: '.element-handle',
    receive: (event, ui) => {
        if(ui.item.hasClass('form-element')){
            return;
        }
        tempElements = $('#formBuilderContainer').sortable("toArray");
        clearModalForm();
        const elType = ui.item.attr('element_type');
        $('#elementSettingsModal #elementType').val(elType);
        $('#elementSettingsModal #elementID').val(null);
        $('#elementSettingsModal #saveMethod').val('create');
        $('#elementSettingsModal #elementContainer').val(null);
        $('#elementOrder').val(tempElements.indexOf(""));
        const element = new element_types[elType]({}, false);

        if($('#elementSettingsModal #elementID').val() === null || $('#elementSettingsModal #elementID').val() === "") {
            $('.rule-method-selector select[name="rule_condition"]').hide();
            $('.rule-element-answer-selector input[name="rule_answer"]').hide();
        }

        if(element_objs.length !== 0) {
            for (var i in element_objs) {
                if($('select#ruleItem').find(`option[value="${element_objs[i].id}"]`).length === 0) {
                    $('select#ruleItem').append(`<option value="${element_objs[i].id}">${element_objs[i].question}</option>`);
                }
            }
        }

        showModal(element);
    },
    start: (event, ui) => {
        start_elements = $('#formBuilderContainer').sortable("toArray");
    },
    update: (event, ui) => {
        showLoading();
        let elements = $('#formBuilderContainer').sortable("toArray");
        if(start_elements.length > elements.length)return;
        if(start_elements.length < elements.length){
            const el_id = ui.item.attr('id');
            ui.item.addClass('in-parent');
            element_objs[el_id].container_id = null;
        }
        elements = $('#formBuilderContainer').sortable("toArray");
        console.log(elements);
        updateElementOrder(elements).then(async (res) => {
            await loadElements(form.id, true).then(res => {
                initBuilder();
                initContainers();
            });
            showSuccess();
        });
    }
})

const initContainers = () => {
    $('.container-block').sortable({
        placeholder: 'placeholder-hor',
        grid: [20, 20],
        nested: true,
        connectWith: '#formBuilderContainer',
        handle: '.contained-element-handle',
        receive: (event, ui) => {
            if(ui.item.hasClass('form-element'))return;
            const container_element_id = event.target.id;
            const container = container_element_id.split('-')[1];
            const container_elements = $(`#${container_element_id}`).sortable("toArray");
            const index = container_elements.indexOf("");
            const main_elements = $('#formBuilderContainer').sortable('toArray');
            const element_order = main_elements.indexOf(container);
            $('#elementContainer').val(container);
            $('#elementOrder').val(element_order + (index + 2));
            const new_order = $('#elementOrder').val();
            // console.log({
            //     container_element_id,
            //     container,
            //     container_elements,
            //     index,
            //     element_order,
            //     new_order
            // });
        },
        start: (event, ui) => {
            const container_element_id = event.target.id;
            container_start_elements = $(`#${container_element_id}`).sortable("toArray");
        },
        update: (event, ui) => {
            showLoading();
            const main_elements = $('#formBuilderContainer').sortable('toArray');
            const container_element_id = event.target.id;
            const container = container_element_id.split('-')[1];
            // console.log({
            //     container_element_id,
            //     container,
            //     main_elements,
            //     // element_order,
            //     // increment,
            //     // elements
            // });
            const element_order = main_elements.indexOf(container);
            const increment = element_order + 1;
            const elements = $(`#${container_element_id}`).sortable("toArray");
            if(container_start_elements.length > elements.length){
                console.log('cancelled');
                hideLoading();
            };
            if(ui.item.hasClass('form-element')){
                const el_id = ui.item.attr('id');
                element_objs[el_id].container_id = container;
                if(ui.item.hasClass('in-parent')){
                    ui.item.removeClass('in-parent');
                }

            }
            updateElementOrder(main_elements);
            updateElementOrder(elements, increment).then(async (res) => {
                await loadElements(form.id, true).then(res => {
                    initBuilder();
                    initContainers();
                });
                showSuccess();
            });
        }
    })
}

$('.form-elements-template').draggable({
    scroll: false,
    revert: "valid",
    helper: "clone",
    connectToSortable: '#formBuilderContainer',
    snapMode: "inner",
    grid: [20, 20],
    cursorAt: { left: 0, top: 0 },
});

$('.builder-tabs').on('shown.bs.tab', (e) => {
    const el = $(e.target) // newly activated tab
    if (el.attr('href') === '#styleBuildTab') {
        $('#styleSaveContainer').show();
        expandSidebar();
    } else {
        $('#styleSaveContainer').hide();
        resetSidebar();
    }
})

const initColorPicker = () => {
    // requirejs(['./colorjoe/colorjoe'], function(colorjoe) {

    colorjoe.rgb('colorPicker', '#000').on('change', function (c) {
        const val = c.hex();
        $('#colorIndicator').css('background-color', `${val} !important`);
        $('#colorValue').val(val);
        const custom_element = getActiveCustomElement();
        handleCustomElementModified(custom_element.active_option, val);
        applyStyle(custom_element.element_name, val);
    });

    $('#colorPicker').append(`
    <div class="container" style="clear: left; max-width: 200px">
    <div class="row">
      <div class="col-5 px-1">
        <div class="py-2">
          <div id="colorIndicator" class="border" style="background-color: #000"></div>
        </div>
      </div>
      <div class="col-7 px-1">
        <div class="py-2">
          <input type="text" class="form-control" id="colorValue" value="#000000">
        </div>
      </div>
    </div>
  </div>
    `)
    // });
}

const getActiveCustomElement = () => {
    const active_option = $('#active-option').val() ? $('#active-option').val() : 'page-background';
    const active_option_arr = active_option.split('-');
    const element = `${active_option_arr[0]}-element`;
    active_option_arr.splice(0, 1);
    const property = active_option_arr.join('-');
    element_name = active_option.split('-').join('_');
    return {active_option ,element, property, element_name};
}

const handleCustomElementModified = (element, value) => {
    element_name = element.split('-').join('_');
    customize_items[element_name] = value;
}

const handleCustomizeSelectChange = ()  => {
    const val = $('#customizeSelect').val();
    $('#active-option').val(val);
    $(`.nav-tabs a[href="#${tab_assignment[val]}"]`).tab('show')
}

const handleCustomStyleChange = (val_element, output_element, property) => {
    const val = $(`${val_element}`).val();
    const custom_element = getActiveCustomElement();
    handleCustomElementModified(custom_element.active_option, val);
    applyStyle(custom_element.element_name, val);
}

const expandSidebar = () => {
    $('#builderSidebar').removeClass('col-md-3');
    $('#builderFormColumn').removeClass('col-md-9');
    $('#builderSidebar').addClass('col-md-5');
    $('#builderFormColumn').addClass('col-md-7');
    $('#formBuilderContainer').addClass('mx-1');
}

const resetSidebar = () => {
    $('#builderSidebar').removeClass('col-md-5');
    $('#builderFormColumn').removeClass('col-md-7');
    $('#builderSidebar').addClass('col-md-3');
    $('#builderFormColumn').addClass('col-md-9');
    $('#formBuilderContainer').removeClass('mx-1');
}

const handleSaveEelement = (event) => {
    event.preventDefault();
    if (editor) {
        editor.save();
    }
    showLoading();
    const save_method = $('#elementSettingsModal #saveMethod').val();
    if (save_method === 'create') {
        const index = tempElements.indexOf("");
        if (index > -1) {
            tempElements.splice(index, 1);
        }
        const container = $('#elementContainer').val();
        if(parseInt(container) === NaN) {
            $('#elementSettingsModal #elementOrder').val(index);
        }
    }
    const data = getModalValues();
    saveElement(data, save_method).then(async (res) => {
        await loadElements(form.id, true).then(res1 => {
            initBuilder();
            initContainers();
        });
        updateElementOrder(elements);
        $('#elementSettingsModal').modal('hide');
        showSuccess();
    }).catch(err => {
        showDanger();
        console.log(err);
    })
}

const handleCopyElement = (id) => {
    showLoading();
    const element = element_objs[id];
    element.id = null;
    const parsed_data = element.getPostData();
    parsed_data.element_order = parsed_data.element_order + 1;
    saveElement(parsed_data, 'create').then(async (res) => {
        await loadElements(form.id, true).then(res1 => {
            initBuilder();
            initContainers();
        });
        const elements = $('#formBuilderContainer').sortable("toArray");
        await updateElementOrder(elements);
        showSuccess();
    }).catch(err => {
        showDanger();
        console.log(err)
    })
}

const handleDeleteElement = (id) => {
    // const element = element_objs[id];
    deleteElement(id).then(async (res) => {
        showLoading();
        $(`#formBuilderContainer #${id}`).remove();
        const elements = $('#formBuilderContainer').sortable("toArray");
        if (elements == 0) {
            $('#formBuilderContainer').html(`
            <div class="col-12" id="blankFormPlaceHolder">
                Drag items from the left and drop them here.
            </div>`)
            showSuccess();
            return;
        }
        await loadElements(form.id, true).then(res => {
            initBuilder();
            initContainers();
        });
        // await updateElementOrder(elements);
        showSuccess();
    }).catch(err => {
        showDanger();
        console.log(err);
    })
}

const initBuilder = () => {
    $('.form-elements-template').hover((event) => {
        $(event.target).addClass('hover');
    });

    $('.form-elements-template').mouseout((event) => {
        $(event.target).removeClass('hover');
    });
    setStyleTabActives(form.style, form.color);
}

const initEditor = (id = 'elementQuestionEditor') => {
    if ($(`#${id}`).length) {
        editor = KothingEditor.create(`${id}`, {
            height: '100px',
            display: "block",
            width: "100%",
            popupDisplay: "full",
            katex: katex,
            toolbarItem: [
                ["undo", "redo"],
                ["font", "fontSize", "formatBlock"],
                [
                    "bold",
                    "underline",
                    "italic",
                    "strike",
                    "subscript",
                    "superscript",
                    "fontColor",
                    "hiliteColor",
                ],
                ["outdent", "indent", "align", "list", "horizontalRule"],
                ["link", "table", "image"],
                ["lineHeight", "paragraphStyle", "textStyle"],
                ["showBlocks", "codeView"],
                ["math"],
                ["preview", "print", "fullScreen"],
                ["removeFormat"],
            ],
            charCounter: true,
        });
    }
}

const handleElementEdit = (id) => {
    clearModalForm();
    const element = element_objs[id];
    $('#elementSettingsModal .modal-title').html(element.element_type);
    $('#elementSettingsModal #saveMethod').val('update');
    setModalElement(element);
    showModal(element);
}

const setModalElement = (element) => {
    setElementRulesConfig(element);
    $('#elementQuestionInput').val(element.question);
    editor.setContents(element.question);
    $('#elementType').val(element.element_type);
    $('#elementFontFamily').val(element.text_font_family);
    $('#elementFontSize').val(element.text_font_size);
    $('#placeholderText').val(element.placeholder_text);
    $('#textBoldSwitch').attr('checked', element.text_is_bold == 1 ? true : false);
    $('#elementFontHorizontalAlignment').val(element.text_horizontal_align);
    $('#elementFontVerticalAlignment').val(element.text_vertical_align);
    $('#elementSpan').val(element.span);
    $('#elementHeight').val(element.height);
    $('#elementChoicesInput').val(choicesParserReverse(element.choices));
    $('#elementMatrixColumnsInput').val(choicesParserReverse(element.matrix_columns));
    $('#elementMatrixRowsInput').val(choicesParserReverse(element.matrix_rows));
    // $('#elementChoicesAndPricesChoiceInput').val(choicesParserReverse(element.matrix_rows));
    $('#requiredSwitch').attr('checked', element.required == 1 ? true : false);
    $('#inlineSwitch').attr('checked', element.is_inline == 1 ? true : false);
    $('#readOnlySwitch').attr('checked', element.read_only == 1 ? true : false);
    $('#adminItemSwitch').attr('checked', element.admin_item == 1 ? true : false);
    $('#elementSettingsModal #elementID').val(element.id);
    $('#elementSettingsModal #elementOrder').val(element.element_order);
    $('#elementSettingsModal #elementContainer').val(element.container_id);
    $('#elementSettingsModal #minChar').val(element.min);
    $('#elementSettingsModal #maxChar').val(element.max);
    $('#elementSettingsModal #rows').val(element.rows);
    $('#elementSettingsModal #columns').val(element.columns);
    $('#elementSettingsModal #limitUnit').val(element.limit_unit);
    $('#elementSettingsModal #imageUrl').val(element.img_url);
    $('#elementSettingsModal #imageAltText').val(element.img_alt_text);
    $('#elementSettingsModal #optionalLinkText').val(element.optional_link_text);
    $('#elementSettingsModal #url').val(element.url);
    $('#elementSettingsModal #urlText').val(element.url_text);
    $('#elementSettingsModal #customCode').val(element.custom_code);

    $('select[name="rule_item"] option').show();
    $('select[name="rule_item"] option[value="'+element.id+'"]').hide();
}

const setElementRulesConfig = (element) => {
    if(element.rules.length === 1) {
        $('div.rule-items div.operator-container').remove();
    }
    for (var i in element.rules) {
        if (i > 0) {
            if(element.rules[i].rule_join == 1) {
                $('div.rule-items').append(ruleOrOperator);
            } else {
                $('div.rule-items').append(ruleAndOperator);
            }

            $('div.rule-items').append(rule_item_el);            
        };

        var ruleItem = $('div.rule-item-container')[i];

        $('select[name="rule_action"]').val(element.rules[i].rule_action);
        $('select[name="rule_join"]').val(element.rules[i].rule_join);
        if(element.rules[i].rule_item !== null) {
            $(ruleItem).find('.rule-element-selector select[name="rule_item"]').val(element.rules[i].rule_item);
            $(ruleItem).find('.rule-method-selector select[name="rule_condition"]').show();
            $(ruleItem).find('.rule-element-answer-selector input[name="rule_answer"]').show();
        } else {
            $(ruleItem).find('.rule-method-selector select[name="rule_condition"]').hide();
            $(ruleItem).find('.rule-element-answer-selector input[name="rule_answer"]').hide();
        }
        $(ruleItem).find('.rule-method-selector select[name="rule_condition"]').val(element.rules[i].rule_condition);
        $(ruleItem).find('.rule-element-answer-selector input[name="rule_answer"]').val(element.rules[i].rule_answer);
    }

    if($('div.rule-item-container:first').next().next().hasClass('operator-container')) {
        while($('div.rule-item-container:first').next().next().hasClass('operator-container')) {
            $('div.rule-item-container:first').next().next().remove();
        }
    }
}

const getModalValues = () => {
    const element_type = $('#elementType').val();
    let span = $('#elementSpan').val();
    let question = $('#elementQuestionInput').val() ? $('#elementQuestionInput').val() : '';
    let placeholder_text = $('#placeholderText').val() ? $('#placeholderText').val() : '';
    if (element_type === "FormattedText") {
        question = $('#elementQuestionEditor').val() ? $('#elementQuestionEditor').val() : '';
    }

    var element_rule = [];
    var rule = {};
    
    $('div.rule-item-container').each(function(index, val) {

        rule = {
            rule_action : $('select[name="rule_action"]').val(),
            rule_join : $('select[name="rule_join"]').val(),
            rule_item : $(val).find('select[name="rule_item"]').val(),
            rule_condition : $(val).find('select[name="rule_condition"]').val(),
            rule_answer : $(val).find('input[name="rule_answer"]').val() ?? "",
            rule_order : (index+1)
        };

        element_rule.push(rule);
    });

    var return_data = {
        form_element: {
            id: $('#elementSettingsModal #elementID').val(),
            form_id: form.id,
            placeholder_text,
            container_id: parseInt($('#elementSettingsModal #elementContainer').val()) > 0 ? $('#elementSettingsModal #elementContainer').val() : null,
            question: question,
            required: $('#requiredSwitch').is(":checked") ? 1 : 0,
            is_inline: $('#inlineSwitch').is(":checked") ? 1 : 0,
            read_only: $('#readOnlySwitch').is(":checked") ? 1 : 0,
            admin_item: $('#adminItemSwitch').is(":checked") ? 1 : 0,
            text_is_bold: $('#textBoldSwitch').is(":checked") ? 1 : 0,
            element_type: $('#elementType').val(),
            span: span,
            height: $('#elementHeight').val(),
            element_order: $('#elementSettingsModal #elementOrder').val(),
            min: $('#elementSettingsModal #minChar').val(),
            max: $('#elementSettingsModal #maxChar').val(),
            rows: $('#elementSettingsModal #rows').val(),
            columns: $('#elementSettingsModal #columns').val(),
            limit_unit: $('#elementSettingsModal #limitUnit').val(),
            img_url: $('#elementSettingsModal #imageUrl').val(),
            img_alt_text: $('#elementSettingsModal #imageAltText').val(),
            optional_link_url: $('#elementSettingsModal #optionalLinkURL').val(),
            url_text: $('#elementSettingsModal #urlText').val(),
            url: $('#elementSettingsModal #url').val(),
            custom_code: $('#elementSettingsModal #customCode').val(),
            text_font_family: $('#elementSettingsModal #elementFontFamily').val(),
            text_font_size: $('#elementSettingsModal #elementFontSize').val(),
            text_horizontal_align: $('#elementSettingsModal #elementFontHorizontalAlignment').val(),
            text_vertical_align: $('#elementSettingsModal #elementFontVerticalAlignment').val(),
            custom_code: $('#elementSettingsModal #customCode').val(),
            percentage_excluded: $('#percentageExcludeSwitch').is(":checked") ? 1 : 0,
        },
        element_rules: JSON.stringify(element_rule),
        choices: choicesParser($('#elementChoicesInput').val()),
        choices_and_prices: choicesPriceParser($('#elementChoicesAndPricesChoiceInput').val(), $('#elementChoicesAndPricesPriceInput').val()),
        matrix_columns: choicesParser($('#elementMatrixColumnsInput').val()),
        matrix_rows: choicesParser($('#elementMatrixRowsInput').val()),
    }

    console.log('get modal values', return_data);
    return return_data;
}

const showModal = (element) => {
    const settings = (element) ? element.settingItems ? element.settingItems : ['question'] : ['question'];
    $('.element-setting-container').hide();
    settings.forEach(setting => {
        $(`[tag=${setting}]`).show();
        if (setting == 'preview') {
            const form_class_list = document.getElementById('formBuilderContainer').className.split(/\s+/);
            form_class_list.forEach(class_item => {
                if (class_item !== 'row' && class_item !== 'ui-sortable') {
                    $('#elementPreview').addClass(class_item);
                }
            });
            const content = element.getElement(true);
            $('#elementPreview').html(content);
        }
    });
    $('#elementSettingsModal').modal({ backdrop: 'static', keyboard: false })
}

const handleStyleChangePreview = (style) => {
    showLoading();
    try {
        tempStyle = style;
        clearFormStyle();
        clearFormStyleControlActive();
        setFormStyleControlActive(tempStyle);
        setFormStyle(tempStyle);
        hideLoading();
    } catch (error) {
        showDanger();
    }
}

const handleColorChangePreview = (color) => {
    showLoading();
    try {
        tempColor = color;
        clearFormColors();
        clearFormColorControlActive();
        setFormColorControlActive(tempColor);
        setFormColor(tempColor);
        hideLoading();
    } catch (error) {
        showDanger();
    }
}

const clearFormStyle = () => {
    styles.forEach((val, index) => {
        $('#formBuilderContainer').removeClass(`form-${val}`);
    });
}

const clearFormColors = () => {
    colors.forEach((val, index) => {
        $('#formBuilderContainer').removeClass(`form-${val}`);
    });
}

const setFormStyle = (style) => {
    $('#formBuilderContainer').addClass(`form-${style}`);
}

const setFormColor = (color) => {
    $('#formBuilderContainer').addClass(`form-${color}`);
}

const clearFormStyleControlActive = () => {
    $('.style-display-container.form-style.active').removeClass(`active`);
}

const clearFormColorControlActive = () => {
    $('.style-display-container.form-color.active').removeClass(`active`);
}

const setFormColorControlActive = (color) => {
    $(`.style-display-container.form-color.form-${color}`).addClass(`active`);
}

const setFormStyleControlActive = (style) => {
    $(`.style-display-container.form-style.${style}-control`).addClass(`active`);
}

const handleFormStyleSave = async () => {
    showLoading();
    const data = {
        customize_items,
        style: tempStyle,
        color: tempColor,
        id: form.id
    };

    await updateForm(data).then((res) => {
        showBuilderTab('build');
        handleOnLoad(form.id, false);
        showSuccess();
    }).catch(err => {
        showDanger();
    });
}

const showBuilderTab = (tab) => {
    $(`.${tab}-tab`).tab('show');
}

const setStyleTabActives = (style, color) => {
    tempColor = color;
    tempStyle = style;
    clearFormColorControlActive();
    clearFormStyleControlActive();
    setFormStyleControlActive(style);
    setFormColorControlActive(color);
}

const handleQuestionInput = (val) => {
    if ($('#elementPreview .heading-text').length) {
        $('#elementPreview .heading-text').text(val);
    }
}

const handleCopyFromFormClicked = () => {
    $('#copyFromFormModal').modal('show');
}

const appendFormOptions = (obj) => {
    const select = $('#copyFromForm');
    const el = `<option value="${obj.id}">${obj.name}</option>`
    select.append(el);
}

const addItemRule = () => {
    var ruleJoin = $('select[name="rule_join"]').val();
    if(ruleJoin == 1) {
        $('div.rule-items').append(ruleOrOperator);
    } else {
        $('div.rule-items').append(ruleAndOperator);
    }

    $('div.rule-items').append(rule_item_el);
    var elementItems = $('div.rule-items div.rule-item-container').find('div.rule-element-selector select[name="rule_item"]').html();

    $('div.rule-items div.rule-item-container:last').find('div.rule-element-selector select[name="rule_item"] option').remove();
    $('div.rule-items div.rule-item-container:last').find('div.rule-element-selector select[name="rule_item"]').append(elementItems);
    $('div.rule-items div.rule-item-container:last').find('div.rule-method-selector select[name="rule_condition"]').hide();
    $('div.rule-items div.rule-item-container:last').find('div.rule-element-answer-selector input[name="rule_answer"]').hide();
}

const removeItemRule = (el) => {
    if( !$(el).parent().parent().parent().prev().hasClass('operator-container') && 
        $(el).parent().parent().parent().next().hasClass('operator-container')
    ) {
        $(el).parent().parent().parent().next().remove();
    }

    if($(el).parent().parent().parent().prev().hasClass('operator-container')) {
        $(el).parent().parent().parent().prev().remove();
    }

    if($('div.rule-item-container').length !== 1) {
        $(el).parent().parent().parent().remove();
    }
}

const setOperatorText = (el) => {
    if($('div.operator-container').length !== 0) {
        if($(el).val() === "1") {
            $('div.rule-items div.operator-container div h6').html('OR');
        } else {
            $('div.rule-items div.operator-container div h6').html('AND');
        }
    }
}

const showFields = (el) => {
    if($(el).val() === null || $(el).val() === "" || $(el).val() === "null") {
        $(el).parent().parent().find('div.rule-method-selector select[name="rule_condition"]').hide();
        $(el).parent().parent().find('div.rule-element-answer-selector input[name="rule_answer"]').hide();
    } else {
        $(el).parent().parent().find('div.rule-method-selector select[name="rule_condition"]').show();
        $(el).parent().parent().find('div.rule-element-answer-selector input[name="rule_answer"]').show();
    }
}

const setPreviewBackgroundImage = (img) => {
    alert(img);
    $(`#elementPreview .form-header`).css('background-image', `url(${img})`);
}
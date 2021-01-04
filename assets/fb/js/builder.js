let tempElements, tempStyle, tempColor, editor;
const styles = ['default', 'big', 'bigger', 'slim', 'rounded', 'narrow', 'casual', 'modern', 'airy', 'bubbly'];
const colors = ['primary', 'secondary', 'danger', 'warning', 'info', 'success', 'dark', 'light', 'orange', 'violet', 'sky-blue', 'persian-green', 'green', 'san-marino-blue', 'mulberry', 'valencia', 'sandy', 'terracotta', 'comet', 'jungle', 'light-brown', 'dark-theme'];
var rule_item_el = $('div.rule-items').html();
const ruleOrOperator = `<div class="row mt-2 operator-container"><div class="col-12"><h6>OR</h6></div></div>`;
const ruleAndOperator = `<div class="row mt-2 operator-container"><div class="col-12"><h6>AND</h6></div></div>`;
$('#formBuilderContainer').sortable({
    placeholder: 'placeholder-hor',
    grid: [20, 20],
    items: '> .in-parent',
    nested: true,
    connectWith: '.container-block',
    handle: '.element-handle',
    receive: (event, ui) => {
        tempElements = $('#formBuilderContainer').sortable("toArray");
        clearModalForm();
        const elType = ui.item.attr('element_type');
        $('#elementSettingsModal #elementType').val(elType);
        $('#elementSettingsModal #elementID').val(null);
        $('#elementSettingsModal #saveMethod').val('create');
        const element = new element_types[elType]({}, false);
        showModal(element);
    },
    update: (event, ui) => {
        showLoading();
        const elements = $('#formBuilderContainer').sortable("toArray");
        updateElementOrder(elements).then( async (res) => {
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
        items: '> .container-block',
        connectWith: '#formBuilderContainer',
        handle: '.contained-element-handle',
        receive: (event, ui) => {
        },
        update: (event, ui) => {
            const elements = $('.container-block').sortable("toArray");
            console.log(elements);
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
    if(el.attr('href') === '#styleBuildTab') {
        $('#styleSaveContainer').show();
    } else {
        $('#styleSaveContainer').hide();
    }
})

const handleSaveEelement = (event) => {
    event.preventDefault();
    if(editor) {
        editor.save();
    }
    showLoading();
    const save_method = $('#elementSettingsModal #saveMethod').val();
    if(save_method === 'create') {
        const index = tempElements.indexOf("");
        if (index > -1) {
            tempElements.splice(index, 1);
        }
        $('#elementSettingsModal #elementOrder').val(index);
    }
    const data = getModalValues();
    saveElement(data, save_method).then(async (res) => {
        await loadElements(form.id, true).then(res1 => {
            initBuilder();
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
    console.log('copying...');
    showLoading();
    const element = element_objs[id];
    element.id = null;
    const parsed_data = element.getPostData();
    saveElement(parsed_data, 'create').then(async (res) => {
        console.log('copied');
        await loadElements(form.id, true);
        const elements = $('#formBuilderContainer').sortable("toArray");
        console.log(elements);
        await updateElementOrder(elements);
        showSuccess();
    }).catch(err => {
        showDanger();
        console.log(err);
    })
}

const handleDeleteElement = (id) => {
    const element = element_objs[id];
    deleteElement(id).then(async (res) => {
        showLoading();
        const html_element = $(`#formBuilderContainer #${id}`).remove();
        if (!element_objs.length) {
            $('#formBuilderContainer').html(`
            <div class="col-12" id="blankFormPlaceHolder">
                Drag items from the left and drop them here.
            </div>`)
            showSuccess();
            return;
        }
        await loadElements(form.id, true).then(res => {
            initBuilder();
        });
        const elements = $('#formBuilderContainer').sortable("toArray");
        await updateElementOrder(elements);
        showSuccess();
    }).catch(err => {
        showDanger();
        console.log(err);
    })
}

const initBuilder = () => {
    $('.form-elements-template').hover((event) =>{
        $(event.target).addClass('hover');
    });
    
    $('.form-elements-template').mouseout((event) =>{
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
    $('#elementSettingsModal #saveMethod').val('update');
    setModalElement(element);
    showModal(element);
}

const setModalElement = (element) => {
    setElementRulesConfig(element);
    $('#elementQuestionInput').val(element.question);
    $('#elementQuestionEditor').val(element.question);
    $('#elementType').val(element.element_type);
    $('#elementWidth').val(element.span);
    $('#elementHeight').val(element.height);
    $('#elementChoicesInput').val(choicesParserReverse(element.choices));
    $('#elementMatrixColumnsInput').val(choicesParserReverse(element.matrix_columns));
    $('#elementMatrixRowsInput').val(choicesParserReverse(element.matrix_rows));
    // $('#elementChoicesAndPricesChoiceInput').val(choicesParserReverse(element.matrix_rows));
    $('#requiredSwitch').val(element.required);
    $('#readOnlySwitch').val(element.read_only);
    $('#adminItemSwitch').val(element.admin_item);
    $('#elementSettingsModal #elementID').val(element.id);
    $('#elementSettingsModal #elementOrder').val(element.element_order);
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
    let span =  $('#elementSpan').val();
    let question = $('#elementQuestionInput').val() ? $('#elementQuestionInput').val() : '';
    if(element_type === "Heading") {
        span = $('#elementWidth').val();
    }
    if(element_type === "FormattedText") {
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
            question: question,
            required: $('#requiredSwitch').is(":checked") ? 1 : 0,
            read_only: $('#readOnlySwitch').is(":checked") ? 1 : 0,
            admin_item: $('#adminItemSwitch').is(":checked") ? 1 : 0,
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
            percentage_excluded: $('#percentageExcludeSwitch').is(":checked") ? 1 : 0,
        },
        element_rules: JSON.stringify(element_rule),
        choices: choicesParser($('#elementChoicesInput').val()),
        choices_and_prices: choicesPriceParser($('#elementChoicesAndPricesChoiceInput').val(),$('#elementChoicesAndPricesPriceInput').val()),
        matrix_columns: choicesParser($('#elementMatrixColumnsInput').val()),
        matrix_rows: choicesParser($('#elementMatrixRowsInput').val()),
    }


    return return_data;
}

const showModal = (element) => {
    const settings = (element) ? element.settingItems ? element.settingItems : ['question'] : ['question'];
    $('.element-setting-container').hide();
    settings.forEach(setting => {
        $(`[tag=${setting}]`).show();
        if(setting == 'preview') {
            const form_class_list = document.getElementById('formBuilderContainer').className.split(/\s+/);
            form_class_list.forEach(class_item => {
                if(class_item !== 'row' && class_item !== 'ui-sortable'){
                    $('#elementPreview').addClass(class_item);
                }
            });
            const content = element.getElement(true);
            $('#elementPreview').html(content);
        }
    });
    $('#elementSettingsModal').modal({backdrop: 'static', keyboard: false})  
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
        style: tempStyle,
        color: tempColor,
        id: form.id
    };

    await updateForm(data).then((res) => {
        showBuilderTab('build');
        handleOnLoad(form.id, true);
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
    if($('#elementPreview .heading-text').length) {
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
        console.log(459);
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
    console.log($(el).val() === "null");
    if($(el).val() === null || $(el).val() === "" || $(el).val() === "null") {
        $(el).parent().parent().find('div.rule-method-selector select[name="rule_condition"]').hide();
        $(el).parent().parent().find('div.rule-element-answer-selector input[name="rule_answer"]').hide();
    } else {
        $(el).parent().parent().find('div.rule-method-selector select[name="rule_condition"]').show();
        $(el).parent().parent().find('div.rule-element-answer-selector input[name="rule_answer"]').show();
    }
}
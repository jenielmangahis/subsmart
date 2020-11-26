let tempElements;
$('#formBuilderContainer').sortable({
    placeholder: 'placeholder-hor',
    grid: [20, 20],
    nested: true,
    receive: (event, ui) => {
        tempElements = $('#formBuilderContainer').sortable("toArray");
        clearModalForm();
        const elType = ui.item.attr('element_type');
        $('#elementSettingsModal #elementType').val(elType);
        $('#elementSettingsModal #elementID').val(null);
        $('#elementSettingsModal #saveMethod').val('create');
        const element = new element_types[elType]({}, false);
        showModal(element.settingItems);
    },
    update: (event, ui) => {
        showLoading();
        const elements = $('#formBuilderContainer').sortable("toArray");
        updateElementOrder(elements).then(res => {
            loadElements(form.id, true)
            showSuccess();
        });
    }
})

$('.form-elements-template').draggable({
    scroll: false,
    revert: "valid",
    helper: "clone",
    connectToSortable: '#formBuilderContainer',
    snapMode: "inner",
    grid: [20, 20],
    cursorAt: { left: 0, top: 0 },
})

const handleSaveEelement = (event) => {
    event.preventDefault();
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
    saveElement(data, save_method).then(res => {
        loadElements(form.id, true);
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

const initEvents = () => {
    $('.form-elements-template').hover((event) =>{
        $(event.target).addClass('hover');
    });
    
    $('.form-elements-template').mouseout((event) =>{
        $(event.target).removeClass('hover');
    });
}

const handleElementEdit = (id) => {
    clearModalForm();
    const element = element_objs[id];
    $('#elementSettingsModal #saveMethod').val('update');
    setModalElement(element);
    showModal(element.settingItems);
}

const setModalElement = (element) => {
    $('#elementQuestionInput').val(element.question);
    $('#elementType').val(element.element_type);
    $('#elementSpan').val(element.span);
    $('#elementChoicesInput').val(choicesParserReverse(element.choices));
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
}

const getModalValues = () => {
    return {
        form_element: {
            id: $('#elementSettingsModal #elementID').val(),
            form_id: form.id,
            question: $('#elementQuestionInput').val(),
            required: $('#requiredSwitch').is(":checked") ? 1 : 0,
            read_only: $('#readOnlySwitch').is(":checked") ? 1 : 0,
            admin_item: $('#adminItemSwitch').is(":checked") ? 1 : 0,
            element_type: $('#elementType').val(),
            span: $('#elementSpan').val(),
            element_order: $('#elementSettingsModal #elementOrder').val(),
            min: $('#elementSettingsModal #minChar').val(),
            max: $('#elementSettingsModal #maxChar').val(),
            rows: $('#elementSettingsModal #rows').val(),
            columns: $('#elementSettingsModal #columns').val(),
            limit_unit: $('#elementSettingsModal #limitUnit').val(),
        },
        choices: choicesParser($('#elementChoicesInput').val()),
    }
}

const showModal = (settings = ['question']) => {
    $('.element-setting-container').hide();
    settings.forEach(setting => {
        $(`[tag=${setting}]`).show();
    });
    $('#elementSettingsModal').modal({backdrop: 'static', keyboard: false})  
}

const showLoading = () => {
    hideSuccess();
    hideDanger();
    $('#loadingContainer').show();
}

const hideLoading = () => {
    $('#loadingContainer').hide();
}

const showDanger = () => {
    hideSuccess();
    hideLoading();
    $('#dangerIndicator').show();
}

const hideDanger = () => {
    $('#dangerIndicator').hide();
}

const showSuccess = () => {
    hideLoading();
    hideDanger();
    $('#successIndicator').show();
    setTimeout(() => {
        hideSuccess();
    }, 2000);
}

const hideSuccess = () => {
    $('#successIndicator').hide();
}
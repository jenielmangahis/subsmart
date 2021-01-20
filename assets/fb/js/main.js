let form;
let products;
let elements;
let template_form;
let template_products;
let template_elements;
let signpads;
const element_objs = [];

const handleCreateForm = async (e) => {
    e.preventDefault()
    let url = '/fb/create';
    if(active_template.id > 0){
        url = `/fb/generate-from-template/${active_template.id}`
    }
    const name = $('#addName').val() == '' ? active_template.name : $('#addName').val();
    $.ajax({
        type: 'POST',
        url,
        data: { name }
    }).done((response) => {
        console.log('create response: ', response.data.template);
        window.location.replace(`/fb/edit/${response.data.form_id}`);
    }).fail((err) => {
        console.log(err);
    })
}

const initSignPads = () => {
    signpads = [];
    const canvas = $('.signature-canvas');
    let i = 0;
    while (i < canvas.length) {
        const el = $(canvas[i]);
        const id = el.attr('id')
        let signpad = new SignaturePad(
            document.querySelector(`#${id}`),
            {
              backgroundColor: "rgb(255, 255, 255)",
            }
          );
        signpads[id] = signpad;
        i++;
    }
}

const getAllForms = (data = {}) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url' : '/fb/get-by-active-user',
            'data': data
        }).done((response) => {
            resolve(response)
        }).fail((err) => {
            reject(err);
        })
    })
}

const getAllFolders = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url' : '/fb/folders/get-by-active-user'
        }).done((response) => {
            resolve(response)
        }).fail((err) => {
            reject(err);
        })
    })
}

const getAllFormTemplateFolders = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url' : '/fb/template-folders/get-all'
        }).done((response) => {
            resolve(response)
        }).fail((err) => {
            reject(err);
        })
    })
}

const getAllFormTemplates = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url' : '/fb/templates/get-all'
        }).done((response) => {
            resolve(response)
        }).fail((err) => {
            reject(err);
        })
    })
}

const getFormByID = (form_id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url': `/fb/get-form-by-id/${form_id}`
        }).done(response => {
            form = response.data.form;
            form_style = response.data.form_style;
            elements = response.data.elements;
            products = response.data.products;
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

<<<<<<< HEAD
=======
const getTemplateFormByID = (form_id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url': `/fb/templates/get-by-form-template-id/${form_id}`
        }).done(response => {
            template_form = response.data.form;
            template_form_style = response.data.form_style;
            template_elements = response.data.elements;
            products = response.data.products;
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

const getFormTemplateByID = (form_id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url': `/fb/templates/get-by-form-template-id/${form_id}`
        }).done(response => {
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

>>>>>>> staging
const renderFormStyle = () => {
    for (const key in form_style) {
        if (form_style.hasOwnProperty(key)) {
            if(key !== 'id' && key !== 'form_id') {
                applyStyle(key, form_style[key]);
            }
        }
    }
}

<<<<<<< HEAD
=======
const renderFormTemplateStyle = () => {
    for (const key in template_form_style) {
        if (template_form_style.hasOwnProperty(key)) {
            if(key !== 'id' && key !== 'form_id') {
                applyStyle(key, template_form_style[key]);
            }
        }
    }
}

>>>>>>> staging
const saveElement = (data, save_method = 'create') => {
    let url = '/fb/elements/create'
    if(save_method === 'update') {
        url = `/fb/elements/update/${data.form_element.id}`;
    }
    console.log('save element', data);
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'POST',
            'url': url,
            'data': data
        }).done(response => {
            console.log('200', response)
            resolve(response)
        }).fail(err => {
            console.log(err)
            reject(err);
        })
    })
}

const deleteElement = (id) => {
    return new Promise((resolve, reject) => {
        try {
            $.ajax({
                'type': 'POST',
                'url': `/fb/elements/destroy/${id}`,
                'data': []
            }).done(response => {
                delete element_objs[id];
                resolve(response)
            }).fail(err => {
                reject(err);
            })   
        } catch (error) {
                reject(error);
        }
    })
}

const renderElement = (el, editable = false) => {
    const element = new element_types[el.element_type](el, editable);
    element_objs[el.id] = element;
    if(element.container_id !== null && element.container_id != 0) {
        $(`#ContainerBlock-${element.container_id}`).append(element.getElement())
    } else {
        if(editable) {
            $('#formBuilderContainer').append(element.getElement())
        } else {
            $('#formContainer').append(element.getElement())
        }
    }
}

const renderTemplateElement = (el) => {
    const element = new element_types[el.element_type](el, false);
    if(element.container_id !== null && element.container_id != 0) {
        $(`#ContainerBlock-${element.container_id}`).append(element.getElement())
    } else {
        $('#formTemplatePreview').append(element.getElement())
    }
}

if (window.view_form_builder) {
    setInterval(() => {
        setElementRules()
    }, 1000);
}

const setElementRules = () => {
    for (var n in elements) {
        var ruleSet = elements[n].rules;

        if (ruleSet.length > 0) {
            for (var i in ruleSet) {
    
                var mainElement = $(`div.form-element#${ruleSet[i].element_id}`); // the element show or hide based on the rule item
                var ruleItem = $(`div#${ruleSet[i].rule_item} input`); // the element selected for the condition
    
                // if(ruleSet[i].rule_action === "1" && ruleSet[i].rule_item !== null) {
                //     mainElement.hide();
                // }
    
                var v = ruleItem.val();
    
                if (ruleSet[i].rule_condition == "1") {
                    if (typeof v !== "undefined" && v.trim() == ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "1") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else if(typeof v !== "undefined" && v.trim() == ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "0") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else {
                        ruleSet[i].flag = false; // mainElement.hide();
                    }
                } else if (ruleSet[i].rule_condition == "2") {
                    if (typeof v !== "undefined" && v.trim() != ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "1") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else if (typeof v !== "undefined" && v.trim() != ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "0") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else {
                        ruleSet[i].flag = false; // mainElement.hide();
                    }
                } else if (ruleSet[i].rule_condition == "3") {
                    if (typeof v !== "undefined" && v.trim() > ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "1") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else if(typeof v !== "undefined" && v.trim() > ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "0") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else {
                        ruleSet[i].flag = false; // mainElement.hide();
                    }
                } else if (ruleSet[i].rule_condition == "4") {
                    if (typeof v !== "undefined" && v.trim() < ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "1") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else if(typeof v !== "undefined" && v.trim() < ruleSet[i].rule_answer.trim() && ruleSet[i].rule_action === "0") {
                        ruleSet[i].flag = true; // mainElement.show();
                    } else {
                        ruleSet[i].flag = false; // mainElement.hide();
                    }
                }
            }

            for (i in ruleSet) {
                var mainElement = $(`div.form-element#${ruleSet[i].element_id}`);
                var ruleItem = $(`div#${ruleSet[i].rule_item} input`); // the element selected for the condition
                var v = ruleItem.val();

                if(ruleSet[i].rule_action === "1" && v == "") {
                    mainElement.hide();
                    break;
                } else if(ruleSet[i].rule_action === "0" && v == "") {
                    mainElement.show();
                    break;
                } else if (ruleSet[0].rule_join == "1") {
                    if (ruleSet[i].flag === true) {
                        if (ruleSet[i].rule_action == "0") mainElement.hide();
                        if (ruleSet[i].rule_action == "1") mainElement.show();
                        break;
                    } else {
                        if (ruleSet[i].rule_action == "0") mainElement.show();
                        if (ruleSet[i].rule_action == "1") mainElement.hide();
                    }
                } else if (ruleSet[0].rule_join == "2") {
                    if (ruleSet[i].flag === false) {
                        if (ruleSet[i].rule_action == "0") mainElement.show();
                        if (ruleSet[i].rule_action == "1") mainElement.hide();
                        break;
                    } else if(ruleSet[i].rule_action == 0) {
                        if (ruleSet[i].rule_action == "0") mainElement.hide();
                        if (ruleSet[i].rule_action == "1") mainElement.show();
                    } else {
                        if (ruleSet[i].rule_action == "0") mainElement.hide();
                        if (ruleSet[i].rule_action == "1") mainElement.show();
                    }
                }
            }
        }

    }
    ruleElementsFlag = [];
}

const updateElementOrder = (elements, increment = 0, parent_element = null) => {

    return new Promise((resolve, reject) => {
        try {
            const data = [];
            elements.forEach((el, index) => {
                if(el !== "" && el !== 'blankFormPlaceHolder') {
                    const id = typeof el === 'object' ? el.id : el;
                    try {
                        element_objs[id].element_order = index + increment;
                    } catch (error) {
                        console.log(error);
                    }
                    const element = element_objs[id].getPostData(false);
                    data.push(element);
                }
            });
            if(!data.length) {
                resolve('empty form');
            } else {
                $.ajax({
                    'type': 'POST',
                    'url': `/fb/elements/update-order`,
                    'data': {elements: data}
                }).done(response => {
                    resolve(response)
                }).fail(err => {
                    reject(err);
                })   
            }
        } catch (error) {
                reject(error);
        }
    })
}

const clearModalForm = () => {
    document.getElementById('elementSettings').reset();
    editor.setContents('');
    $('#requiredSwitch').attr('checked', false);
    $('#inlineSwitch').attr('checked', false);
    $('#readOnlySwitch').attr('checked', false);
    $('#adminItemSwitch').attr('checked', false);
    $('div.rule-item-container').each(function(index, val) {
        if (index > 0) $(val).remove();
    });
}


const choicesParser = (choice_text) => {
    if(choice_text) {
        choice_text = choice_text.trim();
        const choices = choice_text.split(/\r\n|\n\r|\n|\r/);
        choices.forEach(el => {
            
        });
        return choices;
    }

    return ['-'];
}

const choicesPriceParser = (choices_text, prices_text) => {
    if(choices_text) {
        choices_text = choices_text.trim();
        const choices = choices_text.split(/\r\n|\n\r|\n|\r/);
        const prices = prices_text.split(/\r\n|\n\r|\n|\r/);
        const choice_price_arr = [];
        choices.forEach((el, i) => {
            let price = prices[i] ? prices[i]: 0;
            const choice_price_obj = {
                name: el,
                price
            }
            choice_price_arr.push(choice_price_obj);
        });
        return choice_price_arr;
    }

    return [
        {
            'name': '-',
            'price': 0,
        }
    ];
}

const choicesPriceParserReverse = (choices) => {
    let choice_string = '';
    choices.forEach((choice, i) => {
        choice_string += choice.name ? choice.name : choice.text;
        i < choices.length - 1 ? choice_string += '\n' : '';
        price_string += choice.price ? choice.price : choice.text;
        i < choices.length - 1 ? price_string += '\n' : '';
    });
    return {choice_string, price_string};
}

const choicesParserReverse = (choices) => {
    let choice_string = '';
    choices.forEach((choice, i) => {
        choice_string += choice.choice_text ? choice.choice_text : choice.text;
        i < choices.length - 1 ? choice_string += '\n' : '';
    });
    return choice_string;
}

const loadElements = async (form_id, editable = false) =>  {
    await getFormByID(form_id).then(res => {
        let container = '#formContainer';
        if(elements.length) {
            if(editable) {
                container = '#formBuilderContainer';
                $().empty();
            }
            $(container).empty();
            $(container).addClass(`form-${form.style}`);
            $(container).addClass(`form-${form.color}`);
            $('form#formElementsContainer').addClass(`form-${form.style}`);
            $('form#formElementsContainer').addClass(`form-${form.color}`);
            if(form.color === 'dark-theme') {
                $('body').addClass('dark-theme');
            }
            res.data.elements.forEach(element => {
                renderElement(element, editable);
            });
            renderFormStyle();
        }
        initCalendars();
    })
}

const loadTemplatePreview = async (form_id) =>  {
    console.log(form_id)
    await getTemplateFormByID(form_id).then(res => {
        let container = '#formTemplatePreview';
        if(template_elements.length) {
            $(container).empty();
            $(container).addClass(`form-${template_form.style}`);
            $(container).addClass(`form-${template_form.color}`);
            res.data.elements.forEach(element => {
                renderTemplateElement(element);
            });
            renderFormTemplateStyle();
        }
        initCalendars();
    })
}

const updateForm = (data) => {
    return new Promise((resolve, reject) => {
        try {
            $.ajax({
                'type': 'POST',
                'url': `/fb/update/${data.id}`,
                'data': data
            }).done(response => {
                resolve(response)
            }).fail(err => {
                reject(err);
            })   
        } catch (error) {
                reject(error);
        }
    })
}

const initCalendars = () => {
    $('.form-datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
}

const saveFolder = (data, save_method = 'create') => {
    let url = '/fb/folders/create'
    if(save_method === 'update') {
        url = `/fb/folders/update/${data.id}`;
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'POST',
            'url': url,
            'data': data
        }).done(response => {
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

const deleteFolder = (folder_id) => {
    let url = `/fb/folders/destroy/${folder_id}`;
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'POST',
            'url': url,
        }).done(response => {
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

const clearCanvas = (id) => {
    signpads[`Signature-${id}`].clear();
}

const handleCopyFormLink = () => {
    document.getElementById('formMainLink').select();
    document.execCommand('copy');
}

const handleCopyFormEmbedCode = () => {
    document.getElementById('formEmbedCode').select();
    document.execCommand('copy');
}


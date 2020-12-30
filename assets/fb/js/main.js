let form;
let elements;
let signpads;
const element_objs = [];

const handleCreateForm = async (e) => {
    e.preventDefault()
    
    const name = $('#name').val();
    
    $.ajax({
        type: 'POST',
        url: '/fb/create',
        data: { name }
    }).done((response) => {
        window.location.replace(`/fb/edit/${response.data.form_id}`);
    }).fail((err) => {
        console.log(err);
    })
}

const initSignPads = () => {
    console.log('initializing signpads...')
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

const getFormByID = (form_id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url': `/fb/get-form-by-id/${form_id}`
        }).done(response => {
            form = response.data.form;
            elements = response.data.elements;
            resolve(response)
        }).fail(err => {
            reject(err);
        })
    })
}

const saveElement = (data, save_method = 'create') => {
    let url = '/fb/elements/create'
    if(save_method === 'update') {
        url = `/fb/elements/update/${data.form_element.id}`;
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

const deleteElement = (id) => {
    return new Promise((resolve, reject) => {
        try {
            $.ajax({
                'type': 'POST',
                'url': `/fb/elements/destroy/${id}`,
                'data': []
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

const renderElement = (el, editable = false) => {
    const element = new element_types[el.element_type](el, editable);
    element_objs[el.id] = element;
    if(element.container_id !== null) {
        $(`#ContainerBlock-${element.container_id}`).append(element.getElement())
    } else {
        if(editable) {
            $('#formBuilderContainer').append(element.getElement())
        } else {
            $('#formContainer').append(element.getElement())
        }
    }
}

const updateElementOrder = (elements) => {

    return new Promise((resolve, reject) => {
        try {
            const data = [];
            elements.forEach((el, index) => {
                if(el !== "" && el !== 'blankFormPlaceHolder') {
                    const id = typeof el === 'object' ? el.id : el;
                    try {
                        element_objs[el].element_order = index;
                    } catch (error) {
                        console.log(el, typeof el === 'object');
                    }
                    const element = element_objs[el].getPostData(false);
                    data.push(element);
                }
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
            });
        } catch (error) {
                reject(error);
        }
    })
}

const clearModalForm = () => {
    document.getElementById('elementSettings').reset();
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
            res.data.elements.forEach(element => {
                renderElement(element, editable);
            });
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


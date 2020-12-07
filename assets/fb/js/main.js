let form;
let elements;
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

const getAllForms = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            'type': 'GET',
            'url' : '/fb/get-all-by-active-user'
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
    if(editable) {
        $('#formBuilderContainer').append(element.getElement())
    } else {
        $('#formContainer').append(element.getElement())
    }
}

const updateElementOrder = (elements) => {

    return new Promise((resolve, reject) => {
        try {
            const data = [];
            elements.forEach((el, index) => {
                if(el !== "" && el !== 'blankFormPlaceHolder') {
                    element_objs[el].element_order = index;
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
                        console.log(data);
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

const choicesParserReverse = (choices) => {
    let choice_string = '';
    choices.forEach((choice, i) => {
        choice_string += choice.choice_text;
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

const updateFormStyle = (data) => {
    return new Promise((resolve, reject) => {
        try {
            $.ajax({
                'type': 'POST',
                'url': `/fb/update-style/${form.id}`,
                'data': data
            }).done(response => {
                console.log(data);
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
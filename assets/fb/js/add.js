let active_template;
let form_templates = [];
$(() => {
    form_templates[0] = {
        id: 0,
        name: 'Blank Form'
    }
    setActiveTemplate(0);
    getAllFormTemplates().then(res => {
        form_templates = [];
        res.data.forEach(el => {
            appendFormTemplate(el);
        })
    });
});

const setActiveTemplate = async (template_id) => {
    active_template = form_templates[template_id];
    console.log(active_template);
    $('#addTemplateID').val(active_template.id);
    await loadTemplatePreview(template_id);
}

const getActiveTemplate = () => {
    alert(active_template_id);
}

const createForm = (e) => {
    console.log(e);
    // e.preventDefault();
}

const appendFormTemplate = (template) => {
    form_templates[template.id] = template;
    const container = $(`#folder-${template.folder_id} .submenu`);
    const control = `<li><a href="#" onclick="setActiveTemplate(${template.id})">${template.name}</a></li>`;
    $(`#folder-${template.folder_id} .submenu .empty-container`).remove();
    container.append(control);
}

const toggleCreate = () => {
    $('#addFormModal').modal('show');
}
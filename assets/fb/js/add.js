let active_template_id;

$(() => {
    setActiveTemplate(0);
});

const setActiveTemplate = (template_id) => {
    active_template_id = template_id;
}

const getActiveTemplate = () => {
    alert(active_template_id);
}

const createForm = (e) => {
    console.log(e);
    // e.preventDefault();
}

const getFormTemplates = () => {
    
}
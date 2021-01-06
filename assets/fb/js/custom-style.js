const element_properties = {
    form_background:{
        property:  "background",
        element: "form-container-element"
    },
    form_background_size: {
        property: "background-size",
        element: "form-container-element"
    },
    form_border_color: {
        property: "border-color",
        element: "form-container-element"
    },
    form_border_rounding: {
        property: "border-radius",
        element: "form-container-element"
    },
    form_border_width:{
        property:  "border-width",
        element: "form-container-element"
    },
    form_error_background:{
        property:  "background",
        element: "form-container-element"
    },
    form_error_text_color:{
        property:  "color",
        element: "form-container-element"
    },
    form_shadow: {
        property: "border-shadow",
        element: "form-container-element"
    },
    form_text_color:{
        property:  "color",
        element: "form-container-element"
    },
    heading_background:{
        property:  "background",
        element: "heading-element"
    },
    heading_background_size: {
        property: "background-size",
        element: "heading-element"
    },
    heading_border_rounding: {
        property: "border-radius",
        element: "heading-element"
    },
    heading_text_color:{
        property:  "color",
        element: "heading-element"
    },
    item_label_bold: {
        property: "font-weight",
        element: "form"
    },
    item_required_icon: {
        property: "required-icon",
        element: "form"
    },
    page_background:{
        property:  "background",
        element: "page-element"
    },
    page_background_size: {
        property: "background-size",
        element: "page-element"
    },
    page_font_family: {
        property: "font-family",
        element: "page-element"
    },
    page_font_size: {
        property: "font-size",
        element: "page-element"
    },
    page_header_footer_color:{
        property:  "color",
        element: "page-element"
    },
    page_link_color:{
        property:  "color",
        element: "page-element a"
    },
}
const renderStyle = (element, value) => {
    const el = element_properties[element].element;
    const prop = element_properties[element].property;
    $(`.${el}`).css(prop, value);
}
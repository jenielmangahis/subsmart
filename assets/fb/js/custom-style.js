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
        element: "form-container-element .error"
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
        element: "element-label"
    },
    item_required_icon: {
        property: "required-icon",
        element: "form"
    },
    item_highlight: {
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
        element: "page-element:not(.fa)"
    },
    page_header_footer_color:{
        property:  "color",
        element: "page-element"
    },
    page_link_color:{
        property:  "color",
        element: "page-element a"
    },
    field_border_color : {
        property:  "border-color",
        element: "form-container-element .form-control"
    },
    field_border_rounding : {
        property:  "border-radius",
        element: "form-container-element .form-control"
    },
    field_border_width : {
        property:  "border-width",
        element: "form-container-element .form-control"
    },
    field_font_family : {
        property:  "font-family",
        element: "form-container-element .form-control"
    },
    field_font_size : {
        property:  "font-size",
        element: "form-container-element .form-control"
    },
    field_background : {
        property:  "background",
        element: "form-container-element .form-control"
    },
    field_text_color : {
        property:  "color",
        element: "form-container-element .form-control"
    },
    field_spacing : {
        property:  "margin",
        element: "form-container-element .form-control"
    },
    field_padding : {
        property:  "padding",
        element: "form-container-element .form-control"
    },
    item_spacing : {
        property:  "margin",
        element: "form-element"
    },
    item_padding : {
        property:  "padding",
        element: "form-element"
    },
    submit_background: {
        property:  "background",
        element: "submit-button-element"
    },
    submit_background_size: {
        property:  "background-size",
        element: "submit-button-element"
    },
    submit_bold: {
        property:  "font-weight",
        element: "submit-button-element"
    },
    submit_border_style: {
        property:  "border-style",
        element: "submit-button-element"
    },
    submit_border_width: {
        property:  "border-width",
        element: "submit-button-element"
    },
    submit_capitalization: {
        property:  "text-transform",
        element: "submit-button-element"
    },
    submit_font_family: {
        property:  "font-family",
        element: "submit-button-element"
    },
    submit_font_size: {
        property:  "font-size",
        element: "submit-button-element"
    },
    submit_height_padding: {
        property:  "padding",
        element: "submit-button-element"
    },
    submit_hide: {
        property:  "display",
        element: "submit-button-element"
    },
    submit_hover_background: {
        property:  "background",
        element: "submit-button-element"
    },
    submit_rounding: {
        property:  "border-radius",
        element: "submit-button-element"
    },
    submit_shadows: {
        property:  "box-shadow",
        element: "submit-button-element"
    },
    submit_text_color: {
        property:  "color",
        element: "submit-button-element"
    },
    submit_width: {
        property:  "width",
        element: "submit-button-element"
    },
    matrix_alt_row_color: {
        property:  "background",
        element: "matrix-tr-alt"
    },
    matrix_alt_row_header_color: {
        property:  "background",
        element: "matrix-tr-alt .matrix-tr-header"
    },
    matrix_alt_row_text_color: {
        property:  "color",
        element: "matrix-tr-alt"
    },
    matrix_grid_lines: {
        property:  "width",
        element: "matrix-element"
    },
    matrix_header_background: {
        property:  "background",
        element: "matrix-element thead"
    },
    matrix_header_text: {
        property:  "color",
        element: "matrix-element thead"
    },
    matrix_row_color: {
        property:  "background",
        element: "matrix-tr"
    },
    matrix_row_header_color: {
        property:  "background",
        element: "matrix-tr .matrix-tr-header"
    },
    matrix_row_text_color: {
        property:  "color",
        element: "matrix-tr"
    },
    matrix_sub_header_background: {
        property:  "width",
        element: "matrix-element"
    },
}
const applyStyle = (element, value) => {
    const el = element_properties[element].element;
    const prop = element_properties[element].property;
    $(`.${el}`).css(prop, value);
}
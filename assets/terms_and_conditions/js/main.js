const baseUrl = window.location.origin;
let editor;
$(document).ready(() => {
  if ($('#documentContent').length) {
    editor = KothingEditor.create('documentContent', {
      height: '80vh',
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
})

const handleSave = (isUpdate = false, id = null) => {
  editor.save();
  const url = (isUpdate) ? `${baseUrl}/terms-and-conditions/update/${id}` : `${baseUrl}/terms-and-conditions/add`;
  const data = {
    'title'   : $('#documentTitle').val(),
    'content' : $('#documentContent').val(),
  };
  $.ajax({
    url,
    data,
    method: 'POST',
    success: (res) => {
      alert(res.message);
      window.location.href = '/terms-and-conditions';
    }
  })
}
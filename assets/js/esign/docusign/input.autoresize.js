//https://stackoverflow.com/a/34224563/8062659

$.fn.textWidth = function (_text, _font) {
  //get width of text with font.  usage: $("div").textWidth();
  var fakeEl = $("<span>")
      .hide()
      .appendTo(document.body)
      .text(_text || this.val() || this.text())
      .css({ font: _font || this.css("font"), whiteSpace: "pre" }),
    width = fakeEl.width();
  fakeEl.remove();
  return width;
};

$.fn.autoresize = function (options) {
  //resizes elements based on content size.  usage: $('input').autoresize({padding:10,minWidth:0,maxWidth:100});
  options = $.extend(
    { padding: 10, minWidth: 0, maxWidth: 10000 },
    options || {}
  );
  $(this)
    .on("input", function () {
      const width = Math.min(
        options.maxWidth,
        Math.max(options.minWidth, $(this).textWidth() + options.padding)
      );

      $(this).css("width", `${width / 12}em`); // 12 = inputs fontsize in esign signing page
    })
    .trigger("input");
  return this;
};

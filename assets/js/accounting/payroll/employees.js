$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

var element = document.querySelector('#privacy');
var switchery = new Switchery(element, {size: 'small'});
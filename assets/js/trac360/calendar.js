$(document).on("click", ".trac360-close-btn", function() {
    $('.trac360-calendar-modal').fadeOut();
});
$("#calendar-menu-btn").click(function(event) {
    event.preventDefault();
    $('.trac360-calendar-modal').fadeIn();
});

function join(t, a, s) {
    function format(m) {
        let f = new Intl.DateTimeFormat('en', m);
        return f.format(t);
    }
    return a.map(format).join(s);
}

$(document).ready(function() {
    $('a[href="#gwapa-ko"]').click(function() {
        alert('Sign new href executed.');
    });

    $(".fc-next-button").click(function(event) {
        var next_month = current_date.setMonth(current_date.getMonth() + 1, 1);
        current_date = new Date(next_month);
        let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(current_date);
        let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(current_date);
        let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(current_date);
        var date_viewed = `${ye}-${mo}-${da}`;
        // load_calendar();
    });
});
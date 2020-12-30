const origin = 'http://dev.nsmartrac.com/';
const stylesheets = [
    'assets/dashboard/css/bootstrap.min.css',
    'assets/dashboard/css/bootstrap.min.css',
    'assets/dashboard/css/style.css',
    'assets/css/jquery.signaturepad.css',
    'assets/fb/css/main.css',
    'assets/fb/css/view.css',
    'assets/fb/css/datepicker.css',
    'assets/fb/css/custom-themes/styles.css',
];
const scripts = [
    'assets/dashboard/js/jquery.min.js',
    'assets/signature_pad-master/js/signature_pad.js',
    'assets/fb/js/view.js',
    'assets/fb/js/datepicker.js',
    'assets/fb/js/main.js',
];
const loadForm = () => {
    console.log('loading form...')
    const form = document.getElementById('embedManager');
    const head = document.getElementsByTagName('head')[0];
    const body = document.getElementsByTagName('body')[0];
    stylesheets.forEach(stylesheet => {
        let link = document.createElement('link');
        link.rel = 'stylesheet';  
        link.type = 'text/css'; 
        link.href = origin + stylesheet;  
        head.appendChild(link);
    })
    scripts.forEach(script => {
        let js = document.createElement('script');
        js.type = 'text/javascript';
        js.src = origin + script;
        body.appendChild(js);
    });
    handleOnLoad(form.getAttribute('form_id'));
}
window.onload = loadForm;
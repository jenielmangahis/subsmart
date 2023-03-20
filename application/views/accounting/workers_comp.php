<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/workers_comp_modals'); ?>

<style>
.stepper-wrapper {
  font-family: Arial;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}

.stepper-item::before {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: -50%;
  z-index: 2;
}

.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ccc;
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.completed .step-counter {
  background-color: #4bb543;
}

.stepper-item.completed::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}

.center {
  padding: 70px 0;
  border: 3px solid green;
  text-align: center;
}

/* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
/* body {
    margin-top:30px;
} */
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

/* #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
} */

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button:hover {
  opacity: 0.8;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}

.switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #4bb543;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}

@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400);

.font-roboto {
  font-family: 'roboto condensed';
}

/* .modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  overflow: hidden;
}

.modal-dialog {
  position: fixed;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
} */

/* .modal-content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  border: 2px solid #3c7dcf;
  border-radius: 0;
  box-shadow: none;
} */

/* .modal-header {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  height: 50px;
  padding: 10px;
  background: #ffffff;
  border: 0;
} */

/* .modal-footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 60px;
  padding: 10px;
  background: #f1f3f5;
} */

/* .btn {
  height: 40px;
  border-radius: 0;

} */

.btn-modal {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -20px;
  margin-left: -100px;
  width: 200px;
}

.btn-primary,
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active {
  font-weight: 300;
  font-size: 1.6rem;
  color: #fff;
  color: lighten(#484b5b, 20%);
  color: #fff;
  text-align: center;
  background: #60cc69;
  border: 1px solid #36a940;
  border-bottom: 3px solid #36a940;
  box-shadow: 0 2px 4px rgba(0,0,0,0.15);

}

.btn-default,
.btn-default:hover,
.btn-default:focus,
.btn-default:active {
  font-weight: 300;
  font-size: 1.6rem;
  color: #fff;
  text-align: center;
  background: darken(#dcdfe4, 10%);
  border: 1px solid darken(#dcdfe4, 20%);
  border-bottom: 3px solid darken(#dcdfe4, 20%);

}

.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus,
.btn-secondary:active {
  color: #cc7272;
  background: transparent;
  border: 0;
}

::-webkit-scrollbar {
  -webkit-appearance: none;
  width: 10px;
  background: #f1f3f5;
  border-left: 1px solid darken(#f1f3f5, 10%);
}

::-webkit-scrollbar-thumb {
  background: darken(#f1f3f5, 20%);
}

/* .container {
  width: 25%;
} */

.step2 {
  
  padding: 10px;
  
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  
  background-color: cream;
}

.v-stepper {
  position: relative;
/*   visibility: visible; */
}


/* regular step */
.step2 .circle {
  background-color: white;
  border: 3px solid gray;
  border-radius: 100%;
  width: 20px;    /* +6 for border */
  height: 20px;
  display: inline-block;
}

.step2 .line {
    top: 20px;
  left: 8px;
/*   height: 120px; */
  height: 100%;
    
    position: absolute;
    border-left: 3px solid gray;
}

.step2.completed .circle {
  visibility: visible;
  background-color: #1b9404;
  border-color:#1b9404;
}

.step2.completed .line {
  border-left: 3px solid #1b9404;
}

.step2.active .circle {
visibility: visible;
  border-color:#1b9404;
}

.step2.empty .circle {
    visibility: hidden;
}

.step2.empty .line {
/*     visibility: hidden; */
/*   height: 150%; */
  top: 0;
  height: 150%;
}


.step2:last-child .line {
  border-left: 3px solid white;
  z-index: -1; /* behind the circle to completely hide */
}

/* .content {
  margin-left: 20px;
  display: inline-block;
} */


</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            It's the law in every state except Texas. Take care of your employees if they get hurt on the job and protect your business from lawsuits and penalties.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-12">
                            <h1>49 states require workers' comp insurance</h1>
                        </div>
                        <div class="col-12">
                            On-the-job injuries can happen. Take care of your employees if they get hurt and protect your business from lawsuits and penalties. <a href="#">Learn more</a>.
                        </div>
					</div>
                    <div class="row pt-3 align-items-center">
                        <div class="col-sm-3 col-xs-12">
                            <p class="mb-0 text-center"><img src="<?php echo base_url();?>assets/img/accounting/computer_2.png" class="img-responsive max-85" /></p>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <ul class="list-unstyled">
                                <li class="h5 font-weight-normal pt-2"><span class="bx bx-fw bx-check text-success pr-3"></span>Get a quick online quote from our partner, AP Intego</li>
                                <li class="h5 font-weight-normal pt-2"><span class="bx bx-fw bx-check text-success pr-3"></span>Automatically pay what you owe when you run payroll</li>
                                <li class="h5 font-weight-normal pt-2"><span class="bx bx-fw bx-check text-success pr-3"></span>Manage workers' comp and payroll right in nSmarTrac</li>
                            </ul>
                            <button class="nsm-button success" data-bs-toggle="modal" data-bs-target=".getQuote">
                                Get a quote
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>


<script>
// $(document).ready(function () {
	
	var select = document.getElementById('year'),
    year = new Date().getFullYear(),
    html = '<option></option>';

for(i = year; i >= year-18; i--) {
  html += '<option value="' + i + '">' + i + '</option>';
}

select.innerHTML = html;

// )};
</script>

<script>
$(document).ready(function () {

var navListItems = $('div.setup-panel div a'),
	allWells = $('.setup-content'),
	allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
	e.preventDefault();
	var $target = $($(this).attr('href')),
		$item = $(this);

	if (!$item.hasClass('disabled')) {
		navListItems.removeClass('btn-success').addClass('btn-default');
		$item.addClass('btn-success');
		allWells.hide();
		$target.show();
		$target.find('input:eq(0)').focus();
	}
});

allNextBtn.click(function () {
	var curStep = $(this).closest(".setup-content"),
		curStepBtn = curStep.attr("id"),
		nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
		curInputs = curStep.find("input[type='text'],input[type='url']"),
		isValid = true;

	$(".form-group").removeClass("has-error");
	for (var i = 0; i < curInputs.length; i++) {
		if (!curInputs[i].validity.valid) {
			isValid = false;
			$(curInputs[i]).closest(".form-group").addClass("has-error");
		}
	}

	if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-success').trigger('click');
});
</script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "block";
  }
  if (n == (x.length - 1)) {
    // document.getElementById("nextBtn").innerHTML = "Submit";
    $("#nextBtn").hide();
    $("#completeBtn").show();
  } else {
    // document.getElementById("nextBtn").innerHTML = "Next";
    $('#nextBtn').show();
    $('#completeBtn').hide();
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("stepper-item")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("stepper-item");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" completed", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " completed";
}
</script>

<script>
(function() {
  $(document).ready(function() {
    // $('.switch-input').on('change', function() {
    //   var isChecked = $(this).is(':checked');
    //   var selectedData;
    //   var $switchLabel = $('.switch-label');
    //   console.log('isChecked: ' + isChecked); 
      
    //   if(isChecked) {
    //     selectedData = $switchLabel.attr('data-on');
    //   } else {
    //     selectedData = $switchLabel.attr('data-off');
    //   }
      
    //   console.log('Selected data: ' + selectedData);
      
    // });
    
    // // Params ($selector, boolean)
    // function setSwitchState(el, flag) {
    //   el.attr('', flag);
    // }
    
    // // Usage
    // setSwitchState($('.switch-input'), true);    

    $("*[id^='switch-input']").each(function() {
      // alert('test');
            // $(this).upload()
            $(this).change(function(){ 
            var isChecked = $(this).is(':checked');
            var selectedData;
            var $switchLabel = $('.switch-label');
            // console.log('isChecked: ' + isChecked); 
            
            if(isChecked) {
              selectedData = 'yes';
            } else {
              selectedData = 'no';
            }
            
            $(this).val(selectedData);
            // alert(selectedData);
      
    });
    
    // Params ($selector, boolean)
    function setSwitchState(el, flag) {
      el.attr('', flag);
    }
    
    // Usage
    setSwitchState($('#switch-input'), true);
             
            });
        });
  // });
  
})();
</script>

<script>
$("#addEmployeeData").click(function () {
// alert('test');
  var fullName = $("#fullName").val();
  var mRole = $("#mRole").val();
  var classCode = $("#classCode").val();
  var annualPayroll = $("#annualPayroll").val();
  var mOwnership = $("#mOwnership").val();

              markup = "<tr id=\"ss\">" +
                "<td><span>"+fullName+"</span><input  value='"+fullName+"' type=\"hidden\" name=\"mfullName[]\"><input  value='"+annualPayroll+"' type=\"hidden\" name=\"annualPayroll[]\"></td>\n" +
                "<td><span>"+classCode+"</span><input  value='"+classCode+"' type=\"hidden\" name=\"classCode[]\"></td>\n" +
                "<td><span>"+mRole+"</span><input  value='"+mRole+"' type=\"hidden\" name=\"mRole[]\"></td>\n" +
                "<td><span>"+mOwnership+"</span><input  value='"+mOwnership+"' type=\"hidden\" name=\"mOwnership[]\"></td>\n" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove nsm-button error\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#employeesTable");
            tableBody.append(markup);

            $("#divpopemp").load(location.href + " #divpopemp");

});

</script>

<script>
// $(document).on('hidden.bs.modal', function (e) {
//         var target = $(e.target);
//         target.removeData('bs.modal')
//               .find(".modal-content").html('');
//     });
</script>

<script type="text/javascript">
var d = new Date();
var monthArray = new Array();
monthArray[0] = "January";
monthArray[1] = "February";
monthArray[2] = "March";
monthArray[3] = "April";
monthArray[4] = "May";
monthArray[5] = "June";
monthArray[6] = "July";
monthArray[7] = "August";
monthArray[8] = "September";
monthArray[9] = "October";
monthArray[10] = "November";
monthArray[11] = "December";
for(m = 0; m <= 11; m++) {
    var optn = document.createElement("OPTION");
    optn.text = monthArray[m];
    // server side month start from one
    optn.value = monthArray[m];
    // if june selected
    if ( m == 6 ) {
        optn.selected = true;
    }
    document.getElementById('renewaldateMonth').options.add(optn);
}
</script>

<script>
// var nowY = new Date().getFullYear(),
//     options = "";

// for(var Y=nowY; Y>=2021; Y++) {
//   options += "<option>"+ Y +"</option>";
// }

// $("#renewaldateyears").append( options );
$('#renewaldateyears').each(function() {

var year = (new Date()).getFullYear();
var current = year;
// year += 3;
for (var i = 0; i < 3; i++) {
  if ((year+i) == current)
    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
  else
    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
}

})
</script>

// import "https://formio.github.io/formio.js/#";


const formBaseUrl = "/nsmartrac/"; // loc al
// const formBaseUrl = `${window.location.origin}/` ; // online

// =====================================
//     GLOBAL VALUES AND FUNCTIONS
// =====================================

const elementsList = [
  {
    id: 1,
    type: "radio-button",
    category: 'common'
  },
  {
    id: 2,
    type: "dropdown",
    category: 'common'
  },
  {
    id: 3,
    type: "checkbox",
    category: 'common'
  },
  {
    id: 4,
    type: "email-address",
    category: 'common'
  },
  {
    id: 5,
    type: "long-answer",
    category: 'common'
  },
  {
    id: 6,
    type: "short-answer",
    category: 'common'
  },
  {
    id: 7,
    type: "calendar",
    category: 'common'
  },
  {
    id: 8,
    type: "number",
    category: 'common'
  },
  {
    id: 9,
    type: "file-upload",
    category: 'common'
  },
  {
    id: 10,
    type: "text-list",
    category: 'common'
  },
  {
    id: 11,
    type: "rating",
    category: 'common'
  },
  {
    id: 12,
    type: "ranking",
    category: 'common'
  },
  {
    id: 13,
    type: "hidden-field",
    category: 'common'
  },
  {
    id: 14,
    type: "signature",
    category: 'common'
  },
  {
    id: 15,
    type: "image-list",
    category: 'common'
  },
  {
    id: 16,
    type: "calculation",
    category: 'common'
  },
  {
    id: 17,
    type: "credit-card",
    category: 'common'
  },
  {
    id: 18,
    type: "contact-block",
    category: 'common'
  },
  {
    id: 19,
    type: "save-and-return",
    category: 'common'
  },
  {
    id: 20,
    type: "heading",
    category: 'format'
  },
  {
    id: 21,
    type: "formatted-text",
    category: 'format'
  },
  {
    id: 22,
    type: "image",
    category: 'format'
  },
  {
    id: 23,
    type: "link",
    category: 'format'
  },
  {
    id: 24,
    type: "custom-code",
    category: 'format'
  },
  {
    id: 25,
    type: "blank-space",
    category: 'format'
  },
  {
    id: 26,
    type: "page-break",
    category: 'format'
  },
  {
    id: 28,
    type: "radio-button-email-routing",
    category: 'email'
  },
  {
    id: 29,
    type: "dropdown-email-routing",
    category: 'email'
  },
  {
    id: 30,
    type: "checkbox-email-routing",
    category: 'email'
  },
]





// =====================================
//            VIEW PAGE
// =====================================


// this function runs upon page load
loadFormSettings = id => {
  $.ajax({
    url: `${formBaseUrl}formbuilder/form/view/${id}`,
    dataType: 'json',
    type: 'GET',
    success: function(res){
      document.querySelector('#txtFormName').value = res.data.forms_title
      document.querySelector('#txtPrivateNotes').value = res.data.forms_private_note
      document.querySelector('#txtSocialDescription').value = res.data.forms_social_desc
      document.querySelector('#txtFormToggleStart').checked = (res.data.forms_use_start_date == 1)? true : false
      document.querySelector('#txtFormToggleEnd').checked = (res.data.forms_use_closing_date == 1)? true : false
      document.querySelector('#txtFormToggleResult').checked = (res.data.forms_use_results_limit == 1)? true : false
      document.querySelector('#txtStartDate').value = res.data.forms_start_date
      document.querySelector('#txtStartTime').value = res.data.forms_start_time
      document.querySelector('#txtStartMessageTitle').value = res.data.forms_start_title
      document.querySelector('#txtStartMessageContent').value = res.data.forms_start_message
      document.querySelector('#txtEndDate').value = res.data.forms_end_date
      document.querySelector('#txtEndTime').value = res.data.forms_end_time
      document.querySelector('#txtEndMessageTitle').value = res.data.forms_end_title
      document.querySelector('#txtEndMessageContent').value = res.data.forms_end_message
      document.querySelector('#txtResultsLimit').value = res.data.forms_results_limit
      document.querySelector('#txtResultsMessageTitle').value = res.data.forms_results_max_title
      document.querySelector('#txtResultsMessageContent').value = res.data.forms_results_max_message
      document.querySelector('#txtResultsMessageContent').value = res.data.forms_results_max_message
      
      document.querySelector('#txtRedirectLink').value = res.data.forms_redirect_link
      document.querySelector('#txtSuccessTitle').value = res.data.forms_success_title
      document.querySelector('#txtSuccessMessage').value = res.data.forms_success_message
      document.querySelector('#chkSubmitAnotherResponse').checked = (res.data.forms_show_repeat_form_check == 1)? true : false
      
      
      return;
    }
  })
}


loadFormElements = (id, mode = null) => {
  document.querySelector("#windowPreviewContent").innerHTML = "";
  $.ajax({
    url: `${formBaseUrl}formbuilder/form/element/get/${id}`,
    dataType: 'json',
    type: 'GET',
    success: function(res){
      res.data.forEach(el => {
        let elementType = el.fe_element_id;
        var choices = []
        
        if(elementType == 1 || elementType == 2 || elementType == 3 ){
          choices = JSON.parse($.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/${el.fe_id}`,
            dataType: 'json',
            type: 'GET',
            async: false
          }).responseText).data
        }

        if(elementType == 20){
          document.querySelector('#windowPreviewContent').innerHTML += `
          ${(elementType == 20)?`
            <div id="form-element-${el.fe_id}" class="bg-primary text-white col-xs-12 col-sm-12 px-2" ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
              <h1>${el.fe_label}</h1>
            </div>
            `:""}
          `
        }else{
          document.querySelector('#windowPreviewContent').innerHTML += `
            <div id="form-element-${el.fe_id}" class="col-xs-12 ${(el.fe_span == 1)?"col-sm-3":""} ${(el.fe_span == 2)?"col-sm-6":""} ${(el.fe_span == 3)?"col-sm-8":""} ${(el.fe_span == 4)?"col-sm-12":""} px-2" ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              ${(mode == "edit")?
                `
                  <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                    <div class="btn-group" style="margin-y: auto">
                      <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                  </div>
                `
              :""}
  
              ${(elementType == 1)?`
                <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                ${choices.map((choice,i) => `
                  <div class="form-check form-user-elements">
                    <input type="radio" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}-${i}" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="choice.fc_choice">
                    <label for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                  </div>
                `).join("")}
                
              `:""}
  
              ${(elementType == 2)?`
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}">${el.fe_label}</label>
                  <select id="feinput-${el.fe_id}" name="feinput-${el.fe_id}" class="custom-select">
                    ${choices.map(choice => `
                      <option>${choice.fc_choice}</option>
                    `).join("")}
                  </select>
                </div>
              `:""}
              
              
              ${(elementType == 5 || elementType == 10)?`
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <textarea name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}"></textarea>
                </div>
              `:""}
  
              
              ${(elementType == 6 || elementType == 4)?`
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="text" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}">
                </div>
              `:""}
              
              ${(elementType == 3)?`
                <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                ${choices.map(choice => `
                  <div class="form-check form-user-elements">
                    <input type="checkbox" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}-${i}" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="${choice.fc_choice}">
                    <label for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                  </div>
                  `).join("")}
              `:""}
              
              ${(elementType == 7)?`
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="date" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}"/>
                </div>
              `:""}
              
              ${(elementType == 8)?`
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="number" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}">
                </div>
              `:""} 
  
              ${(elementType == 9)?`
                <!-- fix this part -->
                <div class="form-group form-user-elements">
                  <label for="${el.fe_id}">${el.fe_label}</label>
                  <input type="file" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" >
                </div>
              `:""}
  
              
            </div>
          `;
          
        }
      });
      return;
    }
  })
}

// =====================================
//            EDIT PAGE
// =====================================

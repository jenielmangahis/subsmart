// import "https://formio.github.io/formio.js/#";


// const formBaseUrl = "http://localhost/nsmartrac/"; // local
const formBaseUrl = `${window.location.origin}/` ; // online

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
    type: "order-form-table-list",
    category: 'order-form'
  },
  {
    id: 31,
    type: "order-form-table-list",
    category: 'order-form-table'
  },
  {
    id: 32,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 33,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 34,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 35,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 36,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 37,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 38,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 39,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 40,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 41,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 42,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 43,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 44,
    type: "checkbox-email-routing",
    category: 'email'
  },
  {
    id: 45,
    type: "radio-button-matrix",
    category: 'matrix-items'
  },
  {
    id: 46,
    type: "radio-button-multi-scale",
    category: 'matrix-items'
  },
  {
    id: 47,
    type: "dropdown-matrix",
    category: 'matrix-items'
  },
  {
    id: 48,
    type: "dropdown-multi-scale",
    category: 'matrix-items'
  },
  {
    id: 49,
    type: "checkbox-matrix",
    category: 'matrix-items'
  },
  {
    id: 50,
    type: "checkbox-multi-scale",
    category: 'matrix-items'
  },
  {
    id: 51,
    type: "short-answer-matrix",
    category: 'matrix-items'
  },
  {
    id: 52,
    type: "long-answer-matrix",
    category: 'matrix-items'
  },
  {
    id: 53,
    type: "star-matrix",
    category: 'matrix-items'
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
        
        if(elementType == 1 || elementType == 2 || elementType == 3 || elementType >= 44 ){
          choices = JSON.parse($.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/${el.fe_id}`,
            dataType: 'json',
            type: 'GET',
            async: false
          }).responseText).data
        }

        if(elementType >= 20 && elementType < 30){
          document.querySelector('#windowPreviewContent').innerHTML += `
          ${(elementType == 20)?`
            <!-- Header -->
            <div id="form-element-${el.fe_id}" class="bg-primary text-white col-xs-12 col-sm-12 px-2" ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
              <h1 class="form-user-elements">${el.fe_label}</h1>
            </div>
          `:""}

          ${(elementType == 21)?`
            <!-- Formatted Text -->
            <div id="form-element-${el.fe_id}" class="col-xs-12 ${(el.fe_span == 1)?"col-sm-3":""} ${(el.fe_span == 2)?"col-sm-6":""} ${(el.fe_span == 3)?"col-sm-8":""} ${(el.fe_span == 4)?"col-sm-12":""} px-2 " ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
              <p class="form-user-elements">${el.fe_label}</p>
            </div>
          `:""}

          ${(elementType == 22)?`
            <!-- Image -->
            <div id="form-element-${el.fe_id}" class="col-xs-12 ${(el.fe_span == 1)?"col-sm-3":""} ${(el.fe_span == 2)?"col-sm-6":""} ${(el.fe_span == 3)?"col-sm-8":""} ${(el.fe_span == 4)?"col-sm-12":""} px-2 " ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
                <img src="https://via.placeholder.com/150" alt="image" class="form-user-elements" style="width: 100%; height; 300px;">
            </div>
          `:""}

          ${(elementType == 23)?`
            <!-- Link -->
            <div id="form-element-${el.fe_id}" class="col-xs-12 ${(el.fe_span == 1)?"col-sm-3":""} ${(el.fe_span == 2)?"col-sm-6":""} ${(el.fe_span == 3)?"col-sm-8":""} ${(el.fe_span == 4)?"col-sm-12":""} px-2 " ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
              <a href="${el.fe_default_value}" class="form-user-elements">${el.fe_label}</a>
            </div>
          `:""}

          ${(elementType == 25)?`
            <!-- Blank space -->
            <div id="form-element-${el.fe_id}" class="col-xs-12 col-sm-12 form-user-elements" ${(mode == "edit")?`onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`:""}>
              <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                <div class="btn-group" style="margin-y: auto">
                  <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                  <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </div>
              <span class="form-user-elements"></span>
              ${(mode == "edit")?"/ Blank space /":""}
              <br/>
              <br/>
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
                <!-- Radio -->
                <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                ${choices.map((choice,i) => `
                  <div class="form-check form-user-elements">
                    <input type="radio" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}-${i}" class="form-check-input" ${(el.fe_is_required == 1)?"required":""}  placeholder="${el.fe_placeholder_text}" value="choice.fc_choice">
                    <label for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                  </div>
                `).join("")}
                
              `:""}
  
              ${(elementType == 2)?`
                <!-- dropdown -->
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}">${el.fe_label}</label>
                  <select id="feinput-${el.fe_id}" name="feinput-${el.fe_id}" class="custom-select" ${(el.fe_is_required == 1)?"required":""} >
                    ${choices.map(choice => `
                      <option>${choice.fc_choice}</option>
                    `).join("")}
                  </select>
                </div>
              `:""}
              
              ${(elementType == 3)?`
                <!-- Checkbox -->
                <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                ${choices.map((choice, i) => `
                  <div class="form-check form-user-elements">
                    <input type="checkbox" name="feinput-${el.fe_id}-chk-${i}" id="feinput-${el.fe_id}-chk" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="${choice.fc_choice}">
                    <label for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                  </div>
                `).join("")}
              `:""}
              
              
              ${(elementType == 6 || elementType == 4)?`
                <!-- Short answer / Email -->
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="text" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" ${(el.fe_is_required == 1)?"required":""}  placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}">
                </div>
              `:""}

              ${(elementType == 5 || elementType == 10)?`
                <!-- Long answer / Email List -->
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <textarea name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" ${(el.fe_is_required == 1)?"required":""}  placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}"></textarea>
                </div>
              `:""}
  
              ${(elementType == 7)?`
                <!-- Date -->
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}-date"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="date" name="feinput-${el.fe_id}-date" id="feinput-${el.fe_id}-date" class="form-control" ${(el.fe_is_required == 1)?"required":""}  placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}"/>
                </div>
              `:""}
              
              ${(elementType == 8)?`
                <!-- Number -->
                <div class="form-group form-user-elements">
                  <label for="feinput-${el.fe_id}"> ${(el.fe_is_required == 1)? `<span class="text-danger"><strong>*</strong></span>` :""} ${el.fe_label}</label>
                  <input type="number" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-control" ${(el.fe_is_required == 1)?"required":""}  placeholder="${el.fe_placeholder_text}" value="${el.fe_default_value}">
                </div>
              `:""} 
  
              ${(elementType == 9)?`
                <!-- fix this part -->
                <!-- File Upload-->
                <div class="form-group form-user-elements">
                  <label for="${el.fe_id}">${el.fe_label}</label>
                  <input type="file" name="feinput-${el.fe_id}" ${(el.fe_is_required == 1)?"required":""}  id="feinput-${el.fe_id}" >
                </div>
              `:""}
              

              ${(elementType == 44)?`
                <!-- Radio Button Matrix -->
                <table class="table table-hover form-user-elements">
                  <thead>
                    <tr>
                      <th>${el.fe_label}</th>
                      ${choices.map((choice, i) => `
                        ${choice.fc_row == null? `<th>${choice.fc_choice}</th>`:""}
                      `).join('')}
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ${choices.map((choice, rowIndex) => 
                        `<tr>
                          ${(choice.fc_column == null)?`
                            <td>${choice.fc_choice}</td>
                            ${choices.map((cell, columnIndex) => 
                              `
                                ${cell.fc_row == null?`
                                <td>
                                <div class="form-check">
                                  ${columnIndex}
                                  <input class="form-check-input" type="radio" name="feinput-${el.fe_id}-radmtx-${rowIndex}" id="feinput-${el.fe_id}-radmtx-${rowIndex}-${columnIndex}" value="${choice.fc_choice}">
                                </div>
                              </td>
                                `:``}
                              `
                            ).join('')}
                          `:""}
                        </tr>`
                      ).join('')}
                    </tr>
                  </tbody>
                </table>
              `:""}

              ${(elementType == 30)?`
              <!-- product table list-->
                ${
                  (mode == "edit")?"":`
                    ${setTimeout(() => {
                      getProductSelection(el.fe_id)
                    }, 500)}
                  `
                }
                <div class="container-fluid form-user-elements">
                  <p>${el.fe_label}</p>
                  <table class="table" id="table-${el.fe_id}">
                    <thead>
                        <tr>
                            <th class="text-left">Product</th>
                            <th class="text-left">Quantity</th>
                            <th class="text-left">Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="table-product-list-${el.fe_id}"></tbody>
                  </table>
                  <div class="d-flex w-100 justify-content-between">
                    <div class="form-group">
                      <select name="selProduct-${el.fe_id}" id="selProduct-${el.fe_id}" class="product-dropdowns custom-select-sm">
                        
                      </select>
                    </div>
                    <button type="button" onclick="addProductToTable(${el.fe_id})" id="btnAddProduct" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Product</button>
                  </div>
                  <hr/>
                  <div class="text-right">
                    <span id="table-product-tax-addition-${el.fe_id}" class="text-left">Tax: <strong>25%</strong> (+ $0.00)</span><br/>
                    <span id="table-product-total-price-all-${el.fe_id}" class="text-left">Total: <strong>$0.0</strong></span>
                  </div>
                </div>
                
              `:""}

              ${(elementType == 48)?`
                <!-- Checkbox Matrix -->
                <table class="table table-hover form-user-elements">
                  <thead>
                    <tr>
                      <th>${el.fe_label}</th>
                      ${choices.map((choice, i) => 
                        choice.fc_row == null? `<th>${choice.fc_choice}</th>`:""
                      ).join('')}
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ${choices.map((choice, rowIndex) => 
                        `<tr>
                          ${(choice.fc_column == null)?`
                            <td>${choice.fc_choice}</td>
                            ${choices.map((cell, columnIndex) => 
                              `
                                ${cell.fc_row == null?`
                                <td>
                                <div class="form-check">
                                  <input class="form-check-input custom-input" type="checkbox" name="feinput-${el.fe_id}-chkmtx-${rowIndex}-${columnIndex}" id="feinput-${el.fe_id}-chkmtx-${rowIndex}-${columnIndex}">
                                </div>
                              </td>
                                `:``}
                              `
                            ).join('')}
                          `:""}
                        </tr>`
                      ).join('')}
                    </tr>
                  </tbody>
                  
                </table>
                
              `:""}
              ${(elementType == 50)?`
                <!-- Short Answer Matrix -->
                <table class="table table-hover form-user-elements">
                  <thead>
                    <tr>
                      <th>${el.fe_label}</th>
                      ${choices.map((choice, i) => 
                        choice.fc_row == null? `<th>${choice.fc_choice}</th>`:""
                      ).join('')}
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ${choices.map((choice, rowIndex) => 
                        `<tr>
                          ${(choice.fc_column == null)?`
                            <td>${choice.fc_choice}</td>
                            ${choices.map((cell, columnIndex) => 
                              `
                                ${cell.fc_row == null?`
                                  <td>
                                    <div class="form-group">
                                      <input class="form-control" type="text" name="feinput-${el.fe_id}-txtmtx-${rowIndex}-${columnIndex}" id="feinput-${el.fe_id}-txtmtx-${rowIndex}-${columnIndex}">
                                    </div>
                                  </td>
                                `:``}
                              `
                            ).join('')}
                          `:""}
                        </tr>`
                      ).join('')}
                    </tr>
                  </tbody>
                </table>
                
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

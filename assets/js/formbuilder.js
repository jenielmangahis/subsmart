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

loadFormElements = (id, mode = null) => {
  document.querySelector("#windowPreviewContent").innerHTML = "";
  $.ajax({
    url: `${formBaseUrl}formbuilder/form/element/get/${id}`,
    dataType: 'json',
    type: 'GET',
    success: function(res){
      res.data.forEach(el => {
        let elementType = el.fe_element_id;
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
              <div class="form-check form-user-elements">
                <input type="radio" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="test">
                <label for="feinput-${el.fe_id}">${el.fe_label}</label>
              </div>
            `:""}

            ${(elementType == 2)?`
              <div class="form-group form-user-elements">
                <label for="feinput-${el.fe_id}">${el.fe_label}</label>
                <select id="feinput-${el.fe_id}" name="feinput-${el.fe_id}" class="custom-select">
                  <option>test</option>
                  <option>test</option>
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
              <div class="form-check form-user-elements">
                <input type="checkbox" name="feinput-${el.fe_id}" id="feinput-${el.fe_id}" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="test">
                <label for="feinput-${el.fe_id}">${el.fe_label}</label>
              </div>
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
      });
      return;
    }
  })
}

// =====================================
//            EDIT PAGE
// =====================================

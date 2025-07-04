if (!window.screen.orientation) {
  console.info("using screen.orientation polyfill");
  window.screen.orientation = o9n.orientation;
}
if (isMobile()) {
  window.__ismobile = true;
  console.info("mobile device detected");
}
function Signing(hash) {
  
  const PDFJS = pdfjsLib;

  const $documentContainer = $(".signing__documentContainer");

  const $signatureModal = $("#signatureModal");
  const $importSignatureModal = $("#importSignatureModal");

  const $signaturePad = $(".signing__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");
  const $signatureImportButton = $("#signatureImportButton");

  const $fontSelect = $("#fontSelect");
  const $signatureTextInput = $(".signing__signatureInput");

  const $finishSigning = $("[data-action=finish]");

  const prefixURL = "";

  let data = null;
  let signaturePad = null;

  const $statusIndicator = document.getElementById("statusindicator");

  async function fetchData() {
    const endpoint = `${prefixURL}/DocuSign/apiSigning?hash=${hash}`;
    const response = await fetch(endpoint);
    data = await response.json();
    window.__esigndata = data;

    if (data.generated_pdf) {
      let downloadEsignQueryString = new URLSearchParams({
        document_type: "esign",
        generated_esign_id: data.generated_pdf.docfile_id,
        //generated_esign_id: 1643, //For debugging
      }).toString();
  
      generateFileVault(downloadEsignQueryString);   
    }

    if( window.__esigndata.is_finished == 1 ){
      $('.btn-finish-text').text('Finish');
    }

    const jid = window.__esigndata.job_id;
    const endpointA = `${prefixURL}/DocuSign/getUserdate?jid=${jid}`;
    const responseA = await fetch(endpointA);
    companyDataTime = await responseA.json();   
    window._companyDateTime = moment(companyDataTime.current_date_time).format("MMMM Do YYYY, h:mm:ss A");
  }

  async function renderPage({ canvas, page, document }) {
    const documentPage = await document.getPage(page);
    const viewport = await documentPage.getViewport({ scale: 1.5 });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    await documentPage.render({
      viewport,
      canvasContext: canvas.getContext("2d"),
    });

    return canvas;
  }

  async function getPage({ page, ...rest }) {
    const html = `
      <div class="signing__documentPage" data-page="${page}">
        <canvas></canvas>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  function getRenderField({ field, recipient }) {
    //console.log(field);
    const { field_name, coordinates, id: fieldId, value: fieldValue, specs, widget_type, widget_autopopulate_field_name } = field;

    const { first_name, last_name, mail_add, city, state, zip_code, phone_h, phone_m, email, country, county_name, date_of_birth, ssn
     } = window.__esigndata.auto_populate_data.client;

    const { emergency_primary_contact_fname, emergency_primary_contact_lname, emergency_primary_contact_phone } = window.__esigndata.auto_populate_data.primary_emergency_contacts;

    const { service_location, acs_city, acs_state, acs_zip } = window.__esigndata.auto_populate_data.service_ticket;

    const { emergency_secondary_contact_fname, emergency_secondary_contact_lname, emergency_secondary_contact_phone } = window.__esigndata.auto_populate_data.secondary_emergency_contacts;

    const { emergency_third_contact_fname, emergency_third_contact_lname, emergency_third_contact_phone } = window.__esigndata.auto_populate_data.third_emergency_contacts;

    const { access_password } = window.__esigndata.auto_populate_data.acs_access;

    const { kw_dc, solar_system_size } = window.__esigndata.auto_populate_data.acs_info_solar;

    const { docusign_envelope_id } = window.__esigndata.auto_populate_data.user_customer_docfile;

    const { alarm_cs_account, monthly_monitoring, otps, passcode, panel_type } = window.__esigndata.auto_populate_data.acs_alarm;    

    const { jp_amount, jp_program_setup, jp_monthly_monitoring, jp_tax, jp_intallation_cost, jp_equipment_cost, jp_tax_equipment_cost } = window.__esigndata.auto_populate_data.job_payments;   

    const { bill_method, check_num, bank_name, routing_num, card_fname, card_lname, acct_num, equipment, credit_card_exp, credit_card_exp_mm_yyyy, credit_card_num } = window.__esigndata.auto_populate_data.billing;

    const {  total_due, equipment_cost, first_month_monitoring, one_time_activation } = window.__esigndata.auto_populate_data.cost_due;

    const {  inv_monthly_monitoring, inv_program_setup, inv_installation_cost, inv_taxes, inv_subtotal, inv_equipment_cost, inv_grand_total } = window.__esigndata.auto_populate_data.invoices;

    const {  business_name, business_address, business_city, business_potal_code, business_state } = window.__esigndata.auto_populate_data.business_profile;

    const {  job_account_number, job_number, job_name, job_type } = window.__esigndata.auto_populate_data.jobs;

    const {  second_recipient_name, second_recipient_email } = window.__esigndata.auto_populate_data.second_recipient;

    const { job_service_ticket_number, job_service_mail_add, job_service_city, job_service_state, job_service_zip } = window.__esigndata.auto_populate_data.job_service;

    
    let text = recipient[field_name.toLowerCase()];
    let { pageTop: top, left } = JSON.parse(coordinates);
    top = parseInt(top);
    left = parseInt(left);

    const container = document.querySelector(".signing__documentContainer");    
    const a_field_name = field_name;
    
    if( field_name === 'Service Ticket Number' ) {
      return job_service_ticket_number;
    }

    if( field_name === "Job Address" ) {
      return job_service_mail_add;
    }

    if( field_name === "Job City" ) {
      return job_service_city;
    }

    if( field_name === "Job State" ) {
      return job_service_state;
    }

    if( field_name === "Job Zip" ) {
      return job_service_zip;
    }
    
    if ( field_name === "Total Due" ) {
      return total_due;
    }

    if( field_name == "City" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return city;
        }else{
          return fieldValue['value'];
        }
      }else{
        return city;
      }          
    }

    if( field_name == "Panel Type" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return panel_type;
        }else{
          return fieldValue['value'];
        }
      }else{
        return panel_type;
      }          
    }

    if( field_name == "Job Account Number" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return job_account_number;
        }else{
          return fieldValue['value'];
        }
      }else{
        return job_account_number;
      }          
    }

    if( field_name == "Job Number" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return job_number;
        }else{
          return fieldValue['value'];
        }
      }else{
        return job_number;
      }          
    }

    if( field_name == "Job Type" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return job_type;
        }else{
          return fieldValue['value'];
        }
      }else{
        return job_type;
      }          
    }

    if( field_name == "Job Name" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return job_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return job_name;
      }          
    }

    if( field_name == "State" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( acs_state === '' || typeof acs_state === 'undefined' ){      
            return state;
          }else{
            return acs_state;  
          }
          
        }else{
          return fieldValue['value'];
        }
      }else{
        if( acs_state === '' || typeof acs_state === 'undefined' ){    
          return state;  
        }else{
          return acs_state;  
        }        
      }  
    }

    if( field_name == "County" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return county_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return county_name;
      }     
    }

    if( field_name == "Name Second Signatory" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return second_recipient_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return second_recipient_name;
      }     
    }

    if( field_name == "ZIP" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( acs_zip === '' || typeof acs_zip === 'undefined' ){
            return zip_code;
          }else{
            return acs_zip;      
          }
        }else{
          return fieldValue['value'];
        }
      }else{
        if( acs_zip === '' || typeof acs_zip === 'undefined' ){
          return zip_code;
        }else{
          return acs_zip;   
        }
      }      
    }

    if( field_name == "Address" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( service_location === '' || typeof service_location === 'undefined' ){ 
            return mail_add;
          }else{
            return service_location;  
          }          
        }else{
          return fieldValue['value'];
        }
      }else{
        if( service_location === '' || typeof service_location === 'undefined' ){ 
          return mail_add;
        }else{
          return service_location;  
        }
      }
    }

    if( field_name == "Date of Birth" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return date_of_birth;
        }else{
          return fieldValue['value'];
        }
      }else{
        return date_of_birth;
      }
    }

    if( field_name == "Social Security Number" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return ssn;
        }else{
          return fieldValue['value'];
        }
      }else{
        return ssn;
      }
    }

    if( field_name == "Subscriber Name" || field_name == "Customer Name" ) {   
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return first_name + " " + last_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return first_name + " " + last_name;
      }
    }

    if( field_name == "Subscriber Email" || field_name == "Customer Email" ) {
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return email;
        }else{
          return fieldValue['value'];
        }
      }else{
        return email;
      }
    }

    if( field_name == "Primary Contact Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_primary_contact_fname + " " + emergency_primary_contact_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_primary_contact_fname + " " + emergency_primary_contact_lname;
      }
    }

    if( field_name == "Primary Contact First Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_primary_contact_fname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_primary_contact_fname;
      }
    }

    if( field_name == "Primary Contact Last Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_primary_contact_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_primary_contact_lname;
      }
    }

    if( field_name == "Primary Contact Number" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_primary_contact_phone;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_primary_contact_phone;
      }
    }


    if( field_name == "Secondary Contact Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_secondary_contact_fname + " " + emergency_secondary_contact_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_secondary_contact_fname + " " + emergency_secondary_contact_lname;
      }      
    }

    if( field_name == "Secondary Contact First Name" ){
      return emergency_secondary_contact_fname;
    }

    if( field_name == "Secondary Contact Last Name" ){
      return emergency_secondary_contact_lname;
    }

    if( field_name == "Secondary Contact Number" ){
      return emergency_secondary_contact_phone;
    }

    if( field_name == "Third Contact Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_third_contact_fname + " " + emergency_third_contact_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_third_contact_fname + " " + emergency_third_contact_lname;
      }
    }
    
    if( field_name == "Third Contact First Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_third_contact_fname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_third_contact_fname;
      }
    }
    
    if( field_name == "Third Contact Last Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_third_contact_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_third_contact_lname;
      }
    }
    
    if( field_name == "Third Contact Number" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return emergency_third_contact_phone;
        }else{
          return fieldValue['value'];
        }
      }else{
        return emergency_third_contact_phone;
      }
    }


    if( field_name == "Primary Contact" || field_name == "Customer Mobile" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return phone_m;
        }else{
          return fieldValue['value'];
        }
      }else{
        return phone_m;
      }
    }

    if( field_name == "Secondary Contact" || field_name == "Customer Phone" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return phone_h;
        }else{
          return fieldValue['value'];
        }
      }else{
        return phone_h;
      }
    }

    if( field_name == "Access Password" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return access_password;
        }else{
          return fieldValue['value'];
        }
      }else{
        return access_password;
      }
    }

    if( field_name == "Company" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return business_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return business_name;
      }
    }

    if( field_name == "Equipment" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return equipment;
        }else{
          return fieldValue['value'];
        }
      }else{
        return equipment;
      }
    }

    if( field_name == "Esign Envelope ID" ){      
      return "Esign Envelope ID : " + docusign_envelope_id;
    }

    if( field_name == "Card Holder Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return card_fname + " " + card_lname;
        }else{
          return fieldValue['value'];
        }
      }else{
        return card_fname + " " + card_lname;
      }
    }

    if( field_name == "Card Number" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return credit_card_num;
        }else{
          return fieldValue['value'];
        }
      }else{
        return credit_card_num;
      }
    }

    if( field_name == "Checking Account Number" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return check_num;
        }else{
          return fieldValue['value'];
        }
      }else{
        return check_num;
      }
    }

    if( field_name == "Bank Name" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return bank_name;
        }else{
          return fieldValue['value'];
        }
      }else{
        return bank_name;
      }
    }

    if( field_name == "Card Expiration" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return credit_card_exp;
        }else{
          return fieldValue['value'];
        }
      }else{
        return credit_card_exp;
      }
    }

    if( field_name == "ABA" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return routing_num;
        }else{
          return fieldValue['value'];
        }
      }else{
        return routing_num;
      }
    }

    if( field_name == "CS Account Number" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return alarm_cs_account;
        }else{
          return fieldValue['value'];
        }
      }else{
        return alarm_cs_account;
      }
    }

    if( field_name == "Abort Code" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return passcode;
          //return '';
        }else{
          return fieldValue['value'];
        }
      }else{
        return passcode;
      }
      //return '';
    }

    if( field_name == 'Account Number' ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return acct_num;
        }else{
          return fieldValue['value'];
        }
      }else{
        return acct_num;
      }
    }

    if( field_name == "Equipment Cost" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( inv_equipment_cost > 0 ){
            return inv_equipment_cost;
          }else{
            if( jp_equipment_cost > 0 ){
              return jp_equipment_cost;
            }else{
              return 0;
            }
          }          
        }else{
          return fieldValue['value'];
        }
      }else{
        if( inv_equipment_cost > 0 ){
          return inv_equipment_cost;
        }else{
          if( jp_equipment_cost > 0 ){
            return jp_equipment_cost;
          }else{
            return 0;
          }
        }
      }
    }

    if( field_name === "one_time_activation" ) {
      if( inv_program_setup > 0 ){
        return inv_program_setup;
      }else{
        if( jp_program_setup > 0 ){
          return jp_program_setup;
        }else{
          return '0.00';
        }
      }   
    }

    if( field_name == "One Time Activation (OTP)" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          return inv_program_setup > 0 ? inv_program_setup : 0;
        }else{
          return fieldValue['value'];
        }
      }else{
        return inv_program_setup > 0 ? inv_program_setup : 0;
      }
    }

    if( field_name == "Monthly Monitoring Rate" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( inv_monthly_monitoring > 0 ){
            return inv_monthly_monitoring;
          }else{
            if( jp_monthly_monitoring > 0 ){
              return jp_monthly_monitoring;
            }else{
              return 0;
            }
          }
        }else{
          return fieldValue['value'];
        }
      }else{
        if( inv_monthly_monitoring > 0 ){
          return inv_monthly_monitoring;
        }else{
          if( jp_monthly_monitoring > 0 ){
            return jp_monthly_monitoring;
          }else{
            return 0;
          }
        }
      }  
    }

    if( field_name == "Installation Cost" ){
      if( fieldValue ){
        if( fieldValue['value'] === '' || typeof fieldValue['value'] === 'undefined' ){
          if( inv_installation_cost > 0 ){
            return inv_installation_cost;
          }else{
            if( jp_intallation_cost > 0 ){
              return jp_intallation_cost;
            }else{
              return 0;
            }
          }          
        }else{
          return fieldValue['value'];
        }
      }else{
        if( inv_installation_cost > 0 ){
          return inv_installation_cost;
        }else{
          if( jp_intallation_cost > 0 ){
            return jp_intallation_cost;
          }else{
            return 0;
          }
        }
      }      
      
    }

    if( field_name == "kW DC" ){
      return kw_dc;
    }

    if( field_name == "System Size" ){
      return solar_system_size;
    }

    //Dynamic widget start
    if( field_name == 'AutoPopulateText' ){

      //Customer
      if( widget_autopopulate_field_name == 'Customer Name' ){
        if( fieldValue ){
          if( fieldValue['value'] == '' ){
            return first_name + " " + last_name;
          }else{
            return fieldValue['value'];
          }  
        }else{
          return first_name + " " + last_name;
        }     
      }

      if( widget_autopopulate_field_name == 'Customer Firstname' ){
        if( fieldValue ){
          if( fieldValue['value'] == '' ){
            return first_name;
          }else{
            return fieldValue['value'];
          }  
        }else{
          return first_name;
        }      
      }

      if( widget_autopopulate_field_name == 'Customer Lastname' ){
        if( fieldValue ){
          if( fieldValue['value'] == '' ){
            return last_name;
          }else{
            return fieldValue['value'];
          }  
        }else{
          return last_name;
        }          
      }

      if( widget_autopopulate_field_name == 'Customer Email' ){
        return email;
      }

      if( widget_autopopulate_field_name == 'Customer Mobile' ){
        return phone_m;
      }

      if( widget_autopopulate_field_name == 'Customer Phone' ){
        return phone_h;
      }

      if( widget_autopopulate_field_name == 'Customer Address' ){
        return mail_add;
      }

      if( widget_autopopulate_field_name == 'Customer City' ){
        return city;
      }

      if( widget_autopopulate_field_name == 'Customer State' ){
        return state;
      }

      if( widget_autopopulate_field_name == 'Customer Zip' ){
        return zip_code;
      }

      if( widget_autopopulate_field_name == 'Customer SSS' ){
        return ssn;
      }

      if( widget_autopopulate_field_name == 'Customer Date of Birth' ){
        return date_of_birth;
      }

      if( widget_autopopulate_field_name == 'Customer Password' ){
        return access_password;
      }

      if( widget_autopopulate_field_name == 'Customer Abort Code' ){
        return passcode;
      }

      if( widget_autopopulate_field_name == 'Customer Panel Type' ){
        return panel_type;
      }

      //Company
      if( widget_autopopulate_field_name == 'Company Name' ){
        return business_name;
      }

      if( widget_autopopulate_field_name == 'Company Address' ){
        return business_address;
      }

      if( widget_autopopulate_field_name == 'Company City' ){
        return business_city;
      }

      if( widget_autopopulate_field_name == 'Company State' ){
        return business_state;
      }

      if( widget_autopopulate_field_name == 'Company Zip' ){
        return business_potal_code;
      }

      //Invoice
      if( widget_autopopulate_field_name == 'Invoice Equipment Cost' ){
        if( inv_equipment_cost > 0 ){
          return inv_equipment_cost;
        }else{
          if( jp_equipment_cost > 0 ){
            return jp_equipment_cost;
          }else{
            return '0.00';
          }
        }  
      }

      if( widget_autopopulate_field_name == 'Invoice Monthly Monitoring Rate' ){
        if( inv_monthly_monitoring > 0 ){
          return inv_monthly_monitoring;
        }else{
          if( jp_monthly_monitoring > 0 ){
            return jp_monthly_monitoring;
          }else{
            return '0.00';
          }
        }
      }

      if( widget_autopopulate_field_name == 'Invoice One Time Activation' ){
        if( inv_program_setup > 0 ){
          return inv_program_setup;
        }else{
          if( jp_program_setup > 0 ){
            return jp_program_setup;
          }else{
            return '0.00';
          }
        }
      }

      if( widget_autopopulate_field_name == 'Invoice Installation Cost' ){
        if( inv_installation_cost > 0 ){
          return inv_installation_cost;
        }else{
          if( jp_intallation_cost > 0 ){
            return jp_intallation_cost;
          }else{
            return '0.00';
          }
        }
      }

      if( widget_autopopulate_field_name == 'Invoice Total Due' ){
        return inv_grand_total > 0 ? inv_grand_total : '0.00';  
      }

      if( widget_autopopulate_field_name == 'Job Account Number' ){
        return job_account_number;  
      }

      if( widget_autopopulate_field_name == 'Job Name' ){
        return job_name;  
      }

      if( widget_autopopulate_field_name == 'Job Number' ){
        return job_number;  
      }

      if( widget_autopopulate_field_name == 'Job Type' ){
        return job_type;  
      }

      //Job Service
      if( widget_autopopulate_field_name === 'Service Ticket Number' ) {
        return job_service_ticket_number;
      }

      if( widget_autopopulate_field_name === "Job Address" ) {
        return job_service_mail_add;
      }

      if( widget_autopopulate_field_name === "Job City" ) {
        return job_service_city;
      }

      if( widget_autopopulate_field_name === "Job State" ) {
        return job_service_state;
      }

      if( widget_autopopulate_field_name === "Job Zip" ) {
        return job_service_zip;
      }

      if( widget_autopopulate_field_name == 'Job Name' ){
        return job_name;  
      }
    }
    // Dynamic widget end
    
    if (field_name === "Text" && fieldValue === null ) {

      let specs_field_name = JSON.parse(specs);
      let unique_key
      if( specs_field_name.name === "card_number" || specs_field_name.name === "card_account_number" ) {
        return acct_num;
      }
      if( specs_field_name.name === "subscriber_name" ) {
        return first_name + " " + last_name;
      }
      
      if( specs_field_name.name === "subscriber_fname" ) {
        return first_name;
      }

      if( specs_field_name.name === "customer_name" ) {
        return first_name + " " + last_name;
      }
      
      if( specs_field_name.name === "subscriber_lname" ) {
        return last_name;
      }
      
      if( specs_field_name.name === "phone_h" ) {
        return phone_h;
      }
      
      if( specs_field_name.name === "phone_m" ) {
        return phone_m;
      }
      
      if( specs_field_name.name === "address" || specs_field_name.name === "Address" ) {
        return mail_add;
      }
      
      if( specs_field_name.name === "city" || specs_field_name.name === "City" ) {
        if( acs_city != '' ){
          return acs_city;        
        }else{
          return city;          
        }        
      }
      
      if( specs_field_name.name === "state" ) {
        if( acs_state != '' ){
          return acs_state;
        }else{
          return state;  
        }        
      }

      if( specs_field_name.name === "zip_code" || specs_field_name.name === "zip" ) {
        return zip_code;
      }

      if( specs_field_name.name === "password" || specs_field_name.name === "Password" ) {
        return access_password;
      }

      if( specs_field_name.name === "checking_account_n" ) {
        return check_num;
      }

      if( specs_field_name.name === "aba" ) {
        return routing_num;
      }

      if( specs_field_name.name === "equipment_cost" ) {
        if( inv_equipment_cost > 0 ){
          return inv_equipment_cost;
        }else{
          if( jp_equipment_cost > 0 ){
            return jp_equipment_cost;
          }else{
            return '0.00';
          }
        }
      }

      if( specs_field_name.name === "date_not_later_a" ) {
        const today = new Date();
        const nextThreeDays = new Date(today.setDate(today.getDate() + 3));
        return nextThreeDays.toLocaleDateString("en-US");
      }

      if( specs_field_name.name === "date_not_later_b" ) {
        const today = new Date();
        const nextThreeDays = new Date(today.setDate(today.getDate() + 3));
        return nextThreeDays.toLocaleDateString("en-US");
      }

      if( specs_field_name.name === "installation_cost" ) {
        if( inv_installation_cost > 0 ){
          return inv_installation_cost;
        }else{
          if( jp_intallation_cost > 0 ){
            return jp_intallation_cost;
          }else{
            return '0.00';
          }
        }
      }

      if( specs_field_name.name === "one_time_activation" ) {
        if( inv_program_setup > 0 ){
          return inv_program_setup;
        }else{
          if( jp_program_setup > 0 ){
            return jp_program_setup;
          }else{
            return '0.00';
          }
        }   
      }

      if( specs_field_name.name === "total_due" ) {
        return total_due;
      }

      if( specs_field_name.name === "first_month_monitoring" ) {
        if( inv_monthly_monitoring > 0 ){
          return inv_monthly_monitoring;
        }else{
          if( jp_monthly_monitoring > 0 ){
            return jp_monthly_monitoring;
          }else{
            return '0.00';
          }
        }
      }

      if( specs_field_name.name === "card_security_code" ) {
        return credit_card_exp_mm_yyyy;
      }

      if( specs_field_name.name === "card_expiration" ) {
        return credit_card_exp;
      }

      if( specs_field_name.name === "card_name" ) {
        return card_fname + ' ' + card_lname;
      }

      if( specs_field_name.name === "customer_email" ) {
        return email;
      }

      if( specs_field_name.name === "country" ) {
        return country;
      }
      
    }

    if (field_name === "Card Security Code") {
      return credit_card_exp_mm_yyyy;
    }

    if (field_name === "Date Signed") {
      return moment().format("MM/DD/YYYY");
    }

    if (["Approve", "Decline"].includes(field_name)) {
      const html = `<button class="btn btn-secondary btn-sm docusignField">${field_name}</button>`;
      const $element = createElementFromHTML(html);
      $element.css({ top, left, position: "absolute" });
      return $element;
    }

    if (field_name === "Attachment") {
      const { value } = fieldValue || { value: null };

      const html = `
            <div class="signing__fieldAttachment docusignField" title="Attachment" data-field-type="attachment">
              <input type="file" />
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"/>
              </svg>
            </div>
          `;

      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (value) {
        $element.find("input").addClass("d-none");
        $element.attr("data-value", `${prefixURL}/uploads/docusign/${value}`); // prettier-ignore
      }

      const $input = $element.find("input");
      $input.on("change", async function () {
        const [file] = this.files;
        const ONE_MB = 1048576;

        if (file.size > ONE_MB * 8) {
          alert("Maximum file size is less than 8MB");
          return;
        }

        const { data } = await storeFieldValue({
          id: fieldId,
          value: this.files[0],
        });

        $(this).addClass("d-none");
        $element.attr("data-value", `${prefixURL}/uploads/docusign/${data.value}`); // prettier-ignore
        $element.attr("title", $(this).val());
      });

      $element.on("click", function () {
        const filepath = $(this).attr("data-value");
        if (filepath) {
          window.open(filepath, "_blank").focus();
        }
      });

      return $element;
    }

    if (field_name === "Signature") {
      const { specs: fieldSpecs } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};

      let { value } = fieldValue || { value: null };
      if (specs.value) {
        value = specs.value;
      }
      let html = `
            <div class="signing__fieldSignature docusignField" title="Signature" data-field-type="signature" id="signature${fieldId}">
              <div style="display:flex; flex-direction:column; align-items:center; padding:0 0.5em; border:2px solid #bf1e2e; background-color: #ffea588c;">
                <div style="font-weight:600; font-size:0.9em; font-family: monospace;">Sign here</div>
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="enable-background:new 0 0 407.437 407.437" viewBox="0 0 407.437 407.437">
                  <path d="m386.258 91.567-182.54 181.945L21.179 91.567 0 112.815 203.718 315.87l203.719-203.055z"/>
                </svg>
              </div>
            </div>
          `;

      const $element = createElementFromHTML(html);

      if (value) {
        let dateTime = moment();
        if (field.value) {
          const { created_at } = field.value;
          if (created_at) {
            const date = moment(created_at);
            dateTime = date.format("MMMM Do YYYY, hh:mm A");
          }
        }

        const valueHtml = `
              <div class="mobile-signature-container fillAndSign__signatureContainer">
                <img class="fillAndSign__signatureDraw" src="${value}"/>
                ${
                  dateTime
                    ? `<span class="fillAndSign__signatureTime">${dateTime}</span>`
                    : ""
                }
              </div>
            `;

        $element.html(createElementFromHTML(valueHtml));
      }

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      $element.on("click touchstart", () => {        
        signaturePad.clear();
        $(".signing__signatureInput").val("");

        $signatureModal.attr("data-field-id", fieldId);
        $importSignatureModal.attr("data-field-id", fieldId);

        const fid = 0;        
        
        if( window.__ismobile ){
          alert('Sign in mobile:'+fid+':'+fieldId+':'+recipient.id+':'+recipient.docfile_id);
        }else{
          $signatureModal.modal("show");
        } 
             
        //$signatureModal.modal("show");
             
      });
      return $element;
    }

    if (["Checkbox", "Radio", "2 GIG Go Panel 2", "2 GIG Go Panel 3", "Lynx3000", "LynxTouch", "Vista/SEM", "DSC", "Other", "Card Mastercard", "Card Visa", "Card American Express"].includes(field_name)) {
      let {
        subCheckbox = [],
        isChecked,
        name,
        is_required,
        value: valueSpec,
      } = JSON.parse(field.specs) || {};

      if (!name) {
        name = field.unique_key;
      }

      let { value } = fieldValue || {};
      value = value ? JSON.parse(value) : {};

      let hasRequested = false;
      const getSubCheckboxes = () => {
        if (value.subCheckbox && value.subCheckbox.length) {
          return value.subCheckbox;
        }

        return hasRequested ? value.subCheckbox : subCheckbox;
      };

      if( field_name === panel_type ){
        isChecked = 'checked';
      }else{
        isChecked = '';
      }

      if (value.hasOwnProperty("isChecked")) {
        isChecked = value.isChecked;
      }

      //console.log('Panel Type' + panel_type);
      //console.log('Is Checked' + isChecked);

      //const inputType = field_name.toLowerCase();
      const inputType = field_name === "Checkbox" || field_name === "2 GIG Go Panel 2" || field_name === "2 GIG Go Panel 3" || field_name === "Lynx3000" || field_name === "LynxTouch" || field_name === "Vista/SEM" || field_name === "DSC" || field_name === "Other" || field_name === "Card Visa" || field_name === "Card Mastercard" || field_name === "Card American Express"
          ? "checkbox"
          : field_name.toLowerCase();
      const chkDataFieldType = field_name === "2 GIG Go Panel 2" || field_name === "2 GIG Go Panel 3" || field_name === "Lynx3000" || field_name === "LynxTouch" || field_name === "Vista/SEM" || field_name === "DSC" || field_name === "Other" || field_name === "Card Visa" || field_name === "Card Mastercard" || field_name === "Card American Express"
          ? "autoPopulatePanelType"
          : 'esign-checkbox';
      const baseClassName =1
        field_name === "Checkbox" || field_name === "2 GIG Go Panel 2" || field_name === "2 GIG Go Panel 3" || field_name === "Lynx3000" || field_name === "LynxTouch" || field_name === "Vista/SEM" || field_name === "DSC" || field_name === "Other" || field_name === "Card Visa" || field_name === "Card Mastercard" || field_name === "Card American Express"
          ? "docusignField__checkbox"
          : "docusignField__radio";

      const html = `<div class="docusignField ${baseClassName}"></div>`;
      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (is_required) {
        $element.addClass(`${baseClassName}--isRequired`);
      }

      //console.log(JSON.stringify(field, null, 4));
      const inputName = `${name}-${field.unique_key}`;
      $element.append(`
            <div class="form-check">
              <input
                class="form-check-input"
                type="${inputType}"
                id="${field.unique_key}"
                ${isChecked ? "checked" : ""}
                name="${inputName}"
                ${valueSpec ? `value="${valueSpec}"` : ""}
                data-is-parent="true"
                data-parent-id="${field.unique_key}"
                data-field-type="${chkDataFieldType}"
                data-field-id="${field.id}"
              >
              <span class="form-check-indicator">x</span>
              <label
                class="form-check-label invisible"
                for="${field.unique_key}"
              ></label>
            </div>
          `);

      if (subCheckbox.length) {
        $element.append(
          subCheckbox.map((option) => {
            const { id, top = 0, left = 0, value: valueOption } = option;
            let { isChecked = false } = option;
            if (value.subCheckbox) {
              const f =
                value.subCheckbox.find(({ id: _id }) => _id === id) || {};
              isChecked = Boolean(f.isChecked);
            }

            // prettier-ignore
            const $currElement = createElementFromHTML(`
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="${inputType}"
                      id="${id}"
                      ${isChecked ? "checked" : ""}
                      name="${inputName}"
                      ${valueOption ? `value="${valueOption}"` : ""}
                      data-parent-id="${field.unique_key}"
                    >
                    <span class="form-check-indicator">x</span>
                    <label class="form-check-label invisible" for="${id}"></label>
                  </div>
                `);

            const topEm = `${pxToEm(parseInt(top))}em`;
            const leftEm = `${pxToEm(parseInt(left))}em`;
            $currElement.css({
              top: topEm,
              left: leftEm,
              position: "absolute",
            });
            return $currElement;
          })
        );
      }

      $element.find(`input:${inputType}`).on("change", async function () {
        /**
         * if not checkbox, make sure to have only one checked
         */

        const $this = $(this);
        const id = $this.attr("id");
        const _isChecked = $this.is(":checked");

        if (id === field.unique_key) {
          let _subCheckbox = getSubCheckboxes();
          if (field_name !== "Checkbox") {
            _subCheckbox = _subCheckbox.map((f) => ({
              ...f,
              isChecked: false,
            }));
          }

          const { data } = await storeFieldValue({
            id: fieldId,
            value: JSON.stringify({
              subCheckbox: _subCheckbox,
              isChecked: _isChecked,
            }),
          });

          value = JSON.parse(data.value);
        } else {
          let newSubCheckbox = [];
          const subCheckbox = getSubCheckboxes();

          if (subCheckbox.find((s) => s.id === id)) {
            newSubCheckbox = subCheckbox.map((s) => {
              if (s.id !== id && field_name !== "Checkbox") {
                return { ...s, isChecked: false };
              }

              return s.id !== id ? s : { ...s, isChecked: _isChecked };
            });
          } else {
            newSubCheckbox = [...subCheckbox, { id, isChecked: _isChecked }];
          }

          let payload = {
            subCheckbox: newSubCheckbox,
            isChecked: Boolean(value.isChecked),
          };

          if (field_name !== "Checkbox") {
            payload = {
              subCheckbox: newSubCheckbox,
              isChecked: false,
            };
          }

          const { data } = await storeFieldValue({
            id: fieldId,
            value: JSON.stringify(payload),
          });

          value = JSON.parse(data.value);
        }

        if ((!subCheckbox || !subCheckbox.length) && name) {
          const $duplicate = $(
            `[type=checkbox][name^="${name}-"]:not([id="${field.unique_key}"])`
          );
          const id = $duplicate.attr("id");
          const duplicateField = data.fields.find((f) => f.unique_key === id);

          if (duplicateField) {
            const { subCheckbox } = JSON.parse(duplicateField.specs) || {};
            if (!subCheckbox || !subCheckbox.length) {
              $duplicate.prop("checked", Boolean(value.isChecked));
              await storeFieldValue({
                id: duplicateField.id,
                value: JSON.stringify({
                  subCheckbox,
                  isChecked: Boolean(value.isChecked),
                }),
              });
            }
          }
        }

        const thisValue = $this.val();
        const thisID = $this.attr("id");
        // handle options with subcheckbox
        if (
          subCheckbox.length &&
          inputType === "radio" &&
          thisValue &&
          thisID
        ) {
          const $duplicate = $(
            `[type=radio][name^="${name}-"][value="${thisValue}"]:not([id="${thisID}"])`
          );

          const parentId = $duplicate.data("parent-id");
          const duplicateField = data.fields.find(
            (f) => f.unique_key === parentId
          );

          if ($duplicate.length && parentId && duplicateField) {
            const isParent = $duplicate.attr("data-is-parent");
            const isChecked = $this.is(":checked");
            const specs = JSON.parse(duplicateField.specs) || {};

            if (isParent) {
              specs.isChecked = isChecked;
            } else {
              const matchedSubCheckbox = specs.subCheckbox.some(
                (s) => s.value === thisValue
              );

              if (matchedSubCheckbox) {
                specs.isChecked = false;
                specs.subCheckbox = specs.subCheckbox.map((s) => {
                  if (s.value !== thisValue) return s;
                  return { ...s, isChecked };
                });
              }
            }

            $duplicate.prop("checked", isChecked);
            await storeFieldValue({
              id: duplicateField.id,
              value: JSON.stringify(specs),
            });
          }
        }

        if (subCheckbox.length && thisValue && thisID) {
          const $duplicate = $(
            `[type="${inputType}"][name^="${name}-"][value="${thisValue}"]:not([id="${thisID}"])`
          );

          const parentId = $duplicate.data("parent-id");
          const duplicateField = data.fields.find(
            (f) => f.unique_key === parentId
          );

          if ($duplicate.length && parentId && duplicateField) {
            const isParent = $duplicate.attr("data-is-parent");
            const isChecked = $this.is(":checked");
            const specs = JSON.parse(duplicateField.specs) || {};

            if (isParent) {
              specs.isChecked = isChecked;
            } else {
              specs.isChecked = $(`#${parentId}`).is(":checked");
            }

            specs.subCheckbox = specs.subCheckbox.map((s) => {
              if (s.value !== thisValue) {
                return { ...s, isChecked: $(`#${s.id}`).is(":checked") };
              }

              return { ...s, isChecked };
            });

            $duplicate.prop("checked", isChecked);
            storeFieldValue({
              id: duplicateField.id,
              value: JSON.stringify(specs),
            });
          }
        }

        hasRequested = true;
      });

      return $element;
    }

    if (field_name === "Dropdown") {
      const { values: options = [], selected: defaultValue, is_required } = JSON.parse(field.specs) || {}; // prettier-ignore
      const { value: selected } = fieldValue || { value: defaultValue };

      const optionsArray = options.map((option) => {
        const isSelected = selected === option;
        return `
              <option value="${option}" ${isSelected ? "selected" : ""}>
                ${option}
              </option>
            `;
      });

      if (!optionsArray.length) {
        return "";
      }

      const html = `
            <div class="docusignField docusignField__dropdown">
              <select>
                <option value="">Select</option>
                ${optionsArray.join("")}
              </select>
            </div>
          `;

      const $element = createElementFromHTML(html);

      if (is_required) {
        $element.addClass("docusignField__dropdown--isRequired");
      }

      $element.find("select").on("change", function () {
        storeFieldValue({ value: this.value, id: fieldId });
      });

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (!selected && recipient.id !== data.recipient.id) {
        $element.css({ opacity: 0 });
      }

      return $element;
    }

    if (field_name === "Formula") {
      let value = "";
      if ("value" in field && field.value && "value" in field.value) {
        value = String(field.value.value);
      }

      const html = `
            <div class="docusignField docusignField--formula" style="position: relative; display: flex; align-items: center;">
              <input
                readonly
                type="text"
                data-key="${field.unique_key}"
                placeholder="${field_name}"
                ${value.length ? `value="${value}"` : ""}
              />
            </div>
          `;

      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });
      return $element;
    }

    const { decrypted } = data;
    if (decrypted.is_self_signed) {
      text = undefined;
    }
    
    //console.log('widget' + widget_type);
    if (
      field_name === "Text" ||
      field_name === "TextString" ||
      text === undefined || field_name === "City"
      || widget_type == 'dynamic-widget'
    ) {
      let { value } = fieldValue || { value: "" };
      const { specs: fieldSpecs, unique_key, widget_type } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};
      const { width, is_required = false, is_read_only = false } = specs;
      const isRequired = is_required.toLocaleString() === "true";
      const isReadOnly = is_read_only.toLocaleString() === "true";

      let { workorder_recipient: customer } = data;
      if (!customer) {
        customer = data.job_recipient;
      }

      const autoPopulateData = getAutoPopulateDataFromFieldSpecs(specs);
      if (autoPopulateData) {
        customer = autoPopulateData;
      }

      const customer_card = window.__esigndata.auto_populate_data.billing;
      const customer_cost_due = window.window.__esigndata.auto_populate_data.cost_due;;
      let group_input_class = field.original_field_name;      
      group_input_class = 'input-group-' + group_input_class.replace(/\s+/g, '-').toLowerCase();
      if (customer && specs.name && !value) {
        if (String(specs.name.toLowerCase()).startsWith("zip")) {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["zip_code"];
        } else if (specs.name.toLowerCase() === "address") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["mail_add"] ||
            customer["subdivision"];            
        } else if (specs.name.toLowerCase() === "password") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["password"];
        } else if (specs.name.toLowerCase() === "card_number") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_account_number"];
        } else if (specs.name.toLowerCase() === "card_expiration") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_expiration"];
        } else if (specs.name.toLowerCase() === "card_name") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_name"] ||
            customer["card_first_name"] ||
            customer["card_last_name"];
        } else if (specs.name.toLowerCase() === "mobile_number") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["phone_m"] ||
            customer["phone_h"];
            // added changes\/
        } else if (specs.name.toLowerCase() === "subscriber_fname") {
          value =
            customer[specs.name] ||
            customer["first_name"];
        } else if (specs.name.toLowerCase() === "subscriber_lname") {
          value =
            customer[specs.name] ||
            customer["last_name"];
        } else if (specs.name.toLowerCase() === "phone_h") {
          value =
            customer[specs.name] ||
            customer["phone_h"];
        } else if (specs.name.toLowerCase() === "phone_m") {
          value =
            customer[specs.name] ||
            customer["phone_m"];
        } else if (specs.name.toLowerCase() === "city") {
          value =
            customer[specs.name] ||
            customer["city"];
        } else if (specs.name.toLowerCase() === "state") {
          value =
            customer[specs.name] ||
            customer["state"];
        } else if (specs.name.toLowerCase() === "zip_code") {
          value =
            customer[specs.name] ||
            customer["zip_code"];
        } else if (specs.name.toLowerCase() === "customer_email") {
          value =
            customer[specs.name] ||
            customer["email"];
        } else if (specs.name.toLowerCase() === "country") {
          value =
            customer[specs.name] ||
            customer["country"];
        } else if (specs.name.toLowerCase() === "checking_account_n") {
          value =
            customer[specs.name] ||
            customer_card['check_num'];
        } else if (specs.name.toLowerCase() === "aba") {
          value =
            customer[specs.name] ||
            customer_card['routing_num']
        } else if (specs.name.toLowerCase() === "card_account_number") {
          value =
            customer[specs.name] ||
            customer["card_account_number"];
        } else if (specs.name.toLowerCase() === "card_security_code") {
          value =
            customer[specs.name] ||
            customer["card_expiration_mm_yyyy"];
        } else if (specs.name.toLowerCase() === "equipment_cost") {
          value =
            customer[specs.name] ||
            customer_cost_due['equipment_cost'];
        } else if (specs.name.toLowerCase() === "one_time_activation") {
          value =
            customer[specs.name] ||
            customer_cost_due['one_time_activation'];
        } else if (specs.name.toLowerCase() === "first_month_monitoring") {
          value =
            customer[specs.name] ||
            customer_cost_due['first_month_monitoring'];
        } else if (specs.name.toLowerCase().startsWith("job_")) {
          if (window.__esigndata.job_data) {
            const jobData = window.__esigndata.job_data;
            const jobField = specs.name.toLowerCase().replace("job_", "");
            value = jobData[jobField] || "";
          }
        } else {
          value =
            customer[specs.name] || customer[specs.name.toLowerCase()] || "";
        }
      }

      if (specs.value && !value && data.recipient.id === recipient.id) {
        value = specs.value;
      }

      if (value === undefined || value === null) {
        value = "";
      }

      const placeholder = specs.placeholder || specs.name || field_name;
      let custom_class  = "";
      if( placeholder == "Esign Envelope ID" ){
        custom_class = "docusign-envelope-id-field";
      }
      const html = `
        <div class="docusignField" style="position: relative; display: flex; align-items: center;">
          <input class="${custom_class} input-group ${group_input_class}" data-name="${group_input_class}" type="text" placeholder="${placeholder}" value="${value}" data-key="${unique_key}" />
          <div class="spinner-border spinner-border-sm d-none" role="status" style="position: absolute; right: 4px;">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      `;
      

      const $element = createElementFromHTML(html);
      const $input = $element.find("input");

      if (field.original_field_name === "Date Signed") {
        $input.attr("data-field-type", "dateSigned");
        $input.attr("data-field-id", fieldId);
      }

      //Dynamic Widget auto save class start
      if( widget_type ){
        $input.attr("data-field-type", "autoPopulateDynamicWidget");
        $input.attr("data-field-id", fieldId);
      }
      //Dynamic Widget auto save class end

      if (field.original_field_name === "Subscriber Name" || field.original_field_name === "City" || field.original_field_name === "State" || field.original_field_name === "Address" || field.original_field_name === "ZIP" || field.original_field_name === "Subscriber Email" || field.original_field_name === "Primary Contact" || field.original_field_name === "Secondary Contact" || field.original_field_name === "Access Password" || field.original_field_name === "County" || field.original_field_name === "Abort Code" || field.original_field_name === 'Social Security Number' || field.original_field_name === 'Date of Birth' || field.original_field_name === 'Panel Type') {
        $input.attr("data-field-type", "autoPopulateCustomerDetails");
        $input.attr("data-field-id", fieldId);
      }      

      if( field.original_field_name === "Primary Contact Name" || field.original_field_name === "Primary Contact Number" || field.original_field_name === "Primary Contact First Name" || field.original_field_name === "Primary Contact Last Name" ){
        $input.attr("data-field-type", "autoPopulateEmergencyContact");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Secondary Contact Name" || field.original_field_name === "Secondary Contact Number" || field.original_field_name === "Secondary Contact First Name" || field.original_field_name === "Secondary Contact Last Name" ){
        $input.attr("data-field-type", "autoPopulateEmergencyContact");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Checking Account Number" || field.original_field_name === "Account Number" || field.original_field_name === "CS Account Number" || field.original_field_name === "ABA" || field.original_field_name === "Card Number" || field.original_field_name === "Card Holder Name" || field.original_field_name === "Card Expiration" || field.original_field_name === "Card Security Code" || field.original_field_name === "Equipment" || field.original_field_name === "Account Number" ){
        $input.attr("data-field-type", "autoPopulateAccountDetails");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Equipment Cost" || field.original_field_name === "Monthly Monitoring Rate" || field.original_field_name === "One Time Activation (OTP)" || field.original_field_name === "Total Due" || field.original_field_name === "Job Account Number" ||  field.original_field_name === "Installation Cost"){
        $input.attr("data-field-type", "autoPopulateBilling");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "System Size" || field.original_field_name === "kW DC" ){
        $input.attr("data-field-type", "autoPopulateSolar");
        $input.attr("data-field-id", fieldId); 
      }

      if (field.original_field_name === "Text" ) {
        let specs_field_name = specs;
        if( specs_field_name.name === "equipment_cost" || specs_field_name.name === "one_time_activation" || specs_field_name.name === "first_month_monitoring" || specs_field_name.name === 'total_due' ) {
          $input.attr("data-field-type", "autoPopulateBilling");
          $input.attr("data-field-id", fieldId); 
        }
      }

      // requires assets/js/esign/docusign/input.autoresize.js
      $input.autoresize({ minWidth: width ? width : 140 });

      $input.prop("required", isRequired);
      $input.prop("readonly", isReadOnly);

      if (isRequired) {
        $element.addClass("docusignField__input--isRequired");
      }

      if (isReadOnly) {
        $element.addClass("docusignField--readOnly");
      }

      if (specs.name) {
        $input.attr("data-name", specs.name);
      }

      let typingTimer;
      let doneTypingInterval = 2500;
      const doneTyping = async (input) => {
        const $input = $(input);
        const $spinner = $input.next(".spinner-border");

        $input.attr("readonly", true);
        // $spinner.removeClass("d-none");

        const value = $input.val().trim();
        await storeFieldValue({ value, id: fieldId });

        $input.attr("readonly", false);
        $spinner.addClass("d-none");

        if (!$input.attr("data-name")) return;

        const name = $input.attr("data-name").toLowerCase();
        const key = $input.attr("data-key");
        const $sameFields = $(`input[data-name='${name}' i]:not([data-key='${key}'])`); // prettier-ignore

        if (!$sameFields.length) return;

        // This will avoid auto-filling, same data-name
        // for different recipients.
        const inputsWithFields = [];

        //Will autopopulate text input with input-group-text
        // const promises = [...$sameFields].map((input) => {
        //   const $input = $(input);
        //   const key = $input.attr("data-key");
        //   const field = data.fields.find(({ unique_key }) => unique_key === key); // prettier-ignore
        //   if (field) {
        //     inputsWithFields.push($input);
        //     console.log('storing');
        //     return storeFieldValue({ value, id: field.id });
        //   }
        // });

        // await Promise.all(promises);
        // inputsWithFields.forEach(($input) => $input.val(value));
      };

      $element.find("input").keyup(function () {
        clearTimeout(typingTimer);
        if ($(this).val()) {
          typingTimer = setTimeout(() => doneTyping(this), doneTypingInterval);
        }
      });

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (field_name === "TextString" && (field_name !== 'City')) {
        // $element.addClass("completed");
        //$input.prop("required", false);
        // $input.prop("readonly", true);
      }

      return $element;
    }

    return null;
  }

  function renderField({ fields, recipient, context, $page }) {    
    const isOwner = recipient == null ? false : recipient.id === data.recipient.id;    
    const $fields = fields.map((field) => {
      field.original_field_name = field.field_name;

      let $element = getRenderField({ field, recipient, $page });
      const isString = typeof $element === "string";

      if ($element === null || isString) {
        const { field_name } = field;
        const text = recipient[field_name.toLowerCase()];

        field.field_name = "TextString";
        field.value = { value: isString ? $element : text };

        $element = getRenderField({ field, recipient, $page });
      }

      if ($element instanceof jQuery && !isOwner) {
        $element.addClass("completed");
        $element.addClass("not-owned");

        let closestInput = $element.find("input");
        closestInput.addClass('completed-not-owned');
        closestInput.required = false;
      }

      return $element;
    });

    $page.append($fields);

    // We wanted to auto-fill name and email fields
    // from recipient data.
    $fields.forEach(($field, index) => {
      const { field_name, specs } = fields[index];
      if (field_name !== "Text") return;
      if (!specs) return;

      const parsedSpecs = JSON.parse(specs);
      if (!parsedSpecs.name) return;

      const nameLower = parsedSpecs.name.toLowerCase();
      if (!["email", "name"].includes(nameLower)) return;

      const $input = $field.find("input[type=text]");
      if ($input.val()) return; // avoid overiding user defined value

      const currentRecipient =
        getAutoPopulateDataFromFieldSpecs(parsedSpecs) || recipient;

      $input.val(currentRecipient[nameLower]);
      $input.keyup(); // manually trigger event, this will make sure to save the value
    });
  }

  function getAutoPopulateDataFromFieldSpecs(specs) {
    if (specs.auto_populate_with && specs.auto_populate_with.length) {
      if (
        window.__esigndata.auto_populate_data &&
        window.__esigndata.auto_populate_data[specs.auto_populate_with]
      ) {
        const match =
          window.__esigndata.auto_populate_data[specs.auto_populate_with];

        if (match.first_name && match.last_name) {
          match.name = `${match.first_name} ${match.last_name}`;
        }

        return match;
      }
    }
  }

  async function renderPDF(file) {
    const { fields, recipient, co_recipients } = data;
    const filepath = file.path.replace(/^\/|\/$/g, "");

    const documentUrl = `${prefixURL}/${filepath}`;
    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;

    const $container = createElementFromHTML(
      `<div class="signing__documentPDF" data-file-id="${file.id}"></div>`
    );

    for (let index = 1; index <= document.numPages; index++) {
      const isDocumentField = ({ doc_page, docfile_document_id }) => {
        return doc_page == index && docfile_document_id == file.id;
      };

      const currentFields = fields.filter(isDocumentField);
      const params = { page: index, document };
      const $page = await getPage(params);
      $container.append($page);

      const canvas = $page.find("canvas").get(0);
      const context = canvas.getContext("2d");

      await sleep(1);
      renderField({ fields: currentFields, recipient, context, $page });

      co_recipients.forEach((coRecipient) => {
        const fields = coRecipient.fields.filter(isDocumentField);
        renderField({ ...coRecipient, fields, context, $page });
      });

      $(".completed-not-owned").each(function(){        
        $(this).prop('required',false);
      });

      $documentContainer.append($container);
    }

    const formulas = fields.filter((field) => {
      const { specs: fieldSpecs } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};
      return field.field_name === "Formula" && specs.formula;
    });

    formulas.forEach((field) => {
      const specs = JSON.parse(field.specs);
      const regex = /\[(?<fieldname>\w+)]/g;

      const $formula = $(`[data-key="${field.unique_key}"]`);
      $formula.attr("data-field-type", "formula");
      $formula.attr("data-field-id", field.id);

      const setValue = (v) => {
        let formula;
        let hasNonZero = false;

        while ((match = regex.exec(specs.formula))) {
          const { fieldname } = match.groups;

          if (Number(v[fieldname]) > 0) {
            hasNonZero = true;
          }

          if (!formula) {
            formula = specs.formula.replace(`[${fieldname}]`, v[fieldname]);
          } else {
            formula = formula.replace(`[${fieldname}]`, v[fieldname]);
          }
        }

        if (!hasNonZero) {
          return;
        }

        try {
          let value = eval(formula);
          value = Math.round((value + Number.EPSILON) * 100) / 100;

          $formula.val(value);
          $formula.attr("value", $formula.val());
        } catch (error) {
          $formula.val("Invalid");
        }
      };

      let match, values = {}; // prettier-ignore
      while ((match = regex.exec(specs.formula))) {
        const { fieldname } = match.groups;
        const $input = $(`[data-name="${fieldname}"]`);
        values[fieldname] = $input.val() || 0;

        $input.on("keyup", function (event) {
          const { value } = event.target;
          values[fieldname] = value || 0;
          setValue(values);
        });
      }

      setValue(values);
    });
  }

  async function generateFileVault(downloadEsignQueryString) {
    const endpointDownloadEsign = `${prefixURL}/CustomerDashboardQuickActions/mobileDownloadCustomerDocument?${downloadEsignQueryString}`;
    const response = await fetch(endpointDownloadEsign);
    fileData = await response.json();

    if( fileData.is_success == 1 ){
      alert('File is downloaded into file vault.');
    }else{
      alert(fileData.msg);
    }
  }

  async function storeFieldValue({ id, value, force = false }) {
    const { recipient } = data;
    const { id: recipient_id } = recipient;

    if (value instanceof File) {
      const formData = new FormData();
      formData.append("attachment", value);
      formData.append("recipient_id", recipient_id);
      formData.append("field_id", id);

      const endpoint = `${prefixURL}/DocuSign/apiUploadAttachment`;

      $statusIndicator.classList.add("show");
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: {
          accepts: "application/json",
        },
      });

      $statusIndicator.classList.remove("show");
      return response.json();
    }

    if (!force) {
      const matchField = window.__esigndata.fields.find((f) => f.id === id);
      if (window.__ismobile && matchField && matchField.field_name === "Text") {
        return;
      }
    }

    const payload = {
      recipient_id,
      field_id: id,
      value,
    };

    $statusIndicator.classList.add("show");
    const response = await fetch(`${prefixURL}/DocuSign/apiStoreFieldValue`, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    $statusIndicator.classList.remove("show");
    return response.json();
  }

  function attachEventHandlers() {
    const $fontItems = $fontSelect.find(".dropdown-item");
    const $fontItemText = $fontSelect.find(".dropdown-toggle");
    const $groupInput   = $('.input-group');
    
    $groupInput.on('change', function(){
      let data_name  = $(this).attr('data-name');
      if( data_name != 'input-group-text' && data_name != 'input-group-autopopulatetext' ){
        let input_value = $(this).val();
        //console.log('not same');
        $('.'+data_name).val(input_value);

        //Check other fields
        $('.input-group-text').each(function(i, obj) {
          let obj_data_name = $(obj).data('name');
          if( obj_data_name == data_name ){
            obj.value = input_value;
          }
        });
      }
    });

    $fontItems.on("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      const $target = $(event.target);
      const font = $target.data("font");

      $fontItemText.text($target.text().trim());
      $signatureTextInput.attr("data-font", font);
      $fontSelect.removeClass("open");
    });

    $signaturePadClear.on("click", (event) => {
      event.preventDefault();
      signaturePad.clear();
      $signaturePad.get(0).classList.remove("has-content");
    });

    $signatureApplyButton.on("click", async function () {
      const $activeTab = $("#signatureModal .tab-pane.active");
      const signatureType = $activeTab.data("signature-type");

      let $element = null;
      let signatureDataUrl = null;
      const canvas = $signaturePadCanvas.get(0);

      if (signatureType === "type") {
        const signature = $signatureTextInput.val();
        const fontSize = $signatureTextInput.css("font-size");
        const fontFamily = $signatureTextInput.css("font-family");
        const fontWeight = $signatureTextInput.css("font-weight");

        if (isEmptyOrSpaces(signature)) {
          return;
        }

        signaturePad.clear();
        const clonedCanvas = cloneCanvas(canvas);
        const context = clonedCanvas.getContext("2d");

        context.font = `${fontWeight} ${fontSize} ${fontFamily}`;
        const textWidth = context.measureText(signature).width;
        context.fillText(signature, clonedCanvas.width / 2 - textWidth / 2, 100); // prettier-ignore

        trimCanvas(context);
        signatureDataUrl = clonedCanvas.toDataURL("image/png");
      } else {
        if (isCanvasBlank(canvas)) {
          return;
        }

        const clonedCanvas = cloneCanvas(canvas);
        trimCanvas(clonedCanvas.getContext("2d"));
        signatureDataUrl = clonedCanvas.toDataURL("image/png");
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const fieldId = $signatureModal.attr("data-field-id");

      const $signatureFields = $("[data-field-type=signature]");
      const fieldIds = [...$signatureFields].map((e) =>
        $(e).attr("id").replace("signature", "")
      );

      const { data } = await storeFieldValue({
        id: fieldId,
        value: signatureDataUrl,
      });

       const promises = fieldIds.map((id) => storeFieldValue({ id, value: signatureDataUrl })); // prettier-ignore
       await Promise.all(promises);

      // Using company set timezone
      // const jid = window.__esigndata.job_id;
      // const endpoint = `${prefixURL}/DocuSign/getUserdate?jid=${jid}`;
      // const response = await fetch(endpoint);
      // companyDataTime = await response.json();
      // const dateTimeFormatted = moment(companyDataTime.current_date_time).format("MMMM Do YYYY, h:mm:ss A");

      //Using created_at field where date is base from user timezone via ip address
      let dateTime = moment();
      const field = window.__esigndata.fields.find((f) => f.id === fieldId);

      if( data.created_at != '' ){
        let { created_at } = data.created_at;
        if (created_at) {
          dateTime = moment(created_at);          
        }
      }else{
        if (field && field.value) {
          let { created_at } = field.value;
          if (created_at) {
            dateTime = moment(created_at);          
          }
        }
      }

      const dateTimeFormatted = dateTime.format("MMMM Do YYYY, hh:mm A");

      const html = `
        <div class="mobile-signature-container fillAndSign__signatureContainer">
          <img class="fillAndSign__signatureDraw" src="${signatureDataUrl}"/>
          ${
            dateTimeFormatted
              ? `<span class="fillAndSign__signatureTime">${dateTimeFormatted}</span>`
              : ""
          }
        </div>
      `;

      $element = createElementFromHTML(html);
      $("[data-field-type=signature]:not(.not-owned)").html($element);
      // $(`#signature${fieldId}`).html($element);

      $signatureModal.modal("hide");

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
    });

    $signatureImportButton.on("click", async function () {
      let fieldId = $importSignatureModal.attr("data-field-id");
      let importSignatureDataUrl = document.getElementById("select-import-signature").value;
      if( importSignatureDataUrl != '' ){
        $(this).attr("disabled", true);
        $(this).find(".spinner-border").removeClass("d-none");

        const { data } = await storeFieldValue({
          id: fieldId,
          value: importSignatureDataUrl,
        });
      
        let dateTime = moment();
        const field = window.__esigndata.fields.find((f) => f.id === fieldId);
      
        if( data.created_at != '' ){
          let { created_at } = data.created_at;
          if (created_at) {
            dateTime = moment(created_at);          
          }
        }else{
          if (field && field.value) {
            let { created_at } = field.value;
            if (created_at) {
              dateTime = moment(created_at);          
            }
          }
        }
              
        const dateTimeFormatted = dateTime.format("MMMM Do YYYY, hh:mm A");
      
        const html = `
          <div class="fillAndSign__signatureContainer">
            <img class="fillAndSign__signatureDraw" src="${importSignatureDataUrl}"/>
            ${
              dateTimeFormatted
                ? `<span class="fillAndSign__signatureTime">${dateTimeFormatted}</span>`
                : ""
            }
          </div>
        `;
      
        $element = createElementFromHTML(html);
        $("[data-field-type=signature]:not(.not-owned)").html($element);
      
        $importSignatureModal.modal("hide");
      
        $(this).attr("disabled", false);
        $(this).find(".spinner-border").addClass("d-none");
      }else{
        Swal.fire({
          title: 'Error',
          text: 'Please select signature',
          icon: 'error',
          showCancelButton: false,
          confirmButtonText: 'Okay'
        });
      }
    });

    $signatureModal.on("hidden.bs.modal", function () {
      $(this).removeAttr("data-field-id");
      $signaturePad.get(0).classList.remove("has-content");
    });

    $signatureModal.on("show.bs.modal", function () {
      /*if (!isMobile()) return;

      if (document.documentElement.requestFullscreen) {
        this.requestFullscreen();
      } else if (document.documentElement.webkitRequestFullScreen) {
        this.webkitRequestFullScreen();
      }

      if (screen.orientation) {
        screen.orientation
          .lock("landscape-primary")
          .then(() => {
            const $dialog = this.querySelector(".modal-dialog");
            $dialog.classList.add("max-width-unset");
          })
          .catch((error) => {
            console.error(error);
          });
      }*/
    });

    $signatureModal.on("hide.bs.modal", function () {
      /*if (!isMobile()) return;

      if (document.fullscreenElement) {
        document.exitFullscreen().catch((err) => console.error(err));
      }

      const $dialog = this.querySelector(".modal-dialog");
      $dialog.classList.remove("max-width-unset");
      if (screen.orientation) {
        screen.orientation.unlock();
      }*/
    });

    $finishSigning.on("click", async function () {
      const $fields = $(".docusignField");
      const fields = [...$fields];

      for (let index = 0; index < fields.length; index++) {
        const $element = $(fields[index]);
        const $input = $element.find("input");
        const fieldType = $element.attr("data-field-type");

        const scrollToElement = () => {
          const className = "docusignField--focused";
          $(`.${className}`).removeClass(className);
          $element.addClass(className);

          $("html, body").animate({
            scrollTop: parseInt($element.offset().top - 100),
          });
        };

        if ($element.is("select")) {
          if (
            isEmptyOrSpaces($element.val()) &&
            $element.hasClass("docusignField__dropdown--isRequired")
          ) {
            scrollToElement();
            return;
          }
        }

        if (
          fieldType === "signature" &&
          !$element.find(".fillAndSign__signatureContainer").length
        ) {
          // no signature yet
          scrollToElement();
          return;
        }

        if (fieldType === "attachment" && !$input.hasClass("d-none")) {
          // empty attachment
          scrollToElement();
          return;
        }

        if (
          $input.is("input:text") &&
          $input.prop("required") &&
          isEmptyOrSpaces($input.val())
        ) {
          $input.focus();
          scrollToElement();
          return;
        }

        let inputType = undefined;
        if ($input.is("input:radio")) {
          inputType = "radio";
        } else if ($input.is("input:checkbox")) {
          inputType = "checkbox";
        }

        if (inputType !== undefined) {
          const $parent = $input.closest(
            `.docusignField__${inputType}--isRequired`
          );
          if (
            $parent.length &&
            !$element.find(`input:${inputType}:checked`).length
          ) {
            scrollToElement();
            return;
          }
        }
      }

      if (window.__ismobile && window.__esigndata) {
        const $inputs = [
          ...document.querySelectorAll(".docusignField > [data-key]"),
        ];
        const promises = [];
        
        $inputs.forEach(($input) => {
          if (!$input.value) return;

          const dataKey = $input.dataset.key;
          const matchField = window.__esigndata.fields.find(
            ({ unique_key }) => unique_key === dataKey
          );

          if (!matchField) return;
          if (matchField.field_name !== "Text") return;
          if (
            matchField.user_docfile_recipients_id !==
            window.__esigndata.decrypted.recipient_id
          ) {
            return;
          }

          promises.push(
            storeFieldValue({
              force: true,
              id: matchField.id,
              value: $input.value,
            })
          );
        });

        if (promises.length) {
          await Promise.all(promises);
        }
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");
      $(".loader-finishing").removeClass("d-none");

      const $dateSigned = $("[data-field-type=dateSigned]");
      const dateSignedPromises = [...$dateSigned].map((dateSigned) => {
        const $element = $(dateSigned);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateCustomerDetails = $("[data-field-type=autoPopulateCustomerDetails]");
      const autoPopulateCustomerDetailsPromises = [...$autoPopulateCustomerDetails].map((autoPopulateCustomerDetails) => {
        const $element = $(autoPopulateCustomerDetails);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      //Dynamic Widget Save Start
      const $autoPopulateDynamicWidget = $("[data-field-type=autoPopulateDynamicWidget]");
      const autoPopulateDynamicWidgetPromises = [...$autoPopulateDynamicWidget].map((autoPopulateDynamicWidget) => {
        const $element = $(autoPopulateDynamicWidget);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });
      //Dynamic Widget Save End

      const $autoPopulateEmergencyContact = $("[data-field-type=autoPopulateEmergencyContact]");
      const autoPopulateEmergencyContactPromises = [...$autoPopulateEmergencyContact].map((autoPopulateEmergencyContact) => {
        const $element = $(autoPopulateEmergencyContact);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateAccountDetails = $("[data-field-type=autoPopulateAccountDetails]");
      const autoPopulateAccountDetailsPromises = [...$autoPopulateAccountDetails].map((autoPopulateAccountDetails) => {
        const $element = $(autoPopulateAccountDetails);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateBilling = $("[data-field-type=autoPopulateBilling]");
      const autoPopulateBillingPromises = [...$autoPopulateBilling].map((autoPopulateBilling) => {
        const $element = $(autoPopulateBilling);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateSolar = $("[data-field-type=autoPopulateSolar]");
      const autoPopulateSolarPromises = [...$autoPopulateSolar].map((autoPopulateSolar) => {
        const $element = $(autoPopulateSolar);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $formulas = $("[data-field-type=formula]");
      const formulaPromises = [...$formulas].map((formula) => {
        const $element = $(formula);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulatePanelType = $("[data-field-type=autoPopulatePanelType]");
      const autoPopulatePanelTypePromises = [...$autoPopulatePanelType].map((autoPopulatePanelType) => {
        const $element = $(autoPopulatePanelType);
        const fieldId = $element.attr("data-field-id");
        const _panelTypeisChecked = $element.is(":checked");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ 
          id: fieldId,
          value: JSON.stringify({
              isChecked: _panelTypeisChecked,
          })
        });
      });

      await Promise.all(dateSignedPromises);
      await Promise.all(formulaPromises);

      await Promise.all(autoPopulateCustomerDetailsPromises);
      await Promise.all(autoPopulateEmergencyContactPromises);
      await Promise.all(autoPopulateAccountDetailsPromises);
      await Promise.all(autoPopulateBillingPromises);
      await Promise.all(autoPopulateSolarPromises);
      await Promise.all(autoPopulatePanelTypePromises);
      await Promise.all(autoPopulateDynamicWidgetPromises);

      const response = await fetch(`${prefixURL}/DocuSign/apiComplete`, {
        method: "POST",
        body: JSON.stringify({ hash }),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });

      const data = await response.json();

      // RET*RD ALERT!!! Do this in backend.
      if (data.attach_to_customer) {
        if (
          data.attach_to_customer.customer_id &&
          data.attach_to_customer.esign_id
        ) {
          const response = await fetch(
            `${prefixURL}/Customer/apiAttachGeneratedEsign`,
            {
              method: "POST",
              body: JSON.stringify({
                customer_id: data.attach_to_customer.customer_id,
                esign_id: data.attach_to_customer.esign_id,
              }),
              headers: {
                accepts: "application/json",
                "content-type": "application/json",
              },
            }
          );

          const jsonData = await response.json();
          //console.log(jsonData);
        }
      }
      
      // if( window.__ismobile ){
      //   alert('Mobile signing finished:'+data.data.docfile_id+':'+data.data.id);
      // }
      if( window.__esigndata.is_finished == 0 ){
        alert('eSign Status : Awaiting for others');          
      }else{
        alert('eSign Status : Completed');          
      } 

      if (data.hash) {
        const queryString = window.location.href;
        const url = new URL(queryString);
        const params = new URLSearchParams(url.search);

        if( params.has("is_mobile") ){
          window.location = `${prefixURL}/eSign/signing?is_mobile=1&hash=${data.hash}`;
        }else{
          window.location = `${prefixURL}/eSign/signing?hash=${data.hash}`;
        }
        // console.log('testging...');
        return;
      }

      if (data.has_user) {
        if (window.__esigndata.job_id) {
          // redirect to job and auto-open payment modal
          window.location = `${prefixURL}/job/new_job1/${window.__esigndata.job_id}?modal=approved`;
          return;
        }

        window.location = `${prefixURL}/eSign_v2/manage?view=sent`;
      }

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
      $(".loader-finishing").addClass("d-none");
      markAsFinished();
    });
  }

  function markAsFinished() {
    $(".signing").addClass("signing--finished");
    $(".signing__fieldSignature").off();

    const $fields = $(".docusignField");
    [...$fields].forEach((field) => {
      const $input = $(field).find("input");

      [$(field), $input].forEach(($element) => {
        $element.prop("readonly", true);
        $element.prop("disabled", true);
        $element.css({
          color: "initial",
          backgroundColor: "initial",
          opacity: 1,
        });

        if ($element.hasClass("docusignField__dropdown")) {
          const $select = $element.find("select");
          if (!$select.val().length) {
            $element.css({ opacity: 0 });
          }
        }
      });
    });
  }

  async function init() {
    signaturePad = new SignaturePad($signaturePadCanvas.get(0));
    signaturePad.onBegin = () => {
      $signaturePad.get(0).classList.add("has-content");
    };

    await fetchData();

    const { files } = data;
    for (let index = 0; index < files.length; index++) {
      await renderPDF(files[index]);
    }

    attachEventHandlers();

    const $container = $(".signing__documentContainer");
    const containerWidth = parseInt($container.css("width"));

    const $canvases = $container.find("canvas");
    let canvasMaxWidth = 0;
    $canvases.each((_, c) => {
      const width = parseInt($(c).attr("width"));
      if (width > canvasMaxWidth) {
        canvasMaxWidth = width;
      }
    });

    if ($(window).width() <= 991) {
      const fontSize = (1.7823691460055098 / 100) * containerWidth;
      $container.css({ fontSize });
    }

    $(".loader").addClass("d-none");
    if (data.recipient.completed_at) markAsFinished();
    
    if (data.generated_pdf) {
      // download link
      $("[data-action=download]").on("click touchstart", function () {
        let downloadEsignQueryString = new URLSearchParams({
          document_type: "esign",
          generated_esign_id: data.generated_pdf.docfile_id,
          //generated_esign_id: 1643, //For debugging
        }).toString();

        generateFileVault(downloadEsignQueryString);        
      });
    }

    if (window.__ismobile) {
      const $div = document.querySelector(".signing__documentPDF");
      const $text = document.createTextNode(".");
      $div.appendChild($text);
    }
  }

  return { init };
}

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  const hash = urlParams.get("hash");

  if (hash) {
    new Signing(hash).init();
  }
});

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

// https://stackoverflow.com/a/10232792/8062659
function isEmptyOrSpaces(str) {
  return str === null || str.match(/^ *$/) !== null;
}

// https://stackoverflow.com/a/17386803/8062659
function isCanvasBlank(canvas) {
  return !canvas
    .getContext("2d")
    .getImageData(0, 0, canvas.width, canvas.height)
    .data.some((channel) => channel !== 0);
}

// https://stackoverflow.com/a/45873660/8062659
function trimCanvas(ctx) {
  // removes transparent edges
  var x, y, w, h, top, left, right, bottom, data, idx1, idx2, found, imgData;
  w = ctx.canvas.width;
  h = ctx.canvas.height;
  if (!w && !h) {
    return false;
  }
  imgData = ctx.getImageData(0, 0, w, h);
  data = new Uint32Array(imgData.data.buffer);
  idx1 = 0;
  idx2 = w * h - 1;
  found = false;
  // search from top and bottom to find first rows containing a non transparent pixel.
  for (y = 0; y < h && !found; y += 1) {
    for (x = 0; x < w; x += 1) {
      if (data[idx1++] && !top) {
        top = y + 1;
        if (bottom) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2--] && !bottom) {
        bottom = h - y - 1;
        if (top) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
    }
    if (y > h - y && !top && !bottom) {
      return false;
    } // image is completely blank so do nothing
  }
  top -= 1; // correct top
  found = false;
  // search from left and right to find first column containing a non transparent pixel.
  for (x = 0; x < w && !found; x += 1) {
    idx1 = top * w + x;
    idx2 = top * w + (w - x - 1);
    for (y = top; y <= bottom; y += 1) {
      if (data[idx1] && !left) {
        left = x + 1;
        if (right) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2] && !right) {
        right = w - x - 1;
        if (left) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      idx1 += w;
      idx2 += w;
    }
  }
  left -= 1; // correct left
  if (w === right - left + 1 && h === bottom - top + 1) {
    return true;
  } // no need to crop if no change in size
  w = right - left + 1;
  h = bottom - top + 1;
  ctx.canvas.width = w;
  ctx.canvas.height = h;
  ctx.putImageData(imgData, -left, -top);
  return true;
}

// https://stackoverflow.com/a/8306028/8062659
function cloneCanvas(oldCanvas) {
  //create a new canvas
  var newCanvas = document.createElement("canvas");
  var context = newCanvas.getContext("2d");

  //set dimensions
  newCanvas.width = oldCanvas.width;
  newCanvas.height = oldCanvas.height;

  //apply the old canvas to the new one
  context.drawImage(oldCanvas, 0, 0);

  //return the new canvas
  return newCanvas;
}

// https://stackoverflow.com/a/6860916/8062659
function guidGenerator() {
  var S4 = function () {
    return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
  };
  return (
    S4() +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    S4() +
    S4()
  );
}

// https://stackoverflow.com/a/46741311/8062659
function pxToEm(px, element) {
  element =
    element === null || element === undefined
      ? document.documentElement
      : element;

  var temporaryElement = document.createElement("div");
  temporaryElement.style.setProperty("position", "absolute", "important");
  temporaryElement.style.setProperty("visibility", "hidden", "important");
  temporaryElement.style.setProperty("font-size", "1em", "important");
  element.appendChild(temporaryElement);
  var baseFontSize = parseFloat(getComputedStyle(temporaryElement).fontSize);
  temporaryElement.parentNode.removeChild(temporaryElement);
  return px / baseFontSize;
}

function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

// https://stackoverflow.com/a/11381730/8062659
function isMobile() {
  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  if (params.app) {
    return true;
  }

  let check = false;
  (function (a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
}

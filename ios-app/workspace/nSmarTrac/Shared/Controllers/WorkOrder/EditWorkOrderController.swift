//
//  EditWorkOrderController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import FSPagerView
import SVProgressHUD
import TLPhotoPicker

class EditWorkOrderController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var headerField: UITextView!
    @IBOutlet var workOrderNumField: MaterialTextField!
    @IBOutlet var customerField: MaterialTextField!
    @IBOutlet var jobLocationField: MaterialDropdownField!
    @IBOutlet var passwordField: MaterialTextField!
    @IBOutlet var securityNumberField: MaterialTextField!
    @IBOutlet var customField: MaterialTextField!
    @IBOutlet var startDateField: MaterialDatePickerField!
    @IBOutlet var startTimeField: MaterialDropdownField!
    @IBOutlet var endDateField: MaterialDatePickerField!
    @IBOutlet var endTimeField: MaterialDropdownField!
    @IBOutlet var employeeField: MaterialDropdownField!
    @IBOutlet var customerReminderField: MaterialDropdownField!
    @IBOutlet var timezoneField: MaterialDropdownField!
    @IBOutlet var dateIssuedField: MaterialDatePickerField!
    @IBOutlet var jobTypeField: MaterialDropdownField!
    @IBOutlet var jobNameField: MaterialTextField!
    @IBOutlet var jobDescriptionField: MaterialTextField!
    @IBOutlet var termsAndConditionsField: UITextView!
    @IBOutlet var statusField: MaterialDropdownField!
    @IBOutlet var priorityField: MaterialDropdownField!
    @IBOutlet var poNumField: MaterialTextField!
    @IBOutlet var termsOfUserField: UITextView!
    @IBOutlet var instructionsField: MaterialTextField!
    @IBOutlet var companySignatureView: YPDrawSignatureView!
    @IBOutlet var primarySignatureView: YPDrawSignatureView!
    @IBOutlet var secondarySignatureView: YPDrawSignatureView!
    @IBOutlet var signLabel: UILabel!
    @IBOutlet var sign2Label: UILabel!
    @IBOutlet var sign3Label: UILabel!
    @IBOutlet var companyRepNameField: MaterialTextField!
    @IBOutlet var primaryAccntNameNameField: MaterialTextField!
    @IBOutlet var secondaryAccntNameNameField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
    @IBOutlet var pagerView: FSPagerView! {
        didSet {
            self.pagerView.register(FSPagerViewCell.self, forCellWithReuseIdentifier: "cell")
        }
    }
    @IBOutlet var pageControl: FSPageControl! {
        didSet {
            self.pageControl.numberOfPages = self.selectedImages.count
            self.pageControl.contentHorizontalAlignment = .right
            self.pageControl.contentInsets = UIEdgeInsets(top: 0, left: 20, bottom: 0, right: 20)
            self.pageControl.hidesForSinglePage = true
        }
    }

    @IBOutlet var defaultRadio: DLRadioButton!
    @IBOutlet var redRadio: DLRadioButton!
    @IBOutlet var pinkRadio: DLRadioButton!
    @IBOutlet var magentaRadio: DLRadioButton!
    @IBOutlet var purpleRadio: DLRadioButton!
    @IBOutlet var blueRadio: DLRadioButton!
    @IBOutlet var tealRadio: DLRadioButton!
    @IBOutlet var greenRadio: DLRadioButton!
    @IBOutlet var goldRadio: DLRadioButton!
    
    @IBOutlet var itemField: UILabel!
    @IBOutlet var qtyField: UILabel!
    @IBOutlet var priceField: UILabel!
    @IBOutlet var removeButton: UIButton!
    @IBOutlet var item2Field: UILabel!
    @IBOutlet var qty2Field: UILabel!
    @IBOutlet var price2Field: UILabel!
    @IBOutlet var remove2Button: UIButton!
    @IBOutlet var item3Field: UILabel!
    @IBOutlet var qty3Field: UILabel!
    @IBOutlet var price3Field: UILabel!
    @IBOutlet var remove3Button: UIButton!
    @IBOutlet var item4Field: UILabel!
    @IBOutlet var qty4Field: UILabel!
    @IBOutlet var price4Field: UILabel!
    @IBOutlet var remove4Button: UIButton!
    @IBOutlet var item5Field: UILabel!
    @IBOutlet var qty5Field: UILabel!
    @IBOutlet var price5Field: UILabel!
    @IBOutlet var remove5Button: UIButton!
    @IBOutlet var item6Field: UILabel!
    @IBOutlet var qty6Field: UILabel!
    @IBOutlet var price6Field: UILabel!
    @IBOutlet var remove6Button: UIButton!
    @IBOutlet var item7Field: UILabel!
    @IBOutlet var qty7Field: UILabel!
    @IBOutlet var price7Field: UILabel!
    @IBOutlet var remove7Button: UIButton!
    @IBOutlet var item8Field: UILabel!
    @IBOutlet var qty8Field: UILabel!
    @IBOutlet var price8Field: UILabel!
    @IBOutlet var remove8Button: UIButton!
    @IBOutlet var item9Field: UILabel!
    @IBOutlet var qty9Field: UILabel!
    @IBOutlet var price9Field: UILabel!
    @IBOutlet var remove9Button: UIButton!
    
    @IBOutlet var subTotal: UILabel!
    @IBOutlet var taxes: UILabel!
    @IBOutlet var adjustments: UILabel!
    @IBOutlet var depositCollected: UILabel!
    @IBOutlet var grandTotal: UILabel!
    
    var selectedCustomer: Customer?
    var selectedItems: [Item] = []
    var selectedImages: [UIImage] = []
    var groupItems: [[String: [Item]]] = []
    
    var item: WorkOrder!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Edit Work Order"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        workOrderNumField.text              = item.work_order_number
        customerField.text                  = item.customer_name
        jobLocationField.text               = item.job_location
        startDateField.date                 = Date(fromString: item.start_date, format: DateHelper.dateFormatType)!
        startTimeField.text                 = item.start_time
        endDateField.date                   = Date(fromString: item.end_date, format: DateHelper.dateFormatType)!
        endTimeField.text                   = item.end_time
        customerReminderField.text          = item.customer_reminder_notification
        dateIssuedField.date                = Date(fromString: item.date_issued, format: DateHelper.dateFormatType)!
        jobTypeField.text                   = item.job_type
        jobNameField.text                   = item.job_name
        jobDescriptionField.text            = item.job_description
        statusField.text                    = item.status
        priorityField.text                  = item.priority
        poNumField.text                     = item.po_number
        instructionsField.text              = item.instructions
        companyRepNameField.text            = item.company_representative_name
        primaryAccntNameNameField.text      = item.primary_account_holder_name
        secondaryAccntNameNameField.text    = item.secondary_account_holder_name
        
        selectedCustomer = Helpers.getCustomerById(item.customer_id)
        selectedItems.append(contentsOf: item.items)
        initiateItems()
    }
    
    // MARK: - Actions -
    
    @IBAction func selectCustomerButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCustomerController")  as? SelectCustomerController {
            vc.callback = { customer in
                self.selectedCustomer = customer
                self.customerField.text = customer.contact_name
                
                var customerAddress: [String] = []
                // iterate address
                for address in customer.address {
                    customerAddress.append("\(address.address1) \(address.address2), \(address.city), \(address.state) \(address.postal_code)")
                }
                // assign
                self.jobNameField.text = customer.contact_name
                self.jobLocationField.updateOptions(options: customerAddress)
                self.jobLocationField.setSelectedOption(option: customerAddress.first)
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func addCustomerButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerController")
    }
    
    @IBAction func addJobLocationButtonTapped(_ sender: Any) {
        guard selectedCustomer != nil else {
            return
        }
        
        self.pushTo(storyBoard: "Main", identifier: "sb_AddOtherAddressController")
    }
    
    @IBAction func addItemButtonTapped(_ sender: Any) {
        guard selectedItems.count < 9 else {
            return
        }
        
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectItemController")  as? SelectItemController {
            vc.callback = { item in
                self.selectedItems.append(item)
                self.initiateItems()
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func removeItemButtonTapped(_ sender: Any) {
        let tag = (sender as! UIButton).tag
        self.selectedItems.remove(at: tag)
        self.initiateItems()
    }
    
    @IBAction func uploadButtonTapped(_ sender: Any) {
        self.presentImagePicker()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
         
        // get event color
        let eventColor = EventColor.colors[defaultRadio.selected()?.tag ?? 0]
        
        let workOrder: Parameters = ["company_id": App.shared.companyId,
                                     "work_order_number": workOrderNumField.text!,
                                     "customer_id": selectedCustomer?.id ?? 0,
                                     "job_location": jobLocationField.text!,
                                     "employee_id": Helpers.getEmployeeId(employeeField.text!),
                                     "start_date": App.shared.dateFormatter.string(from: startDateField.date),
                                     "start_time": startTimeField.text!,
                                     "end_date": App.shared.dateFormatter.string(from: endDateField.date),
                                     "end_time": endTimeField.text!,
                                     "event_color": eventColor,
                                     "customer_reminder_notification": customerReminderField.text!,
                                     "timezone": timezoneField.text!,
                                     "date_issued": App.shared.dateFormatter.string(from: dateIssuedField.date),
                                     "job_type": jobTypeField.text!,
                                     "job_name": jobNameField.text!,
                                     "job_description": jobDescriptionField.text!,
                                     "status": statusField.text!,
                                     "priority": priorityField.text!,
                                     "po_number": poNumField.text!,
                                     "instructions": instructionsField.text!,
                                     "header": headerField.text!,
                                     "password": passwordField.text!,
                                     "custom_field": customField.text!,
                                     //"terms_and_conditions": termsAndConditionsField.text!,
                                     //"terms_of_use": termsOfUserField.text!,
                                     "company_representative_name": companyRepNameField.text!,
                                     "primary_account_holder_name": primaryAccntNameNameField.text!,
                                     "secondary_account_holder_name": secondaryAccntNameNameField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putWorkOrder(item.id.intValue, params: workOrder, flag: "DELETE_ITEMS") { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            // items
            // create group
            let group = DispatchGroup()
            // sort ungrouped
            let ungrouped = self.selectedItems.sorted(by: {$0.id > $1.id})
            // group
            let grouped = ungrouped.group(by: {$0.id})
            // iterate
            for (key, value) in grouped {
                // create json
                let item: Parameters = ["work_order_id": self.item.id, "items_id": key, "qty": value.count]
                // enter group
                group.enter()
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postWorkOrderItem(item) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
            }
            
            // signatures
            if let image = self.companySignatureView.getCroppedSignature() {
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "work_order_id": self.item.id,
                                          "column_name": "company_representative_signature",
                                          "date_column_name": "company_representative_sign_date"]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadWorkOrderSignature(image, imageName: "\(self.item!.work_order_number)_company_rep_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                }
            }
            
            if let image2 = self.primarySignatureView.getCroppedSignature() {
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "work_order_id": self.item.id,
                                          "column_name": "primary_account_holder_signature",
                                          "date_column_name": "primary_account_holder_sign_date"]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadWorkOrderSignature(image2, imageName: "\(self.item!.work_order_number)_primary_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                }
            }
            
            if let image3 = self.secondarySignatureView.getCroppedSignature() {
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "work_order_id": self.item.id,
                                          "column_name": "secondary_account_holder_signature",
                                          "date_column_name": "secondary_account_holder_sign_date"]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadWorkOrderSignature(image3, imageName: "\(self.item!.work_order_number)_secondary_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                }
            }
            
            // photos
            for image in self.selectedImages {
                // enter group
                group.enter()
                
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "work_order_id": self.item.id]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadWorkOrderPhoto(image, imageName: "\(self.item!.work_order_number)_photo_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    group.leave()
                }
            }
            
            group.notify(queue: DispatchQueue.main, execute: {
                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                self.popViewController()
            })
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.section == 0 {
            return 136
        } else if indexPath.section == 2 {
            if indexPath.row == 0 {
                return 44
            }
            if indexPath.row == 10 {
                return 190
            }
            if self.groupItems.count >= indexPath.row {
                return 44
            }
            return 0
        } else if indexPath.section == 3 {
            if indexPath.row == 3 {
                return 77
            }
            return 60
        } else if indexPath.section == 4 {
            if indexPath.row == 3 || indexPath.row == 6 {
                return 136
            }
            return 60
        } else if indexPath.section == 5 {
            if indexPath.row == 0 {
                return 56
            }
            return 210
        } else if indexPath.section == 6 && indexPath.row == 0 {
            if selectedImages.count > 0 {
                return 200
            }
            return 0
        } else if indexPath.section == 7 {
            return 130
        }
        return 60
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        tableView.allowsSelection = false
        
        // init terms & conditions field
        headerField.text = item.header.isEmpty ? "This workorder agreement (the \"agreement \") is made as of \(App.shared.dateFormatter.string(from: Date())), by and between \(App.shared.company!.business_name), (the \"Company\") and the (\"Customer\") as the address shown below (the \"Premise/Monitored Location\")." : item.header
        headerField.font = UIFont.robotoFont(ofSize: 13)
        
        // init terms and conditions field
        termsAndConditionsField.text = item.terms_and_conditions.isEmpty ? "2. Install of the system. Company agrees to schedule and install an alarm system and/or devices in connection with a Monitoring Agreement which customer will receive at the time of installation. Customer hereby agrees to buy the system/devices described below and incorporated herein for all purposes by this reference (the \"System /Services\"), in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees.\n\n3. Customer agrees to have system maintained for an initial term of 60 months at the above monthly rate in exchange for a reduced cost of the system. Upon the execution of this agreement shall automatically start the billing process. Customer understands that the monthly payments must be paid through “Direct Billing” through their banking institution or credit card. Customers acknowledge that they authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd business day after the above date of this work order in writing. Customer agrees that no verbal method is valid, and must be submitted only in writing. The date on this agreement is the agreed upon date for both the Company and the Customer\n\n4. Client verifies that they are owners of the property listed above. In the event the system has to be removed, Client agrees and understands that there will be an additional $299.00 restocking/removal fee and early termination fees will apply.\n\n5. Client understands that this is a new Monitoring Agreement through our central station. Alarm.com or .net is not affiliated nor has any bearing on the current monitoring services currently or previously initiated by Client with other alarm companies. By signing this work order, Client agrees and understands that they have read the above requirements and would like to take advantage of our services. Client understand that is a binding agreement for both party.\n\n6. Customer agrees that the system is preprogramed for each specific location. accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees. Customer agrees that this is a customized order. By signing this workorder, customer agrees that customized order can not be cancelled after three day of this signed document." : item.terms_and_conditions
        termsAndConditionsField.font = UIFont.robotoFont(ofSize: 13)
        
        // init terms of use field
        termsOfUserField.text = item.terms_of_use.isEmpty ? "**This isn\'t everything... just a summary** You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You must make available to US in substantially as good condition as when received, any goods delivered to You under this contract or sale, You may, if You wish, comply with Our instructions regarding the return shipment of the goods at Your expense and risk. To cancel this transaction, mail deliver a signed and postmarket, dated copy of this Notice of Cancellation or any other written notice to ALarm Direct, Inc., 6866 Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}" : item.terms_of_use
        termsOfUserField.font = UIFont.robotoFont(ofSize: 13)
        
        // init job type
        jobTypeField.updateOptions(options: ["Install", "Inspection", "Repair", "Replace", "Sales", "Service"])
        jobTypeField.setSelectedOption(option: "Service")
        
        // init employee
        employeeField.updateOptions(options: Helpers.getEmployees())
        employeeField.setSelectedOption(option: item.employee_name)
        
        // init customer reminder
        customerReminderField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before", "2 hours before", "4 hours before", "6 hours before", "8 hours before", "12 hours before", "16 hours before", "1 day before", "2 days before", "On date of event"])
        customerReminderField.setSelectedOption(option: item.customer_reminder_notification)
        
        // init timezone
        timezoneField.updateOptions(options: ["Hawaii Time (UTC -10)", "Hawaii Daylight Time (UTC -9)", "Alaska Time (UTC -8)", "Pacific Time (UTC -7)", "Arizona Time (UTC -7)", "Mountain Time (UTC -6)", "Central Time (UTC -5)", "Eastern Time (UTC -4)"])
        timezoneField.setSelectedOption(option: item.timezone)
        
        // init status
        statusField.updateOptions(options: ["New", "Scheduled", "Started", "Paused" ,"Completed", "Invoiced", "Withdrawn", "Closed"])
        statusField.setSelectedOption(option: "New")
        
        // init priority
        priorityField.updateOptions(options: ["Emergency", "Low", "Standard", "Urgent"])
        priorityField.setSelectedOption(option: "Standard")
        
        // init dates
        endDateField.minimumDate = startDateField.date
        
        // init time
        let time = ["12:00 am", "12:30 am", "1:00 am", "1:30 am", "2:00 am", "2:30 am", "3:00 am", "3:30 am", "4:00 am", "4:30 am", "5:00 am", "5:30 am", "6:00 am", "6:30 am", "7:00 am", "7:30 am", "8:00 am", "8:30 am", "9:00 am", "9:30 am", "10:00 am", "10:30 am", "11:00 am", "11:30 am", "12:00 pm", "12:30 pm", "1:00 pm", "1:30 pm", "2:00 pm", "2:30 pm", "3:00 pm", "3:30 pm", "4:00 pm", "4:30 pm", "5:00 pm", "5:30 pm", "6:00 pm", "6:30 pm", "7:00 pm", "7:30 pm", "8:00 pm", "8:30 pm", "9:00 pm", "9:30 pm", "10:00 pm", "10:30 pm", "11:00 pm", "11:30 pm"]
        startTimeField.updateOptions(options: time)
        startTimeField.setSelectedOption(option: item.start_time)
        endTimeField.updateOptions(options: time)
        endTimeField.setSelectedOption(option: item.end_time)
        
        // init radioButtons
        defaultRadio.isMultipleSelectionEnabled = false
        defaultRadio.isSelected = true
        defaultRadio.otherButtons = [redRadio, pinkRadio, magentaRadio, purpleRadio, blueRadio, tealRadio, greenRadio, goldRadio]
        
        defaultRadio.tag    = 0
        redRadio.tag        = 1
        pinkRadio.tag       = 2
        magentaRadio.tag    = 3
        purpleRadio.tag     = 4
        blueRadio.tag       = 5
        tealRadio.tag       = 6
        greenRadio.tag      = 7
        goldRadio.tag       = 8
        
        // iterate radio to set checked
        let radios = [defaultRadio, redRadio, pinkRadio, magentaRadio, purpleRadio, blueRadio, tealRadio, greenRadio, goldRadio]
        var x = 0
        for radio in radios {
            // check
            radio?.isSelected = (item.event_color == EventColor.colors[x]) ? true : false
            // increment
            x+=1
        }
            
        // init remove buttons
        removeButton.tag = 0
        remove2Button.tag = 1
        remove3Button.tag = 2
        remove4Button.tag = 3
        remove5Button.tag = 4
        remove6Button.tag = 5
        remove7Button.tag = 6
        remove8Button.tag = 7
        remove9Button.tag = 8
        
        // init signature views
        companySignatureView.delegate      = self
        companySignatureView.strokeWidth   = 2
        companySignatureView.strokeColor   = .black
        primarySignatureView.delegate      = self
        primarySignatureView.strokeWidth   = 2
        primarySignatureView.strokeColor   = .black
        secondarySignatureView.delegate      = self
        secondarySignatureView.strokeWidth   = 2
        secondarySignatureView.strokeColor   = .black
    }
    
    func initiateItems() {
        // init labels
        let itemFields = [itemField, item2Field, item3Field, item4Field, item5Field, item6Field, item7Field, item8Field, item9Field]
        let qtyFields = [qtyField, qty2Field, qty3Field, qty4Field, qty5Field, qty6Field, qty7Field, qty8Field, qty9Field]
        let priceFields = [priceField, price2Field, price3Field, price4Field, price5Field, price6Field, price7Field, price8Field, price9Field]
        
        // init total
        var subTotal = 0.00
        var taxes = 0.00
        var grandTotal = 0.00
        
        // items
        // clear items
        self.groupItems.removeAll()
        // sort ungrouped
        let ungrouped = self.selectedItems.sorted(by: {$0.id > $1.id})
        // group
        let grouped = ungrouped.group(by: {$0.id})
        // iterate
        var i = 0
        for (key, value) in grouped {
            if let mItem = value.first {
                let qty     = value.count
                let price   = mItem.price.doubleValue
                let tax     = price * 0.075
                let total   = price * qty.doubleValue
                
                itemFields[i]?.text     = mItem.title
                qtyFields[i]?.text      = qty.stringValue
                priceFields[i]?.text    = "$\(price)"
                
                subTotal += total
                taxes += (tax * qty.doubleValue)
                grandTotal = subTotal + taxes
                
                self.groupItems.append([key: value])
                
                i+=1
            }
        }
        
        // update labels
        self.subTotal.text      = "$\(subTotal.rounded(toPlaces: 2))"
        self.taxes.text         = "$\(taxes.rounded(toPlaces: 2))"
        self.grandTotal.text    = "$\(grandTotal.rounded(toPlaces: 2))"

        // update tableView
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }

}

// MARK: - YPSignatureDelegate -

extension EditWorkOrderController: YPSignatureDelegate {
    
    func didStart(_ view: YPDrawSignatureView) {
        // check
        if view == companySignatureView {
            signLabel.isHidden = true
        } else if view == primarySignatureView {
            sign2Label.isHidden = true
        } else {
            sign3Label.isHidden = true
        }
    }
    
    func didFinish(_ view: YPDrawSignatureView) {
    }
    
    // MARK: - ACTIONS -
    
    @IBAction func clearButtonTapped(_ sender: Any) {
        companySignatureView.clear()
        signLabel.isHidden = false
    }
    
    @IBAction func clear2ButtonTapped(_ sender: Any) {
        primarySignatureView.clear()
        sign2Label.isHidden = false
    }
    
    @IBAction func clear3ButtonTapped(_ sender: Any) {
        secondarySignatureView.clear()
        sign3Label.isHidden = false
    }
}

// MARK: - TLPhotosPickerViewControllerDelegate -

extension EditWorkOrderController: TLPhotosPickerViewControllerDelegate {
     
    func presentImagePicker() {
        var selectedAssets = [TLPHAsset]()
        
        let viewController = TLPhotosPickerViewController(withTLPHAssets: { assets in
            selectedAssets = assets
            
            // iterate images
            for asset in assets {
                if let image = asset.fullResolutionImage {
                    self.selectedImages.append(image)
                    self.pagerView.reloadData()
                    self.pageControl.numberOfPages = self.selectedImages.count
                    
                    self.tableView.beginUpdates()
                    self.tableView.endUpdates()
                }
            }
            
        }, didCancel: nil)
        viewController.didExceedMaximumNumberOfSelection = { picker in
            //exceed max selection
            SVProgressHUD.showError(withStatus: "You can only upload up to 10 photos.")
        }
        viewController.selectedAssets = selectedAssets
        
        var configure = TLPhotosPickerConfigure()
        configure.numberOfColumn = 2
        configure.maxSelectedAssets = 10 - self.item.photos.count
        viewController.configure = configure
        
        self.present(viewController, animated: true, completion: nil)
    }
}

// MARK: - FSPagerViewDataSource & FSPagerViewDelegate -

extension EditWorkOrderController: FSPagerViewDataSource, FSPagerViewDelegate {
    
    // MARK:- FSPagerViewDataSource -
    
    func numberOfItems(in pagerView: FSPagerView) -> Int {
        return self.selectedImages.count
    }
    
    public func pagerView(_ pagerView: FSPagerView, cellForItemAt index: Int) -> FSPagerViewCell {
        let cell = pagerView.dequeueReusableCell(withReuseIdentifier: "cell", at: index)
        cell.imageView?.image = self.selectedImages[index]
        cell.imageView?.contentMode = .scaleAspectFill
        return cell
    }
    
    func pagerView(_ pagerView: FSPagerView, didSelectItemAt index: Int) {
        pagerView.deselectItem(at: index, animated: true)
    }
    
    // MARK:- FSPagerViewDelegate -
    
    func pagerViewWillEndDragging(_ pagerView: FSPagerView, targetIndex: Int) {
        self.pageControl.currentPage = targetIndex
    }
}

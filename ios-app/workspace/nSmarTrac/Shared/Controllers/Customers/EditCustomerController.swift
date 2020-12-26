//
//  EditCustomerController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class EditCustomerController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var customerTypeField: MaterialDropdownField!
    @IBOutlet var companyNameField: MaterialTextField!
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var mobileField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var streetField: MaterialTextField!
    @IBOutlet var unitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var birthdayField: MaterialDatePickerField!
    @IBOutlet var sourceField: MaterialTextField!
    @IBOutlet var groupField: MaterialTextField!
    @IBOutlet var commentsField: MaterialTextField!
    @IBOutlet var notifyByEmail: DLRadioButton!
    @IBOutlet var notifyBySMS: DLRadioButton!
    @IBOutlet var saveButton: DesignableButton!
    
    @IBOutlet var contactName: UILabel!
    @IBOutlet var btnRemove: UIButton!
    @IBOutlet var contactName2: UILabel!
    @IBOutlet var btnRemove2: UIButton!
    @IBOutlet var contactName3: UILabel!
    @IBOutlet var btnRemove3: UIButton!
    @IBOutlet var contactName4: UILabel!
    @IBOutlet var btnRemove4: UIButton!
    
    @IBOutlet var address: UILabel!
    @IBOutlet var btnRemoveAdd: UIButton!
    @IBOutlet var address2: UILabel!
    @IBOutlet var btnRemoveAdd2: UIButton!
    @IBOutlet var address3: UILabel!
    @IBOutlet var btnRemoveAdd3: UIButton!
    @IBOutlet var address4: UILabel!
    @IBOutlet var btnRemoveAdd4: UIButton!
    
    var item: Customer!
    var contacts: [MyContact] = []
    var addresses: [MyAddress] = []
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        loadData()
        
        self.navigationItem.title = "Edit Customer"
        self.navigationItem.backBarButtonItem = UIBarButtonItem(title: "", style: .plain, target: nil, action: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure checkbox
        notifyByEmail.configure(item.notify_email)
        notifyBySMS.configure(item.notify_sms)
        
        // configure dropdown
        customerTypeField.updateOptions(options: ["-select-", "Residential", "Commercial"])
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfield
        emailField.keyboardType = .emailAddress
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
        mobileField.delegate = self
        mobileField.keyboardType = .numberPad
        postalCodeField.keyboardType = .numberPad
        
        // init remove buttons
        btnRemove.tag = 0
        btnRemove2.tag = 1
        btnRemove3.tag = 2
        btnRemove4.tag = 3
        
        btnRemoveAdd.tag = 0
        btnRemoveAdd2.tag = 1
        btnRemoveAdd3.tag = 2
        btnRemoveAdd4.tag = 3
    }
    
    func initiateItems() {
        // init labels
        let contactFields = [contactName, contactName2, contactName3, contactName4]
        let addressFields = [address, address2, address3, address4]
        
        // iterate contacts
        var i = 0
        for item in contacts {
            contactFields[i]?.text  = item.name
            i+=1
        }
        
        // iterate addresses
        var j = 0
        for item in addresses {
            addressFields[j]?.text  = "\(item.address1) \(item.address2), \(item.city), \(item.state) \(item.postal_code)"
            j+=1
        }

        // update tableView
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    // MARK: - Load data -
    
    func loadData() {
        customerTypeField.setSelectedOption(option: item.customer_type)
        companyNameField.text   = item.company_name
        nameField.text          = item.contact_name
        emailField.text         = item.contact_email
        mobileField.text        = item.mobile
        phoneField.text         = item.phone
        birthdayField.date      = Date(fromString: item.birthday, format: DateHelper.dateFormatType) ?? Date()
        sourceField.text        = Helpers.getCustomerSourceById(item.source_id)?.name
        groupField.text         = Helpers.getCustomerGroupById(item.customer_group)?.name
        commentsField.text      = item.comments
        
        if let mAddress = item.address.first {
            streetField.text        = mAddress.address1
            unitField.text          = mAddress.address2
            cityField.text          = mAddress.city
            postalCodeField.text    = mAddress.postal_code
            stateField.text         = States.getStateName(mAddress.state)
        }
        
        notifyByEmail.isSelected    = item.notify_email
        notifyBySMS.isSelected      = item.notify_sms
        
        // iterate contacts
        for contact in item.contacts {
            let dictionary: [String: String] = ["name": contact.name,
                                                "email": contact.email,
                                                "phone": contact.phone,
                                                "mobile": contact.mobile,
                                                "notes": contact.notes]
            let myContact = MyContact.models(from: [dictionary])
            contacts.append(contentsOf: myContact)
        }
        
        // iterate addresses
        for address in item.address {
            let dictionary: [String: String] = ["address1": address.address1,
                                                "address2": address.address2,
                                                "city": address.city,
                                                "state": address.state,
                                                "postal_code": address.postal_code,
                                                "contact_name": address.contact_name,
                                                "email": address.email,
                                                "phone": address.phone,
                                                "mobile": address.mobile,
                                                "notes": address.notes]
            let myAddress = MyAddress.models(from: [dictionary])
            addresses.append(contentsOf: myAddress)
        }
        
        // check
        if self.addresses.count > 0 {
            self.addresses.remove(at: 0)
        }
        
        
        self.initiateItems()
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.section == 1 {
            return 88
        } else if indexPath.section == 2 {
            if indexPath.row == 4 {
                return 44
            }
            if contacts.count > indexPath.row {
                return 44
            }
            return 0
        } else if indexPath.section == 4 {
            if indexPath.row == 4 {
                return 44
            }
            if addresses.count > indexPath.row {
                return 44
            }
            return 0
        } else if indexPath.section == 6 {
            return 130
        }
        return 60
    }
    
    // MARK: - Actions -
    
    @IBAction func addContactButtonTapped(_ sender: Any) {
        guard contacts.count < 4 else {
            return
        }
        
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddOtherContactController")  as? AddOtherContactController {
            vc.callback = { items in
                self.contacts.append(contentsOf: items)
                self.initiateItems()
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func addServiceAddressButtonTapped(_ sender: Any) {
        guard addresses.count < 4 else {
            return
        }
        
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddOtherAddressController")  as? AddOtherAddressController {
            vc.callback = { items in
                self.addresses.append(contentsOf: items)
                self.initiateItems()
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func removeContactButtonTapped(_ sender: Any) {
        let tag = (sender as! UIButton).tag
        self.contacts.remove(at: tag)
        self.initiateItems()
    }
    
    @IBAction func removeAddressButtonTapped(_ sender: Any) {
        let tag = (sender as! UIButton).tag
        self.addresses.remove(at: tag)
        self.initiateItems()
    }
    
    @IBAction func selectSourceButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCustomerSourceController")  as? SelectCustomerSourceController {
            vc.callback = { result in
                self.sourceField.text = result.name
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func selectGroupButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCustomerGroupController")  as? SelectCustomerGroupController {
            vc.callback = { result in
                self.groupField.text = result.name
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let customer: Parameters = ["company_id": App.shared.companyId,
                                    "customer_type": customerTypeField.text!,
                                    "company_name": companyNameField.text!,
                                    "contact_name": nameField.text!,
                                    "contact_email": emailField.text!,
                                    "mobile": mobileField.text!,
                                    "phone": phoneField.text!,
                                    "notify_email": notifyByEmail.isSelected,
                                    "notify_sms": notifyBySMS.isSelected,
                                    "birthday": App.shared.dateFormatter.string(from: birthdayField.date),
                                    "customer_group": Helpers.getCustomerGroupId(groupField.text!),
                                    "source_id": Helpers.getCustomerSourceId(sourceField.text!),
                                    "comments": commentsField.text!]
        
        // add main address to the array
        let dictionary: [String: String] = ["address1": self.streetField.text!,
                                            "address2": self.unitField.text!,
                                            "city": self.cityField.text!,
                                            "state": States.getStateCode(self.stateField.text!),
                                            "postal_code": self.postalCodeField.text!,
                                            "contact_name": self.nameField.text!,
                                            "email": self.emailField.text!,
                                            "phone": self.phoneField.text!,
                                            "mobile": self.mobileField.text!,
                                            "notes": ""]
        let myAddress = MyAddress.models(from: [dictionary])
        self.addresses.insert(contentsOf: myAddress, at: 0)
        
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putCustomer(item.id.intValue, params: customer, flag: "DELETE_OTHERS") { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            // create group
            let group = DispatchGroup()
            
            // add additional contacts
            for contact in self.contacts {
                // enter group
                group.enter()
                
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "name": contact.name,
                                          "email": contact.email,
                                          "phone": contact.phone,
                                          "mobile": contact.mobile,
                                          "notes": contact.notes,
                                          "customer_id": self.item.id]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postContact(params) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
            }
            
            // add address
            for item in self.addresses {
                // enter group
                group.enter()
                // add address
                // object to dictionary
                var address = item.toJSON()
                address["customer_id"] = self.item.id
                
                App.shared.api.postAddress(address) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
            }
            
            group.notify(queue: DispatchQueue.main, execute: {
                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                self.popViewController()
            })
        }
    }

}

// MARK: - UITextFieldDelegate -

extension EditCustomerController: UITextFieldDelegate {
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        // check
        if textField == phoneField || textField == mobileField {
            // formatter
            let formatter = DefaultTextInputFormatter(textPattern: "(###) ###-####")
            let result = formatter.formatInput(currentText: textField.text!, range: range, replacementString: string)
            textField.text = result.formattedText
            
            return false
        }
        
        return true
    }
}

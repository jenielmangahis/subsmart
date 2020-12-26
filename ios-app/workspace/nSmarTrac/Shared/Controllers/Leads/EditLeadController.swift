//
//  EditLeadController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class EditLeadController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var customerTypeField: MaterialDropdownField!
    @IBOutlet var companyNameField: MaterialTextField!
    @IBOutlet var contactNameField: MaterialTextField!
    @IBOutlet var contactEmailField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var streetField: MaterialTextField!
    @IBOutlet var unitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var sourceField: MaterialDropdownField!
    @IBOutlet var commentsField: MaterialTextField!
    @IBOutlet var notifyByEmail: DLRadioButton!
    @IBOutlet var notifyBySMS: DLRadioButton!
    @IBOutlet var saveButton: DesignableButton!
    
    var item: Lead!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
            
        self.title = "Edit Lead"
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
        notifyByEmail.configure()
        notifyBySMS.configure()
        
        // configure dropdown
        customerTypeField.updateOptions(options: ["Residential", "Commercial"])
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfield
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
    }
    
    // MARK: - Load data -
    
    func loadData() {
        customerTypeField.setSelectedOption(option: item.customer_type)
        companyNameField.text   = item.company_name
        contactNameField.text   = item.contact_name
        contactEmailField.text  = item.contact_email
        phoneField.text         = item.phone
        streetField.text        = item.street_address
        unitField.text          = item.suite_unit
        cityField.text          = item.city
        postalCodeField.text    = item.postal_code
        stateField.text         = item.state
        sourceField.text        = item.source
        commentsField.text      = item.comments
        
        notifyByEmail.isSelected    = item.notify_sms
        notifyBySMS.isSelected      = item.notify_sms
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "customer_type": customerTypeField.text!,
                                  "company_name": companyNameField.text!,
                                  "contact_name": contactNameField.text!,
                                  "contact_email": contactEmailField.text!,
                                  "phone": phoneField.text!,
                                  "street_address": streetField.text!,
                                  "suite_unit": unitField.text!,
                                  "city": cityField.text!,
                                  "postal_code": postalCodeField.text!,
                                  "state": States.getStateCode(stateField.text!),
                                  "source": sourceField.text!,
                                  "comments": commentsField.text!,
                                  "notify_email": notifyByEmail.isSelected,
                                  "notify_sms": notifyBySMS.isSelected]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putLead(item.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }

}

// MARK: - UITextFieldDelegate -

extension EditLeadController: UITextFieldDelegate {
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        // check
        if textField == phoneField {
            // formatter
            let formatter = DefaultTextInputFormatter(textPattern: "(###) ###-####")
            let result = formatter.formatInput(currentText: textField.text!, range: range, replacementString: string)
            textField.text = result.formattedText
            
            return false
        }
        
        return true
    }
}

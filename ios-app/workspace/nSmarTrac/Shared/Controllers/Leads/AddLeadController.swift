//
//  AddLeadController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class AddLeadController: UITableViewController {
    
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
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
            
        self.title = "New Lead"
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
                                  "notify_sms": notifyBySMS.isSelected,
                                  "type": "Manual Entry",
                                  "status": "New"]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postLead(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }
    
}

// MARK: - UITextFieldDelegate -

extension AddLeadController: UITextFieldDelegate {
    
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

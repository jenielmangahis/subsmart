//
//  AddItemVendorController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import RxSwift
import RxCocoa
import SVProgressHUD

class AddItemVendorController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var mobileField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var streetField: MaterialTextField!
    @IBOutlet var unitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var submitButton: DesignableButton!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
            
        self.title = "Add Vendor"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure dropdown
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfield
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
        mobileField.delegate = self
        mobileField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func submitButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "vendor_name": nameField.text!,
                                  "email": emailField.text!,
                                  "mobile": mobileField.text!,
                                  "phone": phoneField.text!,
                                  "street_address": streetField.text!,
                                  "suite_unit": unitField.text!,
                                  "city": cityField.text!,
                                  "postal_code": postalCodeField.text!,
                                  "state": States.getStateCode(stateField.text!)]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postVendor(params) { (result, error) in
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

extension AddItemVendorController: UITextFieldDelegate {
    
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

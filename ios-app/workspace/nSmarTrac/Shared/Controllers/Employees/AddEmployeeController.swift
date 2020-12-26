//
//  AddEmployeeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 22/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class AddEmployeeController: UITableViewController {

    // MARK: - Properties -

    @IBOutlet var firstNameField: MaterialTextField!
    @IBOutlet var lastNameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var usernameField: MaterialTextField!
    @IBOutlet var passwordField: MaterialTextField!
    @IBOutlet var confirmPasswordField: MaterialTextField!
    @IBOutlet var roleField: MaterialDropdownField!
    @IBOutlet var appAccess: DLRadioButton!
    @IBOutlet var webAccess: DLRadioButton!
    @IBOutlet var aboutField: MaterialTextField!
    @IBOutlet var notesField: MaterialTextField!
    @IBOutlet var notifyByEmail: DLRadioButton!
    @IBOutlet var notifyBySMS: DLRadioButton!
    @IBOutlet var employmentTypeField: MaterialDropdownField!
    @IBOutlet var birthdateField: MaterialDatePickerField!
    @IBOutlet var dateHiredField: MaterialDatePickerField!
    @IBOutlet var payTypeField: MaterialDropdownField!
    @IBOutlet var payRateField: MaterialTextField!
    @IBOutlet var travelRateField: MaterialTextField!
    @IBOutlet var streetField: MaterialTextField!
    @IBOutlet var unitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var submitButton: DesignableButton!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Add Employee"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure checkbox
        appAccess.configure()
        webAccess.configure()
        notifyByEmail.configure()
        notifyBySMS.configure()
        
        // configure dropdown
        roleField.updateOptions(options: Helpers.getRoles())
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfield
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -
    
    @IBAction func uploadButtonTapped(_ sender: Any) {
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let user: Parameters = ["FName": firstNameField.text!,
                                "LName": lastNameField.text!,
                                "email": emailField.text!,
                                "username": usernameField.text!,
                                "password": "",
                                "password_plain": passwordField.text!,
                                "role": Helpers.getRoleId(roleField.text!),
                                "status": 1,
                                "about": aboutField.text!,
                                "comments": notesField.text!,
                                "notify_email": notifyByEmail.isSelected,
                                "notify_sms": notifyBySMS.isSelected,
                                "employment_type": employmentTypeField.text!,
                                "birthdate": App.shared.dateFormatter.string(from: birthdateField.date),
                                "date_hired": App.shared.dateFormatter.string(from: dateHiredField.date),
                                "pay_type": payTypeField.text!,
                                "pay_rate": payRateField.text!,
                                "travel_rate": travelRateField.text!,
                                "company_id": App.shared.companyId,
                                "profile_img": ""]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postUser(user) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
                
            // id
            if let id = result?.Data {
                
                let address: Parameters = ["address1": self.streetField.text!,
                                           "address2": self.unitField.text!,
                                           "city": self.cityField.text!,
                                           "state": States.getStateCode(self.stateField.text!),
                                           "postal_code": self.postalCodeField.text!,
                                           "contact_name": self.firstNameField.text! + " " + self.lastNameField.text!,
                                           "email": self.emailField.text!,
                                           "phone": self.phoneField.text!,
                                           "notes": "",
                                           "user_id": id]
                
                let phone: Parameters = ["number": self.phoneField.text!,
                                         "user_id": id]
                
                // create group
                let group = DispatchGroup()
                
                group.enter()
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postAddress(address) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
                
                group.enter()
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postPhone(phone) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
                
                group.notify(queue: DispatchQueue.main, execute: {
                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                    self.popViewController()
                })
            }
        }
    }
    
}

// MARK: - UITextFieldDelegate -

extension AddEmployeeController: UITextFieldDelegate {
    
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

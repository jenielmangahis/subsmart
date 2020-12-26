//
//  EditEmployeeController.swift
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

class EditEmployeeController: UITableViewController {

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
    
    var item: User!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Edit Employee"
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
        roleField.setSelectedOption(option: Helpers.getRoleById(item.role)?.title)
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfield
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
    }
    
    // MARK: - Load data -
    
    func loadData() {
        firstNameField.text         = item.FName
        lastNameField.text          = item.LName
        emailField.text             = item.email
        phoneField.text             = item.phone.first?.number
        usernameField.text          = item.username
        passwordField.text          = ""
        confirmPasswordField.text   = ""
        roleField.text              = Helpers.getRoleById(item.role)?.title
        aboutField.text             = item.about
        notesField.text             = item.comments
        employmentTypeField.text    = item.employment_type
        birthdateField.date         = Date(fromString: item.birthdate, format: DateHelper.dateFormatType) ?? Date()
        dateHiredField.date         = Date(fromString: item.date_hired, format: DateHelper.dateFormatType) ?? Date()
        payTypeField.text           = item.pay_type
        payRateField.text           = item.pay_rate
        travelRateField.text        = item.travel_rate
        
        streetField.text            = item.address.first?.address1
        unitField.text              = item.address.first?.address2
        cityField.text              = item.address.first?.city
        postalCodeField.text        = item.address.first?.postal_code
        stateField.text             = States.getStateName(item.address.first?.state)
        
        notifyByEmail.isSelected    = item.notify_email
        notifyBySMS.isSelected      = item.notify_sms
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
                                "role": item.role,
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
        
        let address: Parameters = ["address_id": item.address.first?.address_id ?? 0,
                                   "address1": streetField.text!,
                                   "address2": unitField.text!,
                                   "city": cityField.text!,
                                   "state": States.getStateCode(stateField.text!),
                                   "postal_code": postalCodeField.text!,
                                   "contact_name": firstNameField.text! + " " + lastNameField.text!,
                                   "email": emailField.text!,
                                   "phone": phoneField.text!,
                                   "notes": ""]
        
        let phone: Parameters = ["phone_id": item.phone.first?.phone_id ?? 0,
                                 "number": phoneField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putUser(item.id.intValue, params: user) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            // check
            if let mAddress = self.item.address.first {
                App.shared.api.putAddress(mAddress.address_id.intValue, params: address) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                }
            }
            
            // check
            if let mPhone = self.item.phone.first {
                App.shared.api.putAddress(mPhone.phone_id.intValue, params: phone) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                }
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }

}

// MARK: - UITextFieldDelegate -

extension EditEmployeeController: UITextFieldDelegate {
    
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

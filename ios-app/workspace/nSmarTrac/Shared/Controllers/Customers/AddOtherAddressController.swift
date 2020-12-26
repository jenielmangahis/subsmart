//
//  AddOtherAddressController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import ObjectMapper
import RxSwift
import RxCocoa
import SVProgressHUD

class AddOtherAddressController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var streetField: MaterialTextField!
    @IBOutlet var unitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var mobileField: MaterialTextField!
    @IBOutlet var notesField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
    var callback: (([MyAddress]) -> Void)?
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        
        self.title = "Add Other Address"
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
        emailField.keyboardType = .emailAddress
        phoneField.delegate = self
        phoneField.keyboardType = .numberPad
        mobileField.delegate = self
        mobileField.keyboardType = .numberPad
        postalCodeField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // init dictionary
        let dictionary: [String: String] = ["address1": streetField.text!,
                                            "address2": unitField.text!,
                                            "city": cityField.text!,
                                            "state": States.getStateCode(stateField.text!),
                                            "postal_code": postalCodeField.text!,
                                            "contact_name": nameField.text!,
                                            "email": emailField.text!,
                                            "phone": phoneField.text!,
                                            "mobile": mobileField.text!,
                                            "notes": notesField.text!]
        let myAddress = MyAddress.models(from: [dictionary])
        self.callback!(myAddress)
        self.navigationController?.popViewController(animated: true)
    }

}

// MARK: - UITextFieldDelegate -

extension AddOtherAddressController: UITextFieldDelegate {
    
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

// MARK: - Object -

class MyAddress: Mappable {
    var address1: String = ""
    var address2: String = ""
    var city: String = ""
    var state: String = ""
    var postal_code: String = ""
    var contact_name: String = ""
    var email: String = ""
    var phone: String = ""
    var mobile: String = ""
    var notes: String = ""
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        address1        <- map["address1"]
        address2        <- map["address2"]
        city            <- map["city"]
        postal_code     <- map["postal_code"]
        state           <- map["state"]
        contact_name    <- map["contact_name"]
        email           <- map["email"]
        phone           <- map["phone"]
        mobile          <- map["mobile"]
        notes           <- map["notes"]
    }
}

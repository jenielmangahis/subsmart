//
//  AddOtherContactController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import ObjectMapper
import RxSwift
import RxCocoa
import SVProgressHUD

class AddOtherContactController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var mobileField: MaterialTextField!
    @IBOutlet var notesField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
    var callback: (([MyContact]) -> Void)?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        
        self.title = "New Contact"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure textfield
        emailField.keyboardType = .emailAddress
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
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // init dictionary
        let dictionary: [String: String] = ["name": nameField.text!,
                                            "email": emailField.text!,
                                            "phone": phoneField.text!,
                                            "mobile": mobileField.text!,
                                            "notes": notesField.text!]
        let myContact = MyContact.models(from: [dictionary])
        self.callback!(myContact)
        self.navigationController?.popViewController(animated: true)
    }

}

// MARK: - UITextFieldDelegate -

extension AddOtherContactController: UITextFieldDelegate {
    
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

class MyContact: Mappable {
    
    var name: String = ""
    var email: String = ""
    var phone: String = ""
    var mobile: String = ""
    var notes: String = ""
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        name    <- map["name"]
        email   <- map["email"]
        phone   <- map["phone"]
        mobile  <- map["mobile"]
        notes   <- map["notes"]
    }
}

//
//  EditContactController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import RxSwift
import RxCocoa
import SVProgressHUD

class EditContactController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var phoneField: MaterialTextField!
    @IBOutlet var mobileField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    @IBOutlet var cancelButton: DesignableButton!
    
    var item: Contact!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        self.title = "Edit Contact"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        nameField.text      = item.name
        emailField.text     = item.email
        phoneField.text     = item.phone
        mobileField.text    = item.mobile
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "name": nameField.text!,
                                  "email": emailField.text!,
                                  "phone": phoneField.text!,
                                  "mobile": mobileField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putContact(item.id.intValue, params: params) { (success, error) in
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

extension EditContactController: UITextFieldDelegate {
    
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

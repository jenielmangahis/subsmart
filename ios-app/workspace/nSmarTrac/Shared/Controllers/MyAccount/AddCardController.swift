//
//  AddCardController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 19/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import SVProgressHUD

class AddCardController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var cardHolderField: MaterialTextField!
    @IBOutlet var cardNumberField: MaterialTextField!
    @IBOutlet var expirationField: MaterialTextField!
    @IBOutlet var cvvField: MaterialTextField!
    @IBOutlet var btnSetAsDefault: DLRadioButton!
    @IBOutlet var saveButton: DesignableButton!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
            
        self.title = "Add New Card"
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
        btnSetAsDefault.configure()
        
        // configure textfields
        cardNumberField.delegate = self
        cardNumberField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "card_holder": cardHolderField.text!,
                                  "card_number": cardNumberField.text!,
                                  "expiration": expirationField.text!,
                                  "cvv": cvvField.text!,
                                  "is_default": btnSetAsDefault.isSelected]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postCard(params) { (result, error) in
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

extension AddCardController: UITextFieldDelegate {
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        // check
        if textField == cardNumberField {
            // formatter
            let formatter = DefaultTextInputFormatter(textPattern: "XXXX XXXX XXXX XXXX", patternSymbol: "X")
            let result = formatter.formatInput(currentText: textField.text!, range: range, replacementString: string)
            textField.text = result.formattedText
            
            return false
        }
        
        return true
    }
}

//
//  AccountDetailsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 02/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AccountDetailsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var passwordField: MaterialTextField!
    
    let user = App.shared.user!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init
        emailField.text     = user.email
        passwordField.text  = user.password
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.parent?.navigationItem.title = "Account Details"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["email": emailField.text!,
                                  "password": "",
                                  "password_plain": passwordField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putUser(user.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
        }
    }

}

//
//  AttoInviteMemberController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoInviteMemberController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var emailField: MaterialTextField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func createLinkButtonTapped(_ sender: Any) {
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["email": emailField.text!,
                                  "role": "Employee",
                                  "company_id": App.shared.companyId,
                                  "status": 0,
                                  "sender": App.shared.user!.full_name,
                                  "company_name": App.shared.company!.business_name]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postTimesheetTeamMember(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            self.popViewController()
        }
    }
    
}

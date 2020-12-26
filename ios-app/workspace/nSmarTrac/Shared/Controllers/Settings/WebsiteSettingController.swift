//
//  WebsiteSettingController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import SVProgressHUD

class WebsiteSettingController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var linkField: MaterialTextField!
    @IBOutlet var submitButton: DesignableButton!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
            
        self.title = "Website URL"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // load link
        if let link = UserDefaults.standard.string(forKey: "WEBSITE_URL") {
            linkField.text = link
        }
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func submitButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        UserDefaults.standard.set(linkField.text!, forKey: "WEBSITE_URL")
        UserDefaults.standard.synchronize()
        SVProgressHUD.showSuccess(withStatus: "Saved!")
    }
    
}

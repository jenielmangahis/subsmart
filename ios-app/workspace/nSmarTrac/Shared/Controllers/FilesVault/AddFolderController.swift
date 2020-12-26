//
//  AddFolderController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 30/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AddFolderController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var descriptionField: MaterialTextField!
    
    var parentFolder: Folder!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Add Folder"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
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
        
        let params: Parameters = ["folder_name": nameField.text!,
                                  "description": descriptionField.text!,
                                  "path": "/\(nameField.text!)/",
                                  "parent_id": (parentFolder ==  nil) ? 0 : parentFolder.folder_id,
                                  "created_by": App.shared.user?.id ?? 0,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postFolder(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
                
            SVProgressHUD.showSuccess(withStatus: "Folder has been created!")
            self.popViewController()
        }
    }

}

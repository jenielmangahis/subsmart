//
//  ESignOtherSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class ESignOtherSettingsController: UITableViewController {
    
    // MARK: - Properties -
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.title = "eSign Settings"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        
        let identifier = ["sb_ESignDateFormatController", "sb_ESignCloudStorageController"]
        self.pushTo(storyBoard: "Settings", identifier: identifier[indexPath.row])
    }

}

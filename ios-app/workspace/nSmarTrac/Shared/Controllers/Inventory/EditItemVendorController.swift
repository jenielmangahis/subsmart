//
//  EditItemVendorController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EditItemVendorController: UITableViewController {
    
    // MARK: - Properties -
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
            
        self.title = "Edit Vendor"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

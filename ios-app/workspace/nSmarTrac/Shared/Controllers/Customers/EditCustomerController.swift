//
//  EditCustomerController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EditCustomerController: UITableViewController {
    
    // MARK: - Properties -
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.navigationItem.title = "Edit Customer"
        self.navigationItem.backBarButtonItem = UIBarButtonItem(title: "", style: .plain, target: nil, action: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

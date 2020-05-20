//
//  AddCustomerController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton

class AddCustomerController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var notifyByEmail: DLRadioButton!
    @IBOutlet var notifyBySMS: DLRadioButton!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        Utils.configureCheckbox(notifyByEmail, "Notify by Email")
        Utils.configureCheckbox(notifyBySMS, "Notify by SMS")
        
        self.navigationItem.title = "New Customer"
        self.navigationItem.backBarButtonItem = UIBarButtonItem(title: "", style: .plain, target: nil, action: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

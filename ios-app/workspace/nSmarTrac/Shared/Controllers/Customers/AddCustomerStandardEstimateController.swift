//
//  AddCustomerStandardEstimateController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AddCustomerStandardEstimateController: UITableViewController {
    
    // MARK: - Properties -
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.title = "New Estimate"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

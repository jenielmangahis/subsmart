//
//  AddLeadController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AddLeadController: UITableViewController {
    
    // MARK: - Properties -
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
            
        self.title = "New Lead"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

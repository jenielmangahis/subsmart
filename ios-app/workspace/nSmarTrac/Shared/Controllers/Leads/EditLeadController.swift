//
//  EditLeadController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EditLeadController: UITableViewController {
    
    // MARK: - Properties -
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
            
        self.title = "Edit Lead"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

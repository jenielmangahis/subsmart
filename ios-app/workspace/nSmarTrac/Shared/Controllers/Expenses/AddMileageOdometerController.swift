//
//  AddMileageOdometerController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AddMileageOdometerController: UITableViewController {

    // MARK: - Properties -



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Record Expense"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

//
//  EditWorkOrderController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EditWorkOrderController: UITableViewController {

    // MARK: - Properties -



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Edit Work Order"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

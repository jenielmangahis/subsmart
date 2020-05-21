//
//  EditInvoiceController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 20/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EditInvoiceController: UITableViewController {

    // MARK: - Properties -



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Edit Invoice"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

//
//  AddExpenseCategoryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AddExpenseCategoryController: UITableViewController {
    
    // MARK: - Properties -
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
            
        self.title = "Add Expense Category"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

//
//  WorkOrderFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class WorkOrderFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var filterField: MaterialDropdownField!
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Work Order"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        filterField.updateOptions(options: ["All", "New", "Scheduled", "Started", "Paused", "Completed", "Invoiced", "Withdrawn", "Closed"])
        sortField.updateOptions(options: ["Date Issued: Newest First", "Date Issues: Oldest First", "Scheduled Date: Newest First", "Scheduled Date: Oldest First", "Completed Date: Newest First", "Completed Date: Oldest First", "Job: A-Z", "Job: Z-A", "Work Order #: A-Z", "Work Order #: Z-A", "Priority: A-Z", "Priority: Z-A"])
    }

}

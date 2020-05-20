//
//  LeadsFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class LeadsFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var filterField: MaterialDropdownField!
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Leads"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        filterField.updateOptions(options: ["All", "New", "Converted", "Closed", "Contacted", "Follow Up", "Assigned"])
        sortField.updateOptions(options: ["Date: Newest First", "Date: Oldest First", "Name: A-Z", "Name: Z-A", "Source: A-Z", "Source: Z-A"])
    }

}

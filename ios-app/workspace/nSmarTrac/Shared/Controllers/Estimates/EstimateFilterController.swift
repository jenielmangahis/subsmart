//
//  EstimateFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EstimateFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var filterField: MaterialDropdownField!
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Estimate"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        filterField.updateOptions(options: ["All", "Submitted", "Accepted", "Lost", "Declined by Customer", "Invoiced", "Draft"])
        sortField.updateOptions(options: ["Newest First", "Oldest First", "Accepted: Newest First", "Accepted: Oldest First", "Number: Ascending", "Number: Descending", "Amount: Lowest", "Amount: Highest"])
    }

}

//
//  InvoiceFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 20/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class InvoiceFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var filterField: MaterialDropdownField!
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Invoice"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        filterField.updateOptions(options: ["All", "Due", "Overdue", "Paid", "Draft", "Partially Paid"])
        sortField.updateOptions(options: ["Newest First", "Oldest First", "Number: Ascending", "Number: Descending", "Amount: Lowest", "Amount: Highest"])
    }

}

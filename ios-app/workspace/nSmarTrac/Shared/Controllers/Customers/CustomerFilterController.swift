//
//  CustomerFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class CustomerFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var filterField: MaterialDropdownField!
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Customer"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        filterField.updateOptions(options: ["All", "Residential", "Commercial"])
        sortField.updateOptions(options: ["Name: A-Z", "Name: Z-A", "Last Name: A-Z", "Last Name: Z-A", "Email: A-Z", "Email: Z-A"])
    }

}

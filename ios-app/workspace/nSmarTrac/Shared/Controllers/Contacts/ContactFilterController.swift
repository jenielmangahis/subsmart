//
//  ContactFilterController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class ContactFilterController: UITableViewController {
    
    // MARK: - Properties -
    @IBOutlet var sortField: MaterialDropdownField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        
        self.title = "Filter Contact"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        sortField.updateOptions(options: ["Name: A-Z", "Name: Z-A", "Last Name: A-Z", "Last Name: Z-A", "Email: A-Z", "Email: Z-A"])
    }

}

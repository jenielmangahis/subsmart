//
//  AttoPTODetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 30/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AttoPTODetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
    }
}

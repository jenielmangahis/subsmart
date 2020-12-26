//
//  EditTimeEntryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 22/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton

class EditTimeEntryController: UITableViewController {
    
    // MARK: - Properties -
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        
    }
    
    // MARK: - Actions -
    
    @IBAction func workHoursButtonTapped(_ sender: Any) {
    }
    
    @IBAction func ptoButtonTapped(_ sender: Any) {
    }
    
    @IBAction func addBreakButtonTapped(_ sender: Any) {
    }
    
    @IBAction func addAnotherBreakButtonTapped(_ sender: Any) {
    }
    
    @IBAction func editEntryButtonTapped(_ sender: Any) {
    }

}

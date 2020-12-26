//
//  AttoBreakRuleController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 30/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton

class AttoBreakRuleController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var manualButton: DLRadioButton!
    @IBOutlet var automaticButton: DLRadioButton!
    
    var callback: ((String) -> Void)?
    

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
        // configure radio
        manualButton.otherButtons = [automaticButton]
        manualButton.configureRadio(true)
        automaticButton.configureRadio()
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func selectButtonTapped(_ sender: Any) {
        let selected = manualButton.isSelected ? "Manual" : "Automatic"
        self.callback!(selected)
        self.dismiss(animated: true, completion: nil)
    }

}

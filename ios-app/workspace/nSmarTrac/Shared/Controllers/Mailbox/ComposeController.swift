//
//  ComposeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class ComposeController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var toField: MaterialTextField!
    @IBOutlet var fromField: MaterialTextField!
    @IBOutlet var subjectField: MaterialTextField!
    @IBOutlet var messageField: UITextView!
    @IBOutlet var sendButton: UIButton!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        toField.dividerNormalColor      = .clear
        toField.dividerActiveColor      = .clear
        fromField.dividerNormalColor    = .clear
        fromField.dividerActiveColor    = .clear
        subjectField.dividerNormalColor = .clear
        subjectField.dividerActiveColor = .clear
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // AMRK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
    }
    
}

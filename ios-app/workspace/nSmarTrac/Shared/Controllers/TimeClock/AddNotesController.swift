//
//  AddNotesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AddNotesController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var noteField: UITextView!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions
    
    @IBAction func addNoteButtonTapped(_ sender: Any) {
    }

}

//
//  PaymentController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class PaymentController: UIViewController {
    
    // MARK: - Properties -
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Invoice Payment"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func recordButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Main", identifier: "sb_RecordPaymentController")
    }
    
}

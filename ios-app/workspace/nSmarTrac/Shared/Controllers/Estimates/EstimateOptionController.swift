//
//  EstimateOptionController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class EstimateOptionController: UIViewController {

    
    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func closeButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func addStandardEstimateButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: {
            NotificationCenter.default.post(name: Notifications.willAddStandardEstimates, object: self, userInfo: nil)
        })
    }
    
    @IBAction func addOptionsEstimateButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: {
            NotificationCenter.default.post(name: Notifications.willAddOptionsEstimates, object: self, userInfo: nil)
        })
    }

}

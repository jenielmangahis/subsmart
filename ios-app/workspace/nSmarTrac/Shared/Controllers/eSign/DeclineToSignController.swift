//
//  DeclineToSignController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 19/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class DeclineToSignController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var textLabel: UILabel!
    @IBOutlet var reasonField: UITextView!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Decline To Sign"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func declineButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }

}

//
//  UserActivityForInactiveController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/19/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import EzPopup

class UserActivityForInactiveController: UIViewController {
    
    // MARK: - Properties -
    
    var item: TimesheetTeamMember!
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // init
        self.title = item.name
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func clockInButtonTapped(_ sender: Any) {
        let viewController = ManualClockInController.initFromNib()
        viewController.item = item
        let popup = PopupViewController(contentController: viewController, popupWidth: Device.width-60, popupHeight: 457)
        popup.cornerRadius = 10
        popup.canTapOutsideToDismiss = false
        self.present(popup, animated: true, completion: nil)
    }
    
}

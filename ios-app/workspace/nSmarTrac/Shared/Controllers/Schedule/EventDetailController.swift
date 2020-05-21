//
//  EventDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class EventDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var calendarIcon: UIImageView!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure icons
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarDay, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

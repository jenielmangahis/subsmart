//
//  BlockDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class BlockDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    @IBOutlet var blockIcon: UIImageView!
    @IBOutlet var calendarIcon: UIImageView!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        blockIcon.image = UIImage.fontAwesomeIcon(name: .ban, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarDay, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        
        // set title
        self.navigationItem.title = "Schedule Details"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

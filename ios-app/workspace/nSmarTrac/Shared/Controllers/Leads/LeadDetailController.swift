//
//  LeadDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class LeadDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    @IBOutlet var nameIcon: UIImageView!
    @IBOutlet var emailIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    @IBOutlet var emailNotifyIcon: UIImageView!
    @IBOutlet var smsNotifyIcon: UIImageView!
    
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var mobileLabel: UILabel!
    @IBOutlet var typeLabel: UILabel!
    @IBOutlet var bookedOnLabel: UILabel!
    @IBOutlet var leadSourceLabel: UILabel!
    @IBOutlet var emailNotifyLabel: UILabel!
    @IBOutlet var smsNotifyLabel: UILabel!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        nameIcon.image = UIImage.fontAwesomeIcon(name: .tag, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailNotifyIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        smsNotifyIcon.image = UIImage.fontAwesomeIcon(name: .sms, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        
        // set title
        self.navigationItem.title = "Lead Detail"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

//
//  InvoiceDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 20/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import Kingfisher

class InvoiceDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var moreBarButton: UIBarButtonItem!
    @IBOutlet var customerLogo: UIImageView!
    @IBOutlet var phoneIcon: UIImageView!
    @IBOutlet var emailToIcon: UIImageView!
    @IBOutlet var phoneToIcon: UIImageView!
    @IBOutlet var mobileToIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // set title
        self.navigationItem.title = "#INV-000525"
        
        // configure navBar icons
        moreBarButton.image = UIImage.fontAwesomeIcon(name: .ellipsisV, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        phoneIcon.image = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailToIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        phoneToIcon.image = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        mobileToIcon.image = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        
        // configure logo
        customerLogo.kf.setImage(with: URL(string: "https://www.markate.com/cdn/20200131/avatar_14356_2efeea8595_md.jpg"))
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

//
//  WorkOrderDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import Kingfisher

class WorkOrderDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    
    @IBOutlet var calendarIcon: UIImageView!
    @IBOutlet var nameIcon: UIImageView!
    @IBOutlet var emailIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    @IBOutlet var phoneIcon: UIImageView!
    @IBOutlet var locationIcon: UIImageView!
    
    @IBOutlet var customerLogo: UIImageView!
    @IBOutlet var workOrderNameLabel: UILabel!
    @IBOutlet var workOrderNumLabel: UILabel!
    @IBOutlet var priorityLabel: UILabel!
    @IBOutlet var jobTypeLabel: UILabel!
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var mobileLabel: UILabel!
    @IBOutlet var phoneLabel: UILabel!
    @IBOutlet var addressLabel: UILabel!
    @IBOutlet var jobDetailView: UITextView!
    @IBOutlet var assignedToLabel: UILabel!
    
    @IBOutlet var btnMap: UIButton!
    @IBOutlet var btnCopy: UIButton!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure icons
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarDay, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        nameIcon.image = UIImage.fontAwesomeIcon(name: .user, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobile, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        phoneIcon.image = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        locationIcon.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        
        btnMap.setImage(UIImage.fontAwesomeIcon(name: .map, style: .regular, textColor: AppTheme.defaultLinkColor, size: CGSize(width: 22, height: 22)), for: .normal)
        btnCopy.setImage(UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultLinkColor, size: CGSize(width: 22, height: 22)), for: .normal)
        
        // set title
        self.parent?.navigationItem.title = "#WO-00517"
        
        customerLogo.kf.setImage(with: URL(string: "https://www.markate.com/cdn/20200131/avatar_14356_2efeea8595_md.jpg"))
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}

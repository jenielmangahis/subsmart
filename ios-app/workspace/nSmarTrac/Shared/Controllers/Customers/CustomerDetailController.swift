//
//  CustomerDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import MapKit

class CustomerDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    @IBOutlet var nameIcon: UIImageView!
    @IBOutlet var emailIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    @IBOutlet var phoneIcon: UIImageView!
    @IBOutlet var emailNotifyIcon: UIImageView!
    @IBOutlet var smsNotifyIcon: UIImageView!
    @IBOutlet var locationIcon: UIImageView!
    
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var mobileLabel: UILabel!
    @IBOutlet var phoneLabel: UILabel!
    @IBOutlet var emailNotifyLabel: UILabel!
    @IBOutlet var smsNotifyLabel: UILabel!
    @IBOutlet var addressLabel: UILabel!
    
    @IBOutlet var btnMap: UIButton!
    @IBOutlet var btnCopy: UIButton!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure icons
        nameIcon.image = UIImage.fontAwesomeIcon(name: .user, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobile, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        phoneIcon.image = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        emailNotifyIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        smsNotifyIcon.image = UIImage.fontAwesomeIcon(name: .sms, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        locationIcon.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        
        btnMap.setImage(UIImage.fontAwesomeIcon(name: .map, style: .regular, textColor: AppTheme.defaultLinkColor, size: CGSize(width: 22, height: 22)), for: .normal)
        btnCopy.setImage(UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultLinkColor, size: CGSize(width: 22, height: 22)), for: .normal)
        
        // set title
        self.parent?.navigationItem.title = "Customer's Detail"
    }

}

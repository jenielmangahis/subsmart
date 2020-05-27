//
//  EstimateDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import Kingfisher

class EstimateDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var printBarButton: UIBarButtonItem!
    @IBOutlet var customerLogo: UIImageView!
    @IBOutlet var phoneIcon: UIImageView!
    @IBOutlet var emailToIcon: UIImageView!
    @IBOutlet var phoneToIcon: UIImageView!
    @IBOutlet var mobileToIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    
    var floaty = Floaty()
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        
        // set title
        self.navigationItem.title = "Estimate Preview"
        
        // configure navBar icons
        printBarButton.image = UIImage.fontAwesomeIcon(name: .print, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
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

// MARK: - Floaty Delegate -

extension EstimateDetailController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Edit", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Cancel", icon: UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Re-Send", icon: UIImage.fontAwesomeIcon(name: .paperPlane, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Mark as Lost", icon: UIImage.fontAwesomeIcon(name: .ban, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Clone Estimate", icon: UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Convert to Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Convert to Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Schedule Appointment", icon: UIImage.fontAwesomeIcon(name: .calendarPlus, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        self.view.addSubview(floaty)
    }
}

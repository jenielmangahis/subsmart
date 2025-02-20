//
//  ScheduleTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift

class ScheduleTabController: UITabBarController, UITabBarControllerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    var floaty = Floaty()
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        
        // set title
        self.navigationItem.title = "Schedule Details"
        
        // configure navBar icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // configure tab bar
        let tabs = ["Arrival", "Start", "Pause", "Complete", "More"]
        let icons: [FontAwesome] = [.truckMoving, .stopwatch, .pauseCircle, .clipboardCheck, .ellipsisH]
        var tabBarList: [UIViewController] = []
        
        for (index, value) in tabs.enumerated() {
            let image = UIImage.fontAwesomeIcon(name: icons[index], style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
            let tabBarItem  = UITabBarItem(title: value, image: image, tag: index)
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_EventDetailController") as! EventDetailController
            controller.tabBarItem = tabBarItem
            tabBarList.append(controller)
        }
        
        self.tabBar.tintColor = AppTheme.defaultColor
        self.viewControllers = tabBarList
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    override func tabBar(_ tabBar: UITabBar, didSelect item: UITabBarItem) {
        
    }

}

// MARK: - Floaty Delegate -

extension ScheduleTabController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .clear
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .clear, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 0
        
        floaty.addItem("Notes", icon: UIImage.fontAwesomeIcon(name: .fileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
        })
        floaty.addItem("Log Time", icon: UIImage.fontAwesomeIcon(name: .stopwatch, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Reschedule", icon: UIImage.fontAwesomeIcon(name: .calendar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Change Order", icon: UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Attach Photo", icon: UIImage.fontAwesomeIcon(name: .image, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Change Status", icon: UIImage.fontAwesomeIcon(name: .flag, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Cancel Schedule", icon: UIImage.fontAwesomeIcon(name: .ban, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Request Signature", icon: UIImage.fontAwesomeIcon(name: .signature, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Convert To Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Convert To Estimate", icon: UIImage.fontAwesomeIcon(name: .calculator, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        self.view.addSubview(floaty)
    }
}

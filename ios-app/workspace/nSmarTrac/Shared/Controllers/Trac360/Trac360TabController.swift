//
//  Trac360TabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/28/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import iOSDropDown
import SideMenu

class Trac360TabController: UITabBarController, UITabBarControllerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var dropdownField: DropDown!
    
    var floaty = Floaty()
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initFAB()
        initDropDown()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        let storyboard = UIStoryboard(name: "Main", bundle: Bundle.main)
        SideMenuManager.default.leftMenuNavigationController = storyboard.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
    }
    
    // MARK: - Dropdown
        
    func initDropDown() {
        let options: [String] = App.shared.cache.loadCachedTrac360Circles().map { (item) -> String in
            return String(format: "%@", item.name)
        }
        
        dropdownField.optionArray = options
        dropdownField.text = (options.count > 0) ? options.first : ""
        dropdownField.rowHeight = 51
        dropdownField.selectedIndex = 0
        dropdownField.selectedRowColor = UIColor(rgb: 0xF1F1F9)
        dropdownField.isSearchEnable = false
        dropdownField.arrowSize = 7
        dropdownField.arrowColor = UIColor(rgb: 0x76849F)
        dropdownField.setLeftPaddingPoints(20)
        dropdownField.font = UIFont.robotoFont(ofSize: 14)
        dropdownField.didSelect(completion: { (selectedText , index ,id) in
            App.shared.selectedTrac360Circle = App.shared.cache.loadCachedTrac360Circles()[index]
        })
        
        App.shared.selectedTrac360Circle = App.shared.cache.loadCachedTrac360Circles().first
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func chatButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Chat
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func messagesButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Messages
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }

}

// MARK: - Floaty Delegate -

extension Trac360TabController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 60
        floaty.addItem("Help Alert", icon: UIImage.fontAwesomeIcon(name: .exclamationTriangle, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Add Places", icon: UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            //self.pushTo(storyBoard: "Main", identifier: "sb_WorkOrderTypesController")
            self.floaty.close()
        })
        floaty.addItem("Invite", icon: UIImage.fontAwesomeIcon(name: .userPlus, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Add Circle", icon: UIImage.fontAwesomeIcon(name: .dotCircle, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            //self.pushTo(storyBoard: "Main", identifier: "sb_WorkOrderFilterController")
            self.floaty.close()
        })
        floaty.addItem("Check in", icon: UIImage.fontAwesomeIcon(name: .checkCircle, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            //self.pushTo(storyBoard: "Main", identifier: "sb_AddWorkOrderController")
            self.floaty.close()
        })
        
        self.view.addSubview(floaty)
        
    }
}

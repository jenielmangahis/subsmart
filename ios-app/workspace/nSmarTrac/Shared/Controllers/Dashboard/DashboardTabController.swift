//
//  DashboardTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/11/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SideMenu

class DashboardTabController: UITabBarController, UITabBarControllerDelegate {

    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initViews()
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
    
    // MARK: - Actions -
    
    func initViews() {
        // configure tab bar
        var tabBarList: [UIViewController] = []
        
        // tab-1
        let dashboard = UIImage.fontAwesomeIcon(name: .tachometerAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        let tabBarItem  = UITabBarItem(title: "Dashboard", image: dashboard, tag: 0)
        let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_DashboardController") as! DashboardController
        controller.tabBarItem = tabBarItem
        tabBarList.append(controller)
        
        // tab-2
        let calendar = UIImage.fontAwesomeIcon(name: .calendarDay, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        let tabBarItem2  = UITabBarItem(title: "Schedule", image: calendar, tag: 1)
        let controller2 = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(withIdentifier: "sb_ScheduleController") as! ScheduleController
        controller2.tabBarItem = tabBarItem2
        tabBarList.append(controller2)
        
        // tab-3
        let messages = UIImage.fontAwesomeIcon(name: .comments, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        let tabBarItem3  = UITabBarItem(title: "Messages", image: messages, tag: 2)
        let controller3 = UIStoryboard(name: "Others", bundle: Bundle.main).instantiateViewController(withIdentifier: "sb_MessagesController") as! MessagesController
        controller3.tabBarItem = tabBarItem3
        tabBarList.append(controller3)
        
        // tab-4
        let customers = UIImage.fontAwesomeIcon(name: .user, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        let tabBarItem4  = UITabBarItem(title: "Customers", image: customers, tag: 3)
        let controller4 = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(withIdentifier: "sb_CustomersController") as! CustomersController
        controller4.tabBarItem = tabBarItem4
        tabBarList.append(controller4)
        
        self.viewControllers = tabBarList
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

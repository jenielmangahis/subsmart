//
//  ESignTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import SideMenu

class ESignTabController: UITabBarController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    
    var floaty = Floaty()
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initFAB()
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
        
        // set title
        self.navigationItem.title = "eSign"
        
        // set tabBar tintColor
        //self.tabBar.tintColor = AppTheme.defaultColor
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

extension ESignTabController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 60
        
        // add action
        let tap = UITapGestureRecognizer(target: self, action: #selector(handleFloaty(_:)))
        tap.delegate = self
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    // back button action
    @objc func handleFloaty(_ gestureRecognizer: UITapGestureRecognizer) {
        // present vc
        if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddDocToSignController")  as? AddDocToSignController {
            mVC.callback = { (document, filename) in
                self.dismiss(animated: true, completion: {
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ScannedDocumentController") as? ScannedDocumentController
                    viewController?.documents = [document]
                    viewController?.filenames = [filename]
                    self.navigationController?.pushViewController(viewController!, animated: true)
                })
            }
            let navController = UINavigationController(rootViewController: mVC)
            navController.modalPresentationStyle = .formSheet
            present(navController, animated: true, completion: nil)
        }
    }
}

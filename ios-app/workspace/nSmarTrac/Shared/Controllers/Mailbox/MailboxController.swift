//
//  MailboxController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import SideMenu

class MailboxController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!
    
    var floaty = Floaty()
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initFAB()
        
        self.pushTo(storyBoard: "Main", identifier: "sb_InboxController")
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars
            , style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        SideMenuManager.default.leftMenuNavigationController = storyboard?.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Mailbox"
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
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

// MARK: - UISideMenuNavigationControllerDelegate -

extension MailboxController: SideMenuNavigationControllerDelegate {
    
    func sideMenuWillAppear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuDidAppear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuWillDisappear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuDidDisappear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
}

// MARK: - TableView Datasource -

extension MailboxController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 6
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let titles = ["Inbox", "Drafts", "Sent", "Junk", "Trash", "Archive"]
        let icons: [FontAwesome] = [.inbox, .file, .paperPlane, .trash, .trashAlt, .archive]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = titles[indexPath.row]
        cell.imageView?.image = image
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        self.pushTo(storyBoard: "Main", identifier: "sb_InboxController")
    }
    
}

// MARK: - Floaty Delegate -

extension MailboxController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        
        // add action
        let tap = UITapGestureRecognizer(target: self, action: #selector(handleNewMailButton(_:)))
        tap.delegate = self
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    // new mail action
    @objc func handleNewMailButton(_ gestureRecognizer: UITapGestureRecognizer) {
        
    }
}

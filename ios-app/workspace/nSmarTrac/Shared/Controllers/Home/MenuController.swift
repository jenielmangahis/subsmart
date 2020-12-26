//
//  MenuController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SideMenu

class MenuController: UITableViewController {

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // setup company logo
        self.navigationItem.titleView = Utils.shared.getAppLogo()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 6
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let titles = ["Home", "My Business", "My Account", "Notifications", "Settings", "Logout"]
        let icons: [FontAwesome] = [.home, .store, .userCircle, .bell, .cog, .signOutAlt]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = titles[indexPath.row]
        cell.imageView?.image = image

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let shortcuts: [LeftMenu] = [.Home, .MyBusiness, .MyAccount, .Notification, .Settings, .Login]
        App.shared.selectedMenu = shortcuts[indexPath.row]
        
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }

}

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
        return 16
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let titles = ["Home", "Customers", "Quick Links", "Business Contacts", "Leads", "Tasks", "Inventory", "Map", "Calculator", "Estimator", "Expense Tracker", "Notifications", "My Info", "Settings", "Company Profile", "Logout"]
        let icons: [FontAwesome] = [.home, .users, .link, .addressBook, .clipboardList, .tasks, .dollyFlatbed, .map, .calculator, .calculatorAlt, .moneyBill, .bell, .userCircle, .cog, .briefcase, .signOutAlt]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = titles[indexPath.row]
        cell.imageView?.image = image

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        switch (indexPath.row) {
        case 0:
            App.shared.selectedMenu = .Home
            break
        case 1:
            App.shared.selectedMenu = .Customers
            break
        case 2:
            App.shared.selectedMenu = .QuickLinks
            break
        case 3:
            App.shared.selectedMenu = .BusinessContacts
            break
        case 4:
            App.shared.selectedMenu = .Leads
            break
        case 5:
            App.shared.selectedMenu = .Tasks
            break
        case 6:
            App.shared.selectedMenu = .Inventory
            break
        case 7:
            App.shared.selectedMenu = .Map
            break
        case 8:
            App.shared.selectedMenu = .Calculator
            break
        case 9:
            App.shared.selectedMenu = .Estimator
            break
        case 10:
            App.shared.selectedMenu = .Expenses
            break
        case 11:
            App.shared.selectedMenu = .Notification
            break
        case 12:
            App.shared.selectedMenu = .MyInfo
            break
        case 13:
            App.shared.selectedMenu = .Settings
            break
        case 14:
            App.shared.selectedMenu = .CompanyProfile
            break
        case 15:
            //App.shared.user.logout()
            App.shared.selectedMenu = .Login
            break
        default:
            break
        }
        
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }

}

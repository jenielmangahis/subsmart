//
//  ReportsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 22/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SideMenu

class ReportsController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!

    let array1 = ["Monthly Closeout", "Yearly Closeout", "Profit and Loss", "Sales Leaderboard"]
    let array2 = ["Payments Type Summary", "Payments Received", "Sales By Items", "Material Sales Report", "Product Sales Report", "Repeated Business", "Sales Demographics"]
    let array3 = ["Account Receivable", "Invoice by Date", "Aging Summary", "Commercial vs Residential"]
    let array4 = ["Expenses By Category Summary", "Expenses By Category", "Expenses By Customer", "Expenses By Work Order", "Expenses By Vendor"]
    let array5 = ["Estimates Summary"]
    let array6 = ["Sales Summary By Customer", "Sales By Customer Groups", "Sales By Customer Source", "Tax Paid by Customers", "Customer Demographics", "Customer Source"]
    let array7 = ["Payroll Summary", "Payroll By Employee", "Payroll Log Details", "Percent Sales Commission Report"]
    let array8 = ["Time Log Summary", "Time Log Details"]
    let array9 = ["Work Order Status"]
    let array10 = ["Sales Tax", "Non Taxable Sales"]
    
    let ids1 = ["sb_MonthlyCloseoutController", "sb_YearlyCloseoutController", "sb_ProfitLossController", "sb_SalesLeaderboardController"]
    
    var titles: [[String]] = []
    var identifier: [[String]] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        
        titles = [array1, array2, array3, array4, array5, array6, array7, array8, array9, array10]
        identifier = [ids1]
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
        let storyboard = UIStoryboard(name: "Main", bundle: Bundle.main)
        SideMenuManager.default.leftMenuNavigationController = storyboard.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Reports"
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

extension ReportsController: SideMenuNavigationControllerDelegate {
    
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

extension ReportsController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 10
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return titles[section].count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        let headers = ["Popular Reports", "Sales", "Receivables", "Expenses", "Estimates", "Customers", "Employees", "Timesheets", "Work Orders", "Taxes"]
        return Utils.createHeader(AppTheme.defaultLightOpaque!, AppTheme.defaultColor, headers[section])
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = titles[indexPath.section][indexPath.row]
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        self.pushTo(storyBoard: "Reports", identifier: "sb_PaymentByMonthController")
    }
}

//
//  CustomersController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import SideMenu

class CustomersController: UIViewController, UIGestureRecognizerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    //var invoices: [Invoice] = []
    //var filteredItems: [Invoice] = []
    var selectedIndexPath: [IndexPath] = []
    var isFiltered: Bool = false
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.selectedIndexPath.removeAll()
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
        self.navigationItem.title = "Customers"
        
        // setup company logo
        //self.navigationItem.titleView = Utils.shared.getAppLogo()
    }
    
    // MARK: - Search View -
    
    func initSearchView() {
        searchView.backgroundColor = .groupTableViewBackground
        searchView.isHidden = true
        tableTop.constant = -50.0
        
        let leftView = UIView(frame: CGRect(x: 0, y: 7, width: 33, height: 20))
        leftView.backgroundColor = .clear
        
        let imageView = UIImageView(frame: CGRect(x: 13, y: 0, width: 20, height: 20))
        imageView.image = UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20))
        imageView.contentMode = .scaleAspectFit
        leftView.addSubview(imageView)
        
        
        let rightView = UIView(frame: CGRect(x: 0, y: 7, width: 24, height: 20))
        rightView.backgroundColor = .clear
        
        let cancelButton = UIButton(frame: CGRect(x: 0, y: 0, width: 20, height: 20))
        cancelButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20)), for: .normal)
        cancelButton.addTarget(self, action: #selector(cancelButtonTapped(_:)), for: .touchUpInside)
        rightView.addSubview(cancelButton)
        
        textField.borderStyle = .roundedRect
        textField.font = UIFont.robotoFont(ofSize: 13)
        textField.leftViewMode = .always
        textField.leftView = leftView
        textField.rightViewMode = .always
        textField.rightView = rightView
        textField.textColor = UIColor(rgb: 0x545454)
        textField.addTarget(self, action: #selector(searchItem(_ :)), for: .editingChanged)
        textField.addTarget(self, action: #selector(textFieldShouldReturn(_ :)), for: .editingDidEnd)
    }
    
    @objc func cancelButtonTapped(_ sender: Any) {
        self.isFiltered = false
        self.searchView.isHidden = true
        self.tableTop.constant = -50.0
        self.selectedIndexPath.removeAll()
        self.tableView.reloadData()
        self.view.endEditing(true)
    }
    
    // MARK: - UITextField Delegate -
    
    @objc func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
    // MARK: - Filter Array -
    
    @objc func searchItem(_ textfield: UITextField) {
        /*let searchText = textfield.text!
        
        filteredItems = invoices.filter({ item in
            return (item.customer_name.lowercased().contains(searchText.lowercased()) ||
                    item.date.lowercased().contains(searchText.lowercased()) ||
                    item.invoice_code.lowercased().contains(searchText.lowercased()))
        })*/
        
        self.isFiltered = true
        self.tableView.reloadData()
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        //self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        
    }
    
    // MARK: - Notification -
    
    @objc func reloadData(_ notification: Notification) {
        self.refreshData(notification)
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

extension CustomersController: SideMenuNavigationControllerDelegate {
    
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

extension CustomersController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 3
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(AppTheme.defaultLightOpaque!, AppTheme.defaultColor, "J")
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // nameButton
        let nameButton = Utils.createPurpleButton(28, 12, Int((Device.width-40)/2), "John Doe", hasArrow: true)
        nameButton.addTarget(self, action: #selector(didButtonTapped(_:)), for: .touchUpInside)
        nameButton.tag = indexPath.section
        cell.contentView.addSubview(nameButton)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "CONTACTS", "user@example.com", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "CUSTOMER TYPE", "Residential", [.top])
        cell.contentView.addSubview(topRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(100)
        cell.contentView.addSubview(bottomBorder)
        
        // selected
        cell.contentView.backgroundColor = selectedIndexPath.contains(indexPath) ? UIColor(rgb: 0xCDEDB6) : .white
        
        return cell
    }
    
    // MARK: - Protocols -
    
    @objc func didButtonTapped(_ sender: UIButton) {
        self.pushTo(storyBoard: "Main", identifier: "sb_CustomerTabBar")
    }
}

// MARK: - Floaty Delegate -

extension CustomersController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Search", icon: UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.searchView.isHidden = false
            self.tableTop.constant = 0.0
            self.floaty.close()
        })
        floaty.addItem("Filter", icon: UIImage.fontAwesomeIcon(name: .filter, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Main", identifier: "sb_CustomerFilterController")
            self.floaty.close()
        })
        floaty.addItem("Schedule Event", icon: UIImage.fontAwesomeIcon(name: .calendarCheck, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Reminder", icon: UIImage.fontAwesomeIcon(name: .bell, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            
            self.floaty.close()
        })
        floaty.addItem("Add", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerController")
            self.floaty.close()
        })
        self.view.addSubview(floaty)
    }
}

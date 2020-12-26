//
//  EstimatesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import EzPopup
import Floaty
import FontAwesome_swift
import SideMenu
import SVProgressHUD

class EstimatesController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    var items: [Estimate] = []
    var filteredItems: [Estimate] = []
    var groupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [Estimate]
    }
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
        
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(addStandardEstimate(_:)), name: Notifications.willAddStandardEstimates, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addOptionsEstimate(_:)), name: Notifications.willAddOptionsEstimates, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(openPreview(_:)), name: Notifications.willOpenEstimatePreview, object: nil)
        
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getEstimates() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.processData(list)
        }
    }
    
    func processData(_ list: [Estimate]) {
        // sort ungrouped
        let ungrouped = list.sorted(by: {$0.customer_name.prefix(1) > $1.customer_name.prefix(1)})
        // group
        let grouped = ungrouped.group(by: {$0.customer_name.prefix(1)})
        // sort
        let sorted = grouped.sorted(by: {$0.key < $1.key})
        // create temp groupedObjects
        var tempGroupedObjects = [Object]()
        // iterate
        for (key, value) in sorted {
            tempGroupedObjects.append(Object(group: String(key), item: value))
        }
        
        self.groupedItems = tempGroupedObjects
        self.tableView.backgroundView = nil
        self.tableView.reloadData()
        self.refreshControl.endRefreshing()
    }
    
    // MARK: - ErrorView -

    private lazy var errorView: BasicErrorView = {
        let errorView = BasicErrorView()
        errorView.translatesAutoresizingMaskIntoConstraints = false
        return errorView
    }()
    
    func addErrorView(with error: Error) {
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.tableView.backgroundView?.addSubview(self.errorView)
            let safeAreaLayoutGuide = self.view.safeAreaLayoutGuide
            NSLayoutConstraint.activate([
                self.errorView.leadingAnchor.constraint(equalTo: safeAreaLayoutGuide.leadingAnchor),
                self.errorView.trailingAnchor.constraint(equalTo: safeAreaLayoutGuide.trailingAnchor),
                self.errorView.topAnchor.constraint(equalTo: safeAreaLayoutGuide.topAnchor),
                self.errorView.bottomAnchor.constraint(equalTo: safeAreaLayoutGuide.bottomAnchor)
                ])
            self.errorView.displayError(error)
        }
    }

    func removeErrorView() {
        if self.tableView.backgroundView == nil || !self.tableView.backgroundView!.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        SideMenuManager.default.leftMenuNavigationController = storyboard?.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Estimates"
    }
    
    // MARK: - Search View -
    
    func initSearchView() {
        searchView.backgroundColor = .systemGroupedBackground
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
        self.processData(items)
        self.searchView.isHidden = true
        self.tableTop.constant = -50.0
        self.view.endEditing(true)
    }
    
    // MARK: - UITextField Delegate -
    
    @objc func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
    // MARK: - Filter Array -
    
    @objc func searchItem(_ textfield: UITextField) {
        let searchText = textfield.text!
        
        filteredItems = items.filter({ item in
            return (item.customer_name.lowercased().contains(searchText.lowercased()) ||
                    item.job_name.lowercased().contains(searchText.lowercased()))
        })
        
        self.processData(filteredItems)
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: - Notification -
    
    @objc func addStandardEstimate(_ notification: Notification) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddStandardEstimateController")
    }
    
    @objc func addOptionsEstimate(_ notification: Notification) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomEstimateController")
    }
    
    @objc func openPreview(_ notification: Notification) {
        if let info = notification.userInfo?["estimate"] as? Estimate {
            App.shared.selectedEstimate = info
            self.pushTo(storyBoard: "Main", identifier: "sb_EstimatePreviewController")
            
            NotificationCenter.default.post(name: Notifications.willEditEstimate, object: self, userInfo: nil)
        }
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

// MARK: - TableView Datasource -

extension EstimatesController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return groupedItems.count
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return groupedItems[section].item.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.uppercased())
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // get name
        var name = "Job for " + item.customer_name
        if !item.job_name.isEmpty {
            name = "\(item.customer_name) (\(item.job_name))"
        }
        
        // nameButton
        let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), name, hasArrow: true)
        cell.contentView.addSubview(nameButton)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "ESTIMATE #", item.estimate_number, [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "DATE", item.estimate_date.toReadableDate, [.top])
        cell.contentView.addSubview(topRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "STATUS", item.status, [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // bottomRight view
        let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "AMOUNT", "$\(item.estimate_value)", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(150)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        // edit button
        let edit = UIContextualAction(style: .normal, title: "") {  (contextualAction, view, boolValue) in
            // get item
            let item =  self.groupedItems[indexPath.section].item[indexPath.row]
            // check type
            if item.estimate_type == "Standard" {
                // edit item at indexPath
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
            } else if item.estimate_type == "Option" {
                // edit item at indexPath
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
            }
        }
        edit.image = UIImage.fontAwesomeIcon(name: .pen, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        edit.backgroundColor = .blueColor
        
        
        // check role
        if App.shared.user!.role.intValue <= 3 {
            // delete button
            let delete = UIContextualAction(style: .destructive, title: "") {  (contextualAction, view, boolValue) in
                // show alert
                let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // delete item at indexPath
                    let item = self.groupedItems[indexPath.section].item[indexPath.row]
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show(withStatus: "Deleting...")
                    App.shared.api.deleteEstimate(item.id.intValue) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        guard success == true else {
                            return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                        }
                        
                        self.groupedItems[indexPath.section].item.remove(at: indexPath.row)
                        tableView.deleteRows(at: [indexPath], with: .fade)
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: {
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    })
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            }
            delete.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))

            return UISwipeActionsConfiguration(actions: [delete, edit])
        }

        return UISwipeActionsConfiguration(actions: [edit])
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        App.shared.selectedEstimate = groupedItems[indexPath.section].item[indexPath.row]
        self.pushTo(storyBoard: "Main", identifier: "sb_EstimatePreviewController")
    }
}

// MARK: - Floaty Delegate -

extension EstimatesController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Settings", icon: UIImage.fontAwesomeIcon(name: .cog, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Settings", identifier: "sb_EstimateSettingsController")
            self.floaty.close()
        })
        floaty.addItem("Search", icon: UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.searchView.isHidden = false
            self.tableTop.constant = 0.0
            self.floaty.close()
        })
        floaty.addItem("Filter", icon: UIImage.fontAwesomeIcon(name: .filter, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Main", identifier: "sb_EstimateFilterController")
            self.floaty.close()
        })
        floaty.addItem("Add", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EstimateOptionController") as? EstimateOptionController
            let popup = PopupViewController(contentController: viewController!, popupWidth: Device.width-100, popupHeight: 350)
            popup.cornerRadius = 10
            popup.canTapOutsideToDismiss = false
            self.present(popup, animated: true, completion: nil)
            self.floaty.close()
        })
        
        self.view.addSubview(floaty)
    }
}

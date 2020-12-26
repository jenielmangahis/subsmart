//
//  ExpenseCategorySettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift

class ExpenseCategorySettingsController: UIViewController {

    // MARK: - Properties -
    
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
    
    let categories: [[String]] = [["Automobile Expense"], ["Bank Charges"], ["Commision & Fees"], ["Dues & Subscriptions"], ["Federal Taxes (941/944)", "FL Unemployment Tax", "Fuel/Mileage Expenses"], ["Insurance"], ["Job Materials"], ["Legal & Professional Fees", "Loan Payable"], ["Meals & Entertainment"], ["Office Expenses"], ["Payroll Expenses", "Penalties & Settlements"], ["Reimburstment", "Rent or Lease", "Repair & Maintenance"], ["Shareholder Notes Payable", "Subcontractors", "Subcontractors - COS", "Supplies", "Supplies & Materials - COGS"], ["Taxes & Licenses", "Telephony Expense", "Travel Expense"], ["Uncategorized Expense", "Utilities"]]
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
                
        self.title = "Expense Categories"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
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

}

// MARK: - TableView Datasource -

extension ExpenseCategorySettingsController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return categories.count
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return categories[section].count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        let header = categories[section][0].prefix(1).uppercased()
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, header)
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = categories[indexPath.section][indexPath.row]
        
        return cell
    }
}

// MARK: - Floaty Delegate -

extension ExpenseCategorySettingsController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Search", icon: UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.searchView.isHidden = false
            self.tableTop.constant = 0.0
            self.floaty.close()
        })
        floaty.addItem("Add", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Settings", identifier: "sb_AddExpenseCategoryController")
            self.floaty.close()
        })
        
        self.view.addSubview(floaty)
    }
}

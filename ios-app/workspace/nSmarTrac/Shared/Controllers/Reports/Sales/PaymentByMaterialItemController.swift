//
//  PaymentByMaterialItemController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 26/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class PaymentByMaterialItemController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var tableView: UITableView!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    
    //var invoices: [Invoice] = []
    //var filteredItems: [Invoice] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
                
        self.title = "Material Sales Report"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
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

extension PaymentByMaterialItemController: UITableViewDelegate, UITableViewDataSource {
    
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
        return Utils.createReportHeader(App.shared.headerBgColor, App.shared.headerColor, "Item", "Total Sales")
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text        = "Indoor DVR Camera"
        cell.textLabel?.font        = UIFont.robotoFont(ofSize: 13)
        cell.detailTextLabel?.text  = "$2,786.28"
        cell.detailTextLabel?.font  = UIFont.robotoFont(ofSize: 13)
        
        
        if indexPath.row == 2 {
            cell.textLabel?.text        = "Total"
            cell.textLabel?.font        = UIFont.robotoBoldFont(ofSize: 13)
            cell.detailTextLabel?.text  = "$8,358.84"
            cell.detailTextLabel?.font  = UIFont.robotoBoldFont(ofSize: 13)
        }
        
        return cell
    }
}

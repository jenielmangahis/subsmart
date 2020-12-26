//
//  PayrollSummaryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class PayrollSummaryController: UIViewController {
    
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
                
        self.title = "Payroll Summary"
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

extension PayrollSummaryController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 7
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        let names = ["Today", "Yesterday", "This Week", "This Month", "Previous Month", "This Year", "Previous Year"]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // nameLabel
        let nameLabel = Utils.createPurpleLabel(28, 12, Int((Device.width-40)/2), names[indexPath.row])
        cell.contentView.addSubview(nameLabel)
        
        // topLeft view
        let topLeft = Utils.createViewForPayroll(20, 50, Int((Device.width-40)/2), 50, "WORK TIME (hh:mm | total pay)", "0:00", "$0.00", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createViewForPayroll(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "TRAVEL TIME (hh:mm | total pay)", "0:00", "$0.00", [.top])
        cell.contentView.addSubview(topRight)
        
        // midLeft view
        let midLeft = Utils.createViewForPayroll(20, 100, Int((Device.width-40)/2), 50, "MANUAL ENTRY (hh:mm | total pay)", "0:00", "$0.00", [.top, .right])
        cell.contentView.addSubview(midLeft)
        
        // midRight view
        let midRight = Utils.createViewForPayroll(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "OTHER (hh:mm | total pay)", "0:00", "$0.00", [.top])
        cell.contentView.addSubview(midRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createViewForPayroll(20, 150, Int((Device.width-40)/2), 50, "TOTAL (hh:mm | total pay)", "0:00", "$0.00", [.top])
        cell.contentView.addSubview(bottomLeft)
        
        // midRight view
        let bottomRight = Utils.createViewForPayroll(Int(Device.width/2), 150, Int((Device.width-40)/2), 50, "", "", "", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(200)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
}

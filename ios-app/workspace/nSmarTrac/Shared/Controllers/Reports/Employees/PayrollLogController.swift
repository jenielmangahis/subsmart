//
//  PayrollLogController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class PayrollLogController: UIViewController {
    
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
                
        self.title = "Payroll Log Details"
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

extension PayrollLogController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 3
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // nameLabel
        let nameLabel = Utils.createPurpleLabel(28, 12, Int((Device.width-40)/2), "Employee Name Here")
        cell.contentView.addSubview(nameLabel)
        
        // typeLabel
        let typeLabel = Utils.createGrayLabel(28, 28, Int(Device.width-40), "Clock In-Out")
        cell.contentView.addSubview(typeLabel)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "CLOCK IN-OUT DATE", "28-May-2020, 11:24 - 11:25", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "WORKED HOURS:MINS", "0:00", [.top])
        cell.contentView.addSubview(topRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "HOURLY RATE", "$0.00", [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // bottomRight view
        let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "TOTAL PAY", "$0.00", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(150)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
}

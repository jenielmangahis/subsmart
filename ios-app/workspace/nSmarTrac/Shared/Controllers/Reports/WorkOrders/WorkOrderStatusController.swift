//
//  WorkOrderStatusController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class WorkOrderStatusController: UIViewController {
    
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
                
        self.title = "Work Order Status"
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

extension WorkOrderStatusController: UITableViewDelegate, UITableViewDataSource {
    
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
        let nameLabel = Utils.createPurpleLabel(28, 12, Int((Device.width-40)/2), "Customer Name Here")
        cell.contentView.addSubview(nameLabel)
        
        // typeLabel
        let typeLabel = Utils.createGrayLabel(28, 28, Int(Device.width-40), "Commercial")
        cell.contentView.addSubview(typeLabel)
        
        // amount view
        let amountView = Utils.createInvoiceLabel(Int(Device.width/2), 12, Int((Device.width-40)/2), "$0.00")
        cell.contentView.addSubview(amountView)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "JOB NAME (WO #)", "John Doe (WO-00545)", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "WO STATUS", "Scheduled", [.top])
        cell.contentView.addSubview(topRight)
        
        // midLeft view
        let midLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "ASSIGNED TO", "Sam Smith", [.top, .right])
        cell.contentView.addSubview(midLeft)
        
        // midRight view
        let midRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "SCHEDULED DATE", "02 Jun 2020, 10:00am - 12:00pm", [.top])
        cell.contentView.addSubview(midRight)
        
        // mid2Left view
        let mid2Left = Utils.createView(20, 150, Int((Device.width-40)/2), 50, "TIME LOG", "0:00", [.top, .right])
        cell.contentView.addSubview(mid2Left)
        
        // mid2Right view
        let mid2Right = Utils.createView(Int(Device.width/2), 150, Int((Device.width-40)/2), 50, "EXPENSES", "$0.00", [.top])
        cell.contentView.addSubview(mid2Right)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 200, Int((Device.width-40)/2), 50, "WAGE", "0:00", [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // topRight view
        let bottomRight = Utils.createView(Int(Device.width/2), 200, Int((Device.width-40)/2), 50, "PROFIT", "$0.00", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(250)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
}

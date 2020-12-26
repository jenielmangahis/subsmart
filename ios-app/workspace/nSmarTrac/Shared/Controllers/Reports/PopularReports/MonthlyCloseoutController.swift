//
//  MonthlyCloseoutController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 26/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class MonthlyCloseoutController: UIViewController {
    
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
                
        self.title = "Monthly Closeout"
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

extension MonthlyCloseoutController: UITableViewDelegate, UITableViewDataSource {
    
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
        
        let mWidth = Int((Device.width-40)/3)
        let midCoor = mWidth+20
        let rightCoor = (mWidth*2)+20
        
        // nameLabel
        let nameLabel = Utils.createPurpleLabel(28, 12, Int(Device.width-40), "May 2020")
        cell.contentView.addSubview(nameLabel)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, mWidth, 50, "# of ESTIMATES.", "0", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topMid view
        let topMid = Utils.createView(midCoor, 50, mWidth, 50, "ESTIMATED", "$0.00", [.top, .right])
        cell.contentView.addSubview(topMid)
        
        // topRight view
        let topRight = Utils.createView(rightCoor, 50, mWidth, 50, "ACCEPTED", "$0.00", [.top])
        cell.contentView.addSubview(topRight)
        
        // bottomLeft view
        let centerLeft = Utils.createView(20, 100, mWidth, 50, "# OF INVOICED", "0", [.top, .right])
        cell.contentView.addSubview(centerLeft)
        
        // bottomMid view
        let centerMid = Utils.createView(midCoor, 100, mWidth, 50, "INVOICED", "$0.00", [.top, .right])
        cell.contentView.addSubview(centerMid)
        
        // bottomRight view
        let centerRight = Utils.createView(rightCoor, 100, mWidth, 50, "PAID", "$0.00", [.top])
        cell.contentView.addSubview(centerRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 150, mWidth, 50, "DUE", "$0.00", [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // bottomMid view
        let bottomMid = Utils.createView(midCoor, 150, mWidth, 50, "# OF EXPENSES", "0", [.top, .right])
        cell.contentView.addSubview(bottomMid)
        
        // bottomRight view
        let bottomRight = Utils.createView(rightCoor, 150, mWidth, 50, "TOTAL EXPENSES", "$0.00", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(200)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
}

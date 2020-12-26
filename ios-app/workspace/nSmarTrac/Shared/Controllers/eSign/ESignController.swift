//
//  ESignController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class ESignController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var actionRequiredLabel: UILabel!
    @IBOutlet var waitingLabel: UILabel!
    @IBOutlet var tableView: UITableView!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    
    var items: [ESign] = []
    var recentItems: [ESign] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
        
        self.parent?.navigationItem.title = "eSign"
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
        App.shared.api.getESignDocs() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.recentItems = Array(list.prefix(5))
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
            self.refreshControl.endRefreshing()
            
            // filter action required
            let actionRequired = list.filter({ item in
                return (item.status == "Action Required")
            })
            self.actionRequiredLabel.text = "\(actionRequired.count)"
            
            // filter waiting for others
            let waiting = list.filter({ item in
                return (item.status == "Waiting for Others")
            })
            self.waitingLabel.text = "\(waiting.count)"
        }
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

}

// MARK: - TableView Datasource -

extension ESignController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return recentItems.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 18
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return "RECENT ACTIVITY"
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = recentItems[indexPath.row]
        var status = item.status
        // check
        if item.status == "Action Required" {
            status = "Needs to Sign"
        } else if status == "Cancelled" {
            status = "Voided"
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = (item.status == "Action Required" && item.type == "Multiple") ? "Please eSign: \(item.name)" : item.name
        cell.detailTextLabel?.text = status
        
        // add date
        let date = Date(fromString: item.created_at, format: DateHelper.dateFormatType) ?? Date()
        let dateLabel = UILabel(frame: CGRect(x: Device.width-140, y: 32.67, width: 80, height: 13))
        dateLabel.font = UIFont.robotoFont(ofSize: 11)
        dateLabel.text = App.shared.documentDateFormatter.string(from: date)
        dateLabel.textAlignment = .right
        dateLabel.textColor = .darkGray
        cell.contentView.addSubview(dateLabel)
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_DocumentDetailController")  as? DocumentDetailController
        controller?.item = recentItems[indexPath.row]
        self.navigationController?.pushViewController(controller!, animated: true)
    }
}

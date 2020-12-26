//
//  AttoAddDeptMemberController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AttoAddDeptMemberController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var addButton: DesignableButton!
    
    var items: [TimesheetTeamMember] = []
    var selectedItem: [TimesheetTeamMember] = []
    

    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewDidAppear(_ animated: Bool) {
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getTimesheetTeamMembers() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            // iterate to filter
            for item in list {
                // check
                if item.department_id.intValue == 0 && item.status.intValue == 1 {
                    self.items.append(item)
                }
            }
            
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
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
        let indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        indicator.style = UIActivityIndicatorView.Style.medium
        indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: - Actions -
    
    @IBAction func clearButtonTapped(_ sender: Any) {
    }
    
    @IBAction func addButtonTapped(_ sender: Any) {
        // iterate selected
        for item in selectedItem {
            // params
            let params: Parameters = ["department_id": item.id]
            
            SVProgressHUD.show()
            App.shared.api.putTimesheetTeamMember(item.id.intValue, params: params) { (result, error) in
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
            }
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return "No Department"
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel!.text = items[indexPath.row].name
        
        // add radio
        let radio = DLRadioButton(frame: CGRect(x: Device.width-44, y: 10, width: 24, height: 24))
        radio.tag = indexPath.row
        radio.configureRTL()
        radio.addTarget(self, action: #selector(didRadioCheck(_:)), for: .touchUpInside)
        cell.contentView.addSubview(radio)
        
        return cell
    }
    
    // MARK: - Protocol -
    
    @objc func didRadioCheck(_ sender: DLRadioButton) {
        selectedItem.append(items[sender.tag])
    }
    
}

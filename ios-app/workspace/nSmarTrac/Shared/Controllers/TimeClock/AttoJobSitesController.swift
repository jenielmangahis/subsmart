//
//  AttoJobSitesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoJobSitesController: UITableViewController {
    
    // MARK: - Properties -
    
    var textField = UITextField()
    var allowClockInRestrictions: Bool = false
    
    var items: [TimesheetJobSite] = []
    
    

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
        // check if not nil
        if let item = App.shared.timesheetSettings {
            // assign
            allowClockInRestrictions = item.allow_clock_in_restrictions.boolValue
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
        
        // call api
        App.shared.api.getTimesheetJobSites() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
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
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 3
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return [0, 1, items.count][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return [nil, nil, "JOB SITES"][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        if section == 0 {
            return "When you add a location, we'll use it's name instead of the address in all timesheet report"
        } else if section == 1 {
            return "When enabled, team members will only be allowed to clock in when they are located at one of the listed job sites."
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.section == 1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SettingCell", for: indexPath) as! DeptSettingCell
            cell.deptSwitch.addTarget(self, action: #selector(deptSwitchValueChanged(_:)), for: .valueChanged)
            
            // check if not nil
            if let item = App.shared.timesheetSettings {
                cell.deptSwitch.isOn = item.allow_clock_in_restrictions.boolValue
            }
            
            return cell
            
        } else if indexPath.section == 2 {
            // get item
            let item = items[indexPath.row]
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! JobSiteCell
            cell.name.text      = item.name
            cell.address.text   = item.address
            cell.distance.text  = item.diameter + " Feet"
            
            return cell
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_AttoEditJobSiteController") as? AttoEditJobSiteController
        controller?.item = items[indexPath.row]
        self.navigationController?.pushViewController(controller!, animated: true)
    }
    
    // MARK: - Protocol -
    
    @objc func deptSwitchValueChanged(_ sender: UISwitch) {
        
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "allow_clock_in_restrictions": sender.isOn]
        
        SVProgressHUD.show()
        App.shared.api.putTimesheetSetting(params) { (result, error) in
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            
            // update settings
            SVProgressHUD.show()
            App.shared.api.getTimesheetSetting() { (result, error) in
                SVProgressHUD.dismiss()
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // check
                if result != nil {
                    App.shared.timesheetSettings = result
                    
                    // reload table
                    self.allowClockInRestrictions = sender.isOn
                    self.tableView.reloadData()
                }
            }
        }
    }
    
    // MARK: - Actions -

    @IBAction func addButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Others", identifier: "sb_AttoAddJobSiteController")
    }
    
}

// MARK: - UITextFieldDelegate -

extension AttoJobSitesController: UITextFieldDelegate {
    
    func textFieldShouldBeginEditing(_ textField: UITextField) -> Bool {
        self.textField = textField
        return true
    }
}

// MARK: - Cells -

class JobSiteCell: UITableViewCell {
    @IBOutlet var name: UILabel!
    @IBOutlet var address: UILabel!
    @IBOutlet var distance: UILabel!
}

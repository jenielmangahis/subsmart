//
//  AttoDepartmentController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoDepartmentController: UITableViewController {
    
    // MARK: - Properties -
    
    var textField = UITextField()
    var isDeptEnabled: Bool = false
    
    var items: [TimesheetDepartment] = []
    
    

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
            print(item)
            // assign
            isDeptEnabled = item.allow_email_report.boolValue
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
            
        }
        
        // call api
        App.shared.api.getTimesheetDepartments() { (list, error) in
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
        return [1, 1, items.count][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        // check
        if isDeptEnabled {
            return [nil, nil, "DEPARTMENTS"][section]
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        if section == 0 {
            return "Enable departments to organized your team into groups for easier management and reporting."
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        // check
        if indexPath.section != 0 {
            return isDeptEnabled ? 44 : 0
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.section == 0 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SettingCell", for: indexPath) as! DeptSettingCell
            cell.deptSwitch.addTarget(self, action: #selector(deptSwitchValueChanged(_:)), for: .valueChanged)
            
            // check if not nil
            if let item = App.shared.timesheetSettings {
                cell.deptSwitch.isOn = item.allow_departments.boolValue
            }
            
            return cell
            
        } else if indexPath.section == 1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddCell", for: indexPath) as! AddDeptCell
            cell.nameField.delegate = self
            cell.addButton.addTarget(self, action: #selector(addButtonTapped(_:)), for: .touchUpInside)
            return cell
        }
        
        // get item
        let item = items[indexPath.row]
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = item.name
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if indexPath.section == 2 {
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_AttoDepartmentDetailController") as? AttoDepartmentDetailController
            controller?.item = items[indexPath.row]
            self.navigationController?.pushViewController(controller!, animated: true)
        }
    }
    
    // MARK: - Protocol -
    
    @objc func deptSwitchValueChanged(_ sender: UISwitch) {
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "allow_departments": sender.isOn]
        
        SVProgressHUD.show()
        App.shared.api.putTimesheetSetting(params) { [self] (result, error) in
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
                    self.isDeptEnabled = sender.isOn
                    self.tableView.reloadData()
                }
            }
        }
    }
    
    @objc func addButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["name": textField.text!,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postTimesheetDepartment(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
                
            self.loadData()
        }
    }

}

// MARK: - UITextFieldDelegate -

extension AttoDepartmentController: UITextFieldDelegate {
    
    func textFieldShouldBeginEditing(_ textField: UITextField) -> Bool {
        self.textField = textField
        return true
    }
}

// MARK: - Cells -

class DeptSettingCell: UITableViewCell {
    @IBOutlet var deptSwitch: UISwitch!
}

class AddDeptCell: UITableViewCell {
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var addButton: UIButton!
}

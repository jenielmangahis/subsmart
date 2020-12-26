//
//  AttoManualEntriesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AttoManualEntriesController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var allowManualEntriesSwitch: UISwitch!
    @IBOutlet var adminButton: DLRadioButton!
    @IBOutlet var managerButton: DLRadioButton!
    @IBOutlet var employeeButton: DLRadioButton!
    
    var isAllowedManualEntries: Bool = false
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // check if not nil
        if let item = App.shared.timesheetSettings {
            // assign
            allowManualEntriesSwitch.isOn   = item.allow_manual_entries.boolValue
            adminButton.isSelected          = item.roles.contains("Admins")
            managerButton.isSelected        = item.roles.contains("Managers")
            employeeButton.isSelected       = item.roles.contains("Employees")
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        adminButton.otherButtons = [managerButton, employeeButton]
        adminButton.configureRTL()
        managerButton.configureRTL()
        employeeButton.configureRTL()
        
        allowManualEntriesSwitch.addTarget(self, action: #selector(allowManualEntriesSwitchValueChanged(_:)), for: .valueChanged)
    }
    
    // MARK: - Actions -
    
    @objc func allowManualEntriesSwitchValueChanged(_ sender: UISwitch) {
        isAllowedManualEntries = sender.isOn
        self.tableView.reloadData()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // roles
        var roles: [String] = []
        
        // check
        if adminButton.isSelected {
            roles.append("Admins")
        }
        if managerButton.isSelected {
            roles.append("Managers")
        }
        if employeeButton.isSelected {
            roles.append("Employees")
        }
        
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "allow_manual_entries": allowManualEntriesSwitch.isOn,
                                  "roles": roles.joined(separator: ", ")]
        
        SVProgressHUD.show()
        App.shared.api.putTimesheetSetting(params) { (result, error) in
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            
            // update settings
            App.shared.api.getTimesheetSetting() { (result, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // check
                if result != nil {
                    App.shared.timesheetSettings = result
                }
            }
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        
        // check
        if section != 0 {
            return isAllowedManualEntries ? 44 : 0
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        if section == 1 && isAllowedManualEntries {
            return "ROLES"
        }
        return nil
    }
    
}

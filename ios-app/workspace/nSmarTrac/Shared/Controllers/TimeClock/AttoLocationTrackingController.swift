//
//  AttoLocationTrackingController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoLocationTrackingController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var locationTrackingSwitch: UISwitch!
    @IBOutlet var userSpecificSwitch: UISwitch!
    
    var isLocationTracking: Bool = true
    var isUserSpecific: Bool = false
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
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
            locationTrackingSwitch.isOn     = item.allow_location_tracking.boolValue
            userSpecificSwitch.isOn         = item.allow_user_specific.boolValue
            
            isLocationTracking  = locationTrackingSwitch.isOn
            isUserSpecific      = userSpecificSwitch.isOn
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func locationTrackingSwitchValueChanged(_ sender: UISwitch) {
        isLocationTracking = sender.isOn
        self.tableView.reloadData()
    }
    
    @IBAction func userSpecificSwitchValueChanged(_ sender: UISwitch) {
        isUserSpecific = sender.isOn
        self.tableView.reloadData()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["user_id": App.shared.user!.id,
                                  "allow_location_tracking": locationTrackingSwitch.isOn,
                                  "allow_user_specific": userSpecificSwitch.isOn]
        
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
        if section == 1 {
            return isLocationTracking ? 44 : 0
        } else if section == 2 {
            return (isLocationTracking && isUserSpecific) ? 44 : 0
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        // check
        if section == 1 && isLocationTracking {
            return "LOCATION TRACKING REQUIREMENT"
        } else if section == 2 && isLocationTracking && isUserSpecific {
            return "LOCATION TRACKING ENABLED FOR:"
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        // check
        if section == 0 {
            return "When enabled, the user will not be allowed to clock in/out, add a job or take a break if they haven't enabled location services for nSmarTrac in their device."
        } else if section == 1 && isLocationTracking {
            return "When enabled, you can set loocation tracking as required on a user basis."
        }
        return nil
    }
    
}

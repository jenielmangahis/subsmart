//
//  AttoMemberDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 26/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AttoMemberDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var locationTracking: UISwitch!
    @IBOutlet var adminButton: DLRadioButton!
    @IBOutlet var managerButton: DLRadioButton!
    @IBOutlet var employeeButton: DLRadioButton!
    @IBOutlet var removeButton: UIButton!
    
    var item: TimesheetTeamMember!
    var role = "Employee"
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        self.navigationItem.title = !item.name.isEmpty ? item.name : item.email
        
        // configure radio
        emailLabel.text         = item.email
        locationTracking.isOn   = item.will_track_location.boolValue
        
        adminButton.otherButtons = [managerButton, employeeButton]
        adminButton.configureRadio((item.role == "Admin") ? true : false)
        managerButton.configureRadio((item.role == "Manager") ? true : false)
        employeeButton.configureRadio((item.role == "Employee") ? true : false)
        
        // check status
        if item.status.intValue == 1 {
            removeButton.setTitle("Remove user", for: .normal)
        } else {
            removeButton.setTitle("Remove Pending Invite", for: .normal)
        }
    }
    
    // MARK: - Actions -

    @IBAction func resendInviteButtonTapped(_ sender: Any) {
    }
    
    @IBAction func removeButtonTapped(_ sender: Any) {
        // call api to remove pending invite
        SVProgressHUD.show()
        App.shared.api.deleteTimesheetTeamMember(item.id.intValue) { (success, error) in
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Removing successful...")
            self.popViewController()
        }
    }
    
    @IBAction func adminButtonTapped(_ sender: Any) {
        role = "Admin"
    }
    
    @IBAction func managerButtonTapped(_ sender: Any) {
        role = "Manager"
    }
    
    @IBAction func employeeButtonTapped(_ sender: Any) {
        role = "Employee"
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        
        let params: Parameters = ["role": role]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putTimesheetTeamMember(item.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            self.popViewController()
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let isActive = item.status.boolValue
        
        // check
        if section == 0 {
            return 0
        } else if section == 1 {
            return isActive ? 0 : 44
        } else if section == 2 || section == 4 || section == 5 || section == 6 {
            return isActive ? 44 : 0
        } else if section == 3 {
            return 87
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        let isActive = item.status.boolValue
        
        // check
        if section == 2 && isActive {
            return "EMAIL ADDRESS"
        } else if section == 3 {
            return "ASSIGN ROLE"
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        let isActive = item.status.boolValue
        
        // check
        if section == 0 && !isActive {
            return "An invite email has been sent to the member. They'll join your account as soon as they accept the invite."
        } else if section == 6 && isActive {
            return "This is a user-specific setting and will not affect your account's location tracking preference."
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if indexPath.section == 1 {
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectDepartmentController") as? SelectDepartmentController
            controller?.item = item
            self.navigationController?.pushViewController(controller!, animated: true)
        } else if indexPath.section == 2 {
            self.pushTo(storyBoard: "Others", identifier: "sb_AttoOvertimeSettingController")
        }
    }
    
}

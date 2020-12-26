//
//  AttoOwnerDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 26/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AttoOwnerDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var locationTracking: UISwitch!
    
    var item: TimesheetTeamMember!
    
    

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
        self.navigationItem.title   = item.name
        
        emailLabel.text             = item.email
        locationTracking.isOn       = item.will_track_location.boolValue
    }
    
    // MARK: - Actions -
    
    @IBAction func saveButtonTapped(_ sender: Any) {
    }
    
    // MARK: - TableView Datasource -
    
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

//
//  AttoSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AttoSettingsController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var userFullName: UILabel!
    @IBOutlet var userEmail: UILabel!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        userFullName.text   = App.shared.user!.full_name
        userEmail.text      = App.shared.user!.email
    }
    
    override func viewDidAppear(_ animated: Bool) {
        self.parent?.navigationItem.title = "Settings"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if indexPath.section == 1 {
            self.pushTo(storyBoard: "Others", identifier: "sb_AttoNotificationController")
        } else if indexPath.section == 2 {
            switch indexPath.row {
                case 0:
                    self.pushTo(storyBoard: "Others", identifier: "sb_AttoTeamController")
                case 1:
                    self.pushTo(storyBoard: "Others", identifier: "sb_AttoInviteMemberController")
                default:
                    break
            }
        } else {
            let ids = ["sb_AttoDepartmentController", "sb_AttoWorkweekController", "sb_AttoTimesheetController", "sb_AttoManualEntriesController", "sb_AttoTimeOptionsController", "sb_AttoBreakPrefsController", "sb_AttoJobCodesController", "sb_AttoPTOController", "sb_AttoLocationTrackingController", "sb_AttoJobSitesController"]
            self.pushTo(storyBoard: "Others", identifier: ids[indexPath.row])
        }
    }

}

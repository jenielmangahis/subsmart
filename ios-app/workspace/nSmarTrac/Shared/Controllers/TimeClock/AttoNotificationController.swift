//
//  AttoNotificationController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import MultiSelectSegmentedControl
import SVProgressHUD

class AttoNotificationController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var clockInReminder: UISwitch!
    @IBOutlet var clockInReminderTime: UIButton!
    @IBOutlet var clockOutReminder: UISwitch!
    @IBOutlet var clockOutReminderTime: UIButton!
    @IBOutlet var whenEnterAJobSite: UISwitch!
    @IBOutlet var whenLeaveAJobSite: UISwitch!
    @IBOutlet var clockedInFor12h: UISwitch!
    @IBOutlet var clockedInFor24h: UISwitch!
    @IBOutlet var daysToBeReminded: MultiSelectSegmentedControl!
    @IBOutlet var whenUserClocksIn: UISwitch!
    @IBOutlet var whenUserClocksOut: UISwitch!
    @IBOutlet var whenUserStartsABreak: UISwitch!
    @IBOutlet var whenUserEndsABreak: UISwitch!
    @IBOutlet var whenTimEntryIsModified: UISwitch!
    @IBOutlet var timePicker: UIDatePicker!
    @IBOutlet var timePicker2: UIDatePicker!
    
    var willRemindDuringClockIn: Bool = true
    var willRemindDuringClockOut: Bool = true
    var willShowPicker: Bool = false
    var willShowPicker2: Bool = false
    
    var item: TimesheetNotificationSetting?
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initMultiSelect()
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // check if not nil
        if let item = App.shared.timesheetNotificationSettings {
            // assign
            self.item = item
            
            clockInReminder.isOn        = item.clocked_in_reminder.boolValue
            clockOutReminder.isOn       = item.clocked_out_reminder.boolValue
            whenEnterAJobSite.isOn      = item.when_enter_a_job_site.boolValue
            whenLeaveAJobSite.isOn      = item.when_leave_a_job_site.boolValue
            clockedInFor12h.isOn        = item.clocked_in_for_12h.boolValue
            clockedInFor24h.isOn        = item.clocked_in_for_24h.boolValue
            whenUserClocksIn.isOn       = item.when_user_clock_in.boolValue
            whenUserClocksOut.isOn      = item.when_user_clock_out.boolValue
            whenUserStartsABreak.isOn   = item.when_user_start_a_break.boolValue
            whenUserEndsABreak.isOn     = item.when_user_ends_a_break.boolValue
            whenTimEntryIsModified.isOn = item.when_time_entry_is_modified.boolValue
            
            clockInReminderTime.setTitle(item.clocked_in_reminder_time, for: .normal)
            clockOutReminderTime.setTitle(item.clocked_out_reminder_time, for: .normal)
            daysToBeReminded.selectedSegmentIndexes = [0, 1, 2, 3, 4, 5]
            
            willRemindDuringClockIn = clockInReminder.isOn
            willRemindDuringClockOut = clockOutReminder.isOn
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func clockInReminderSwitchValueChanged(_ sender: Any) {
        willRemindDuringClockIn = clockInReminder.isOn
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func clockOutReminderSwitchValueChanged(_ sender: Any) {
        willRemindDuringClockOut = clockOutReminder.isOn
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func remindDuringClockInButtonTapped(_ sender: Any) {
        // set
        willShowPicker = !willShowPicker
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if willShowPicker {
            clockInReminderTime.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            clockInReminderTime.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func remindDuringClockOutButtonTapped(_ sender: Any) {
        // set
        willShowPicker2 = !willShowPicker2
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if willShowPicker2 {
            clockOutReminderTime.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            clockOutReminderTime.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func timePickerValueChanged(_ sender: UIDatePicker) {
        clockInReminderTime.setTitle(App.shared.timeFormatter.string(from: sender.date), for: .normal)
    }
    
    @IBAction func timePicker2ValueChanged(_ sender: UIDatePicker) {
        clockOutReminderTime.setTitle(App.shared.timeFormatter.string(from: sender.date), for: .normal)
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["clocked_in_reminder": clockInReminder.isOn,
                                  "clocked_in_reminder_time": clockInReminderTime.titleLabel?.text! ?? "",
                                  "clocked_out_reminder": clockOutReminder.isOn,
                                  "clocked_out_reminder_time": clockOutReminderTime.titleLabel?.text! ?? "",
                                  "when_enter_a_job_site": whenEnterAJobSite.isOn,
                                  "when_leave_a_job_site": whenLeaveAJobSite.isOn,
                                  "clocked_in_for_12h": clockedInFor12h.isOn,
                                  "clocked_in_for_24h": clockedInFor12h.isOn,
                                  "when_user_clock_in": whenUserClocksIn.isOn,
                                  "when_user_clock_out": whenUserClocksOut.isOn,
                                  "when_user_start_a_break": whenUserStartsABreak.isOn,
                                  "when_user_ends_a_break": whenUserEndsABreak.isOn,
                                  "when_time_entry_is_modified": whenTimEntryIsModified.isOn,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putTimesheetNotificationSetting(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            
            // update settings
            App.shared.api.getTimesheetNotificationSetting() { (result, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // check
                if result != nil {
                    self.item = result
                    App.shared.timesheetNotificationSettings = result
                }
            }
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row = indexPath.row
        
        // check
        if section == 0 {
            if row == 1 {
                return willRemindDuringClockIn ? 44 : 0
            } else if row == 2 {
                return willShowPicker ? 216 : 0
            }
            return 44
        } else if section == 1 {
            if row == 1 {
                return willRemindDuringClockOut ? 44 : 0
            } else if row == 2 {
                return willShowPicker2 ? 216 : 0
            }
            return 44
        }
        return 44
    }
    

}

// MARK: - MultiSelectSegmentedControlDelegate -

extension AttoNotificationController: MultiSelectSegmentedControlDelegate {
    
    func initMultiSelect() {
        daysToBeReminded.delegate = self
        daysToBeReminded.items = ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"]
        daysToBeReminded.selectedSegmentIndexes = [0, 1, 2, 3, 4]
    }
    
    func multiSelect(_ multiSelectSegmentedControl: MultiSelectSegmentedControl, didChange value: Bool, at index: Int) {
        
    }
}

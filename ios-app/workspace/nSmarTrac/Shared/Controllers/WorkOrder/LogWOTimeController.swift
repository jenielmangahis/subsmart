//
//  LogWOTimeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import SVProgressHUD

class LogWOTimeController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var woIcon: UIImageView!
    @IBOutlet var userIcon: UIImageView!
    @IBOutlet var markerIcon: UIImageView!
    @IBOutlet var calendarIcon: UIImageView!
    
    @IBOutlet var workOrderNum: UILabel!
    @IBOutlet var customerName: UILabel!
    @IBOutlet var jobLocation: UILabel!
    @IBOutlet var date: UILabel!
    
    @IBOutlet var assignee: UILabel!
    @IBOutlet var startTime: UILabel!
    @IBOutlet var endTime: UILabel!
    @IBOutlet var estimatedHours: UILabel!
    @IBOutlet var actualStartTime: MaterialDatePickerField!
    @IBOutlet var actualEndTime: MaterialDatePickerField!
    @IBOutlet var totalHours: UILabel!
    @IBOutlet var variance: UILabel!
    
    var item: WorkOrder!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Log Time"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure icons
        woIcon.image = UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        userIcon.image = UIImage.fontAwesomeIcon(name: .user, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        markerIcon.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarAlt, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        
        // configure date fields
        actualStartTime.datePickerMode  = .time
        actualEndTime.datePickerMode    = .time
        actualEndTime.minimumDate       = actualStartTime.date
        actualStartTime.addTarget(self, action: #selector(updateTotalHours(_:)), for: .editingDidEnd)
        actualEndTime.addTarget(self, action: #selector(updateTotalHours(_:)), for: .editingDidEnd)
        
        // get estimated hours
        let start = App.shared.timesheetDateTimeFormatter.date(from: item.start_date + " " + item.start_time)
        let end = App.shared.timesheetDateTimeFormatter.date(from: item.end_date + " " + item.end_time)
        let diff = Calendar.current.dateComponents([.hour, .minute], from: start!, to: end!)
        
        // configure labels
        workOrderNum.text   = "Work Order # \(item.work_order_number)"
        customerName.text   = item.customer_name
        jobLocation.text    = item.job_location
        date.text           = item.start_date.getDay + ", " + item.start_date.toReadableDate
        assignee.text       = item.employee_name
        startTime.text      = item.start_time
        endTime.text        = item.end_time
        estimatedHours.text = "\(diff.hour!)hrs \(diff.minute!)mins"
    }
    
    // MARK: - Actions -
    
    @objc func updateTotalHours(_ sender: Any) {
        // get estimated hours
        let start = App.shared.timesheetDateTimeFormatter.date(from: item.start_date + " " + item.start_time)
        let end = App.shared.timesheetDateTimeFormatter.date(from: item.end_date + " " + item.end_time)
        let diff = Calendar.current.dateComponents([.hour, .minute], from: start!, to: end!)
        
        // get total hours
        let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: actualStartTime.date, to: actualEndTime.date)
        totalHours.text = "\(actualDiff.hour!)hrs \(actualDiff.minute!)mins"
        
        // set variance
        let hourDiff = actualDiff.hour! - diff.hour!
        let minsDiff = actualDiff.minute! - diff.hour!
        variance.text = "Variance: \(hourDiff)hr \(abs(minsDiff))mins"
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // get estimated hours
        let start = App.shared.timesheetDateTimeFormatter.date(from: item.start_date + " " + item.start_time)
        let end = App.shared.timesheetDateTimeFormatter.date(from: item.end_date + " " + item.end_time)
        let diff = Calendar.current.dateComponents([.hour, .minute], from: start!, to: end!)
        let plannedDiff = "\(diff.hour!):\(diff.minute!)".decimalTime
        
        // get total hours
        let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: actualStartTime.date, to: actualEndTime.date)
        let shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
        
        // get overtime
        let overtime = (shiftDuration > plannedDiff) ? shiftDuration - plannedDiff : 0.00
        
        
        let params: Parameters = ["user_id": App.shared.user!.id,
                                  "shift_duration": shiftDuration,
                                  "break_duration": 0.00,
                                  "overtime": overtime,
                                  "break_remaining_time": "",
                                  "expected_endbreak": 0,
                                  "date_in": App.shared.dateFormatter.string(from: Date()),
                                  "date_out": App.shared.dateFormatter.string(from: Date()),
                                  "status": 0]
        
        // add attendance
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postTimesheetAttendance(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            // id
            if let id = result?.Data {
                
                // create group
                let group = DispatchGroup()
                
                // enter group
                group.enter()
                
                // check in
                let params2: Parameters = ["attendance_id": id,
                                           "user_id": App.shared.user!.id,
                                           "action": "Check in",
                                           "entry_type": "Manual",
                                           "approved_by": 0,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": self.item.id,
                                           "notes": ""]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postTimesheetLog(params2) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
                
                // enter group
                group.enter()
                
                // check out
                let params3: Parameters = ["attendance_id": id,
                                           "user_id": App.shared.user!.id,
                                           "action": "Check out",
                                           "entry_type": "Manual",
                                           "approved_by": 0,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": self.item.id,
                                           "notes": ""]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postTimesheetLog(params3) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
                
                group.notify(queue: DispatchQueue.main, execute: {
                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                    self.popViewController()
                })
            }
            
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }

}

// MARK: - Extensions -

extension String {
    
    var decimalTime: Double {
        let comps = self.components(separatedBy: ":")
        let h = (Int(comps.first!) ?? 0) * 60
        let m = (Int(comps[1]) ?? 0)
        let total = h + m
        return total.doubleValue / 60
    }
}

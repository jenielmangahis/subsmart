//
//  UserTimesheetController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import Alamofire
import FontAwesome_swift
import SVProgressHUD

class UserTimesheetController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var dateRangeView: UIView!
    @IBOutlet var weekLabel: UILabel!
    @IBOutlet var totalHoursLabel: UILabel!
    @IBOutlet var regularHoursLabel: UILabel!
    @IBOutlet var overtimeHoursLabel: UILabel!
    @IBOutlet var breakHoursLabel: UILabel!
    @IBOutlet var ptoHoursLabel: UILabel!
    
    var startDateOfWeek  = Date().dateFor(.startOfWeek)
    var endDateOfWeek    = Date().dateFor(.endOfWeek)
    
    var item: TimesheetTeamMember!
    
    var headerDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "dd MMM"
        return formatter
    }()
    
    var dayFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "EEE"
        return formatter
    }()
    
    var dateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MM/dd"
        return formatter
    }()
    
    var timeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "h:mma"
        return formatter
    }()
    
    

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
        // init
        self.title = item.name
        self.dateRangeView.borders(for: [.bottom], width: 1, color: .systemGroupedBackground)
        self.weekLabel.text = headerDateFormatter.string(from: startDateOfWeek) + " - " + headerDateFormatter.string(from: endDateOfWeek)
        
        self.totalHoursLabel.text = "Total Hours • " + (App.shared.toAbbreviatedHourFormatter.string(from: item.total_hours * 3600) ?? "0m")
        self.regularHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: item.total_hours * 3600) ?? "0m"
        self.overtimeHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: item.total_overtime * 3600) ?? "0m"
        self.breakHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: item.total_break * 3600) ?? "0m"
        self.ptoHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: item.total_pto * 3600) ?? "0m"
    }
    
    // returns clock in, clock out, total hours
    func getTimeEntry(_ startDate: Date) -> (String, String, String)? {
        // date string
        let date = App.shared.dateFormatter.string(from: startDate)
        
        // init
        var clockIn = ""
        var clockOut = ""
        var totalHours = 0.0
        
        // iterate attendance
        for attendance in item.attendance {
            // get date
            if let date_created = App.shared.dateTimeFormatter.date(from: attendance.date_created) {
                
                let dateString = App.shared.dateFormatter.string(from: date_created)
                
                // check
                if dateString == date {
                    // assign
                    //totalHours = App.shared.toAbbreviatedHourFormatter.string(from: attendance.shift_duration.doubleValue * 3600) ?? "0m"
                    totalHours += attendance.shift_duration.doubleValue
                    
                    // get clock in/ out hours
                    // iterate
                    for log in attendance.logs {
                        let logDate = App.shared.dateTimeFormatter.date(from: log.date_created)
                        
                        // check
                        if log.action == "Check in" && clockIn.isEmpty {
                            clockIn = timeFormatter.string(from: logDate!).lowercased()
                        } else if log.action == "Check out" {
                            clockOut = timeFormatter.string(from: logDate!).lowercased()
                        }
                    }
                    
                    //return (clockIn, clockOut, totalHours)
                }
            }
        }
        
        // check if 0
        if totalHours == 0.0 {
            return nil
        }
        
        return (clockIn, clockOut, App.shared.toAbbreviatedHourFormatter.string(from: totalHours * 3600) ?? "0m")
    }
    
    // returns attendance of specific date
    func getAttendace(_ date: Date) -> TimesheetAttendance? {
        // date string
        let date = App.shared.dateFormatter.string(from: date)
        
        // iterate attendance
        for attendance in item.attendance {
            // get date
            if let date_created = App.shared.dateTimeFormatter.date(from: attendance.date_created) {
                // get date string
                let dateString = App.shared.dateFormatter.string(from: date_created)
                
                // check
                if dateString == date {
                    return attendance
                }
            }
        }
        return nil
    }

    // MARK: - Load data -

    func loadData() {
        
        // set weekLabel
        self.weekLabel.text = headerDateFormatter.string(from: startDateOfWeek) + " - " + headerDateFormatter.string(from: endDateOfWeek)
        
        // get selected week
        let startDate = App.shared.dateFormatter.string(from: startDateOfWeek)
        let endDate = App.shared.dateFormatter.string(from: endDateOfWeek)
        
        App.shared.api.getTimesheetForMember(item!.user_id.intValue, startDate, endDate) { (result, error) in
            if let e = error {
                return print(e.localizedDescription)
            }
            
            self.totalHoursLabel.text = "Total Hours • " + (App.shared.toAbbreviatedHourFormatter.string(from: result!.total_hours * 3600) ?? "0m")
            self.regularHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result!.total_hours * 3600) ?? "0m"
            self.overtimeHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result!.total_overtime * 3600) ?? "0m"
            self.breakHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result!.total_break * 3600) ?? "0m"
            self.ptoHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result!.total_pto * 3600) ?? "0m"

            self.item = result
            self.tableView.reloadData()
        }
    }
    
    // MARK: - Actions -

    @IBAction func addButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Others", identifier: "sb_AddTimeEntryController")
    }
    
    @IBAction func prevButtonTapped(_ sender: Any) {
        self.startDateOfWeek = self.startDateOfWeek.adjust(.week, offset: -1)
        self.endDateOfWeek = self.endDateOfWeek.adjust(.week, offset: -1)
        self.loadData()
    }
    
    @IBAction func nextButtonTapped(_ sender: Any) {
        self.startDateOfWeek = self.startDateOfWeek.adjust(.week, offset: 1)
        self.endDateOfWeek = self.endDateOfWeek.adjust(.week, offset: 1)
        self.loadData()
    }
    
    @IBAction func sendReportButtonTapped(_ sender: Any) {
        // show alert
        let alertController = UIAlertController(title: "Send Report to:", message: App.shared.user!.email, preferredStyle: .actionSheet)
        let yesAction = UIAlertAction(title: "Send Report", style: .default) { [self] (alertAction) -> Void in
            
            // get start and end date
            let startDate = App.shared.dateFormatter.string(from: self.startDateOfWeek)
            let endDate = App.shared.dateFormatter.string(from: self.endDateOfWeek)
            
            SVProgressHUD.show()
            App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
                SVProgressHUD.dismiss()
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // init
                var regularHours: Double = 0.0
                var overtimeHours: Double = 0.0
                var breakHours: Double = 0.0
                var ptoHours: Double = 0.0
                
                // iterate
                for item in list {
                    regularHours += item.total_hours
                    overtimeHours += item.total_overtime
                    breakHours += item.total_break
                    ptoHours += item.total_pto
                }
                
                
                // get proper date
                let mStartDate = App.shared.monthDateFormatter.string(from: self.startDateOfWeek)
                let mEndDate = App.shared.monthDateFormatter.string(from: self.endDateOfWeek)
                
                // init date
                var date = mStartDate + " - " + mEndDate
                
                // check
                let startMonthDay = mStartDate.components(separatedBy: " ")
                let endMonthDay = mEndDate.components(separatedBy: " ")
                
                // check if not nil
                if let startMonth = startMonthDay.first,
                   let endMonth = endMonthDay.first, let endDay = endMonthDay.last {
                    // check
                    if startMonth == endMonth {
                        date = mStartDate + " - " + endDay
                    }
                }
                
                
                var subject = self.item.name + " : Timesheet Report from nSmarTrac - " + date
                var message = "Below you\'ll find the timesheet report you requested for <b>" + self.item.name + "</b> for the period <b>" + date + "</b>"
                // check
                if self.item.name == App.shared.user!.full_name {
                    subject = "Your Timesheet Report from nSmarTrac - " + date
                    message = "Below you\'ll find the timesheet report for the period <b>" + date + "</b>"
                }
                
                
                // params
                let params: Parameters = ["requester": App.shared.user!.full_name,
                                          "email": App.shared.user!.email,
                                          "subject": subject,
                                          "message": message,
                                          "date": date,
                                          "link": "user_id=\(self.item.user_id)&start_date=\(startDate)&end_date=\(endDate)",
                                          "total_hours": App.shared.toAbbreviatedHourFormatter.string(from: breakHours * regularHours) ?? "0m",
                                          "total_break": App.shared.toAbbreviatedHourFormatter.string(from: breakHours * 3600) ?? "0m",
                                          "total_overtime": App.shared.toAbbreviatedHourFormatter.string(from: overtimeHours * 3600) ?? "0m",
                                          "total_pto": App.shared.toAbbreviatedHourFormatter.string(from: ptoHours * 3600) ?? "0m"]
                
                SVProgressHUD.show()
                App.shared.api.postTimesheetReport(params) { (result, error) in
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    guard result?.Code == 200 else {
                        return SVProgressHUD.showError(withStatus: result!.Message)
                    }
                    
                    SVProgressHUD.showSuccess(withStatus: "Timesheet report generated!")
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 7
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // get date of a row
        let rowDate = self.startDateOfWeek.adjust(.day, offset: indexPath.row)
        
        // get icon
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        view.borderColor        = .lightGray
        view.borderWidth        = 1
        view.cornerRadius       = 5
        
        let label               = UILabel(frame: CGRect(x: 0, y: 0, width: 40, height: 20))
        label.font              = UIFont.robotoFont(ofSize: 12)
        label.text              = dayFormatter.string(from: rowDate)
        label.textAlignment     = .center
        label.textColor         = .label
        label.backgroundColor   = .systemGroupedBackground
        view.addSubview(label)
        
        let date            = UILabel(frame: CGRect(x: 0, y: 21, width: 40, height: 20))
        date.font           = UIFont.robotoFont(ofSize: 10)
        date.text           = dateFormatter.string(from: rowDate)
        date.textAlignment  = .center
        date.textColor      = .lightGray
        view.addSubview(date)
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // date icon
        cell.imageView?.image       = view.asImage()
        
        // check
        if let result = getTimeEntry(rowDate) {
            // start time
            let startTimeLabel = UILabel()
            startTimeLabel.font = UIFont.robotoFont(ofSize: 12)
            startTimeLabel.textColor = .label
            startTimeLabel.text = result.0
            startTimeLabel.frame.size = startTimeLabel.intrinsicContentSize
            startTimeLabel.frame = CGRect(x: 80, y: 20, width: startTimeLabel.frame.size.width, height: 20)
            cell.contentView.addSubview(startTimeLabel)
            
            // arrow
            let arrow = UIImageView(frame: CGRect(x: 88 + startTimeLabel.frame.size.width, y: 25, width: 10, height: 10))
            arrow.image = UIImage(systemName: "arrow.right")
            arrow.tintColor = .lightGray
            cell.contentView.addSubview(arrow)
            
            // end time
            let endTimeLabel = UILabel(frame: CGRect(x: 106 + startTimeLabel.frame.size.width, y: 20, width: 60, height: 20))
            endTimeLabel.font = UIFont.robotoFont(ofSize: 12)
            endTimeLabel.textColor = .label
            endTimeLabel.text = !result.1.isEmpty ? result.1 : "Active"
            cell.contentView.addSubview(endTimeLabel)
            
            // total hours
            let totalHoursLabel = UILabel(frame: CGRect(x: Device.width-120, y: 20, width: 80, height: 20))
            totalHoursLabel.font = UIFont.robotoFont(ofSize: 14)
            totalHoursLabel.textAlignment = .right
            totalHoursLabel.textColor = .label
            totalHoursLabel.text = result.2
            cell.contentView.addSubview(totalHoursLabel)
            
            cell.accessoryType = .disclosureIndicator
            
        } else {
            let mLabel = UILabel(frame: CGRect(x: 80, y: 20, width: 80, height: 20))
            mLabel.font = UIFont.robotoFont(ofSize: 13)
            mLabel.textColor = .lightGray
            mLabel.text = "Not Active!"
            cell.contentView.addSubview(mLabel)
            
            // plus button
            let button          = UIButton(frame: CGRect(x: Device.width-40, y: 15, width: 30, height: 30))
            button.borderColor  = .lightGray
            button.borderWidth  = 1
            button.cornerRadius = 15
            button.tintColor    = .lightGray
            button.setImage(UIImage.fontAwesomeIcon(name: .plus, style: .regular, textColor: .lightGray, size: CGSize(width: 30, height: 30)), for: .normal)
            cell.contentView.addSubview(button)
            
            cell.accessoryType  = .none
        }
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        // get date of a row
        let date = self.startDateOfWeek.adjust(.day, offset: indexPath.row)
        
        // check
        if let result = getAttendace(date) {
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_TimeEntryDetailController") as? TimeEntryDetailController
            controller?.name = item.name
            controller?.user_id = item.user_id.intValue
            controller?.selectedDate = date
            self.navigationController?.pushViewController(controller!, animated: true)
        } else {
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddTimeEntryController") as? AddTimeEntryController
            controller?.selectedDates = [self.startDateOfWeek.adjust(.day, offset: indexPath.row)]
            self.navigationController?.pushViewController(controller!, animated: true)
        }
    }
    
}

//
//  TimeEntryDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 22/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DottedLineView
import FSCalendar
import Material
import SVProgressHUD

class TimeEntryDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var calendar: FSCalendar!
    @IBOutlet var dateLabel: UILabel!
    @IBOutlet var containerView: UIView!
    @IBOutlet var totalHoursLabel: UILabel!
    @IBOutlet var regularHoursLabel: UILabel!
    @IBOutlet var overtimeHoursLabel: UILabel!
    @IBOutlet var breakHoursLabel: UILabel!
    @IBOutlet var ptoHoursLabel: UILabel!
    
    var item: TimesheetTeamMember!
    var items: [TimesheetAttendance] = []
    
    var name: String!
    var user_id: Int!
    var selectedDate: Date!
    
    var monthDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMMM d"
        return formatter
    }()
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initCalendar()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // init
        self.title = name
        self.containerView.backgroundColor = .systemGroupedBackground
        self.dateLabel.text = monthDateFormatter.string(from: selectedDate)
        
        self.totalHoursLabel.text = "Total Hours • 0m"
        self.regularHoursLabel.text = "0m"
        self.overtimeHoursLabel.text = "0m"
        self.breakHoursLabel.text = "0m"
        self.ptoHoursLabel.text = "0m"
        
        
        // get selected week
        let startDate = App.shared.dateFormatter.string(from: selectedDate)
        let endDate = App.shared.dateFormatter.string(from: selectedDate)
        
        SVProgressHUD.show()
        App.shared.api.getTimesheetForMember(user_id, startDate, endDate) { (result, error) in
            if let e = error {
                return print(e.localizedDescription)
            }
            
            // check if not nil
            if let result = result {
                self.totalHoursLabel.text = "Total Hours • " + (App.shared.toAbbreviatedHourFormatter.string(from: result.total_hours * 3600) ?? "0m")
                self.regularHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result.total_hours * 3600) ?? "0m"
                self.overtimeHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result.total_overtime * 3600) ?? "0m"
                self.breakHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result.total_break * 3600) ?? "0m"
                self.ptoHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: result.total_pto * 3600) ?? "0m"
                
                self.items = result.attendance.filter({ item in
                    let date = Date(fromString: item.date_created, format: DateHelper.dateTimeFormatType)!
                    let date_created = App.shared.dateFormatter.string(from: date)
                    let today = App.shared.dateFormatter.string(from: self.selectedDate)
                    
                    return (date_created == today)
                })

                self.item = result
                self.tableView.reloadData()
                SVProgressHUD.dismiss()
            }
        }
    }
    
    // MARK: - Actions -

    @IBAction func addButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Others", identifier: "sb_AddTimeEntryController")
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        // get proper height
        let entry = items[indexPath.row]
        // check status
        if entry.status.intValue == 1 {
            return CGFloat(350 + entry.logs.count * 50)
        }
        return CGFloat(400 + entry.logs.count * 50)
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // get item
        let entry = items[indexPath.row]
        
        // init total time
        var totalTime = "0m"
        // get total time
        let createdDate = App.shared.dateTimeFormatter.date(from: entry.date_created)
        // check if active
        if entry.status.intValue == 1 {
            // get shift duration
            let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: createdDate!, to: Date())
            let shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
            totalTime = App.shared.toAbbreviatedHourFormatter.string(from: shiftDuration * 3600) ?? "0m"
        } else {
            totalTime = App.shared.toAbbreviatedHourFormatter.string(from: entry.shift_duration.doubleValue * 3600) ?? "0m"
        }
        
        
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.selectionStyle = .none
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // time entry
        let timeEntry = UILabel(frame: CGRect(x: 20, y: 30, width: Int(Device.width)-40, height: 20))
        timeEntry.font = UIFont.robotoBoldFont(ofSize: 17)
        timeEntry.textColor = .label
        timeEntry.text = "Time Entry • " + totalTime
        cell.contentView.addSubview(timeEntry)
        
        // check status to add edit and delete button
        if entry.status.intValue == 0 {
            let edit = UIButton(frame: CGRect(x: Device.width-76, y: 30, width: 24, height: 24))
            edit.tag = indexPath.row-1
            edit.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            edit.addTarget(self, action: #selector(editTimeEntry(_:)), for: .touchUpInside)
            cell.contentView.addSubview(edit)
            
            
            let delete = UIButton(frame: CGRect(x: Device.width-44, y: 30, width: 24, height: 24))
            delete.tag = indexPath.row-1
            delete.setImage(UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            delete.addTarget(self, action: #selector(deleteTimeEntry(_:)), for: .touchUpInside)
            cell.contentView.addSubview(delete)
        }
        
        let grayLine = createLine(x: 0, y: 60, width: Int(Device.width), height: 2)
        cell.contentView.addSubview(grayLine)
        
        var yCoor: Int = 0
        
        // check if manual
        if entry.logs.first?.entry_type == "Manual" {
            // add manual icon
            let icon = UIImageView(frame: CGRect(x: 20, y: 80, width: 30, height: 30))
            icon.image = UIImage(systemName: "m.circle.fill")
            icon.tintColor = .systemPurple
            cell.contentView.addSubview(icon)
            
            // manual text
            let text = UILabel(frame: CGRect(x: 60, y: 80, width: 150, height: 30))
            text.font = UIFont.robotoBoldFont(ofSize: 17)
            text.textColor = .systemPurple
            text.text = "Manual Entry"
            cell.contentView.addSubview(text)
            
            // gray line
            cell.contentView.addSubview(createLine(y: 130))
            
            // set yCoor
            yCoor = 132
        } else {
            // add image
            let mapImage = UIImageView(frame: CGRect(x: 0, y: 62, width: Device.width, height: 128))
            cell.addSubview(mapImage)
            
            // gray line
            cell.contentView.addSubview(createLine(x: 0, y: 190, width: Int(Device.width), height: 2))
            
            // set yCoor
            yCoor = 192
        }
        
        // add value to yCoor
        yCoor += 20
        
        
        var x = 0
        // iterate logs
        for log in entry.logs {
            
            // get log time
            let logTime = App.shared.dateTimeFormatter.date(from: log.date_created)
            
            // check log
            if log.action == "Check in" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoBoldFont(ofSize: 13)
                clockInTime.textColor = .label
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 100, y: yCoor-5, width: 30, height: 30))
                icon.image = generateClockIcon(.greenColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoBoldFont(ofSize: 16)
                action.textColor = .label
                action.text = "Clock In"
                cell.contentView.addSubview(action)
                
                // address
                let address = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 40))
                address.font = UIFont.robotoFont(ofSize: 13)
                address.numberOfLines = 2
                address.textColor = .lightGray
                address.text = !log.user_location_address.isEmpty ? log.user_location_address : "Manually Clocked by " + log.approved_by_name
                cell.contentView.addSubview(address)
                
                // add value to yCoor
                yCoor += 70
                
            } else if log.action == "Break in" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoFont(ofSize: 13)
                clockInTime.textColor = .lightGray
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // check previous log
                if entry.logs[x-1].action == "Break out" {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
                } else {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
                }
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
                icon.image = generateDot(.orangeColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoFont(ofSize: 13)
                action.textColor = .label
                action.text = "Start Break"
                cell.contentView.addSubview(action)
                
                // add value to yCoor
                yCoor += 50
                
            } else if log.action == "Break out" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoFont(ofSize: 13)
                clockInTime.textColor = .lightGray
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // print line
                cell.contentView.addSubview(createVerticalLine(.orangeColor, y: yCoor-35))
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
                icon.image = generateDot(.orangeColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoFont(ofSize: 13)
                action.textColor = .label
                action.text = "End Break"
                cell.contentView.addSubview(action)
                
                // add value to yCoor
                yCoor += 50
                
            } else if log.action == "Check out" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoBoldFont(ofSize: 13)
                clockInTime.textColor = .label
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // check previous log
                if entry.logs[x-1].action == "Break out" {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
                } else {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
                }
                
                let icon = UIImageView(frame: CGRect(x: 100, y: yCoor-5, width: 30, height: 30))
                icon.image = generateClockIcon(.redColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoBoldFont(ofSize: 16)
                action.textColor = .label
                action.text = "Clock Out"
                cell.contentView.addSubview(action)
                
                // address
                let address = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 40))
                address.font = UIFont.robotoFont(ofSize: 13)
                address.numberOfLines = 2
                address.textColor = .lightGray
                address.text = !log.user_location_address.isEmpty ? log.user_location_address : "Manually Clocked Out by " + log.approved_by_name
                cell.contentView.addSubview(address)
                
                // add value to yCoor
                yCoor += 70
            }
            
            x+=1
        }
        
        // check last log
        if (entry.logs.last?.action == "Break out" || entry.logs.last?.action == "Check in") && entry.status.intValue == 1 {
            
            // check previous log
            if entry.logs[x-1].action == "Break out" {
                // print line
                cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
            } else {
                // print line
                cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
            }
            
            let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
            icon.image = generateDot(.greenColor)
            cell.contentView.addSubview(icon)
            
            // action
            let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
            action.font = UIFont.robotoBoldFont(ofSize: 16)
            action.textColor = .label
            action.text = "On the Clock"
            cell.contentView.addSubview(action)
            
            // info
            let info = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 20))
            info.font = UIFont.robotoFont(ofSize: 13)
            info.textColor = .lightGray
            info.text = "Member is still active"
            cell.contentView.addSubview(info)
            
            // add value to yCoor
            yCoor += 70
        }
        
        // check status to add not field
        if entry.status.intValue == 0 {
            // add note
            let textView = TextView(frame: CGRect(x: 20, y: yCoor, width: Int(Device.width)-40, height: 80))
            textView.borderColor = UIColor(rgb: 0xf1f1f1)
            textView.borderWidth = 2
            textView.font = UIFont.robotoFont(ofSize: 13)
            textView.textColor = .label
            textView.placeholderLabel.font = UIFont.robotoFont(ofSize: 13)
            textView.placeholderLabel.text = "Type your notes here..."
            textView.placeholderLabel.textColor = .lightGray
            cell.contentView.addSubview(textView)
            
            // add value to yCoor
            yCoor += 110
        }
        
        // add zigzag
        let zigzag = UIImageView(frame: CGRect(x: (Int(Device.width)-100)/2, y: yCoor, width: 100, height: 10))
        zigzag.image = UIImage(named: "ic_zigzag")
        cell.contentView.addSubview(zigzag)
        
        
        return cell
    }
    
    // MARK: - Protocol -
    
    @objc func editTimeEntry(_ sender: UIButton) {
        
    }
    
    @objc func deleteTimeEntry(_ sender: UIButton) {
        // show alert
        let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // delete item at indexPath
            let item = self.items[sender.tag]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Deleting...")
            App.shared.api.deleteTimesheetAttendance(item.id.intValue) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                }
                
                // reload view
                self.initViews()
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    // MARK: - Other Functions -
    
    func createLine(x: Int = 20, y: Int, width: Int = Int(Device.width)-40, height: Int = 2) -> UIView {
        let grayLine = UIView(frame: CGRect(x: x, y: y, width: width, height: height))
        grayLine.backgroundColor = UIColor(rgb: 0xf1f1f1)
        return grayLine
    }
    
    func generateClockIcon(_ color: UIColor) -> UIImage {
        // large circle
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 30, height: 30))
        view.backgroundColor    = color.withAlphaComponent(0.2)
        view.borderWidth        = 1
        view.borderColor        = color
        view.cornerRadius       = 15
        
        // small circle
        let small = UIView(frame: CGRect(x: 10, y: 10, width: 10, height: 10))
        small.backgroundColor    = color
        small.cornerRadius       = 5
        view.addSubview(small)
        
        return view.asImage()
    }
    
    func generateDot(_ color: UIColor = .greenColor) -> UIImage {
        let small = UIView(frame: CGRect(x: 0, y: 0, width: 10, height: 10))
        small.backgroundColor    = color
        small.cornerRadius       = 5
        return small.asImage()
    }
    
    func createVerticalLine(_ color: UIColor = UIColor(rgb: 0xf1f1f1), y: Int) -> UIView {
        let line = UIView(frame: CGRect(x: 114, y: y, width: 2, height: 50))
        line.backgroundColor = color
        return line
    }
    
    func createDashLine(_ y: Int) -> UIView {
        let line = DottedLineView(frame: CGRect(x: 114, y: y, width: 2, height: 50))
        line.horizontal = false
        line.lineWidth = 2
        line.lineColor = UIColor(rgb: 0xf1f1f1)
        return line
    }

}

// MARK: - FSCalendar Datasource -

extension TimeEntryDetailController: FSCalendarDataSource, FSCalendarDelegate, FSCalendarDelegateAppearance {
    
    // MARK: - Calendar - 09300537911
    
    func initCalendar() {
        // init calendar
        calendar.calendarWeekdayView.backgroundColor    = .clear
        calendar.allowsMultipleSelection                = false
        calendar.appearance.weekdayTextColor            = AppTheme.defaultLinkColor
        calendar.appearance.weekdayFont                 = UIFont.robotoBoldFont(ofSize: 13)
        calendar.appearance.borderDefaultColor          = .clear
        calendar.appearance.borderSelectionColor        = .clear
        calendar.appearance.selectionColor              = AppTheme.defaultLinkColor
        calendar.appearance.separators                  = .none
        calendar.appearance.titleFont                   = UIFont.robotoFont(ofSize: 13)
        calendar.appearance.titleTodayColor             = AppTheme.defaultLinkColor
        calendar.appearance.titleSelectionColor         = .white
        calendar.appearance.todayColor                  = .clear
        calendar.appearance.todaySelectionColor         = AppTheme.defaultLinkColor
        calendar.scope                                  = .week
        calendar.weekdayHeight                          = 42
        calendar.rowHeight                              = 43
        calendar.pagingEnabled                          = false
        calendar.scrollEnabled                          = true
        calendar.scrollDirection                        = .horizontal
        calendar.select(selectedDate)
    }
    
    func calendar(_ calendar: FSCalendar, didSelect date: Date, at monthPosition: FSCalendarMonthPosition) {
        selectedDate = date
        initViews()
    }
}

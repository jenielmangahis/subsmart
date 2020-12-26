//
//  AttoWorkweekController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AttoWorkweekController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var startDayButton: UIButton!
    @IBOutlet var hoursPerWeekButton: UIButton!
    @IBOutlet var hoursPerDayButton: UIButton!
    
    @IBOutlet var startDayPicker: UIPickerView!
    @IBOutlet var hoursPerWeekPicker: UIPickerView!
    @IBOutlet var hoursPerDayPicker: UIDatePicker!
    
    @IBOutlet var noOvertimeButton: DLRadioButton!
    @IBOutlet var dailyOvertimeButton: DLRadioButton!
    @IBOutlet var weeklyOvertimeButton: DLRadioButton!
    
    var isStartDay: Bool = false
    var isHoursPerWeek: Bool = false
    var isHoursPerDay: Bool = false
    var overtime: String = "No Overtime"
    
    var startDayPickerData: [String] = []
    var hoursPerWeekPickerData: [[String]] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        initPickerView()
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
            startDayButton.setTitle(item.workweek_start_day, for: .normal)
            hoursPerWeekButton.setTitle(item.regular_hours_per_week, for: .normal)
            hoursPerDayButton.setTitle(item.regular_hours_per_day, for: .normal)
            
            noOvertimeButton.configureRadio((item.overtime == "No Overtime") ? true : false)
            dailyOvertimeButton.configureRadio((item.overtime == "Daily Overtime") ? true : false)
            weeklyOvertimeButton.configureRadio((item.overtime == "Weekly Overtime") ? true : false)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure radio
        noOvertimeButton.otherButtons = [dailyOvertimeButton, weeklyOvertimeButton]
        noOvertimeButton.configureRadio(true)
        dailyOvertimeButton.configureRadio()
        weeklyOvertimeButton.configureRadio()
        
        startDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        hoursPerWeekButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        hoursPerDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
    }
    
    // MARK: - Actions -
    
    @IBAction func startDayButtonTapped(_ sender: Any) {
        isStartDay = !isStartDay
        isHoursPerWeek = false
        isHoursPerDay = false
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if isStartDay {
            startDayButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            startDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func hoursPerWeekButtonTapped(_ sender: Any) {
        isHoursPerWeek = !isHoursPerWeek
        isStartDay = false
        isHoursPerDay = false
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if isHoursPerWeek {
            hoursPerWeekButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            hoursPerWeekButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func hoursPerDayButtonTapped(_ sender: Any) {
        isHoursPerDay = !isHoursPerDay
        isStartDay = false
        isHoursPerWeek = false
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if isHoursPerDay {
            hoursPerDayButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            hoursPerDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func hoursPerDayPickerValueChanged(_ sender: UIDatePicker) {
        let timeFormatter: DateFormatter = {
            let formatter = DateFormatter()
            formatter.dateFormat = "HH:mm"
            return formatter
        }()
        
        let time = timeFormatter.string(from: sender.date).components(separatedBy: ":")
        // check
        if let hour = time.first, let mins = time.last {
            // check
            if hour.intValue > 0 {
                hoursPerDayButton.setTitle("\(String(format: "%d", Int(hour)!))h", for: .normal)
                
                // check mins
                if mins.intValue > 0 {
                    hoursPerDayButton.setTitle("\(String(format: "%d", Int(hour)!))h \(String(format: "%d", Int(mins)!))m", for: .normal)
                }
            } else {
                hoursPerDayButton.setTitle("\(String(format: "%d", Int(mins)!))m", for: .normal)
            }
        }
    }
    
    @IBAction func noOvertimeButtonTapped(_ sender: Any) {
        overtime = "No Overtime"
    }
        
    @IBAction func dailyOvertimeButtonTapped(_ sender: Any) {
        overtime = "Daily Overtime"
    }
        
    @IBAction func weeklyOvertimeButtonTapped(_ sender: Any) {
        overtime = "Weekly Overtime"
    }
        
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "workweek_start_day": startDayButton.titleLabel?.text! ?? "",
                                  "regular_hours_per_week": hoursPerWeekButton.titleLabel?.text! ?? "",
                                  "regular_hours_per_day": hoursPerDayButton.titleLabel?.text! ?? "",
                                  "overtime": overtime]
        
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
        let row = indexPath.row
        
        // check
        if section == 0 {
            if row == 1 {
                return isStartDay ? 216 : 0
            } else if row == 3 {
                return isHoursPerWeek ? 216 : 0
            } else if row == 5 {
                return isHoursPerDay ? 216 : 0
            }
        } else if section == 1 {
            return 87
        }
        return 44
    }
    
}

// MARK: - UIPickerViewDelegate, UIPickerViewDataSource

extension AttoWorkweekController: UIPickerViewDelegate, UIPickerViewDataSource {
    
    func initPickerView() {
        startDayPicker.delegate = self
        startDayPicker.dataSource = self
        
        hoursPerWeekPicker.delegate = self
        hoursPerWeekPicker.dataSource = self
        
        startDayPickerData = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
        
        var row: [String] = []
        var row2: [String] = []
        
        // generate data
        for x in 0...167 {
            row.append(x.stringValue)
        }
        for x in 0...11 {
            row2.append((x*5).stringValue)
        }
        hoursPerWeekPickerData = [row, row2]
    }
    
    // Sets number of columns in picker view
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        // check
        if pickerView == startDayPicker {
            return 1
        }
        return 2
    }

    // Sets the number of rows in the picker view
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        if pickerView == startDayPicker {
            return startDayPickerData.count
        }
        return hoursPerWeekPickerData[component].count
    }
    
    // This function sets the text of the picker view to the content of the "salutations" array
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        if pickerView == startDayPicker {
            return startDayPickerData[row]
        }
        return hoursPerWeekPickerData[component][row]
    }
    
    // When user selects an option, this function will set the text of the text field to reflect
    // the selected option.
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        if pickerView == startDayPicker {
            return startDayButton.setTitle(startDayPickerData[row], for: .normal)
        }
        
        let value = hoursPerWeekPickerData[0][pickerView.selectedRow(inComponent: 0)] + "h " + hoursPerWeekPickerData[1][pickerView.selectedRow(inComponent: 1)] + "m"
        return hoursPerWeekButton.setTitle(value, for: .normal)
    }
}

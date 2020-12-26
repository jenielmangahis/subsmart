//
//  AttoOvertimeSettingController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/6/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AttoOvertimeSettingController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var hoursPerWeekButton: UIButton!
    @IBOutlet var hoursPerDayButton: UIButton!
    
    @IBOutlet var hoursPerWeekPicker: UIPickerView!
    @IBOutlet var hoursPerDayPicker: UIDatePicker!
    
    @IBOutlet var noOvertimeButton: DLRadioButton!
    @IBOutlet var dailyOvertimeButton: DLRadioButton!
    @IBOutlet var weeklyOvertimeButton: DLRadioButton!
    
    var isHoursPerWeek: Bool = false
    var isHoursPerDay: Bool = false
    var overtime: String = "No Overtime"
    
    var hoursPerWeekPickerData: [[String]] = []
    
    var item: TimesheetSetting?
    
    

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
            self.item = item
            
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
        
        hoursPerWeekButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        hoursPerDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
    }
    
    // MARK: - Actions -
    
    @IBAction func hoursPerWeekButtonTapped(_ sender: Any) {
        isHoursPerWeek = !isHoursPerWeek
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
        let params: Parameters = ["user_id": App.shared.user!.id,
                                  "regular_hours_per_week": hoursPerWeekButton.titleLabel?.text! ?? "",
                                  "regular_hours_per_day": hoursPerDayButton.titleLabel?.text! ?? "",
                                  "overtime": overtime]
        
        UIApplication.shared.isNetworkActivityIndicatorVisible = true
        App.shared.api.putTimesheetSetting(params) { (result, error) in
            UIApplication.shared.isNetworkActivityIndicatorVisible = false
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
                    self.item = result
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
                return isHoursPerWeek ? 216 : 0
            } else if row == 3 {
                return isHoursPerDay ? 216 : 0
            }
        } else if section == 1 {
            return 87
        }
        return 44
    }

}

// MARK: - UIPickerViewDelegate, UIPickerViewDataSource

extension AttoOvertimeSettingController: UIPickerViewDelegate, UIPickerViewDataSource {
    
    func initPickerView() {
        
        hoursPerWeekPicker.delegate = self
        hoursPerWeekPicker.dataSource = self
        
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
        return 2
    }

    // Sets the number of rows in the picker view
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        return hoursPerWeekPickerData[component].count
    }
    
    // This function sets the text of the picker view to the content of the "salutations" array
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return hoursPerWeekPickerData[component][row]
    }
    
    // When user selects an option, this function will set the text of the text field to reflect
    // the selected option.
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        let value = hoursPerWeekPickerData[0][pickerView.selectedRow(inComponent: 0)] + "h " + hoursPerWeekPickerData[1][pickerView.selectedRow(inComponent: 1)] + "m"
        return hoursPerWeekButton.setTitle(value, for: .normal)
    }
}

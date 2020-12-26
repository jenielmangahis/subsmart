//
//  AttoTimesheetController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoTimesheetController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var emailReportSwitch: UISwitch!
    @IBOutlet var startDayButton: UIButton!
    @IBOutlet var scheduleButton: UIButton!
    @IBOutlet var payrollButton: UIButton!
    @IBOutlet var firstPayrollButton: UIButton!
    @IBOutlet var secondPayrollButton: UIButton!
    @IBOutlet var mLabel: UILabel!
    @IBOutlet var bottomView: DesignableView!
    
    @IBOutlet var startDayPicker: UIPickerView!
    @IBOutlet var schedulePicker: UIPickerView!
    
    var isReportingEnabled: Bool = false
    var isStartDay: Bool = false
    var isSchedule: Bool = false
    
    var startDayPickerData: [String] = []
    var schedulePickerData: [String] = []
    

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
            emailReportSwitch.isOn  = item.allow_email_report.boolValue
            startDayButton.setTitle(item.payroll_workweek_start_day, for: .normal)
            scheduleButton.setTitle(item.payroll_schedule, for: .normal)
            
            isReportingEnabled = emailReportSwitch.isOn
            
            bottomView.isHidden = isReportingEnabled
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        emailReportSwitch.addTarget(self, action: #selector(reportingSwitchValueChanged(_:)), for: .valueChanged)
        
        bottomView.isHidden = isReportingEnabled
    }
    
    // MARK: - Actions -
    
    @objc func reportingSwitchValueChanged(_ sender: UISwitch) {
        isReportingEnabled = sender.isOn
        bottomView.isHidden = sender.isOn
        self.tableView.reloadData()
    }
    
    @IBAction func startDayButtonTapped(_ sender: Any) {
        isStartDay = !isStartDay
        isSchedule = false
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if isStartDay {
            startDayButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            startDayButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func scheduleButtonTapped(_ sender: Any) {
        isSchedule = !isSchedule
        isStartDay = false
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if isSchedule {
            scheduleButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            scheduleButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func payrollButtonTapped(_ sender: Any) {
    }
    
    @IBAction func firstPayrollButtonTapped(_ sender: Any) {
    }
    
    @IBAction func secondPayrollButtonTapped(_ sender: Any) {
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "allow_email_report": emailReportSwitch.isOn,
                                  "payroll_workweek_start_day": startDayButton.titleLabel?.text! ?? "",
                                  "payroll_schedule": scheduleButton.titleLabel?.text! ?? ""]
        
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
        if section != 0 {
            if isReportingEnabled {
                if section == 1 {
                    if row == 1 {
                        return isStartDay ? 216 : 0
                    } else if row == 3 {
                        return isSchedule ? 216 : 0
                    }
                    return 44
                } else if section == 2 {
                    return 0
                }
            }
            return 0
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        if section == 1 && isReportingEnabled {
            return "PAYROLL PERIOD"
        }
        return nil
    }
    
}

// MARK: - UIPickerViewDelegate, UIPickerViewDataSource

extension AttoTimesheetController: UIPickerViewDelegate, UIPickerViewDataSource {
    
    func initPickerView() {
        startDayPicker.delegate = self
        startDayPicker.dataSource = self
        
        schedulePicker.delegate = self
        schedulePicker.dataSource = self
        
        startDayPickerData = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
        schedulePickerData = ["Weekly", "Bi-Weekly", "Semi-Monthly", "Monthly", "Custom"]
    }
    
    // Sets number of columns in picker view
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }

    // Sets the number of rows in the picker view
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        if pickerView == startDayPicker {
            return startDayPickerData.count
        }
        return schedulePickerData.count
    }
    
    // This function sets the text of the picker view to the content of the "salutations" array
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        if pickerView == startDayPicker {
            return startDayPickerData[row]
        }
        return schedulePickerData[row]
    }
    
    // When user selects an option, this function will set the text of the text field to reflect
    // the selected option.
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        if pickerView == startDayPicker {
            return startDayButton.setTitle(startDayPickerData[row], for: .normal)
        }
        return scheduleButton.setTitle(schedulePickerData[row], for: .normal)
    }
}

//
//  AttoTimeOptionsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoTimeOptionsController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var fixedTimezoneSwitch: UISwitch!
    @IBOutlet var timezoneButton: UIButton!
    @IBOutlet var decimalHoursSwitch: UISwitch!
    @IBOutlet var roundClockInOutTimesSwitch: UISwitch!
    @IBOutlet var roundingButton: UIButton!
    @IBOutlet var roundingPicker: UIPickerView!
    
    var isFixedTimezone: Bool = false
    var willRoundClockTimes: Bool = false
    var willShowPicker: Bool = false
    
    var roundingPickerData: [String] = []
    

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
            fixedTimezoneSwitch.isOn        = item.allow_fixed_timezone.boolValue
            decimalHoursSwitch.isOn         = item.allow_use_decimal_hours.boolValue
            roundClockInOutTimesSwitch.isOn = item.round_clock_inout_times.boolValue
            
            timezoneButton.setTitle(item.timezone, for: .normal)
            roundingButton.setTitle(item.round_increment, for: .normal)
            
            isFixedTimezone     = fixedTimezoneSwitch.isOn
            willRoundClockTimes = roundClockInOutTimesSwitch.isOn
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        fixedTimezoneSwitch.addTarget(self, action: #selector(fixedTimezoneSwitchValueChanged(_:)), for: .valueChanged)
        roundClockInOutTimesSwitch.addTarget(self, action: #selector(roundClockInOutTimesSwitchValueChanged(_:)), for: .valueChanged)
    }
    
    // MARK: - Actions -
    
    @objc func fixedTimezoneSwitchValueChanged(_ sender: UISwitch) {
        isFixedTimezone = sender.isOn
        self.tableView.reloadData()
    }
    
    @objc func roundClockInOutTimesSwitchValueChanged(_ sender: UISwitch) {
        willRoundClockTimes = sender.isOn
        self.tableView.reloadData()
    }
    
    @IBAction func timezoneButtonTapped(_ sender: Any) {
    }
    
    @IBAction func roundingButtonTapped(_ sender: Any) {
        willShowPicker = !willShowPicker
        self.tableView.reloadData()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "allow_fixed_timezone": fixedTimezoneSwitch.isOn,
                                  "timezone": timezoneButton.titleLabel?.text! ?? "",
                                  "allow_use_decimal_hours": decimalHoursSwitch.isOn,
                                  "round_clock_inout_times": roundClockInOutTimesSwitch.isOn,
                                  "round_increment": roundingButton.titleLabel?.text! ?? ""]
        
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
        if section == 0 && row == 1 {
            return isFixedTimezone ? 44 : 0
        } else if section == 2 {
            if row == 1 {
                return willRoundClockTimes ? 44 : 0
            } else if row == 2 {
                return (willRoundClockTimes && willShowPicker) ? 216 : 0
            }
        }
        return 44
    }

}

// MARK: - UIPickerViewDelegate, UIPickerViewDataSource

extension AttoTimeOptionsController: UIPickerViewDelegate, UIPickerViewDataSource {
    
    func initPickerView() {
        roundingPicker.delegate = self
        roundingPicker.dataSource = self
        
        roundingPickerData = ["5 min", "10 min", "15 min", "20 min", "30 min"]
    }
    
    // Sets number of columns in picker view
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }

    // Sets the number of rows in the picker view
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        return roundingPickerData.count
    }
    
    // This function sets the text of the picker view to the content of the "salutations" array
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return roundingPickerData[row]
    }
    
    // When user selects an option, this function will set the text of the text field to reflect
    // the selected option.
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        return roundingButton.setTitle(roundingPickerData[row], for: .normal)
    }
}

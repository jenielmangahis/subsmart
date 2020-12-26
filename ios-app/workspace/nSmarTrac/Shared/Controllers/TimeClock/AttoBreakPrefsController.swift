//
//  AttoBreakPrefsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class AttoBreakPrefsController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var breakRuleButton: UIButton!
    @IBOutlet var lengthButton: UIButton!
    @IBOutlet var typeButton: UIButton!
    @IBOutlet var timePicker: UIDatePicker!
    @IBOutlet var typePicker: UIPickerView!
    
    var breakRule: String = "Manual"
    var willShowBreakLength: Bool = false
    var willShowType: Bool = false
    
    var typePickerData: [String] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
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
            breakRuleButton.setTitle(item.break_rule, for: .normal)
            lengthButton.setTitle(item.break_length, for: .normal)
            typeButton.setTitle(item.break_type, for: .normal)
            
            // check
            if item.break_rule == "Automatic" {
                willShowBreakLength = true
                
                self.tableView.beginUpdates()
                self.tableView.endUpdates()
            }
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func timePickerValueChanged(_ sender: UIDatePicker) {
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
                lengthButton.setTitle("\(String(format: "%d", Int(hour)!))h", for: .normal)
                
                // check mins
                if mins.intValue > 0 {
                    lengthButton.setTitle("\(String(format: "%d", Int(hour)!))h \(String(format: "%d", Int(mins)!))m", for: .normal)
                }
            } else {
                lengthButton.setTitle("\(String(format: "%d", Int(mins)!))m", for: .normal)
            }
        }
    }
    
    @IBAction func breakRuleButtonTapped(_ sender: Any) {
        // present vc
        if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_AttoBreakRuleController")  as? AttoBreakRuleController {
            mVC.callback = { selected in
                // set selected
                self.breakRule = selected
                self.breakRuleButton.setTitle(selected, for: .normal)
                self.tableView.reloadData()
            }
            let navController = UINavigationController(rootViewController: mVC)
            navController.modalPresentationStyle = .formSheet
            present(navController, animated: true, completion: nil)
        }
    }
    
    @IBAction func lengthButtonTapped(_ sender: Any) {
        willShowBreakLength = !willShowBreakLength
        self.tableView.reloadData()
    }
    
    @IBAction func typeButtonTapped(_ sender: Any) {
        willShowType = !willShowType
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        
        // check
        if willShowType {
            typeButton.setImage(UIImage(systemName: "chevron.up"), for: .normal)
        } else {
            typeButton.setImage(UIImage(systemName: "chevron.down"), for: .normal)
        }
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "break_rule": breakRuleButton.titleLabel?.text! ?? "",
                                  "break_length": lengthButton.titleLabel?.text! ?? "",
                                  "break_type": typeButton.titleLabel?.text! ?? ""]
        
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
            return (breakRule == "Automatic") ? 44 : 0
        } else if section == 0 && row == 2 {
            return (breakRule == "Automatic" && willShowBreakLength) ? 216 : 0
        } else if section == 1 && row == 1 {
            return willShowType ? 216 : 0
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        if section == 0 {
            if breakRule == "Manual" {
                return "Team members can start and end breaks at any time while on the clock."
            }
            return ""
        }
        return "Break hours will not be added to the total number of hours for every pay period."
    }

}

// MARK: - UIPickerViewDelegate, UIPickerViewDataSource

extension AttoBreakPrefsController: UIPickerViewDelegate, UIPickerViewDataSource {
    
    func initPickerView() {
        typePicker.delegate = self
        typePicker.dataSource = self
        
        typePickerData = ["Unpaid", "Paid"]
    }
    
    // Sets number of columns in picker view
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }

    // Sets the number of rows in the picker view
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        return typePickerData.count
    }
    
    // This function sets the text of the picker view to the content of the "salutations" array
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return typePickerData[row]
    }
    
    // When user selects an option, this function will set the text of the text field to reflect
    // the selected option.
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        return typeButton.setTitle(typePickerData[row], for: .normal)
    }
}

//
//  AddTimeEntryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 22/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AddTimeEntryController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var workHoursButton: DLRadioButton!
    @IBOutlet var ptoButton: DLRadioButton!
    @IBOutlet var dateField: MaterialTextField!
    @IBOutlet var addDateButton: UIButton!
    @IBOutlet var workFromHourField: MaterialDatePickerField!
    @IBOutlet var workToHourField: MaterialDatePickerField!
    @IBOutlet var addWorkHoursButton: UIButton!
    @IBOutlet var breakFromField: MaterialDatePickerField!
    @IBOutlet var breakToField: MaterialDatePickerField!
    @IBOutlet var addBreakButton: UIButton!
    @IBOutlet var removeBreakButton: UIButton!
    @IBOutlet var breakFromField2: MaterialDatePickerField!
    @IBOutlet var breakToField2: MaterialDatePickerField!
    @IBOutlet var addBreakButton2: UIButton!
    @IBOutlet var removeBreakButton2: UIButton!
    @IBOutlet var breakFromField3: MaterialDatePickerField!
    @IBOutlet var breakToField3: MaterialDatePickerField!
    @IBOutlet var addBreakButton3: UIButton!
    @IBOutlet var removeBreakButton3: UIButton!
    @IBOutlet var breakFromField4: MaterialDatePickerField!
    @IBOutlet var breakToField4: MaterialDatePickerField!
    @IBOutlet var addBreakButton4: UIButton!
    @IBOutlet var removeBreakButton4: UIButton!
    @IBOutlet var breakFromField5: MaterialDatePickerField!
    @IBOutlet var breakToField5: MaterialDatePickerField!
    @IBOutlet var addBreakButton5: UIButton!
    @IBOutlet var removeBreakButton5: UIButton!
    @IBOutlet var breakFromField6: MaterialDatePickerField!
    @IBOutlet var breakToField6: MaterialDatePickerField!
    @IBOutlet var addBreakButton6: UIButton!
    @IBOutlet var removeBreakButton6: UIButton!
    @IBOutlet var breakFromField7: MaterialDatePickerField!
    @IBOutlet var breakToField7: MaterialDatePickerField!
    @IBOutlet var addBreakButton7: UIButton!
    @IBOutlet var removeBreakButton7: UIButton!
    @IBOutlet var breakFromField8: MaterialDatePickerField!
    @IBOutlet var breakToField8: MaterialDatePickerField!
    @IBOutlet var addBreakButton8: UIButton!
    @IBOutlet var removeBreakButton8: UIButton!
    @IBOutlet var breakFromField9: MaterialDatePickerField!
    @IBOutlet var breakToField9: MaterialDatePickerField!
    @IBOutlet var addBreakButton9: UIButton!
    @IBOutlet var removeBreakButton9: UIButton!
    @IBOutlet var ptoHoursField: MaterialDatePickerField!
    @IBOutlet var addPtoHoursButton: UIButton!
    @IBOutlet var ptoCodeField: MaterialTextField!
    @IBOutlet var addPtoCodeButton: UIButton!
    @IBOutlet var noteField: UITextView!
    
    var currentTextField = UITextField()
    
    var isWorkHours: Bool = true
    var breakCount: Int = 1
    var isWorkHourAdded: Bool = false
    var isBreakAdded: Bool = false
    var selectedDates: [Date] = []
    var selectedPTO: TimesheetPTO? = nil
    
    var startToolbar: UIToolbar = {
        // create toolbar for start time
        let title = UIBarButtonItem(title: "Set Start Time", style: .plain, target: nil, action: nil)
        let flexibleSpace = UIBarButtonItem(barButtonSystemItem: .flexibleSpace, target: nil, action: nil)
        let next = UIBarButtonItem(title: "Next", style: .done, target: self, action: #selector(nextButtonTapped(_:)))
        let toolbar = UIToolbar()
        toolbar.items = [title, flexibleSpace, next]
        toolbar.sizeToFit()
        return toolbar
    }()
    
    var endToolbar: UIToolbar = {
        // create toolbar for end time
        let title = UIBarButtonItem(title: "Set End Time", style: .plain, target: nil, action: nil)
        let flexibleSpace = UIBarButtonItem(barButtonSystemItem: .flexibleSpace, target: nil, action: nil)
        let next = UIBarButtonItem(title: "Done", style: .done, target: self, action: #selector(doneButtonTapped(_:)))
        let toolbar = UIToolbar()
        toolbar.items = [title, flexibleSpace, next]
        toolbar.sizeToFit()
        return toolbar
    }()
    
    var toolbar: UIToolbar = {
        // create toolbar for end time
        let title = UIBarButtonItem(title: "Set Start Time", style: .plain, target: nil, action: nil)
        let flexibleSpace = UIBarButtonItem(barButtonSystemItem: .flexibleSpace, target: nil, action: nil)
        let next = UIBarButtonItem(title: "Done", style: .done, target: self, action: #selector(doneButtonTapped(_:)))
        let toolbar = UIToolbar()
        toolbar.items = [title, flexibleSpace, next]
        toolbar.sizeToFit()
        return toolbar
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
        // check selectedDates
        if !selectedDates.isEmpty {
            // update gui
            self.addDateButton.isHidden = true
            
            let items: [String] = selectedDates.map { (item) -> String in
                return String(format: "%@", App.shared.monthDateFormatter.string(from: item))
            }
            self.dateField.text = items.joined(separator: ", ")
        }
        
        workHoursButton.otherButtons = [ptoButton]
        workHoursButton.configureRadio(true)
        workHoursButton.iconSize = 24
        workHoursButton.iconColor = .lightGray
        workHoursButton.iconSelected = UIImage(named: "ic_event_default_check")!
        ptoButton.configureRadio()
        ptoButton.iconSize = 24
        ptoButton.iconColor = .lightGray
        ptoButton.iconSelected = UIImage(named: "ic_event_default_check")!
        
        workFromHourField.reconfigure(startToolbar)
        workToHourField.reconfigure(endToolbar)
        workToHourField.minimumDate = workFromHourField.date
        
        addBreakButton.isEnabled = false
        addBreakButton2.isEnabled = false
        addBreakButton3.isEnabled = false
        addBreakButton4.isEnabled = false
        addBreakButton5.isEnabled = false
        addBreakButton6.isEnabled = false
        addBreakButton7.isEnabled = false
        addBreakButton8.isEnabled = false
        addBreakButton9.isEnabled = false
        
        breakFromField.reconfigure(startToolbar)
        breakToField.reconfigure(endToolbar)
        breakToField.minimumDate = breakFromField.date
        
        breakFromField2.reconfigure(startToolbar)
        breakToField2.reconfigure(endToolbar)
        breakToField2.minimumDate = breakFromField2.date
        
        breakFromField3.reconfigure(startToolbar)
        breakToField3.reconfigure(endToolbar)
        breakToField3.minimumDate = breakFromField3.date
        
        breakFromField4.reconfigure(startToolbar)
        breakToField4.reconfigure(endToolbar)
        breakToField4.minimumDate = breakFromField4.date
        
        breakFromField5.reconfigure(startToolbar)
        breakToField5.reconfigure(endToolbar)
        breakToField5.minimumDate = breakFromField5.date
        
        breakFromField6.reconfigure(startToolbar)
        breakToField6.reconfigure(endToolbar)
        breakToField6.minimumDate = breakFromField6.date
        
        breakFromField7.reconfigure(startToolbar)
        breakToField7.reconfigure(endToolbar)
        breakToField7.minimumDate = breakFromField7.date
        
        breakFromField8.reconfigure(startToolbar)
        breakToField8.reconfigure(endToolbar)
        breakToField8.minimumDate = breakFromField8.date
        
        breakFromField9.reconfigure(startToolbar)
        breakToField9.reconfigure(endToolbar)
        breakToField9.minimumDate = breakFromField9.date
        
        ptoHoursField.reconfigure(toolbar)
        ptoHoursField.picker.locale = Locale(identifier: "en_GB")
        ptoHoursField.picker.addTarget(self, action: #selector(didPickerValueChanged(_:)), for: .valueChanged)
        
        // delegates
        workFromHourField.delegate = self
        workToHourField.delegate = self
        breakFromField.delegate = self
        breakToField.delegate = self
        breakFromField2.delegate = self
        breakToField2.delegate = self
        breakFromField3.delegate = self
        breakToField3.delegate = self
        breakFromField4.delegate = self
        breakToField4.delegate = self
        breakFromField5.delegate = self
        breakToField5.delegate = self
        breakFromField6.delegate = self
        breakToField6.delegate = self
        breakFromField7.delegate = self
        breakToField7.delegate = self
        breakFromField8.delegate = self
        breakToField8.delegate = self
        breakFromField9.delegate = self
        breakToField9.delegate = self
        ptoHoursField.delegate = self
    }
    
    // MARK: - Actions -
    
    @objc func nextButtonTapped(_ sender: Any) {
        // check current textField
        if currentTextField == workFromHourField {
            _ = workToHourField.becomeFirstResponder()
        } else if currentTextField == breakFromField {
            _ = breakToField.becomeFirstResponder()
        } else if currentTextField == breakFromField2 {
            _ = breakToField2.becomeFirstResponder()
        } else if currentTextField == breakFromField3 {
            _ = breakToField3.becomeFirstResponder()
        } else if currentTextField == breakFromField4 {
            _ = breakToField4.becomeFirstResponder()
        } else if currentTextField == breakFromField5 {
            _ = breakToField5.becomeFirstResponder()
        } else if currentTextField == breakFromField6 {
            _ = breakToField6.becomeFirstResponder()
        } else if currentTextField == breakFromField7 {
            _ = breakToField7.becomeFirstResponder()
        } else if currentTextField == breakFromField8 {
            _ = breakToField8.becomeFirstResponder()
        } else if currentTextField == breakFromField9 {
            _ = breakToField9.becomeFirstResponder()
        }
    }
    
    @objc func doneButtonTapped(_ sender: Any) {
        currentTextField.resignFirstResponder()
        
        // check current textField
        if currentTextField == workToHourField {
            self.isWorkHourAdded = true
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
            
            addBreakButton.isEnabled = true
            addBreakButton2.isEnabled = true
            addBreakButton3.isEnabled = true
            addBreakButton4.isEnabled = true
            addBreakButton5.isEnabled = true
            addBreakButton6.isEnabled = true
            addBreakButton7.isEnabled = true
            addBreakButton8.isEnabled = true
            addBreakButton9.isEnabled = true
        } else {
            self.isBreakAdded = true
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    @objc func didPickerValueChanged(_ sender: UIDatePicker) {
        let ptoTimeFormatter: DateFormatter = {
            let formatter = DateFormatter()
            formatter.dateFormat = "HH:mm"
            return formatter
        }()
        
        let time = ptoTimeFormatter.string(from: sender.date).components(separatedBy: ":")
        // check
        if let hour = time.first, let mins = time.last {
            // check
            if hour.intValue > 0 {
                ptoHoursField.text = "\(String(format: "%d", Int(hour)!))h"
                
                // check mins
                if mins.intValue > 0 {
                    ptoHoursField.text = "\(String(format: "%d", Int(hour)!))h \(String(format: "%d", Int(mins)!))m"
                }
            } else {
                ptoHoursField.text = "\(String(format: "%d", Int(mins)!))m"
            }
        }
        
        addPtoHoursButton.isHidden = true
    }
    
    @IBAction func workHoursButtonTapped(_ sender: Any) {
        isWorkHours = true
        addDateButton.isHidden = false
        
        self.tableView.reloadData()
    }
    
    @IBAction func ptoButtonTapped(_ sender: Any) {
        isWorkHours = false
        addDateButton.isHidden = false
        
        self.tableView.reloadData()
    }
    
    @IBAction func addDateButtonTapped(_ sender: UIButton) {
        if let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectDatesController") as? SelectDatesController {
            controller.callback = { dates in
                // update gui
                self.addDateButton.isHidden = true
                
                // assign
                self.selectedDates = dates
                
                let items: [String] = dates.map { (item) -> String in
                    return String(format: "%@", App.shared.monthDateFormatter.string(from: item))
                }
                self.dateField.text = items.joined(separator: ", ")
            }
            let navController = UINavigationController(rootViewController: controller)
            navController.modalPresentationStyle = .formSheet
            self.present(navController, animated: true, completion: nil)
        }
    }
    
    @IBAction func removeDateButtonTapped(_ sender: UIButton) {
        addDateButton.isHidden = false
        dateField.text = ""
    }
    
    @IBAction func addClockInOutButtonTapped(_ sender: UIButton) {
        sender.isHidden             = true
        workFromHourField.isEnabled = true
        workToHourField.isEnabled   = true
        workToHourField.text        = ""
        _ = workFromHourField.becomeFirstResponder()
    }
    
    @IBAction func removeClockInOutButtonTapped(_ sender: UIButton) {
        addWorkHoursButton.isHidden = false
        
        self.isWorkHourAdded = false
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
        self.initViews()
    }
    
    @IBAction func addBreakButtonTapped(_ sender: UIButton) {
        sender.isHidden = true
        
        // check sender
        if sender == addBreakButton {
            breakFromField.isEnabled    = true
            breakToField.isEnabled      = true
            breakToField.text           = ""
            _ = breakFromField.becomeFirstResponder()
        } else if sender == addBreakButton2 {
            breakFromField2.isEnabled   = true
            breakToField2.isEnabled     = true
            breakToField2.text          = ""
            _ = breakFromField2.becomeFirstResponder()
        } else if sender == addBreakButton3 {
            breakFromField3.isEnabled   = true
            breakToField3.isEnabled     = true
            breakToField3.text          = ""
            _ = breakFromField3.becomeFirstResponder()
        } else if sender == addBreakButton4 {
            breakFromField4.isEnabled   = true
            breakToField4.isEnabled     = true
            breakToField4.text          = ""
            _ = breakFromField4.becomeFirstResponder()
        } else if sender == addBreakButton5 {
            breakFromField5.isEnabled   = true
            breakToField5.isEnabled     = true
            breakToField5.text          = ""
            _ = breakFromField5.becomeFirstResponder()
        } else if sender == addBreakButton6 {
            breakFromField6.isEnabled   = true
            breakToField6.isEnabled     = true
            breakToField6.text          = ""
            _ = breakFromField6.becomeFirstResponder()
        } else if sender == addBreakButton7 {
            breakFromField7.isEnabled   = true
            breakToField7.isEnabled     = true
            breakToField7.text          = ""
            _ = breakFromField7.becomeFirstResponder()
        } else if sender == addBreakButton8 {
            breakFromField8.isEnabled   = true
            breakToField8.isEnabled     = true
            breakToField8.text          = ""
            _ = breakFromField8.becomeFirstResponder()
        } else if sender == addBreakButton9 {
            breakFromField9.isEnabled   = true
            breakToField9.isEnabled     = true
            breakToField9.text          = ""
            _ = breakFromField9.becomeFirstResponder()
        }
    }
    
    @IBAction func removeBreakButtonTapped(_ sender: UIButton) {
        // check sender
        if sender == removeBreakButton {
            addBreakButton.isHidden = false
            breakFromField.text = ""
            breakToField.text = ""
        } else if sender == removeBreakButton2 {
            addBreakButton2.isHidden = false
            breakFromField2.text = ""
            breakToField2.text = ""
        } else if sender == removeBreakButton3 {
            addBreakButton3.isHidden = false
            breakFromField3.text = ""
            breakToField3.text = ""
        } else if sender == removeBreakButton4 {
            addBreakButton4.isHidden = false
            breakFromField4.text = ""
            breakToField4.text = ""
        } else if sender == removeBreakButton5 {
            addBreakButton5.isHidden = false
            breakFromField5.text = ""
            breakToField5.text = ""
        } else if sender == removeBreakButton6 {
            addBreakButton6.isHidden = false
            breakFromField6.text = ""
            breakToField6.text = ""
        } else if sender == removeBreakButton7 {
            addBreakButton7.isHidden = false
            breakFromField7.text = ""
            breakToField7.text = ""
        } else if sender == removeBreakButton8 {
            addBreakButton8.isHidden = false
            breakFromField8.text = ""
            breakToField8.text = ""
        } else if sender == removeBreakButton9 {
            addBreakButton9.isHidden = false
            breakFromField9.text = ""
            breakToField9.text = ""
        }
        
        // check breakCount
        if breakCount > 1 {
            self.breakCount -= 1
        } else {
            self.isBreakAdded = false
        }
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func addAnotherBreakButtonTapped(_ sender: Any) {
        self.breakCount += 1
        self.isBreakAdded = false
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func addPtoHoursButtonTapped(_ sender: UIButton) {
        ptoHoursField.isEnabled = true
        _ = ptoHoursField.becomeFirstResponder()
    }
    
    @IBAction func removePtoHoursButtonTapped(_ sender: UIButton) {
        addPtoHoursButton.isHidden = false
        ptoHoursField.text = ""
        _ = ptoHoursField.resignFirstResponder()
    }
    
    @IBAction func addPtoCodeButtonTapped(_ sender: UIButton) {
        // present vc
        if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectPTOController")  as? SelectPTOController {
            mVC.callback = { pto in
                // update gui
                self.addPtoCodeButton.isHidden = true
                // set selected
                self.selectedPTO = pto
                // assign
                self.ptoCodeField.text = pto.name
            }
            let navController = UINavigationController(rootViewController: mVC)
            navController.modalPresentationStyle = .formSheet
            present(navController, animated: true, completion: nil)
        }
    }
    
    @IBAction func removePtoCodeButtonTapped(_ sender: UIButton) {
        addPtoCodeButton.isHidden = false
        ptoCodeField.text = ""
    }
    
    @IBAction func addEntryButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // check if regular hours
        if workHoursButton.isSelected {
            // iterate dates
            for date in selectedDates {
                
                // get shift duration
                let startTime = App.shared.timeFormatter.date(from: workFromHourField.text!)!
                let endTime = App.shared.timeFormatter.date(from: workToHourField.text!)!
                let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: startTime, to: endTime)
                var shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
                
                // init break fields
                let fromFields = [breakFromField, breakFromField2, breakFromField3, breakFromField4, breakFromField5, breakFromField6, breakFromField7, breakFromField8, breakFromField9]
                let toFields = [breakToField, breakToField2, breakToField3, breakToField4, breakToField5, breakToField6, breakToField7, breakToField8, breakToField9]
                // get break duration
                var breakDuration = 0.00
                
                // iterate breaks
                for x in 0...breakCount-1 {
                    // chek if not nil
                    if let breakFrom = fromFields[x]?.text, let breakTo = toFields[x]?.text {
                        // gets start and end break
                        let startBreak = App.shared.timeFormatter.date(from: breakFrom)!
                        let endBreak = App.shared.timeFormatter.date(from: breakTo)!
                        let breakDiff = Calendar.current.dateComponents([.hour, .minute], from: startBreak, to: endBreak)
                        breakDuration = "\(breakDiff.hour!):\(breakDiff.minute!)".decimalTime
                    }
                }
                // update shiftDuration
                shiftDuration = shiftDuration - breakDuration
                
                // get overtime
                let overtime = (shiftDuration > 8) ? shiftDuration - 8 : 0.00
                
                // check shift duration
                if shiftDuration > 8 {
                    shiftDuration = shiftDuration - overtime
                }
                
                // params
                let params: Parameters = ["user_id": App.shared.user!.id,
                                          "shift_duration": shiftDuration,
                                          "break_duration": breakDuration,
                                          "overtime": overtime,
                                          "date_created": App.shared.dateFormatter.string(from: date),
                                          "status": 0,
                                          "notes": noteField.text!]
                
                // add attendance
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postTimesheetAttendance(params) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return print(error?.localizedDescription as Any)
                    }
                    guard result?.Code == 200 else {
                        return print(result!.Message!)
                    }
                    
                    // id
                    if let id = result?.Data {
                        
                        // create time clock message
                        let message = App.shared.user!.full_name + " has Manually Added Time Entry today at " + App.shared.timeFormatter.string(from: Date())
                        
                        // create date
                        let startDate = App.shared.dateFormatter.string(from: date) + " " + self.workFromHourField.text!.to24hTimeFormat
                        let endDate = App.shared.dateFormatter.string(from: date) + " " + self.workToHourField.text!.to24hTimeFormat
                        
                        // check in
                        let params2: Parameters = ["attendance_id": id,
                                                   "user_id": App.shared.user!.id,
                                                   "user_location": "0,0",
                                                   "action": "Check in",
                                                   "entry_type": "Manual",
                                                   "date_created": startDate,
                                                   "approved_by": 0,
                                                   "company_id": App.shared.companyId,
                                                   "workorder_id": 0,
                                                   "message": message]
                        
                        // add log
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show(withStatus: "Saving...")
                        App.shared.api.postTimesheetLog(params2) { (_, _) in
                            SVProgressHUD.setDefaultMaskType(.none)
                            SVProgressHUD.dismiss()
                            
                            // create group
                            let group = DispatchGroup()
                            
                            
                            // break if the is any
                            // iterate breaks
                            for x in 0...self.breakCount-1 {
                                // chek if not nil
                                if let breakFrom = fromFields[x]?.text, let breakTo = toFields[x]?.text {
                                    // gets break time
                                    let startBreak = App.shared.dateFormatter.string(from: date) + " " + breakFrom.to24hTimeFormat
                                    let endBreak = App.shared.dateFormatter.string(from: date) + " " + breakTo.to24hTimeFormat
                                    
                                    // enter group
                                    group.enter()
                                    
                                    // break in
                                    let params3: Parameters = ["attendance_id": id,
                                                               "user_id": App.shared.user!.id,
                                                               "user_location": "0,0",
                                                               "action": "Break in",
                                                               "entry_type": "Manual",
                                                               "date_created": startBreak,
                                                               "approved_by": 0,
                                                               "company_id": App.shared.companyId,
                                                               "workorder_id": 0,
                                                               "message": ""]
                                    
                                    // add log
                                    SVProgressHUD.setDefaultMaskType(.clear)
                                    SVProgressHUD.show(withStatus: "Saving...")
                                    App.shared.api.postTimesheetLog(params3) { (_, _) in
                                        SVProgressHUD.setDefaultMaskType(.none)
                                        SVProgressHUD.dismiss()
                                        
                                        // leave group
                                        group.leave()
                                        
                                        // break out
                                        let params4: Parameters = ["attendance_id": id,
                                                                   "user_id": App.shared.user!.id,
                                                                   "user_location": "0,0",
                                                                   "action": "Break out",
                                                                   "entry_type": "Manual",
                                                                   "date_created": endBreak,
                                                                   "approved_by": 0,
                                                                   "company_id": App.shared.companyId,
                                                                   "workorder_id": 0,
                                                                   "message": ""]
                                        
                                        // enter group
                                        group.enter()
                                        
                                        // add log
                                        SVProgressHUD.setDefaultMaskType(.clear)
                                        SVProgressHUD.show(withStatus: "Saving...")
                                        App.shared.api.postTimesheetLog(params4) { (_, _) in
                                            SVProgressHUD.setDefaultMaskType(.none)
                                            SVProgressHUD.dismiss()
                                            
                                            // leave group
                                            group.leave()
                                        }
                                    }
                                }
                            }
                            
                            // notify group
                            group.notify(queue: DispatchQueue.main, execute: {
                                
                                // check out
                                let params5: Parameters = ["attendance_id": id,
                                                           "user_id": App.shared.user!.id,
                                                           "user_location": "0,0",
                                                           "action": "Check out",
                                                           "entry_type": "Manual",
                                                           "date_created": endDate,
                                                           "approved_by": 0,
                                                           "company_id": App.shared.companyId,
                                                           "workorder_id": 0,
                                                           "message": ""]
                                
                                // add log
                                SVProgressHUD.setDefaultMaskType(.clear)
                                SVProgressHUD.show(withStatus: "Saving...")
                                App.shared.api.postTimesheetLog(params5) { (_, _) in
                                    SVProgressHUD.setDefaultMaskType(.none)
                                    SVProgressHUD.dismiss()
                                    
                                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                                    self.popViewController()
                                }
                                
                            })
                        }
                    }
                    
                }
            }
        } else {
            // pto
            // dates
            let dates: [String] = selectedDates.map { (date) -> String in
                return App.shared.dateFormatter.string(from: date)
            }
            
            // params
            let params: Parameters = ["user_id": App.shared.user!.id,
                                      "pto_id": self.selectedPTO?.id ?? 0,
                                      "total_hours": self.ptoHoursField.text!,
                                      "date_created": App.shared.dateFormatter.string(from: Date()),
                                      "status": 0,
                                      "dates": dates.joined(separator: ", ")]
            
            // add attendance
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Saving...")
            App.shared.api.postTimesheetPTO(params) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return print(error?.localizedDescription as Any)
                }
                guard result?.Code == 200 else {
                    return print(result!.Message!)
                }
                
                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                self.popViewController()
            }
        }
    }
    
    @IBAction func addAnotherButtonTapped(_ sender: Any) {
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row = indexPath.row
        
        // check
        if section == 7 {
            return 130
        } else if section  == 6 {
            return 200
        } else if section == 5 || section == 4 {
            return isWorkHours ? 0 : 44
        } else if section == 3 {
            if isWorkHours {
                if row == 9 {
                    return (breakCount >= 1 && isWorkHourAdded && isBreakAdded) ? 44 : 0
                } else if row <= breakCount-1 {
                    return 44
                }
                return 0
            }
            return 0
        } else if section == 2 {
            return isWorkHours ? 44 : 0
        } else if section == 0 {
            return 44
        }
        return 44
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        // check
        if isWorkHours {
            let titles = ["SELECT ENTRY TYPE", "DATE", "WORK HOURS", "BREAK TIME", "", "", "NOTES", nil]
            return titles[section]
        }
        
        let titles = ["SELECT ENTRY TYPE", "DATE", "", "", "PTO HOURS", "PTO CODE", "NOTES", nil]
        return titles[section]
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        // check
        if section == 2 || section == 3 {
            return isWorkHours ? 44 : 0.0001
        } else if section == 4 || section == 5 {
            return isWorkHours ? 0.0001 : 44
        } else if section == 7 {
            return 18
        }
        return 44
    }
    
}

// MARK: - UITextFieldDelegate -

extension AddTimeEntryController: UITextFieldDelegate {
    
    func textFieldShouldBeginEditing(_ textField: UITextField) -> Bool {
        currentTextField        = textField
        currentTextField.text   = (textField == ptoHoursField) ? "" : "12:00 AM"
        return true
    }
}

// MARK: - Extension -

extension String {
    
    var to24hTimeFormat: String {
        // string to date
        let time = App.shared.timeFormatter.date(from: self)
        // change format
        let time24 = App.shared.time24Formatter.string(from: time!)
        return time24
    }
}

//
//  TimeClockController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import CoreLocation
import FontAwesome_swift
import Pulsator
import SVProgressHUD

class TimeClockController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var headerView: UIView!
    @IBOutlet var indicatorView: UIView!
    @IBOutlet var onTheClockLabel: UILabel!
    @IBOutlet var dateLabel: UILabel!
    @IBOutlet var timerLabel: UILabel!
    @IBOutlet var toggleButton: DesignableButton!
    @IBOutlet var toggleView: DesignableView!
    @IBOutlet var containerView: UIView!
    @IBOutlet var actionView: UIView!
    @IBOutlet var noteIcon: UIImageView!
    @IBOutlet var coffeeIcon: UIImageView!
    @IBOutlet var bookmarkIcon: UIImageView!
    
    let pulsator = Pulsator()
    var timer = Timer()
    
    var item: TimesheetTeamMember?
    var activeTimeClock: TimesheetAttendance?
    
    var lastClockInTime: Date? = nil
    var lastClockOutTime: Date? = nil
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override func viewDidAppear(_ animated: Bool) {
        self.parent?.navigationItem.title = "Time Clock"
        initPulsator()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // set date to dateLabel
        dateLabel.text = "Today • " + Date().toString(format: .custom("MMM dd"))
        
        // init views
        headerView.isHidden = true
        timerLabel.isHidden = true
        actionView.isHidden = true
        toggleButton.setTitle("CLOCK IN", for: .normal)
        toggleView.backgroundColor = UIColor.greenColor
        pulsator.backgroundColor = UIColor.greenColor.cgColor
        
        // check based on data fetch
        if let item = App.shared.userTimesheet {
            // get last attendance
            if let attendance = item.attendance.last {
                
                // set
                self.item = item
                self.activeTimeClock = attendance
                
                // iterate logs
                for log in attendance.logs {
                    // check
                    if log.action == "Check in" {
                        lastClockInTime = App.shared.dateTimeFormatter.date(from: log.date_created)
                        
                        // save id to userdefaults
                        UserDefaults.standard.set(attendance.id, forKey: "LAST_ATTENDANCE_ID")
                        UserDefaults.standard.set(lastClockInTime, forKey: "LAST_ATTENDANCE_CREATED")
                        UserDefaults.standard.synchronize()
                        
                    } else if log.action == "Check out" {
                        lastClockOutTime = App.shared.dateTimeFormatter.date(from: log.date_created)
                        
                        // update userdefaults
                        UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_ID")
                        UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_CREATED")
                        UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_DURATION")
                        UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_DIFF")
                        UserDefaults.standard.set(lastClockOutTime, forKey: "LAST_ATTENDANCE_STOP")
                        UserDefaults.standard.synchronize()
                    }
                }
                
                // get last log
                if let lastLog = attendance.logs.last {
                    // check last log
                    if lastLog.action == "Break in" {
                        // update ui
                        headerView.isHidden = false
                        indicatorView.backgroundColor = .orangeColor
                        onTheClockLabel.text = "On Break • 0m"
                        
                        timerLabel.isHidden = false
                        actionView.isHidden = true
                        toggleButton.setTitle("END BREAK", for: .normal)
                        toggleView.backgroundColor = UIColor.orangeColor
                        pulsator.backgroundColor = UIColor.orangeColor.cgColor
                        
                        // update userdefaults
                        UserDefaults.standard.set(App.shared.dateTimeFormatter.date(from: lastLog.date_created), forKey: "LAST_ATTENDANCE_BREAK_START")
                        UserDefaults.standard.synchronize()
                        
                        // update timer
                        self.timer = Timer.scheduledTimer(timeInterval: 1, target: self, selector: #selector(self.updateTimer(_:)), userInfo: nil, repeats: true)
                        
                    } else if lastLog.action == "Check in" || lastLog.action == "Break out" {
                        // update ui
                        headerView.isHidden = false
                        indicatorView.backgroundColor = .greenColor
                        onTheClockLabel.text = "On the Clock"
                        
                        timerLabel.isHidden = false
                        actionView.isHidden = false
                        toggleButton.setTitle("CLOCK OUT", for: .normal)
                        toggleView.backgroundColor = UIColor.redColor
                        pulsator.backgroundColor = UIColor.redColor.cgColor
                        
                        // check
                        if lastLog.action == "Break out" {
                            // update userdefaults
                            UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_START")
                            UserDefaults.standard.set(attendance.break_duration.doubleValue, forKey: "LAST_ATTENDANCE_BREAK_DIFF")
                            UserDefaults.standard.synchronize()
                        }
                        
                        // update timer
                        self.timer = Timer.scheduledTimer(timeInterval: 1, target: self, selector: #selector(self.updateTimer(_:)), userInfo: nil, repeats: true)
                        
                    } else if lastLog.action == "Check out" {
                        // update ui
                        headerView.isHidden = true
                        timerLabel.isHidden = true
                        actionView.isHidden = true
                        toggleButton.setTitle("CLOCK IN", for: .normal)
                        toggleView.backgroundColor = UIColor.greenColor
                        pulsator.backgroundColor = UIColor.greenColor.cgColor
                    }
                }
            }
        }
    }
    
    // MARK: - Action -
    
    @IBAction func clockInButtonTapped(_ sender: Any) {
        
        // check user location
        var coordinates = "0,0"
        if let location = App.shared.userLocation,
           let address = App.shared.userLocationAddress {
            
            // set
            coordinates = "\(location.coordinate.latitude),\(location.coordinate.longitude)"
            
            // explode address
            let mAddress = address.components(separatedBy: ", ")
            
            // check if currently in coffee break
            if UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_BREAK_START") != nil {
                // update ui
                self.headerView.isHidden = false
                self.indicatorView.backgroundColor = .greenColor
                self.onTheClockLabel.text = "On the clock"
                
                self.timerLabel.isHidden = false
                self.actionView.isHidden = false
                self.toggleButton.setTitle("CLOCK OUT", for: .normal)
                self.toggleView.backgroundColor = UIColor.redColor
                self.pulsator.backgroundColor = UIColor.redColor.cgColor
                
                // get break duration
                let breakStart = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_BREAK_START")
                let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: breakStart as! Date, to: Date())
                let breakDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
                
                // get break difference
                let breakTimestamp = (breakStart as! Date).timeIntervalSince1970
                let currentTimestamp = Date().timeIntervalSince1970
                let breakDiff = currentTimestamp - breakTimestamp
                
                // get id
                if let id = UserDefaults.standard.string(forKey: "LAST_ATTENDANCE_ID") {
                    
                    // update userdefaults
                    UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_START")
                    UserDefaults.standard.set(breakDiff, forKey: "LAST_ATTENDANCE_BREAK_DIFF")
                    UserDefaults.standard.synchronize()
                    
                    // attendance
                    let attendance: Parameters = ["break_duration": (self.activeTimeClock?.break_duration.doubleValue ?? 0.00) + breakDuration]
                    
                    // log
                    let log: Parameters = ["attendance_id": id,
                                           "user_id": App.shared.user!.id,
                                           "user_location": coordinates,
                                           "user_location_address": address,
                                           "action": "Break out",
                                           "entry_type": "Normal",
                                           "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                           "approved_by": 0,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": 0]
                    
                    // create time clock message
                    let message = App.shared.user!.full_name + " is On the Clock again today in " + mAddress.first! + " at " + App.shared.timeFormatter.string(from: Date())
                    
                    // params
                    let params: Parameters = ["attendance": attendance,
                                              "log": log,
                                              "user_id": App.shared.user!.id,
                                              "message": message,
                                              "company_id": App.shared.companyId]
                    
                    // call api
                    App.shared.api.putTimesheet(id.intValue, params: params) { (result, error) in
                        guard error == nil else {
                            return print(error?.localizedDescription as Any)
                        }
                        
                        // assign to global
                        App.shared.userTimesheet = result
                    }
                }
            }
            // check if there is an existing attendance_id
            else if UserDefaults.standard.string(forKey: "LAST_ATTENDANCE_ID") != nil {
                // invalidate timer
                self.timer.invalidate()
                
                // update ui
                self.headerView.isHidden = true
                self.indicatorView.backgroundColor = .greenColor
                self.onTheClockLabel.text = "On the Clock"
                
                self.timerLabel.isHidden = true
                self.actionView.isHidden = true
                self.toggleButton.setTitle("CLOCK IN", for: .normal)
                self.toggleView.backgroundColor = UIColor.greenColor
                self.pulsator.backgroundColor = UIColor.greenColor.cgColor
                
                // get id
                if let id = UserDefaults.standard.string(forKey: "LAST_ATTENDANCE_ID"),
                   let createdDate = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_CREATED") {

                    // get shift duration
                    let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: createdDate as! Date, to: Date())
                    var shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
                    
                    // get break duration
                    var breakDuration = 0.00
                    if let duration = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_BREAK_DURATION") {
                        breakDuration = duration as! Double
                    }
                    
                    // get overtime
                    let overtime = (shiftDuration > 8) ? shiftDuration - 8 : 0.00
                    
                    // check shift duration
                    if shiftDuration > 8 {
                        shiftDuration = shiftDuration - overtime
                    }
                    
                    // update userdefaults
                    UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_ID")
                    UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_CREATED")
                    UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_DURATION")
                    UserDefaults.standard.set(nil, forKey: "LAST_ATTENDANCE_BREAK_DIFF")
                    UserDefaults.standard.set(Date(), forKey: "LAST_ATTENDANCE_STOP")
                    UserDefaults.standard.set(coordinates, forKey: "LAST_ATTENDANCE_END_LOCATION")
                    UserDefaults.standard.synchronize()
                    
                    
                    // attendance
                    let attendance: Parameters = ["user_id": App.shared.user!.id,
                                                  "shift_duration": shiftDuration,
                                                  "break_duration": breakDuration,
                                                  "overtime": overtime,
                                                  "status": 0]
                    
                    // log
                    let log: Parameters = ["attendance_id": id,
                                           "user_id": App.shared.user!.id,
                                           "user_location": coordinates,
                                           "user_location_address": address,
                                           "action": "Check out",
                                           "entry_type": "Normal",
                                           "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                           "approved_by": 0,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": 0]
                    
                    // create time clock message
                    let message = App.shared.user!.full_name + " has Clocked Out today in " + mAddress.first! + " at " + App.shared.timeFormatter.string(from: Date())
                    
                    // params
                    let params: Parameters = ["attendance": attendance,
                                              "log": log,
                                              "user_id": App.shared.user!.id,
                                              "message": message,
                                              "company_id": App.shared.companyId]
                    
                    // call api
                    App.shared.api.putTimesheet(id.intValue, params: params) { (result, error) in
                        guard error == nil else {
                            return print(error?.localizedDescription as Any)
                        }
                        
                        // assign to global
                        App.shared.userTimesheet = result
                    }
                }
                
            } else {
                // update ui
                self.headerView.isHidden = false
                self.indicatorView.backgroundColor = .greenColor
                self.onTheClockLabel.text = "On the Clock"
                
                self.timerLabel.text     = "00:00:00"
                self.timerLabel.isHidden = false
                self.actionView.isHidden = false
                self.toggleButton.setTitle("CLOCK OUT", for: .normal)
                self.toggleView.backgroundColor = UIColor.redColor
                self.pulsator.backgroundColor = UIColor.redColor.cgColor
                
                // save id to userdefaults
                UserDefaults.standard.set(Date(), forKey: "LAST_ATTENDANCE_CREATED")
                UserDefaults.standard.synchronize()
                
                // update timer
                self.timer = Timer.scheduledTimer(timeInterval: 1, target: self, selector: #selector(self.updateTimer(_:)), userInfo: nil, repeats: true)
                
                
                // attendance
                let attendance: Parameters = ["user_id": App.shared.user!.id,
                                              "shift_duration": 0.00,
                                              "break_duration": 0.00,
                                              "overtime": 0.00,
                                              "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                              "status": 1]
                
                // log
                let log: Parameters = ["user_id": App.shared.user!.id,
                                       "user_location": coordinates,
                                       "user_location_address": address,
                                       "action": "Check in",
                                       "entry_type": "Normal",
                                       "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                       "approved_by": 0,
                                       "company_id": App.shared.companyId,
                                       "workorder_id": 0]
                
                // create time clock message
                let message = App.shared.user!.full_name + " has Clocked In today in " + mAddress.first! + " at " + App.shared.timeFormatter.string(from: Date())
                
                // params
                let params: Parameters = ["attendance": attendance,
                                          "log": log,
                                          "user_id": App.shared.user!.id,
                                          "message": message,
                                          "company_id": App.shared.companyId]
                
                // call api
                App.shared.api.postTimesheet(params) { (result, error) in
                    guard error == nil else {
                        return print(error?.localizedDescription as Any)
                    }
                    
                    // assign to global
                    App.shared.userTimesheet = result
                }
            }
            
        } else {
            Utils.shared.showAlertWithMessage(title: "Turn On Location Services!", message: "nSmarTrac requires Location Services set to 'Always' for you to clock in/out, add break or add job. Open the app's permissions page and enable location tracking.")
        }
    }
    
    @IBAction func addNotesButtonTapped(_ sender: Any) {
        self.presentFormSheet(storyBoard: self.storyboard!, identifier: "sb_AddNotesController")
    }
    
    @IBAction func takeBreakButtonTapped(_ sender: Any) {
        var coordinates = "0,0"
        if let location = App.shared.userLocation,
           let address = App.shared.userLocationAddress {
            
            // set
            coordinates = "\(location.coordinate.latitude),\(location.coordinate.longitude)"
            
            // explode address
            let mAddress = address.components(separatedBy: ", ")
            
            // get id
            if let id = UserDefaults.standard.string(forKey: "LAST_ATTENDANCE_ID") {
                // update ui
                headerView.isHidden = false
                indicatorView.backgroundColor = .orangeColor
                
                timerLabel.isHidden = false
                actionView.isHidden = true
                toggleButton.setTitle("END BREAK", for: .normal)
                toggleView.backgroundColor = UIColor.orangeColor
                pulsator.backgroundColor = UIColor.orangeColor.cgColor
                
                // save break start dateTime
                UserDefaults.standard.set(Date(), forKey: "LAST_ATTENDANCE_BREAK_START")
                UserDefaults.standard.synchronize()
                
                // create time clock message
                let message = App.shared.user!.full_name + " is taking a Break today in " + mAddress.first! + " at " + App.shared.timeFormatter.string(from: Date())
                
                // break in
                let params2: Parameters = ["attendance_id": id,
                                           "user_id": App.shared.user!.id,
                                           "user_location": coordinates,
                                           "user_location_address": address,
                                           "action": "Break in",
                                           "entry_type": "Normal",
                                           "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                           "approved_by": 0,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": 0,
                                           "message": message]
                
                // add log
                App.shared.api.postTimesheetLog(params2) { (result2, error2) in
                    guard error2 == nil else {
                        return print(error2?.localizedDescription as Any)
                    }
                    guard result2?.Code == 200 else {
                        return print(result2!.Message as Any)
                    }
                    
                    // get current attendance
                    App.shared.api.getUserTimesheet() { (result3, error3) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        if let e = error3 {
                            return print(e.localizedDescription)
                        }
                        
                        App.shared.userTimesheet = result3
                    }
                }
            }
        }
    }
    
    @IBAction func addJobButtonTapped(_ sender: Any) {
    }
    
    // MARK: - Functions -
    
    func initPulsator() {
        pulsator.backgroundColor    = UIColor.greenColor.cgColor
        pulsator.numPulse           = 3
        pulsator.position           = CGPoint(x: containerView.layer.bounds.midX, y: containerView.layer.bounds.midY)
        pulsator.radius             = 180
        containerView.layer.addSublayer(pulsator)
        pulsator.start()
    }
    
    @objc func updateTimer(_ sender: Any) {
        if let createdDate = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_CREATED") {
            let createTimestamp = (createdDate as! Date).timeIntervalSince1970
            let currentTimestamp = Date().timeIntervalSince1970
            var diff = currentTimestamp - createTimestamp
            
            // check if currently in coffee break
            if let breakStart = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_BREAK_START") {
                let breakTimestamp = (breakStart as! Date).timeIntervalSince1970
                diff = breakTimestamp - createTimestamp
                
                // get break duration
                let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: breakStart as! Date, to: Date())
                let breakDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
                self.onTheClockLabel.text = "On Break • " + App.shared.breakHourFormatter.string(from: breakDuration * 3600)!
            }
            
            // check if there is break diff
            if let breakDiff = UserDefaults.standard.object(forKey: "LAST_ATTENDANCE_BREAK_DIFF") {
                diff = diff - (breakDiff as! Double)
            }
            
            // check
            if diff < 10 {
                self.timerLabel.text = "00:00:0" + App.shared.toHourFormatter.string(from: diff)!
            } else if diff < 60 {
                self.timerLabel.text = "00:00:" + App.shared.toHourFormatter.string(from: diff)!
            } else if diff < 600 {
                self.timerLabel.text = "00:0" + App.shared.toHourFormatter.string(from: diff)!
            } else if diff < 3600 {
                self.timerLabel.text = "00:" + App.shared.toHourFormatter.string(from: diff)!
            } else if diff < 36000 {
                self.timerLabel.text = "0" + App.shared.toHourFormatter.string(from: diff)!
            } else {
                self.timerLabel.text = App.shared.toHourFormatter.string(from: diff)
            }
        }
    }

}
